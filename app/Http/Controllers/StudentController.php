<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    function index() {
        return view('pages.student.index', [
            'students' => User::query()->where('is_admin', 0)->get()
        ]);
    }

    function create() {
        return view('pages.student.create');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required'],
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/students');
    }
}
