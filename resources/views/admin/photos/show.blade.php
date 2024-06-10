@extends('layouts.app')

@section('content')

<div class="title">
    <div class="container">

        <h1> section show {{$photo->id}}, {{$photo->title}}</h1>
    </div>
</div>
<div class="container">
    @include('partials.session-message')
    <p>{{$photo->slug}}</p>
    <div class="w-50">
        @if (Str::startsWith($photo->image, 'https://'))
        <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top" alt="">
        @else
        <img src="{{asset('storage/' . $photo->image)}}" class="card-img-top" alt="">
        @endif
    </div>

    <span>
        @forelse($photo->categories as $cat)

        {{$cat->title}}
        <br>

        @empty

        N/A

        @endforelse
    </span>

</div>
@endsection