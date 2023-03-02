@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin.partials.editCreate', [ 'method' => 'PUT', 'routeName' => 'admin.posts.update'])
</div>
@endsection