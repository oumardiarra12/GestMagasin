@extends('layouts.master')
@section('title', 'Gestion Vente')

@section('title_toolbar', 'Mes Ventes')
@section('subtitle_toolbar', 'Gestion des Ventes')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('ventes.createcomptoir') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Vente
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
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
                            <a href="{{ route('ventes.mesventespdf') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg col-sm-6 col-12">
                            <div class="form-group">
                                <input type="date" onchange="searchdatavente()" class="" placeholder="Choisir Date"
                                    id="date_vente">
                            </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                            <div class="form-group">
                                <select class="placeholder js-states form-control" name="client_id" id="client_id"
                                    onchange="searchclient()">
                                    <option selected="true" disabled="disabled">Choisir Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->nom_client }}">
                                            {{ $client->nom_client }} {{ $client->prenom_client }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="tablevente">
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
                        @foreach ($mesventes as $vente)
                            <tr>
                                <td class="text-bolds">{{ $vente->client->nom_client }}
                                    {{ $vente->client->prenom_client }}</td>
                                <td>{{ $vente->num_vente }}</td>
                                <td>{{ $vente->date_vente }}</td>
                                <td>{{ $vente->total_vente }}</td>
                                <td>{{ $vente->retourventes->sum('total_retourvente') }}</td>
                                <td>{{ $vente->paiementventes->sum('total_payer') }}</td>
                                <td>{{ $vente->total_vente - $vente->paiementventes->sum('total_payer') }}</td>
                                <td>
                                    @if ($vente->status_vente_paiement == 'non payer')
                                        <span class="badges bg-lightred">Non Payer</span>
                                    @elseif ($vente->status_vente_paiement == 'payer partial')
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
                                            <a href="javascript:void(0);" class="dropdown-item detailvente"
                                                data-id="{{ $vente->id }}"><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Vente</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item showpayment"
                                                data-id="{{ $vente->id }}"><img
                                                    src="assets/img/icons/dollar-square.svg" class="me-2"
                                                    alt="img">Voir Paiements</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('ventes.exportpdftiket', $vente->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download pdf</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot align="right">
                        <tr>
                            <td>Total:</td><td></td><td></td><td></td><td class="totalvente"></td>
                        </tr>
                    </tfoot> --}}
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
                                        {{-- <li>
                                            <a href="{{ route('ventes.exportpdftiket', $vente->id) }}"><img
                                                    src="assets/img/icons/printer.svg" alt="img"></a>
                                        </li> --}}
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
        {{-- Debut de Paiement --}}
        <div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Voir Paiements</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table" id="tableshowpaiementvente">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Total vente</th>
                                        <th>Montant Payer </th>
                                        <th>Montant Reste </th>
                                        <th>Saisir Par </th>
                                    </tr>
                                </thead>
                                <tbody id="showtablepaiemenclient">
                                    {{-- <tr class="bor-b1">
                                        <td>2022-03-07 </td>
                                        <td>INV/SL0101</td>
                                        <td>2000 </td>
                                        <td>2000</td>
                                        <td>0</td>
                                        <td>Oumar Diarra</td>
                                        <td>
                                            <a class="me-2" href="javascript:void(0);">
                                                <img src="assets/img/icons/printer.svg" alt="img">
                                            </a>
                                            <a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">
                                                <img src="assets/img/icons/edit.svg" alt="img">
                                            </a>
                                            <a class="me-2 confirm-text" href="javascript:void(0);">
                                                <img src="assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fin de Paiement --}}
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        // debut de Recherche
        function searchdatavente() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("date_vente");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablevente");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }


        function searchclient() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("client_id");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablevente");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // calcul auto pour ajout
        $(document).ready(function() {
            $('#total_payerc').on('keyup', function() {
                var montantpayer = $('#total_payerc').val();
                var montantapayer = $('#total_ventepaiement').val();
                var reste = montantapayer - montantpayer;
                $('#total_restec').val(reste);
                if (reste < 0) {
                    alert("le Montant est Superier")
                    $('#total_payerc').val('');
                    $('#total_restec').val(montantapayer);
                }
            });
        })
        // calcul auto pour edit
        $(document).ready(function() {
            $('#edittotal_payerc').on('keyup', function() {
                var montantpayer = $('#edittotal_payerc').val();
                var montantapayer = $('#total_paiementcedit').val();
                var reste = montantapayer - montantpayer;
                $('#edittotal_restec').val(reste);
                if (reste < 0) {
                    alert("le Montant est Superier")
                    $('#edittotal_payerc').val('');
                    $('#edittotal_restec').val(montantapayer);
                }
            });
        })
        // fin de Recherche
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Deatil Produit
            //$("#tableventedetails tbody").empty();
            $('body').on('click', '.detailvente', function() {
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
            });


            //show paiement client
            $('body').on('click', '.showpayment', function() {
                var id = $(this).data('id');
                var url = "{{ route('paiementventes.show', ['id' => ':id']) }}"
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    $("#tableshowpaiementvente").find("tbody").empty();
                    $('#showpayment').modal('show');
                    $.each(data, function(index, item) {
                        out = `<tr class="bor-b1">
                            <td>
                           ` + item.date_paiement_vente + `
                            </td>
                            <td>
                            ` + item.num_paiement_ventes + `
                            </td>
                            <td>
                            ` + item.total_vente + `
                            </td>
                            <td>
                                ` + item.total_payer + `
                            </td>
                            <td>
                                ` + item.total_reste + `
                            </td>
                            <td>
                                ` + item.user.nom_user + ` ` + item.user.prenom_user + `
                            </td>

                            </tr>`
                        //console.log(output)
                        $('tbody#showtablepaiemenclient:last-child').append(out);
                     })
                    })
            })
        });


          $('body').on('click', '.dawloadpayment',function() {
                var id = $(this).data("id");
                var data = '';
                $.ajax({
                    type: 'GET',
                    url: "/paiementventes/export/" + id,
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        var blob = new Blob([response], {type: 'application/pdf'});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "reglementvente.pdf";
                        link.click();
                    },
                    error: function(blob) {
                        console.log(blob);
                    }
                });
            });
        //     $(document).ready(function() {
        //     $('table#tablevente thead th').each(function(i) {
        //         calculateColumn(i);
        //     });
        // });

        // function calculateColumn(index) {
        //     var total = 0;
        //     $('table#tablevente tr').each(function() {
        //         var value = parseInt($('td.totalvente', this).eq(index).text());
        //         if (!isNaN(value)) {
        //             total += value;
        //         }
        //     });
        //     $('table#tablevente tfoot td.totalvente').eq(index).text(total);
        // }
    </script>
@endsection
