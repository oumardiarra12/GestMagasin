@extends('layouts.master')
@section('title', 'Gestion Fournisseur')

@section('title_toolbar', 'Nouveau Fournisseur')
@section('subtitle_toolbar', 'Gestion des Fournisseurs')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('fournisseurs.store') }}" id="createfournisseur">
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
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom_fournisseur" id="nom_fournisseur" placeholder="Saisir le Nom Fournisseur">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" name="prenom_fournisseur" id="prenom_fournisseur"
                                placeholder="Saisir le Prenom Fournisseur">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email_fournisseur" id="email_fournisseur" placeholder="Saisir Email Fournisseur">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" name="tel_fournisseur" id="tel_fournisseur"
                                placeholder="Saisir le Numero de Telephone Fournisseur">
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="adresse_fournisseur" id="adresse_fournisseur"
                                placeholder="Saisir l'Adresse Fournisseur">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description_fournisseur" id="description_fournisseur" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('fournisseurs.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            jQuery.validator.addMethod("pattern", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Field must string");

            $("#createfournisseur").validate({
                rules: {
                    nom_fournisseur: {
                        required: true,
                        pattern: true,
                    },
                    prenom_fournisseur: {
                        required: true,
                        pattern: true,
                    },
                    email_fournisseur: {
                        required: true,
                        email: true,
                    },
                    tel_fournisseur: {
                        required: true,
                        number: true
                    },
                    adresse_fournisseur: "required",
                },
                messages: {
                    nom_fournisseur: {
                        required: "Supply Firstname is required",
                        pattern: "Supply Firstname must string"
                    },
                    nom_fournisseur: {
                        required: "Supply Last name is required",
                        pattern: "Supply Last name must string"
                    },
                    email_fournisseur: {
                        required: "Supply Email is required",
                        email: "Supply Email is email",
                    },
                    tel_fournisseur: {
                        required: "Supply Phone is required",
                        number: "Supply Phone is numeric",
                    },
                    adresse_fournisseur: {
                        required: "Supply Address is required",
                    },

                }
            });
        });
    </script>
@endsection
