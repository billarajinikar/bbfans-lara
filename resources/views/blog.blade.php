@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <h2 class="text-center mb-4">Bigg Boss Reviews</h2>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                        <a href="{{ route('blog.show', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
