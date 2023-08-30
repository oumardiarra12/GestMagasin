@extends('layouts.master')
@section('title', 'Gestion Depense')

@section('title_toolbar', 'La liste des Depenses')
@section('subtitle_toolbar', 'Gestion des Depenses')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('depenses.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Depense
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
                                href="{{ route('depenses.depensepdf') }}"><img src="assets/img/icons/pdf.svg"
                                    alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"
                                href="{{ route('depenses.export') }}"><img src="assets/img/icons/excel.svg"
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
                                            @foreach ($categoriedepenses as $categoriedepense)
                                                <option value="{{ $categoriedepense->nom_categorie_depense }}">{{ $categoriedepense->nom_categorie_depense  }}
                                                </option>
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
                <table class="table  datanew" id="tableDepense">
                    <thead>
                        <tr>
                            <th>Ref Depense</th>
                            <th>Categorie </th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Creer Par</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depenses as $depense)
                            <tr>
                                <td>
                                    {{ $depense->num_depense }}
                                </td>
                                <td>{{ $depense->categoriedepense->nom_categorie_depense }} </td>
                                <td>{{ $depense->date_depense }}</td>
                                <td>{{ $depense->total_depense }}</td>
                                <td>{{ $depense->user->nom_user }} {{ $depense->user->prenom_user }}</td>
                                <td>
                                    <a class="me-3 detaildepense" href="javascript:void(0)" data-toggle="tooltip"
                                        data-id="{{ $depense->id }}">
                                        <img src="assets/img/icons/eye.svg" alt="img">
                                    </a>
                                    <a class="me-3 editdepense" href="javascript:void(0)" data-toggle="tooltip"
                                        data-id="{{ $depense->id }}">
                                        <img src="assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <form class="delete-item d-inline confirm-text" method="post"
                                        action="{{ route('depenses.delete', $depense->id) }}">
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
        <div class="modal fade" id="editdepensemodel" aria-hidden="true">
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
                    <form id="editdepense">
                        <div class="row p-2">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Reference</label>
                                    <input type="text"  name="num_depense"
                                        id="num_depense" readonly>
                                </div>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Reference</label>
                                    <input type="date" placeholder="Saisir la date de Depense" name="date_depense"
                                        id="date_depense" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Categorie</label>
                                    <select class="placeholder js-states form-control" name="categorie_depense_id" id="categorie_depense_id">
                                        <option selected="true" disabled="disabled">Categorie</option>
                                        @foreach ($categoriedepenses as $categoriedepense)
                                            <option value="{{ $categoriedepense->id }}">{{ $categoriedepense->nom_categorie_depense }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Montant de Depense</label>
                                    <input type="text" id="total_depense" name="total_depense"
                                        placeholder="Saisir le Montant">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" name="note_depense" id="note_depense"></textarea>
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
        {{-- detail Depense --}}
        <div class="modal fade" id="detaildepensemodel" aria-hidden="true">
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
                                    <div class="productdetails">
                                        <ul class="product-bar">
                                            <li>
                                                <h4>Reference</h4>
                                                <h6 id="num_depenseshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Categorie</h4>
                                                <h6 id="categorie_depense_idshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Le Montant de Depense</h4>
                                                <h6 id="total_depenseshow"></h6>
                                            </li>
                                            <li>
                                                <h4>Date de Depense</h4>
                                                <h6 id="date_depenseshow"></h6>
                                            </li>

                                            <li>
                                                <h4>Saisir Par </h4>
                                                <h6 id="usershow"></h6>
                                            </li>
                                            <li>
                                                <h4>Note</h4>
                                                <h6 id="note_depenseshow"></h6>
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
                table = document.getElementById("tableDepense");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
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
                // Edit Depense
                $('body').on('click', '.editdepense', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('depenses.edit', ['id' => ':id']) }}"
                    url = url.replace(':id', id);
                    $.get(url, function(data) {
                        console.log(data);
                        $('#modelHeading').html("Edit Depense");
                        $('#savedata').val("edit-user");
                        $('#editdepensemodel').modal('show');
                        $('#id').val(data.id);
                        $('#num_depense').val(data.num_depense);
                        $('#date_depense').val(data.date_depense);
                        $('#total_depense').val(data.total_depense);
                        $('#note_depense').val(data.note_depense);
                        $('#categorie_depense_id').val(data.categorie_depense_id).change();
                    })
                });
                // Deatil Depense
                $('body').on('click', '.detaildepense', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('depenses.show', ['id' => ':id']) }}"
                    url = url.replace(':id', id);

                    $.get(url, function(data) {
                        console.log(data);
                        $('#modelHeadingshow').html("Detail Depense");
                        $('#savedata').val("edit-user");
                        $('#detaildepensemodel').modal('show');
                        $('#idshow').text(data.id);
                        $('#num_depenseshow').text(data[0].num_depense);
                        $('#date_depenseshow').text(data[0].date_depense);
                        $('#total_depenseshow').text(data[0].total_depense);
                        $('#note_depenseshow').text(data[0].note_depense);
                        $('#categorie_depense_idshow').text(data[0].categoriedepense.nom_categorie_depense);
                        $('#usershow').text(data[0].user.nom_user + '  ' + data[0].user
                            .prenom_user);
                    })
                });

                //$('#preview').attr('src','/storage/users/'+"userdefault.jpg");
                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $(this).html('Sending..');
                    var id = $('#id').val();
                    console.log(id)
                    $.ajax({
                        data: $('#editdepense').serialize(),
                        url: "/depenses/update/" + id,
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#editdepense').trigger("reset");
                            $('#editdepensemodel').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Depense a ete modifier success',
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
