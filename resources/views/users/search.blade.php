@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center text-uppercase font-weight-bold mt-3 mb-2">Resultados de: {{$busqueda}}</h1>
@stop

@section('content')
    <div class="container">
        @if (count($users) > 0)    
            <div class="row">
                @foreach ($users as $user)
                    @include('layouts.users' , ['user'=>$user])
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @else
            <h2 class="text-center mt-5">No encontramos ningun usuario, revisa la informacion.</h2>
        @endif        
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop