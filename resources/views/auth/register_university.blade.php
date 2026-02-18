@extends('layouts.app')

@push('title')
    {{ __('Affiliation Registration') }}
@endpush

@section('content')
<div class="signLog-section">
    <div class="left">
        <div class="wrap">
            <div class="zMain-signLog-content">
                <h4>{{ __('Register as University') }}</h4>

                <form action="{{ route('register.university') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- User Credentials --}}
                    <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                    @error('first_name') <span>{{ $message }}</span> @enderror

                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                    @error('last_name') <span>{{ $message }}</span> @enderror

                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email') <span>{{ $message }}</span> @enderror

                    <input type="password" name="password" placeholder="Password">
                    @error('password') <span>{{ $message }}</span> @enderror

                    {{-- University Details --}}
                    <input type="text" name="university_name" placeholder="Affiliation Name" value="{{ old('university_name') }}">
                    @error('university_name') <span>{{ $message }}</span> @enderror

                    <input type="number" name="world_ranking" placeholder="World Ranking" value="{{ old('world_ranking') }}">
                    <input type="text" name="avg_cost" placeholder="Average Cost" value="{{ old('avg_cost') }}">
                    <input type="number" name="country_id" placeholder="Country ID" value="{{ old('country_id') }}">

                    <button type="submit">{{ __('Register University') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
