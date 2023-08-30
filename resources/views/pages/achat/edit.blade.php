@extends('layouts.master')
@section('title', 'Gestion Achat')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Edit Achat')
@section('subtitle_toolbar', 'Gestion des Achats')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('achats.update', $achat->id) }}" method="POST" id="editachat">
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
                            <label>Fournisseur</label>
                            <div class="row">
                                <input type="hidden" id="id" value="{{ $achat->id }}" name="id" />
                                <div class="col-lg-10 col-sm-10 col-10">
                                    <select class="placeholder js-states form-control" name="fournisseur_id"
                                        id="fournisseur_id">
                                        <option selected="true" disabled="disabled">Selectionner Produit</option>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option @if ($achat->fournisseur_id == $fournisseur->id || old('fournisseur_id') == $fournisseur->id) selected @endif
                                                value="{{ $fournisseur->id }}">{{ $fournisseur->nom_fournisseur }}
                                                {{ $fournisseur->prenom_fournisseur }}</option>
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
                            <label>Status</label>
                            <div class="row">
                                <div class="col-lg-10 col-sm-10 col-10">
                                    <select class="placeholder js-states form-control" name="status_achat_reception"
                                        id="status_achat_reception">
                                        <option selected="true" disabled="disabled">Selectionner Status</option>
                                        <option @if ($achat->status_achat_reception == 'encours' || old('status_achat_reception') == 'encours') selected @endif value="encours">En Cours
                                        </option>
                                        <option @if ($achat->status_achat_reception == 'reception' || old('status_achat_reception') == 'reception') selected @endif value="reception">
                                            Reception</option>
                                        <option @if ($achat->status_achat_reception == 'reception partial' || old('status_achat_reception') == 'reception partial') selected @endif value="reception partial">
                                            Reception Partiel</option>
                                        <option @if ($achat->status_achat_reception == 'annuler' || old('status_achat_reception') == 'annuler') selected @endif value="annuler">Annuler
                                        </option>
                                    </select>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date Achat </label>
                            <div class="input-groupicon">
                                <input type="date" class="form-control" value="{{ $achat->date_achat }}"
                                    name="date_achat" id="date_achat">
                                {{-- <div class="addonset">
                                <img src="assets/img/icons/calendars.svg" alt="img">
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Reference Achat </label>
                            <div class="input-groupicon">
                                <input type="text" class="form-control" value="{{ $achat->num_achat }}" name="num_achat"
                                    id="num_achat" readonly>
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
                                    <th class="recieved-product-qty d-none">QTE Reçue</th>
                                    <th>Prix Achat</th>
                                    <th>Sous Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ligneachats as $key => $ligneachat)
                                    <td class="productimgname">
                                        <input type="text" value="{{ $ligneachat->produit->nom_produit }}"
                                            class="form-control-plaintext border-0" readonly />
                                        <input type="hidden" name="produit_id[]" value="{{ $ligneachat->produit_id }}" />
                                    </td>
                                    <td> <input type="number" name="quantite_ligneAchat[]"
                                            value="{{ $ligneachat->quantite_ligneAchat }}"
                                            class="form-control quantite_ligneAchat" /></td>
                                    <td class="recieved-product-qty d-none"> <input type="number"
                                            name="quantite_recu_ligneAchat[]"
                                            value="{{ $ligneachat->quantite_recu_ligneAchat }}"
                                            class="form-control quantiterecu_ligneAchat recieved" /></td>
                                    <td><input type="number" name="prixachat_ligneAchat[]"
                                            value="{{ $ligneachat->prixachat_ligneAchat }}"
                                            class=" prixachat_ligneAchat" /></td>
                                    <td><input type="text" name="soustotal_ligneAchat[]"
                                            value="{{ $ligneachat->soustotal_ligneAchat }}"
                                            class="form-control-plaintext border-0 soustotal_ligneAchat" readonly /></td>
                                    <td>
                                        <a class="remove"><img src="assets/img/icons/delete.svg" alt="svg"></a>
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
                           --}}
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
                                    <h5><input type="text" name="total_achat" id="total_achat"
                                            value="{{ $achat->total_achat }}"
                                            class="form-control-plaintext border-0 total_achat" readonly /></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control description_achat" name="description_achat">{{ $achat->description_achat }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button id="achat-form" class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('achats.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
           if ($('select[name="status_achat_reception"]').val() == "reception partial") {
                $(".recieved-product-qty").removeClass("d-none");
                $(".quantite_ligneAchat").each(function() {
                    rowindex = $(this).closest('tr').index();
                    $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val($(this)
                    .val());
                });

            } else if (($('select[name="status_achat_reception"]').val() == "encours") || ($(
                    'select[name="status_achat_reception"]').val() == "annuler")) {
                $(".recieved-product-qty").addClass("d-none");
                $(".recieved").each(function() {
                    $(this).val(0);
                });
            } else {
                $(".recieved-product-qty").addClass("d-none");
                $(".quantite_ligneAchat").each(function() {
                    rowindex = $(this).closest('tr').index();
                    $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val($(this)
                    .val());
                });
            }


            $("#editachat").validate({
                ignore: [],
                rules: {
                    date_achat: {
                        required: true,
                        date: true
                    },
                    fournisseur_id: "required",
                    status_achat_reception:{
                        required:true,
                        quanity_and_recu:true
                    } ,
                    "produit_id[]": {
                        required: true,
                    },
                    "quantite_ligneAchat[]": {
                        required: true,
                        digits: true,
                    },
                    "quantite_recu_ligneAchat[]": {
                        required: true,
                        digits: true,


                    },
                    "prixachat_ligneAchat[]": {
                        required: true,
                        digits: true
                    },
                    "soustotal_ligneAchat[]": {
                        required: true,
                        digits: true
                    },
                    total_achat: {
                        required: true,
                        digits: true
                    },


                },
                messages: {
                    date_achat: {
                        required: "Date Purchase is required",
                        date: "Date Purchase is must date"
                    },
                    fournisseur_id: {
                        required: "Supply is required"
                    },
                    status_achat_reception: {
                        required: "status is required",
                        quanity_and_recu:'Quantity and Recieved value is same! Please Change Purchase Status or Recieved value'
                    },
                    "produit_id[]": {
                        required: "Product is required",
                    },
                    "quantite_ligneAchat[]": {
                        required: "Qty is required",
                        digits: "Qty is must numeric"
                    },
                    "quantite_recu_ligneAchat[]": {
                        required: "Qty Recevied is required",
                        digits: "Qty Recevied is must numeric"
                    },
                    "prixachat_ligneAchat[]": {
                        required: "Price is required",
                        digits: "Price is must numeric"
                    },
                    "soustotal_ligneAchat[]": {
                        required: "Sous Total is required",
                        digits: "Sous Total is must numeric"
                    },
                    total_achat: {
                        required: "Total is required",
                        digits: "Total is must numeric"
                    }

                },
                submitHandler: function(form) {
                    var rownumber = $('table tbody tr:last').index();
                    if (rownumber < 0) {
                        alert("Please insert product to  table upadte!");
                        !$("#createachat").valid()
                        return false;
                    }
                    else if ($('select[name="status_achat_reception"]').val() == "reception partial") {
                        $(".quantite_ligneAchat").each(function() {
                            rowindex = $(this).closest('tr').index();
                            quantity = $(this).val();
                            recieved = $('table tbody tr:nth-child(' + (rowindex + 1) + ')')
                                .find('.recieved').val();

                            if (quantity == recieved) {
                                alert(
                                    'Quantity and Recieved value is same! Please Change Purchase Status or Recieved value');
                                !$("#createachat").valid()
                                return ;
                                e.preventDefault()
                            }


                        });

                    }else{
                        form.submit();
                    return true
                    }

                }



            });




            });


        //});

        function getSubtotal(quantity, price) {
            return (quantity * price);
        }

        function totalAchat() {
            var totalAchat = 0;
            $('.soustotal_ligneAchat').each(function(i, e) {
                var soustotal = $(this).val() - 0;
                totalAchat += soustotal;
            })
            $('.total_achat').val(totalAchat);
        }
        //Changer quantite
        $("table").on('input', '.quantite_ligneAchat', function() {
            rowindex = $(this).closest('tr').index();
            if ($(this).val() < 1 && $(this).val() != '') {
                $('table tbody tr:nth-child(' + (rowindex + 1) + ') .quantite_ligneAchat').val(1);
                alert("La quantité ne peut pas être inférieure à 1");
            }
            checkQuantity($(this).val());
        });
        //Changer rix achat
        $("table").on('input', '.prixachat_ligneAchat', function() {
            rowindex = $(this).closest('tr').index();
            if ($(this).val() <= 0) {
                $('table tbody tr:nth-child(' + (rowindex + 1) + ') .prixachat_ligneAchat').val(0);
                alert("La quantité ne peut pas être inférieure à 0");
            }
            checkQuantity($(this).val());
        });
        $('tbody').delegate('.quantite_ligneAchat,.prixachat_ligneAchat', 'change', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantite_ligneAchat').val() - 0;
            var prixachat = tr.find('.prixachat_ligneAchat').val() - 0;
            var soustotal = qty * prixachat;
            tr.find('.soustotal_ligneAchat').val(soustotal);
            totalAchat();

        });

        function checkQuantity(purchase_qty) {
            $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.quantite_ligneAchat').val(purchase_qty);
            var status = $('select[name="status_achat_reception"]').val();
            if (status == 'reception' || status == 'reception partial')
                $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val(purchase_qty);
            else
                $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val(0);
        }
        // change status
        $('select[name="status_achat_reception"]').on('change', function() {
            if ($('select[name="status_achat_reception"]').val()  == "reception partial") {
                $(".recieved-product-qty").removeClass("d-none");
                $(".quantite_ligneAchat").each(function() {
                    rowindex = $(this).closest('tr').index();
                    $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val($(this).val());
                });

            } else if (($('select[name="status_achat_reception"]').val() == "encours") || ($(
                    'select[name="status_achat_reception"]').val() == "annuler")) {
                $(".recieved-product-qty").addClass("d-none");
                $(".recieved").each(function() {
                    $(this).val(0);
                });
            } else {
                $(".recieved-product-qty").addClass("d-none");
                $(".quantite_ligneAchat").each(function() {
                    rowindex = $(this).closest('tr').index();
                    $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val($(this).val());
                });
            }
        });
        var path = "{{ route('achats.rechercheproduit') }}";

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
                    `" class="quantite_ligneAchat" name="quantite_ligneAchat[]" value="1"/></td>`
                if ($('select[name="status_achat_reception"]').val() == "reception") {
                    newRow += `<td class="recieved-product-qty d-none"><input type="number" id="` + rowindex +
                        `" class="quantiterecu_ligneAchat recieved" name="quantite_recu_ligneAchat[]" value="1" step="any"/></td>`
                } else if ($('select[name="status_achat_reception"]').val() == "reception partial") {
                    newRow += `<td class="recieved-product-qty"><input type="number" id="` + rowindex +
                        `" class="quantiterecu_ligneAchat recieved" name="quantite_recu_ligneAchat[]" value="1" step="any"/></td>`
                } else {
                    newRow += `<td class="recieved-product-qty d-none"><input type="number" id="` + rowindex +
                        `" class="quantiterecu_ligneAchat recieved" name="quantite_recu_ligneAchat[]" value="0" step="any"/></td>`
                }
                newRow += `<td><input type="number" id="` + rowindex +
                    `" class="prixachat_ligneAchat" name="prixachat_ligneAchat[]" value="` + ui.item
                    .prix + `"/></td>`
                newRow += `<td><input type="text" id="` + rowindex +
                    `" class="form-control-plaintext soustotal_ligneAchat" value="` +
                    getSubtotal(ui.item.prix, 1) + `" name="soustotal_ligneAchat[]"  readonly /></td>`
                newRow += `<td><a class="remove"><img src="assets/img/icons/delete.svg" alt="svg"></a></td>`

                newRow += `</tr>`
                $("table tbody").append(newRow);
                $('#lims_productcodeSearch').val('');
                totalAchat();
                return false;
            }

        });
        $('tbody').delegate('.remove', 'click', function() {
            //var l = $('tbody tr').length;
            $(this).parent().parent().remove();
            totalAchat()
            // if (l == 0) {
            //      alert('Vous etes sur de Supprimer')
            //  } else {

            // }
        })

    </script>
@endsection
