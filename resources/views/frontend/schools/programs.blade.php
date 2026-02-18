@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <h1>{{ $school->title }}</h1>

    <p>Total programs: {{ $programs->total() }}</p>

    <ul>
        @forelse($programs as $program)
            <li>
                <a href="{{ route('program.details', $program->slug) }}">
                    {{ $program->title }}
                </a>
                <small>({{ $program->programType->title ?? 'No Type' }})</small>
            </li>
        @empty
            <li>No programs found</li>
        @endforelse
    </ul>

    {{ $programs->links() }}
</div>
@endsection
