<div class="bd-b-one bd-c-stroke pb-20 mb-20 d-flex align-items-center flex-wrap justify-content-between g-10">
    <h2 class="fs-18 fw-600 lh-22 text-title-black">{{ __('Update Degree') }}</h2>
    <div class="mClose">
        <button type="button"
                class="bd-one bd-c-stroke rounded-circle w-24 h-24 bg-transparent text-para-text fs-13"
                data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
</div>

<form class="ajax reset"
      action="{{ route('admin.degrees.store') }}"
      method="post"
      data-handler="settingCommonHandler"
      enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $degreeData->id }}">

    <div class="row rg-20">
        <div class="col-6">
            <label for="name" class="zForm-label-alt">{{ __('Name') }} <span class="text-danger">*</span></label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ $degreeData->name }}"
                   placeholder="{{ __('Type Degree Name') }}"
                   class="form-control zForm-control-alt">
        </div>

        <div class="col-6">
            <label for="universityId" class="zForm-label-alt">{{ __('University') }} <span class="text-danger">*</span></label>
            <select class="sf-select-checkbox-search" id="universityId" name="university_id">
                @foreach($university as $data)
                    <option value="{{ $data->id }}" {{ $degreeData->university_id == $data->id ? 'selected' : '' }}>
                        {{ $data->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <label for="countryId" class="zForm-label-alt">{{ __('Country') }} <span class="text-danger">*</span></label>
            <select class="sf-select-checkbox-search" id="countryId" name="country_id">
                @foreach($country as $data)
                    <option value="{{ $data->id }}" {{ $degreeData->country_id == $data->id ? 'selected' : '' }}>
                        {{ $data->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <label for="degreeCategoryId" class="zForm-label-alt">{{ __('Degree Category') }} <span class="text-danger">*</span></label>
            <select class="sf-select-checkbox-search" id="degreeCategoryId" name="degree_category_id">
                @foreach($degreeCategory as $data)
                    <option value="{{ $data->id }}" {{ $degreeData->degree_category_id == $data->id ? 'selected' : '' }}>
                        {{ $data->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- <div class="col-6">
            <label for="studyLevelId" class="zForm-label-alt">{{ __('Study level') }} <span class="text-danger">*</span></label>
            <select class="sf-select-checkbox-search" id="studyLevelId" name="study_level_id">
                @foreach($studyLevel as $data)
                    <option value="{{ $data->id }}" {{ $degreeData->study_level_id == $data->id ? 'selected' : '' }}>
                        {{ $data->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="col-6">
            <label for="status" class="zForm-label-alt">{{ __('Status') }} <span class="text-danger">*</span></label>
            <select class="sf-select-without-search" id="status" name="status">
                <option value="{{ STATUS_ACTIVE }}" {{ $degreeData->status == STATUS_ACTIVE ? 'selected' : '' }}>
                    {{ __('Active') }}
                </option>
                <option value="{{ STATUS_DEACTIVATE }}" {{ $degreeData->status == STATUS_DEACTIVATE ? 'selected' : '' }}>
                    {{ __('Deactivate') }}
                </option>
            </select>
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Requirement Program') }} <span class="text-danger">*</span></label>
            <input type="text"
                   name="requirement_program"
                   value="{{ $degreeData->requirement_program }}"
                   class="form-control zForm-control-alt">
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Requirement Score') }} <span class="text-danger">*</span></label>
            <input type="text"
                   name="requirement_score"
                   value="{{ $degreeData->requirement_score }}"
                   class="form-control zForm-control-alt">
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Intake Time') }} <span class="text-danger">*</span></label>
            <input type="date"
                   name="intake_time"
                   value="{{ $degreeData->intake_time }}"
                   class="form-control zForm-control-alt">
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Duration') }} <span class="text-danger">*</span></label>
            <input type="text"
                   name="duration"
                   value="{{ $degreeData->duration }}"
                   class="form-control zForm-control-alt">
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Total Fees / Amount') }} <span class="text-danger">*</span></label>
            <input type="number"
                   name="amount"
                   value="{{ $degreeData->amount }}"
                   class="form-control zForm-control-alt">
        </div>

        <div>
            <label class="zForm-label-alt">{{ __('Details') }} <span class="text-danger">*</span></label>
            <textarea class="summernoteOne" name="details">{!! $degreeData->details !!}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="primary-form-group">
                <div class="primary-form-group-wrap zImage-upload-details mw-100 mt-12">
                    <label class="zForm-label-alt">{{ __('Banner Image') }}</label>
                    <div class="upload-img-box">
                        <img src="{{ getFileUrl($degreeData->banner_image) }}" />
                        <input type="file" name="banner_image" accept="image/*" onchange="previewFile(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-end pt-15">
        <button type="submit" class="sf-btn-primary">
            <span>{{ __('Submit') }}</span>
        </button>
    </div>
</form>
