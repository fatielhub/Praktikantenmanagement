<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stagiaire;

class AccueilController extends Controller
{
    public function index()
    {
        // Stats dynamiques
        $totalStagiaires = Stagiaire::count();
        $acceptedStagiaires = Stagiaire::where('status', 'accepted')->count();
        $refusedStagiaires = Stagiaire::where('status', 'refused')->count();

        return view('accueil', compact(
            'totalStagiaires',
            'acceptedStagiaires',
            'refusedStagiaires'
        ));
    }
}
