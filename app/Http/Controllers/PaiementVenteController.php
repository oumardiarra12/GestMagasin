<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaiementVente\StorePaiementVenteRequest;
use App\Http\Requests\PaiementVente\UpdatePaiementVenteRequest;
use App\Models\PaiementVente;
use App\Models\Societe;
use App\Models\Vente;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class PaiementVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePaiementVenteRequest $request)
    {
        $vente = Vente::findOrFail($request->vente_id);
        PaiementVente::create([
            'vente_id' => $request->vente_id,
            'total_vente' => $request->total_vente,
            'total_payer' => $request->total_payer,
            'total_reste' => $request->total_reste,
            'date_paiement_vente' => $request->date_paiement_vente,
            'description_paiement' => $request->description_paiement,
            'user_id' => Auth::user()->id
        ]);
        if ($request->total_reste == 0) {
            $vente->status_vente_paiement = "payer";
            $vente->save();
        } elseif ($request->total_reste > 0) {
            $vente->status_vente_paiement = "payer partial";
            $vente->save();
        }
        return response()->json(['success' => 'Payment saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vente = Vente::findOrFail($id);
        $paiementventes = PaiementVente::with("user")->where("vente_id", $vente->id)->get();
        return response()->json($paiementventes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paiementvente = PaiementVente::findOrFail($id);
        return response()->json($paiementvente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaiementVenteRequest $request,$id)
    {
        $paiementvente = PaiementVente::findOrFail($id);
        $paiementvente->total_vente = $request->total_vente;
        $paiementvente->total_payer = $request->total_payer;
        $paiementvente->total_reste = $request->total_reste;
        $paiementvente->date_paiement_vente = $request->date_paiement_vente;
        $paiementvente->description_paiement = $request->description_paiement;
        $paiementvente->user_id = Auth::user()->id;
        $paiementvente->save();
        if ($request->total_reste == 0) {
            $paiementvente->vente->status_vente_paiement = "payer";
            $paiementvente->vente->save();
        } elseif ($request->total_reste > 0) {
            $paiementvente->vente->status_vente_paiement = "payer partial";
            $paiementvente->vente->save();
        }
        return response()->json(['success' => 'Payment saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $paiementvente=PaiementVente::findOrFail($id);
            $paiementvente->delete();

            return response()->json(['success' => 'Payment delete successfully.']);
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Paiement Achat ne peut pas etre supprimer.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdfpaiementvente($id){
        $paiementvente=PaiementVente::findOrFail($id);
        $societe=Societe::first();
        $data = [
            'paiementvente' => $paiementvente,
            'societe'=>$societe,
        ];

        $pdf = PDF::loadView('pages.vente.ventepaiementpdf', $data);

        return $pdf->download('ReglementClient.pdf');
        //return response()->download($pdf);

    }
    public function dette(Request $request){
        $dette=PaiementVente::with(['vente' => function($query){
            $query->groupBy('vente_id');
        }])->orderBy('id', 'desc')
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
        )->where("total_reste",'>',0)->get();
        dd($dette);
    }
}
