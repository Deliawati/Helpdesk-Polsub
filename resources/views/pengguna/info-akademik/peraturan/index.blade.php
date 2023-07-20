@extends('layouts.app')

@section('title', 'Peraturan Akademik')

@section('head')
@endsection

@section('content')
<section class="our-services">
    <div class="container pt-5">
        <h4>Peraturan Akademik</h4>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Peraturan</th>
                        <th scope="col">File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peraturans as $peraturan)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{!! $peraturan->nama !!}</td>
                            <td>
                                <a href="{{ asset('storage/peraturan-akademik/' . $peraturan->file) }}" target="_blank">
                                    <i class="mdi mdi-file-pdf-box"></i> {{ $peraturan->file }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
