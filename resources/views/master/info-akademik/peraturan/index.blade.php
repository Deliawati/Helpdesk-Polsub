@extends('layouts.main')

@section('title', 'Kelola Peraturan Akademik')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><strong>Gagal!</strong> {{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="d-flex justify-content-between align-items-center">
                    Data Peraturan Akademik
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bx bx-plus"></i>
                    </button>
                </h5>

                @include('master.info-akademik.peraturan.createModal')

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Peraturan</th>
                                <th scope="col">File</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peraturans as $peraturan)
                                <tr>
                                    <td>{{ $peraturan->id }}</td>
                                    <td>{{ $peraturan->nama }}</td>
                                    <td>
                                        <a href="{{ asset('storage/peraturan-akademik/' . $peraturan->file) }}" target="_blank">
                                            <i class="bx bx-file"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$peraturan->id}}">
                                            <i class="bx bx-edit"></i>
                                        </button>

                                        @include('master.info-akademik.peraturan.editModal')

                                        <form method="POST"
                                            action="{{ route('master-peraturan-akademik.destroy', $peraturan->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>                              
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
