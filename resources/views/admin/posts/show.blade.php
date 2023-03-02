@extends('layouts.app')

@section('head')
    @vite(['resources/js/deleteForm.js'])
@endsection

@section('content')
<div class="container">
    <div class="card text-center mt-5">
        <div class="card-header fw-bold">
            {{ $post->author }} --- {{ $post->type->name }}
        </div>
        <div class="card-body p-3 m-3">
            <h2 class="card-title fw-bold p-3">
                {{ $post->title }}
            </h2>
        </div>
        <div class="tags mb-5">
            @foreach ($post->Technologies as $technology)
                <span class="p-2 badge rounded-pill"
                style="background-color: {{ $technology->bg_color }}"> #{{ $technology->name }}</span>
            @endforeach
        </div>
        <div class="card-image mb-4">
            @if ( $post->isImageAUrl())
                <img src="{{ $post->image }}"
            @else
                <img src="{{ asset('storage/' . $post->image ) }}"
            @endif
                alt="{{ $post->title }} image" class="img-fluid">
        </div>
            <p class="card-text mb-4">
                {{ $post->content }}
            </p>
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">
                Edit
            </a>
            <form action="{{ route('admin.posts.destroy', $post->id)}}" method="POST" class="d-inline-block form-deleter">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
        <div class="card-footer text-muted">
            {{ $post->post_date }}
        </div>
    </div>
</div>
@endsection