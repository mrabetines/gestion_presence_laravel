<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::table('Niveau')->insert([
            'nom' => 'premier niveau',
        ]);
         DB::table('Etudiant')->insert([
            'nom' => 'mrabet',
            'prenom' => 'ines',
            'CIN' => '09191681',
            'email' => 'mrabet.ines.858@gmail.com',
            'id_Niveau' => 1,
            'qr_code' => '0000000117',
            'active' => true,
            'carte_Etudiant' =>'1300282', 
        ]);*/
        DB::table('Etudiant')->insert([
            'nom' => 'ayari',
            'prenom' => 'sameh',
            'CIN' => '09191682',
            'email' => 'ayari.sameh.858@gmail.com',
            'id_Niveau' => 1,
            'qr_code' => '0000000118',
            'active' => true,
            'carte_Etudiant' => '1300283', 
        ]);
        DB::table('Session')->insert([
            'nom' => 'session',
            'date_debut' => '2017-06-24',
            'date_fin' => '2017-06-28',
            'date_publication' => '2017-06-22',
            'date_fin_inscription' => '2017-06-23', 
            'time_publication' => '11:22:10',
            'time_fin_inscription' =>'11:22:10' ,
            'id_Niveau' => 1, 
        ]);
        DB::table('Examen')->insert([
            'date' => '2017-07-24',
            'max_Places' => 20,
            'nbre_Places' => 2,
            'id_Session' => 1,   
        ]);
        DB::table('Etudiant_Examen')->insert([
            'id_Etudiant' => 1,
            'id_Examen' => 1,
        ]);
        DB::table('Beacon')->insert([
            'uuid' => 'B9407F30-F5F8-466E-AFF9-25556B57FE6D',
            'major' => 0,
            'minor' => 0,
            'id_Examen' => 1,

        ]);

        
    }
}
