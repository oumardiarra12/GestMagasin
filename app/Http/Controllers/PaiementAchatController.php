<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaiementAchat\StorePaiementAchatRequest;
use App\Http\Requests\PaiementAchat\UpdatePaiementAchatRequest;
use App\Models\Achat;
use App\Models\PaiementAchat;
use App\Models\Societe;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
class PaiementAchatController extends Controller
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
    public function store(StorePaiementAchatRequest $request)
    {
        $achat = Achat::findOrFail($request->achat_id);
        PaiementAchat::create([
            'achat_id' => $request->achat_id,
            'total_achat' => $request->total_achat,
            'total_payer' => $request->total_payer,
            'total_reste' => $request->total_reste,
            'date_paiement_achat' => $request->date_paiement_achat,
            'description_paiement' => $request->description_paiement,
            'user_id' => Auth::user()->id
        ]);
        if ($request->total_reste == 0) {
            $achat->status_achat_payment = "pay";
            $achat->save();
        } elseif ($request->total_reste > 0) {
            $achat->status_achat_payment = "pay partial";
            $achat->save();
        }
        return response()->json(['success' => 'Payment saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $achat = Achat::findOrFail($id);
        $paiementachats = PaiementAchat::with("user")->where("achat_id", $achat->id)->get();
        return response()->json($paiementachats);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paiementachat = PaiementAchat::findOrFail($id);
        return response()->json($paiementachat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaiementAchatRequest $request, $id)
    {
        $paiementachat = PaiementAchat::findOrFail($id);
        $paiementachat->total_achat = $request->total_achat;
        $paiementachat->total_payer = $request->total_payer;
        $paiementachat->total_reste = $request->total_reste;
        $paiementachat->date_paiement_achat = $request->date_paiement_achat;
        $paiementachat->description_paiement = $request->description_paiement;
        $paiementachat->user_id = Auth::user()->id;
        $paiementachat->save();
        if ($request->total_reste == 0) {
            $paiementachat->achat->status_achat_payment = "pay";
            $paiementachat->achat->save();
        } elseif ($request->total_reste > 0) {
            $paiementachat->achat->status_achat_payment = "pay partial";
            $paiementachat->achat->save();
        }
        return response()->json(['success' => 'Payment saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {
            $paiementachat=PaiementAchat::findOrFail($id);
            $paiementachat->delete();
           // $achat =Achat::where('id',$paiementachat->achat_id)->get();

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
    public function pdfpaiementachat($id){
        $paiementachat =PaiementAchat::findOrFail($id);
        $societe=Societe::first();
        $data = [
            'paiementachat' => $paiementachat,
            'societe'=>$societe,
        ];

        $pdf = PDF::loadView('pages.achat.achatpaiementpdf', $data);

        return $pdf->download('ReglementClient.pdf');
        //return response()->download($pdf);

    }
    public function creance(Request $request){
        // $creance=PaiementAchat::with(['achat' => function($query){
        //     $query->groupBy('achat_id');
        // }])->where("total_reste",'>',0)->get();
        $creance=PaiementAchat::with(['achat' => function($query){
            $query->groupBy('achat_id');
        }])->orderBy('id', 'desc')
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
        )->where("total_reste",'>',0)->get();
        dd($creance);
    }
}
