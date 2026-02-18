@extends('frontend.layouts.app')
@push('title')
    {{ __('Home') }}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <section class="inner-breadcrumb-section bg-white">
        <div class="container">
            <div class="inner-breadcrumb-wrap" data-aos="fade-up" data-aos-duration="1000">
            <h4 class="inner-breadcrumb-title">{{__('About Us')}}</h4>
            <ol class="breadcrumb inner-breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('frontend')}}">{{__('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('about-us.details')}}">{{__('About Us Details')}}</a></li>
            </ol>
        </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="section-gap-top overflow-hidden bg-white pb-20">
        <div class="container">
            <div class="section-content-wrap" data-aos="fade-up" data-aos-duration="1000">
                <div class="row rg-20 justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <h4 class="section-title text-center">{{$aboutUs->title ?? ''}}</h4>
                    </div>
                    <div class="col-lg-5">
                        <p class="section-info ">
                            {{$aboutUs->details ?? ''}}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Images -->
            <div class="row rg-24" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-sm-6">
                    <div class="aboutUs-img" style="aspect-ratio: 4/3.7;"><img src="{{getFileUrl($aboutUs->banner_image[0] ?? '')}}" alt="" /></div>
                </div>
                <div class="col-sm-6">
                    <div class="row rg-24">
                        <div class="col-12">
                            <div class="aboutUs-img"><img src="{{getFileUrl($aboutUs->banner_image[1] ?? '')}}" alt="" /></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="aboutUs-img"><img src="{{getFileUrl($aboutUs->banner_image[2] ?? '')}}" alt="" /></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="aboutUs-img"><img src="{{getFileUrl($aboutUs->banner_image[3] ?? '')}}" alt="" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Heritage --}}
    <section class="contant-gap" style="background-color: #fff0ef;">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="section-content-wrap max-w-550 m-auto">
            <h4 class="section-title text-center">{{__('A Heritage Like No Other')}}</h4>
            <p class=" text-center">{{__('The history of the Mar Thoma Christians is a testament to resilience and faith. From the arrival of St. Thomas the Apostle in 52 AD to the evolution of the unique Nasrani identity, this community has harmonized Eastern Christian spirituality with Indian cultural traditions for two millennia.')}}</p>
        </div>
        <div class="row rg-24">
            <!-- Pillar 1 -->
            <div class="col-md-4">
                <div class="heritage-pillar-card">
                    <div class="pillar-number">01</div>
                    <h4 class="pillar-title">{{__('Ecclesiastical History')}}</h4>
                    <p class="pillar-description">{{__('Chronicling the journey of the Church in Malabar through the centuries.')}}</p>
                </div>
            </div>
            <!-- Pillar 2 -->
            <div class="col-md-4">
                <div class="heritage-pillar-card">
                    <div class="pillar-number">02</div>
                    <h4 class="pillar-title">{{__('Linguistic Preservation')}}</h4>
                    <p class="pillar-description">{{__('Teaching Malayalam, the mother tongue, to ensure students can engage with primary liturgical texts and literature.')}}</p>
                </div>
            </div>
            <!-- Pillar 3 -->
            <div class="col-md-4">
                <div class="heritage-pillar-card">
                    <div class="pillar-number">03</div>
                    <h4 class="pillar-title">{{__('Cultural Identity')}}</h4>
                    <p class="pillar-description">{{__('Exploring the social customs, arts, and values that have been passed down through generations of Mar Thoma families.')}}</p>
                </div>
            </div>
        </div>
    </div>
   </section>

<!-- Why Florida -->
<section class="section-gap">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="section-content-wrap max-w-750 m-auto">
            <h4 class="section-title text-center">{{__('Why Florida?')}}</h4>
            <div class="content-box">
                <p class="section-info text-center">{{__('As a registered non-profit religious university in the State of Florida, we operate under the legal framework that allows religious institutions to offer programs focused on ecclesiastical and theological subjects. This location allows us to serve the large Malayali community in the U.S. while utilizing modern technology to reach international students in Kerala and across the globe.')}}</p>
            </div>
        </div>
    </div>
</section>
<!-- A Message to Our Students -->
{{-- <section class="section-gap message"  style="background-color: #fff0ef;">
    <div class="container " data-aos="fade-up" data-aos-duration="1000">
        <div class="section-content-wrap max-w-750 m-auto">
            <h4 class="section-title text-center">{{__('A Message to Our Students')}}</h4>
            <div class="message-box">
                <p class="section-info text-center">{{__('Whether you are a second-generation Malayali in the U.S. seeking to understand your "roots," or a student in Kerala looking to study the global impact of our heritage, Malayalam University is your home. We are more than an institution; we are a community dedicated to ensuring that the light of the Mar Thoma tradition continues to shine for another 2,000 years.')}}</p>
            </div>
        </div>
    </div>
</section> --}}
<!-- A Message to Our Students -->
<section class="message-section" style="background-color: #fff0ef;">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="message-content-wrap max-w-750 m-auto">
            <h4 class="message-title text-center">{{__('A Message to Our Students')}}</h4>
            <div class="message-box">
                <p class="message-text text-center">
                    {{__('Whether you are a second-generation Malayali in the U.S. seeking to understand your "roots," or a student in Kerala looking to study the global impact of our heritage, Malayalam University is your home. We are more than an institution; we are a community dedicated to ensuring that the light of the Mar Thoma tradition continues to shine for another 2,000 years.')}}
                </p>
            </div>
        </div>
    </div>
</section>


    <!-- History -->
    <!--<section class="bg-white overflow-hidden section-gap-top">-->
    <!--    <div class="container">-->
    <!--        <div class="section-content-wrap max-w-550 m-auto" data-aos="fade-up" data-aos-duration="1000">-->
    <!--            <h4 class="section-title text-center">{{__('Our History')}}</h4>-->
    <!--            <p class="section-info text-center">{{__('Our history at StudyJet is defined by our commitment to empowering-->
    <!--                students in their journey toward global education since our founding in 2016.')}}</p>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="history-item-wrap" data-aos="fade-up" data-aos-duration="1000">-->
    <!--        <div class="container-fluid">-->
    <!--            <div class="row justify-content-center">-->
    <!--                @foreach($aboutUs->our_history ?? [] as $history)-->
    <!--                    <div class="col-xxl-4 col-md-6">-->
    <!--                        <div class="history-item">-->
    <!--                            <div class="img"><img src="{{ getFileUrl($history['image']) }}" alt=""></div>-->
    <!--                            <div class="icon"></div>-->
    <!--                            <p class="year">{{$history['year']}}</p>-->
    <!--                            <div class="text-content">-->
    <!--                                <h4 class="title">{{$history['title']}}</h4>-->
    <!--                                <p class="info">{{$history['description']}}</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                @endforeach-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    
    <!--  -->
    <section class="section-gap bg-white">
        <div class="container">
            <div class="section-content-wrap max-w-550 m-auto" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="section-title text-center">{{__('Number Says it All')}}</h4>
                <p class="section-info text-center">{{__('Numbers speak volumes at StudyJet, showcasing our impact and success in guiding thousands of students toward their global education goals.')}}</p>
            </div>
            <div class="choose-items-wrap" data-aos="fade-up" data-aos-duration="1000">
                <div class="row rg-20">
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="choose-item">
                            <div class="icon"><img src="{{ asset('assets/images/icon/choose-icon-1.svg') }}"
                                                   alt=""/></div>
                            <h4 class="title"> {{ getOption('why_choose_us_partnering_universities') ?? 0}} </h4>
                            <p class="info">{{__('Partnering Universities')}}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="choose-item">
                            <div class="icon"><img src="{{ asset('assets/images/icon/choose-icon-2.svg') }}"
                                                   alt=""/></div>
                            <h4 class="title"> {{ getOption('why_choose_us_countries') ?? 0 }} </h4>
                            <p class="info">{{__('Countries')}}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="choose-item">
                            <div class="icon"><img src="{{ asset('assets/images/icon/choose-icon-3.svg') }}"
                                                   alt=""/></div>
                            <h4 class="title"> {{ getOption('why_choose_us_global_students') ?? 0 }} </h4>
                            <p class="info">{{__('Global Students')}}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="choose-item">
                            <div class="icon"><img src="{{ asset('assets/images/icon/choose-icon-4.svg') }}"
                                                   alt=""/></div>
                            <h4 class="title"> {{ getOption('why_choose_us_courses') ?? 0 }} </h4>
                            <p class="info">{{__('Courses')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission - Vision - Goal -->
    <section class="section-gap bg-secondary-bg" data-background="{{asset('assets/images/why-choose-us.png')}}">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="section-content-wrap max-w-627 m-auto">
                <h4 class="section-title text-center max-w-488 m-auto">{{__('We Know Exactly How to Help You for Succeed.')}}</h4>
                <p class="section-info text-center">{{__('We know exactly how to help you succeed by providing tailored support and resources for your educational journey.')}}</p>
            </div>
            <ul class="nav nav-tabs zTab-reset zTab-two" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="ourMission-tab" data-bs-toggle="tab" data-bs-target="#ourMission-tab-pane" type="button" role="tab" aria-controls="ourMission-tab-pane" aria-selected="true">{{__('Our Mission')}}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ourVision-tab" data-bs-toggle="tab" data-bs-target="#ourVision-tab-pane" type="button" role="tab" aria-controls="ourVision-tab-pane" aria-selected="false">{{__('Our Vision')}}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ourGoal-tab" data-bs-toggle="tab" data-bs-target="#ourGoal-tab-pane" type="button" role="tab" aria-controls="ourGoal-tab-pane" aria-selected="false">{{__('Our Goal')}}</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ourMission-tab-pane" role="tabpanel" aria-labelledby="ourMission-tab" tabindex="0">
                    <div class="mvg-content-wrap">
                        <div class="row rg-20 align-items-center">
                            <div class="col-lg-6">
                                <div class="mvg-content-img">
                                    <img src="{{ getFileUrl($aboutUs->our_mission_image ?? '') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mvg-content-text">
                                    <h4 class="title">{{ $aboutUs->our_mission_title ?? '' }}</h4>
                                    <p class="info">{!! $aboutUs->our_mission_details ?? '' !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ourVision-tab-pane" role="tabpanel" aria-labelledby="ourVision-tab" tabindex="0">
                    <div class="mvg-content-wrap">
                        <div class="row rg-20 align-items-center">
                            <div class="col-lg-6">
                                <div class="mvg-content-img">
                                    <img src="{{ getFileUrl($aboutUs->our_vision_image ?? '') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mvg-content-text">
                                    <h4 class="title">{{ $aboutUs->our_vision_title ?? '' }}</h4>
                                    <p class="info">{!! $aboutUs->our_vision_details ?? '' !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ourGoal-tab-pane" role="tabpanel" aria-labelledby="ourGoal-tab" tabindex="0">
                    <div class="mvg-content-wrap">
                        <div class="row rg-20 align-items-center">
                            <div class="col-lg-6">
                                <div class="mvg-content-img">
                                    <img src="{{ getFileUrl($aboutUs->our_goal_image ?? '') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mvg-content-text">
                                    <h4 class="title">{{ $aboutUs->our_goal_title ?? '' }}</h4>
                                    <p class="info">{!! $aboutUs->our_goal_details ?? '' !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Awards & Achievements -->
    <section class="section-gap bg-white">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="section-content-wrap max-w-550 m-auto">
                <h4 class="section-title text-center">{{__('Awards & Achievements')}}</h4>
                <p class="section-info text-center">{{__('Our awards and achievements highlight our commitment to excellence in guiding students toward their international education dreams.')}}</p>
            </div>
            <div class="row rg-24">
                @if(!empty($aboutUs->awards))
                    @foreach($aboutUs->awards as $award)
                        @if(!empty($award['name']) && !empty($award['image']))
                            <div class="col-md-6">
                                <div class="award-item-one">
                                    <div class="img">
                                        <img src="{{ getFileUrl($award['image']) }}" alt="" />
                                    </div>
                                    <h4 class="title">{{ $award['name'] }}</h4>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

        </div>
    </section>

    <!-- FAQ -->
    <section class="section-gap bg-secondary-bg">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="section-content-wrap max-w-606 m-auto">
                <h4 class="section-title text-center">{{__('Frequently')}}<br> {{__('Asked Question')}}</h4>
            </div>
            <div class="accordion zAccordion-reset zAccordion-two" id="accordionExample">
                @foreach($faqData as $index => $data)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" aria-controls="collapse{{ $index }}"
                                    aria-expanded="false">
                                {{ $data->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                             aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>{{ $data->answer }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section-gap-top overflow-hidden">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="section-content-wrap max-w-550 m-auto">
                <h4 class="section-title text-center">{{__('What Our Student Says')}}</h4>
                <p class="section-info text-center">{{__('Real stories from students who turned their study abroad dreams into reality with StudyJet.')}}</p>
            </div>
            <div class="swiper ladingTestimonials-slider">
                <div class="swiper-wrapper">
                    @foreach ($testimonialData as $data)
                        <div class="swiper-slide">
                            <div class="testimonial-item-one">
                                <p class="info">{{ $data->description }}</p>
                                <div class="content">
                                    <div class="text-content">
                                        <h4 class="name">— {{ $data->name }}</h4>
                                        <p class="date">{{ formatDate($data->review_date, 'F j, Y') }}</p>
                                    </div>
                                    <div class="img">
                                        <img src="{{ getFileUrl($data->image) }}" alt=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <style>
 .heritage-pillar-card{
            background-color: white;
            padding: 1.5rem;
            border-radius:16px;
        }
        .contant-gap {
            padding: 5rem 2rem;
        }
        /* Message Section */
        .message-section {
            position: relative;
            padding: 5rem 2rem;
            overflow: hidden;
            background-color: #fff0ef;
        }

        /* Decorative big quotation mark */
        .message-section::before {
            content: '“';
            font-size: clamp(6rem, 15vw, 10rem); /* responsive size */
            position: absolute;
            top: 0;
            left: 1rem;
            color: rgba(0,0,0,0.05);
            z-index: 0;
            font-family: serif;
            line-height: 1;
        }

        /* Content wraps above the quote */
        .message-content-wrap {
            position: relative;
            z-index: 1;
        }

        /* Title styling */
        .message-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 700;
            color: #333;
        }

        /* Message box & text */
        .message-box {
            text-align: center;
        }

        .message-text {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #555;
        }

        /* Responsive padding for the section */
        @media (max-width: 768px) {
            .message-section {
                padding: 3rem 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .message-section {
                padding: 2rem 1rem;
            }

            .message-section::before {
                left: 0.5rem; /* adjust quote position on small screens */
            }
        }
</style>
@endsection
