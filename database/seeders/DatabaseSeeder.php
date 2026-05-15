<?php

namespace Database\Seeders;

use App\Models\Famille;
use App\Models\Prompt;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Familles
        $familles = [
            ['titre' => 'Rédaction',      'type' => 'Texte'],
            ['titre' => 'Programmation',  'type' => 'Code'],
            ['titre' => 'Marketing',      'type' => 'Texte'],
            ['titre' => 'Analyse',        'type' => 'Données'],
            ['titre' => 'Traduction',     'type' => 'Langue'],
        ];

        foreach ($familles as $data) {
            Famille::firstOrCreate(['titre' => $data['titre']], $data);
        }

        // Prompts d'exemple
        $prompts = [
            [
                'titre'       => 'Rédaction d\'email professionnel',
                'description' => 'Génère un email professionnel formel adapté au contexte donné.',
                'prompt_text' => "Rédige un email professionnel en français pour [DESTINATAIRE] concernant [SUJET].\nTon : formel et courtois.\nLongueur : 150-200 mots.\nInclure : objet, corps, formule de politesse.",
                'famille_id'  => Famille::where('titre', 'Rédaction')->first()->id,
            ],
            [
                'titre'       => 'Revue de code PHP',
                'description' => 'Analyse un extrait de code PHP et propose des améliorations.',
                'prompt_text' => "Analyse le code PHP suivant et fournis :\n1. Les problèmes de sécurité détectés\n2. Les améliorations de performance possibles\n3. Les bonnes pratiques non respectées\n4. Une version corrigée du code\n\nCode à analyser :\n[CODE]",
                'famille_id'  => Famille::where('titre', 'Programmation')->first()->id,
            ],
            [
                'titre'       => 'Description produit e-commerce',
                'description' => 'Crée une description produit optimisée SEO pour une boutique en ligne.',
                'prompt_text' => "Rédige une description produit pour [NOM_PRODUIT] destinée à une boutique e-commerce.\nCaractéristiques : [CARACTERISTIQUES]\nPublic cible : [CIBLE]\nInclure : accroche, bénéfices, appel à l'action.\nOptimisé SEO avec le mot-clé principal : [MOT_CLE]",
                'famille_id'  => Famille::where('titre', 'Marketing')->first()->id,
            ],
        ];

        foreach ($prompts as $data) {
            Prompt::firstOrCreate(['titre' => $data['titre']], $data);
        }
    }
}
