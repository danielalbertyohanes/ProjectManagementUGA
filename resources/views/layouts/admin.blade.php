<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UGA - Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            /* Lebar penuh layar */
            height: 60px;
            /* Tinggi topbar */
            background-color: white;
            /* Warna latar */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 999;
            /* Pastikan topbar di atas navbar */
            padding: 0 20px;
            /* Ruang horizontal */
        }

        .topbar img {
            height: 70px;
            /* Ukuran logo */
        }

        .topbar ul {
            list-style: none;
            /* Hilangkan bullet */
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .topbar ul li {
            margin-left: 10px;
            /* Jarak antar item */
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100vh - 60px);
            background-color: #3b5998;
            z-index: 1020;
            padding-top: 15px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #323d54;
        }

        /* Konten utama */
        .content {
            margin-top: 60px;
            /* Ruang di bawah topbar */
            margin-left: 250px;
            /* Ruang di samping navbar */
            padding: 20px;
            background-color: #f8f9fa;
            /* Warna latar konten */
            min-height: calc(100vh - 60px);
            /* Tinggi minimal */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="text-center py-3 font-bold">Navigation</h2>
        <ul>
            <li><a href="{{ route('welcome') }}"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
            <hr>
            @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
            <li><a href="{{ route('employee.index') }}"><i class="fa fa-users"></i> Master Employee</a></li>
            <li><a href="{{ route('dosen.index') }}"><i class="fa fa-users"></i> Master Kontributor</a></li>
            <li><a href="{{ route('link_external.index') }}"><i class="fa fa-book"></i> Master External Link</a></li>
            <li><a href="{{ route('periode.index') }}"><i class="fa fa-calendar"></i> Master Periode</a></li>
            <li><a href="{{ route('course.index') }}"><i class="fa fa-book"></i> Master Courses</a></li>
            @endif
        </ul>
    </aside>

    <!-- Topbar -->
    <header class="topbar">
        <div class="flex items-center">
            <img src="{{ asset('admin/img/ppkp_logos.svg') }}" alt="Logo">
        </div>
        <ul class="flex items-center space-x-3">
            <span class="text-gray-700">{{ optional(Auth::user())->name ?? 'Not Logged In' }}</span>
            <li class="dropdown">
                <a href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('employee.show', Auth::user()->id) }}">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>
    </header>

    <!-- Content Wrapper -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <!-- Logout link with confirmation -->
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-key"></i> {{ __('Logout') }}
                    </a>

                    <!-- Logout form -->
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