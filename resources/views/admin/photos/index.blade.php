@extends('layouts.app')

@section('content')

<div class="title">
    <div class="container">
        <h1 class=>Your Photos</h1>
    </div>
</div>
<div class="container">
    @include('partials.session-message')
    <div class="row mx-n4">

        @forelse($photos as $photo)

        <div class="card px-0 m-4 col-3 overflow-hidden">
            @if (Str::startsWith($photo->image, 'https://'))
            <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top" alt="">
            @else
            <img src="{{asset('storage/' . $photo->image)}}" class="card-img-top" alt="">
            @endif
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="title">
                        <span class="card-title">{{$photo->title}}</span>
                    </div>
                    <div class="actions mx-n2">
                        <a href="{{route('admin.photos.show', $photo)}}"><i class="fa-solid fa-mountain-sun mx-2"></i></a>
                        <a href="{{route('admin.photos.edit', $photo)}}"><i class="fa-solid fa-marker mx-2"></i></a>
                        <i class="fa-solid fa-trash mx-2" data-bs-toggle="modal" data-bs-target="#{{$photo->id}}"></i>
                        <div class="modal fade" id="{{$photo->id}}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete photo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this photo permanently?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                        <form action="{{route('admin.photos.destroy', $photo)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @empty

        <p>No photo here</p>

        @endforelse
    </div>
</div>
@endsection

<style type="text/css">
    .card-body {
        width: 100%;
        transition: 0.5s;
    }

    .card-body:hover {

        width: 100%;

    }

    a {
        text-decoration: none;


    }

    .fa-trash:hover {
        cursor: pointer;
        color: red;
    }
</style>