<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Custom Styles -->
    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="panel" class="d-flex flex-column position-absolute inset-0">
        <nav class="navbar navbar-dark bg-dark border-bottom shadow-sm w-100">
            <a href="{{ url('/') }}" class="navbar-brand">
                {{ config('app.name', 'Laravel') }}
            </a>

            <ul class="navbar-nav flex-row ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="{{ route('panel.profile.edit') }}" class="dropdown-item @if(request()->routeIs('panel.profile.edit')) active @endif">
                                <i class="fas fa-house text-dark mr-1"></i>
                                {{ __('menu.panel.profile.edit') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.profile.edit') }}" class="dropdown-item @if(request()->routeIs('panel.profile.edit')) active @endif">
                                <i class="fas fa-user text-dark mr-1"></i>
                                {{ __('menu.panel.profile.edit') }}
                            </a>
                        </li>

                        <hr class="dropdown-divider">

                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off text-dark mr-1"></i>
                                {{ __('Logout') }}
                            </a>

                            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-expand-md">
                <button type="button" class="navbar-toggler button_hamburger_htra ml-3" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                    <span></span>
                </button>
            </div>
        </nav>

		<div class="flex-grow-1 d-flex flex-row-reverse flex-md-row overflow-hidden">
			<div class="d-flex navbar-expand-md flex-shrink-0">
				<div id="navbarNav" class="bg-white shadow-sm navbar-collapse width collapse flex-fill">
					<nav id="panel-side-navbar">
						<div class="input-group has-clear p-3">
							<input type="text" id="panel-side-nav-search" class="form-control"
								placeholder="Search menu">
							<div class="input-group-append">
								<button type="button" class="btn btn-clear btn-clear-hidden">
									<i class="fa fa-times"></i>
								</button>
							</div>
						</div>
						<hr class="dropdown-divider m-0" />
						<div id="panel-side-nav-group" class="flex-grow-1 overflow-auto on-hover">
							<ul class="nav flex-column">
								<li class="nav-item">
                                    @php
                                        $isOpenCollapseGoogleAnalytics = request()->routeIs('panel.google-analytics.*');
                                    @endphp
									<a href="#collapseGoogleAnalytics" class="nav-link d-flex align-items-center @if(!$isOpenCollapseGoogleAnalytics) collapsed @endif" data-toggle="collapse" aria-expanded="{{ $isOpenCollapseGoogleAnalytics ? 'true' : 'false' }}" aria-controls="collapseGoogleAnalytics">
										<i class="fas fa-chart-simple mr-2"></i>
                                        {{ __('menu.panel.google-analytics.text') }}

										<i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
									</a>
									<div id="collapseGoogleAnalytics" class="collapse @if($isOpenCollapseGoogleAnalytics) show @endif">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a href="{{ route('panel.google-analytics.urls') }}" class="nav-link @if(request()->routeIs('panel.google-analytics.urls')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.google-analytics.urls') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.google-analytics.locations') }}" class="nav-link @if(request()->routeIs('panel.google-analytics.locations')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.google-analytics.locations') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.google-analytics.languages') }}" class="nav-link @if(request()->routeIs('panel.google-analytics.languages')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.google-analytics.languages') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.google-analytics.browsers') }}" class="nav-link @if(request()->routeIs('panel.google-analytics.browsers')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.google-analytics.browsers') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.google-analytics.device-categories') }}" class="nav-link @if(request()->routeIs('panel.google-analytics.device-categories')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.google-analytics.device-categories') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.google-analytics.operating-systems') }}" class="nav-link @if(request()->routeIs('panel.google-analytics.operating-systems')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.google-analytics.operating-systems') }}</span>
                                                </a>
											</li>
										</ul>
									</div>
								</li>
                                @can('manage_system')
								<li class="nav-item">
                                    @php
                                        $isOpenCollapseProjects = request()->routeIs('panel.projects.*');
                                    @endphp
									<a href="#collapseProjects" class="nav-link d-flex align-items-center @if(!$isOpenCollapseProjects) collapsed @endif" data-toggle="collapse" aria-expanded="{{ $isOpenCollapseProjects ? 'true' : 'false' }}" aria-controls="collapseProjects">
										<i class="fas fa-diagram-project mr-2"></i>
                                        {{ __('menu.panel.projects.text') }}

										<i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
									</a>
									<div id="collapseProjects" class="collapse @if($isOpenCollapseProjects) show @endif">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a href="{{ route('panel.projects.index') }}" class="nav-link @if(request()->routeIs('panel.projects.index')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.projects.index') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.projects.create') }}" class="nav-link @if(request()->routeIs('panel.projects.create')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.projects.create') }}</span>
                                                </a>
											</li>
										</ul>
									</div>
								</li>

								<li class="nav-item">
                                    @php
                                        $isOpenCollapseUsers = request()->routeIs('panel.users.*');
                                    @endphp
									<a href="#collapseUsers" class="nav-link d-flex align-items-center @if(!$isOpenCollapseUsers) collapsed @endif" data-toggle="collapse" aria-expanded="{{ $isOpenCollapseUsers ? 'true' : 'false' }}" aria-controls="collapseUsers">
                                        <i class="fas fa-users mr-2"></i>
                                        {{ __('menu.panel.users.text') }}

										<i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
									</a>
									<div id="collapseUsers" class="collapse @if($isOpenCollapseUsers) show @endif">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a href="{{ route('panel.users.index') }}" class="nav-link @if(request()->routeIs('panel.users.index')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.users.index') }}</span>
                                                </a>
											</li>
											<li class="nav-item">
												<a href="{{ route('panel.users.create') }}" class="nav-link @if(request()->routeIs('panel.users.create')) active @endif">
                                                    <span class="pl-1">{{ __('menu.panel.users.create') }}</span>
                                                </a>
											</li>
										</ul>
									</div>
								</li>
                                @endcan
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<main class="flex-md-shrink-1 flex-shrink-0 w-100 overflow-auto py-3">
				<div class="container-fluid">
                    @yield('content')
				</div>

                @yield('scripts')
			</main>
		</div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success.title') }}',
                text: '{{ session('success.text') }}',
                confirmButtonText: '{{ __('messages.panel.sweetalert2.success.confirm-button-text') }}'
            });
        </script>
    @endif
</body>
</html>
