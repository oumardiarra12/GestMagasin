<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unite\StoreUniteRequest;
use App\Models\Unite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UniteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unites=Unite::all();
        return view('pages.unite.index',compact('unites'));
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
    public function store(StoreUniteRequest $request)
    {
        Unite::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'code_unite' => $request->code_unite,
                'nom_unite' => $request->nom_unite,
                'description_unite' => $request->description_unite,
                "user_id"=>Auth::user()->id
            ]
        );

        return response()->json(['success' => 'Unite saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Unite $unite)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unite = Unite::find($id);
        return response()->json($unite);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Unite $unite)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $unite=Unite::findOrFail($id);
            $unite->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Cet Unite ne peut pas etre supprimer car il est lie a un Produit.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
}
