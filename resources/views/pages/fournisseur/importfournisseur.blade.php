@extends('layouts.master')
@section('title', 'Gestion Fournisseur')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Import Fournisseur')
@section('subtitle_toolbar', 'Import Fournisseur')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="requiredfield">
                <h4>
                    Le champ doit être au format csv</h4>
            </div>
            <div class="row">
                <form action="{{ route('fournisseurs.importfournisseur') }}" method="POST" id="importfournisseur" enctype="multipart/form-data">
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
                                <input type="file" name="filefournisseur" accept=".xlsx" >
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
                                    <h4>Nom Fournisseur</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Prenom Fournisseur</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Email Fournisseur</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Telephone Fournisseur</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Addresse Fournisseur</h4>
                                    <h6 class="manitorygreen">This Field is required</h6>
                                </li>
                                <li>
                                    <h4>Description</h4>
                                    <h6 class="manitoryblue">Field optional</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('fournisseurs.index')}}" class="btn btn-cancel">Cancel</a>
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
    $("#importfournisseur").validate({
        rules: {
            filefournisseur: "required",
        },
        messages: {
            fileclient: {
                required: "File is required",
            },

        }
    });
});
</script>
@endsection
