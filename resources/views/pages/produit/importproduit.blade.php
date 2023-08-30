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
@section('title_toolbar', 'Import Produit')
@section('subtitle_toolbar', 'Import Produit')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="requiredfield">
                <h4>
                    Le champ doit être au format csv</h4>
            </div>
            <div class="row">
                <form action="{{ route('produits.importproduit') }}" method="POST" id="importproduit" enctype="multipart/form-data">
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
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Telecharger Fichier Excel</label>
                            <div class="image-upload">
                                <input type="file" name="fileproduit" accept=".xlsx" >
                                <div class="image-uploads">
                                    <img src="assets/img/icons/upload.svg" alt="img">
                                    <h4>Faites glisser et déposez un fichier à télécharger</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="productdetails productdetailnew">
                            <ul class="product-bar">
                                <li>
                                    <h4>Nom</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Code Barre</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Prix Vente</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Prix Achat</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Unite Produit</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Categorie Produit</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Description</h4>
                                    <h6 class="manitoryblue">Field optional</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="productdetails productdetailnew">
                            <ul class="product-bar">
                                <li>
                                    <h4>Stock Minimum</h4>
                                    <h6 class="manitoryblue">Field optional</h6>
                                </li>
                                <li>
                                    <h4>Stock Actuel</h4>
                                    <h6 class="manitoryblue">Field optional</h6>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $("#importproduit").validate({
        rules: {
            fileproduit: "required",
        },
        messages: {
            fileproduit: {
                required: "File is required",
            },

        }
    });
});
</script>
@endsection
