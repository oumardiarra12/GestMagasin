<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocieteController extends Controller
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
        $societe=Societe::first();
        return view('pages.societe.create',compact('societe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageName="";
        $societe=Societe::first();
        if($request->file('logo_societe')){
            if ($societe->logo_societe) {
                Storage::delete('public/logosociete/' . $societe->logo_societe);
              }
            $imageName = 'logo'.'.'.$request->logo_societe->extension();
            $request->logo_societe->storeAs('public/logosociete', $imageName);

        }else {
            $imageName="logosociete.jpg";
        }
        Societe::updateOrCreate([
            'id'=>1
        ],[
            'nom_societe'=>$request->nom_societe,
            'activite_societe'=>$request->activite_societe,
            'tel_societe'=>$request->tel_societe,
            'nif_societe'=>$request->nif_societe,
            'bp_societe'=>$request->bp_societe,
            'adresse'=>$request->adresse,
            'logo_societe'=> $imageName,

        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Societe $societe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Societe $societe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Societe $societe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Societe $societe)
    {
        //
    }
}
