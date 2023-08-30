@extends('layouts.master')
@section('title', 'Gestion Devis')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Edit Devis')
@section('subtitle_toolbar', 'Gestion des Devis')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('devis.update', $devis->id)}}"  method="POST" id="editdevis">
                @method('PUT')
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
                            <label>Client</label>
                            <div class="row">
                                <input type="hidden" id="id" value="{{ $devis->id }}" name="id" />
                                <div class="col-lg-10 col-sm-10 col-10">
                                    <select class="placeholder js-states form-control" name="client_id"
                                        id="client_id">
                                        <option selected="true" disabled="disabled">Selectionner Client</option>
                                        @foreach ($clients as $client)
                                            <option @if ($devis->client_id == $client->id || old('client_id') == $client->id) selected @endif value="{{ $client->id }}">{{ $client->nom_client }}
                                                {{ $client->prenom_client }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                {{-- <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                <div class="add-icon">
                                    <a href="javascript:void(0);"><img src="assets/img/icons/plus1.svg" alt="img"></a>
                                </div>
                            </div> --}}

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date Devis </label>
                            <div class="input-groupicon">
                                <input type="date" class="form-control" value="{{$devis->date_devis}}" name="date_devis"  id="date_devis">
                                {{-- <div class="addonset">
                                <img src="assets/img/icons/calendars.svg" alt="img">
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Reference </label>
                            <div class="input-groupicon">
                                <input type="text" class="form-control" value="{{$devis->num_devis}}" name="num_devis"  id="num_devis" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nom de Produit</label>
                            <div class="input-groupicon">
                                <input type="text" placeholder="Recherche Produit par select..." name="product_code_name"
                                    id="lims_productcodeSearch">
                                <div class="addonset">
                                    <img src="assets/img/icons/scanners.svg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>QTE</th>
                                    <th>Prix Vente</th>
                                    <th>Sous Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lignedevis as $lignedevis)
                                <td class="productimgname">
                                    <input type="text" value="{{$lignedevis->produit->nom_produit}}" class="form-control-plaintext border-0" readonly/>
                                    <input type="hidden" class="produit_id" name="produit_id[]" value="{{$lignedevis->produit_id}}" />
                                  </td>
                                  <td> <input type="number"  name="quantite_lignedevis[]" value="{{$lignedevis->quantite_lignedevis}}" class="form-control quantite_lignedevis" /></td>
                                  <td><input type="text"  name="prixvente_lignedevis[]" value="{{$lignedevis->prixvente_lignedevis}}" class="form-control-plaintext border-0 prixvente_lignedevis" readonly/></td>
                                  <td><input type="text"  name="soustotal_lignedevis[]" value="{{$lignedevis->soustotal_lignedevis}}" class="form-control-plaintext border-0 soustotal_lignedevis" readonly/></td>
                                  <td>
                                      <a class="delete-set"><img src="assets/img/icons/delete.svg" alt="svg"></a>
                                  </td>
                            </tr>
                                @endforeach
                                {{-- <tr>
                                <td class="productimgname">
                                    <input type="text" value="Produit 1" class="form-control-plaintext border-0" readonly/>
                                    <input type="hidden" name="produit_id[]" />
                                  </td>
                                  <td> <input type="number" name="quantite_ligneAchat[]" value="1" class="form-control" /></td>
                                  <td><input type="text" name="prixachat_ligneAchat[]" value="2000" class="form-control-plaintext border-0" readonly/></td>
                                  <td><input type="text" name="soustotal_ligneAchat[]" value="2000" class="form-control-plaintext border-0" readonly/></td>
                                  <td>
                                      <a class="delete-set"><img src="assets/img/icons/delete.svg" alt="svg"></a>
                                  </td>
                            </tr>
                            <tr>
                                <td class="productimgname">
                                  <input type="text" value="Produit 1" class="form-control-plaintext border-0" readonly />
                                  <input type="hidden" name="produit_id[]" />
                                </td>
                                <td> <input type="number" name="quantite_ligneAchat[]" value="1" class="form-control" /></td>
                                <td><input type="text" name="prixachat_ligneAchat[]" value="2000" class="form-control-plaintext border-0" readonly/></td>
                                <td><input type="text" name="soustotal_ligneAchat[]" value="2000" class="form-control-plaintext border-0" readonly/></td>
                                <td>
                                    <a class="delete-set"><img src="assets/img/icons/delete.svg" alt="svg"></a>
                                </td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 float-md-right">
                        <div class="total-order">
                            <ul>
                                <li class="total">
                                    <h4>Grand Total</h4>
                                    <h5><input type="text" value="{{$devis->total_devis}}" name="total_devis" id="total_devis"
                                            class="form-control-plaintext border-0 total_devis"  readonly /></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control description_devis" name="description_devis">{{$devis->description_devis}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button  id="devis-form" class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('devis.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {


            $("#editdevis").validate({
                ignore: [],
                rules: {
                    date_devis: {
                        required: true,
                        date: true
                    },
                    client_id: "required",
                    "produit_id[]": {
                        required: true,
                        minlength: 1

                    },
                    "quantite_lignedevis[]": {
                        required: true,
                        digits: true,

                    },

                    "prixvente_lignedevis[]": {
                        required: true,
                        digits: true
                    },
                    "soustotal_lignedevis[]": {
                        required: true,
                        digits: true
                    },
                    total_vente: {
                        required: true,
                        digits: true
                    },



                },
                messages: {
                    date_devis: {
                        required: "Date Canotation is required",
                        date: "Date Canotation is must date"
                    },
                    client_id: {
                        required: "Customer is required"
                    },
                    "produit_id[]": {
                        required: "Product is required",
                        minlength: "Please insert product to  table!"
                    },
                    "quantite_lignedevis[]": {
                        required: "Qty is required",
                        digits: "Qty is must numeric",

                    },

                    "prixvente_lignedevis[]": {
                        required: "Price is required",
                        digits: "Price is must numeric"
                    },
                    "soustotal_lignedevis[]": {
                        required: "Sous Total is required",
                        digits: "Sous Total is must numeric"
                    },
                    total_devis: {
                        required: "Total is required",
                        digits: "Total is must numeric"
                    },


                },
                submitHandler: function(form) {
                    var rownumber = $('table tbody tr:last').index();
                    if (rownumber < 0) {
                        alert("Please insert product to  table upadte!");
                        !$("#editdevis").valid()
                        return false;
                    }else{
                        return true;
                    }


                }



            });


        });

        function getSubtotal(quantity, price) {
            return (quantity * price);
        }

        function totalDevis() {
            var totalDevis = 0;
            $('.soustotal_lignedevis').each(function(i, e) {
                var soustotal = $(this).val() - 0;
                totalDevis += soustotal;
            })
            $('.total_devis').val(totalDevis);
        }
        //Changer quantite
        $("table").on('input', '.quantite_lignedevis', function() {
            rowindex = $(this).closest('tr').index();
            if ($(this).val() < 1 && $(this).val() != '') {
                $('table tbody tr:nth-child(' + (rowindex + 1) + ') .quantite_lignedevis').val(1);
                alert("La quantité ne peut pas être inférieure à 1");
            }

        });
        //Changer rix vente
        $("table").on('input', '.prixvente_lignedevis', function() {
            rowindex = $(this).closest('tr').index();
            if ($(this).val() <= 0) {
                $('table tbody tr:nth-child(' + (rowindex + 1) + ') .prixvente_lignedevis').val(0);
                alert("La quantité ne peut pas être inférieure à 0");
            }

        });
        $('tbody').delegate('.quantite_lignedevis,.prixvente_lignedevis', 'change', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantite_lignedevis').val() - 0;
            var prixvente = tr.find('.prixvente_lignedevis').val() - 0;
            var soustotal = qty * prixvente;
            tr.find('.soustotal_lignedevis').val(soustotal);
            totalDevis();

        });



        var path = "{{ route('devis.rechercheproduit') }}";

        $("#lims_productcodeSearch").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#lims_productcodeSearch').val(ui.item.label);
                var rowindex = $(this).parents("tr").index();
                var newRow = `<tr>` +
                    `<td><input type="text" class="produit_id form-control-plaintext" id="` + rowindex +
                    `" value="` + ui.item
                    .label + `" readonly />
    <input type="hidden" name="produit_id[]" id="` + rowindex + `" value="` + ui.item.value + `"  /></td>`
                newRow += `<td><input type="number" id="` + rowindex +
                    `" class="quantite_lignedevis" name="quantite_lignedevis[]" value="1"/></td>`

                newRow += `<td><input type="number" id="` + rowindex +
                    `" class="prixvente_lignedevis" name="prixvente_lignedevis[]" value="` + ui.item
                    .prix + `"/></td>`
                newRow += `<td><input type="text" id="` + rowindex +
                    `" class="form-control-plaintext soustotal_lignedevis" value="` +
                    getSubtotal(ui.item.prix, 1) + `" name="soustotal_lignedevis[]"  readonly /></td>`
                newRow += `<td><a class="remove"><img src="assets/img/icons/delete.svg" alt="svg"></a></td>
</td>`

                newRow += `</tr>`
                $("table tbody").append(newRow);
                $('#lims_productcodeSearch').val('');
                totalDevis();
                return false;
            }

        });
        $('tbody').delegate('.remove', 'click', function() {
            //var l = $('tbody tr').length;
            $(this).parent().parent().remove();
            totalDevis()
            // if (l == 0) {
            //      alert('Vous etes sur de Supprimer')
            //  } else {

            // }
        })
    </script>
@endsection
