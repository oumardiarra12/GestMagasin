<!DOCTYPE html>
<html lang="en">
    @php
    $company = DB::table('companies')->first();
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Authentification - {{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url('/logosociete/'.$company->company_logo)}}">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.min.css">
    <style>
        .login-wrapper .login-content {
            margin: auto;
            background: #fff;
            border-radius: 15px;
            height: auto;
            box-shadow: 9px -8px 77px -20px rgba(0,0,0,0.50);
            -webkit-box-shadow: 9px -8px 77px -20px rgba(0,0,0,0.50);
            -moz-box-shadow: 9px -8px 77px -20px rgba(0,0,0,0.50);
        }
        @media (max-width: 991px){
            .login-wrapper .login-content {
                width: 80%;
                box-shadow: none !important;
                border-radius: 10px;
            }
        }
        @media (max-width: 480px){
            .login-wrapper .login-content {
                width: 100%;
                box-shadow: none !important;
                border-radius: none;
            }
        }

        .login-wrapper {
            overflow: auto;
        }

        .login-wrapper .login-img {
            display: none;
        }
    </style>
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            @yield('content')
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>
