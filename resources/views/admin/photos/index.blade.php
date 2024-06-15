@extends('layouts.app')

@section('content')

<div class="title">
    <div class="container">
        <h1 class=>Your Photos</h1>
    </div>
</div>
<div class="container">
    @include('partials.session-message')
    <form action="{{route('admin.photos.categories.filter')}}" method="get">
        <div class="d-flex flex-wrap overflow-x-auto gap-2">

            @forelse($categories as $category)
            <div class="form-check col-3">
                <!--Faccio la verifica sfruttando il parametro $checks, passato prima tramite la session e poi con il compact-->
                <input class="form-check-input border-2" type="checkbox" value="{{$category->id}}" id="category-{{$category->id}}" name="categories[]" {{ in_array($category->id, ($checks ? $checks : []))  ? 'checked' : '' }} />
                <label class="form-check-label" for="category-{{$category->id}}">{{$category->title}}</label>
            </div>
            @empty
            <p>no results</p>
            @endforelse
        </div>
        <button type="submit">Filter</button>
    </form>
    <div class="row justify-content-center">
        <div class="card px-0 m-4 w-29 d-flex justify-content-center align-items-center card-add-image">
            <a href="{{route('admin.photos.create')}}">
                <i class="fa-solid fa-circle-plus fa-6x"></i>
            </a>
        </div>

        @forelse($photos as $photo)
        <div class="card px-0 m-4 w-29  d-flex justify-content-end">
            <a href="{{route('admin.photos.show', $photo)}}" class="overflow-hidden card-img-top position-relative">
                @if (Str::startsWith($photo->image, 'https://'))
                <img src="https://picsum.photos/seed/picsum/300/200" class="w-100 position-absolute bottom-0" alt="">
                @else
                <img src="{{asset('storage/' . $photo->image)}}" class="w-100 position-absolute bottom-0" alt="">
                @endif
            </a>
            <!--<div class="card-body">-->
            <div class="d-flex justify-content-between align-items-center prov">
                <div class="title mx-2">
                    <span>{{$photo->title}}</span>
                </div>
                <div class="actions mx-2">
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
                                    <button type="button" class="btn" data-bs-dismiss="modal">Back</button>
                                    <form action="{{route('admin.photos.destroy', $photo)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn delete-btn">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--</div>-->
        </div>

        @empty

        <p>No photo here</p>

        @endforelse
    </div>
</div>
@endsection

<style type="text/css">
    .category-button {
        width: 22, 5%;

        & .badge {
            background-color: var(--button-purple);
        }
    }

    .card-img-top {
        /*height: 80%;*/
        height: 320px;
        background-color: var(--bg-blue) !important;

        & img {
            cursor: pointer;
        }
    }

    .modal-content {
        background-color: var(--bg-softblue) !important;

        & .delete-btn {
            background-color: var(--button-delete) !important;
        }

        & .delete-btn:hover {
            opacity: 0.6;
        }
    }

    .prov {
        height: 80px;
    }

    .card-body {
        width: 100%;
        transition: 0.5s;
    }

    .card-body:hover {

        width: 100%;

    }
</style>