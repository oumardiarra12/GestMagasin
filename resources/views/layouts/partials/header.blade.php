<div class="header">

    <div class="header-left active">
        @can('admin')
        <a href="{{url('/')}}" class="logo" >
            <img src="{{ Storage::url('/logosociete/'.$societe->logo_societe) }}" style="height:60px;width:100px;" alt="logo">
        </a>
        @endcan
        @can('manager')
        <a href="{{url('/gerant')}}" class="logo" >
            <img src="{{ Storage::url('/logosociete/'.$societe->logo_societe) }}" style="height:60px;width:100px;" alt="logo">
        </a>
        @endcan
        @can('agent')
        <a href="{{url('/user')}}" class="logo" >
            <img src="{{ Storage::url('/logosociete/'.$societe->logo_societe) }}" style="height:60px;width:100px;" alt="logo">
        </a>
        @endcan
        @can('admin')
        <a href="index.html" class="logo-small">
            <img src="{{ Storage::url('/logosociete/'.$societe->logo_societe) }}" style="height:60px;width:100px;" alt="logo"  >
        </a>
        @endcan
        @can('manager')
        <a href="index.html" class="logo-small">
            <img src="{{ Storage::url('/logosociete/'.$societe->logo_societe) }}" style="height:60px;width:100px;" alt="logo"  >
        </a>
        @endcan
        @can('agent')
        <a href="index.html" class="logo-small">
            <img src="{{ Storage::url('/logosociete/'.$societe->logo_societe) }}" style="height:60px;width:100px;" alt="logo"  >
        </a>
        @endcan

        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">





        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('/storage/users/'.Auth::user()->photo_user) }}" alt="">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ asset('/storage/users/'.Auth::user()->photo_user) }}" alt="">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{Auth::user()->nom_user}} {{Auth::user()->prenom_user}}</h6>
                            <h5>{{Auth::user()->categorie->nom_categorie}}</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{route('profile')}}"> <i class="me-2" data-feather="user"></i> Mon Profil</a>
                    <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                            data-feather="settings"></i>Parametre</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{route('login.logout')}}"><img src="assets/img/icons/log-out.svg"
                            class="me-2" alt="img">Deconnection</a>
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>
            <a class="dropdown-item" href="signin.html">Logout</a>
        </div>
    </div>

</div>
