<?php

namespace App\Http\Controllers;

use App\Exports\ExportDepenses;
use App\Http\Requests\Depense\StoreDepenseRequest;
use App\Http\Requests\Depense\UpdateDepenseRequest;
use App\Models\CategorieDepense;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use Excel;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depenses=Depense::all();
        $categoriedepenses=CategorieDepense::all();
        return view('pages.depense.index',compact('depenses','categoriedepenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoriedepenses=CategorieDepense::all();
        return view('pages.depense.create',compact('categoriedepenses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepenseRequest $request)
    {
        Depense::create([
            'date_depense'=>$request->date_depense,
            'total_depense'=>$request->total_depense,
            'note_depense'=>$request->note_depense,
            'categorie_depense_id'=>$request->categorie_depense_id,
            'user_id'=>Auth::user()->id
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
        $depense = Depense::with('categoriedepense',  'user')->where("id", $id)->get();
        return response()->json($depense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $depense = Depense::find($id);
        return response()->json($depense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepenseRequest $request, string $id)
    {
        $depense = Depense::find($id);
        $depense->num_depense=$request->num_depense;
        $depense->date_depense=$request->date_depense;
        $depense->total_depense=$request->total_depense;
        $depense->note_depense=$request->note_depense;
        $depense->categorie_depense_id=$request->categorie_depense_id;
        $depense->user_id=Auth::user()->id;
        $depense->save();
        return response()->json(['success' => 'Depense saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $depense = Depense::findOrFail($id);
            $depense->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Depense ne peut pas etre supprimer car il est lie a une action.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function exportdepense()
    {
        return Excel::download(new ExportDepenses, 'depenses.xlsx');
    }
    public function depensepdf()
    {
        $depenses = Depense::all();
        view()->share('depensepdf', $depenses);
        $pdf = PDF::loadView('pages.depense.depensepdf', compact('depenses'))->setPaper('a4', 'landscape');
        return $pdf->download('depense.pdf');
    }
}
