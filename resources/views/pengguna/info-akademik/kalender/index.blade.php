@extends('layouts.app')

@section('title', 'Kalender Akademik')

@section('head')
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <h4>Kalender Akademik</h4>
            <p>Berikut adalah kalender akademik {{count($kalenders)}} tahun terkahir. Mohon untuk selalu memperhatikan
                kalender akademik ini.</p>

            <div id="accordion" class="mt-3">
                @foreach($kalenders as $item)
                <div class="card">
                    <div class="card-header" id="heading{{$item->id}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$item->id}}"
                                aria-expanded="@if($loop->first) true @else false @endif" aria-controls="collapse{{$item->id}}">
                                Tahun Ajaran {{ $item->tahun_ajaran }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{$item->id}}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading{{$item->id}}" data-parent="#accordion">
                        <div class="card-body">
                            <embed src="{{ asset('storage/kalender-akademik/' . $item->file) }}"
                                style="
                                width: 100%;
                                height: 80vh;
                                " />
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
