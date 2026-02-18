<div class="modal fade" id="add-modal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content border-0 bd-ra-4 p-sm-25 p-15">

<div class="bd-b-one bd-c-stroke pb-20 mb-20 d-flex justify-content-between">
    <h2 class="fs-18 fw-600">{{ __('Add Program Content') }}</h2>
    <button class="bd-one bd-c-stroke rounded-circle w-24 h-24"
            data-bs-dismiss="modal">
        <i class="fa-solid fa-times"></i>
    </button>
</div>

<form class="ajax reset"
      action="{{ route('admin.programs.store') }}"
      method="POST"
      data-handler="settingCommonHandler">

@csrf

<div class="row rg-20">

<div class="col-6">
    <label class="zForm-label-alt">{{ __('School') }}</label>
    <select name="school_id" class="sf-select-checkbox-search">
        @foreach($schools as $school)
            <option value="{{ $school->id }}">{{ $school->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-6">
    <label class="zForm-label-alt">{{ __('Program Type') }}</label>
    <select name="program_type_id" class="sf-select-checkbox-search">
        @foreach($programTypes as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-12">
    <label class="zForm-label-alt">{{ __('Title') }}</label>
    <input type="text" name="name"
           class="form-control zForm-control-alt">
</div>

<div class="col-12">
    <label class="zForm-label-alt">{{ __('Content') }}</label>
    <textarea class="summernoteOne" name="description"></textarea>
</div>

<div class="col-6">
    <label class="zForm-label-alt">{{ __('Status') }}</label>
    <select name="status" class="sf-select-without-search">
        <option value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
        <option value="{{ STATUS_DEACTIVATE }}">{{ __('Deactivate') }}</option>
    </select>
</div>

</div>

<div class="text-end pt-15">
    <button class="flipBtn sf-flipBtn-primary">{{ __('Submit') }}</button>
</div>

</form>
</div>
</div>
</div>
