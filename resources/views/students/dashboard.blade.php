{{-- resources/views/students/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Student Dashboard</h2>

            <hr>

            <div class="card">
                <div class="card-header">Welcome, {{ Auth::guard('student')->user()->name }}
                </div>
                <div class="card-body">
                    <p>This is your dashboard.</p>
                    <a href="/blogs/create" class="btn btn-primary">Create Blog Post</a>
                    <a href="/blogs" class="btn btn-secondary">View Blogs</a>

                </div>
            </div>

            <!-- Logout Button -->
            <form action="/students/logout" method="post" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection