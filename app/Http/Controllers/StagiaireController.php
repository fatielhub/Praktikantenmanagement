<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StagiaireController extends Controller
{
    // ==============================
    // Admin Methods (Auth + Admin)
    // ==============================

    public function index(Request $request)
    {
        $query = Stagiaire::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%")
                  ->orWhere('dossier_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stagiaires = $query->orderBy('id', 'desc')->paginate(10);

        return view('stagiaires.index', compact('stagiaires'));
    }

    public function create()
    {
        $services = Service::all();
        return view('stagiaires.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'email'=>'nullable|email|max:255',
            'cin'=>'nullable|string|max:50|unique:stagiaires,cin',
            'telephone'=>'nullable|string|max:50',
            'filiere'=>'nullable|string|max:255',
            'sujet_rapport'=>'nullable|string|max:500',
            'service_id'=>'nullable|integer|exists:services,id',
            'date_naissance'=>'nullable|date',
            'niveau_etude'=>'required|string|max:255',
            'message'=>'nullable|string',
            'debut_stage'=>'required|date',
            'fin_stage'=>'required|date|after:debut_stage',
        ]);

        $data = $request->all();
        $data['status'] = 'pending';
        $data['sujet_rapport'] = $data['sujet_rapport'] ?? '';

        Stagiaire::create($data);

        return redirect()->route('stagiaires.index')->with('success','Stagiaire ajouté avec succès!');
    }

    public function edit($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        $services = Service::all();
        return view('stagiaires.edit', compact('stagiaire','services'));
    }

    public function update(Request $request, $id)
    {
        $stagiaire = Stagiaire::findOrFail($id);

        $data = $request->validate([
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'email'=>'nullable|email|max:255',
            'cin'=>'nullable|string|max:50|unique:stagiaires,cin,' . $id,
            'telephone'=>'nullable|string|max:50',
            'filiere'=>'nullable|string|max:255',
            'sujet_rapport'=>'nullable|string|max:500',
            'service_id'=>'nullable|integer|exists:services,id',
            'date_naissance'=>'nullable|date',
            'niveau_etude'=>'required|string|max:255',
            'message'=>'nullable|string',
            'debut_stage'=>'required|date',
            'fin_stage'=>'required|date|after:debut_stage',
        ]);

        $data['sujet_rapport'] = $data['sujet_rapport'] ?? '';

        $stagiaire->update($data);

        return redirect()->route('stagiaires.index')->with('success','Stagiaire mis à jour avec succès!');
    }

    public function accept($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update(['status'=>'accepted']);

        $this->createCertificate($stagiaire->id);

        try {
            \Mail::to($stagiaire->email)->send(new \App\Mail\ApplicationAccepted($stagiaire));
        } catch (\Exception $e) {
            \Log::error('Mail error: '.$e->getMessage());
        }

        return redirect()->route('stagiaires.index')->with('success','Stagiaire accepté et email envoyé.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'refusal_reason'=>'required|string|max:1000',
        ]);

        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update([
            'status'=>'rejected',
            'refusal_reason'=>$request->refusal_reason
        ]);

        try {
            \Mail::to($stagiaire->email)->send(new \App\Mail\ApplicationRejected($stagiaire, $request->refusal_reason));
        } catch (\Exception $e) {
            \Log::error('Mail error: '.$e->getMessage());
        }

        return redirect()->route('stagiaires.index')->with('success','Stagiaire rejeté et email envoyé.');
    }

    public function setPending($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        $stagiaire->update(['status'=>'pending']);
        return redirect()->back()->with('success','Statut mis à jour en En attente.');
    }

    private function createCertificate($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        if($stagiaire->status !== 'accepted') return;

        $pdf = Pdf::loadView('certificates.attestation', compact('stagiaire'));
        $filename = 'attestations/attestation_'.$stagiaire->id.'_'.time().'.pdf';
        Storage::disk('public')->put($filename, $pdf->output());
        $stagiaire->update(['attestation_path'=>$filename]);
    }

    public function viewCertificate($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        if(!$stagiaire->attestation_path || !Storage::disk('public')->exists($stagiaire->attestation_path)){
            abort(404,'Attestation non disponible');
        }
        return response()->file(Storage::disk('public')->path($stagiaire->attestation_path));
    }

    public function downloadCertificate($id)
    {
        $stagiaire = Stagiaire::findOrFail($id);
        return Storage::disk('public')->download($stagiaire->attestation_path,'attestation_stage_'.$stagiaire->nom.'.pdf');
    }

    // ==============================
    // Public Methods (NO LOGIN)
    // ==============================

    public function publicApply()
    {
        return view('public.apply');
    }

    public function publicSubmit(Request $request)
    {
        $request->validate([
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'cin'=>'required|string|max:50|unique:stagiaires,cin',
            'telephone'=>'required|string|max:50',
            'universite'=>'required|string|max:255',
            'filiere'=>'required|string|max:255',
            'debut_stage'=>'required|date',
            'fin_stage'=>'required|date|after:debut_stage',
            'message'=>'nullable|string',
            'sujet_rapport'=>'nullable|string|max:500',
            'cv'=>'required|mimes:pdf|max:2048',
            'motivation_letter'=>'required|mimes:pdf|max:2048',
            'cni_copy'=>'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'insurance_certificate'=>'required|mimes:pdf|max:2048',
            'signed_convention'=>'required|mimes:pdf|max:2048',
        ]);

        $data = $request->except(['cv','motivation_letter','cni_copy','insurance_certificate','signed_convention']);
        $data['status'] = 'pending';
        $data['dossier_number'] = 'ST-'.date('Y').'-'.strtoupper(bin2hex(random_bytes(3)));
        $data['sujet_rapport'] = $data['sujet_rapport'] ?? '';

        $fileFields = ['cv','motivation_letter','cni_copy','insurance_certificate','signed_convention'];
        foreach($fileFields as $field){
            if($request->hasFile($field)){
                $data[$field.'_path'] = $request->file($field)->store('applications/'.$field,'public');
            }
        }

        $stagiaire = Stagiaire::create($data);

        try {
            \Mail::to($stagiaire->email)->send(new \App\Mail\ApplicationSubmitted($stagiaire));
        } catch (\Exception $e) {
            \Log::error('Mail error: '.$e->getMessage());
        }

        return redirect()->route('public.track')
            ->with('success','Votre demande a été soumise. Votre numéro de dossier: '.$stagiaire->dossier_number);
    }

    public function track()
    {
        return view('public.track');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'dossier_number'=>'required|string',
        ]);

        $stagiaire = Stagiaire::where('email',$request->email)
            ->where('dossier_number',$request->dossier_number)
            ->first();

        if(!$stagiaire){
            return back()->withErrors(['error'=>'Aucun dossier trouvé'])->withInput();
        }

        return view('public.status', compact('stagiaire'));
    }

    public function publicShowDownload($id,$dossier_number)
    {
        $stagiaire = Stagiaire::where('id',$id)
            ->where('dossier_number',$dossier_number)
            ->firstOrFail();

        if($stagiaire->status !== 'accepted' || !$stagiaire->attestation_path || !Storage::disk('public')->exists($stagiaire->attestation_path)){
            abort(404,'Attestation non disponible');
        }

        return view('public.download-attestation', compact('stagiaire'));
    }

    public function publicDownloadFile($id,$dossier_number)
    {
        $stagiaire = Stagiaire::where('id',$id)
            ->where('dossier_number',$dossier_number)
            ->firstOrFail();

        if($stagiaire->status !== 'accepted' || !$stagiaire->attestation_path || !Storage::disk('public')->exists($stagiaire->attestation_path)){
            abort(404,'Fichier non trouvé');
        }

        return Storage::disk('public')->download($stagiaire->attestation_path,'attestation_stage_'.$stagiaire->nom.'.pdf');
    }
    public function show($id)
    {
        $stagiaire = Stagiaire::findOrFail($id); 
        return view('stagiaires.show', compact('stagiaire')); 
    }
}