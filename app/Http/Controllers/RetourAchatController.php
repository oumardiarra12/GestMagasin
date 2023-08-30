<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetourAchat\StoreRetourAchatRequest;
use App\Http\Requests\RetourAchat\UpdateRetourAchatRequest;
use App\Models\Achat;
use App\Models\LigneRetourAchat;
use App\Models\Produit;
use App\Models\RetourAchat;
use App\Models\RetourLigneAchat;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class RetourAchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achatretours=RetourAchat::all();
        return view('pages.retournachat.index',compact('achatretours'));
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
    public function store(StoreRetourAchatRequest $request,$id)
    {
        $achat=Achat::findOrFail($id);
        $achatretour = new RetourAchat();
        $achatretour->date_retour_achat = $request->date_retour_achat;
        $achatretour->total_retour_achat = $request->total_retour_achat;
        $achatretour->description_retour_achat = $request->description_retour_achat;
        $achatretour->achat_id=$achat->id;
        $achatretour->user_id = Auth::user()->id;
        $achatretour->save();
        foreach ($request->produit_id as $key => $produit_id) {
            $ligneachatretour = new LigneRetourAchat();
            $ligneachatretour->produit_id = $request->produit_id[$key];
            $ligneachatretour->quantite_retourligneAchat = $request->quantite_retourligneAchat[$key];
            $ligneachatretour->prixachat_retourligneAchat = $request->prixachat_retourligneAchat[$key];
            $ligneachatretour->soustotal_retourligneAchat = $request->soustotal_retourligneAchat[$key];
            $ligneachatretour->retour_achat_id = $achatretour->id;
            $ligneachatretour->save();
            Produit::where('id', $request->produit_id[$key])->decrement('stockactuel', $request->quantite_retourligneAchat[$key]);
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
        $achatretour=RetourAchat::findOrFail($id);
        $ligneachatretours=LigneRetourAchat::where("retour_achat_id",$id)->get();
        $societe=Societe::first();
        return view('pages.retournachat.show',compact('achatretour','societe','ligneachatretours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $achatretour=RetourAchat::findOrFail($id);
        $ligneachatretours=LigneRetourAchat::where("retour_achat_id",$id)->get();
        return view('pages.retournachat.edit',compact('achatretour','ligneachatretours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRetourAchatRequest $request, string $id)
    {
        $achatretour = RetourAchat::findOrFail($id);
        $ligneachatretours=LigneRetourAchat::where("retour_achat_id",$id)->get();
        foreach ($ligneachatretours as   $ligneachatretour) {
            $produit = Produit::find($ligneachatretour->produit_id);
            $produit->increment('stockactuel', $ligneachatretour->quantite_retourligneAchat);
        }
        $achatretour->date_retour_achat = $request->date_retour_achat;
        $achatretour->total_retour_achat = $request->total_retour_achat;
        $achatretour->description_retour_achat = $request->description_retour_achat;
        $achatretour->user_id = Auth::user()->id;
        $achatretour->save();
        $ligneachatretours=LigneRetourAchat::where("retour_achat_id",$id)->delete();
        foreach ($request->produit_id as $key => $produit_id) {
            $ligneachatretour = new LigneRetourAchat();
            $ligneachatretour->produit_id = $request->produit_id[$key];
            $ligneachatretour->quantite_retourligneAchat = $request->quantite_retourligneAchat[$key];
            $ligneachatretour->prixachat_retourligneAchat = $request->prixachat_retourligneAchat[$key];
            $ligneachatretour->soustotal_retourligneAchat = $request->soustotal_retourligneAchat[$key];
            $ligneachatretour->retour_achat_id = $achatretour->id;
            $ligneachatretour->save();
            Produit::where('id', $request->produit_id[$key])->decrement('stockactuel', $request->quantite_retourligneAchat[$key]);
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
            $achatretour = RetourAchat::findOrFail($id);
            $ligneachatretours=LigneRetourAchat::where("retour_achat_id",$id)->get();
            foreach ($ligneachatretours as   $ligneachatretour) {
                $produit = Produit::find($ligneachatretour->produit_id);
                $produit->increment('stockactuel', $ligneachatretour->quantite_retourligneAchat);
            }
            LigneRetourAchat::where("retour_achat_id",$id)->delete();
            $achatretour->delete();
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
    public function pdfligneachatretour($id)
    {

        $societe = Societe::first();
        $achatretour = RetourAchat::findOrFail($id);
        $ligneachatretours=LigneRetourAchat::where("retour_achat_id",$id)->get();
        $data = [
            'achatretour' => $achatretour,
            'societe' => $societe,
            'ligneachatretours' => $ligneachatretours,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.retournachat.achatretourinvoice', $data)->setPaper('a4');

        return $pdf->download('achatretour.pdf');
    }
    public function achatretourpdf()
    {
        $achatretours = RetourAchat::all();
        view()->share('retourachats',  $achatretours);
        $pdf = PDF::loadView('pages.retournachat.tableretourachatpdf', compact('achatretours'))->setPaper('a4', 'landscape');
        return $pdf->download('retourachatpdf.pdf');
    }

}
