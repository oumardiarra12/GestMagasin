<!doctype html>
<html lang="fr">
@php
    $company = DB::table('companies')->first();
@endphp

<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url('/logosociete/' . $company->company_logo) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />

    <!-- CSS notify-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />


    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    @yield('style')
</head>

<body>
    <!--begin::Loader-->
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
    <!--end::Loader-->

    <!--begin::Main-->
    <div class="main-wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

        <div class='page-wrapper'>
            <div class='content'>
                {{-- @include('component.message') --}}
                @include('layouts.partials.toolbar')
                @yield('content')
            </div>
        </div>
    </div>
    <!--end::Main-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.valiadate.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script> --}}

    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>


    {{-- form erros --}}
    @if ($errors->any())
        <script>
            if (document.getElementById('modal_add')) {
                document.getElementById('modal_add').click();
            }
        </script>
    @endif

    {{-- error --}}
    @if ($message = Session::get('error'))
        <script>
            let message = {!! json_encode($message) !!}
            $(document).ready(function() {
                $(document).ready(function() {
                    notify(message);
                });
            });
        </script>
    @endif

    {{-- notify --}}
    <script>
        function notify(message, status = "error") {
            new Notify({
                status: status,
                title: '',
                text: message,
                effect: 'slide',
                speed: 500,
                customClass: '',
                customIcon: '',
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 3000,
                gap: 20,
                distance: 20,
                type: 3,
                position: 'right top'
            })
        }
    </script>
    @yield('script')

    {{-- Delete confimed --}}
    <script>
        $('.delete-item').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer cet élément ?',
                text: 'Cette action est irréversible !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Supprimer',
                confirmButtonColor: "#d33",
                cancelButtonText: 'Annuler',
                cancelButtonColor: "#D5D5D5",
            }).then((result) => {
                if (result.value) {
                    e.currentTarget.submit();
                }
            })
        });
    </script>
    {{-- Notification success --}}
    {{-- @if (session('notification.type') == 'success')
        <script>
            Swal.fire({
                title: "{!! session('notification.message') !!}",
                text: "Voulez-vous assigner des parents ou tuteurs à l'étudiant ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                confirmButtonColor: "#d33",
                cancelButtonText: 'Non',
                cancelButtonColor: "#D5D5D5",
            })
            .then((result) => {
                if (result.value) {

                } else {

                }
            })
        </script> --}}
    @if (session('notification.type') == 'success')
        <script type="text/javascript">
            Swal.fire({
                title: "Tâche effectuée!",
                text: "{!! session('notification.message') !!}",
                icon: "success",
                button: "OK",
                buttonColor: '#8CD4F5',
            });
        </script>
    @endif
    @if (session('notification.type') == 'warning')
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('notification.message') }}");
        </script>
    @endif
</body>

</html>
