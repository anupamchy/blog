<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        if (!Auth::guard('student')->check()) {
            return redirect('/students/login');
        }
        return view('blogs.create');
        // return view('/students/dashboard');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'image|nullable',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validateData['image'] = $imageName;
        }
        Blog::create($validateData);
        return redirect('/students/dashboard')->with('success', 'Blog created successfully.');
    }
}
