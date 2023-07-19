@extends('layouts.main')

@section('title', 'Kelola Layanan Akademik')

@section('head')
    <script src="https://cdn.tiny.cloud/1/j5gqw60qypi9txea3m892uu1z4c38jvmw74cpvjetog9q3td/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
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
                    Data Layanan Akademik
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bx bx-plus"></i>
                    </button>
                </h5>

                @include('master.info-akademik.layanan.createModal')

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Layanan</th>
                                {{-- <th scope="col">Melalui</th> --}}
                                <th scope="col">Konfirmasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($layanans as $layanan)
                                <tr>
                                    <th scope="row">{{ $layanan->id }}</th>
                                    <td>{!! $layanan->nama !!}</td>
                                    {{-- <td class="melalui">
                                        <ul>
                                            @foreach (explode(';', $layanan->melalui) as $melalui)
                                                <li>
                                                    @if (filter_var($melalui, FILTER_VALIDATE_URL))
                                                        <a href="{{ $melalui }}"
                                                            target="_blank">{{ $melalui }}</a>
                                                    @else
                                                        {{ $melalui }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td> --}}
                                    <td>
                                        <ul>
                                            @foreach (explode(';', $layanan->konfirmasi) as $konfirmasi)
                                                <li>{{ $konfirmasi }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $layanan->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>

                                        @include('master.info-akademik.layanan.editModal')

                                        <form method="POST"
                                            action="{{ route('master-layanan-akademik.destroy', $layanan->id) }}"
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable();
            tinymce.init({
                selector: 'textarea',
                plugins: 'link lists wordcount advlist',
                toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                menubar: false
            });
            // Prevent Bootstrap dialog from blocking focusin
            document.addEventListener('focusin', (e) => {
                if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
                    e.stopImmediatePropagation();
                }
            });
        });
    </script>
@endsection
