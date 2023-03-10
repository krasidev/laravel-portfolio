@extends('layouts.app')

@section('title', __('content.app.titles.projects'))

@section('content')
<div class="row column-count">
    @foreach ($projects as $project)
        <div class="col-12">
            <div class="card mb-4 shadow-sm d-flex flex-row flex-wrap">
                <a href="{{ route('projects.show', ['project' => $project->slug]) }}" target="_blank" class="card-link">
                    <img src="{{ $project->imagePathWithTimestamp }}" class="card-img-top border-bottom" />
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('projects.show', ['project' => $project->slug]) }}" target="_blank" class="card-link">{{ $project->name }}</a>
                    </h5>
                    <div class="card-text">{!! $project->short_description !!}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    $('.column-count').columnCount({
        lg: 3,
        md: 2
    });
</script>
@endsection
