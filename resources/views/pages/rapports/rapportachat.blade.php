@extends('layouts.master')
@section('title', 'Gestion Achat')

@section('title_toolbar', 'Rapport des Achats')
@section('subtitle_toolbar', 'Gestion des Achats')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('achats.index') }}" class="btn btn-outline-warning"><img
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
                    <form action="{{ route('rapports.rapportachats') }}" method="get">
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
                            <th>Fournisseur</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Status Reception</th>
                            <th>Total</th>
                            <th>Retour</th>
                            <th>Payer</th>
                            <th>Reste</th>
                            <th>Paiement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($achatrapports as $achatrapport)
                            <tr>
                                <td class="text-bolds">{{ $achatrapport->fournisseur->nom_fournisseur }}
                                    {{ $achatrapport->fournisseur->prenom_fournisseur }}</td>
                                <td>{{ $achatrapport->num_achat }}</td>
                                <td>{{ $achatrapport->date_achat }}</td>
                                <td>
                                    @if ($achatrapport->status_achat_reception == 'encours')
                                        <span class="badges bg-lightred">En Cours</span>
                                    @elseif ($achatrapport->status_achat_reception == 'annuler')
                                        <span class="badges bg-lightred">Annuler</span>
                                    @elseif ($achatrapport->status_achat_reception == 'reception partial')
                                        <span class="badges bg-lightyellow">Reception Partial</span>
                                    @else
                                        <span class="badges bg-lightgreen">Reception</span>
                                    @endif
                                </td>
                                <td class="totalachat">{{ $achatrapport->total_achat }}</td>
                                <td>{{ $achatrapport->retourachats->sum('total_retour_achat') }}</td>
                                <td>{{ $achatrapport->paiementachats->sum('total_payer') }}</td>
                                <td>{{ $achatrapport->total_achat - $achatrapport->paiementachats->sum('total_payer') }}</td>
                                <td>
                                    @if ($achatrapport->status_achat_payment == 'no pay')
                                        <span class="badges bg-lightred">Non Payer</span>
                                    @elseif ($achatrapport->status_achat_payment == 'pay partial')
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
                                            <a href="javascript:void(0);" class="dropdown-item detailachat"
                                                data-id="{{ $achatrapport->id }}"><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Achat</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('achats.exportpdfachat', $achatrapport->id) }}"
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
          <div class="modal fade" id="showachat" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4> Details Achat</h4>
                            <h6>Voir Achat details</h6>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-sales-split">
                                    <h2>Detail Achat : <span id="num_achatshow"></span></h2>
                                    <ul>
                                        {{-- <li>
                                            <a href="javascript:void(0);"><img src="assets/img/icons/edit.svg"
                                                    alt="img"></a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route('achats.exportpdfachat', $achatrapport->id) }}"><img
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
                                                        Fournisseur</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        <span id="nom_fournisseurshow"></span> <span
                                                            id="prenom_fournisseurshow"></span>
                                                    </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="email_fournisseurshow"> </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="tel_fournisseurshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="adress_fournisseurshow"></font>
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
                                                        Achat</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Reference </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Payment Status</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Status Reception</font>
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
                                                        id="achat_numshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="date_achatshow"></font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="status_achatshow"></font>

                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"
                                                        id="status_achatpaiementshow"></font>
                                                </font><br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width: 100%;line-height: inherit;text-align: left;" id="tableachatdetails">
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
                                                QTE Recu
                                            </th>
                                            <th
                                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                                Prix Achat
                                            </th>
                                            <th
                                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                                Sous Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyligneachat">

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
                                                <h5 id="totalachatsohw"></h5>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <p id="descriptionachatsohw"></p>
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
            //$("#tableachatdetails tbody").empty();
            $('body').on('click', '.detailachat', function() {
                var id = $(this).data('id');
                var url = "{{ route('achats.show', ['id' => ':id']) }}"
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    console.log(data);
                    $("#tableachatdetails").find("tbody").empty();
                    $('#showachat').modal('show');
                    $('#num_achatshow').text(data.achat[0].num_achat);
                    $('#nom_fournisseurshow').text(data.achat[0].fournisseur.nom_fournisseur);
                    $('#prenom_fournisseurshow').text(data.achat[0].fournisseur.prenom_fournisseur);
                    $('#email_fournisseurshow').text(data.achat[0].fournisseur.email_fournisseur);
                    $('#tel_fournisseurshow').text(data.achat[0].fournisseur.tel_fournisseur);
                    $('#adress_fournisseurshow').text(data.achat[0].fournisseur
                        .adresse_fournisseur);
                    $('#achat_numshow').text(data.achat[0].num_achat);
                    $('#date_achatshow').text(data.achat[0].date_achat);
                    $('#status_achatshow').text(data.achat[0].status_achat_reception);
                    $('#status_achatpaiementshow').text(data.achat[0].status_achat_payment);
                    $('#totalachatsohw').text(data.achat[0].total_achat);
                    $('#societenameshow').text(data.societe.nom_societe);
                    $('#societetelshow').text(data.societe.tel_societe);
                    $('#societeadresseshow').text(data.societe.adresse);
                    $('#descriptionachatsohw').text(data.achat[0].description_achat);

                    $.each(data.ligneachats, function(index, item) {
                        output = `<tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                           ` + item.produit.nom_produit + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                            ` + item.quantite_ligneAchat + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                            ` + item.quantite_recu_ligneAchat + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                ` + item.prixachat_ligneAchat + `
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                ` + item.soustotal_ligneAchat + `
                            </td>
                            </tr>`
                        //console.log(output)
                        $('tbody#bodyligneachat:last-child').append(output);
                    })

                })
            });
        });
    </script>
@endsection

