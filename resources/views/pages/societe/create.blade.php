@extends('layouts.master')
@section('title', 'Gestion Societe')

@section('title_toolbar', 'Societe')
@section('subtitle_toolbar', 'Gestion des Societe')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('societes.store') }}" id="form"  enctype="multipart/form-data">
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
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nom de Societe <span class="manitory">*</span></label>
                            <input type="text" name="nom_societe" value="{{$societe->nom_societe}}" placeholder="Nom de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Activite de Societe</label>
                            <input type="text" name="activite_societe" value="{{$societe->activite_societe}}" placeholder="Activite de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telephone Societe <span class="manitory">*</span></label>
                            <input type="text" name="tel_societe" value="{{$societe->tel_societe}}" placeholder="Telephone de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>NIF Societe<span class="manitory">*</span></label>
                            <input type="text" name="nif_societe" value="{{$societe->nif_societe}}" placeholder="NIF de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telephone Societe<span class="manitory">*</span></label>
                            <input type="text" name="bp_societe" value="{{$societe->bp_societe}}" placeholder="BP de Societe">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Addresse Societe<span class="manitory">*</span></label>
                            <textarea class="form-control" name="adresse" id="adresse">{{$societe->adresse}}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <div class="image-uploads">
                                <img id="preview" src="#" alt="your image" class="mt-3"
                                    style="display:none;max-height: 250px;" />
                            </div>
                            <label for="selectImage"  class="btn text-white btn-warning me-2" >Choisir Logo <i class="fa fa-camera" data-bs-toggle="tooltip" title="fa fa-camera"></i> </label>
                            <input type="file" style="display: none;" class="form-control" name="logo_societe"
                                @error('logo_societe') is-invalid @enderror id="selectImage">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('home')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
