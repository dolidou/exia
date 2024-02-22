<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EtudiantsImport;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.etudiants', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('etudiants.etudiants');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'matricule' => 'required|string|unique:etudiants,matricule',
        'promo' => 'required|string',
    ]);

   
        $etudiant = new Etudiant();
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->matricule = $request->input('matricule');
        $etudiant->promo = $request->input('promo');
        $etudiant->save();
 

    return redirect()->route('etudiant.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('etudiants.etudiants', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('etudiants.etudiants', compact('etudiant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->matricule = $request->input('matricule');
        $etudiant->promo = $request->input('promo');
        $etudiant->save();

        return redirect()->route('etudiant.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiant.index');
    }

    public function upload(Request $request)
{
    // Valider le fichier envoyé
    $request->validate([
        'file' => 'required|mimes:xls,xlsx|max:2048' // Types de fichiers autorisés : xls, xlsx, taille maximale : 2Mo
    ]);

    // Récupérer le fichier téléchargé
    $file = $request->file('file');

    // Importer les données du fichier Excel
    try {
        Excel::import(new EtudiantsImport, $file);
        return redirect()->route('etudiant.index')->with('success', 'Les étudiants ont été importés avec succès.');
    } catch (\Exception $e) {
        return redirect()->route('etudiant.index')->with('error', 'Une erreur s\'est produite lors de l\'importation des étudiants.');
    }
}
}
