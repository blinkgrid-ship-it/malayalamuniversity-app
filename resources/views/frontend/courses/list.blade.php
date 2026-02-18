@extends('frontend.layouts.app')
@push('title')
    {{ __('Home') }}
@endpush



@section('content')
    <!-- Breadcrumb -->
    <section class="inner-breadcrumb-section">
        <div class="inner-breadcrumb-wrap" data-aos="fade-up" data-aos-duration="1000">
            <h4 class="inner-breadcrumb-title">{{__('Courses')}}</h4>
            <ol class="breadcrumb inner-breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('frontend')}}">{{__('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('courses.list')}}">{{__('Course List')}}</a></li>
            </ol>
        </div>
    </section>

    <div class="section-gap-top">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row rg-24 align-items-center pb-md-40 pb-20">
                <div class="col-lg-8">
                    <div class="align-items-center course-search-suggestion">
                        <h4 class="title"> {{__('Showing')}}</h4>
                        <span class="fs-18">
                            {{ ($courses->currentPage() - 1) * $courses->perPage() + 1 }}
                            -
                            {{ min($courses->currentPage() * $courses->perPage(), $courses->total()) }}
                            {{__('of')}}
                            {{ $courses->total() }} {{__('courses')}}
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Form for Sorting -->
                    <form id="sortForm" method="GET" action="{{ route('courses.list') }}">
                        <!-- Persist filter values as hidden inputs -->
                        <input type="hidden" name="search_key" value="{{ request('search_key') }}">
                       

                        <div class="d-flex justify-content-lg-end">
                            <div class="course-search-sort">
                                <div class="d-flex align-items-center g-10">
                                    <div class="icon d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                             viewBox="0 0 21 21" fill="none">
                                            <path d="M9.66699 7.16675L16.3337 7.1668" stroke="#636370"
                                                  stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                            <path d="M9.66699 10.5H13.8337" stroke="#636370"
                                                  stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                            <path d="M9.66699 13.8333H12.167" stroke="#636370"
                                                  stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                            <path d="M9.66699 3.83325H18.0003" stroke="#636370"
                                                  stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                            <path
                                                d="M5.08333 18V3M5.08333 18C4.49981 18 3.40961 16.3381 3 15.9167M5.08333 18C5.66686 18 6.75706 16.3381 7.16667 15.9167"
                                                stroke="#636370" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <h4 class="title">{{__('Sort By')}} :</h4>
                                    <select name="sort_by" class="sf-select-checkbox"
                                            onchange="document.getElementById('sortForm').submit();">
                                        <option value="">{{__('Default')}}</option>
                                        <option value="name-asc" {{ request('sort_by') == 'name-asc' ? 'selected' : '' }}>{{__('Name A to Z')}}</option>
                                        <option value="name-desc" {{ request('sort_by') == 'name-desc' ? 'selected' : '' }}>{{__('Name Z to A')}}</option>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form> <!-- End of Sorting Form -->
                </div>
            </div>

            <div class="row rg-24">


                  <div class="col-lg-3 col-md-6">
                    <div class="course-search-sidebar" data-aos="fade-up" data-aos-duration="1000">
                        <!-- Form for Filtering by Country -->
                        <form id="filterForm" method="GET" action="{{ route('courses.list') }}">
                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                            <div class="pb-25">
                                <div class="search-one">
                                    <input type="text" id="search-key" name="search_key"
                                           value="{{ request('search_key') }}"
                                           placeholder="{{__('Search here...')}}"/>
                                    <button class="icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.71401 15.7857C12.6194 15.7857 15.7854 12.6197 15.7854 8.71428C15.7854 4.80884 12.6194 1.64285 8.71401 1.64285C4.80856 1.64285 1.64258 4.80884 1.64258 8.71428C1.64258 12.6197 4.80856 15.7857 8.71401 15.7857Z"
                                                stroke="#707070" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M18.3574 18.3571L13.8574 13.8571" stroke="#707070"
                                                  stroke-width="1.35902" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="accordion zAccordion-reset zAccordion-three pb-md-40 pb-20"
                                 id="accordionStudyLevel">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseStydyLevel"
                                                aria-expanded="true"
                                                aria-controls="collapseStydyLevel">{{__('Study Level')}}</button>
                                    </h2>
                                    <div id="collapseStydyLevel" class="accordion-collapse collapse show"
                                         data-bs-parent="#accordionStudyLevel">
                                        <div class="accordion-body">
                                            <ul class="zList-pb-8">
                                                @foreach($studyLevel as $data)
                                                    <li>
                                                        <div class="zForm-wrap-checkbox">
                                                            <input type="checkbox" name="study_level[]"
                                                                   value="{{$data->id}}"
                                                                   class="form-check-input bd-c-stroke-2 bg-transparent"
                                                                   id="study_level-{{$data->id}}"
                                                                   {{ in_array($data->id, request('study_level', [])) ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit();"/>
                                                            <label
                                                                for="study_level-{{$data->id}}">{{$data->name}}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                             <div class="accordion zAccordion-reset zAccordion-three pb-md-40 pb-20"
                                 id="accordionProgramm">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseStydyLevel"
                                                aria-expanded="true"
                                                aria-controls="collapseStydyLevel">{{__('Programms')}}</button>
                                    </h2>
                                    <div id="collapseStydyLevel" class="accordion-collapse collapse show"
                                         data-bs-parent="#accordionProgramm">
                                        <div class="accordion-body">
                                            <ul class="zList-pb-8">
                                                @foreach($programms as $data)
                                                    <li>
                                                        <div class="zForm-wrap-checkbox">
                                                            <input type="checkbox" name="programms[]"
                                                                   value="{{$data->id}}"
                                                                   class="form-check-input bd-c-stroke-2 bg-transparent"
                                                                   id="programms-{{$data->id}}"
                                                                   {{ in_array($data->id, request('programms', [])) ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit();"/>
                                                            <label
                                                                for="programms-{{$data->id}}">{{$data->title}}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                           
                        </form>
                    </div>
                </div>

             

                <div class="col-lg-9 col-md-6">
                    <div class="row rg-24" data-aos="fade-up" data-aos-duration="1000">
                        @forelse($courses as $course)
                        <div class="col-lg-4">
        <div class="modern-university-card">
            <!-- Course Image -->
            <a href="{{ route('courses.single', $course->slug) }}" class="card-image-wrapper">
                <img src="{{getFileUrl($course->thumbnail)}}" alt="{{$course->name}}"/>
            </a>
            
            <div class="card-content">
                <!-- Course Header -->
               
                <a href="{{ route('courses.single', $course->slug) }}" class="university-name">
                    
                    <span class="course-title-text">
                         @if($course->course_code)
                        <span class="course-code">
                            {{ substr($course->course_code, 0, 3) }} {{ substr($course->course_code, 3) }}
                        </span>
                    @endif
                        {{$course->title}}</span>
                </a>
                
                <!-- Instructor & Program -->
                <div class="instructor-info">
                    @if(isset($course->instructors) && is_array($course->instructors))
                        <p class="instructor-name">
                           {{ implode(' & ', array_column($course->instructors, 'name')) }}
                        </p>
                    
                    @endif
                    <p class="program-name">- {{ $course->program->title }}</p>
                </div>
                
                <!-- Intake Status -->
                <div class="intake-info">
                    <span class="info-label">Intake -</span>
                    <span class="info-value">
                        {{
                            [
                                1 => __('Continuous'),
                                2 => __('Fixed Intakes'),
                                3 => __('On Demand'),
                                4 => __('Closed'),
                            ][$course->intake_status] ?? __('N/A')
                        }}
                    </span>
                </div>
                
                <div class="intake-info">
                    <span class="info-label">Prerequisite -</span>
                    <span class="info-value">{{ $course->prerequisite ?? "None" }}</span>
                </div>
                
                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <img src="{{asset('assets/images/icon/world-ranking.svg')}}" alt="Course Fee"/>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Course Fee</div>
                            <div class="stat-value">{{showPrice($course->price)}}</div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <img src="{{asset('assets/images/icon/clock.svg')}}" alt="Duration"/>
                        </div>
                        @if($course->credit_hours)
                        <div class="stat-content">
                            <div class="stat-label">Duration</div>
                            <div class="stat-value">{{ number_format($course->credit_hours, 2, ':', '') }} hrs</div>
                        </div>
                        @endif
                    </div>
                    {{-- <div class="stat-item">
                                                <div class="stat-icon">
                                                    <img src="{{asset('assets/images/icon/class-start-date.svg')}}" alt="International Students"/>
                                                </div>
                                                <div class="stat-content">
                                                    <div class="stat-label">{{__('Modules')}}</div>
                                                    <div class="stat-value">{{$course->duration}} {{__('Days')}}</div>
                                                </div>
                                            </div> --}}
                    
                </div>

                <!-- View Details Button -->
                <a href="{{route('courses.single', $course->slug)}}" class="view-details-btn">
                    View Details
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

                        @empty
                            <div class="col-md-12">
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h4>{{__('No Courses Found')}}</h4>
                                    <p>{{__('Try adjusting your filters or search criteria')}}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{$courses->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection