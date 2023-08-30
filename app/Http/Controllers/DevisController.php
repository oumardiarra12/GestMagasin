<?php

namespace App\Http\Controllers;

use App\Http\Requests\Devis\StoreDevisRequest;
use App\Http\Requests\Devis\UpdateDevisRequest;
use App\Http\Requests\Vente\StoreVenteRequest;
use App\Models\Client;
use App\Models\Devis;
use App\Models\LigneDevis;
use App\Models\LigneVente;
use App\Models\Produit;
use App\Models\Societe;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devis=Devis::all();
        $clients=Client::all();
        return view('pages.devis.index',compact('devis','clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients=Client::all();
        return view('pages.devis.create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDevisRequest $request)
    {
        $devis = new Devis();
        $devis->date_devis = $request->date_devis;
        $devis->total_devis = $request->total_devis;
        $devis->description_devis = $request->description_devis;
        $devis->client_id = $request->client_id;
        $devis->user_id = Auth::user()->id;
        $devis->save();
        foreach ($request->produit_id as $key => $produit_id) {
            $lignedevis = new LigneDevis();
            $lignedevis->produit_id = $request->produit_id[$key];
            $lignedevis->quantite_lignedevis = $request->quantite_lignedevis[$key];
            $lignedevis->prixvente_lignedevis = $request->prixvente_lignedevis[$key];
            $lignedevis->soustotal_lignedevis = $request->soustotal_lignedevis[$key];
            $lignedevis->devis_id = $devis->id;
            $lignedevis->save();
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
        $devis=Devis::findOrFail($id);
        $lignedevis=LigneDevis::where("devis_id",$id)->get();
        $societe = Societe::first();
        return view('pages.devis.show',compact('devis','lignedevis','societe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $devis=Devis::findOrFail($id);
        $lignedevis=LigneDevis::where("devis_id",$id)->get();
        $clients=Client::all();
        return view('pages.devis.edit',compact('devis','lignedevis','clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDevisRequest $request,$id)
    {
        $devis=Devis::findOrFail($id);
        $lignedevis=LigneDevis::where("devis_id",$id)->get();
        $devis->date_devis = $request->date_devis;
        $devis->total_devis = $request->total_devis;
        $devis->description_devis = $request->description_devis;
        $devis->client_id = $request->client_id;
        $devis->user_id = Auth::user()->id;
        LigneDevis::where("devis_id",$id)->delete();
        foreach ($request->produit_id as $key => $produit_id) {
            $lignedevis = new LigneDevis();
            $lignedevis->produit_id = $request->produit_id[$key];
            $lignedevis->quantite_lignedevis = $request->quantite_lignedevis[$key];
            $lignedevis->prixvente_lignedevis = $request->prixvente_lignedevis[$key];
            $lignedevis->soustotal_lignedevis = $request->soustotal_lignedevis[$key];
            $lignedevis->devis_id = $devis->id;
            $lignedevis->save();
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
            $devis = Devis::findOrFail($id);
            LigneDevis::where("devis_id", $id)->delete();
            $devis->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();
        } catch (\Throwable $th) {


        }
    }
    public function RechercheProduit(Request $request)
    {
        $search = $request->search;
        $result = Produit::where('nom_produit', 'LIKE', '%' . $search . '%')
            ->orWhere('codebarre', 'like', '%' . $search . '%')->get();
        $response = array();
        foreach ($result as $r) {
            $response[] = array("value" => $r->id, "label" => $r->nom_produit, 'prix' => $r->prixvente_produit);
        }
        echo json_encode($response);
        exit;
    }
    public function devispdf()
    {
        $devis = Devis::all();
        view()->share('devispdf', $devis);
        $pdf = PDF::loadView('pages.devis.devispdf', compact('devis'))->setPaper('a4', 'landscape');
        return $pdf->download('devis.pdf');
    }
    public function pdflignedevis($id)
    {
        $devis=Devis::findOrFail($id);
        $societe = Societe::first();
        $lignedevis = LigneDevis::where("devis_id", $id)->get();
        $data = [
            'devis' => $devis,
            'societe' => $societe,
            'lignedevis' => $lignedevis,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.devis.devisinvoicepdf', $data)->setPaper('a4');

        return $pdf->download('devis.pdf');
    }
    public function createvente($id){
        $devis=Devis::findOrFail($id);
        $lignedevis = LigneDevis::where("devis_id", $id)->get();
        return view('pages.vente.createvente',compact('devis','lignedevis'));
    }
    public function storevente(StoreVenteRequest $request){
        $vente = new Vente();
        $vente->date_vente = $request->date_vente;
        $vente->total_vente = $request->total_vente;
        $vente->description_vente = $request->description_vente;
        $vente->client_id = $request->client_id;
        $vente->user_id = Auth::user()->id;
        $vente->save();
        foreach ($request->produit_id as $key => $produit_id) {
            $lignevente = new LigneVente();
            $lignevente->produit_id = $request->produit_id[$key];
            $lignevente->quantite_lignevente = $request->quantite_lignevente[$key];
            $lignevente->prixvente_lignevente = $request->prixvente_lignevente[$key];
            $lignevente->soustotal_lignevente = $request->soustotal_lignevente[$key];
            $lignevente->vente_id = $vente->id;
            $lignevente->save();
            Produit::where('id', $request->produit_id[$key])->decrement('stockactuel', $request->quantite_lignevente[$key]);
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
}
