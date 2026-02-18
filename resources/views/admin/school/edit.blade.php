<div class="bd-b-one bd-c-stroke pb-20 mb-20 d-flex align-items-center justify-content-between g-10">
    <h2 class="fs-18 fw-600 lh-22 text-title-black">{{ __('Update School') }}</h2>
    <button type="button" class="bd-one bd-c-stroke rounded-circle w-24 h-24 bg-transparent text-para-text fs-13" data-bs-dismiss="modal">
        <i class="fa-solid fa-times"></i>
    </button>
</div>

<form class="ajax reset" action="{{ route('admin.schools.store') }}" method="post" data-handler="settingCommonHandler">
    @csrf
    <input type="hidden" name="id" value="{{ $schoolData->id }}">

    <div class="row rg-20">
        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Title') }} <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ $schoolData->title }}" class="form-control zForm-control-alt">
        </div>
        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Subtitle') }}</label>
            <input type="text" name="subtitle" value="{{ $schoolData->subtitle }}" class="form-control zForm-control-alt">
        </div>
        <div class="col-12">
            <label class="zForm-label-alt">{{ __('Description') }}</label>
            <textarea name="description" class="form-control zForm-control-alt" rows="4">{{ $schoolData->description }}</textarea>
        </div>
        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Status') }} <span class="text-danger">*</span></label>
            <select name="status" class="sf-select-without-search">
                <option value="{{ STATUS_ACTIVE }}" {{ $schoolData->status == STATUS_ACTIVE ? 'selected' : '' }}>{{ __('Active') }}</option>
                <option value="{{ STATUS_DEACTIVATE }}" {{ $schoolData->status == STATUS_DEACTIVATE ? 'selected' : '' }}>{{ __('Deactivate') }}</option>
            </select>
        </div>
    </div>

    <div class="text-end pt-15">
        <button type="submit" class="flipBtn sf-flipBtn-primary">{{ __('Update') }}</button>
    </div>
</form>
