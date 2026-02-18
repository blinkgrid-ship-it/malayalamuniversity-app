@extends('frontend.layouts.app')
@push('title')
    {{ __('Home') }}
@endpush
@section('content')
    <!-- Hero Banner -->
    @if(getOption('hero_banner_status') == STATUS_ACTIVE)
        <section class="hero-banner-section">
            <div class="container-fluid">

                   <div class="row">
                <div class="hero-banner-content" data-background="{{ asset('assets/images/banner.jpg') }}">

                    <div class="row">
                        <div class="col-md-6">
                             <h4 class="title">{{ getOption('banner_title') }}</h4>
                    <p class="info">{{ getOption('banner_description') }}</p>
                     <a href="{{route('register')}}" class="sf-btn-icon-primary position-relative z-index-1">
                        {{__('Register Now')}}
                        <span class="icon">
                            <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                            <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                        </span>
                    </a>
                        </div>
                        <div class="col-md-6">
                            <!-- <img src="{{getFileUrl(getOption('banner_image')) }}"> -->
                        </div>

                    </div>
                   
                   
                </div>
            </div>
            </div>
        </section>


            <div class="container">

                    <!-- The University  Impact ||| --Why Choose Us -->
    @if(getOption('why_choose_us_status') == STATUS_ACTIVE)
 
                <div class="section-content-wrap max-w-550 m-auto mt-100" data-aos="fade-up" data-aos-duration="1000">
                    <h4 class="section-title text-center">{{__('The University  Impact')}}</h4>
                    <p class="section-info text-center">{{__('We support learners and institutions through structured programs, accessible courses, and reliable academic services designed for diverse educational needs.')}}</p>
                </div>
                <div class="choose-items-wrap" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row rg-20">
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="choose-item">
                                <div class="icon"><img src="{{ asset('assets/images/icon/choose-icon-1.svg') }}"
                                                       alt=""/></div>
                                <h4 class="title"> {{ getOption('why_choose_us_partnering_universities') ?? 0}} </h4>
                                <p class="info">{{__('Affiliations')}}</p>
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
                                <p class="info">{{__('Students')}}</p>
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
        
      
    @endif

