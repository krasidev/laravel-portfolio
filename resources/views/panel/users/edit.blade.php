@extends('layouts.panel')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('menu.panel.users.edit') }}</div>

    <div class="card-body">
        <form action="{{ route('panel.users.update', ['user' => $user->id]) }}" method="post" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('content.panel.users.labels.name') }}: <span class="text-danger">*</span></label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="email">{{ __('content.panel.users.labels.email') }}: <span class="text-danger">*</span></label>

                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="password">{{ __('content.panel.users.labels.password') }}:</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="password-confirm">{{ __('content.panel.users.labels.password_confirmation') }}:</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" />
                    </div>
                </div>
            </div>

            <hr class="dropdown-divider mt-0 mb-3">

            <button type="submit" class="btn btn-primary">{{ __('content.panel.users.buttons.update') }}</button>
        </form>
    </div>
</div>
@endsection
