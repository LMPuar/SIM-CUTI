<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view ('register.index',[
            'title' => 'Register',
        ]);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kantor' => ['required','max:255'],
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5'

        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('berhasil', 'registrasi berhasil! silahkan login!');

        return redirect('/');
    }
}
