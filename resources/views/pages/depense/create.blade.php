@extends('layouts.master')
@section('title', 'Gestion Depense')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Nouveau Depense')
@section('subtitle_toolbar', 'Nouveau Depense')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('depenses.store')}}" method="POST" id="createdepense">
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
                        <label>Date de Depense</label>
                        <input type="date" placeholder="Saisir la Date de Depense" name="date_depense" id="date_depense">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Categorie</label>
                        <select class="placeholder js-states form-control" name="categorie_depense_id" id="categorie_depense_id">
                            <option selected="true" disabled="disabled">Categorie</option>
                            @foreach ($categoriedepenses as $categoriedepense)
                            <option value="{{$categoriedepense->id}}">{{$categoriedepense->nom_categorie_depense}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Montant de Depense</label>
                        <input type="text" id="total_depense" name="total_depense" placeholder="Saisir le Montant de Depense">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Note</label>
                        <textarea class="form-control" name="note_depense" id="note_depense"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button  class="btn btn-submit me-2">Submit</button>
                    <a href="productlist.html" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('script')
    <script>

    $(document).ready(function() {
            $("#createdepense").validate({
                rules: {
                    date_depense: "required",
                    total_depense:{
                        required:true,
                        number: true
                    },

                    categorie_depense_id: "required",

                },
                messages: {
                    date_depense: {
                        required: "Date Expense is required",
                    },
                    total_depense: {
                        required: "Amount expense is required",
                        number: "Amount expense is numeric",
                    },

                    categorie_depense_id : {
                        required: "Category is required",
                    },

                }
            });
        });
    </script>
@endsection
