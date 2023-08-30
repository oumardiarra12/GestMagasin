<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Depense;
use App\Models\PaiementAchat;
use App\Models\PaiementVente;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PDF;
class RapportController extends Controller
{
    public function rapportachat(Request $request){
        $achatrapports=Achat::orderBy('id', 'desc')
        ->when(
            $request->date_from && $request->date_to,
            function (Builder $builder) use ($request) {
                $builder->whereBetween(
                    DB::raw('DATE(date_achat)'),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->get();
        return view('pages.rapports.rapportachat',compact('achatrapports','request'));
    }
    public function rapportachatpdf(Request $request){
        $achatrapports=Achat::orderBy('id', 'desc')
        ->when(
            $request->date_from && $request->date_to,
            function (Builder $builder) use ($request) {
                $builder->whereBetween(
                    DB::raw('DATE(date_achat)'),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->get();
        view()->share('achatrapportpdf', $achatrapports);
        $pdf = PDF::loadView('pages.rapports.achatrapportpdf', compact('achatrapports','request'))->setPaper('a4', 'landscape');
        return $pdf->download('achatrapport.pdf');
    }
    public function rapportvente(Request $request){
        $venterapports=Vente::orderBy('id', 'desc')
        ->when(
            $request->date_from && $request->date_to,
            function (Builder $builder) use ($request) {
                $builder->whereBetween(
                    DB::raw('DATE(date_vente)'),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->get();
        return view('pages.rapports.rapportvente',compact('venterapports','request'));
    }
    public function rapportpaiementvente(Request $request){
        $paiementventerapports=PaiementVente::orderBy('id', 'desc')
        ->when(
            $request->date_from && $request->date_to,
            function (Builder $builder) use ($request) {
                $builder->whereBetween(
                    DB::raw('DATE(date_paiement_vente)'),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->get();
        return view('pages.rapports.rapportpaiementclient',compact('paiementventerapports','request'));
    }
    public function rapportpaiementachat(Request $request){
        $paiementfournisseurrapports=PaiementAchat::orderBy('id', 'desc')
        ->when(
            $request->date_from && $request->date_to,
            function (Builder $builder) use ($request) {
                $builder->whereBetween(
                    DB::raw('DATE(date_paiement_achat)'),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->get();
        return view('pages.rapports.rapportpaiementfournisseur',compact('paiementfournisseurrapports','request'));
    }
    public function rapportdepense(Request $request){
        $depenserapports=Depense::orderBy('id', 'desc')
        ->when(
            $request->date_from && $request->date_to,
            function (Builder $builder) use ($request) {
                $builder->whereBetween(
                    DB::raw('DATE(date_depense)'),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->get();
        return view('pages.rapports.rapportdepense',compact('depenserapports','request'));
    }
}
