<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieDepense\StoreOrUpdateCategorieDepenseRequest;
use App\Models\CategorieDepense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategorieDepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriedepenses = CategorieDepense::all();
        return view('pages.categoriedepense.index', compact('categoriedepenses'));
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
    public function store(StoreOrUpdateCategorieDepenseRequest $request)
    {
        CategorieDepense::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nom_categorie_depense' => $request->nom_categorie_depense,
                'description_categorie_depense' => $request->description_categorie_depense,
            ]
        );

        return response()->json(['success' => 'Famille saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoriedepense = CategorieDepense::find($id);
        return response()->json($categoriedepense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $categoriedepense=CategorieDepense::findOrFail($id);
            $categoriedepense->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Categorie de Depense ne peut pas etre supprimer car il est lie a un Produit.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
}
