@extends('layouts.master')
@section('title', 'Gestion Retour Vente')

@section('title_toolbar', 'La liste des Retours Ventes')
@section('subtitle_toolbar', 'Gestion des Retours Ventes')


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    {{-- <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="assets/img/icons/filter.svg" alt="img">
                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                        </a>
                    </div> --}}
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{ route('retourventes.exporttable') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="tablevente">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Ref. Vente</th>
                            <th>Ref. Retour Vente</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venteretours as $venteretour)
                            <tr>
                                <td>{{$venteretour->date_retourvente}}</td>
                                <td class="text-bolds">{{ $venteretour->vente->client->nom_client }}
                                    {{ $venteretour->vente->client->prenom_client }}</td>
                                <td>{{ $venteretour->vente->num_vente }}</td>
                                <td>{{ $venteretour->num_retourvente }}</td>
                                <td>{{ $venteretour->total_retourvente }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('retourventes.show', $venteretour->id) }}" class="dropdown-item detailachat"><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Retour Vente</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('retourventes.edit', $venteretour->id) }}"
                                                class="dropdown-item editvente"><img src="assets/img/icons/edit.svg"
                                                    class="me-2" alt="img">Edit
                                                Retour Vente</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('retourventes.exportretourvente', $venteretour->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download pdf</a>
                                        </li>
                                        <li>
                                            <form class="delete-item d-inline" method="post"
                                                action="{{ route('retourventes.delete', $venteretour->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item">
                                                    <img src="assets/img/icons/delete1.svg" class="me-2"
                                                        alt="img" />
                                                    <input style="border:none;background:transparent" type="submit"
                                                        value="Delete Retour Vente">
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
        </div>




    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>



    </script>
@endsection
