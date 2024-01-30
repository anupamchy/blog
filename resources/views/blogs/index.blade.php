@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Blogs</h2>
            <hr>

            <!-- Blogs List -->
            @foreach ($blogs as $blog)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">{{ $blog->description }}</p>
                    @if ($blog->image)
                    <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}"
                        style="height: 500px; width: auto;" class="img-fluid mb-3">

                    {{-- <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}"
                        class="img-fluid mb-3"> --}}
                    @endif
                </div>

                <!-- Display Comments -->
                @foreach ($blog->comments as $comment)
                <div class="ml-3">
                    <strong>{{ $comment->student->name }}</strong>
                    <p>{{ $comment->content }}</p>

                    <!-- Reply Form -->
                    <form method="POST" action="/comments/{{ $comment->id }}/replies" class="mb-2">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" required class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                    </form>

                    <!-- Display Replies -->
                    @foreach ($comment->replies as $reply)
                    <div class="ml-4">
                        <strong>{{ $reply->student->name }}</strong>
                        <p>{{ $reply->content }}</p>
                    </div>
                    @endforeach
                </div>
                @endforeach

                <!-- Comment Form -->
                <form method="POST" action="/blogs/{{ $blog->id }}/comments" class="mt-2">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" required class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection