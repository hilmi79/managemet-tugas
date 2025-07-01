<nav class="app-header navbar navbar-expand bg-body shadow-sm border-bottom">
    <div class="container-fluid">

        <!-- Kiri: Sidebar Toggle + Link -->
        <ul class="navbar-nav d-flex align-items-center">
            <!-- Sidebar toggle -->
            <li class="nav-item">
                <a class="nav-link px-2" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list fs-4"></i>
                </a>
            </li>

            <!-- Home link -->
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link px-2 mt-2 text-secondary">
                    <i class="bi bi-house-door me-1"></i> Home
                </a>
            </li>

            <!-- Contact link -->
            <li class="nav-item">
                <a href="{{ url('/contact') }}" class="nav-link px-2 mt-2 text-secondary">
                    <i class="bi bi-envelope me-1"></i> Contact
                </a>
            </li>
        </ul>

        <!-- Kanan: User Dropdown -->
        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center px-2" data-bs-toggle="dropdown">
                    <img
                        src="{{ asset('images/user-default.png') }}"
                        alt="User Image"
                        class="rounded-circle shadow-sm border"
                        style="width: 36px; height: 36px; object-fit: cover;"
                    />
                    <span class="ms-2 fw-medium d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm rounded">
                    <li>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-person me-2 text-secondary"></i> Profil
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right me-2 text-danger"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
