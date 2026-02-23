<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Graph data: Stagiaires ajoutés sur les 7 derniers jours
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::today()->subDays($i);
            $labels[] = $day->format('d M');
            $data[] = Stagiaire::whereDate('created_at', $day)->count();
        }

        // Total stagiaires
        $total = Stagiaire::count();
        
        // Status counts
        $pending = Stagiaire::where('status', 'pending')->count();
        $accepted = Stagiaire::where('status', 'accepted')->count();
        $rejected = Stagiaire::where('status', 'rejected')->count();

        // Complétude: on considère un stagiaire "complet" si tous les champs essentiels sont remplis
        $complets = Stagiaire::whereNotNull('prenom')
            ->whereNotNull('nom')
            ->whereNotNull('email')
            ->whereNotNull('filiere')
            ->whereNotNull('debut_stage')
            ->whereNotNull('fin_stage')
            ->count();

        $tauxCompleteness = $total > 0 ? round(($complets / $total) * 100) : 0;

        return view('dashboard', compact('labels', 'data', 'tauxCompleteness', 'total', 'pending', 'accepted', 'rejected'));
    }
}