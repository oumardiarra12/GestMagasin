@extends('layouts.master')
@section('title', 'Gestion Paiement Vente')

@section('title_toolbar', 'Rapport des Paiements Ventes')
@section('subtitle_toolbar', 'Gestion des Paiements Ventes')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('ventes.index') }}" class="btn btn-outline-warning"><img
            src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-top">
                {{-- <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="assets/img/icons/filter.svg" alt="img">
                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{ route('achats.achatpdf') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                    </ul>
                </div> --}}


            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                    <form action="{{ route('rapports.rapportpaiementventes') }}" method="get">
                        <div class="row">
                           <div class="col-md-5 form-group">
                               <label for="">Date Debut</label>
                               <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
                            </div>
                            <div class="col-md-5 form-group">
                               <label for="">Date Fin</label>
                               <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
                            </div>
                            <div class="col-md-2 form-group" style="margin-top:25px;">
                               <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>
                   </form>
                </div>
                {{-- <div class="col-lg-6 col-sm-6 col-12 d-flex align-items-center justify-content-end">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"
                    href="{{ route('rapports.rapportachatpdf') }}"><img src="assets/img/icons/pdf.svg"
                        alt="img"></a>
                </div> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap mb-0" id="tableachat">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Payer</th>
                            <th>Reste</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $paiementventerapports as  $paiementventerapport)
                            <tr>
                                <td class="text-bolds">{{$paiementventerapport->vente->client->nom_client }}
                                    {{ $paiementventerapport->vente->client->prenom_client }}</td>
                                <td>{{ $paiementventerapport->num_paiement_ventes }}</td>
                                <td>{{ $paiementventerapport->date_paiement_vente }}</td>
                                <td class="totalachat">{{ $paiementventerapport->total_vente }}</td>
                                <td>{{ $paiementventerapport->total_payer }}</td>
                                <td>{{ $paiementventerapport->total_reste }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot align="right">
                        <tr>
                            <td>Total:</td><td></td><td></td><td></td><td class="totalachat"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        {{-- debut Show Purchase  --}}

        {{-- fin Show Purchase  --}}
    </div>
    </div>
    </div>
@endsection

