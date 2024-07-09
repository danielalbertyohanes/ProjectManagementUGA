@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome, {{ Auth::User()->name }}</div>

                    <div class="card-body">
                        <p>Selamat datang di halaman ini. Anda dapat mengelola Course, Topics, dan informasi lainnya di
                            sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-yhF+o52vps0bIyQ/YNjyz8DbERanw11OvGQHp/JUsV2cv9VjaFCYJTPGa3Mva6ZR07gA/8N2UhuB1I1AGFyDVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
