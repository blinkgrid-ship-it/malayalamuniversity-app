@extends('frontend.layouts.app')
@push('title')
    {{ $universityData->name }}
@endpush
@section('content')
    <section class="course-single-content-wrap">
        <div class="course-single-overlay bg-red" data-background="{{asset('assets/images/bread.jpg')}}"></div>
        <div class="container">
            <div class="row rg-24">
                <div class="col-lg-8">
                    <div class="course-single-content" data-aos="fade-up" data-aos-duration="1000">
                        <!-- University Header -->
                        <div class="text-content">
                            <h4 class="title">{{ $universityData->name }}</h4>
                            <p class="info">{{ $universityData->countryName }}</p>
                            <!-- <p class="author">
                                {{__('World Ranking')}}: #{{ $universityData->world_ranking }}
                            </p> -->
                        </div>

                        <!-- Navigation Links -->
                        <div class="course-single-link">
                            <a href="#universityDetails" class="link">{{__('Details')}}</a>
                            <!-- <a href="#universitySubjects" class="link">{{__('Subjects')}}</a> -->
                            <a href="#universityBenefits" class="link">{{__('Core Benefits')}}</a>
                            <a href="#universityGallery" class="link">{{__('Gallery')}}</a>
                            <a href="#universityFAQ" class="link">{{__('FAQ')}}</a>
                        </div>

                        <div class="course-single-content-details">
                            <!-- University Details -->
                            <div class="itemWrap" id="universityDetails">
                                <div class="item bg-white">
                                    <h4 class="title">{{ __('About the University') }}</h4>
                                    <div class="program-content-2">
                                        <div class="imgBlock mb-20">
                                            <img src="{{ getFileUrl($universityData->thumbnail_image) }}" class="w-100 bd-ra-10" alt="{{ $universityData->name }}"/>
                                        </div>
                                        <div class="info">
                                            {!! $universityData->details !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Core Benefits -->
                            <div class="itemWrap" id="universityBenefits">
                                <div class="item bg-white">
                                    <h4 class="title">{{ __('Core Benefits') }}</h4>
                                    <div class="row rg-15">
                                        @if (!empty($universityData->core_benefits_title))
                                            @php
                                                $half = ceil(count($universityData->core_benefits_title) / 2);
                                                $firstColumn = array_slice($universityData->core_benefits_title, 0, $half);
                                                $secondColumn = array_slice($universityData->core_benefits_title, $half);
                                            @endphp

                                            <!-- First Column -->
                                            <div class="col-md-6">
                                                <ul class="zList-pb-15">
                                                    @foreach($firstColumn as $key => $title)
                                                        <li>
                                                            <div class="courseLearnItem">
                                                                <div class="icon d-flex">
                                                                    <img src="{{ getFileUrl($universityData->core_benefits_icon[$key]) }}" alt="" style="width: 24px; height: 24px; object-fit: contain;"/>
                                                                </div>
                                                                <h4 class="text">
                                                                    {{ $title }}
                                                                </h4>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <!-- Second Column -->
                                            <div class="col-md-6">
                                                <ul class="zList-pb-15">
                                                    @foreach($secondColumn as $key => $title)
                                                        @php
                                                            $actualKey = $key + $half;
                                                        @endphp
                                                        <li>
                                                            <div class="courseLearnItem">
                                                                <div class="icon d-flex">
                                                                    <img src="{{ getFileUrl($universityData->core_benefits_icon[$actualKey]) }}" alt="" style="width: 24px; height: 24px; object-fit: contain;"/>
                                                                </div>
                                                                <h4 class="text">
                                                                    {{ $title }}
                                                                </h4>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <p>{{ __('No core benefits available.') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="itemWrap" id="universityGallery">
                                <div class="item bg-secondary-bg border-0">
                                    <h4 class="title">{{__('Gallery')}}</h4>
                                    @if (!empty($universityData->gallery_image))
                                        <div class="row rg-24">
                                            @foreach($universityData->gallery_image as $index => $image)
                                                <div class="col-md-6">
                                                    <div class="university-gallery-img sf-popup-gallery">
                                                        <a href="{{ getFileUrl($image) }}">
                                                            <img src="{{ getFileUrl($image) }}" alt="Gallery Image {{ $index + 1 }}" class="w-100 bd-ra-10" style="height: 250px; object-fit: cover;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center">
                                            {{__('No gallery images available')}}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- FAQ -->
                            <div class="itemWrap" id="universityFAQ">
                                <div class="item bg-white">
                                    <h4 class="title">{{__('Frequently Asked Questions')}}</h4>
                                    @if($faqData->isNotEmpty())
                                        <div class="accordion zAccordion-reset zAccordion-two" id="accordionExample1">
                                            @foreach($faqData as $index => $faq)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseFaq{{$index}}"
                                                                aria-controls="collapseFaq{{$index}}"
                                                                aria-expanded="false">
                                                            {{ $faq->question }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFaq{{$index}}" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample1">
                                                        <div class="accordion-body">
                                                            <p>{{ $faq->answer }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center">
                                            {{__('No FAQs available yet')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="course-single-sidebar" data-aos="fade-up" data-aos-duration="1000">
                        <div class="item">
                            <div class="img">
                                <img src="{{getFileUrl($universityData->thumbnail_image)}}" alt="{{$universityData->name}}"/>
                            </div>
                            <p class="price">
                                {{__('Average Cost')}}: {{ showPrice($universityData->avg_cost) }}
                            </p>
                            <a href="{{ route('consultations.list', ['university_id' => $universityData->id]) }}" class="sf-btn-icon-primary w-100">
                                {{__('Book a Consultation')}}
                                <span class="icon">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                </span>
                            </a>
                        </div>

                        <div class="courseFeatures">
                            <h4 class="title">{{__('University Information')}}</h4>
                            <ul class="zList-pb-13">
                                {{-- <li class="item">
                                    <div class="left">
                                        <div class="icon">
                                            <img src="{{asset('assets/images/icon/ranking.svg')}}" alt=""/>
                                        </div>
                                        <p class="fs-16 fw-400 lh-28 text-para-text d-flex g-5 text-break">
                                            <span class="text-title-text flex-shrink-0">{{__('World Ranking')}} :</span>
                                            #{{ $universityData->world_ranking }}
                                        </p>
                                    </div>
                                </li> --}}
                                {{-- <li class="item">
                                    <div class="left">
                                        <div class="icon">
                                            <img src="{{asset('assets/images/icon/students2.svg')}}" alt=""/>
                                        </div>
                                        <p class="fs-16 fw-400 lh-28 text-para-text d-flex g-5 text-break">
                                            <span class="text-title-text flex-shrink-0">{{__('International Students')}} :</span>
                                            {{ number_format($universityData->international_student) }}
                                        </p>
                                    </div>
                                </li> --}}
                                <li class="item">
                                    <div class="left">
                                        <div class="icon">
                                            <img src="{{asset('assets/images/icon/country2.svg')}}" alt=""/>
                                        </div>
                                        <p class="fs-16 fw-400 lh-28 text-para-text d-flex g-5 text-break">
                                            <span class="text-title-text flex-shrink-0">{{__('Country')}} :</span>
                                            {{ $universityData->countryName }}
                                        </p>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="left">
                                        <div class="icon">
                                            <img src="{{asset('assets/images/icon/price.svg')}}" alt=""/>
                                        </div>
                                        <p class="fs-16 fw-400 lh-28 text-para-text d-flex g-5 text-break">
                                            <span class="text-title-text flex-shrink-0">{{__('Average Cost')}} :</span>
                                            {{ showPrice($universityData->avg_cost) }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- CTA Sidebar -->
                        {{-- <div class="meet-consultant mt-20" data-background="{{ getFileUrl(getOption('cta_sidebar_image')) }}">
                            <h4 class="title">{{ getOption('cta_sidebar_title') }}</h4>
                            <a href="{{ route('consultations.list', ['university_id' => $universityData->id]) }}"  class="sf-btn-icon-primary">
                                {{__('Book a Consultation')}}
                                <span class="icon">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                    <img src="{{ asset('assets/images/icon/icon-angle-right.svg') }}" alt="">
                                </span>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection