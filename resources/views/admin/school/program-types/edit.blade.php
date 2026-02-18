<div class="bd-b-one bd-c-stroke pb-20 mb-20 d-flex justify-content-between">
    <h2 class="fs-18 fw-600">{{ __('Update Program') }}</h2>
    <button class="bd-one rounded-circle w-24 h-24" data-bs-dismiss="modal">
        <i class="fa-solid fa-times"></i>
    </button>
</div>

<form class="ajax reset"
      action="{{ route('admin.school-programs.store') }}"
      method="POST"
      data-handler="settingCommonHandler">
    @csrf
    <input type="hidden" name="id" value="{{ $program->id }}">

    <div class="row rg-20">
        <div class="col-6">
            <label class="zForm-label-alt">{{ __('School') }} *</label>
            <select name="school_id" class="sf-select-checkbox-search">
                @foreach($schools as $school)
                    <option value="{{ $school->id }}"
                        {{ $program->school_id == $school->id ? 'selected' : '' }}>
                        {{ $school->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Program Type') }} *</label>
            <select name="program_type_id" class="sf-select-checkbox-search">
                @foreach($programTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ $program->program_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label class="zForm-label-alt">{{ __('Program Name') }} *</label>
            <input type="text" name="name"
                   value="{{ $program->name }}"
                   class="form-control zForm-control-alt">
        </div>

        <div class="col-12">
            <label class="zForm-label-alt">{{ __('Description') }}</label>
            <textarea name="description"
                      class="summernoteOne">{!! $program->description !!}</textarea>
        </div>

        <div class="col-6">
            <label class="zForm-label-alt">{{ __('Status') }}</label>
            <select name="status" class="sf-select-without-search">
                <option value="{{ STATUS_ACTIVE }}" {{ $program->status == STATUS_ACTIVE ? 'selected' : '' }}>
                    {{ __('Active') }}
                </option>
                <option value="{{ STATUS_DEACTIVATE }}" {{ $program->status == STATUS_DEACTIVATE ? 'selected' : '' }}>
                    {{ __('Deactivate') }}
                </option>
            </select>
        </div>
    </div>

    <div class="text-end pt-15">
        <button class="flipBtn sf-flipBtn-primary">{{ __('Submit') }}</button>
    </div>
</form>
