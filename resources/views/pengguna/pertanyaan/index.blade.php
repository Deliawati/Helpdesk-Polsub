@extends('layouts.app')

@section('title', 'Pertanyaan')

@section('head')
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center">
                        Form Tiket Pertanyaan
                    </h5>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Whoops!</strong> Ada kesalahan saat mengisi form, silahkan cek kembali form yang
                            anda isi.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            @guest
                                <div>
                                    <p class="text-center">Silahkan <a href="{{ route('login') }}">login</a> untuk mengajukan
                                        pertanyaan</p>
                                </div>
                            @else
                                <p>Isi form dibawah ini untuk mengajukan pertanyaan kepada kami.</p>

                                <form method="POST" action="{{ route('pertanyaan.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" id="kategori" name="kategori">
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" class="text-capitalize">
                                                        {{ $kategori->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pertanyaan">Pertanyaan</label>
                                            <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            @endguest
                        </div>
                    </div>

                    @guest
                    @else
                        <div class="mt-3">
                            <h5 class="text-center">Daftar Tiket Pertanyaan Saya</h5>

                            <div id="accordion-riwayat">
                                @foreach ($my_tickets as $tiket)
                                    <div class="card">
                                        <div class="card-header {{ $tiket->balasan ? 'bg-success' : 'bg-warning' }}"
                                            id="myasks{{ $tiket->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link {{ $tiket->balasan ? 'text-white' : '' }} collapsed"
                                                    data-toggle="collapse" data-target="#collapse-riwayat{{ $tiket->id }}"
                                                    aria-expanded="false" aria-controls="collapse-riwayat{{ $tiket->id }}">
                                                    <span class="badge badge-light">
                                                        {{ $tiket->kategori->nama }}
                                                    </span>
                                                    {{ '#' . $tiket->id . ' ' . $tiket->pertanyaan }}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-riwayat{{ $tiket->id }}" class="collapse"
                                            aria-labelledby="myasks{{ $tiket->id }}" data-parent="#accordion-riwayat">
                                            <div class="card-body">
                                                @if ($tiket->balasan)
                                                    {!! $tiket->balasan !!}
                                                @else
                                                    <p class="text-center">Belum ada jawaban</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
