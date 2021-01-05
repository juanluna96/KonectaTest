@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center text-uppercase font-weight-bold my-3">Editar usuario</h1>
@stop

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('users.update', ['user'=>$user->id]) }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if (Auth::user()->id != $user->id)
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label for="position" class="col-form-label text-md-right">{{ __('Cargo') }}</label>
                            <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{$user->position}}" required autocomplete="position" autofocus>
        
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rol">{{ __('Rol') }}</label>
                            <select id="rol" class="custom-select @error('rol') is-invalid @enderror" name="rol">
                                <option value="">-- Seleccione --</option>
                                @foreach ($roles as $rol)
                                    <option value="{{$rol->id}}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>{{$rol->descripcion}}</option>
                                @endforeach
                            </select>

                            @error('rol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label for="position" class="col-form-label text-md-right">{{ __('Cargo') }}</label>
                        <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{$user->position}}" required autocomplete="position" autofocus>

                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
                
                

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen">Elige un avatar para {{ (Auth::user()->name == $user->name) ? 'ti' : $user->name }}</label>
                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" id="imagen">

                    @if ($user->image)
                        <div class="mt-4">
                            <p>Imagen actual:</p>

                            <img src="/storage/{{$user->image}}" style="width: 300px">
                        </div>
                    @endif

                    @error('imagen')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group my-3">
                    <div class="row">
                        <div class="col-md-4 offset-lg-10 col-lg-2">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-edit"></i> Editar usuario</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop