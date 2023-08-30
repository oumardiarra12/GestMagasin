@extends('layouts.master')
@section('title', 'Gestion Fournisseur')

@section('title_toolbar', 'La liste des Fournisseurs')
@section('subtitle_toolbar', 'Gestion des Fournisseurs')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Fournisseur
        </a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{route('fournisseurs.fournisseurpdf')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{route('fournisseurs.export')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="assets/img/icons/excel.svg" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table  datanew">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Addresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fournisseurs as $fournisseur)
                        <tr>
                            <td>
                               {{$fournisseur->nom_fournisseur}}
                            </td>
                            <td>{{$fournisseur->prenom_fournisseur}}</td>
                            <td>{{$fournisseur->email_fournisseur}}</td>
                            <td>{{$fournisseur->tel_fournisseur}}</td>
                            <td>{{$fournisseur->adresse_fournisseur}}</td>
                            <td>
                                <a class="me-3 editfournisseur" href="javascript:void(0)" data-toggle="tooltip"
                                data-id="{{ $fournisseur->id }}">
                                    <img src="assets/img/icons/edit.svg" alt="img">
                                </a>
                                <form class="delete-item d-inline confirm-text" method="post"
                                        action="{{ route('fournisseurs.delete', $fournisseur->id) }}">
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
        {{-- edit fournisseur --}}
        <div class="modal fade" id="editfournisseurmodel" aria-hidden="true">
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
                    <div class="card">
                        <div class="card-body">
                            <form id="editfournisseur">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom_fournisseur" id="nom_fournisseur" placeholder="Saisir le Nom Fournisseur">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Prenom</label>
                                        <input type="text" name="prenom_fournisseur" id="prenom_fournisseur" placeholder="Saisir le Prenom Fournisseur">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email_fournisseur" id="email_fournisseur" placeholder="Saisir Email Fournisseur">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="tel_fournisseur" id="tel_fournisseur" placeholder="Saisir le Numero de Telephone Fournisseur">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="adresse_fournisseur" id="adresse_fournisseur" placeholder="Saisir l'Adresse Fournisseur">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description_fournisseur" id="description_fournisseur" class="form-control"></textarea>
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
                // Edit Produit
                $('body').on('click', '.editfournisseur', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('fournisseurs.edit', ['id' => ':id']) }}"
                    url = url.replace(':id', id);

                    $.get(url, function(data) {
                        console.log(data);
                        $('#modelHeading').html("Edit Fournisseur");
                        $('#savedata').val("edit-user");
                        $('#editfournisseurmodel').modal('show');
                        $('#id').val(data.fournisseur.id);
                        $('#nom_fournisseur').val(data.fournisseur.nom_fournisseur);
                        $('#prenom_fournisseur').val(data.fournisseur.prenom_fournisseur);
                        $('#email_fournisseur').val(data.fournisseur.email_fournisseur);
                        $('#tel_fournisseur').val(data.fournisseur.tel_fournisseur);
                        $('#adresse_fournisseur').val(data.fournisseur.adresse_fournisseur);
                        $('#description_fournisseur').val(data.fournisseur.description_fournisseur);
                    })
                });
                //$('#preview').attr('src','/storage/users/'+"userdefault.jpg");
                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $(this).html('Sending..');
                    var id = $('#id').val();
                    console.log(id)
                    $.ajax({
                        data: $('#editfournisseur').serialize(),
                        url: "/fournisseurs/update/" + id,
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#editfournisseur').trigger("reset");
                            $('#editfournisseurmodel').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Fournisseur a ete modifier success',
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
