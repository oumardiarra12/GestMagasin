<?php

namespace App\Http\Controllers;

use App\Http\Requests\Achat\StoreAchatRequest;
use App\Http\Requests\Achat\UpdateAchatRequest;
use App\Http\Requests\PaiementAchat\StorePaiementAchatRequest;
use App\Models\Achat;
use App\Models\Fournisseur;
use App\Models\LigneAchat;
use App\Models\Produit;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achats = Achat::all();
        $fournisseurs = Fournisseur::all();
        return view('pages.achat.index', compact('achats', 'fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('pages.achat.create', compact('fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAchatRequest $request)
    {
        $achat = new Achat();
        $achat->date_achat = $request->date_achat;
        $achat->status_achat_reception = $request->status_achat_reception;
        $achat->total_achat = $request->total_achat;
        $achat->description_achat = $request->description_achat;
        $achat->fournisseur_id = $request->fournisseur_id;
        $achat->user_id = Auth::user()->id;
        $achat->save();
        foreach ($request->produit_id as $key => $produit_id) {
            $ligneachat = new LigneAchat();
            $ligneachat->produit_id = $request->produit_id[$key];
            $ligneachat->quantite_ligneAchat = $request->quantite_ligneAchat[$key];
            $ligneachat->quantite_recu_ligneAchat = $request->quantite_recu_ligneAchat[$key];
            $ligneachat->prixachat_ligneAchat = $request->prixachat_ligneAchat[$key];
            $ligneachat->soustotal_ligneAchat = $request->soustotal_ligneAchat[$key];
            $ligneachat->achat_id = $achat->id;
            $ligneachat->save();
            Produit::where('id', $request->produit_id[$key])->increment('stockactuel', $request->quantite_recu_ligneAchat[$key]);
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $achat = Achat::with("fournisseur")->where("id", $id)->get();
        $ligneachats = LigneAchat::with("produit")->where("achat_id", $id)->get();
        $societe = Societe::first();
        return response()->json(array('achat' => $achat, 'ligneachats' => $ligneachats, 'societe' => $societe));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $achat = Achat::findOrFail($id);
        $ligneachats = LigneAchat::where("achat_id", $id)->get();
        $fournisseurs = Fournisseur::all();
        return view('pages.achat.edit', compact('achat', 'ligneachats', 'fournisseurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchatRequest $request, string $id)
    {
        $achat = Achat::findOrFail($id);
        $ligneachats = LigneAchat::where('achat_id', $id)->get();
        foreach ($ligneachats as  $ligneachat) {
            $produit = Produit::find($ligneachat->produit_id);
            $produit->decrement('stockactuel', $ligneachat->quantite_recu_ligneAchat);
        }
        $achat->date_achat = $request->date_achat;
        $achat->status_achat_reception = $request->status_achat_reception;
        $achat->total_achat = $request->total_achat;
        $achat->description_achat = $request->description_achat;
        $achat->fournisseur_id = $request->fournisseur_id;
        $achat->user_id = Auth::user()->id;
        $achat->save();
        LigneAchat::where('achat_id', $id)->delete();
        foreach ($request->produit_id as $key => $produit_id) {
            $ligneachat = new LigneAchat();
            $ligneachat->produit_id = $request->produit_id[$key];
            $ligneachat->quantite_ligneAchat = $request->quantite_ligneAchat[$key];
            $ligneachat->quantite_recu_ligneAchat = $request->quantite_recu_ligneAchat[$key];
            $ligneachat->prixachat_ligneAchat = $request->prixachat_ligneAchat[$key];
            $ligneachat->soustotal_ligneAchat = $request->soustotal_ligneAchat[$key];
            $ligneachat->achat_id = $achat->id;
            $ligneachat->save();
            Produit::where('id', $request->produit_id[$key])->increment('stockactuel', $request->quantite_recu_ligneAchat[$key]);
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifier !");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $achat = Achat::findOrFail($id);
            $ligneachats = LigneAchat::where("achat_id", $id)->get();
            foreach ($ligneachats as  $ligneachat) {
                $product = Produit::find($ligneachat->produit_id);
                $product->decrement('stockactuel', $ligneachat->quantite_recu_ligneAchat);
            }
            LigneAchat::where("achat_id", $id)->delete();
            $achat->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Commande Achat ne peut pas etre supprimer car il est receptionne.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function achatpdf()
    {
        $achats = Achat::all();
        view()->share('achatpdf', $achats);
        $pdf = PDF::loadView('pages.achat.achatpdf', compact('achats'))->setPaper('a4', 'landscape');
        return $pdf->download('achat.pdf');
    }
    public function RechercheProduit(Request $request)
    {
        $search = $request->search;
        $result = Produit::where('nom_produit', 'LIKE', '%' . $search . '%')
            ->orWhere('codebarre', 'like', '%' . $search . '%')->get();
        $response = array();
        foreach ($result as $r) {
            $response[] = array("value" => $r->id, "label" => $r->nom_produit, 'prix' => $r->prixachat_produit);
        }
        echo json_encode($response);
        exit;
    }
    public function pdfligneachat($id)
    {
        $achat = Achat::findOrFail($id);
        $societe = Societe::first();
        $ligneachats = LigneAchat::where('achat_id', $id)->get();
        $data = [
            'achat' => $achat,
            'societe' => $societe,
            'ligneachats' => $ligneachats,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.achat.achatinvoicepdf', $data)->setPaper('a4');

        return $pdf->download('achat.pdf');
    }
    public function createpaiement($id){
        $achat=Achat::findOrFail($id);
        $sumtotalpayer=$achat->paiementachats->sum("total_payer");
        $restetotalpayer=$achat->total_achat-$sumtotalpayer;
        return response()->json(['achat'=>$achat,'restetotalpayer'=>$restetotalpayer]);
    }
    public function retourachatcreate($id){
        $achat = Achat::findOrFail($id);
        $ligneachats = LigneAchat::where('achat_id', $id)->get();
        return view('pages.retournachat.create',compact('achat','ligneachats'));
    }


}
