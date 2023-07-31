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
                        @foreach ($kategoris as $kategori)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if ($loop->first) active @endif"
                                    id="{{ $kategori->id }}-tab" data-toggle="tab" data-target="#p-{{ $kategori->id }}"
                                    type="button" role="tab" aria-controls="p-{{ $kategori->id }}"
                                    aria-selected="true">
                                    {{ $kategori->nama }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach ($kategoris as $kategori)
                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                id="p-{{ $kategori->id }}" role="tabpanel" aria-labelledby="{{ $kategori->id }}-tab">
                                @foreach ($kategori->faqs as $faq)
                                    <div id="accordion-faq-{{ $faq->id }}">
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
                                                aria-labelledby="heading{{ $faq->id }}"
                                                data-parent="#accordion-faq-{{ $faq->id }}">
                                                <div class="card-body">
                                                    {!! $faq->jawaban !!}

                                                    @if ($faq->attachments->count() > 0)
                                                        <hr />
                                                        <div class="font-weight-bold mb-2">Attachments:</div>
                                                        <div class="d-flex">
                                                            @foreach ($faq->attachments as $attachment)
                                                                <div class="mr-1">
                                                                    <a href="{{ asset('storage/faq/' . $attachment->nama) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary mb-1"
                                                                        title="{{ $attachment->nama }}">
                                                                        <i class="mdi mdi-download"></i>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
