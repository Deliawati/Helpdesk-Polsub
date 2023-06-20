@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
    <section class="our-services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verifikasi Alamat Email Anda') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Sebuah tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                                </div>
                            @endif

                            {{ __('Sebelum bisa melanjutkan proses berikutnya, tolong cek link verifikasi email yang telah dikirim ke alamat email Anda.') }}
                            {{ __('Jika merasa tidak menerima link tersebut') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk mengirimnya kembali') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
