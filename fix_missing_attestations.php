<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$stagiaires = App\Models\Stagiaire::where('status', 'accepted')->whereNull('attestation_path')->orWhere('attestation_path', '')->get();

echo "Found " . $stagiaires->count() . " accepted stagiaires without attestation path.\n";

foreach ($stagiaires as $s) {
    if ($s->status !== 'accepted') continue;
    echo "Processing ID: " . $s->id . " - " . $s->nom . "\n";
    try {
        $stagiaire = $s;
        $pdf = Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.attestation', compact('stagiaire'));
        $filename = 'attestations/attestation_'.$s->id.'_'.time().'.pdf';
        Illuminate\Support\Facades\Storage::disk('public')->put($filename, $pdf->output());
        $s->update(['attestation_path'=>$filename]);
        echo "  - Generated: " . $filename . "\n";
    } catch (\Exception $e) {
        echo "  - Error: " . $e->getMessage() . "\n";
    }
}
