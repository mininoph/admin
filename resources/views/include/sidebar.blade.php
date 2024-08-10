<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN"> 
            </div>
        </a>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>


                 <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'users/banned') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Users')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('users/banned')}}" class="menu-item {{ ($segment1 == 'users/banned') ? 'active' : '' }}">{{ __('Banned User')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'user-transaction') ? 'active' : '' }}">
                    <a href="{{url('user-transaction')}}"><i class="ik ik-book-open"></i><span>{{ __('User Transaction')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'request-pending' || $segment1 == 'request-complete'||$segment1 == 'request-reject') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Payment Request')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('request-pending')}}" class="menu-item {{ ($segment1 == 'request-pending') ? 'active' : '' }}">{{ __('Pending')}}</a>
                        <a href="{{url('request-complete')}}" class="menu-item {{ ($segment1 == 'request-complete') ? 'active' : '' }}">{{ __('Completed')}}</a>
                        <a href="{{url('request-reject')}}" class="menu-item {{ ($segment1 == 'request-reject') ? 'active' : '' }}">{{ __('Reject')}}</a>
                    </div>
                </div>
                
               <div class="nav-item {{ ($segment1 == 'offer') ? 'active' : '' }}">
                    <a href="{{url('offer')}}"><i class="ik ik-home"></i><span>{{ __('Home Offers')}}</span>  </a>
                </div>
                
                 <div class="nav-item {{ ($segment1 == 'offerwall') ? 'active' : '' }}">
                    <a href="{{url('offerwall')}}"><i class="ik ik-home"></i><span>{{ __('Offerwall & Survey')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'banner') ? 'active' : '' }}">
                    <a href="{{url('banner')}}"><i class="ik ik-image"></i><span>{{ __('Promotion Banner')}}</span>  </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'hotoffer' || $segment2 == 'approval'||$segment2 == 'completed') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-gift"></i><span>{{ __('Hot Offer')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('hotoffer')}}" class="menu-item {{ ($segment1 == 'hotoffer') ? 'active' : '' }}">{{ __('Offer')}}</a>
                        <a href="{{url('hotoffer/approval')}}" class="menu-item {{ ($segment2 == 'approval') ? 'active' : '' }}">{{ __('Pending Approval')}}</a>
                        <a href="{{url('hotoffer/approved')}}" class="menu-item {{ ($segment2 == 'approved') ? 'active' : '' }}">{{ __('Approved')}}</a>
                    </div>
                </div>
          
                
                <div class="nav-item {{ ($segment1 == 'games') ? 'active' : '' }}">
                    <a href="{{url('games')}}"><i class="ik ik-play"></i><span>{{ __('Games')}}</span>  </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'websites') ? 'active' : '' }}">
                    <a href="{{url('websites')}}"><i class="ik ik-globe"></i><span>{{ __('Websites')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'videos') ? 'active' : '' }}">
                    <a href="{{url('videos')}}"><i class="ik ik-youtube"></i><span>{{ __('Videos')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'apps') ? 'active' : '' }}">
                    <a href="{{url('apps')}}"><i class="fab fa-android"></i><span>{{ __('Apps')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'setting/spin') ? 'active' : '' }}">
                    <a href="{{url('setting/spin')}}"><i class="ik ik-target"></i><span>{{ __('Spinner')}}</span></a>
                </div>

                <div class="nav-item {{ ($segment1 == 'payment-options') ? 'active' : '' }}">
                    <a href="{{url('payment-options')}}"><i class="ik ik-credit-card"></i><span>{{ __('Redeem Option')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'notification') ? 'active' : '' }}">
                    <a href="{{url('notification')}}"><i class="ik ik-bell"></i><span>{{ __('Notifiaiton')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == '/setting/app') ? 'active' : '' }}">
                    <a href="{{url('/setting/app')}}"><i class="ik ik-settings"></i><span>{{ __('App Setting')}}</span>  </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'language' || $segment1 == 'language/data') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Language Setting')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('language')}}" class="menu-item {{ ($segment1 == 'language') ? 'active' : '' }}">{{ __('Languages')}}</a>
                        <a href="{{url('language/data')}}" class="menu-item {{ ($segment1 == 'language/data') ? 'active' : '' }}">{{ __('Language Data')}}</a>
                    </div>
                </div>
                
                
                <div class="nav-item {{ ($segment1 == '/setting/ads') ? 'active' : '' }}">
                    <a href="{{url('/setting/ads')}}"><i class="ik ik-server"></i><span>{{ __('Ads Setting')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'setting-general') ? 'active' : '' }}">
                    <a href="{{url('setting-general')}}"><i class="ik ik-settings"></i><span>{{ __('General Setting')}}</span>  </a>
                </div>
              
                @if(auth()->user()->id==2)    
              	<div class="nav-item {{ ($segment1 == 'admins') ? 'active' : '' }}">
                    <a href="{{url('admins')}}"><i class="ik ik-user"></i><span>Manage Admin</span>  </a>
                </div>
                @endif
            

                <div class="nav-item {{ ($segment1 == 'admin-profile') ? 'active' : '' }}">
                    <a href="{{url('admin-profile')}}"><i class="ik ik-lock"></i><span>{{ __('Admin Profile')}}</span>  </a>
                </div>


                <div class="nav-item {{ ($segment1 == 'clear-cache') ? 'active' : '' }}">
                    <a href="{{url('clear-cache')}}"><i class="ik ik-battery-charging"></i><span>{{ __('Clear Cache')}}</span>  </a>
                </div>
                              
        </div>
    </div>
</div>