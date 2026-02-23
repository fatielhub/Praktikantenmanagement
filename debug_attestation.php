<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$stagiaire = App\Models\Stagiaire::find(4);
if ($stagiaire) {
    echo "ID: " . $stagiaire->id . "\n";
    echo "Status: " . $stagiaire->status . "\n";
    
    if ($stagiaire->status === 'accepted') {
        echo "Attempting to generate certificate...\n";
        try {
            $pdf = Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.attestation', compact('stagiaire'));
            $filename = 'attestations/attestation_'.$stagiaire->id.'_'.time().'.pdf';
            Illuminate\Support\Facades\Storage::disk('public')->put($filename, $pdf->output());
            $stagiaire->update(['attestation_path'=>$filename]);
            echo "Success! New path: " . $filename . "\n";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}

