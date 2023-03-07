@extends('layouts.panel')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('menu.panel.projects.edit') }}</div>

    <div class="card-body">
        <form action="{{ route('panel.projects.update', ['project' => $project->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('content.panel.projects.labels.name') }}: <span class="text-danger">*</span></label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $project->name) }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="slug">{{ __('content.panel.projects.labels.slug') }}: <span class="text-danger">*</span></label>

                        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $project->slug) }}" />

                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="url">{{ __('content.panel.projects.labels.url') }}: <span class="text-danger">*</span></label>

                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', $project->url) }}" />

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="image">{{ __('content.panel.projects.labels.image') }}:</label>

                        <input id="image" type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="short_description">{{ __('content.panel.projects.labels.short_description') }}: <span class="text-danger">*</span></label>

                        <textarea name="short_description" id="short_description" class="projects-tinymce form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $project->short_description) }}</textarea>

                        @error('short_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="description">{{ __('content.panel.projects.labels.description') }}: <span class="text-danger">*</span></label>

                        <textarea name="description" id="description" class="projects-tinymce form-control @error('short_description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="dropdown-divider mt-0 mb-3">

            <button type="submit" class="btn btn-primary">{{ __('content.panel.projects.buttons.update') }}</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    tinymce.init({
        selector: '.projects-tinymce'
    });
</script>
@endsection
