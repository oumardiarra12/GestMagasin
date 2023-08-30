@extends('layouts.master')
@section('title', 'Gestion Retour Achat')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Nouvau Retour Achat')
@section('subtitle_toolbar', 'Gestion des Retour Achats')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('retourachats.store',$achat->id) }}" method="POST" id="createretourachat">
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
                            <label>Reference Achat </label>
                            <div class="input-groupicon">
                                <input type="text" class="form-control" value="{{$achat->num_achat}}"  id="referenceachat_achat" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date Retour Achat</label>
                            <div class="input-groupicon">
                                <input type="date" class="form-control" name="date_retour_achat" value="{{date('Y-m-d')}}"  id="retourachatdate_achat">
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
                                    <th>QTE Reçue</th>
                                    <th>Prix Achat</th>
                                    <th>Sous Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ligneachats as $ligneachat)
                                <tr>
                                    <td class="productimgname">
                                        <input type="text" value="{{$ligneachat->produit->nom_produit}}" class="form-control-plaintext border-0" readonly/>
                                        <input type="hidden" value="{{$ligneachat->produit_id}}" name="produit_id[]" />
                                      </td>
                                      <td> <input type="number" value="{{$ligneachat->quantite_ligneAchat}}" class="form-control-plaintext border-0" readonly/></td>
                                      <td> <input type="number" name="quantite_retourligneAchat[]" value="{{$ligneachat->quantite_recu_ligneAchat}}" class="form-control quantite_retourligneAchat" /></td>
                                      <td><input type="text" name="prixachat_retourligneAchat[]" value="{{$ligneachat->prixachat_ligneAchat}}"  class="form-control-plaintext border-0 prixachat_retourligneAchat" readonly/></td>
                                      <td><input type="text" name="soustotal_retourligneAchat[]" value="{{$ligneachat->soustotal_ligneAchat}}" class="form-control-plaintext border-0 soustotal_retourligneAchat" readonly/></td>
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
                                    <h5><input type="text" name="total_retour_achat" value="{{$achat->total_achat}}" id="total_retour_achat"
                                            class="form-control-plaintext border-0 total_retour_achat"  readonly /></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control description_retour_achat" name="description_retour_achat"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('retourachats.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {


            $("#createretourachat").validate({
                ignore: [],
                rules: {
                    date_retour_achat: {
                        required: true,
                        date: true
                    },
                    "produit_id[]": {
                        required: true,
                        minlength: 1

                    },
                    "quantite_retourligneAchat[]": {
                        required: true,
                        digits: true,

                    },

                    "prixachat_retourligneAchat[]": {
                        required: true,
                        digits: true
                    },
                    "soustotal_retourligneAchat[]": {
                        required: true,
                        digits: true
                    },
                    total_retour_achat: {
                        required: true,
                        digits: true
                    },



                },
                messages: {
                    date_retour_achat: {
                        required: "Date Return Purchase is required",
                        date: "Date Return Purchase is must date"
                    },

                    "produit_id[]": {
                        required: "Return Product is required",
                        minlength: "Please insert Return product to  table!"
                    },
                    "quantite_retourligneAchat[]": {
                        required: "Qty Return is required",
                        digits: "Qty Return is must numeric",

                    },

                    "prixachat_retourligneAchat[]": {
                        required: "Price is required",
                        digits: "Price is must numeric"
                    },
                    "soustotal_retourligneAchat[]": {
                        required: "Sous Total is required",
                        digits: "Sous Total is must numeric"
                    },
                    total_retour_achat: {
                        required: "Total is required",
                        digits: "Total is must numeric"
                    },


                },
                // submitHandler: function(form) {
                //     var rownumber = $('table tbody tr:last').index();
                //     if (rownumber < 0) {
                //         alert("Please insert product to  table upadte!");
                //         !$("#createachat").valid()
                //         return false;
                //     }
                //     else if ($('select[name="status_achat_reception"]').val() == "reception partial") {
                //         $(".quantite_ligneAchat").each(function() {
                //             rowindex = $(this).closest('tr').index();
                //             quantity = $(this).val();
                //             recieved = $('table tbody tr:nth-child(' + (rowindex + 1) + ')')
                //                 .find('.recieved').val();
                //             if (quantity == recieved) {
                //                 alert(
                //                     'Quantity and Recieved value is same! Please Change Purchase Status or Recieved value');
                //                 !$("#createachat").valid()
                //                 return false;
                //                 //e.preventDefault()
                //             }


                //         });

                //     }else{
                //         form.submit();
                //     return true
                //     }

                // }



            });


        });

        function getSubtotal(quantity, price) {
            return (quantity * price);
        }

        function totalAchat() {
            var totalAchat = 0;
            $('.soustotal_retourligneAchat').each(function(i, e) {
                var soustotal = $(this).val() - 0;
                totalAchat += soustotal;
            })
            $('.total_retour_achat').val(totalAchat);
        }
        //Changer quantite
        $("table").on('input', '.quantite_retourligneAchat', function() {
            rowindex = $(this).closest('tr').index();
            if ($(this).val() < 1 && $(this).val() != '') {
                $('table tbody tr:nth-child(' + (rowindex + 1) + ') .quantite_retourligneAchat').val(1);
                alert("La quantité ne peut pas être inférieure à 1");
            }
            // checkQuantity($(this).val());
        });
        //Changer rix achat
        // $("table").on('input', '.prixachat_ligneAchat', function() {
        //     rowindex = $(this).closest('tr').index();
        //     if ($(this).val() <= 0) {
        //         $('table tbody tr:nth-child(' + (rowindex + 1) + ') .prixachat_ligneAchat').val(0);
        //         alert("La quantité ne peut pas être inférieure à 0");
        //     }
        //     checkQuantity($(this).val());
        // });
        $('tbody').delegate('.quantite_retourligneAchat', 'change', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantite_retourligneAchat').val() - 0;
            var prixachat = tr.find('.prixachat_retourligneAchat').val() - 0;
            var soustotal = qty * prixachat;
            tr.find('.soustotal_retourligneAchat').val(soustotal);
            totalAchat();

        });

        // function checkQuantity(purchase_qty) {
        //     //$('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.quantite_ligneAchat').val(purchase_qty);
        //     var status = $('select[name="status_achat_reception"]').val();
        //     if (status == 'reception' || status == 'reception partial')
        //         $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val(purchase_qty);
        //     else
        //         $('table tbody tr:nth-child(' + (rowindex + 1) + ')').find('.recieved').val(0);
        // }
        // change status



