<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!-- Start Left Navbar Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Contact</a>
            </li>
        </ul>
        <!-- End Left Navbar Links -->

        <!-- Start Right Navbar Links -->
        <ul class="navbar-nav ms-auto">
            @auth
                <!-- Roles Display -->
                @php
                    $activeRoles = Auth::user()->getActiveRoles();
                @endphp
                @if(!empty($activeRoles))
                    <li class="nav-item d-none d-md-flex align-items-center me-3">
                        <span class="text-muted me-2">Roles:</span>
                        <div class="d-flex gap-1">
                            @foreach($activeRoles as $role)
                                <span class="badge bg-primary">{{ ucfirst($role) }}</span>
                            @endforeach
                        </div>
                    </li>
                @endif

                <!-- Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <!-- Messages Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-chat-text"></i>
                        <span class="navbar-badge badge text-bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/img/user1-128x128.jpg') }}" 
                                         alt="User Avatar" 
                                         class="img-size-50 rounded-circle me-3" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="dropdown-item-title mb-1">
                                        Brad Diesel
                                        <span class="float-end text-danger">
                                            <i class="bi bi-star-fill small"></i>
                                        </span>
                                    </h6>
                                    <p class="text-muted small mb-1">Call me whenever you can...</p>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer text-center">See All Messages</a>
                    </div>
                </li>

                <!-- Notifications Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-bell-fill"></i>
                        <span class="navbar-badge badge text-bg-warning">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-envelope me-2"></i> 4 new messages
                            <span class="float-end text-muted small">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer text-center">See All Notifications</a>
                    </div>
                </li>

                <!-- User Menu -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/user8-128x128.jpg') }}" 
                             class="user-image rounded-circle shadow me-2" 
                             alt="User Image" />
                        <span class="d-none d-md-inline">{{ Str::limit(Auth::user()->nama, 15) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <!-- User Header -->
                        <li class="user-header text-bg-primary text-center p-3">
                            <img src="{{ asset('assets/img/user8-128x128.jpg') }}" 
                                 class="rounded-circle shadow mb-2" 
                                 alt="User Image" 
                                 width="80" height="80" />
                            <p class="mb-1">{{ Auth::user()->nama }}</p>
                            <small class="opacity-75">
                                @if(!empty($activeRoles))
                                    {{ implode(', ', array_map('ucfirst', $activeRoles)) }}
                                @else
                                    Member since {{ Auth::user()->created_at->format('M. Y') }}
                                @endif
                            </small>
                        </li>

                        <!-- Menu Footer -->
                        <li class="user-footer">
                            <form action="{{ route('logout') }}" method="POST">@csrf
                                <a href="#" class="btn btn-default btn-flat float-end"
                                    onclick="event.preventDefault(); this.closest('form').submit();">Sign out</a>
                            </form>
                            <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                        </li>
                    </ul>
                </li>
            @else
                <!-- Login Link for Guests -->
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
            @endauth
        </ul>
        <!-- End Right Navbar Links -->
    </div>
</nav>