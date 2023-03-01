<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="side-menu-bt-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary wrapper-menu" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle position-relative" id="notification-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if (count(auth()->guard('admin')->user()->unreadNotifications))
                                <span class="bg-danger d-block position-absolute rounded admin-notification-badge" style="width: 5px; height: 5px; top:36%; right:14px"></span>
                                @endif
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="notification-dropdown">
                                <div class="card shadow-none m-0 border-0">
                                    <div class="p-3 card-header-border">
                                        <h6 class="text-center">
                                            Notifications
                                        </h6>
                                    </div>
                                    <div class="card-body overflow-auto card-header-border p-0 card-body-list" style="max-height: 500px;">
                                        <ul class="dropdown-menu-1 overflow-auto list-style-1 mb-0 admin-notifications">
                                            @foreach (auth()->guard('admin')->user()->unreadNotifications as $notification)
                                            <li class="dropdown-item-1 float-none p-3 admin-notification" style="cursor:auto">
                                                <div class="list-item d-flex justify-content-start align-items-start">
                                                    <div class="list-style-detail ml-2 mr-2">
                                                        <h6 class="font-weight-bold">{{$notification['data']['message']}}</h6>
                                                        <p class="m-0">
                                                            <a href="#" class="mark-as-read" data-id="{{$notification->id}}">
                                                            <small class="text-secondary">
                                                               mark as read
                                                            </small>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if (count(auth()->guard('admin')->user()->unreadNotifications))
                                    <div class="card-footer text-muted p-3">
                                        <a href="#" id="mark-all"><p class="mb-0 text-primary text-center font-weight-bold">Mark All as read</p></a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('images/Flag/flag001.png')}}" class="img-fluid rounded-circle" alt="user" style="height: 30px; min-width: 30px; width: 30px;">
                            <span class="bg-primary"></span>
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <div class="card shadow-none m-0 border-0">
                                    <div class=" p-0 ">
                                        <ul class="dropdown-menu-1 list-group list-group-flush">
                                            <li class="dropdown-item-1 list-group-item  px-2"><a class="p-0" href="#"><img src="{{asset('images/Flag/flag-03.png')}}" alt="img-flaf" class="img-fluid mr-2" style="width: 15px;height: 15px;min-width: 15px;"/>Spanish</a></li>
                                            <li class="dropdown-item-1 list-group-item  px-2"><a class="p-0" href="#"><img src="{{asset('images/Flag/flag-04.png')}}" alt="img-flaf" class="img-fluid mr-2" style="width: 15px;height: 15px;min-width: 15px;"/>Italian</a></li>
                                            <li class="dropdown-item-1 list-group-item  px-2"><a class="p-0" href="#"><img src="{{asset('images/Flag/flag-02.png')}}" alt="img-flaf" class="img-fluid mr-2" style="width: 15px;height: 15px;min-width: 15px;"/>French</a></li>
                                            <li class="dropdown-item-1 list-group-item  px-2"><a class="p-0" href="#"><img src="{{asset('images/Flag/flag-05.png')}}" alt="img-flaf" class="img-fluid mr-2" style="width: 15px;height: 15px;min-width: 15px;"/>German</a></li>
                                            <li class="dropdown-item-1 list-group-item  px-2"><a class="p-0" href="#"><img src="{{asset('images/Flag/flag-06.png')}}" alt="img-flaf" class="img-fluid mr-2" style="width: 15px;height: 15px;min-width: 15px;"/>Japanese</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-icon search-content">
                            <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="svg-icon text-secondary" id="h-suns" height="25" width="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </a>
                            <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                <form action="#" class="searchbox p-2">
                                    <div class="form-group mb-0 position-relative">
                                    <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                                    <a href="#" class="search-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </a>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="nav-item nav-icon dropdown-toggle pr-0 search-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <img src="{{asset('images/user/1.jpg')}}" class="img-fluid avatar-rounded" alt="user">
                                <span class="mb-0 ml-2 user-name">John Doe</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <a href="#">My Profile</a>
                                </li>
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-02-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <a href="#">Edit Profile</a>
                                </li>
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-03-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <a href="#">Account Settings</a>
                                </li>
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-04-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <a href="#">Privacy Settings</a>
                                </li>
                                <li class="dropdown-item  d-flex svg-icon border-top">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <a href="{{route('admin.logout')}}">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
