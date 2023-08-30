<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Vente\StoreComptoirRequest;
use App\Http\Requests\Vente\StoreVenteRequest;
use App\Http\Requests\Vente\UpdateVenteRequest;
use App\Models\Client;
use App\Models\Famille;
use App\Models\LigneVente;
use App\Models\PaiementVente;
use App\Models\Produit;
use App\Models\Societe;
use App\Models\Vente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventes = Vente::all();
        $clients = Client::all();
        return view('pages.vente.index', compact('ventes', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('pages.vente.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenteRequest $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vente = Vente::with("client")->where("id", $id)->get();
        $ligneventes = LigneVente::with("produit")->where("vente_id", $id)->get();
        $societe = Societe::first();
        return response()->json(array('vente' => $vente, 'ligneventes' => $ligneventes, 'societe' => $societe));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vente=Vente::findOrFail($id);
        $ligneventes=LigneVente::with("produit")->where("vente_id", $id)->get();
        $clients=Client::all();
        return view('pages.vente.edit', compact('vente', 'ligneventes', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenteRequest $request, string $id)
    {
        $vente = Vente::findOrFail($id);
        $ligneventes = LigneVente::with("produit")->where("vente_id", $id)->get();
        foreach ($ligneventes as  $lignevente) {
            $produit = Produit::find($lignevente->produit_id);
            $produit->increment('stockactuel', $lignevente->quantite_lignevente);
        }
        $vente->date_vente = $request->date_vente;
        $vente->total_vente = $request->total_vente;
        $vente->description_vente = $request->description_vente;
        $vente->client_id = $request->client_id;
        $vente->user_id = Auth::user()->id;
        $vente->save();
        LigneVente::where('vente_id', $id)->delete();
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
        Session::flash('notification.message', "L'élément a été bien modifier !");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vente = Vente::findOrFail($id);
            $ligneventes = LigneVente::with("produit")->where("vente_id", $id)->get();
            foreach ($ligneventes as  $lignevente) {
                $produit = Produit::find($lignevente->produit_id);
                $produit->increment('stockactuel', $lignevente->quantite_lignevente);
            }
            LigneVente::where("vente_id", $id)->delete();
            $vente->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Vente ne peut pas etre supprimer car il est a un Retour.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
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
    public function ventepdf()
    {
        $ventes = Vente::all();
        view()->share('ventepdf', $ventes);
        $pdf = PDF::loadView('pages.vente.ventepdf', compact('ventes'))->setPaper('a4', 'landscape');
        return $pdf->download('vente.pdf');
    }
    public function createpaiement($id){
        $vente=Vente::findOrFail($id);
        $sumtotalpayer=$vente->paiementventes->sum("total_payer");
        $restetotalpayer=$vente->total_vente-$sumtotalpayer;
        return response()->json(['vente'=>$vente,'restetotalpayer'=>$restetotalpayer]);
    }
    public function pdflignevente($id)
    {
        $vente=Vente::findOrFail($id);
        $societe = Societe::first();
        $ligneventes = LigneVente::with("produit")->where("vente_id", $id)->get();
        $data = [
            'vente' => $vente,
            'societe' => $societe,
            'ligneventes' => $ligneventes,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.vente.venteinvoicepdf', $data)->setPaper('a4');

        return $pdf->download('vente.pdf');
    }
    public function retourventecreate($id){
        $vente = Vente::findOrFail($id);
        $ligneventes = LigneVente::where('vente_id', $id)->get();
        return view('pages.retournvente.create',compact('vente','ligneventes'));
    }
    public function createcomptoir(){
        $clients=Client::all();
        $familles = Famille::all();
        $ventes=Vente::where("user_id",Auth::user()->id)->get();
        return view('pages.vente.comptoir',compact('clients','familles','ventes'));
    }
    public function storecomptoir(StoreComptoirRequest $request){
        $vente = new Vente();
        // $vente->date_vente = $request->date_vente;
        $vente->total_vente = $request->total_vente;
        $vente->status_vente_paiement="payer";
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
        PaiementVente::create([
            'vente_id' => $vente->id,
            'total_vente' => $request->total_vente,
            'total_payer' => $request->total_vente,
            'total_reste' => 0,
            //'date_paiement_vente' => $request->date_paiement_vente,
            'description_paiement' => 'comptoir',
            'user_id' => Auth::user()->id
        ]);
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function storeclient(StoreClientRequest $request){
        Client::create($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function pdfcomptoir($id){
        $vente=Vente::findOrFail($id);
        $societe = Societe::first();
        $ligneventes = LigneVente::where("vente_id", $id)->get();
        $data = [
            'vente' => $vente,
            'societe' => $societe,
            'ligneventes' => $ligneventes,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.vente.tiket', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('ticke.pdf');

    }
    public function venterecentpdf()
    {
        $ventes = Vente::all();
        view()->share('venterecentpdf', $ventes);
        $pdf = PDF::loadView('pages.vente.venterecentpdf', compact('ventes'))->setPaper('a4', 'landscape');
        return $pdf->download('venterecentpdf.pdf');
    }
    public function mesvente(){
        $mesventes=Vente::where("user_id",Auth::user()->id)->whereBetween('date_vente',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
    )->get();
    $clients=Client::all();
    return view('pages.vente.mesventes',compact('mesventes','clients'));
    }
    public function mesventespdf(){
        $ventes = Vente::where("user_id",Auth::user()->id)->whereBetween('date_vente',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
    )->get();
        view()->share('mesventespdf', $ventes);
        $pdf = PDF::loadView('pages.vente.mesventespdf', compact('ventes'))->setPaper('a4', 'landscape');
        return $pdf->download('mesventespdf.pdf');
    }

}
