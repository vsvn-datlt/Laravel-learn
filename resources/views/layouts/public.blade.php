<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Contact App')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    {{-- Bootstrap --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            {{-- <a class="navbar-brand text-uppercase" href="{{ route('contacts.index') }}"> --}}
            <a class="navbar-brand text-uppercase" href="{{ route($__env->yieldContent('logo_contact_app_ref')) }}">
                <strong>Contact</strong> App
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- /.navbar-header -->
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><a href="#" class="nav-link">Companies</a></li>
                        <li class="nav-item @if (\Illuminate\Support\Facades\Route::currentRouteName() == 'contacts.index') active @endif">
                            <a href="{{ route('contacts.index') }}" class="nav-link">
                                @if (\Illuminate\Support\Facades\Route::currentRouteName() == "contacts.index")
                                    <b>Contacts</b>
                                @else
                                    Contacts
                                @endif
                            </a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item mr-2"><a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('user-profile-information.edit') }}">Settings</a>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                  </form>
                            </div>
                          </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-5 footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md">
                    <strong>Contact App</strong>
                    <small class="d-block mb-3">© 2021-2022</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a href="#">Email Marketing</a></li>
                        <li><a href="#">Email Template</a></li>
                        <li><a href="#">Email Broadcast</a></li>
                        <li><a href="#">Autoresponder Email</a></li>
                        <li><a href="#">RSS-to-Email</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a href="#">Landing page Guide</a></li>
                        <li><a href="#">Inbound Marketing Guide</a></li>
                        <li><a href="#">Email Marketing Guide</a></li>
                        <li><a href="#">Helpdesk Guide</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Locations</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
