@extends('layouts.producers')

@section('content')
    <h1>Show Experience</h1>

    <p>
        Product: {{ $experience->product->name }} <br />
        Image: {{ $experience->image }} <br />
        Message: {{ $experience->message }} <br />


        @if($experience->reply == true)
            Email: {{ $experience->user_email }}
            <button>Reply</button> <br />
        @else
            The User doesnt want a reply.
        @endif

    </p>

@stop