//         $("#lims_productcodeSearch").autocomplete({
//             source: function(request, response) {
//                 $.ajax({
//                     url: path,
//                     type: 'GET',
//                     dataType: "json",
//                     data: {
//                         search: request.term
//                     },
//                     success: function(data) {
//                         response(data);
//                     }
//                 });
//             },
//             select: function(event, ui) {
//                 $('#lims_productcodeSearch').val(ui.item.label);
//                 var rowindex = $(this).parents("tr").index();
//                 var newRow = `<tr>` +
//                     `<td><input type="text" class="produit_id form-control-plaintext" id="` + rowindex +
//                     `" value="` + ui.item
//                     .label + `" readonly />
//     <input type="hidden" name="produit_id[]" id="` + rowindex + `" value="` + ui.item.value + `"  /></td>`
//                 newRow += `<td><input type="number" id="` + rowindex +
//                     `" class="quantite_ligneAchat" name="quantite_ligneAchat[]" value="1"/></td>`
//                     newRow += `<td class="recieved-product-qty d-none"><input type="number" id="` + rowindex +
//                         `" class="quantiterecu_ligneAchat recieved" name="quantite_recu_ligneAchat[]" value="1" step="any"/></td>`
//                 newRow += `<td><input type="number" id="` + rowindex +
//                     `" class="prixachat_ligneAchat" name="prixachat_ligneAchat[]" value="` + ui.item
//                     .prix + `"/></td>`
//                 newRow += `<td><input type="text" id="` + rowindex +
//                     `" class="form-control-plaintext soustotal_ligneAchat" value="` +
//                     getSubtotal(ui.item.prix, 1) + `" name="soustotal_ligneAchat[]"  readonly /></td>`
//                 newRow += `<td><a class="remove"><img src="assets/img/icons/delete.svg" alt="svg"></a></td>
// </td>`

//                 newRow += `</tr>`
//                 $("table tbody").append(newRow);
//                 $('#lims_productcodeSearch').val('');
//                 totalAchat();
//                 return false;
//             }

//         });
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
