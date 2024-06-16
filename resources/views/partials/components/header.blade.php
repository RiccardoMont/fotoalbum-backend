<header>
    <nav class="navbar navbar-expand-md p-0 bg">
        <div class="container">
            <div class="pages">
                <ul class="list-unstyled d-flex m-0">
                    <li class="d-flex align-items-center gap-1">
                        <i class="fa-solid fa-house"></i>
                        <a href="{{url('/') }}">{{ __('Home') }}</a>
                    </li>
                    @if (Auth::user())
                    <li>
                        <a href="{{ route('admin.photos.index') }}">{{ __('Photos') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.best-shoots.index') }}">{{ __('Best Shoots Tags') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="user d-flex justify-content-end ms-auto">
                <ul class="list-unstyled d-flex m-0">
                    @guest
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @endif
                    @else
                    <li><a href="{{ url('admin') }}">{{__('Dashboard')}}</a></li>
                    <li><a href="{{ url('profile') }}">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('admin.leads.index')}}">{{__('Messages')}}</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


</header>