@extends('layouts.app')

@push('title')
    {{ __('Register as University - Step 1') }}
@endpush

@section('content')
<div class="signLog-section">
     <div class="right">
            <div class="rightbg" data-background="{{ getFileUrl(getOption('login_right_image')) }}">
                 <a href="{{ route('frontend') }}" class="logo"><img src="{{ getFileUrl(getOption('app_logo')) }}" alt="" /></a>
            <h4 class="title">
                {{ getOption('auth_page_title') }}
            </h4>
            </div>
           
        </div>
    <div class="left">
        <div class="wrap">
            <div class="zMain-signLog-content">
                <div class="pb-sm-35 pb-20">
                    <h4 class="fs-sm-36 fs-26 fw-600 lh-sm-46 lh-20 text-title-text pb-5">
                        {{ __('Affiliation Registration - Step 1') }}
                    </h4>
                    <p class="fs-18 fw-500 lh-28 text-para-text">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="text-brand-primary">{{ __('Sign In') }}</a>
                    </p>
                </div>
                <form action="{{ route('register.university.step1.post') }}" method="post">
                    @csrf
                    <div class="row rg-25 pb-15">
                        <div class="col-md-12">
                            <div class="">
                                <label class="zForm-label">{{ __('Affiliation Name') }}</label>
                                <input type="text" class="form-control zForm-control" name="university_name" value="{{ old('university_name') }}" placeholder="{{ __('Enter the name of your institution or organization') }}">
                                @error('university_name') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="">
                                <label class="zForm-label">{{ __('Country') }}</label>
                                <select class="form-control zForm-control" name="country_id">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label class="zForm-label">{{ __('World Ranking') }}</label>
                                <input type="number" class="form-control zForm-control" name="world_ranking" value="{{ old('world_ranking') }}" placeholder="{{ __('Enter World Ranking') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label class="zForm-label">{{ __('Average Cost') }}</label>
                                <input type="number" class="form-control zForm-control" name="avg_cost" value="{{ old('avg_cost') }}" placeholder="{{ __('Enter Average Cost') }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="flipBtn sf-flipBtn-primary w-100">{{ __('Next Step') }}</button>

                    <!-- Link to main registration page -->
                    <p class="pt-sm-20 pt-20 fs-15 fw-500 lh-28 text-para-text">
                        {{ __('Want to register as a regular user?') }}
                        <a href="{{ route('register') }}" class="text-brand-primary">{{ __('Register here') }}</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
