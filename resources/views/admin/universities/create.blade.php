@extends('layouts.app')

@push('title')
    {{ $pageTitle ?? 'Add University' }}
@endpush

@section('content')
<div class="p-sm-30 p-15">
    <div class="row rg-20">
        <div class="">
            <div class="align-items-center bd-b-one bd-c-one bd-c-stroke bd-c-stroke-2 d-flex justify-content-between mb-30 pb-15 pb-sm-30">
                <h4 class="fs-18 fw-700 lh-24 text-title-text">{{ $pageTitle ?? 'Add University' }}</h4>
                <a href="{{ route('admin.universities.index') }}" class="flipBtn sf-flipBtn-secondary flex-shrink-0">{{ __('Back') }}</a>
            </div>

            <form action="{{ route('admin.universities.store') }}" method="POST">
                @csrf
                <div class="p-sm-25 p-15 mb-20 bd-one bd-c-stroke bd-ra-10 bg-white">
                    <h5 class="fs-16 fw-600 mb-15">{{ __('University Details') }}</h5>
                    <div class="row rg-20">
                        <div class="col-md-6">
                            <label for="university_name" class="zForm-label-alt">{{ __('University Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="university_name" id="university_name" placeholder="{{ __('Type University Name') }}" class="form-control zForm-control-alt" required>
                        </div>
                        <div class="col-md-6">
                            <label for="world_ranking" class="zForm-label-alt">{{ __('World Ranking') }}</label>
                            <input type="number" name="world_ranking" id="world_ranking" placeholder="{{ __('Type World Ranking') }}" class="form-control zForm-control-alt">
                        </div>
                        <div class="col-md-6">
                            <label for="avg_cost" class="zForm-label-alt">{{ __('Average Cost') }}</label>
                            <input type="number" name="avg_cost" id="avg_cost" placeholder="{{ __('Type Average Cost') }}" class="form-control zForm-control-alt">
                        </div>
                        <div class="col-md-6 d-flex align-items-center gap-20 pt-20">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="feature" id="feature" value="1">
                                <label for="feature" class="form-check-label">{{ __('Feature') }}</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="top_university" id="top_university" value="1">
                                <label for="top_university" class="form-check-label">{{ __('Top University') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
                    <h5 class="fs-16 fw-600 mb-15">{{ __('Admin User Details') }}</h5>
                    <div class="row rg-20">
                        <div class="col-md-6">
                            <label for="first_name" class="zForm-label-alt">{{ __('First Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" placeholder="{{ __('Type First Name') }}" class="form-control zForm-control-alt" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="zForm-label-alt">{{ __('Last Name') }}</label>
                            <input type="text" name="last_name" id="last_name" placeholder="{{ __('Type Last Name') }}" class="form-control zForm-control-alt">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="zForm-label-alt">{{ __('Email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" placeholder="{{ __('Type Email') }}" class="form-control zForm-control-alt" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="zForm-label-alt">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" placeholder="{{ __('Type Password') }}" class="form-control zForm-control-alt" required>
                        </div>
                    </div>
                </div>

                <div class="text-end pt-15">
                    <button type="submit" class="flipBtn sf-flipBtn-primary flex-shrink-0">{{ __('Submit') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
