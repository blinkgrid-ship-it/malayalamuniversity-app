@extends('layouts.app')

@push('title')
    {{ $pageTitle }}
@endpush

@section('content')

<div class="px-sm-30 p-15 bd-b-one bd-c-stroke-2 d-flex justify-content-between align-items-center">
    <h4 class="fs-18 fw-700 lh-24 text-title-text">{{ $pageTitle }}</h4>
    <button data-bs-toggle="modal" data-bs-target="#add-modal" class="flipBtn sf-flipBtn-primary flex-shrink-0">
        + {{ __('Add School') }}
    </button>
</div>

<div class="p-sm-30 p-15">
    <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">
        <table class="table zTable zTable-last-item-right pt-15" id="schoolsDataTable">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Subtitle') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- ADD + EDIT MODAL (SAME MODAL) -->
<div class="modal fade" id="add-modal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 bd-ra-4 p-sm-25 p-15">

            <div class="bd-b-one bd-c-stroke pb-20 mb-20 d-flex justify-content-between">
                <h2 class="fs-18 fw-600">{{ __('Add School') }}</h2>
                <button type="button" class="bd-one bd-c-stroke rounded-circle w-24 h-24 bg-transparent"
                        data-bs-dismiss="modal">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <form class="ajax reset" action="{{ route('admin.schools.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id">

                <div class="row rg-20">
                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Title') }} *</label>
                        <input type="text" name="title" class="form-control zForm-control-alt">
                    </div>

                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Subtitle') }}</label>
                        <input type="text" name="subtitle" class="form-control zForm-control-alt">
                    </div>

                    <div class="col-12">
                        <label class="zForm-label-alt">{{ __('Description') }}</label>
                        <textarea name="description" class="summernoteOne"></textarea>
                    </div>

                    <div class="col-6">
                        <label class="zForm-label-alt">{{ __('Status') }} *</label>
                        <select name="status" class="sf-select-without-search">
                            <option value="{{ STATUS_ACTIVE }}">{{ __('Active') }}</option>
                            <option value="{{ STATUS_DEACTIVATE }}">{{ __('Deactivate') }}</option>
                        </select>
                    </div>
                </div>

                <div class="text-end pt-15">
                    <button type="submit" class="flipBtn sf-flipBtn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="schools-route" value="{{ route('admin.schools.index') }}">

@endsection

@push('script')
<script src="{{ asset('admin/custom/js/cms/school.js') }}"></script>

<script>
function getEditModal(url, modalId) {
    $.get(url, function (data) {

        $(modalId + ' input[name="id"]').val(data.id);
        $(modalId + ' input[name="title"]').val(data.title);
        $(modalId + ' input[name="subtitle"]').val(data.subtitle);
        $(modalId + ' select[name="status"]').val(data.status);
        $(modalId + ' textarea[name="description"]').summernote('code', data.description ?? '');

        $(modalId + ' h2').text('Edit School');
        $(modalId).modal('show');
    });
}

$('#add-modal').on('hidden.bs.modal', function () {
    const modal = $(this);
    modal.find('form')[0].reset();
    modal.find('input[name="id"]').val('');
    modal.find('textarea[name="description"]').summernote('code', '');
    modal.find('h2').text('Add School');
});
</script>
<script>
$(document).on('ajaxSuccess', function (event, xhr) {
    if (xhr.responseJSON && xhr.responseJSON.status === true) {

        const modalEl = document.getElementById('add-modal');
        const modal = bootstrap.Modal.getInstance(modalEl);

        if (modal) {
            modal.hide();
        }
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css('padding-right', '');
        $('#schoolsDataTable').DataTable().ajax.reload(null, false);
    }
});
</script>
@endpush
