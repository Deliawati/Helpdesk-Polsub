@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center font-weight-bold">Register</h5>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name"
                                        class="form-label text-md-end">{{ __('Nama') }}<span class="text-danger">*</span></label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" placeholder="ex: Delia Polsub" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="no_telp"
                                        class="form-label text-md-end">{{ __('No Telepon') }}<span class="text-danger">*</span></label>
                                    <input id="no_telp" type="text"
                                        class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                                        value="{{ old('no_telp') }}" placeholder="ex: 0821229019292" required autocomplete="no_telp">

                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email"
                                        class="form-label text-md-end">{{ __('Email') }}<span class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="ex: delia@mail.com" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password"
                                        class="form-label text-md-end">{{ __('Password') }}<span class="text-danger">*</span></label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm"
                                        class="form-label text-md-end">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
