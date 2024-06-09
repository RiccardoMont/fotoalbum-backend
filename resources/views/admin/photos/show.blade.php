@extends('layouts.admin')

@section('content')


<h1> section show {{$photo->id}}, {{$photo->title}}</h1>
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
@endsection