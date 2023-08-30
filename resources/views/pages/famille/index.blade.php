@extends('layouts.master')
@section('title', 'Gestion Categorie')

@section('title_toolbar', 'La liste des Categories')
@section('subtitle_toolbar', 'Gestion des Categories')

@section('btn_add_item')
    <div class="page-btn">
        <a href="javascript:void(0)" class="btn btn-added" id="newfamillemodel">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Categorie
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
                            <img src="assets/img/icons/filter.svg" alt="img" />
                            <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img" /></a>
                    </div>
                </div>
                {{-- <div class="wordset">
                <ul>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                src="assets/img/icons/pdf.svg" alt="img" /></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                src="assets/img/icons/excel.svg" alt="img" /></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                src="assets/img/icons/printer.svg" alt="img" /></a>
                    </li>
                </ul>
            </div> --}}
            </div>

            {{-- <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                        alt="img" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="table-responsive">
                <table class="table  datanew">
                    <thead>
                        <tr>

                            <th>ID</th>
                            <th>Nom</th>
                            <th>Creer Par</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($familles as $famille)
                            <tr>
                                <td>{{ $famille->id }}</td>
                                <td>{{ $famille->nom_famille }}</td>
                                <td>{{ $famille->user->nom_user }} {{ $famille->user->prenom_user }}</td>
                                <td>
                                    <a class="me-3 editFamille" href="javascript:void(0)" data-toggle="tooltip"
                                        data-id="{{ $famille->id }}">
                                        <img src="assets/img/icons/edit.svg" alt="img">
                                    </a>

                                    <form class="delete-item d-inline confirm-text" method="post"
                                            action="{{ route('categories.delete', $famille->id) }}">
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
            <div class="modal fade" id="createfamillemodel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modelHeading"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>

                        <form id="familleForm" name="familleForm">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" name="nom_famille" id="nom_famille">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" id="description_famille" name="description_famille"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" id="savedata" class="btn btn-submit" value="create">Submit</button>
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        //   $("#familleForm").validate({
        //             rules: {
        //                 nom_famille: "required",
        //             },

        //         })
        $(function() {
            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#newfamillemodel').click(function() {
                $('#savedata').val("create-product");
                $('#id').val('');
                $('#familleForm').trigger("reset");
                $('#modelHeading').html("Nouveau Categorie");
                $('#createfamillemodel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editFamille', function() {
                var id = $(this).data('id');
                var url = "{{ route('categories.edit', ['id' => ':id']) }}"
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    $('#modelHeading').html("Edit Categorie");
                    $('#savedata').val("edit-user");
                    $('#createfamillemodel').modal('show');
                    $('#id').val(data.id);
                    $('#nom_famille').val(data.nom_famille);
                    $('#description_famille').val(data.description_famille);
                })
            });

            /*------------------------------------------
            --------------------------------------------
            Create Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('#savedata').click(function(e) {
                e.preventDefault();
                var data = $('#familleForm').serialize();
                $(this).html('Sending..');
                $.ajax({
                    url: "{{ route('categories.store') }}",
                    data: data,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#familleForm').trigger("reset");
                        $('#createfamillemodel').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'OPeration a ete effectuer avec success',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        location.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data.responseJSON.errors);
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

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/


        });
    </script>
@endsection
