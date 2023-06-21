@extends('layouts.app')

@section('title', 'FAQ')

@section('head')
@endsection

@section('content')
    <section class="our-services">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h5>FAQ</h5>
                    <p>Frequently Asked Questions merupakan kumpulan pertanyaan-pertanyaan yang sering diajukan oleh
                        mahasiswa aktif, alumni dan calon mahasiswa Politeknik Negeri Subang. Jika pertanyaan dan jawaban
                        yang dicari tidak tersedia, silahkan mengakses menu Chatbot atau mengajukan pertanyaan melalui menu
                        Buat Tiket. </p>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="ukt-tab" data-toggle="tab" data-target="#ukt"
                                type="button" role="tab" aria-controls="ukt" aria-selected="true">UKT</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="beasiswa-tab" data-toggle="tab" data-target="#beasiswa"
                                type="button" role="tab" aria-controls="beasiswa"
                                aria-selected="false">Beasiswa</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kelulusan-tab" data-toggle="tab" data-target="#kelulusan"
                                type="button" role="tab" aria-controls="kelulusan"
                                aria-selected="false">Kelulusan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pmb-tab" data-toggle="tab" data-target="#pmb" type="button"
                                role="tab" aria-controls="pmb" aria-selected="false">PMB</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="perkuliahan-tab" data-toggle="tab" data-target="#perkuliahan"
                                type="button" role="tab" aria-controls="perkuliahan"
                                aria-selected="false">Perkuliahan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="surat-tab" data-toggle="tab" data-target="#surat" type="button"
                                role="tab" aria-controls="surat" aria-selected="false">Surat Menyurat</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="ukt" role="tabpanel" aria-labelledby="ukt-tab">
                            @foreach ($faqs as $faq)
                                @if ($faq->kategori == 'UKT')
                                    <div id="accordion-faq-ukt">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-faq{{ $faq->id }}" aria-expanded="false"
                                                        aria-controls="collapse-faq{{ $faq->id }}">
                                                        {{ $faq->pertanyaan }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-faq{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion-faq-ukt">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="beasiswa" role="tabpanel" aria-labelledby="beasiswa-tab">
                            @foreach ($faqs as $faq)
                                @if ($faq->kategori == 'beasiswa')
                                    <div id="accordion-faq-beasiswa">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-faq{{ $faq->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-faq{{ $faq->id }}">
                                                        {{ $faq->pertanyaan }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-faq{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordion-faq-beasiswa">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="kelulusan" role="tabpanel" aria-labelledby="kelulusan-tab">
                            @foreach ($faqs as $faq)
                                @if ($faq->kategori == 'kelulusan')
                                    <div id="accordion-faq-kelulusan">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-faq{{ $faq->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-faq{{ $faq->id }}">
                                                        {{ $faq->pertanyaan }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-faq{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordion-faq-kelulusan">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="pmb" role="tabpanel" aria-labelledby="pmb-tab">
                            @foreach ($faqs as $faq)
                                @if ($faq->kategori == 'PMB')
                                    <div id="accordion-faq-pmb">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-faq{{ $faq->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-faq{{ $faq->id }}">
                                                        {{ $faq->pertanyaan }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-faq{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordion-faq-pmb">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="perkuliahan" role="tabpanel" aria-labelledby="perkuliahan-tab">
                            @foreach ($faqs as $faq)
                                @if ($faq->kategori == 'perkuliahan')
                                    <div id="accordion-faq-perkuliahan">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-faq{{ $faq->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-faq{{ $faq->id }}">
                                                        {{ $faq->pertanyaan }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-faq{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordion-faq-perkuliahan">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="surat" role="tabpanel" aria-labelledby="surat-tab">
                            @foreach ($faqs as $faq)
                                @if ($faq->kategori == 'surat menyurat')
                                    <div id="accordion-faq-surat">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-faq{{ $faq->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-faq{{ $faq->id }}">
                                                        {{ $faq->pertanyaan }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse-faq{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordion-faq-surat">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
