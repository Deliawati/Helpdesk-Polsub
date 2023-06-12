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

                    <div id="accordion-faq">
                        @foreach ($faqs as $faq)
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
                                    aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion-faq">
                                    <div class="card-body">
                                        {!! $faq->jawaban !!}
                                    </div>
                                </div>
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
