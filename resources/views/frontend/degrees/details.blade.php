@extends('frontend.layouts.app')
@push('title')
    {{ __('Home') }}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <section class="inner-breadcrumb-section">
        <div class="container">
            <div class="inner-breadcrumb-wrap" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="inner-breadcrumb-title">{{__('Degrees')}}</h4>
                <ol class="breadcrumb inner-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('degrees.list')}}">{{__('Degree List')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('degree.details',$degreeDetails->slug)}}">{{ $degreeDetails->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-gap">
        <div class="container">
            <div class="row rg-20">
                <div class="col-lg-8 px-20">
                    <div class="subject-details-content ps-20" data-aos="fade-up" data-aos-duration="1000">
                        <div class="textBlock-wrap">
                            <div class="text-content">
                                <div class="imgBlock">
                                    <img src="{{ getFileUrl($degreeDetails->banner_image) }}" class="w-100" alt=""
                                    style="aspect-ratio:16/8; object-fit:cover;"
                                    />
                                </div>
                                <h4 class="title">{{ $degreeDetails->name }}</h4>
                                <p class="info pb-20">{{ $degreeDetails->universityName }}</p>
                                <div class="info-alt program-content">
                                    {!! $degreeDetails->details !!}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-40">
                            <a href="{{route('consultations.list')}}" class="sf-btn-icon-primary">
                                {{__('Book a Consultation')}}
                                <span class="icon">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                </span>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1000">
                    {{-- <div class="mb-10">
                        <div class="meet-consultant" data-background="{{ getFileUrl(getOption('cta_sidebar_image')) }}">
                            <h4 class="title">{{ getOption('cta_sidebar_title') }}</h4>
                            <a href="{{route('consultations.list')}}" class="sf-btn-icon-primary">
                                {{__('Book a Consultation')}}
                                <span class="icon">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                </span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="subject-details-sidebar bd-ra-20 bg-secondary-bg p-sm-25 p-15">
                        <h4 class="title">{{__('Details')}}</h4>
                        <ul class="zList-pb-13">
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/ranking.svg') }}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between g-5"> <span class="flex-shrink-0"> {{ __('Degree Type')}} : </span> {{$degreeDetails->degreeCategoryName}}</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/country2.svg') }}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between g-5"> <span class="flex-shrink-0"> {{ __('Country')}} : </span> {{$degreeDetails->countryName}}</p>
                                </div>
                            </li>
                            
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/time.svg')}}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between g-5"> <span class="flex-shrink-0"> {{__('Duration')}} : </span> {{$degreeDetails->duration}} Days</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/date.svg')}}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between g-5"> <span class="flex-shrink-0"> {{__('Next Intake')}} : </span> {{$degreeDetails->intake_time}}</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/cap-2.svg')}}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between g-5"> <span class="flex-shrink-0"> {{__('Minimum Qualification')}} : </span> {{$degreeDetails->studyLevelName}}</p>
                                </div>
                            </li>
                            @if($degreeDetails->requirement_program)
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/score.svg')}}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between  flexp-wrap g-5"> <span class=""> {{$degreeDetails->requirement_program}} : </span> <span class="flex flex-shrink-0">
                                        {{$degreeDetails->requirement_score}} %</span></p>
                                </div>
                            </li>
                            @endif
                            <li class="item">
                                <div class="left w-100">
                                    <div class="icon"><img src="{{ asset('assets/images/icon/price.svg') }}" alt="" /></div>
                                    <p class="fs-16 fw-400 lh-28 text-para-text d-flex flex-grow-1 justify-content-between g-5"> <span class="flex-shrink-0"> {{__('Total Fees / Amount')}} : </span> {{showPrice($degreeDetails->amount)}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related -->
    @if($exploreDegrees->isNotEmpty()) 
    <section class="section-gap bg-secondary-bg">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="section-content-wrap max-w-550 m-auto">
                <h4 class="section-title text-center pb-0">{{__('Explore All Degrees')}}</h4>
            </div>
            <div class="swiper threeSlider">
                <div class="swiper-wrapper">
                    @foreach($exploreDegrees as $data)
                        <div class="swiper-slide">
                            <div class="course-item-two">
                                <a href="{{ route('degree.details',$data->degreeSlug) }}" class="img">
                                    <img src="{{ getFileUrl($data->degreeBannerImage) }}" alt=" {{ $data->degreeName }}" />
                                </a>
                                <div class="course-content">
                                    <div class="text-content">
                                        <h4 class="title">{{$data->degreeName}}</h4>
                                        {{-- <p class="author">{{$data->degreeCategoryName}}</p> --}}
                                    </div>
                                    <ul class="list zList-pb-6">
                                        <li class="item">
                                            <div class="icon d-flex">
                                                <img src="{{asset('assets/images/icon/qualification.svg')}}" alt=""/>
                                            </div>
                                            <p class="text">{{$data->degreeCategoryName}}</p>
                                        </li>
                                        <li class="item">
                                            <div class="icon d-flex">
                                                <img src="{{asset('assets/images/icon/country.png')}}" alt=""/>
                                            </div>
                                            <p class="text">{{$data->countryName}}</p>
                                        </li>
                                        <li class="item">
                                            <div class="icon d-flex"><img src="{{asset('assets/images/icon/next-course.svg')}}" alt="" /></div>
                                            <p class="text">{{__('Intake Date')}} : {{ \Carbon\Carbon::parse($data->degreeIntakeTime )->format('Y-m-d')}}</p>
                                        </li>
                                    </ul>
                                    <a href="{{ route('degree.details',$data->degreeSlug) }}" class="link">{{__('More Details')}} <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="sliderControls">
                    <div class="swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                            <path d="M8.82617 1.87305L4.01367 6.68555L3.71289 7L4.01367 7.31445L8.82617 12.127L9.45508 11.498L4.95703 7L9.45508 2.50195L8.82617 1.87305Z" fill="#999999" />
                        </svg>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                            <path d="M6.17383 1.87305L5.54492 2.50195L10.043 7L5.54492 11.498L6.17383 12.127L10.9863 7.31445L11.2871 7L10.9863 6.68555L6.17383 1.87305Z" fill="#999999" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
     @endif
     <style>
.program-content table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.program-content table, .program-content th, .program-content td {
    border: 1px solid #ddd;
}
.program-content th, .program-content td {
    padding: 8px 10px;
    text-align: left;
}
.program-content img {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
    border-radius: 5px;
}
.program-content p {
    margin-bottom: 15px;
}
.program-content ul {
    padding-left: 20px;
    margin-bottom: 15px;
}
.program-content ol {
    padding-left: 20px;
    margin-bottom: 15px;
}
.responsive-container {
    width: 80%;       /* Main width for desktop */
    max-width: 1200px; /* Optional max cap */
    margin: 0 auto;
    line-height: 1.6;
    font-size: 16px;
    color: #333;
}

/* Mobile adjustment */
@media (max-width: 768px) {
    .responsive-container {
        width: 95%;  /* Wider on mobile to utilize space */
        padding: 0 10px;
        font-size: 15px;
    }
}
</style>
@endsection
