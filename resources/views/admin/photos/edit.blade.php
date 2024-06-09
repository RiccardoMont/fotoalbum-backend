@extends('layouts.admin')

@section('content')

<h1>Section Edit</h1>
@include('partials.errors')
@include('partials.session-message')

<form action="{{route('admin.photos.update', $photo)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label fs-5 fw-bold">Title</label>
        <input type="text" class="form-control border-3 border-dark-subtle" name="title" id="title" value="{{old('title', $photo->title)}}">
        @error('title')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        @if (Str::startsWith($photo->image, 'https://'))
        <img src="https://picsum.photos/seed/picsum/300/200" class="w-25" alt="">
        @else
        <img src="{{asset('storage/' . $photo->image)}}" class="w-25" alt="">
        @endif
        <div class="mb-3">
            <label for="image" class="form-label fs-5 fw-bold">Photo</label>
            <input type="file" class="form-control border-3 border-dark-subtle" name="image" id="image" placeholder="image" aria-describedby="coverImageHelper">
            <div id="coverImageHelper" class="form-text">Upload a photo</div>
            @error('image')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label fs-5 fw-bold">Description</label>
        <textarea type="text" class="form-control border-3 border-dark-subtle" name="description" id="description" rows="6" cols="100">{{old('description', $photo->description)}}</textarea>
        @error('description')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <div class="label">
            <label class="form-label fs-5 fw-bold">Categories</label>
        </div>
        <div class="d-flex flex-wrap">
            @foreach ($categories as $category)
            <div class="form-check col-3">
                @if($errors->any())
                <input class="form-check-input border-3 border-secondary" type="checkbox" value="{{$category->id}}" id="category-{{$category->id}}" name="categories[]" {{ in_array($category->id, old('categories', []))  ? 'checked' : '' }} />
                @else
                <input class="form-check-input border-3 border-secondary" type="checkbox" value="{{$category->id}}" id="category-{{$category->id}}" name="categories[]" {{ $photo->categories->contains($category) ? 'checked' : '' }} />
                @endif
                <label class="form-check-label" for="category-{{$category->id}}">{{$category->title}}</label>
            </div>
            @endforeach
        </div>
        @error('categories')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <button class="btn btn-primary my-4" type="submit">Update</button>

</form>


@endsection