@extends('layouts.app')

@section('content')

<h1>Sezione best-shoots</h1>

@include('partials.session-message')


<div class="d-flex flex-wrap my-4">
    @forelse($best_shoots as $best)

    <div class="mx-4">
        <span>{{$best->title}}</span>
        <i class="fa-solid fa-marker mx-2" data-bs-toggle="offcanvas" data-bs-target="#edit{{$best->id}}"></i>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="edit{{$best->id}}" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit Best Shoots Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <form action="{{route('admin.best-shoots.update', $best)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="title" class="form-label fs-5 fw-bold">Title</label>
                            <input type="text" class="form-control border-3 border-dark-subtle" name="title" id="title" value="{{old('title', $best->title)}}">
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label fs-6 fw-bold">Slug</label>
                            <input type="text" class="form-control border-3 border-dark-subtle fst-italic" name="slug" id="slug" value="{{old('slug', $best->slug)}}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
        <i class="fa-solid fa-trash mx-2" data-bs-toggle="modal" data-bs-target="#{{$best->id}}"></i>
        <div class="modal fade" id="{{$best->id}}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete best shoots tag</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this best shoots tag permanently?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <form action="{{route('admin.best-shoots.destroy', $best)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @empty
    <span>No results</span>
    @endforelse

    <div class="mx-4">
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#AddBestTag">Add New Best Tag</button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="AddBestTag" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add New Best Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <form action="{{route('admin.best-shoots.store')}}" method="POST">
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
    </div>

</div>


@endsection