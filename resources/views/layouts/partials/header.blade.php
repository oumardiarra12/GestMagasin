@php
    $company = DB::table("companies")->first();
@endphp
<div class="header">

    <div class="header-left active">
        @if (Auth::user()->CategoryUser->name_category_users==='admin')
        <a href="{{route('home.index')}}" class="logo">
            <img src="{{ Storage::url('/logosociete/'.$company->company_logo) }}" style="width: 60px; height:60px; border-radius: 50%;" alt="logo">
        </a>
        <a href="{{route('home.index')}}" class="logo-small">
            <img src="assets/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
        @endif
        @if (Auth::user()->CategoryUser->name_category_users==='gerant')
        <a href="{{route('home.homegerant')}}" class="logo">
            <img src="{{ Storage::url('/logosociete/'.$company->company_logo) }}" style="width: 60px; height:60px; border-radius: 50%;" alt="logo">
        </a>
        <a href="{{route('home.homegerant')}}" class="logo-small">
            <img src="assets/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
        @endif
        @if (Auth::user()->CategoryUser->name_category_users==='gestionnaire')
        <a href="{{route('home.user')}}" class="logo">
            <img src="{{ Storage::url('/logosociete/'.$company->company_logo) }}" style="width: 60px; height:60px; border-radius: 50%;" alt="logo">
        </a>
        <a href="{{route('home.user')}}" class="logo-small">
            <img src="assets/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
        @endif

    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">
        {{-- <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="assets/img/icons/notification-bing.svg" alt="img"> <span
                    class="badge rounded-pill">4</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">John Doe</span> added new task
                                            <span class="noti-title">Patient appointment booking</span></p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="assets/img/profiles/avatar-03.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed
                                            the task name <span class="noti-title">Appointment booking with payment
                                                gateway</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="assets/img/profiles/avatar-06.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Misty Tison</span> added
                                            <span class="noti-title">Domenic Houston</span> and <span
                                                class="noti-title">Claire Mapes</span> to project <span
                                                class="noti-title">Doctor available module</span></p>
                                        <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="assets/img/profiles/avatar-17.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                            completed task <span class="noti-title">Patient and Doctor video
                                                conferencing</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="assets/img/profiles/avatar-13.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added
                                            new task <span class="noti-title">Private chat module</span></p>
                                        <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">View all Notifications</a>
                </div>
            </div>
        </li> --}}

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('/storage/users/'.Auth::user()->image) }}" alt="image user">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ asset('/storage/users/'.Auth::user()->image) }}" alt="image user">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{Auth::user()->firstname}} {{Auth::user()->firstname}}</h6>
                            <h5>{{Auth::user()->CategoryUser->name_category_users}}</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{route('profile')}}"> <i class="me-2" data-feather="user"></i> Mon
                        Profile</a>
                        @if(Auth::user()->CategoryUser->name_category_users==='admin')
                    <a class="dropdown-item" href="{{route('utilisateur.index')}}"><i class="me-2"
                            data-feather="settings"></i>Parametres</a>
                            @endif
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{ route('login.logout') }}"><img src="assets/img/icons/log-out.svg"
                            class="me-2" alt="img"> <form  action="{{ route('login.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>Logout</a>

                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}">Mon Profile</a>
            <a class="dropdown-item" href="{{route('utilisateur.index')}}">Parametres</a>
            <a class="dropdown-item logout pb-0" href="{{ route('login.logout') }}"><img src="assets/img/icons/log-out.svg"
                class="me-2" alt="img"> <form  action="{{ route('login.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>Logout</a>
        </div>
    </div>

</div>
