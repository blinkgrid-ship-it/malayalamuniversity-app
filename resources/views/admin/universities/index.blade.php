@extends('layouts.app')

@push('title')
    {{ $pageTitle ?? 'All Universities' }}
@endpush

@section('content')

<div class="px-sm-30 p-15 bd-b-one bd-c-stroke-2 d-flex justify-content-between align-items-center flex-wrap g-20">
    <h4 class="fs-18 fw-700 lh-24 text-title-text">{{ $pageTitle ?? 'Universities' }}</h4>
    <a href="{{ route('admin.universities.create') }}" class="flipBtn sf-flipBtn-primary flex-shrink-0">
        + {{ __('Add University') }}
    </a>
</div>

<div class="p-sm-30 p-15">
    <div class="p-sm-25 p-15 bd-one bd-c-stroke bd-ra-10 bg-white">

        <table class="table zTable pt-15"
               id="universityDataTable"
               style="width:100%; border-collapse:collapse;">

            <thead>
                <tr>
                    <th style="text-align:left; vertical-align:middle;">{{ __('ID') }}</th>
                    <th style="text-align:left; vertical-align:middle;">{{ __('Name') }}</th>
                    <th style="text-align:left; vertical-align:middle;">{{ __('Admin Email') }}</th>
                    <th style="text-align:left; vertical-align:middle;">{{ __('World Ranking') }}</th>
                    <th style="text-align:center; vertical-align:middle;">{{ __('Status') }}</th>
                    <th style="text-align:left; vertical-align:middle; width:220px;">{{ __('Action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($universities as $university)
                <tr>
                    <td style="vertical-align:middle;">{{ $university->id }}</td>

                    <td style="vertical-align:middle;">
                        {{ $university->name }}
                    </td>

                    <td style="vertical-align:middle;">
                        {{ $university->admin->email ?? '-' }}
                    </td>

                    <td style="vertical-align:middle;">
                        {{ $university->world_ranking ?? '-' }}
                    </td>

                    {{-- STATUS --}}
                    <td style="text-align:center; vertical-align:middle;">
                        @if($university->status)
                            <span style="
                                display:inline-block;
                                min-width:70px;
                                padding:4px 12px;
                                font-size:12px;
                                font-weight:600;
                                color:#fff;
                                background:#22c55e;
                                border-radius:20px;
                                text-align:center;
                            ">
                                Active
                            </span>
                        @else
                            <span style="
                                display:inline-block;
                                min-width:70px;
                                padding:4px 12px;
                                font-size:12px;
                                font-weight:600;
                                color:#fff;
                                background:#ef4444;
                                border-radius:20px;
                                text-align:center;
                            ">
                                Inactive
                            </span>
                        @endif
                    </td>

                    {{-- ACTION --}}
                    <td style="vertical-align:middle;">
                        <div style="display:flex; align-items:center; gap:8px;">

                            {{-- Toggle --}}
                            <form action="{{ route('admin.universities.toggleStatus', $university->id) }}"
                                  method="POST" style="margin:0;">
                                @csrf
                                @method('PUT')
                                <a href="#"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   style="
                                       display:inline-block;
                                       padding:6px 14px;
                                       font-size:13px;
                                       font-weight:600;
                                       color:#fff;
                                       background:#f59e0b;
                                       border-radius:6px;
                                       text-decoration:none;
                                       white-space:nowrap;
                                   ">
                                    {{ $university->status ? 'Deactivate' : 'Activate' }}
                                </a>
                            </form>

                            {{-- Delete --}}
                            <form action="{{ route('admin.universities.destroy', $university->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?');"
                                  style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <a href="#"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   style="
                                       display:inline-block;
                                       padding:6px 14px;
                                       font-size:13px;
                                       font-weight:600;
                                       color:#fff;
                                       background:#dc2626;
                                       border-radius:6px;
                                       text-decoration:none;
                                       white-space:nowrap;
                                   ">
                                    Delete
                                </a>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<input type="hidden" id="universities-route" value="{{ route('admin.universities.index') }}">

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#universityDataTable').DataTable({
            pageLength: 10,
            ordering: false,
            processing: true,
            serverSide: false,
            responsive: true,
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-angles-left'></i>",
                    next: "<i class='fa-solid fa-angles-right'></i>",
                },
                search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
            },
            dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">'
        });
    });
</script>
@endpush
