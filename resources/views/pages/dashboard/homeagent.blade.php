@extends('layouts.master')
@section('content')
    <h1 class="text-primary">BIENVENUE {{Auth::user()->nom_user}}  {{Auth::user()->prenom_user}}</h1>
    <h2>La Liste des Produits</h2>
    <div class="table-responsive">
        <table class="table  datanew" id="tableProduit">
            <thead>
                <tr>
                    <th>Nom Produit</th>
                    <th>Categorie </th>
                    <th>Unite</th>
                    <th>prix Vente</th>
                    <th>Stock Actuel</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                    <tr>
                        <td>
                            {{ $produit->nom_produit }}
                        </td>
                        <td>{{ $produit->famille->nom_famille }} </td>
                        <td>{{ $produit->unite->code_unite }}</td>
                        <td>{{ $produit->prixvente_produit }}</td>
                        <td>{{ $produit->stockactuel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
