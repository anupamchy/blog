<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function create()
    {
        return view('students.create');
    }
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students',
            'roll_number' => 'required|string|unique:students',
        ]);
        $data['password'] = Str::random(8);
        Student::create($data);
        return redirect()->back()->with('success', 'Student created successfully.');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'roll_number' => 'required',
            'password' => 'required',
        ]);

        $student = Student::where('roll_number', $request->roll_number)
            ->where('password', $request->password)
            ->first();

        if ($student) {
            Auth::guard('student')->login($student);
            return redirect()->intended('/students/dashboard');
        }

        return back()->withErrors([
            'roll_number' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/students/login');
    }

}
