@extends('layouts.master')
@section('title', 'Gestion Utilisateur')

@section('title_toolbar', 'La liste des Utilisateurs')
@section('subtitle_toolbar', 'Gestion des Utilisateurs')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('utilisateur.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Utilisateur
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

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" name="firstname" id="firstname" onkeyup="searchFirstname()"
                                    placeholder="Entre le Nom" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" id="telephone" onkeyup="searchTelephone()"
                                    placeholder="Entre le Telephone" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select" id="categorie" onchange="searchCategorie()">
                                    <option selected disabled hidden>----</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->nom_categorie }}">{{ $categorie->nom_categorie }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                        alt="img" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="userTable">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Numéro</th>
                            <th>Email</th>
                            <th>Categorie</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nom_user }}</td>
                                <td>{{ $user->prenom_user }}</td>
                                <td>{{ $user->telephone_user }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->Categorie->nom_categorie }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        {{-- <li>
                                            <a href="{{ route('utilisateur.show', $user->id) }}" class="dropdown-item"><img
                                                    src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li> --}}
                                        <li>
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $user->id }}"
                                                class="dropdown-item editUser"><img src="assets/img/icons/edit.svg"
                                                    class="me-2" alt="img" />Éditer</a>
                                        </li>
                                        <li>
                                            <form class="delete-item d-inline" method="post"
                                                action="{{ route('utilisateur.delete', $user->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item">
                                                    <img src="assets/img/icons/delete1.svg" class="me-2" alt="img" />
                                                    <input style="border:none;background:transparent" type="submit"
                                                        value="Supprimer">
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="createusermodel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modelHeading"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <form method="POST" id="userForm" name="userForm"
                            action="{{ route('utilisateur.update', $user->id) }}" enctype="multipart/form-data"
                            id="userform">
                            @method('put')
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
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Nom</label>
                                            <input type="text" name="nom_user" id="nom_user">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Categorie</label>
                                            <select class="js-example-basic-single select2" name="categorie_id"
                                                id="categorie_id">
                                                <option value="">Selectionner</option>
                                                @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Mot de Passe</label>
                                            <div class="pass-group">
                                                <input type="password" class="pass-input" name="password"
                                                    id="password">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                            <span class="btn btn-danger" onclick="generatePass()">Generer le Mot de
                                                Passe</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Prenom</label>
                                            <input type="text" name="prenom_user" id="prenom_user">
                                        </div>
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <div class="pass-group">
                                                <input type="text" name="telephone_user" id="telephone_user">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Adresse</label>
                                            <div class="pass-group">
                                                <input type="text" name="adresse_user" id="adresse_user">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="selectImage" class="btn text-white btn-warning me-2">Choisir Image
                                                <i class="fa fa-camera" data-bs-toggle="tooltip"
                                                    title="fa fa-camera"></i> </label>
                                            <input type="file" style="display: none;" class="form-control"
                                                name="photo_user" @error('photo_user') is-invalid @enderror
                                                id="selectImage" accept=".jpg, .jpeg .svg">
                                            <div class="image-uploads">
                                                <img id="preview" src="#" alt="your image" class="mt-3"
                                                    style="display:none;max-height: 250px;" accept=".jpg, .jpeg .svg" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" id="savedata" class="btn btn-submit"
                                    value="create">Submit</button>
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
    <script>
        function searchFirstname() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("firstname");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
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

        function searchTelephone() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("telephone");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
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

        function searchCategorie() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("categorie");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[5];
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
    </script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.editUser', function() {
                var id = $(this).data('id');
                var url = "{{ route('utilisateur.edit', ['id' => ':id']) }}"
                url = url.replace(':id', id);
                $.get(url, function(data) {
                    console.log(data.user.photo_user)
                    $('#modelHeading').html("Edit Utilisateur");
                    $('#savedata').val("edit-user");
                    $('#createusermodel').modal('show');
                    $('#id').val(data.user.id);
                    $('#nom_user').val(data.user.nom_user);
                    $('#prenom_user').val(data.user.prenom_user);
                    $('#telephone_user').val(data.user.telephone_user);
                    $('#adresse_user').val(data.user.adresse_user);
                    $('#email').val(data.user.email);
                    $('#selectImage input[type=file]').val(data.user.photo_user);
                    preview = document.getElementById('preview');
                    preview.style.display = 'block';
                    $('#preview').attr('src', '/storage/users/' + data.user.photo_user);
                    $('#categorie_id').val(data.user.categorie_id).change();
                })
            });

            //$('#preview').attr('src','/storage/users/'+"userdefault.jpg");
            $('#savedata').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                var id = $('#id').val();
                console.log(id)
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "/utilisateur/update/" + id,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#userForm').trigger("reset");
                        $('#createusermodel').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Utilisateur a ete modifier success',
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
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                console.log(preview.src)
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        function generatePass() {
            // change 12 to the length you want the hash
            let randomPasswordHash = (Math.random().toString().substr(2, 6));

            $('#password').val(randomPasswordHash);
        }
    </script>
@endsection
