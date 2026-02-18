@extends('layouts.app')

@push('title')
    {{ __('Register as University - Step 2') }}
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
                        {{ __('Affiliation Registration - Step 2') }}
                    </h4>
                    <p class="fs-18 fw-500 lh-28 text-para-text">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="text-brand-primary">{{ __('Sign In') }}</a>
                    </p>
                </div>
                <form action="{{ route('register.university.step2.post') }}" method="post">
                    @csrf
                    <div class="row rg-25 pb-15">
                        <div class="col-md-6">
                            <div class="">
                                <label class="zForm-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control zForm-control" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('Enter First Name') }}">
                                @error('first_name') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label class="zForm-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control zForm-control" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Enter Last Name') }}">
                                @error('last_name') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label class="zForm-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control zForm-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}">
                                @error('email') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label class="zForm-label">{{ __('Password') }}</label>
                                <div class="passShowHide">
                                    <input type="password" class="form-control zForm-control passShowHideInput" name="password" placeholder="{{ __('Enter Password') }}">
                                    <button type="button" toggle=".passShowHideInput" class="toggle-password fa-solid fa-eye"></button>
                                    @error('password') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-sm-25 pb-20 d-flex justify-content-start align-items-center flex-wrap g-10">
                        <div class="zForm-wrap-checkbox">
                            <input type="checkbox" class="form-check-input" name="agree_policy" id="agree_policy">
                            <label for="agree_policy">{{ __('I agree to the') }}
                                <a href="{{ route('page', 'page-terms_services_page') }}" target="_blank">{{ __('Terms of Use') }}</a>
                                {{ __('and') }}
                                <a href="{{ route('page', 'page-privacy_policy_page') }}" target="_blank">{{ __('Privacy Policy') }}</a>
                            </label>
                            @error('agree_policy') <span class="fs-12 text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="flipBtn sf-flipBtn-primary w-100">{{ __('Register University') }}</button>

                    <!-- Link back to Step 1 -->
                    <p class="pt-sm-20 pt-20 fs-15 fw-500 lh-28 text-para-text">
                        {{ __('Want to edit your university details?') }}
                        <a href="{{ route('register.university.step1') }}" class="text-brand-primary">{{ __('Go back') }}</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
