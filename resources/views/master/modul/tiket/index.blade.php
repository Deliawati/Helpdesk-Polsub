@extends('layouts.main')

@section('title', 'Kelola Data Tiket')

@section('head')
    <style>
        .max-3-line {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endsection

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
                    Data Tiket
                </h5>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Penanya</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Balasan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tikets as $tiket)
                            <tr>
                                <th scope="row">{{$tiket->id}}</th>
                                <td>{{$tiket->user->email}}</td>
                                <td>{{$tiket->kategori}}</td>
                                <td>
                                    <div class="max-3-line">
                                        {{$tiket->pertanyaan}}
                                    </div>
                                </td>
                                <td>
                                    <div class="max-3-line">
                                        {{$tiket->balasan}}
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#balasModal{{ $tiket->id }}">
                                        <i class="bx bx-info-circle"></i>
                                    </button>

                                    @include('master.modul.tiket.balasModal')
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable();
    });
</script>
@endsection