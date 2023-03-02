@extends('layouts.app')

@section('head')
    @vite(['resources/js/deleteForm.js'])
@endsection

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-{{ session('message_class')}}">
            {{ session('message')}}
        </div>
    @endif
    <table class="table table-striped table-borderless table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Post date</th>
                <th scope="col">
                    <a href="{{ route('admin.posts.create')}}" class="btn btn-sm btn-primary">
                        Create new post
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->author }}</td>
                <td>{{ $post->post_date }}</td>
                <td>
                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-primary">
                        Show
                    </a>

                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-success">
                        Edit
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post->id)}}" method="POST" class="d-inline-block form-deleter">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
@endsection