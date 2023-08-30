@extends('layouts.master')
@section('title', 'Gestion Vente')

@section('title_toolbar', 'Rapport des Ventes')
@section('subtitle_toolbar', 'Gestion des Ventes')

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
                    <form action="{{ route('rapports.rapportventes') }}" method="get">
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
                            <th>Retour</th>
                            <th>Payer</th>
                            <th>Reste</th>
                            <th>Paiement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venterapports as $venterapport)
                            <tr>
                                <td class="text-bolds">{{ $venterapport->client->nom_client }}
                                    {{ $venterapport->client->prenom_client }}</td>
                                <td>{{ $venterapport->num_vente }}</td>
                                <td>{{ $venterapport->date_vente }}</td>
                                <td class="totalachat">{{ $venterapport->total_vente }}</td>
                                <td>{{ $venterapport->retourventes->sum('total_retour_vente') }}</td>
                                <td>{{ $venterapport->paiementventes->sum('total_payer') }}</td>
                                <td>{{ $venterapport->total_vente - $venterapport->paiementventes->sum('total_payer') }}</td>
                                <td>
                                    @if ($venterapport->status_vente_payment == 'no pay')
                                        <span class="badges bg-lightred">Non Payer</span>
                                    @elseif ($venterapport->status_vente_payment == 'pay partial')
                                        <span class="badges bg-lightyellow">Payer Partial</span>
                                    @else
                                        <span class="badges bg-lightgreen">Payer</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item showvente"
                                                data-id="{{ $venterapport->id }}"><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Vente</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('ventes.exportpdfvente', $venterapport->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download pdf</a>
                                        </li>
                                    </ul>
                                </td>
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
        <div class="modal fade" id="showvente" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4> Details Vente</h4>
                            <h6>Voir Vente details</h6>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-sales-split">
                                    <h2>Detail Vente : <span id="num_venteshow"></span></h2>
                                    <ul>
                                        {{-- <li>
                                            <a href="javascript:void(0);"><img src="assets/img/icons/edit.svg"
                                                    alt="img"></a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route('ventes.exportpdfvente', $venterapport->id) }}"><img
                                                    src="assets/img/icons/printer.svg" alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                                <table style="width: 100%;line-height: inherit;text-align: left;">
                                    <tbody>
                                        <tr>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Client</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        <span id="nom_clientshow"></span> <span
                                                            id="prenom_clientshow"></span>
                                                    </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="email_clientshow"> </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="tel_clientshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="adress_clientshow"></font>
                                                </font><br>
                                            </td>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Societe</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="societenameshow"></font>
                                                </font><br>
                                                {{-- <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="societeemailshow"> </font></font><br> --}}
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="societetelshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="societeadresseshow"></font>
                                                </font><br>
                                            </td>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Vente</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Reference </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                       Date </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">

                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Status Paiement</font>
                                                </font><br>
                                            </td>
                                            <td
                                                style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        &nbsp;</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="vente_numshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="date_venteshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="status_ventepaiementshow"></font>
                                                </font><br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 100%;line-height: inherit;text-align: left;" id="tableventedetails">
                                    <thead>
                                        <tr class="heading " style="background: #F3F2F7;">
                                            <th
                                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                                Designation
                                            </th>
                                            <th
                                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                                QTE
                                            </th>
                                            <th
                                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                                Prix Vente
                                            </th>
                                            <th
                                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                                Sous Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodylignevente">

                                    </tbody>
                                </table>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 ">
                                    <div class="total-order w-100 max-widthauto m-auto mb-4">
                                    </div>
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="total-order w-100 max-widthauto m-auto mb-4">
                                        <ul>
                                            <li class="total">
                                                <h4>Grand Total</h4>
                                                <h5 id="totalventesohw"></h5>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <p id="descriptionventesohw"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                    aria-label="Close">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin Show Purchase  --}}
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
             $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Deatil Produit
            //$("#tableventedetails tbody").empty();
            $('body').on('click', '.showvente', function() {
                var id = $(this).data('id');
                var url = "{{ route('ventes.show', ['id' => ':id']) }}"
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    // console.log(data);
                    $("#tableventedetails").find("tbody").empty();
                    $('#showvente').modal('show');
                    $('#num_venteshow').text(data.vente[0].num_vente);
                    $('#nom_clientshow').text(data.vente[0].client.nom_client);
                    $('#prenom_clientshow').text(data.vente[0].client.prenom_client);
                    $('#email_clientshow').text(data.vente[0].client.email_client);
                    $('#tel_clientshow').text(data.vente[0].client.tel_client);
                    $('#adress_clientshow').text(data.vente[0].client
                        .adresse_client);
                    $('#vente_numshow').text(data.vente[0].num_vente);
                    $('#date_venteshow').text(data.vente[0].date_vente);
                    $('#status_ventepaiementshow').text(data.vente[0].status_vente_paiement);
                    $('#totalventesohw').text(data.vente[0].total_vente);
                    $('#societenameshow').text(data.societe.nom_societe);
                    $('#societetelshow').text(data.societe.tel_societe);
                    $('#societeadresseshow').text(data.societe.adresse);
                    $('#descriptionventesohw').text(data.vente[0].description_vente);

                    $.each(data.ligneventes, function(index, item) {
                        output = `<tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                           ` + item.produit.nom_produit + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                            ` + item.quantite_lignevente + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                ` + item.prixvente_lignevente + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                ` + item.soustotal_lignevente + `
                            </td>
                            </tr>`
                        //console.log(output)
                        $('tbody#bodylignevente:last-child').append(output);
                    })

                })
            })});
    </script>
@endsection

