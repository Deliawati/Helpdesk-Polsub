@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <h5 class="d-flex justify-content-between align-items-center">
                    Data FAQ
                    <button class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"></i>
                    </button>
                </h5>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Jawaban</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
