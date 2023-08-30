@extends('layouts.master')
@section('title', 'Gestion Client')

@section('title_toolbar', 'La liste des Clients')
@section('subtitle_toolbar', 'Gestion des Clients')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('clients.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Client
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
                            <a href="{{route('clients.clientpdf')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{route('clients.export')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
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
                        @foreach ($clients as $client)
                        <tr>
                            <td>
                               {{$client->nom_client}}
                            </td>
                            <td>{{$client->prenom_client}}</td>
                            <td>{{$client->email_client}}</td>
                            <td>{{$client->tel_client}}</td>
                            <td>{{$client->adresse_client}}</td>
                            <td>
                                <a class="me-3 editclient" href="javascript:void(0)" data-toggle="tooltip"
                                data-id="{{ $client->id }}">
                                    <img src="assets/img/icons/edit.svg" alt="img">
                                </a>
                                <form class="delete-item d-inline confirm-text" method="post"
                                        action="{{ route('clients.delete', $client->id) }}">
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
        {{-- edit client --}}
        <div class="modal fade" id="editclientmodel" aria-hidden="true">
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
                            <form id="editclient">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom_client" id="nom_client" placeholder="Saisir le Nom Client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Prenom</label>
                                        <input type="text" name="prenom_client" id="prenom_client" placeholder="Saisir le Prenom Client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email_client" id="email_client" placeholder="Saisir Email Client">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="tel_client" id="tel_client" placeholder="Saisir le Numero de Telephone Client">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="adresse_client" id="adresse_client" placeholder="Saisir l'Adresse Client">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description_client" id="description_client" class="form-control"></textarea>
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
                $('body').on('click', '.editclient', function() {
                    var id = $(this).data('id');
                    var url = "{{ route('clients.edit', ['id' => ':id']) }}"
                    url = url.replace(':id', id);

                    $.get(url, function(data) {
                        console.log(data);
                        $('#modelHeading').html("Edit Client");
                        $('#savedata').val("edit-user");
                        $('#editclientmodel').modal('show');
                        $('#id').val(data.client.id);
                        $('#nom_client').val(data.client.nom_client);
                        $('#prenom_client').val(data.client.prenom_client);
                        $('#email_client').val(data.client.email_client);
                        $('#tel_client').val(data.client.tel_client);
                        $('#adresse_client').val(data.client.adresse_client);
                        $('#description_client').val(data.client.description_client);
                    })
                });
                //$('#preview').attr('src','/storage/users/'+"userdefault.jpg");
                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $(this).html('Sending..');
                    var id = $('#id').val();
                    console.log(id)
                    $.ajax({
                        data: $('#editclient').serialize(),
                        url: "/clients/update/" + id,
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#editclient').trigger("reset");
                            $('#editclientmodel').modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Client a ete modifier success',
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
