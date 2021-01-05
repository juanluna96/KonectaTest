<?php

namespace App\Http\Controllers;

use App\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admins()
    {
        $admins = User::where('rol_id', '=', 1)->paginate(10);
        return view('users.admins', compact('admins'));
    }

    public function sellers()
    {
        $sellers = User::where('rol_id', '=', 2)->paginate(10);
        return view('users.sellers', compact('sellers'));
    }

    public function clients()
    {
        $clients = User::where('rol_id', '=', 3)->paginate(10);
        return view('users.clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener roles
        if (Auth::user()->rol->descripcion == "Admin") {
            $roles = Rol::where('id', '!=', 1)->get(['id', 'descripcion']);
            return view('users.admin.create', compact('roles'));
        } else {
            $roles = Rol::where('id', '>', 2)->get(['id', 'descripcion']);
            return view('users.sellers.create', compact('roles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validacion
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'rol' => ['required', 'integer', 'min:2', 'max:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Asignar valores
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->position = $data['position'];
        $user->image = 'upload-avatar/default.png';
        $user->password = Hash::make($data['password']);
        $user->rol_id = $data['rol'];

        // Guardar en la BD
        $save = $user->save();


        //Redireccionar
        if (Auth::user()->rol->descripcion == "Admin") {
            if ($data['rol'] == 2) {
                return redirect()->action('UserController@sellers');
            } else {
                return redirect()->action('UserController@clients');
            }
        } else {
            return redirect()->action("HomeController@index_seller");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->rol->descripcion == "Admin") {
            $roles = Rol::where('id', '!=', 1)->get(['id', 'descripcion']);
            return view('users.admin.edit', compact('user', 'roles'));
        } else {
            $roles = Rol::where('id', '>', 2)->get(['id', 'descripcion']);
            return view('users.sellers.edit', compact('user', 'roles'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validacion
        if ($request['rol']) {
            $data = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'rol' => ['required', 'integer', 'min:2', 'max:3'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'imagen' => 'image'
            ]);
        } else {
            $data = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'imagen' => 'image'
            ]);
        }


        // Asignar los valores
        $user->name = $data['name'];
        $user->position = $data['position'];
        $user->email = $data['email'];
        if ($request['rol']) {
            $user->rol = $data['rol'];
        }

        // Si el usuario sube una nueva imagen
        if (request('imagen')) {
            // Borrar antigua imagen del servidor
            $old_image = public_path('storage/' . $user->image);
            if (file_exists($old_image) && ($user->image != 'storage/upload-avatar/default.png')) {
                @unlink($old_image);
            }

            // Obtener la ruta de imagen
            $ruta_imagen = $request['imagen']->store('upload-avatar', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            // Asignar al objeto
            $user->image = $ruta_imagen;
        }

        $user->update();

        // Redireccionar
        switch (Auth::user()->rol->descripcion) {
            case 'Admin':
                if ($request['rol'] == 2) {
                    return redirect()->action('UserController@sellers');
                } else {
                    return redirect()->action('UserController@clients');
                }
                break;
            case 'Vendedor':
                return redirect()->action('HomeController@index_seller');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Borrar antigua imagen del servidor
        $url_imagen = public_path('storage/' . $user->image);
        if (file_exists($url_imagen) && ($user->image != 'storage/upload-avatar/default.png')) {
            @unlink($url_imagen);
        }

        // Borrar de la BD
        $user->delete();

        // Redireccionar
        switch (Auth::user()->rol->descripcion) {
            case 'Admin':
                return redirect()->action('UserController@index_admin');
                break;
            case 'Vendedor':
                return redirect()->action('HomeController@index_seller');
                break;
        }
    }

    public function all()
    {
        $users = User::orderBy('rol_id')->paginate(16);
        return view('users.all', compact('users'));
    }

    public function search(Request $request)
    {
        $busqueda = $request['usuario'];
        $users = User::where('name', 'like', '%' . $busqueda . '%')->orWhere('position', 'like', '%' . $busqueda . '%')->paginate(1);
        $users->appends(['usuario' => $busqueda]);

        return view('users.search', compact('users', 'busqueda'));
    }
}
