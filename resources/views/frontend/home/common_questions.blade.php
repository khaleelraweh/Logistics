<div class="rs-faq-part style1 orange-color pt-100 pb-100 md-pt-70 md-pb-70 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 padding-0">
                <div class="main-part">
                    <div class="title mb-40 md-mb-15">
                        <h2 class="text-part">{{ __('panel.faq_title') ?? 'Frequently Asked Questions' }}</h2>
                    </div>
                    <div class="faq-content">
                        <div id="accordion" class="accordion">
                            @foreach($common_questions as $index => $question)
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link {{ $index !== 0 ? 'collapsed' : '' }}" data-toggle="collapse"
                                           href="#collapse{{ $index }}">
                                            {{ $question->getTranslation('title', app()->getLocale()) }}
                                        </a>
                                    </div>
                                    <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}" data-parent="#accordion">
                                        <div class="card-body">
                                            {!! $question->getTranslation('description', app()->getLocale()) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if($common_questions->isEmpty())
                                <p class="text-muted">{{ __('panel.no_questions_found') ?? 'No questions available yet.' }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 padding-0">
                <div class="img-part media-icon orange-color">
                    <a class="popup-videos" href="https://www.youtube.com/watch?v=atMUy_bPoQI">
                        <i class="fa fa-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
