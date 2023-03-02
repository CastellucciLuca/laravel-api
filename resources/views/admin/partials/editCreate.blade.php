<form action="{{ route($routeName, $post) }}" method="POST" class="p-5" enctype="multipart/form-data">
    @csrf
    @method($method)

    @if($errors->any())
    <div class="error-wrapper">
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <h5 class="mb-3">
        Author: <span class="fw-semibold">{{ Auth::user()->name }} </span>
    </h5>

    <div class="mb-3  d-flex align-items-center justify-content-between">
        @foreach ($technologyList as $technology)
                <div class="d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" name="technologies[]" value="{{ $technology->id }}"
                    @if ($errors->any())
                        @checked(in_array($technology->id, old('technologies',[])))
                    @else
                        @checked($post->technologies->contains($technology->id))
                    @endif
                    >
                    <label class="form-check-label ms-2">{{ $technology->name }}</label>
                </div>
                @endforeach
    </div>
    <div class="mb-3">
        <label for="post_category" class="form-label">
            Post Title
        </label>

        <select  class="form-control" id="post_type" name="type_id" >
            @foreach ($typesList as $type)
                <option value="{{ $type->id }}"
                    {{ old('type_id', $post->type_id) ==  $type->id ? 'selected' : '' }}> {{ $type->name }}
                </option>
            @endforeach
        </select>

    </div>
    <div class="mb-3">
        <label for="post_title" class="form-label">Post Title</label>
        <input type="text" class="form-control" id="post_title" placeholder="Insert Post title" name="title" value="{{ old('title', $post->title )}}">
    </div>

    <div class="mb-3">
        <label for="post_date" class="form-label">Post date</label>
        <input type="dateTime" class="form-control" id="post_date" name="post_date" value="{{ old('post_date', $post->post_date )}}">
    </div>

    <div class="mb-3">
        <label for="post_content" class="form-label">Post content</label>
        <textarea class="form-control" id="post_content" rows="10" name="content">{{ old('content', $post->content )}}</textarea>
    </div>

    <div class="mb-3">
        <label for="post_content" class="form-label">Post image</label>
        <input type="file" class="form-control" id="post_image" name="image" value="{{ old('image', $post->image) }}">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
                    Create new post
        </button>
    </div>

</form>

