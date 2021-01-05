@extends('adminlte::page')



@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center text-uppercase font-weight-bold my-3">Lista de vendedores</h1>
@stop

@section('content')
    <div class="container">
        @if (count($sellers) > 0)
            <a name="" id="" class="btn btn-primary d-block mx-auto mt-3 mb-4" style="max-width: 500px" href="{{ route('users.create') }}" role="button"><i class="fas fa-plus-square mr-2"></i>Crear nuevo usuario</a>
            <div class="row justify-content-between">
                @foreach ($sellers as $seller)
                    @include('layouts.users' , ['user'=>$seller])
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $sellers->links() }}
            </div>
            @else
                <h2 class="text-center mt-5">Aun no tienes vendedores? Empieza por agregar algunos</h2>
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