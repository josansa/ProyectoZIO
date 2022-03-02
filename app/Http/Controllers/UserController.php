<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($name)
    {
        session_start();
        if (isset($_SESSION["user"])) {
            $user = User::where(['name' => $name])->get()->first();
            $imagenes = Image::where(['user_id' => $user->id])->get();
            return view("galeria", compact('imagenes'));
        } else {
            return redirect()->route('index');
        }
    }

    public function iniciarSesion(Request $request)
    {
        session_start();
        $request->validate([
            'email' => 'required',
            'pswd' => 'required'
        ]);

        $_SESSION["user"] = User::where(['password' => $request->pswd, 'email' => $request->email])->get()->first();
        if ($_SESSION["user"]) {
            return redirect('galeria/home/'.$_SESSION["user"]->name);
        } else {
            $_SESSION["error"] = "<div class='error'>El correo o la contraseña introducidos son inválidos.</div>";
            return redirect()->route('index');
        }
    }

    public function cerrarSesion()
    {
        session_start();
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            return redirect()->route('index');
        }
    }

    public function create()
    {
        session_start();
        return view("registro");
    }

    
    public function store(Request $request)
    {
        session_start();

        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'pswd' => 'required'
        ]);

        $usuarios = User::select("name", "email")->get();
        $error1 = False;
        $error2 = False;
        foreach ($usuarios as $user) {
            if ($user->name == $request->nombre) {
                $error1 = True;
            }
            if ($user->email == $request->email) {
                $error2 = True;
            }
        }
        if (!$error1 && !$error2) {
            $usuario = new User();
            $usuario->name = $request->nombre;
            $usuario->email = $request->email;
            $usuario->password = $request->pswd;
            $usuario->save();
            $_SESSION["registroCompleto"] = "<div class='exito'>Usted se ha registrado correctamente.</div>";
            return redirect()->route('index');
        } else {
            if (($error1 && $error2)||$error2) {
                $_SESSION["registroCompleto"] = "<div class='error'>Ya existe un usuario registrado que usa ese email.<br>Por favor, inténtelo de nuevo</div>";
            } else {
                $_SESSION["registroCompleto"] = "<div class='error'>Ya existe un usuario que usa ese nombre.<br>Por favor, inténtelo de nuevo</div>";
            }
            return redirect()->route('registro');
        }
    }

    public function edit(User $id)
    {
        session_start();
        if (isset($_SESSION["user"])) {
            $user = $id;
            return view('editProfile', compact('user'));
        } else {
            return redirect()->route('index');
        }
    }

    public function update(User $id, Request $request)
    {   
        session_start();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'bio' => 'required'
        ]);
        
        $usuarios = User::select("id", "name", "email")->get();
        $error1 = False;
        $error2 = False;
        foreach ($usuarios as $user) {
            if ($user->id != $id->id) {
                if ($user->name == $request->name) {
                    $error1 = True;
                }
                if ($user->email == $request->email) {
                    $error2 = True;
                }          
            }
        }
        if (!$error1 && !$error2) {
            $id->name = $request->name;
            $id->email = $request->email;
            $id->bio = $request->bio;
            $id->update();
            $_SESSION["user"] = $id;
            $_SESSION["update"] = "";
            return redirect('galeria/home/'.$id->name);
        } else {
            if (($error1 && $error2)||$error2) {
                $_SESSION["updateError"] = "<div class='error'>Ya existe un usuario registrado que usa ese email.<br>Por favor, inténtelo de nuevo</div>";
            } else {
                $_SESSION["updateError"] = "<div class='error'>Ya existe un usuario que usa ese nombre.<br>Por favor, inténtelo de nuevo</div>";
            }
            return redirect('usuarios/edit/'.$id->id);
        }
    }

    public function updateProfileImg(User $id, Request $request)
    {
        session_start();
        $request->validate([
            'files' => 'required',
            'img' => 'required',
        ]);
        $id->profileimg = $request->img;
        move_uploaded_file($_FILES["files"]["tmp_name"], "../public/img/profileIMG/" . $_FILES["files"]["name"]);
        $id->update();
        $_SESSION["user"] = $id;
        $_SESSION["update"] = "";
        return redirect('galeria/home/'.$id->name);
    }
}
