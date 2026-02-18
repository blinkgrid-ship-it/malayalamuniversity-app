@extends('frontend.layouts.app')
@push('title')
    {{ __('Schools') }}
@endpush

@section('content')
    <!-- Breadcrumb -->
    <!-- Breadcrumb -->
    <section class="inner-breadcrumb-section">
        <div class="container">
            <div class="inner-breadcrumb-wrap" data-aos="fade-up" data-aos-duration="1000">
                <h4 class="inner-breadcrumb-title">
                    @if(isset($school))
                        {{ $school->title }}
                    @else
                        {{ __('Schools') }}
                    @endif
                </h4>
                <ol class="breadcrumb inner-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('schools.list') }}">{{ __('School List') }}</a>
                    </li>
                    @if(isset($school))
                        <li class="breadcrumb-item active">{{ $school->title }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </section>


    <div class="section-gap-top">
        <div class="container">
            <div class="row rg-24 align-items-center pb-md-40 pb-20" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-lg-8">
                    <div class="align-items-center course-search-suggestion">
                        @if($programs->count())
                            <h4 class="title">{{ __('Showing') }}</h4>
                            <span class="fs-18">
                                {{ ($programs->currentPage() - 1) * $programs->perPage() + 1 }}
                                -
                                {{ min($programs->currentPage() * $programs->perPage(), $programs->total()) }}
                                {{ __('of') }} {{ $programs->total() }} {{ __('programs') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Sorting Form -->
                    <form id="sortForm" method="GET" action="{{ route('schools.list') }}">
                        <input type="hidden" name="school" value="{{ $selectedSchool }}">
                        <input type="hidden" name="search_key" value="{{ request('search_key') }}">
                        @if(request('program_type'))
                            @foreach(request('program_type') as $type)
                                <input type="hidden" name="program_type[]" value="{{ $type }}">
                            @endforeach
                        @endif
                        <div class="d-flex justify-content-lg-end">
                            <div class="course-search-sort">
                                <div class="d-flex align-items-center g-10">
                                    <div class="icon d-flex">
                                        <!-- SVG icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                            <path d="M9.66699 7.16675L16.3337 7.1668" stroke="#636370" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.66699 10.5H13.8337" stroke="#636370" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.66699 13.8333H12.167" stroke="#636370" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.66699 3.83325H18.0003" stroke="#636370" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.08333 18V3M5.08333 18C4.49981 18 3.40961 16.3381 3 15.9167M5.08333 18C5.66686 18 6.75706 16.3381 7.16667 15.9167" stroke="#636370" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <h4 class="title">{{ __('Sort By') }} :</h4>
                                    <select name="sort_by" class="sf-select-checkbox" onchange="document.getElementById('sortForm').submit();">
                                        <option value="">{{ __('Default') }}</option>
                                        <option value="name-asc" {{ request('sort_by') == 'name-asc' ? 'selected' : '' }}>{{ __('Name A to Z') }}</option>
                                        <option value="name-desc" {{ request('sort_by') == 'name-desc' ? 'selected' : '' }}>{{ __('Name Z to A') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row rg-24">
                <div class="col-lg-4 col-md-6">
                    <div class="course-search-sidebar" data-aos="fade-up" data-aos-duration="1000">
                        <form id="filterForm" method="GET" action="{{ route('schools.list') }}">
                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                            <input type="hidden" name="school" value="{{ $selectedSchool }}">

                            <!-- Search -->
                            <div class="pb-25">
                                <div class="search-one">
                                    <input type="text" id="search-key" name="search_key" value="{{ request('search_key') }}" placeholder="{{ __('Search here...') }}">
                                    <button class="icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.71401 15.7857C12.6194 15.7857 15.7854 12.6197 15.7854 8.71428C15.7854 4.80884 12.6194 1.64285 8.71401 1.64285C4.80856 1.64285 1.64258 4.80884 1.64258 8.71428C1.64258 12.6197 4.80856 15.7857 8.71401 15.7857Z" stroke="#707070" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.3574 18.3571L13.8574 13.8571" stroke="#707070" stroke-width="1.35902" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Program Type Filter -->
                            <div class="accordion zAccordion-reset zAccordion-three pb-md-40 pb-20" id="accordionProgramType">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProgramType" aria-expanded="true" aria-controls="collapseProgramType">{{ __('Program Type') }}</button>
                                    </h2>
                                    <div id="collapseProgramType" class="accordion-collapse collapse show" data-bs-parent="#accordionProgramType">
                                        <div class="accordion-body">
                                            <ul class="zList-pb-8">
                                                @foreach($programTypes as $type)
                                                    <li>
                                                        <div class="zForm-wrap-checkbox">
                                                            <input type="checkbox" name="program_type[]" value="{{ $type->id }}" class="form-check-input bd-c-stroke-2 bg-transparent" id="program_type-{{ $type->id }}" {{ in_array($type->id, request('program_type', [])) ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit();"/>
                                                            <label for="program_type-{{ $type->id }}">{{ $type->title }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schools List -->
                            {{-- <div class="accordion zAccordion-reset zAccordion-three pb-md-40 pb-20" id="accordionSchool">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSchool" aria-expanded="true" aria-controls="collapseSchool">
                                            {{ __('Schools') }}
                                        </button>
                                    </h2>
                                    <div id="collapseSchool" class="accordion-collapse collapse show" data-bs-parent="#accordionSchool">
                                        <div class="accordion-body">
                                            <ul class="zList-pb-8">
                                                @foreach($schools as $school)
                                                    <li>
                                                        <a href="{{ route('schools.list', ['school' => $school->id]) }}" class="{{ ($selectedSchool == $school->id) ? 'text-primary fw-bold' : '' }}">
                                                            {{ $school->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            @if($schools->count() > 1)
                        <div class="accordion zAccordion-reset zAccordion-three pb-md-40 pb-20" id="accordionOtherSchools">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtherSchools" aria-expanded="true" aria-controls="collapseOtherSchools">
                                        {{ __('Explore more') }}
                                    </button>
                                </h2>
                                <div id="collapseOtherSchools" class="accordion-collapse collapse show" data-bs-parent="#accordionOtherSchools">
                                    <div class="accordion-body">
                                        <ul class="zList-pb-8">
                                            @foreach($schools as $s)
                                                @if(!isset($school) || $s->id != $school->id)
                                                    <li class="d-flex gap-2">
                                                        <div class="icon d-flex">
                                                        <img src="{{ asset('assets/images/icon/score.svg') }}" class=" w-5" alt="" style="max-width: 16px; color: #636370;;">
                                                    </div>
                                                        <a href="{{ route('schools.details', $s->id) }}"
                                                             style="color: #636370">{{ $s->title }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        </form>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="row rg-24" data-aos="fade-up" data-aos-duration="1000">
                        @forelse($programs as $program)
                            <div class="col-lg-6">
                                <div class="course-item-two">
                                    <a href="{{ route('program.details', $program->slug) }}" class="img">
                                        <img src="{{ getFileUrl($program->banner_image) }}" alt="{{ $program->title }}">
                                    </a>
                                    <div class="course-content">
                                        <div class="text-content">
                                            <a href="{{ route('program.details', $program->slug) }}" class="title">{{ $program->title }}</a>
                                        </div>
                                        <ul class="list zList-pb-6">
                                            <li class="item">
                                                <div class="icon d-flex">
                                                    <img src="{{ asset('assets/images/icon/choose-icon-4.svg') }}" alt="">
                                                </div>
                                                <p class="text">{{ $program->programType->title ?? 'No Type' }}</p>
                                            </li>
                                            <li class="item">
                                                <div class="icon d-flex">
                                                    <img src="{{ asset('assets/images/icon/choose-icon-1.svg') }}" alt="">
                                                </div>
                                                <p class="text">{{ $program->school->title ?? '' }}</p>
                                            </li>
                                        </ul>
                                        <a href="{{ route('program.details', $program->slug) }}" class="link">{{ __('View Details') }}<i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
                                    <p>{{ __('No programs found') }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
