@extends('layouts.master')
@section('title', 'Gestion Retour Achat')

@section('title_toolbar', 'La liste des Retours Achats')
@section('subtitle_toolbar', 'Gestion des Retours Achats')


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
                            <a href="{{ route('retourachats.exporttable') }}" data-bs-toggle="tooltip" data-bs-placement="top"
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
                <table class="table datanew" id="tableachat">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Fournisseur</th>
                            <th>Ref. Achat</th>
                            <th>Ref. Retour Achat</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($achatretours as $achatretour)
                            <tr>
                                <td>{{$achatretour->date_retour_achat}}</td>
                                <td class="text-bolds">{{ $achatretour->achat->fournisseur->nom_fournisseur }}
                                    {{ $achatretour->achat->fournisseur->prenom_fournisseur }}</td>
                                <td>{{ $achatretour->achat->num_achat }}</td>
                                <td>{{ $achatretour->num_retour_achat }}</td>
                                <td>{{ $achatretour->total_retour_achat }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('retourachats.show', $achatretour->id) }}" class="dropdown-item detailachat"><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Retour Achat</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('retourachats.edit', $achatretour->id) }}"
                                                class="dropdown-item editachat"><img src="assets/img/icons/edit.svg"
                                                    class="me-2" alt="img">Edit
                                                Retour Achat</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('retourachats.exportretourachat', $achatretour->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download pdf</a>
                                        </li>
                                        <li>
                                            <form class="delete-item d-inline" method="post"
                                                action="{{ route('retourachats.delete', $achatretour->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item">
                                                    <img src="assets/img/icons/delete1.svg" class="me-2"
                                                        alt="img" />
                                                    <input style="border:none;background:transparent" type="submit"
                                                        value="Delete Retour Achat">
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
