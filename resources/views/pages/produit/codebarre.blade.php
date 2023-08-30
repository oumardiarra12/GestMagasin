@extends('layouts.master')
@section('title', 'Gestion Produit')

@section('title_toolbar', 'Code Barre Produit')
@section('subtitle_toolbar', 'Gestion des Produits')
@section('btn_add_item')
<div class="page-btn">
    <a href="{{ route('produits.generercodebarre') }}" class="btn btn-outline-warning"><img
            src="{{ asset('assets/img/icons/printer.svg') }}" alt="img" class="me-1"></a>
</div>
<div class="page-btn">
    <a href="{{ route('produits.index') }}" class="btn btn-outline-warning"><img
            src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
</div>
@endsection
@section('content')
    <div class="row">
        @foreach ($produits as $produit)
        <div class="col-sm-3">
            <div class="card w-100 p-0">
              <div class="card-body">
                <span class="card-title">{!! DNS1D::getBarcodeHTML($produit->codebarre, 'C39',1) !!}</span>
                <p class="card-text m-0 p-0 fw-bold"><span>{{$produit->codebarre}}</span><br/>
                    <span class="m-0 p-0 fw-bold">Nom: {{$produit->nom_produit}}</span><br/>
                <span class="m-0 p-0 fw-bold">Prix vente: {{$produit->prixvente_produit}}</span>
                </p>

              </div>
            </div>
          </div>
          @endforeach
    </div>
@endsection
