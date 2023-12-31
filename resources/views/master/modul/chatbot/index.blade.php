@extends('layouts.main')

@section('title', 'Kelola Data Chatbot')

@section('head')
    <script src="https://cdn.tiny.cloud/1/j5gqw60qypi9txea3m892uu1z4c38jvmw74cpvjetog9q3td/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        .wrap-2-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
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
                    Data Chatbot
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bx bx-plus"></i>
                    </button>
                </h5>

                @include('master.modul.chatbot.createModal')

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Response</th>
                                <th scope="col">Attachment</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chatbots as $chat)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $chat->pertanyaan }}</td>
                                    <td>
                                        <div class="wrap-2-lines">
                                            {!! $chat->jawaban !!}
                                        </div>
                                    </td>
                                    <td width="20%">
                                        @if ($chat->attachments->count() > 0)
                                            <ul class="ps-2 ms-0 mb-0">
                                                @foreach ($chat->attachments as $attachment)
                                                    <li> 
                                                        <a href="{{ asset('storage/chatbot/' . $attachment->nama) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-primary mb-1"
                                                            title="{{$attachment->nama}}">
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
                                            data-bs-target="#editModal{{ $chat->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>

                                        <form method="POST" action="{{ route('modul-chatbot.destroy', $chat->id) }}"
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

                    @foreach ($chatbots as $chat)
                        @include('master.modul.chatbot.editModal')
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
                menubar: false
            });
        });
    </script>
@endsection
