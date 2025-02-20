<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UGA - Management</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/admin.css') }}" rel="stylesheet">
</head>

<body class="flex">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="text-center py-3 font-bold text-white">Navigation</h2>
        <ul>
            <li><a href="{{ route('home') }}"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
            <hr>
            @if (Auth::user()->position_id == '1')
                <li><a href="{{ route('employee.index') }}"><i class="fa fa-user-tie"></i> Master Employee</a></li>
                <li><a href="{{ route('dosen.index') }}"><i class="fa fa-user-check"></i> Master Kontributor</a></li>
                <li><a href="{{ route('link_external.index') }}"><i class="fa fa-external-link-alt"></i> Master External
                        Link</a></li>
                <li><a href="{{ route('periode.index') }}"><i class="fa fa-calendar"></i> Master Periode</a></li>
                <li><a href="{{ route('course.index') }}"><i class="fa fa-graduation-cap"></i> Master Courses</a></li>
                <li><a href="{{ route('report.rptCourse') }}"><i class="fa fa-chart-line"></i> Report Course</a></li>
                <li><a href="{{ route('report.rptEmployee') }}"><i class="fa fa-user-cog"></i> Report Employee</a></li>
                <li><a href="{{ route('report.rptPeriode') }}"><i class="fa fa-calendar-check"></i> Report Periode</a>
                </li>
            @elseif (Auth::user()->position_id == '2' || Auth::user()->position_id == '3')
                <li><a href="{{ route('course.index') }}"><i class="fa fa-graduation-cap"></i> Master Courses</a></li>
            @endif
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="flex items-center">
                <img src="{{ asset('admin/img/ppkp_logos.svg') }}" alt="Logo">
            </div>
            <ul class="flex items-center space-x-3">
                <span class="text-gray-700">{{ optional(Auth::user())->name ?? 'Not Logged In' }}</span>
                <li class="dropdown">
                    <a href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id) }}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal"
                            data-target="#logoutModal">Logout</a>
                    </div>
                </li>
            </ul>
        </header>

        <!-- Page Content -->
        <div class="content">
            @yield('content')
        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap mengakhiri sesi saat ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                        <!-- Tombol Logout dengan konfirmasi -->
                        <a class="btn btn-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-key"></i> {{ __('Keluar') }}
                        </a>

                        <!-- Form Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
        @yield('javascript')
</body>

</html>
