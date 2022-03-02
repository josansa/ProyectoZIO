<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        session_start();

        $request->validate([
            'tituloimg' => 'required',
            'pieimg' => 'required',
            'img' => 'required'
        ]);

        $imagen = new Image();
        $imagen->titulo = $request->tituloimg;
        $imagen->pie = $request->pieimg;
        $imagen->name = $request->img;
        $imagen->user_id = $_SESSION["user"]->id;
        $imagen->save();
        move_uploaded_file($_FILES["files"]["tmp_name"], "../public/img/usersIMG/" . $_FILES["files"]["name"]);
        return redirect()->route('index');
    }

    public function destroy(Image $id)
    {
        $id->delete();
        return redirect()->route('index');
    }
}
