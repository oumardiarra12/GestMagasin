@extends('layouts.master')
@section('title', 'Gestion Client')

@section('title_toolbar', 'Nouveau Client')
@section('subtitle_toolbar', 'Gestion des Clients')
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
            <form method="POST" action="{{ route('clients.store') }}" id="createclient">
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
                            <input type="text" name="nom_client" id="nom_client" placeholder="Saisir le Nom Client">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" name="prenom_client" id="prenom_client"
                                placeholder="Saisir le Prenom Client">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email_client" id="email_client" placeholder="Saisir Email Client">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" name="tel_client" id="tel_client"
                                placeholder="Saisir le Numero de Telephone Client">
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="adresse_client" id="adresse_client"
                                placeholder="Saisir l'Adresse Client">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description_client" id="description_client" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-cancel">Cancel</a>
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

            $("#createclient").validate({
                rules: {
                    nom_client: {
                        required: true,
                        pattern: true,
                    },
                    prenom_client: {
                        required: true,
                        pattern: true,
                    },
                    email_client: {
                        required: true,
                        email: true,
                    },
                    tel_client: {
                        required: true,
                        number: true
                    },
                    adresse_client: "required",
                },
                messages: {
                    nom_client: {
                        required: "Customer Firstname is required",
                        pattern: "Customer Firstname must string"
                    },
                    nom_client: {
                        required: "Customer Last name is required",
                        pattern: "Customer Last name must string"
                    },
                    email_client: {
                        required: "Customer Email is required",
                        email: "Customer Email is email",
                    },
                    tel_client: {
                        required: "Customer Phone is required",
                        number: "Customer Phone is numeric",
                    },
                    adresse_client: {
                        required: "Customer Address is required",
                    },

                }
            });
        });
    </script>
@endsection
