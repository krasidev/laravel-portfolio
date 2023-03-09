@extends('layouts.app')

@section('url', $project->url)

@section('title', $project->name)

@section('image', asset($project->imagePathWithTimestamp))

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a href="{{ $project->url }}" target="_blank" class="card-link">
                    <img src="{{ $project->imagePathWithTimestamp }}" class="img-thumbnail" />
                </a>
            </div>
            <div class="col-12 col-md-8 col-xl-9 pt-3 pt-md-0">
                <h5 class="card-title">
                    <a href="{{ $project->url }}" target="_blank" class="card-link">{{ $project->name }}</a>
                </h5>
                <div class="card-text">{!! $project->description !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection
