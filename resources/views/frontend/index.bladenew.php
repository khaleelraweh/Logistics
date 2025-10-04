@extends('layouts.app')

@section('content')

    <!-- Start Landing Section -->
    <div class="landing" id="home">
        <div class="overlay"></div>
        <div class="wrapper">
            @if($mainSliders->count() > 0)
            <div class="bxslider">
                @foreach($mainSliders as $slider)
                <div class="text wow fadeIn" data-wow-duration="1s">
                    <div class="content wow fadeInDown" data-wow-duration="1s">
                        <h2>{{ $slider->title ?? 'نظام لوجستي متكامل' }}</h2>
                        <p>{{ $slider->description ?? 'نقدم حلول لوجستية متكاملة' }}</p>
                        @if($slider->show_btn_title && $slider->btn_title)
                        <a href="{{ $slider->url ?? '#services' }}" class="btn btn-primary mt-3" target="{{ $slider->target ?? '_self' }}">
                            {{ $slider->btn_title ?? 'اعرف المزيد' }}
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text wow fadeIn" data-wow-duration="1s">
                <div class="content wow fadeInDown" data-wow-duration="1s">
                    <h2>نظام لوجستي متكامل <br />لإدارة سلاسل التوريد</h2>
                    <p>نقدم حلول لوجستية متكاملة تشمل إدارة المستودعات، التخزين، النقل، والتوصيل</p>
                    <a href="#services" class="btn btn-primary mt-3">اكتشف خدماتنا</a>
                </div>
            </div>
            @endif
        </div>
        <i class="fa-solid fa-angles-up" id="up"></i>
    </div>
    <!-- End Landing Section -->

    <!-- Start Partners Section -->
    @if($partners->count() > 0)
    <div class="services" id="partners">
        <div class="container">
            <div class="main-heading wow fadeIn" data-wow-duration="2s">
                <h2>شركاؤنا</h2>
                <p>نعمل مع أفضل الشركاء لتقديم حلول لوجستية متكاملة</p>
            </div>
            <div class="services-container">
                @foreach($partners as $partner)
                <div class="srv-box wow bounceInLeft" data-wow-duration="1s" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    @if($partner->partner_image)
                    <img src="{{ asset('assets/partners/' . $partner->partner_image) }}"
                         alt="{{ $partner->name }}"
                         style="width: 80px; height: 80px; object-fit: contain; margin-left: 30px;">
                    @else
                    <i class="fas fa-handshake fa-3x"></i>
                    @endif
                    <div class="text">
                        <h3>{{ $partner->name }}</h3>
                        <p>{{ $partner->description }}</p>
                        @if($partner->partner_link)
                        <a href="{{ $partner->partner_link }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                            زيارة الموقع
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- End Partners Section -->

    <!-- Start System Features Section -->
    @if($systemFeatures->count() > 0)
    <div class="design" id="features">
        <div class="image wow fadeInUp">
            <img src="{{ asset('frontend/images/system-features.png') }}" alt="مميزات النظام" />
        </div>
        <div class="text wow fadeInRight">
            <h2>مميزات نظامنا</h2>
            <ul>
                @foreach($systemFeatures as $feature)
                <li>
                    @if($feature->icon)
                    <i class="{{ $feature->icon }} me-2"></i>
                    @endif
                    {{ $feature->title }}
                </li>
                @endforeach
            </ul>
            <a href="#contact" class="btn btn-light mt-3">اطلب الخدمة</a>
        </div>
    </div>
    @endif
    <!-- End System Features Section -->

    <!-- Start System Modules Section -->
    @if($systemModules->count() > 0)
    <div class="services" id="modules" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="main-heading wow fadeIn" data-wow-duration="2s">
                <h2>وحدات النظام</h2>
                <p>نظام متكامل يشمل جميع الوحدات اللازمة لإدارة عملياتك اللوجستية</p>
            </div>
            <div class="services-container">
                @foreach($systemModules as $module)
                <div class="srv-box wow bounceInRight" data-wow-duration="1s" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    @if($module->icon)
                    <i class="{{ $module->icon }} fa-3x"></i>
                    @else
                    <i class="fas fa-cube fa-3x"></i>
                    @endif
                    <div class="text">
                        <h3>{{ $module->title }}</h3>
                        <p>{{ $module->description }}</p>
                        @if($module->link)
                        <a href="{{ $module->link }}" class="btn btn-outline-primary btn-sm mt-2">استكشاف</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- End System Modules Section -->

    <!-- Start Testimonials Section -->
    @if($testimonials->count() > 0)
    <div class="our-skill" id="testimonials">
        <div class="main-heading wow fadeIn" data-wow-duration="1s">
            <h2>شهادات نعتز بها</h2>
            <p>آراء عملائنا الكرام الذين وثقوا في خدماتنا اللوجستية</p>
        </div>
        <div class="container">
            <div class="testimonials wow fadeInLeft" data-wow-duration="1s">
                <h2>آراء العملاء</h2>
                <p>نفتخر بثقة عملائنا ونعمل باستمرار لتطوير خدماتنا</p>
                <div class="main-content">
                    <div class="popular">
                        <div class="bx-content">
                            @foreach($testimonials as $index => $testimonial)
                            @if($index % 2 == 0)
                            <div class="content wow fadeInUp" data-wow-delay="{{ ($index/2 + 0.5) }}s">
                                @if($testimonial->image)
                                <img src="{{ asset('assets/testimonials/' . $testimonial->image) }}"
                                     alt="{{ $testimonial->name }}" />
                                @else
                                <img src="{{ asset('frontend/images/skills-01.jpg') }}" alt="عميل" />
                                @endif
                                <div class="text">
                                    {{ $testimonial->content }}
                                    <p>{{ $testimonial->name }} - {{ $testimonial->title }}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="bx-content">
                            @foreach($testimonials as $index => $testimonial)
                            @if($index % 2 == 1)
                            <div class="content wow fadeInUp" data-wow-delay="{{ (($index-1)/2 + 1) }}s">
                                @if($testimonial->image)
                                <img src="{{ asset('assets/testimonials/' . $testimonial->image) }}"
                                     alt="{{ $testimonial->name }}" />
                                @else
                                <img src="{{ asset('frontend/images/skills-02.jpg') }}" alt="عميل" />
                                @endif
                                <div class="text">
                                    {{ $testimonial->content }}
                                    <p>{{ $testimonial->name }} - {{ $testimonial->title }}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="skills wow fadeInRight" data-wow-duration="1s">
                <h2>إحصائياتنا</h2>
                <p>أرقام تدل على ثقة عملائنا في خدماتنا</p>
                <div class="prog-holder wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h4>رضا العملاء</h4>
                    <div class="prog">
                        <span style="width: 95%" data-progress="95%"></span>
                    </div>
                </div>
                <div class="prog-holder wow bounceInUp" data-wow-duration="1.1s" data-wow-delay="0.5s">
                    <h4>سرعة التوصيل</h4>
                    <div class="prog">
                        <span style="width: 90%" data-progress="90%"></span>
                    </div>
                </div>
                <div class="prog-holder wow bounceInUp" data-wow-duration="1.2s" data-wow-delay="0.5s">
                    <h4>دقة التتبع</h4>
                    <div class="prog">
                        <span style="width: 98%" data-progress="98%"></span>
                    </div>
                </div>
                <div class="prog-holder wow bounceInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">
                    <h4>الأمان والموثوقية</h4>
                    <div class="prog">
                        <span style="width: 99%" data-progress="99%"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- End Testimonials Section -->

    <!-- Start Common Questions Section -->
    @if($commonQuestions->count() > 0)
    <div class="pricing" id="faq">
        <div class="container">
            <div class="main-heading">
                <h2>الأسئلة الشائعة</h2>
                <p>أجوبة على أكثر الأسئلة شيوعاً حول خدماتنا اللوجستية</p>
            </div>
            <div class="plans">
                @foreach($commonQuestions as $question)
                <div class="plan wow fadeInLeft" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    <div class="head">
                        <h3>سؤال</h3>
                        <span>?</span>
                    </div>
                    <ul>
                        <li><strong>{{ $question->title }}</strong></li>
                        <li>{{ Str::limit($question->description, 150) }}</li>
                    </ul>
                    <div class="foot">
                        <a href="#contact">استفسر أكثر</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- End Common Questions Section -->

    <!-- Start Contact Section -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="main-heading wow fadeIn" data-wow-duration="1s">
                <h2>تواصل معنا</h2>
                <p>نحن هنا لمساعدتك في جميع استفساراتك اللوجستية</p>
            </div>
            <div class="content wow bounceIn" data-wow-duration="1s">
                <form action="#" method="POST">
                    @csrf
                    <input class="main-input" placeholder="اسمك الكريم" type="text" name="name" required />
                    <input class="main-input" placeholder="بريدك الإلكتروني" type="email" name="email" required />
                    <input class="main-input" placeholder="الموضوع" type="text" name="subject" required />
                    <textarea class="main-input" placeholder="رسالتك" name="message" required></textarea>
                    <input type="submit" value="إرسال الرسالة" />
                </form>
                <div class="info">
                    <h4>معلومات التواصل</h4>
                    <span>+966 123 456 789</span>
                    <span>info@logistics.com</span>
                    <h4>عنواننا</h4>
                    <address>
                        المملكة العربية السعودية<br />
                        الرياض، حي العليا<br />
                        شارع الملك فهد<br />
                    </address>
                    <h4>ساعات العمل</h4>
                    <span>الأحد - الخميس: 8 ص - 5 م</span>
                    <span>الجمعة - السبت: مغلق</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Section -->

@endsection
