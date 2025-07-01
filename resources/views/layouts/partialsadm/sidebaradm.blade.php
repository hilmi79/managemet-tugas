@php
    $active = fn($route) => request()->routeIs($route) ? 'active fw-semibold text-primary' : '';
@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Brand -->
   <div class="sidebar-brand text-center py-3">
    <a href="{{ route('dashboard') }}" class="brand-link d-flex align-items-center justify-content-center gap-2">
        <div class="bg-white shadow-sm border rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
            <i class="bi bi-mortarboard text-primary" style="font-size: 1.5rem; line-height: 1;"></i>
        </div>
    </a>
    <span class="brand-text fw-light fs-5">Sistem Tugas</span>
</div>



    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $active('dashboard') }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Mata Kuliah -->
                @if(Auth::user()->role == 'dosen')
                <li class="nav-item">
                    <a href="{{ route('dosen.matakuliah.index') }}" class="nav-link {{ $active('dosen.matakuliah.index') }}">
                        <i class="nav-icon bi bi-book-half"></i>
                        <p>Mata Kuliah</p>
                    </a>
                </li>
                @elseif(Auth::user()->role == 'mahasiswa')
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.matakuliah.index') }}" class="nav-link {{ $active('mahasiswa.matakuliah.index') }}">
                        <i class="nav-icon bi bi-book-half"></i>
                        <p>Mata Kuliah</p>
                    </a>
                </li>
                @endif

                <!-- Menu Dosen -->
                @if(Auth::user()->role == 'dosen')
                <li class="nav-item">
                    <a href="{{ route('dosen.tugas.index') }}" class="nav-link {{ $active('dosen.tugas.index') }}">
                        <i class="nav-icon bi bi-clipboard-data"></i>
                        <p>Kelola Tugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dosen.penilaian.index') }}" class="nav-link {{ $active('dosen.penilaian.index') }}">
                        <i class="nav-icon bi bi-check2-square"></i>
                        <p>Penilaian</p>
                    </a>
                </li>
                @endif

                <!-- Menu Mahasiswa -->
                @if(Auth::user()->role == 'mahasiswa')
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.tugas.index') }}" class="nav-link {{ $active('mahasiswa.tugas.index') }}">
                        <i class="nav-icon bi bi-journal-bookmark"></i>
                        <p>Daftar Tugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.jawaban.index') }}" class="nav-link {{ $active('mahasiswa.jawaban.index') }}">
                        <i class="nav-icon bi bi-upload"></i>
                        <p>Jawaban Saya</p>
                    </a>
                </li>
                @endif

                <!-- Profil -->
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ $active('profile.edit') }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Profil</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
