@extends('layouts.admin')

@section('content')


<h1>category index</h1>
@include('partials.session-message')
<button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#AddCategory">Add category</button>
<div class="offcanvas offcanvas-start" tabindex="-1" id="AddCategory" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fs-5 fw-bold">Title</label>
                    <input type="text" class="form-control border-3 border-dark-subtle" name="title" id="title" value="">
                    @error('title')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<table class="table table-borderless">
    <th>
        <tr>
            <td>Title</td>
            <td>Slug</td>
            <td>Posts n°</td>
            <td></td>
        </tr>
    </th>


    @forelse($categories as $category)
    <tr>
        <td>
            <span>{{$category->title}}</span>
        </td>
        <td>
            <em>{{$category->slug}}</em>
        </td>
        <td>
            <span>{{$category->photos->count()}}</span>
        </td>
        <td>
            <i class="fa-solid fa-marker mx-2" data-bs-toggle="offcanvas" data-bs-target="#edit{{$category->id}}"></i>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="edit{{$category->id}}" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <form action="{{route('admin.categories.update', $category)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="title" class="form-label fs-5 fw-bold">Title</label>
                                <input type="text" class="form-control border-3 border-dark-subtle" name="title" id="title" value="{{old('title', $category->title)}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label fs-6 fw-bold">Slug</label>
                                <input type="text" class="form-control border-3 border-dark-subtle fst-italic" name="slug" id="slug" value="{{old('slug', $category->slug)}}" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>

            <i class="fa-solid fa-trash mx-2" data-bs-toggle="modal" data-bs-target="#{{$category->id}}"></i>
            <div class="modal fade" id="{{$category->id}}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this category permanently?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                            <form action="{{route('admin.categories.destroy', $category)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        @empty
        <span>No categories</span>
    </tr>
    @endforelse
</table>
@endsection