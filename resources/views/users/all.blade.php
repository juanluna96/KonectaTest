@extends('adminlte::page')



@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center text-uppercase font-weight-bold mt-3 mb-2">Buscador de usuarios</h1>
@stop

@section('content')
    <div class="container">
        @if (count($users) > 0)
            <form action="{{ route('users.search') }}">
                <div class="input-group my-3">
                    <input type="text" id="usuario" class="form-control @error('usuario') is-invalid @enderror" name="usuario" placeholder="Buscar usuario" required autocomplete="name" autofocus>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                    </div>
    
                    @error('usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </form>

            <div class="row justify-content-between">
                @foreach ($users as $user)
                    @include('layouts.users' , ['user'=>$user])
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
            @else
                <h2 class="text-center mt-5">Aun no tienes administradores? Empieza por agregar algunos</h2>
                <a name="" id="" class="btn btn-primary d-block mx-auto" style="max-width: 500px" href="{{ route('users.create') }}" role="button">Crear nuevo usuario</a>
            @endif        
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop