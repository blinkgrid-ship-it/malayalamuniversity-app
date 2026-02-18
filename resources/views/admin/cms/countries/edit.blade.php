@extends('layouts.app')
@push('title')
    {{ $pageTitle }}
@endpush
@section('content')
<div class="p-sm-30 p-15">
    <div class="row rg-20">
        <div class="">
            <div class="align-items-center bd-b-one bd-c-one bd-c-stroke bd-c-stroke-2 d-flex justify-content-between mb-30 pb-15 pb-sm-30">
                <h4 class="fs-18 fw-700 lh-24 text-title-text">{{$pageTitle}}</h4>
            </div>

            <form action="{{ route('admin.cms-settings.universities.updateOwn') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $universityData->id }}">

                {{-- University Basic Details --}}
                <div class="p-sm-25 p-15 mb-20 bd-one bd-c-stroke bd-ra-10 bg-white">
                    <div class="row rg-20">
                        <div class="col-md-6">
                            <label for="name" class="zForm-label-alt">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="{{ __('Type Name') }}" value="{{ $universityData->name }}" class="form-control zForm-control-alt">
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="zForm-label-alt">{{ __('Status') }} <span class="text-danger">*</span></label>
                            <select class="sf-select-without-search" id="status" name="status">
                                <option {{ $universityData->status == STATUS_ACTIVE ? 'selected' : '' }} value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
                                <option {{ $universityData->status == STATUS_DEACTIVATE ? 'selected' : '' }} value="{{ STATUS_DEACTIVATE }}">{{ __('Deactivate') }}</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="details" class="zForm-label-alt">{{ __('Details') }} <span class="text-danger">*</span></label>
                            <textarea class="summernoteOne" name="details" id="details" placeholder="{{__('Details')}}">{!! $universityData->details !!}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Core Benefits Section --}}
                <div class="p-sm-25 mb-20 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
                    <div class="core-benefits-block">
                        <div class="bd-c-stroke-2 justify-content-between align-items-center pt-15 d-flex justify-content-between rg-20 flex-wrap">
                            <h4 class="fs-18 fw-700 lh-24 text-title-text">{{__('Core Benefits Section')}}</h4>
                            <button type="button" class="flipBtn sf-flipBtn-primary flex-shrink-0 addCountryCoreBenefitsBtn">{{ __('+ Add More') }}</button>
                        </div>
                        @foreach ($universityData->core_benefits_title ?? [] as $index => $title)
                        <div class="countryCoreBenefitsItems row rg-20 bd-b-one bd-c-one bd-c-stroke-2 pb-15">
                            <div class="col-md-6 pt-14">
                                <label for="core_benefits_title-{{$index}}" class="zForm-label-alt">{{ __('Core Benefits Title') }} <span class="text-danger">*</span></label>
                                <input type="text" name="core_benefits_title[]" id="core_benefits_title-{{$index}}" placeholder="{{ __('Type Core Benefits Title') }}" value="{{ $title }}" class="core_benefits_title form-control zForm-control-alt">
                            </div>
                            <div class="col-md-6">
                                <div class="primary-form-group d-flex justify-content-between">
                                    <div class="primary-form-group-wrap zImage-upload-details mw-100 mt-12 position-relative">
                                        <label for="coreBenefitsIcon{{ $index }}" class="zForm-label-alt">{{ __('Core Benefits Icon') }} <span class="text-mime-type">{{ __('(jpeg,png,jpg,svg,webp)') }}</span> <span class="text-danger">*</span>
                                            <small class="preview-image-div">
                                                <a href="{{getFileUrl($universityData->core_benefits_icon[$index] ?? null)}}" target="_blank"><i class="fa-solid fa-eye"></i></a>
                                            </small>
                                        </label>
                                        <div class="d-flex align-items-center g-10">
                                            <div class="file-upload-one d-flex flex-column g-10 w-100">
                                                <label for="coreBenefitsIcon{{ $index }}">
                                                    <p class="fileName fs-12 fw-500 lh-16 text-para-text">{{__("Choose Image to upload")}}</p>
                                                    <p class="fs-12 fw-500 lh-16 text-white">{{__("Browse File")}}</p>
                                                </label>
                                                <span class="fs-12 fw-400 lh-24 text-main-color pt-3">{{__("Recommended: 56 px / 56 px")}}</span>
                                                <div class="max-w-150 flex-shrink-0">
                                                    <input type="hidden" class="old_core_benefits_icon_id" name="core_benefits_icon_id[]" value="{{ $universityData->core_benefits_icon[$index] ?? null }}">
                                                    <input type="file" name="core_benefits_icon[]" id="coreBenefitsIcon{{ $index }}" accept="image/*" class="fileUploadInput position-absolute invisible core_benefits_icon"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!$loop->first)
                                    <button type="button" class="removeCountryCoreBenefits top-0 end-0 bg-transparent border-0 p-0 m-2 rounded-circle d-flex justify-content-center align-items-center">
                                        <!-- Delete icon SVG -->
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Gallery Section --}}
                <div class="p-sm-25 mb-20 bd-one bd-c-stroke bd-ra-10 bg-white">
                    <h4 class="fs-18 fw-700 lh-24 text-title-text">{{__('Image Gallery Section')}}</h4>
                    <div class="row">
                        @foreach($universityData->gallery_image ?? [] as $key => $imageId)
                        <div class="col-lg-3 col-md-6">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap zImage-upload-details mw-100 mt-12">
                                    <div class="zImage-inside">
                                        <img src="{{ getFileUrl($imageId) }}" alt="Gallery Image"/>
                                    </div>
                                    <label for="gallery_image_{{ $key }}" class="zForm-label-alt">{{ __('Gallery Image') }} {{ $key + 1 }}</label>
                                    <input type="file" name="gallery_image[]" id="gallery_image_{{ $key }}" accept="image/*" onchange="previewFile(this)"/>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Banner Image --}}
                <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
                    <h4 class="fs-18 fw-700 lh-24 text-title-text">{{__('Banner Image Section')}}</h4>
                    <div class="primary-form-group-wrap zImage-upload-details mw-100 mt-12">
                        <img src="{{getFileUrl($universityData->banner_image)}}" alt="Banner Image"/>
                        <input type="file" name="banner_image" id="banner_image" accept="image/*" onchange="previewFile(this)"/>
                        <span class="fs-12 fw-400 lh-24 text-main-color pt-3">{{__("Recommended: 830 px / 550 px")}}</span>
                    </div>
                </div>

                <div class="bd-c-stroke-2 justify-content-between align-items-center text-end pt-15">
                    <button type="submit" class="flipBtn sf-flipBtn-primary flex-shrink-0">{{__('Update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('admin/custom/js/cms/countries.js')}}"></script>
@endpush
