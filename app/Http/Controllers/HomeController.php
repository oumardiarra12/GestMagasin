<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Client;
use App\Models\Depense;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\RetourAchat;
use App\Models\RetourVente;
use App\Models\Vente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalachat=Achat::where("status_achat_payment","pay")->orwhere("status_achat_payment","pay partial")->whereBetween('date_achat',
        [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
    )->sum('total_achat');
    $countachat=Achat::count();
    $totalachatretour=RetourAchat::whereBetween('date_retour_achat',
    [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_retour_achat');
$totalachats=$totalachat-$totalachatretour;
    $totalvente=Vente::whereBetween('date_vente',
    [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_vente');
$countvente=Vente::count();
$totalventeretour=RetourVente::whereBetween('date_retourvente',
[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_retourvente');
$totalventes= $totalvente-$totalventeretour;
$totaldepense=Depense::whereBetween('date_depense',
[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_depense');
$countclient=Client::count();
$countfournisseur=Fournisseur::count();
$produits=Produit::orderBy('id', 'desc')->take(5)->get();
$achatyear = Achat::select(DB::raw("sum(total_achat) as total_achat"), DB::raw("MONTHNAME(date_achat) as month_name"))
->whereYear('date_achat', date('Y'))
->groupBy(DB::raw("Month(date_achat)"))
->pluck('total_achat', 'month_name');
$venteyear = Vente::select(DB::raw("sum(total_vente) as total_vente"), DB::raw("MONTHNAME(date_vente) as month_name"))
->whereYear('date_vente', date('Y'))
->groupBy(DB::raw("Month(date_vente)"))
->pluck('total_vente', 'month_name');
$dataachat = json_decode($achatyear->values());
$datavente = json_decode($venteyear->values());
        return view('pages.dashboard.homeadmin',compact('totalachats','totalventes','totaldepense','countachat','countvente','countclient','countfournisseur','produits','dataachat','datavente'));
    }
    public function homegerant(){
        $totalachat=Achat::where("status_achat_payment","pay")->orwhere("status_achat_payment","pay partial")->whereBetween('date_achat',
        [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
    )->sum('total_achat');
    $countachat=Achat::count();
    $totalachatretour=RetourAchat::whereBetween('date_retour_achat',
    [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_retour_achat');
$totalachats=$totalachat-$totalachatretour;
    $totalvente=Vente::whereBetween('date_vente',
    [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_vente');
$countvente=Vente::count();
$totalventeretour=RetourVente::whereBetween('date_retourvente',
[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_retourvente');
$totalventes= $totalvente-$totalventeretour;
$totaldepense=Depense::whereBetween('date_depense',
[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
)->sum('total_depense');
$countclient=Client::count();
$countfournisseur=Fournisseur::count();
$produits=Produit::orderBy('id', 'desc')->take(5)->get();
$achatyear = Achat::select(DB::raw("sum(total_achat) as total_achat"), DB::raw("MONTHNAME(date_achat) as month_name"))
->whereYear('date_achat', date('Y'))
->groupBy(DB::raw("Month(date_achat)"))
->pluck('total_achat', 'month_name');
$venteyear = Vente::select(DB::raw("sum(total_vente) as total_vente"), DB::raw("MONTHNAME(date_vente) as month_name"))
->whereYear('date_vente', date('Y'))
->groupBy(DB::raw("Month(date_vente)"))
->pluck('total_vente', 'month_name');
$dataachat = json_decode($achatyear->values());
$datavente = json_decode($venteyear->values());
        return view('pages.dashboard.homemanage',compact('totalachats','totalventes','totaldepense','countachat','countvente','countclient','countfournisseur','produits','dataachat','datavente'));
    }
    public function homeagent(){
        $produits=Produit::all();
        return view('pages.dashboard.homeagent',compact('produits'));
    }
}
