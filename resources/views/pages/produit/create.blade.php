@extends('layouts.master')
@section('title', 'Gestion Produit')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Nouveau Produit')
@section('subtitle_toolbar', 'Nouveau Produit')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('produits.store')}}" method="POST" id="createproduit">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="row">

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" placeholder="Saisir le Nom de Produit" name="nom_produit" id="nom_produit">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Categorie</label>
                        <select class="placeholder js-states form-control" name="famille_id" id="famille_id">
                            <option selected="true" disabled="disabled">Categorie</option>
                            @foreach ($familles as $famille)
                            <option value="{{$famille->id}}">{{$famille->nom_famille}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Unite</label>
                        <select class="placeholder js-states form-control" name="unite_id" id="unite_id">
                            <option selected="true" disabled="disabled">Unite</option>
                            @foreach ($unites as $unite)
                                <option value="{{$unite->id}}">{{$unite->code_unite}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Code Barre</label>
                        <input type="text" id="codebarre" name="codebarre" placeholder="Saisir le Code Barre">
                        <span class="input-group-text" id="basic-addon2"  onclick="generateCodeBarre()">Generer Code Barre</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Stock Min</label>
                        <input type="text" name="stockmin" id="stockmin">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Stock Actuel</label>
                        <input type="text" name="stockactuel" id="stockactuel" readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Prix Achat</label>
                        <input type="text" name="prixachat_produit" id="prixachat_produit">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Prix Vente</label>
                        <input type="text" name="prixvente_produit" id="prixvente_produit">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description_produit" id="description_produit"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button  class="btn btn-submit me-2">Submit</button>
                    <a href="{{route('produits.index')}}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
         function generateCodeBarre() {
        // change 12 to the length you want the hash
        let randomcodebarreHash = (Math.random().toString().substr(2, 13));

        $('#codebarre').val(randomcodebarreHash);
    }
    $(document).ready(function() {
            $("#createproduit").validate({
                rules: {
                    nom_produit: "required",
                    stockmin:{
                        required:true,
                        number: true
                    },
                    prixvente_produit:{
                        required:true,
                        number: true
                    },
                    prixachat_produit:{
                        required:true,
                        number: true
                    },
                    famille_id: "required",
                    unite_id: "required",
                },
                messages: {
                    nom_produit: {
                        required: "Product Name is required",
                    },
                    stockmin: {
                        required: "Stock Minium is required",
                        number: "Stock Minium is numeric",
                    },
                    prixvente_produit: {
                        required: "Price sale is required",
                        number: "Price sale is numeric",
                    },
                    prixachat_produit: {
                        required: "Price purchase is required",
                        number: "Price purchase is numeric",
                    },
                    famille_id: {
                        required: "Category is required",
                    },
                    unite_id: {
                        required: "Unit is required",
                    },
                }
            });
        });
    </script>
@endsection
