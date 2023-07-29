@extends('layouts.main')

@section('title', 'Kelola Data FAQ')

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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Data FAQ</h5>

                    <div class="d-flex">
                        <div class="form-group d-flex align-items-center me-3">
                            <label for="kategori" class="me-1">Filter Kategori:</label>
                            <form method="GET" action="{{ route('modul-faq.index') }}">
                                <select class="form-control" id="kategori" name="kategori" onchange="this.form.submit()">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == request()->get('kategori') ? 'selected' : '' }}>{{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="bx bx-plus"></i>
                        </button>
                    </div>
                </div>

                @include('master.modul.faq.createModal')

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Jawaban</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Attachment</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $faq->pertanyaan }}</td>
                                    <td>{!! $faq->jawaban !!}</td>
                                    <td>{{ $faq->kategori->nama }}</td>
                                    <td width="20%">
                                        @if ($faq->attachments->count() > 0)
                                            <ul class="ps-2 ms-0 mb-0">
                                                @foreach ($faq->attachments as $attachment)
                                                    <li>
                                                        <a href="{{ asset('storage/faq/' . $attachment->nama) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-primary mb-1"
                                                            title="{{ $attachment->nama }}">
                                                            <i class="bx bx-download"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-danger mb-1"
                                                            onclick="
                                                            event.preventDefault();
                                                            if(confirm('Apakah anda yakin ingin menghapus file ini?')){
                                                                document.getElementById('deleteAttachment{{ $attachment->id }}').submit();
                                                            }">
                                                            <i class="bx bx-x"></i>
                                                        </button>

                                                        <form id="deleteAttachment{{ $attachment->id }}"
                                                            action="{{ route('attachment.delete', $attachment->id) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $faq->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>

                                        <form method="POST" action="{{ route('modul-faq.destroy', $faq->id) }}"
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

                    @foreach ($faqs as $faq)
                        @include('master.modul.faq.editModal')
                    @endforeach

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
                menubar: false,
                forced_root_block: 'div'
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
