<?php

namespace App\Http\Controllers;

use App\Exports\ExportProduits;
use App\Http\Requests\Produit\StoreProduitRequest;
use App\Http\Requests\Produit\UpdateProduitRequest;
use App\Imports\ImportProduits;
use App\Models\Famille;
use App\Models\Produit;
use App\Models\Unite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Excel;
use PDF;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        $familles = Famille::all();
        $unites = Unite::all();
        return view('pages.produit.index', compact('produits', 'familles', 'unites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $familles = Famille::all();
        $unites = Unite::all();
        return view('pages.produit.create', compact('familles', 'unites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        Produit::create([
            'codebarre' => $request->codebarre,
            'nom_produit' => $request->nom_produit,
            'stockmin' => $request->stockmin,
            'prixvente_produit' => $request->prixvente_produit,
            'prixachat_produit' => $request->prixachat_produit,
            'description_produit' => $request->description_produit,
            'famille_id' => $request->famille_id,
            'unite_id' => $request->unite_id,
            'user_id' => Auth::user()->id
        ]);
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produit = Produit::with('famille', 'unite', 'user')->where("id", $id)->get();
        return response()->json(array('produit' => $produit));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $familles = Famille::all();
        $unites = Unite::all();
        return response()->json(array('produit' => $produit, 'familles' => $familles, 'unites' => $unites));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->codebarre = $request->codebarre;
        $produit->ref_produit = $request->ref_produit;
        $produit->nom_produit = $request->nom_produit;
        $produit->stockmin = $request->stockmin;
        $produit->stockactuel = $request->stockactuel;
        $produit->prixvente_produit = $request->prixvente_produit;
        $produit->prixachat_produit = $request->prixachat_produit;
        $produit->description_produit = $request->description_produit;
        $produit->famille_id = $request->famille_id;
        $produit->unite_id = $request->unite_id;
        $produit->save();
        return response()->json(['success' => 'Produit saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $produit = Produit::findOrFail($id);
            $produit->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Produit ne peut pas etre supprimer car il est lie a un vente ou achat.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function importproduit()
    {
        return view('pages.produit.importproduit');
    }
    public function importstoreproduit(Request $request)
    {
        $validated = $request->validate([
            'fileproduit' => 'required',
        ]);
        Excel::import(new ImportProduits, request()->file('fileproduit'));
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function exportproduit()
    {
        return Excel::download(new ExportProduits, 'produits.xlsx');
    }
    public function produitpdf()
    {
        $produits = Produit::all();
        view()->share('produitpdf', $produits);
        $pdf = PDF::loadView('pages.produit.produitpdf', compact('produits'))->setPaper('a4', 'landscape');
        return $pdf->download('produit.pdf');
    }
    public function generecodebarre(){
        $produits=Produit::all();
        return view('pages.produit.codebarre',compact('produits'));
    }
    public function genererpdfcodebarre(){
        $produits=Produit::all();
        $data = [
            'produits' => $produits
        ];

        $pdf = PDF::loadView('pages.produit.pdfcodebarre', $data)->setPaper('a4', 'landscape');

        return $pdf->download('produits.pdf');
    }
}