{{-- Course listing --}}
    
         <div class="hero-banner-filterWrap mb-100">

              <div class="section-content-wrap max-w-550 m-auto">
            <h4 class="section-title text-center">{{ __('Be Career-Ready with 150+ Degree Programs') }}</h4>
            <p class="section-info text-center">{{ __('Pursue your passion or explore the possibilities') }}</p>
        </div>
        

    <!-- Single Tab Navigation for BOTH filter form AND listings -->
    <div class="zTab-wrap ">
        <ul class="nav nav-tabs zTab-reset zTab-one" id="featuredListingsTab" role="tablist">

            @foreach ($programms as $program)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{  $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#courses-{{ $program->id }}" type="button" role="tab"
                       
                        aria-selected="true">{{ $program->title  }}
                </button>
            </li>
            @endforeach
            
        </ul>
    </div>
    
    <!-- Tab Content for FILTER FORMS -->
    <div class="tab-content" id="featuredListingsTabContent">
        <!-- Courses Tab Content - Form -->



            @foreach ($programms as $program)
        <div class="tab-pane fade  {{  $loop->first ? 'active show' : '' }}" id="courses-{{ $program->id }}" role="tabpanel" aria-labelledby="courses-tab"
             tabindex="0">
                 
                 


                            <div class="row mb-20">
                            @foreach($program['courses'] as $course)

                                    <div class="col-md-4 mb-20">

                                        <div class="discover-item-one">
                                    <a href="{{ route('courses.single', $course->slug) }}"  class="img">
                                        <img src={{getFileUrl($course->thumbnail)}} alt="">
                                    </a>
                                    <div class="content">
                                        <h4 class="title">{{ $course->title }}</h4>
                                        <p class="info">{{ getSubText($course->description ?? '', 100) }}</p>
                                        <a href="{{ route('courses.single', $course->slug) }}" class="link">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>

        
                                    </div>
                            @endforeach
                            </div>
                             <div class="text-center mt-40">
                        <a href="/courses" class="sf-btn-icon-primary">
                            {{ __('View All Courses') }}
                            <span class="icon">
                                <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                            </span>
                        </a>
                    </div>



             </div>
         @endforeach
    
    
    

        
    </div>
    

    
</div>


                
            </div>
        </section>
    @endif
    <!-- Discover -->
    @php
    $serviceImage = getOption('our_service_image')
        ? getFileUrl(getOption('our_service_image'))
        : asset('assets/images/service-left-imga.png');
    @endphp
    <!-- @if(getOption('service_status') == STATUS_ACTIVE)
        <section class="position-relative section-gap bg-secondary-bg z-index-1" id="serviceSection">
            <div class="container">
                <div class="row rg-24" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-lg-4">
                        <div class="service-content-left">
                            <h4 class="section-title">{{__('Our Services')}}</h4>
                            <p class="section-info">{{__('We help you explore university programs, learning opportunities, and supportive services for students and communities worldwide..')}}</p>
                            <div class="img"><img src="{{ $serviceImage }}" alt=""></div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row rg-24">
                            @foreach($serviceData as $data)
                                <div class="col-sm-6">
                                    <div class="service-item-one">
                                        <div class="icon"><img src="{{ getFileUrl( $data->icon ) }}" alt=""/></div>
                                        <a href="{{ route('service.details',$data->slug) }}"
                                           class="title">{{ $data->title }}</a>
                                        <p class="info">{!! getSubText($data->description ,85)  !!}</p>
                                        <a href="{{route('service.details',$data->slug)}}" class="link">{{__('Read More')}} <i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif -->






    <!-- About Us -->
    {{-- @if(getOption('about_us_status') == STATUS_ACTIVE)
        @if($aboutUs)
            <section class="section-gap home-about-section bg-brand-primary" data-background="{{asset('assets/images/about-bg-shape.svg')}}">
                <div class="container">
                    <div class="home-about-content" data-aos="fade-up" data-aos-duration="1000">
                        <h4 class="section-title text-white">{{ $aboutUs->title }}</h4>
                        <p class="info">{{ $aboutUs->details }}</p>
                        <div class="about-list">
                            @foreach($aboutUs->about_us_point ?? [] as $point)
                                <div class="item"><div class="icon"></div><p class="text">{{$point['point']}}</p></div>
                            @endforeach
                        </div>
                        <a href="{{route('consultations.list')}}" class="sf-btn-icon-primary">
                            {{__('Book a Consultation')}}
                            <span class="icon">
                                <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                            </span>
                        </a>
                    </div>
                    <div class="home-about-content-img" data-aos="fade-up" data-aos-duration="1000">
                        <div class="imgWrap"><img src="{{ getFileUrl( $aboutUs->banner_image[0] ?? '') }}" alt=""></div>
                        <div class="textWrap">
                            <h4 class="title">{{ getOption('why_choose_us_global_students') ?? 0 }}+</h4>
                            <p class="info">{{__('Students successfully placed in universities worldwide')}}</p>
                        </div>
                        <div class="textWrap">
                            <h4 class="title">{{ getOption('student_visa_approval_rate') ?? 0 }}%</h4>
                            <p class="info">{{__('Student visa approval rate')}}</p>
                        </div>
                        <div class="imgWrap"><img src="{{ getFileUrl($aboutUs->banner_image[1] ?? '') }}" alt=""></div>
                    </div>
                </div>
            </section>
        @endif
    @endif --}}

    <!-- How We Work -->
    {{-- @if(getOption('how_we_work_status') == STATUS_ACTIVE)
        <section class="howWork-section section-gap-top" id="howWeWork">
            <div class="container">
                <div class="section-content-wrap max-w-550 m-auto" data-aos="fade-up" data-aos-duration="1000">
                    <h4 class="section-title text-center">{{__('How We Work')}}</h4>
                    <p class="section-info text-center max-w-550 m-auto">{{__('We work collaboratively with students to provide tailored solutions for their study abroad needs.')}}</p>
                </div>
                <!--  -->
                <div class="howWork-wrap" data-aos="fade-up" data-aos-duration="1000">
                    <div class="howWork-stepWrap">
                        <div class="row justify-content-center align-items-start flex-lg-nowrap rg-20">
                            @foreach($titles as $index => $title)
                                <div class="col-lg-auto col-md-4 col-sm-6">
                                    <div class="howWork-item">
                                        <div class="noWrap">
                                            <p class="no">0{{ $index + 1 }}</p>
                                            <div class="bar"></div>
                                        </div>
                                        <div class="text-content">
                                            <h4 class="title">{{ $title }}</h4>
                                            <p class="info">{{ $descriptions[$index] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="howWork-videoWrap sf-popup-gallery" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{getFileUrl(getOption('how_we_work_image'))}}" alt=""/>
                    <a href="{{getFileUrl(getOption('how_we_work_video'))}}" class="video"><i
                            class="fa-solid fa-play"></i></a>
                </div>
            </div>
        </section>
    @endif --}}


@if(getOption('blog_article_status') == STATUS_ACTIVE)
<section class="section-gap section-gap-margin-top bg-brand-primary"
         data-background="{{ asset('assets/images/book-your-consultation.svg') }}">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="row rg-24 justify-content-between align-items-center pb-24">
            <div class="col-lg-5">
                <div class="max-w-473">
                    <h4 class="section-title text-white mb-24">
                        <!--{{ __('Insights, Inspiration, and Innovation.') }}-->
                        {{ __('Our Academic Departments') }}
                    </h4>
                    <!--<a href="{{ route('blog.list') }}" class="sf-btn-icon-primary">-->
                        <!--{{ __('More Articles') }}-->
                    <!--    {{ __('View All') }}-->
                    <!--    <span class="icon">-->
                    <!--        <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">-->
                    <!--        <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">-->
                    <!--    </span>-->
                    <!--</a>-->
                </div>
            </div>

            <div class="col-lg-7">
                @if($blogData->isNotEmpty())
                    <div class="blog-item-one">
                        <div class="topContent">
                            <div class="author">
                                <!--<img src="{{ getFileUrl($blogData[0]->userImage) }}" alt="">-->
                                <div class="nameDegi">
                                    <!--<h4 class="name">{{ $blogData[0]->userName }}</h4>-->
                                    <h4 class="name">{{ $blogData[0]->title }}</h4>
                                    <!--<p class="degi">{{ $blogData[0]->userDesignation }}</p>-->
                                </div>
                            </div>
                            <!--<div class="date">-->
                            <!--    <p>{{ \Carbon\Carbon::parse($blogData[0]->publish_date)->format('M jS Y') }}</p>-->
                            <!--</div>-->
                        </div>

                        <a href="#" class="img">
                            <img src="{{ getFileUrl($blogData[0]->banner_image) }}" alt=""/>
                        </a>

                        <div class="content">
                            <!--<a href="{{ route('blog.details', $blogData[0]->slug) }}" class="title">-->
                               
                                {{ $blogData[0]->meta_title }}
                            <!--</a>-->
                            <!--<a href="{{ route('blog.details', $blogData[0]->slug) }}" class="link">-->
                            <!--    {{ __('Read More') }} <i class="fa-solid fa-arrow-right"></i>-->
                            <!--</a>-->
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row rg-12">
            @foreach($blogData->skip(1)->take(3) as $data)
                <div class="col-12 col-md-6 ">
                    <div class="blog-item-one">
                        <div class="topContent">
                            <div class="author">
                                <!--<img src="{{ getFileUrl($data->userImage) }}" alt="">-->
                                <div class="nameDegi">
                                    <!--<h4 class="name">{{ $data->userName }}</h4>-->
                                    <!--<p class="degi">{{ $data->userDesignation }}</p>-->
                                     <h4 class="name">{{ $data->title }}</h4>
                                </div>
                            </div>
                            <!--<div class="date">-->
                            <!--    <p>{{ \Carbon\Carbon::parse($data->publish_date)->format('M jS Y') }}</p>-->
                            <!--</div>-->
                        </div>

                        <a href="#" class="img" style="width:100%; min-height:400px; object-fit:cover; display:block;">
                            <img src="{{ getFileUrl($data->banner_image) }}" alt="" style="width:100%; min-height:500px; object-fit:cover; display:block;"/>
                        </a>

                        <div class="content">
                            <a href="#" class="title">
                                <!--{{ $data->title }}-->
                                {{ $data->meta_title  }}
                            </a>
                            <!--<a href="{{ route('blog.details', $data->slug) }}" class="link">-->
                            <!--    {{ __('Read More') }} <i class="fa-solid fa-arrow-right"></i>-->
                            <!--</a>-->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif




    <!-- FAQ -->
    @if(getOption('faq_status') == STATUS_ACTIVE)
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
    @endif

    <!-- Testimonials -->
    @if(getOption('testimonial_status') == STATUS_ACTIVE)
        <section class="section-gap-top overflow-hidden">
            <div class="container">
                <div class="section-content-wrap max-w-550 m-auto" data-aos="fade-up" data-aos-duration="1000">
                    <h4 class="section-title text-center">{{__('What Our Student Says')}}</h4>
                    <p class="section-info text-center">{{__('Feedback from students describing their experience with our academic programs and services.')}}</p>
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
    @endif
@endsection
@push('script')
    <script src="{{ asset('frontend/js/frontend.js') }}"></script>
@endpush

<!-- Add this JavaScript to sync the two tab panes -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all tab buttons
    const tabButtons = document.querySelectorAll('#featuredListingsTab button[data-bs-toggle="tab"]');
    
    tabButtons.forEach(button => {
        button.addEventListener('shown.bs.tab', function(event) {
            const targetId = event.target.getAttribute('data-bs-target');
            const tabId = event.target.id.replace('-tab', '');
            
            // Show the corresponding listings pane
            const listingsPaneId = tabId + '-listings-pane';
            const listingsPane = document.getElementById(listingsPaneId);
            
            if (listingsPane) {
                // Hide all listings panes
                document.querySelectorAll('.tab-content.mt-20 .tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                
                // Show the active listings pane
                listingsPane.classList.add('show', 'active');
            }
        });
    });
});
</script>