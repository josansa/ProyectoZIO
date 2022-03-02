<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION["user"])) {
            return redirect("galeria/home/".$_SESSION["user"]->name);
        }
        return view("index");
    }
}
