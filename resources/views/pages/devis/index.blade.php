@extends('layouts.master')
@section('title', 'Gestion Devis')

@section('title_toolbar', 'La liste des Devis')
@section('subtitle_toolbar', 'Gestion des Devis')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('devis.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Devis
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
                            <a href="{{ route('devis.exporttable') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg col-sm-6 col-12">
                            <div class="form-group">
                                <input type="date" onchange="searchdatadevis()" class="" placeholder="Choisir Date"
                                    id="date_devis">
                            </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                            <div class="form-group">
                                <select class="placeholder js-states form-control" name="status_devis"
                                    id="status_devis" onchange="searchstatusdevis()">
                                    <option selected="true" disabled="disabled">Choisir Status Devis</option>
                                    <option value="non accepter">Non Accepter</option>
                                    <option value="accepter">Accepter</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                            <div class="form-group">
                                <select class="placeholder js-states form-control" name="client_id" id="client_id"
                                    onchange="searchclient()">
                                    <option selected="true" disabled="disabled">Choisir Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->nom_client }}">
                                            {{ $client->nom_client }} {{ $client->prenom_client }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="tabledevis">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devis as $devis)
                            <tr>
                                <td class="text-bolds">{{ $devis->client->nom_client }}
                                    {{ $devis->client->prenom_client }}</td>
                                <td>{{ $devis->num_devis }}</td>
                                <td>{{ $devis->date_devis }}</td>
                                <td>{{ $devis->total_devis }}</td>
                                <td>
                                    @if ($devis->status_devis == 'non accepter')
                                        <span class="badges bg-lightred">Non Accepter</span>
                                    @else
                                        <span class="badges bg-lightgreen">Accepter</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('devis.show', $devis->id) }}" class="dropdown-item detaildevis"
                                                ><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Devis</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('devis.edit', $devis->id) }}"
                                                class="dropdown-item editdevis"><img src="assets/img/icons/edit.svg"
                                                    class="me-2" alt="img">Edit
                                                    Devis</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('devis.createvente', $devis->id) }}" class="dropdown-item creerpaiement"
                                               ><img src="assets/img/icons/plus-circle.svg"
                                                    class="me-2" alt="img">Creer Vente</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('devis.exportdevis', $devis->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download pdf</a>
                                        </li>
                                        <li>
                                            <form class="delete-item d-inline" method="post"
                                                action="{{ route('devis.delete', $devis->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item">
                                                    <img src="assets/img/icons/delete1.svg" class="me-2"
                                                        alt="img" />
                                                    <input style="border:none;background:transparent" type="submit"
                                                        value="Delete Devis">
                                                </button>
                                            </form>

                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot align="right">
                        <tr>
                            <td>Total:</td><td></td><td></td><td></td><td class="totalvente"></td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        // debut de Recherche
        function searchdatadevis() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("date_devis");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabledevis");
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

        function searchstatusdevis() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("status_devis");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabledevis");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
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

        function searchclient() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("client_id");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabledevis");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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
@endsection
