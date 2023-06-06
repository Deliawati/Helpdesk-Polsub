@extends('layouts.app')

@section('title', 'Layanan Akademik')

@section('head')
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <h4>Layanan Akademik</h4>
            <p>Berikut adalah layanan akademik yang dapat diakses oleh mahasiswa.</p>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Melalui</th>
                            <th scope="col">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanans as $layanan)
                            <tr>
                                <th scope="row">{{ $loop->index+1 }}</th>
                                <td>{!! $layanan->nama !!}</td>
                                <td class="melalui">
                                    <ul>
                                        @foreach (explode(';', $layanan->melalui) as $melalui)
                                            <li>
                                                @if (filter_var($melalui, FILTER_VALIDATE_URL))
                                                    <a href="{{ $melalui }}" target="_blank">{{ $melalui }}</a>
                                                @else
                                                    {{ $melalui }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach (explode(';', $layanan->konfirmasi) as $konfirmasi)
                                            <li>{{ $konfirmasi }}</li>
                                        @endforeach
                                    </ul>
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
