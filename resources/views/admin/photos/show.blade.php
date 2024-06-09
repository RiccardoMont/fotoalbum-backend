@extends('layouts.admin')

@section('content')


<h1> section show {{$photo->id}}, {{$photo->title}}</h1>
<p>{{$photo->slug}}</p>
<div class="w-100">

    @if (Str::startsWith($photo->image, 'https://'))
    <img src="https://picsum.photos/seed/picsum/300/200" class="card-img-top" alt="">
    @else
    <img src="{{asset('storage/' . $photo->image)}}" class="card-img-top" alt="">
    @endif
</div>
@endsection