@extends('layouts.app')

@section('title', 'Kalender Akademik')

@section('head')
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <h4>Kalender Akademik Tahun Ajaran {{ $kalender->tahun_ajaran }}</h4>
            <p>Berikut adalah kalender akademik tahun ajaran {{ $kalender->tahun_ajaran }}. Mohon untuk selalu memperhatikan
                kalender akademik ini.</p>

            <embed src="{{ asset('storage/kalender-akademik/' . $kalender->file) }}" style="
                width: 100%;
                height: 80vh;
                " />
        </div>
    </section>
@endsection

@section('script')

@endsection
