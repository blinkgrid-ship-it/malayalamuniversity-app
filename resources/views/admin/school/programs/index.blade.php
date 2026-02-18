@extends('layouts.app')
@push('title')
    {{ $pageTitle }}
@endpush

@section('content')
<div class="px-sm-30 p-15 bd-b-one bd-c-stroke-2 d-flex justify-content-between align-items-center">
    <h4 class="fs-18 fw-700 lh-24 text-title-text">{{$pageTitle}}</h4>
    <button data-bs-toggle="modal" data-bs-target="#add-modal" class="flipBtn sf-flipBtn-primary flex-shrink-0">
        + {{__('Add Program')}}</button>
</div>

<div class="p-sm-30 p-15">
    <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
        <table class="table zTable zTable-last-item-right pt-15" id="programsDataTable">
            <thead>
                <tr>
                    <th>{{__('Image')}}</th>
                    <th>{{__('School')}}</th>
                    <th>{{__('Program Type')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 bd-ra-4 p-sm-25 p-15">
            <form class="ajax reset" action="{{ route('admin.schools.programs.store') }}" method="post" data-handler="settingCommonHandler">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="row rg-20">
                    <div class="col-6">
                        <label>{{__('School')}} <span class="text-danger">*</span></label>
                        <select name="school_id" class="sf-select-without-search">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label>{{__('Program Type')}} <span class="text-danger">*</span></label>
                        <select name="program_type_id" class="sf-select-without-search">
                            @foreach($programTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label>{{__('Title')}} <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control zForm-control-alt">
                    </div>
                    <div class="col-12">
                        <label>{{__('Subtitle')}}</label>
                        <input type="text" name="subtitle" class="form-control zForm-control-alt">
                    </div>
                    <div class="col-12">
                        <label for="bannerImage" class="zForm-label-alt">{{ __('Banner Image') }} 
                            <span class="text-danger">*</span>
                            <span class="text-mime-type">{{__('(jpeg,png,jpg,svg,webp)')}}</span>
                        </label>
                        <div class="upload-img-box">
                            <img src="" />
                            <input type="file" name="banner_image" id="bannerImage" accept="image/*" onchange="previewFile(this)" />
                        </div>
                        <span class="fs-12 fw-400 lh-24 text-main-color pt-3">{{__("Recommended: 880 px / 420 px")}}</span>
                    </div>

                    <div class="col-12">
                        <label>{{__('Content')}}</label>
                        <textarea class="summernoteOne" name="content" placeholder="{{__('Program Content')}}"></textarea>
                        <small class="text-muted">HTML format supported</small>
                    </div>
                    <div class="col-6">
                        <label>{{__('Sort Order')}}</label>
                        <input type="number" name="sort_order" class="form-control zForm-control-alt">
                    </div>
                    <div class="col-6">
                        <label>{{__('Status')}}</label>
                        <select name="status" class="sf-select-without-search">
                            <option value="1">{{__('Active')}}</option>
                            <option value="0">{{__('Deactivate')}}</option>
                        </select>
                    </div>
                </div>
                <div class="pt-15 text-end">
                    <button type="submit" class="flipBtn sf-flipBtn-primary">{{__('Submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="programs-route" value="{{ route('admin.schools.programs.index') }}">
@endsection

@push('script')
<script>
(function($){
    "use strict";
    $('#programsDataTable').DataTable({
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
            { data: 'banner_image', name: 'banner_image' },
            { data: 'school', name: 'school' },
            { data: 'program_type', name: 'programType' },
            { data: 'title', name: 'title' },
            { data: 'status', name: 'status', searchable: false },
            { data: 'action', name: 'action', searchable: false }
        ]
    });
})(jQuery);

function getEditModal(url, modalId) {
    $.get(url, function(data){
        // Fill modal fields
        $(modalId + ' input[name="id"]').val(data.id);
        $(modalId + ' input[name="title"]').val(data.title);
        $(modalId + ' input[name="subtitle"]').val(data.subtitle);
        $(modalId + ' select[name="school_id"]').val(data.school_id);
        $(modalId + ' select[name="program_type_id"]').val(data.program_type_id);
        $(modalId + ' select[name="status"]').val(data.status);
        $(modalId + ' input[name="sort_order"]').val(data.sort_order);
       $(modalId + ' textarea[name="content"]').summernote('code', data.content);


        if(data.banner_image){
            $(modalId + ' img').attr('src', data.banner_image);
        } else {
            $(modalId + ' img').attr('src', '');
        }

        // Show modal
        $(modalId).modal('show');
    });
}

</script>
@endpush
