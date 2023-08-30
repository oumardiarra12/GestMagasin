<?php

namespace App\Http\Controllers;

use App\Http\Requests\Famille\StoreFamilleRequest;
use App\Models\Famille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class FamilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familles = Famille::all();
        return view('pages.famille.index', compact('familles'));
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
    public function store(StoreFamilleRequest $request)
    {


        Famille::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nom_famille' => $request->nom_famille,
                'description_famille' => $request->description_famille,
                "user_id"=>Auth::user()->id
            ]
        );

        return response()->json(['success' => 'Famille saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Famille $famille)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $famille = Famille::find($id);
        return response()->json($famille);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Famille $famille)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $famille=Famille::findOrFail($id);
            $famille->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Famille ne peut pas etre supprimer car il est lie a un Produit.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
}
