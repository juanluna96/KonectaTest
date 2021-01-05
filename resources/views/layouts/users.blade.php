<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="/storage/{{$user->image}}" class="w-100 rounded-circle" alt="Imagen perfil {{$user->name}}">
        <div class="card-body text-center">
            <h6 class="font-weight-bold text-uppercase">{{$user->name}}</h6>
            <p class="card-text mb-0">{{$user->position}}</p>
            @if (Request::route()->getName() == 'users.all')
                <p class="my-2 font-weight-bold">{{$user->rol->descripcion}}</p> 
            @endif
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <a class="btn btn-warning my-1 d-block" href="{{ route('users.edit', ['user'=>$user->id]) }}" role="button">Editar</a>
                </div>
                @if ($user->id != Auth::user()->id)
                    {{--  <eliminar-usuario user-id="{{$user->id}}"></eliminar-usuario>  --}}
                    <form action="{{ route('users.destroy', ['user'=>$user->id]) }}" method="post" class="col-md-6">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger my-1 w-100"><i class="fas fa-user-slash mr-2"></i>Eliminar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>