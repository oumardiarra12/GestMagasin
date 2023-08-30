<?php

namespace App\Http\Controllers;

use App\Exports\ExportClients;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Imports\ImportClients;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
use Excel;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=Client::all();
        return view('pages.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        Client::create($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $client = Client::findOrFail($id);
    //     return response()->json(array('client' => $client));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return response()->json(array('client' => $client));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->nom_client = $request->nom_client;
        $client->prenom_client = $request->prenom_client;
        $client->email_client = $request->email_client;
        $client->tel_client = $request->tel_client;
        $client->adresse_client = $request->adresse_client;
        $client->description_client	 = $request->description_client	;
        $client->save();
        return response()->json(['success' => 'Client saved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Ce Client ne peut pas etre supprimer car il est lie a un vente ou achat.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function importclient()
    {
        return view('pages.client.importclient');
    }
    public function importstoreclient(Request $request)
    {
        $validated = $request->validate([
            'fileclient' => 'required',
        ]);
        Excel::import(new ImportClients, request()->file('fileclient'));
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function exportclient()
    {
        return Excel::download(new ExportClients, 'clients.xlsx');
    }
    public function clientpdf()
    {
        $clients = Client::all();
        view()->share('clientpdf', $clients);
        $pdf = PDF::loadView('pages.client.clientpdf', compact('clients'))->setPaper('a4', 'landscape');
        return $pdf->download('clients.pdf');
    }
}
