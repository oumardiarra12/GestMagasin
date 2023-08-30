@extends('layouts.masterpos')
@section('title', 'Gestion Comptoir')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Comptoir')
@section('subtitle_toolbar', 'Gestion Comptoir')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-sm-12 tabs_wrapper">
            <div class="page-header ">
                <div class="page-title">
                    <h4>Categories</h4>
                    <h6>Manage your purchases</h6>
                </div>
            </div>
            <ul class=" tabs owl-carousel owl-theme owl-product  border-0 ">
                @foreach ($familles as $famille)
                    <li class="{{ $famille->id == 1 ? 'active' : '' }}" id="{{ $famille->id }}">
                        <div class="product-details ">
                            <h6>{{ $famille->nom_famille }}</h6>
                        </div>
                    </li>
                @endforeach

                {{-- <li id="headphone">
                <div class="product-details ">
                    <img src="assets/img/product/product63.png" alt="img">
                    <h6>Headphones</h6>
                </div>
            </li>
            <li id="Accessories">
                <div class="product-details">
                    <img src="assets/img/product/product64.png" alt="img">
                    <h6>Accessories</h6>
                </div>
            </li>
            <li id="Shoes">
                <a class="product-details">
                    <img src="assets/img/product/product65.png" alt="img">
                    <h6>Shoes</h6>
                </a>
            </li>
            <li id="computer">
                <a class="product-details">
                    <img src="assets/img/product/product66.png" alt="img">
                    <h6>Computer</h6>
                </a>
            </li>
            <li id="Snacks">
                <a class="product-details">
                    <img src="assets/img/product/product67.png" alt="img">
                    <h6>Snacks</h6>
                </a>
            </li>
            <li id="watch">
                <a class="product-details">
                    <img src="assets/img/product/product68.png" alt="img">
                    <h6>Watches</h6>
                </a>
            </li>
            <li id="cycle">
                <a class="product-details">
                    <img src="assets/img/product/product61.png" alt="img">
                    <h6>Cycles</h6>
                </a>
            </li>
            <li id="fruits1">
                <div class="product-details ">
                    <img src="assets/img/product/product62.png" alt="img">
                    <h6>Fruits</h6>
                </div>
            </li>
            <li id="headphone1">
                <div class="product-details ">
                    <img src="assets/img/product/product63.png" alt="img">
                    <h6>Headphones</h6>
                </div>
            </li> --}}
            </ul>
            <div class="tabs_container">
                @foreach ($familles as $famille)
                    <div class="{{ $famille->id == 1 ? 'tab_content active' : 'tab_content' }}" data-tab="{{ $famille->id }}">
                        <div class="row">
                            @foreach ($famille->produits as $produit)
                                <div class="col-lg-3 col-sm-6 addcart" style="width:300px;">
                                    <div
                                        class="{{ $produit->famille_id ? 'productset flex-fill' : 'productset flex-fill active' }}">

                                        <div class="productsetimg">
                                            <h4 class="p-2 nom_produit">{{ $produit->nom_produit }}</h4>
                                            <h6>Stock Actuel: {{ $produit->stockactuel }}</h6>
                                            <div class="check-product">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="productsetcontent">
                                            <h4 class="d-none produit_id">{{ $produit->id }}</h4>
                                            <h5>{{ $produit->famille->nom_famille }}</h5>
                                            <h6 class="prixvente_produit">{{ $produit->prixvente_produit }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>

                    </div>
                @endforeach


            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mt-5">
            {{-- <div class="order-list">
            <div class="orderid">
                <h4>Order List</h4>
                <h5>Transaction id : #65565</h5>
            </div>
            <div class="actionproducts">
                <ul>
                    <li>
                        <a href="javascript:void(0);" class="deletebg confirm-text"><img
                                src="assets/img/icons/delete-2.svg" alt="img"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                            class="dropset">
                            <img src="assets/img/icons/ellipise1.svg" alt="img">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            data-popper-placement="bottom-end">
                            <li>
                                <a href="#" class="dropdown-item">Action</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Another Action</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Something Elses</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div> --}}
            <form method="POST" action="{{ route('ventes.storecomptoir') }}" id="createcomptoirvente">
                <div class="card card-order">
                    <div class="card-body">

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
                            <div class="col-12 mt-2">
                                <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal"
                                    data-bs-target="#create"><i class="fa fa-plus me-2"></i>Nouveau Client</a>
                            </div>
                            <div class="col-lg-12">
                                <div class="select-split ">
                                    <div class="select-group w-100">
                                        <select class="placeholder js-states form-control" name="client_id" id="client_id">
                                            <option selected="true" disabled="disabled">Selectionner Client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->nom_client }}
                                                    {{ $client->prenom_client }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nom de Produit</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="Recherche Produit par select..."
                                            name="product_code_name" id="lims_productcodeSearch">
                                        <div class="addonset">
                                            <img src="assets/img/icons/scanners.svg" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="split-card">
                    </div>
                    <div class="card-body pt-0">
                        <div class="totalitem">
                            <h4>
                                Articles au total : <strong id="countarticle"></strong></h4>
                            <a href="javascript:void(0);" onclick="tableclear()">
                                Tout effacer</a>
                        </div>
                        <table class="table" id="tablecard">
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="split-card">
                    </div>
                    <div class="card-body pt-0 pb-2">
                        <div class="setvalue">
                            <ul>
                                <li class="total-value">
                                    <h5>Total </h5>
                                    <h6><input type="text" name="total_vente"
                                            class="form-control-plaintext total_vente border-0" value="0" readonly /></h6>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>
                <div class="row m-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="btn-pos">
                    <ul>
                        <li>
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#recents"><img
                                    src="assets/img/icons/transcation.svg" alt="img" class="me-1">
                                Les Ventes Recents</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Creer Nouveau Client</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('ventes.storeclient') }}" id="createclientcomptoir">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Nom Client</label>
                                        <input type="text" name="nom_client" id="nom_client" class="nom_client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Prenom Client</label>
                                        <input type="text" name="prenom_client" id="prenom_client"
                                            class="prenom_client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Email Client</label>
                                        <input type="text" name="email_client" id="email_client"
                                            class="email_client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Telephone Client</label>
                                        <input type="text" name="tel_client" id="tel_client" class="tel_client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Addresse Client</label>
                                        <input type="text" name="adresse_client" id="adresse_client"
                                            class="adresse_client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Description Client</label>
                                        <textarea name="description_client" id="description_client" class="description_client"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="recents" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Recent Ventes</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="tabs-sets">

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                                    aria-labelledby="purchase-tab">
                                    <div class="table-top">
                                        <div class="search-set">
                                            <div class="search-input">
                                                <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                        alt="img"></a>
                                            </div>
                                        </div>
                                        <div class="wordset">
                                            <ul>
                                                {{-- <li>
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="pdf"><img src="assets/img/icons/pdf.svg"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="excel"><img src="assets/img/icons/excel.svg"
                                                            alt="img"></a>
                                                </li> --}}
                                                <li>
                                                    <a  data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="print" href="{{route('ventes.venterecentpdf')}}"><img src="assets/img/icons/printer.svg"
                                                            alt="img"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table datanew">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Ref</th>
                                                    <th>CLient</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ventes as $vente)
                                                    <tr>
                                                        <td>{{ $vente->date_vente }}</td>
                                                        <td>{{ $vente->num_vente }}</td>
                                                        <td>{{ $vente->client->nom_client }}
                                                            {{ $vente->client->prenom_client }}</td>
                                                        <td>{{ $vente->total_vente }}</td>
                                                        <td>
                                                            <a class="me-3" href="{{route('ventes.exportpdftiket',$vente->id)}}">
                                                                <img src="assets/img/icons/pdf.svg" alt="img">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="payment" role="tabpanel">
                                    <div class="table-top">
                                        <div class="search-set">
                                            <div class="search-input">
                                                <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                        alt="img"></a>
                                            </div>
                                        </div>
                                        <div class="wordset">
                                            <ul>
                                                <li>
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="print"><img src="assets/img/icons/printer.svg"
                                                            alt="img"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {


            $("#createcomptoirvente").validate({
                ignore: [],
                rules: {
                    date_vente: {
                        required: true,
                        date: true
                    },
                    client_id: "required",
                    "produit_id[]": {
                        required: true,
                        minlength: 1

                    },
                    "quantite_lignevente[]": {
                        required: true,
                        digits: true,

                    },

                    "prixvente_lignevente[]": {
                        required: true,
                        digits: true
                    },
                    "soustotal_lignevente[]": {
                        required: true,
                        digits: true
                    },
                    total_vente: {
                        required: true,
                        digits: true
                    },



                },
                messages: {
                    date_vente: {
                        required: "Date Sale is required",
                        date: "Date Sale is must date"
                    },
                    client_id: {
                        required: "Customer is required"
                    },
                    "produit_id[]": {
                        required: "Product is required",
                        minlength: "Please insert product to  table!"
                    },
                    "quantite_lignevente[]": {
                        required: "Qty is required",
                        digits: "Qty is must numeric",

                    },

                    "prixvente_lignevente[]": {
                        required: "Price is required",
                        digits: "Price is must numeric"
                    },
                    "soustotal_lignevente[]": {
                        required: "Sous Total is required",
                        digits: "Sous Total is must numeric"
                    },
                    total_vente: {
                        required: "Total is required",
                        digits: "Total is must numeric"
                    },


                },
                submitHandler: function(form) {
                    var rownumber = $('table#tablecard tbody tr:last').index();
                    if (rownumber < 0) {
                        alert("Please insert product to  table upadte!");
                        !$("#createcomptoirvente").valid()
                        return false;
                    } else {
                        form.submit();
                        return true
                    }


                }



            });

            function getSubtotal(quantity, price) {
                return (quantity * price);
            }

            function totalVente() {
                var totalVente = 0;
                $('.soustotal_lignevente').each(function(i, e) {
                    var soustotal = $(this).val() - 0;
                    totalVente += soustotal;
                })
                $('.total_vente').val(totalVente);
            }

            function updateitem(row) {
                //$(this).closest('tr')
                var qty = row.find('.quantite_lignevente').val() - 0;
                var prixvente = row.find('.prixvente_lignevente').val() - 0;
                var soustotal = qty * prixvente;
                row.find('.soustotal_lignevente').val(soustotal);
                totalVente();
            }
            $('#tablecard').delegate('.quantite_lignevente', 'change', function() {
                updateitem($(this).closest('tr'))
            });
            $(".addcart").on("click", function() {
                var nom_produit = $(this).find('.nom_produit').text();
                var produit_id = $(this).find('.produit_id').text();
                var prixvente_produit = $(this).find('.prixvente_produit').text();
                var rowindex = $(this).parents("tr").index();

                var newRow = `<tr class="product-lists">`
                newRow += `<td class="productimgname">
                            <input type="text" id="` + rowindex + `" value="` + nom_produit + `" class="form-control-plaintext border-0" readonly/>
                            <input type="hidden" id="` + rowindex +
                    `" class="produit_id" name="produit_id[]" value="` + produit_id + `" />
                          </td>`
                newRow += `<td> <div class="increment-decrement">
                                                        <div class="input-groups">
                                                            <input type="button" value="-"
                                                                class="button-minus dec button">
                                                            <input type="text" name="quantite_lignevente[]" value="1"
                                                                class="quantity-field quantite_lignevente">
                                                            <input type="button" value="+"
                                                                class="button-plus inc button">
                                                        </div>
                                                    </div>
   </td>`
                newRow += `<td class="d-none"><input type="text" id="` + rowindex +
                    `" name="prixvente_lignevente[]" value="` + prixvente_produit +
                    `" class="form-control-plaintext prixvente_lignevente border-0" readonly/></td>`
                newRow += `<td><input type="text" id="` + rowindex +
                    `" name="soustotal_lignevente[]" class="form-control-plaintext soustotal_lignevente border-0" value="` +
                    getSubtotal(prixvente_produit, 1) + `" readonly/></td>`
                newRow += `<td>
                              <a class="remove"><img src="assets/img/icons/delete.svg" style="width: 40px;" alt="svg"></a>
                          </td>`
                newRow += `</tr>`;
                $("table#tablecard tbody").append(newRow);
                var a = document.getElementById("tablecard");
                var rows = a.rows.length;
                $('#countarticle').text(rows);
                totalVente();

            })
            var path = "{{ route('ventes.rechercheproduit') }}";
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
                    var newRow = `<tr class="product-lists">`
                    newRow += `<td class="productimgname">
                            <input type="text" id="` + rowindex + `" value="` + ui.item.label + `" class="form-control-plaintext border-0" readonly/>
                            <input type="hidden" id="` + rowindex +
                        `" class="produit_id" name="produit_id[]" value="` + ui.item.value + `" />
                          </td>`
                    newRow += `<td> <div class="increment-decrement">
                                                        <div class="input-groups">
                                                            <input type="button" value="-"
                                                                class="button-minus dec button">
                                                            <input type="text" name="quantite_lignevente[]" value="1"
                                                                class="quantity-field quantite_lignevente">
                                                            <input type="button" value="+"
                                                                class="button-plus inc button">
                                                        </div>
                                                    </div>
   </td>`
                    newRow += `<td class="d-none"><input type="text" id="` + rowindex +
                        `" name="prixvente_lignevente[]" value="` + ui.item.prix +
                        `" class="form-control-plaintext prixvente_lignevente border-0" readonly/></td>`
                    newRow += `<td><input type="text" id="` + rowindex +
                        `" name="soustotal_lignevente[]" class="form-control-plaintext soustotal_lignevente border-0" value="` +
                        getSubtotal(ui.item.prix, 1) + `" readonly/></td>`
                    newRow += `<td>
                              <a class="remove"><img src="assets/img/icons/delete.svg" style="width: 40px;" alt="svg"></a>
                          </td>`
                    newRow += `</tr>`;
                    $("table#tablecard tbody").append(newRow);
                    $('#lims_productcodeSearch').val('');
                    totalVente();
                    var a = document.getElementById("tablecard");
                    var rows = a.rows.length;
                    $('#countarticle').text(rows);
                    return false;
                }

            });
        })

        function tableclear() {
            $('#tablecard').empty()
            $('.total_vente').val(0);
            var a = document.getElementById("tablecard");
            var rows = a.rows.length;
            $('#countarticle').text(rows);

        }
        $('table#tablecard tbody').delegate('.remove', 'click', function() {
            //var l = $('tbody tr').length;
            $(this).parent().parent().remove();

            var a = document.getElementById("tablecard");
            var rows = a.rows.length;
            $('#countarticle').text(rows);
            var totalVente = 0;
            $('.soustotal_lignevente').each(function(i, e) {
                var soustotal = $(this).val() - 0;
                totalVente += soustotal;
            })
            $('.total_vente').val(totalVente);


            // if (l == 0) {
            //      alert('Vous etes sur de Supprimer')
            //  } else {

            // }
        })
    </script>

@endsection
