@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin.partials.editCreate', [ 'method' => 'POST', 'routeName' => 'admin.posts.store'])
</div>
@endsection