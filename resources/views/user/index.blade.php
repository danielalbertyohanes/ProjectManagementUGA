<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pengaturan Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/profile.css') }}">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">Pengaturan Akun</h4>
        <!-- Notifikasi -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @elseif (session('erorr'))
            <div class="alert alert-danger">{{ session('erorr') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="row no-gutters">
                <!-- Sidebar -->
                <div class="col-md-3 sidebar">
                    <div class="list-group">
                        <a class="list-group-item active" data-toggle="list" href="#account-general">Umum</a>
                        <a class="list-group-item" data-toggle="list" href="#account-change-password">Ubah Kata Sandi</a>
                    </div>
                </div>

                <!-- Konten -->
                <div class="col-md-9">
                    <div class="tab-content p-4">
                        <!-- Pengaturan Umum -->
                        <div class="tab-pane fade active show" id="account-general">
                            <form method="POST" action="{{ route('user.update', ['user' => $user->id, 'from' => 'user']) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="name" type="text" class="form-control" value="{{ $user->name }}" />
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" class="form-control" value="{{ $user->email }}" />
                                </div>

                                <div class="form-group">
                                    <label>Posisi</label>
                                    <input type="text" class="form-control" value="{{ $user->position->name }}" readonly />
                                </div>

                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('home') }}" class="btn btn-light">Batal</a>
                                </div>
                            </form>
                        </div>

                        <!-- Ubah Kata Sandi -->
                        <div class="tab-pane fade" id="account-change-password">
                            <form action="{{ route('employee.changePassword', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Kata Sandi Saat Ini</label>
                                    <input name="current_password" type="password" class="form-control" required>
                                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Kata Sandi Baru</label>
                                    <input name="new_password" type="password" class="form-control" required>
                                    @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Ulangi Kata Sandi Baru</label>
                                    <input name="new_password_confirmation" type="password" class="form-control" required>
                                    @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
                                    <a href="{{ route('home') }}" class="btn btn-light">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
