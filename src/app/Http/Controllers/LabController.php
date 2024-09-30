<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        $data = ['name' => 'Vitaliy', 'role' => 'Student'];
        return view('welcome', $data);
    }

    public function about()
    {
        $data = ['name' => 'Vitaliy', 'role' => 'Student', 'age'=>'10' ,'description' => 'Vitaliy, prosto Vitaliy'];
        return view('about', $data);
    }

    public function contact()
    {
        $data = ['email' => 'Vitaliy.email@example.com', 'phone' => '+123456789'];
        return view('contact', $data);
    }

    public function hobbies()
    {
        $data = ['hobbie'=> 'cooking'];
        return view('hobbies', $data);
    }
}
