@extends('frontend.layouts.app')
@push('title')
    {{ $program->title ?? __('School Program') }}
@endpush

@section('content')
<!-- Breadcrumb -->
<section class="inner-breadcrumb-section">
    <div class="container">
        <div class="inner-breadcrumb-wrap" data-aos="fade-up" data-aos-duration="1000">
            <h4 class="inner-breadcrumb-title">{{ $program->title ?? __('Program') }}</h4>
            <ol class="breadcrumb inner-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('schools.list') }}">{{ __('Schools') }}</a></li>
                @if($program->school)
                    <li class="breadcrumb-item"><a href="{{ route('schools.details', $program->school->id) }}">{{ $program->school->title }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ $program->title }}</li>
            </ol>
        </div>
    </div>
</section>

<!-- Program Content -->
<section style="margin: 4rem 0rem">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 px-1 px-lg-20">
                <div class="program-details-content  responsive-container" data-aos="fade-up" data-aos-duration="1000">
                     <!-- Program Title -->
                    {{-- <h2 class="title" style="color: black">{{ $program->title }}</h2>
                    <p class="info pb-20">{{ $program->school->title ?? '' }}</p> --}}

                    <!-- Banner Image -->
                    @if($program->banner_image)
                        <div class="imgBlock mb-20">
                            <img src="{{ getFileUrl($program->banner_image) }}" class="w-100 img" alt="{{ $program->title }}"
                                 style="aspect-ratio:16/9; object-fit:cover; border-radius:8px;" />
                        </div>
                    @endif

                   
                    <!-- Program HTML Content -->
                    <div class="program-content item" style="line-height:1.6; font-size:15px; color:#333;">
                        {!! $program->content !!}
                    </div>

                  
                </div>
            </div>
        </div>
    </div>
</section>
<section>
            <!-- Related Programs -->
@if(isset($relatedPrograms) && $relatedPrograms->isNotEmpty())
    <div class="row mt-50 section-gap bg-secondary-bg p-20">
        <div class="col-12 mt-20">
           <div class="m-auto">
                <h4 class="section-title text-center pb-0">{{__('Explore All Degrees')}}</h4>
            </div>
        </div>
        @foreach($relatedPrograms as $rel)
            <div class="col-sm-6 col-lg-4 mt-20 pb-20">
                <div class="course-item-two">
                    <!-- Program Banner -->
                    <a href="{{ route('program.details', $rel->slug) }}" class="img" style="width: 100%; height:auto; aspect-ratio: 16/9;">
                        <img src="{{ getFileUrl($rel->banner_image) }}" alt="{{ $rel->title }}" >
                    </a>

                    <!-- Program Content -->
                    <div class="course-content">
                        <div class="text-content">
                            <a href="{{ route('program.details', $rel->slug) }}" class="title">{{ $rel->title }}</a>
                        </div>
                        <ul class="list zList-pb-6">
                            <li class="item">
                                <div class="icon d-flex">
                                    <img src="{{ asset('assets/images/icon/choose-icon-4.svg') }}" alt="">
                                </div>
                                <p class="text">{{ $rel->programType->title ?? 'No Type' }}</p>
                            </li>
                            <li class="item">
                                <div class="icon d-flex">
                                    <img src="{{ asset('assets/images/icon/choose-icon-1.svg') }}" alt="">
                                </div>
                                <p class="text">{{ $rel->school->title ?? '' }}</p>
                            </li>
                        </ul>
                        <a href="{{ route('program.details', $rel->slug) }}" class="link">
                            {{ __('View Details') }}<i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
</section>

<!-- Inline Styling for tables, images, and content inside program description -->
<style>
.program-content{
padding: 25px;
    border: 1px solid var(--stroke);
    border-radius: 25px;
}
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
    color: #636370;
    font-size: 18px;
    font-weight: 500;
    line-height: 28px;
}
.program-content ul {
    padding-left: 20px;
    margin-bottom: 15px;
     color: #636370;
    font-size: 18px;
  font-weight: 500;
  line-height: 28px;
}
.program-content ol {
    padding-left: 20px;
    margin-bottom: 15px;
     color: #636370;
    font-size: 18px;
  font-weight: 500;
  line-height: 28px;
}
.responsive-container {
    width: 80%;       /* Main width for desktop */
    max-width: 1200px; /* Optional max cap */
    margin: 0 auto;
     color: #636370;
    font-size: 18px;
    font-weight: 500;
    line-height: 28px;
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
