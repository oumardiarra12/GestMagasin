@extends('layouts.auth')
@section('style')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
@endsection
@section('content')
    <div class="login-wrapper">
        <div class="login-content">
            <div class="login-userset">
                {{-- <div class="login-logo">
                    <img src="assets/img/logo.png" alt="img">
                </div> --}}
                <div class="login-userheading">
                    <h3>Connectez-vous</h3>
                    {{-- <h4>Please login to your account</h4> --}}
                </div>
                @error('email')
                    <!--end::Input group-->
                    <div class="alert alert-danger" role="alert">
                        Les informations fournit ne correspondent pas ! <br> Veuillez réessayer s'il vous plait
                    </div>
                    <!--begin::Actions-->
                @enderror
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"  method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-login">
                        <label>Adresse email</label>
                        <div class="form-addons">
                            <input type="text" name="email" value = "{{ old('email') }}" placeholder="Adresse email">
                            <img src="assets/img/icons/mail.svg" alt="img">
                        </div>
                    </div>
                    <div>
                        @error('email')
                            <div class="text-danger mb-3">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-login">
                        <label>Mot de passe</label>
                        <div class="pass-group">
                            <input name="password" type="password" class="pass-input" placeholder="Mot de passe">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                    <div>
                        @error('password')
                            <div class="text-danger mb-3">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-login">
                        <div class="alreadyuser">
                            @if (Route::has('password.request'))
                                <h4><a href="{{ route('password.request') }}" class="hover-a">Mot de passe oublié ?</a></h4>
                            @endif
                        </div>
                    </div>
                    <div class="form-login">
                        <input type="submit" style="padding: 0px" class="btn btn-login" value="Se connecter"/>
                    </div>
                </form>
                {{-- <div class="signinform text-center">
                    <h4>Don’t have an account? <a href="#" class="hover-a">Se Connecte</a></h4>
                </div> --}}

            </div>
        </div>
        <div class="login-img">
            <img src="assets/img/login.jpg" alt="img">
        </div>
    </div>
@endsection
