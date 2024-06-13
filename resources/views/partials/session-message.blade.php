@if(session('message'))
<div class="alert 
    @if(session('value'))
    alert-danger
    @else
    alert-success
    @endif
    "
    role="alert">
    {{session('message')}}
</div>

@endif