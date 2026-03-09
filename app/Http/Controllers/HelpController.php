<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display the help page with FAQ and user guide.
     */
    public function index()
    {
        $faqs = [
            [
                'category' => 'Général',
                'questions' => [
                    [
                        'q' => 'Comment prendre un rendez-vous ?',
                        'a' => 'Allez dans la section "Agenda", cliquez sur le bouton "Nouveau RDV", remplissez les informations du patient et choisissez un créneau horaire disponible.'
                    ],
                    [
                        'q' => 'Comment ajouter un nouveau patient ?',
                        'a' => 'Cliquez sur "Patients" dans la barre latérale, puis sur le bouton "Ajouter Patient". Remplissez le formulaire avec les coordonnées et les antécédents médicaux.'
                    ]
                ]
            ],
            [
                'category' => 'Gestion',
                'questions' => [
                    [
                        'q' => 'Comment imprimer une ordonnance ?',
                        'a' => 'Dans la section "Ordonnances", choisissez l\'ordonnance souhaitée et cliquez sur l\'icône d\'imprimante. Une fenêtre de prévisualisation s\'ouvrira.'
                    ],
                    [
                        'q' => 'Puis-je modifier le profil de mon cabinet ?',
                        'a' => 'Oui, allez dans "Configuration" dans le menu des paramètres pour modifier les coordonnées, les horaires et les préférences de notification.'
                    ]
                ]
            ],
            [
                'category' => 'Sécurité',
                'questions' => [
                    [
                        'q' => 'Comment changer mon mot de passe ?',
                        'a' => 'Dans la section "Configuration", onglet "Sécurité", vous pouvez définir un nouveau mot de passe après avoir saisi votre mot de passe actuel.'
                    ]
                ]
            ]
        ];

        return view('help.index', compact('faqs'));
    }
}
