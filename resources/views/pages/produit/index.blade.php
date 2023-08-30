@extends('layouts.master')
@section('title', 'Gestion Produit')

@section('title_toolbar', 'La liste des Produits')
@section('subtitle_toolbar', 'Gestion des Produits')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('produits.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Produit
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
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"
                                href="{{ route('produits.produitpdf') }}"><img src="assets/img/icons/pdf.svg"
                                    alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"
                                href="{{ route('produits.export') }}"><img src="assets/img/icons/excel.svg"
                                    alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="placeholder js-states form-control" id="categorie"
                                            onchange="searchCategorie()">
                                            <option>Categorie</option>
                                            @foreach ($familles as $famille)
                                                <option value="{{ $famille->nom_famille }}">{{ $famille->nom_famille }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="placeholder js-states form-control" id="unite"
                                            onchange="searchUnite()">
                                            <option>Unite</option>
                                            @foreach ($unites as $unite)
                                                <option value="{{ $unite->nom_unite }}">{{ $unite->code_unite }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                                alt="img"></a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table  datanew" id="tableProduit">
                    <thead>
                        <tr>
                            <th>Nom Produit</th>
                            <th>Categorie </th>
                            <th>Unite</th>
                            <th>prix Vente</th>
                            <th>Stock Actuel</th>
                            <th>Creer Par</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr>
                                <td>
                                    {{ $produit->nom_produit }}
                                </td>
                                <td>{{ $produit->famille->nom_famille }} </td>
                                <td>{{ $produit->unite->code_unite }}</td>
                                <td>{{ $produit->prixvente_produit }}</td>
                                <td>{{ $produit->stockactuel }}</td>
                                <td>{{ $produit->user->nom_user }} {{ $produit->user->prenom_user }}</td>
                                <td>
                                    <a class="me-3 detailproduit" href="javascript:void(0)" data-toggle="tooltip"
                                        data-id="{{ $produit->id }}">
                                        <img src="assets/img/icons/eye.svg" alt="img">
                                    </a>
                                    <a class="me-3 editproduit" href="javascript:void(0)" data-toggle="tooltip"
                                        data-id="{{ $produit->id }}">
                                        <img src="assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <form class="delete-item d-inline confirm-text" method="post"
                                        action="{{ route('produits.delete', $produit->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-rounded btn-light">
                                            <img src="assets/img/icons/delete.svg" alt="img">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="editproduitmodel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form id="editproduit">
                        <div class="row p-2">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" placeholder="Saisir le Nom de Produit" name="nom_produit"
                                        id="nom_produit">
                                </div>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Reference</label>
                                    <input type="text" placeholder="Saisir la Reference de Produit" name="ref_produit"
                                        id="ref_produit" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Categorie</label>
                                    <select class="placeholder js-states form-control" name="famille_id" id="famille_id">
                                        <option selected="true" disabled="disabled">Categorie</option>
                                        @foreach ($familles as $famille)
                                            <option value="{{ $famille->id }}">{{ $famille->nom_famille }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Unite</label>
                                    <select class="placeholder js-states form-control" name="unite_id" id="unite_id">
                                        <option selected="true" disabled="disabled">Unite</option>
                                        @foreach ($unites as $unite)
                                            <option value="{{ $unite->id }}">{{ $unite->code_unite }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Code Barre</label>
                                    <input type="text" id="codebarre" name="codebarre"
                                        placeholder="Saisir le Code Barre">
                                    <span class="input-group-text" id="basic-addon2"
                                        onclick="generateCodeBarre()">Generer Code Barre</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Stock Min</label>
                                    <input type="text" name="stockmin" id="stockmin">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Stock Actuel</label>
                                    <input type="text" name="stockactuel" id="stockactuel" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Prix Achat</label>
                                    <input type="text" name="prixachat_produit" id="prixachat_produit">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Prix Vente</label>
                                    <input type="text" name="prixvente_produit" id="prixvente_produit">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_produit" id="description_produit"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" id="savedata">Submit</button>
                                <a href="productlist.html" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- detail produit --}}
        <div class="modal fade" id="detailproduitmodel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeadingshow"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="bar-code-view">
                                        <canvas id="codebarreshow"></canvas>
                                        {{-- <span id="codebarreshow"></span> --}}
                                        {{-- <a class="printimg">
                                            <img src="assets/img/icons/printer.svg" alt="print">
                                        </a> --}}
                                    </div>
                                    <div class="productdetails">
                                        <ul class="product-bar">
                                            <li>
                                                <h4>Produit</h4>
                                                <h6 id="nom_produitshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Categorie</h4>
                                                <h6 id="famille_idshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Unite</h4>
                                                <h6 id="unite_idshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Prix de Vente</h4>
                                                <h6 id="prixventeshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Prix d'Achat</h4>
                                                <h6 id="prixachatshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Reference</h4>
                                                <h6 id="referenceshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Stock Minimum</h4>
                                                <h6 id="stockminshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Stock Actuelle</h4>
                                                <h6 id="stockactuelshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Saisir Par </h4>
                                                <h6 id="usershow"></h6>
                                            </li>
                                            <li>
                                                <h4>Description</h4>
                                                <h6 id="descriptionshow"></h6>
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
    @endsection
    @section('script')
        <script>
            function searchCategorie() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("categorie");
                filter = input.value.toUpperCase();
                table = document.getElementById("tableProduit");
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

            function searchUnite() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("unite");
                filter = input.value.toUpperCase();
                table = document.getElementById("tableProduit");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[3];
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
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // Edit Produit
                $('body').on('click', '.editproduit', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('produits.edit', ['id' => ':id']) }}"
                    url = url.replace(':id', id);

                    $.get(url, function(data) {
                        console.log(data);
                        $('#modelHeading').html("Edit Produit");
                        $('#savedata').val("edit-user");
                        $('#editproduitmodel').modal('show');
                        $('#id').val(data.produit.id);
                        $('#ref_produit').val(data.produit.ref_produit);
                        $('#codebarre').val(data.produit.codebarre);
                        $('#nom_produit').val(data.produit.nom_produit);
                        $('#stockmin').val(data.produit.stockmin);
                        $('#stockactuel').val(data.produit.stockactuel);
                        $('#prixvente_produit').val(data.produit.prixvente_produit);
                        $('#prixachat_produit').val(data.produit.prixachat_produit);
                        $('#description_produit').val(data.produit.description_produit);
                        $('#famille_id').val(data.produit.famille_id).change();
                        $('#unite_id').val(data.produit.unite_id).change();
                    })
                });
                // Deatil Produit
                $('body').on('click', '.detailproduit', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('produits.show', ['id' => ':id']) }}"
                    url = url.replace(':id', id);

                    $.get(url, function(data) {
                        console.log(data);
                        $('#modelHeadingshow').html("Detail Produit");
                        $('#savedata').val("edit-user");
                        $('#detailproduitmodel').modal('show');
                        $('#idshow').text(data.produit.id);
                        $('#referenceshow').text(data.produit[0].ref_produit);
                        //$('#codebarreshow').text(data.produit[0].codebarre);
                        $('#nom_produitshow').text(data.produit[0].nom_produit);
                        $('#stockminshow').text(data.produit[0].stockmin);
                        $('#stockactuelshow').text(data.produit[0].stockactuel);
                        $('#prixventeshow').text(data.produit[0].prixvente_produit);
                        $('#prixachatshow').text(data.produit[0].prixachat_produit);
                        $('#descriptionshow').text(data.produit[0].description_produit);
                        $('#famille_idshow').text(data.produit[0].famille.nom_famille);
                        $('#unite_idshow').text(data.produit[0].unite.nom_unite);
                        $('#usershow').text(data.produit[0].user.nom_user + '  ' + data.produit[0].user
                            .prenom_user);
                        $("#codebarreshow").JsBarcode(
                            data.produit[0].codebarre

                        );
                    })
                });

                //$('#preview').attr('src','/storage/users/'+"userdefault.jpg");
                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $(this).html('Sending..');
                    var id = $('#id').val();
                    console.log(id)
                    $.ajax({
                        data: $('#editproduit').serialize(),
                        url: "/produits/update/" + id,
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#editproduit').trigger("reset");
                            $('#editproduitmodel').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Produit a ete modifier success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#savedata').html('Save Changes');
                            printErrorMsg(data.responseJSON.errors);
                        }
                    });
                });

                function printErrorMsg(msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function(key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    });
                }
            });
        </script>
    @endsection
