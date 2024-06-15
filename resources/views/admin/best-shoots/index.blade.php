@extends('layouts.app')

@section('content')

<div class="title">
    <div class="container">
        <h1>Best Shoots Tags</h1>
    </div>
</div>
@include('partials.session-message')
<div class="container">
    <div class="row gap-1">
        @forelse($best_shoots as $best)
        @forelse($best->photos as $photo)
        <div class="card">
            <div class="mask d-flex align-items-center">
                <img src="{{asset('storage/' . $photo->image)}}" alt="">
                <div class="badge">{{$best->title}}</div>
            </div>
            <h1>{{$photo->title}}</h1>
        </div>
        @empty
        @endforelse
        @empty
        <p>no results</p>
        @endforelse
    </div>
    <div class="row gap-1">
        @forelse($highlighted->photos as $photo)
        <div class="card">
            <div class="mask d-flex align-items-center">
                <img src="{{asset('storage/' . $photo->image)}}" alt="">
                <div class="badge">{{$highlighted->title}}</div>
            </div>
            <h1>{{$photo->title}}</h1>
        </div>
        @empty
        <p>no res</p>
        @endforelse
    </div>
</div>
@endsection

<style type="text/css">
    .card {
        background-color: var(--bg-blue) !important;
        width: 49% !important;

        & .mask {
            height: 300px;
            width: 100%;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;

            img {
                width: 100%;
                position: absolute;
                top: 0;
                left: 0;
            }

        }

        & .badge {
            background-color: var(--button-mag);
            opacity: 0.85;
            position: absolute;
            bottom: 20px;
            right: 0px;
            --bs-badge-font-size: 1em;
            --bs-badge-border-radius: 0;
        }
    }
</style>