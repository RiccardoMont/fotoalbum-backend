@extends('layouts.app')

@section('content')

<div class="container d-flex flex-no-wrap gap-4 py-4">
    @include('partials.session-message')

    <div class="w-50">
        @if (Str::startsWith($photo->image, 'https://'))
        <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top" alt="">
        @else
        <img src="{{asset('storage/' . $photo->image)}}" class="card-img-top" alt="">
        @endif
    </div>
    <div class="w-50 p-2 d-flex flex-column justify-content-between">
        <div class="texts">
            <div class="title">
                <span>{{$photo->title}}</span>
            </div>
            <p>{{$photo->slug}}</p>
            <div class="d-flex align-items-center flex-wrap gap-2">
                @forelse($photo->categories as $cat)
                <div class="badge">{{$cat->slug}}</div>
                @empty
                @endforelse
            </div>
            <div class="py-1">
                <p class="fst-italic">{{$photo->description}}</p>
            </div>

        </div>
        <div class="actions_edit d-flex justify-content-between">
            <a href="{{route('admin.photos.edit', $photo)}}"><i class="fa-solid fa-marker fa-2x mx-2"></i></a>
            <i class="fa-solid fa-trash fa-2x mx-2" data-bs-toggle="modal" data-bs-target="#{{$photo->id}}"></i>
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

</div>
@endsection

<style type="text/css">
    .badge {
        background-color: var(--button-mag);

    }

    .actions_edit {

        & .fa-marker {
            color: var(--button-edit);
        }


        & .fa-marker:hover {
            opacity: 0.6;
        }

        & .fa-trash {
            color: var(--button-delete);
            cursor: pointer;
        }

        & .fa-trash:hover {
            opacity: 0.6;
        }

    }
</style>