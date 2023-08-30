<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetourVente\StoreRetourVenteRequest;
use App\Http\Requests\RetourVente\UpdateRetourVenteRequest;
use App\Models\Produit;
use App\Models\RetourLigneVente;
use App\Models\RetourVente;
use App\Models\Societe;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class RetourVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venteretours=RetourVente::all();
        return view('pages.retournvente.index',compact('venteretours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRetourVenteRequest $request,$id)
    {
        $vente=Vente::findOrFail($id);
        $venteretour = new RetourVente();
        $venteretour->date_retourvente = $request->date_retourvente;
        $venteretour->total_retourvente = $request->total_retourvente;
        $venteretour->description_retourvente = $request->description_retourvente;
        $venteretour->vente_id=$vente->id;
        $venteretour->user_id = Auth::user()->id;
        $venteretour->save();
        foreach ($request->produit_id as $key => $produit_id) {
            $ligneventeretour = new RetourLigneVente();
            $ligneventeretour->produit_id = $request->produit_id[$key];
            $ligneventeretour->quantite_ligneretourvente = $request->quantite_ligneretourvente[$key];
            $ligneventeretour->prixvente_ligneretourvente = $request->prixvente_ligneretourvente[$key];
            $ligneventeretour->soustotal_ligneretourvente = $request->soustotal_ligneretourvente[$key];
            $ligneventeretour->retour_vente_id = $venteretour->id;
            $ligneventeretour->save();
            Produit::where('id', $request->produit_id[$key])->increment('stockactuel', $request->quantite_ligneretourvente[$key]);
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
        $venteretour=RetourVente::findOrFail($id);
        $ligneventeretours=RetourLigneVente::where("retour_vente_id",$id)->get();
        $societe=Societe::first();
        return view('pages.retournvente.show',compact('venteretour','societe','ligneventeretours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venteretour=RetourVente::findOrFail($id);
        $ligneventeretours=RetourLigneVente::where("retour_vente_id",$id)->get();
        return view('pages.retournvente.edit',compact('venteretour','ligneventeretours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRetourVenteRequest $request, string $id)
    {
        $venteretour=RetourVente::findOrFail($id);
        $ligneventeretours=RetourLigneVente::where("retour_vente_id",$id)->get();
        foreach ($ligneventeretours as   $ligneventeretour) {
            $produit = Produit::find($ligneventeretour->produit_id);
            $produit->decrement('stockactuel', $ligneventeretour->quantite_ligneretourvente);
        }
        $venteretour->date_retourvente = $request->date_retourvente;
        $venteretour->total_retourvente = $request->total_retourvente;
        $venteretour->description_retourvente = $request->description_retourvente;
        $venteretour->user_id = Auth::user()->id;
        $venteretour->save();
        RetourLigneVente::where("retour_vente_id",$id)->delete();
        foreach ($request->produit_id as $key => $produit_id) {
            $ligneventeretour = new RetourLigneVente();
            $ligneventeretour->produit_id = $request->produit_id[$key];
            $ligneventeretour->quantite_ligneretourvente = $request->quantite_ligneretourvente[$key];
            $ligneventeretour->prixvente_ligneretourvente = $request->prixvente_ligneretourvente[$key];
            $ligneventeretour->soustotal_ligneretourvente = $request->soustotal_ligneretourvente[$key];
            $ligneventeretour->retour_vente_id = $venteretour->id;
            $ligneventeretour->save();
            Produit::where('id', $request->produit_id[$key])->increment('stockactuel', $request->quantite_ligneretourvente[$key]);
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
            $venteretour=RetourVente::findOrFail($id);
        $ligneventeretours=RetourLigneVente::where("retour_vente_id",$id)->get();
        foreach ($ligneventeretours as   $ligneventeretour) {
            $produit = Produit::find($ligneventeretour->produit_id);
            $produit->decrement('stockactuel', $ligneventeretour->quantite_ligneretourvente);
        }
        RetourLigneVente::where("retour_vente_id",$id)->delete();
        $venteretour->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Vente ne peut pas etre supprimer car il a vente.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdfligneventeretour($id)
    {

        $societe = Societe::first();
        $venteretour = RetourVente::findOrFail($id);
        $ligneventeretours=RetourLigneVente::where("retour_vente_id",$id)->get();
        $data = [
            'venteretour' => $venteretour,
            'societe' => $societe,
            'ligneventeretours' => $ligneventeretours,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.retournvente.venteretourinvoice', $data)->setPaper('a4');

        return $pdf->download('venteretour.pdf');
    }
    public function venteretourpdf()
    {
        $venteretours = RetourVente::all();
        view()->share('venteretours',  $venteretours);
        $pdf = PDF::loadView('pages.retournvente.tableretourventepdf', compact('venteretours'))->setPaper('a4', 'landscape');
        return $pdf->download('retourventepdf.pdf');
    }
}
