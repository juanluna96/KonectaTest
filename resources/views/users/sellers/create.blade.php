@extends('layouts.app')

@section('content')
<h1 class="text-center text-uppercase font-weight-bold my-3">Crear nuevo cliente</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form action="{{ route('users.store') }}" method="post" novalidate>
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="position" class="col-form-label text-md-right">{{ __('Cargo') }}</label>
                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus>

                @error('position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="hidden" name="rol" value="3">

            <div class="form-group">
                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row align-items-center">
                <div class="form-group col-md-6">
                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group my-3">
                <div class="row">
                    <div class="col-md-4 offset-lg-10 col-lg-2">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> Registrar usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection