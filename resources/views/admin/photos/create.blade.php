@extends('layouts.app')

@section('content')
<div class="title">
    <div class="container">

        <h1>Section Create</h1>
    </div>
</div>
<div class="container">

    @include('partials.errors')
    @include('partials.session-message')

    <form action="{{route('admin.photos.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fs-5 fw-bold">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fs-5 fw-bold">Photo</label>
            <input type="file" class="form-control" name="image" id="image" placeholder="image" aria-describedby="coverImageHelper">
            @error('image')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fs-5 fw-bold">Description</label>
            <textarea type="text" class="form-control" name="description" id="description" rows="6" cols="100">{{old('description')}}</textarea>
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
                    <input class="form-check-input border-2" type="checkbox" value="{{$category->id}}" id="category-{{$category->id}}" name="categories[]" {{ in_array($category->id, old('categories',[]))  ? 'checked' : '' }} />
                    <label class="form-check-label" for="category-{{$category->id}}">{{$category->title}}</label>
                </div>
                @endforeach
            </div>
            @error('categories')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="best_shoot_id" class="form-label fs-5 fw-bold">Best Shoots Tag</label>
            <select class="form-select" name="best_shoot_id" id="best_shoot_id">
                <option value="">Select one</option>
                @foreach ($best_shoots as $best_shoot)
                <option value="{{$best_shoot->id}}" {{$best_shoot->id == old('best_shoot_id') ? 'selected' : ''}}>{{$best_shoot->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <div class="label">
                <label class="form-label fs-4 fw-bold">Ready to publish?</label>
            </div>
            <div class="d-flex">
                <div class="form-check col-3">
                    <input class="form-check-input" type="radio" name="published" id="published_1" value=1 checked>
                    <label class="form-check-label" for="published_1">
                        Publish
                    </label>
                </div>
                <div class="form-check col-3">
                    <input class="form-check-input" type="radio" name="published" id="published_0" value=0>
                    <label class="form-check-label" for="published_0">
                        Save in Drafts
                    </label>
                </div>
                @error('published')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

        <button class="btn btn-primary my-4" type="submit">Create</button>

    </form>
</div>


@endsection

<style type="text/css">



</style>