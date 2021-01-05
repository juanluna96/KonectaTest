@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-3">Administrador de clientes</h1>
        <a class="btn btn-primary my-3 btn-block mx-auto" style="max-width: 400px" href="{{ route('users.create') }}" role="button">Crear nuevo cliente</a>
        
        @if (count($clients) > 0)
            <table class="table table-light ">
                <thead class="bg-primary text-white">
                    <tr>
                        <td>N</td>
                        <td>Nombre</td>
                        <td>Foto</td>
                        <td>Cargo</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($clients as $client)    
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$client->name}}</td>
                            <td><img class="img-thumbnail" src="/storage/{{$client->image}}" alt="avatar-{{$client->id}}" style="max-width: 100px"></td>
                            <td>{{$client->position}}</td>
                            <td>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <a class="btn btn-warning my-1 d-block" href="{{ route('users.edit', ['user'=>$client->id]) }}" role="button">Editar</a>
                                    </div>
                                    <form action="{{ route('users.destroy', ['user'=>$client->id]) }}" method="post" class="col-md-6">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger my-1 w-100"><i class="fas fa-user-slash mr-2"></i>Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $clients->links() }}
            </div>
        @else
            <h3 class="text-center">Aun no tienes clientes? Empieza agregando algunos.</h3>
        @endif
        
    </div>
@endsection