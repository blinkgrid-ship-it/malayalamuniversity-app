@extends('layouts.app')
@push('title')
    {{ $pageTitle }}
@endpush

@section('content')
<div class="px-sm-30 p-15 bd-b-one bd-c-stroke-2 d-flex justify-content-between align-items-center">
    <h4 class="fs-18 fw-700 lh-24 text-title-text">{{$pageTitle}}</h4>
    <button data-bs-toggle="modal" data-bs-target="#add-modal" class="flipBtn sf-flipBtn-primary flex-shrink-0">
        + {{__('Add Program Type')}}
    </button>
</div>

<div class="p-sm-30 p-15">
    <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
        <table class="table zTable zTable-last-item-right pt-15" id="schoolProgramTypesDataTable">
            <thead>
                <tr>
                    <th><div>{{__('School')}}</div></th>
                    <th><div>{{__('Title')}}</div></th>
                    <th><div>{{__('Status')}}</div></th>
                    <th><div>{{__('Action')}}</div></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 bd-ra-4 p-sm-25 p-15">
            <div class="bd-b-one bd-c-stroke pb-20 mb-20 d-flex align-items-center flex-wrap justify-content-between g-10">
                <h2 class="fs-18 fw-600 lh-22 text-title-black">{{ __('Add Program Type') }}</h2>
                <div class="mClose">
                    <button type="button" class="bd-one bd-c-stroke rounded-circle w-24 h-24 bg-transparent text-para-text fs-13" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            </div>

            <form class="ajax reset" action="{{ route('admin.schools.program-types.store') }}" method="post" 
            data-handler="settingCommonHandler">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="row rg-20">
                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('School') }} <span class="text-danger">*</span></label>
                        <select name="school_id" class="sf-select-without-search">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Title') }} <span class="text-danger">*</span></label>
                        <input type="text" name="title" placeholder="{{ __('Type Program Type Title') }}" class="form-control zForm-control-alt">
                    </div>
                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Short Code') }}</label>
                        <input type="text" name="short_code" placeholder="{{ __('UG, PG, etc.') }}" class="form-control zForm-control-alt">
                    </div>
                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Sort Order') }}</label>
                        <input type="number" name="sort_order" placeholder="{{ __('0') }}" class="form-control zForm-control-alt">
                    </div>
                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Status') }}</label>
                        <select name="status" class="sf-select-without-search">
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Deactivate') }}</option>
                        </select>
                    </div>
                    <div class="col-12 pt-15 text-end">
                        <button type="submit" class="flipBtn sf-flipBtn-primary">{{ __('Submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="schoolProgramTypes-route" value="{{ route('admin.schools.program-types.index') }}">
@endsection

@push('script')
<script>
(function($){
    "use strict";
    $('#schoolProgramTypesDataTable').DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: true,
        processing: true,
        searching: true,
        responsive: true,
        ajax: $('#schools-route').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            { data: 'school', name: 'school' },
            { data: 'title', name: 'title' },
            { data: 'status', name: 'status', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ]
    });
})(jQuery);
function getEditModal(url, modalId) {
    $.get(url, function(data){
        $(modalId + ' input[name="id"]').val(data.id);
        $(modalId + ' input[name="title"]').val(data.title);
        $(modalId + ' input[name="short_code"]').val(data.short_code);
        $(modalId + ' input[name="sort_order"]').val(data.sort_order);
        $(modalId + ' select[name="school_id"]').val(data.school_id);
        $(modalId + ' select[name="status"]').val(data.status);

        $(modalId).modal('show');
    });
}

</script>
@endpush
