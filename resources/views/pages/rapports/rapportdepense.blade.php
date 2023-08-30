@extends('layouts.master')
@section('title', 'Gestion Depense')

@section('title_toolbar', 'Rapport des Depenses')
@section('subtitle_toolbar', 'Gestion des Depenses')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('depenses.index') }}" class="btn btn-outline-warning"><img
            src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-top">
                {{-- <div class="search-set">
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
                            <a href="{{ route('achats.achatpdf') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                    </ul>
                </div> --}}


            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                    <form action="{{ route('rapports.rapportdepenses') }}" method="get">
                        <div class="row">
                           <div class="col-md-5 form-group">
                               <label for="">Date Debut</label>
                               <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
                            </div>
                            <div class="col-md-5 form-group">
                               <label for="">Date Fin</label>
                               <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
                            </div>
                            <div class="col-md-2 form-group" style="margin-top:25px;">
                               <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>
                   </form>
                </div>
                {{-- <div class="col-lg-6 col-sm-6 col-12 d-flex align-items-center justify-content-end">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"
                    href="{{ route('rapports.rapportachatpdf') }}"><img src="assets/img/icons/pdf.svg"
                        alt="img"></a>
                </div> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-nowrap mb-0" id="tableachat">
                    <thead>
                        <tr>
                            <th>Type de Depense</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depenserapports as $depenserapport)
                            <tr>
                                <td class="text-bolds">{{ $depenserapport->categoriedepense->nom_categorie_depense }}</td>
                                <td>{{ $depenserapport->num_depense }}</td>
                                <td>{{  $depenserapport->date_depense }}</td>
                                <td class="totalachat">{{  $depenserapport->total_depense }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0)"  data-id="{{ $depenserapport->id }}" class="dropdown-item detaildepense"
                                                ><img src="assets/img/icons/eye1.svg"
                                                    class="me-2 " alt="img">Detail Depense</a>
                                        </li>
                                        {{-- <li>
                                            <a href="{{ route('depenses.depensepdf', $depenserapport->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/download.svg"
                                                    class="me-2" alt="img">Download pdf</a>
                                        </li> --}}
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot align="right">
                        <tr>
                            <td>Total:</td><td></td><td></td><td></td><td class="totalachat"></td>
                        </tr>
                    </tfoot>
                </table>
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
        {{-- fin Depense  --}}
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
            });
    </script>
@endsection

