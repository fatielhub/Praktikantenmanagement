<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class StagiairesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stagiaires')->insert([
            [
                'user_id'=>1,
                'nom'=>'El-Atmani',
                'prenom'=>'Fatima Azzahra',
                'cin'=>'AB123456',
                'telephone'=>'0661122334',
                'email'=>'fatima@example.com',
                'date_naissance'=>'2006-07-15',
                'niveau_etude'=>'Bac+2',
                'filiere'=>'Informatique',
                'sujet_rapport'=>'Gestion Stagiaire Laravel',
                'encadrant_faculte_id'=>1,
                'encadrant_secondaire'=>'M. Ahmed – OFPPT',
                'service_id'=>1,
                'debut_stage'=>'2026-03-01',
                'fin_stage'=>'2026-06-30',
                'attestation_status'=>'not_generated',
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ],
        ]);
    }
}
