@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
    <div class="card text-center mt-5">
        <div class="card-header">
            {{ $post->author }}
        </div>
        <div class="card-body p-3 m-3">
            <h2 class="card-title fw-bold p-3">
                {{ $post->title }}
            </h2>
            <p class="card-text mb-4">
                {{ $post->content }}
            </p>
        </div>
        <div class="card-footer text-muted">
            {{ $post->post_date }}
        </div>
    </div>
    @endforeach
</div>
@endsection