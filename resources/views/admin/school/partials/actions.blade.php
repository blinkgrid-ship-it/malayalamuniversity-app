<div class="d-flex align-items-center">
    <!-- Edit button -->
    <button type="button"
            class="sf-btn sf-btn-sm sf-btn-primary me-2"
            data-bs-toggle="modal"
            data-bs-target="#edit-modal"
            data-ajax-url="{{ route('admin.schools.edit', $d->id) }}">
        <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
    </button>

    <!-- Delete button -->
    <button type="button"
            class="sf-btn sf-btn-sm sf-btn-danger deleteRecord"
            data-ajax-url="{{ route('admin.schools.delete', $d->id) }}">
        <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
    </button>
</div>
