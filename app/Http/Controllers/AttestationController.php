<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateAttestationRequest;
use App\Mail\AttestationReadyMail;
use App\Models\Attestation;
use App\Models\Stagiaire;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AttestationController extends Controller
{
    public function index(Request $request): View
    {
        $acceptedStagiaires = Stagiaire::where('status', 'accepted')
            ->orderBy('nom')
            ->get();

        $attestations = Attestation::with('stagiaire')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('attestations.index', compact('acceptedStagiaires', 'attestations'));
    }

    /**
     * Generate attestation PDF for an accepted stagiaire (admin only).
     */
    public function generate(GenerateAttestationRequest $request): RedirectResponse
    {
        $stagiaire = Stagiaire::where('status', 'accepted')->findOrFail($request->validated('stagiaire_id'));

        $numero = Attestation::generateNumero();
        $dateDebut = $stagiaire->debut_stage;
        $dateFin = $stagiaire->fin_stage;

        $dir = 'attestations';
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        $filename = $dir . '/attestation_' . $stagiaire->id . '_' . $numero . '_' . time() . '.pdf';
        $attestation = new Attestation([
            'stagiaire_id' => $stagiaire->id,
            'numero_attestation' => $numero,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'pdf_path' => $filename,
        ]);

        $logoPath = public_path('faculte.jpg');
        if (!is_file($logoPath)) {
            $logoPath = null;
        }

        $pdf = Pdf::loadView('attestations.pdf', [
            'stagiaire' => $stagiaire,
            'attestation' => $attestation,
            'logoPath' => $logoPath,
        ]);
        $pdf->setPaper('A4', 'portrait');

        Storage::disk('public')->put($filename, $pdf->output());
        $attestation->save();

        $attestation->load('stagiaire');
        $email = $stagiaire->email;
        if ($email) {
            try {
                Mail::to($email)->send(new AttestationReadyMail($attestation));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()
            ->route('attestations.index')
            ->with('success', 'Attestation générée avec succès. Un email avec la pièce jointe PDF a été envoyé au stagiaire.');
    }

    /**
     * Download attestation PDF (auth: user must be admin or the stagiaire).
     */
    public function download(Request $request, int $id)
    {
        $attestation = Attestation::with('stagiaire')->findOrFail($id);
        $user = $request->user();

        if ($user->role === 'admin') {
            // admin can download any
        } elseif ($attestation->stagiaire->user_id && (int) $attestation->stagiaire->user_id === (int) $user->id) {
            // stagiaire can download own
        } else {
            abort(403);
        }

        if (!Storage::disk('public')->exists($attestation->pdf_path)) {
            abort(404, 'Fichier attestation introuvable.');
        }

        $name = 'attestation_' . $attestation->stagiaire->nom . '_' . $attestation->stagiaire->prenom . '_' . $attestation->numero_attestation . '.pdf';

        return Storage::disk('public')->download($attestation->pdf_path, $name);
    }

    /**
     * View attestation inline in browser (auth: admin or stagiaire).
     */
    public function view(Request $request, int $id)
    {
        $attestation = Attestation::with('stagiaire')->findOrFail($id);
        $user = $request->user();

        if ($user->role === 'admin') {
            // ok
        } elseif ($attestation->stagiaire->user_id && (int) $attestation->stagiaire->user_id === (int) $user->id) {
            // ok
        } else {
            abort(403);
        }

        if (!Storage::disk('public')->exists($attestation->pdf_path)) {
            abort(404, 'Fichier attestation introuvable.');
        }

        $path = Storage::disk('public')->path($attestation->pdf_path);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="attestation_' . $attestation->numero_attestation . '.pdf"',
        ]);
    }
}
