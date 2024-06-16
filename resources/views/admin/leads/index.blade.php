@extends('layouts.app')

@section('content')
<div class="title">
    <div class="container">
        <h1>Messages</h1>
    </div>
</div>
<div class="container">
    <table class="table table-borderless table-striped">
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Message</td>
            <td></td>
        </tr>
        @forelse($leads as $lead)
        <tr>
            <td>{{$lead->name}}</td>
            <td>{{$lead->email}}</td>
            <td>{{$lead->message}}</td>
            <td>
                <i class="fa-solid fa-book-open" data-bs-toggle="modal" data-bs-target="#{{$lead->id}}"></i>
                <div class="modal fade" id="{{$lead->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">From: {{$lead->name}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="text" class="form-control" id="email" value="{{$lead->email}}"> 
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text">{{$lead->message}}</textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-trash mx-2" data-bs-toggle="modal" data-bs-target="#{{$lead->id}}-delete"></i>
                <div class="modal fade" id="{{$lead->id}}-delete" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteModalLabel">Delete Message</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this messsage permanently?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">Back</button>
                                <form action="{{route('admin.leads.destroy', $lead)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-btn" type="submit" class="btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <p>no results</p>
        @endforelse
    </table>
</div>
@endsection