<?php

namespace App\Http\Controllers;

use App\Exports\ExportFournisseurs;
use App\Http\Requests\Fournisseur\StoreFournisseurRequest;
use App\Http\Requests\Fournisseur\UpdateFournisseurRequest;
use App\Imports\ImportFournisseurs;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
use Excel;
class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs=Fournisseur::all();
        return view('pages.fournisseur.index',compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.fournisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFournisseurRequest $request)
    {
        Fournisseur::create($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $fournisseur = Fournisseur::findOrFail($id);
    //  return response()->json(array('fournisseur' => $fournisseur));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return response()->json(array('fournisseur' => $fournisseur));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFournisseurRequest $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->nom_fournisseur = $request->nom_fournisseur;
        $fournisseur->prenom_fournisseur = $request->prenom_fournisseur;
        $fournisseur->email_fournisseur = $request->email_fournisseur;
        $fournisseur->tel_fournisseur = $request->tel_fournisseur;
        $fournisseur->adresse_fournisseur = $request->adresse_fournisseur;
        $fournisseur->description_fournisseur	 = $request->description_fournisseur	;
        $fournisseur->save();
        return response()->json(['success' => 'Fournisseur saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $fournisseur = Fournisseur::findOrFail($id);
            $fournisseur->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Fournisseur ne peut pas etre supprimer car il est lie a un  achat.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function importfournisseur()
    {
        return view('pages.fournisseur.importfournisseur');
    }
    public function importstorefournisseur(Request $request)
    {
        $validated = $request->validate([
            'filefournisseur' => 'required',
        ]);
        Excel::import(new ImportFournisseurs, request()->file('filefournisseur'));
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function exportfournisseur()
    {
        return Excel::download(new ExportFournisseurs, 'fournisseurs.xlsx');
    }
    public function fournisseurpdf()
    {
        $fournisseurs = Fournisseur::all();
        view()->share('fournisseurpdf', $fournisseurs);
        $pdf = PDF::loadView('pages.fournisseur.fournisseurpdf', compact('fournisseurs'))->setPaper('a4', 'landscape');
        return $pdf->download('fournisseurs.pdf');
    }
}
