@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background-color: blue;">
                    <div class="card-body">
                        <div class="card-header center custom-bg-color" style="text-align: center; margin-bottom: 20px;">
                            {{ __('Register') }}
                        </div>

                        <form method="POST" action="{{ route('employee.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="dosenNpk" class="col-md-4 col-form-label text-md-end">NPK</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('npk') is-invalid @enderror"
                                        id="dosenNpk" name="npk" required maxlength="6" pattern="\d{6}"
                                        inputmode="numeric"
                                        title="NPK must be exactly 6 digits and only numbers are allowed"
                                        value="{{ old('npk') }}">
                                    @error('npk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">Phone Number</label>
                                <div class="col-md-6">
                                    <input id="phone" type="tel"
                                        class="form-control @error('phone') is-invalid @enderror" name="no_telp"
                                        value="{{ old('phone') }}" required autocomplete="tel" pattern="\d+"
                                        title="Phone number must be only digits">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="text"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required value="staffuga" readonly style="background-color: #8e8e8e;">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="position_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Position') }}</label>
                                <div class="col-md-6">
                                    <select id="position_id" class="form-control @error('position_id') is-invalid @enderror"
                                        name="position_id" required autocomplete="position_id" autofocus>
                                        <option value="" selected disabled>Choose Position</option>
                                        @foreach ($positions as $p)
                                            @if ($p->name !== 'Dosen')
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4 mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
