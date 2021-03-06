@extends('layouts.producers')

@section('content')
    <h1>Show Experience</h1>

    <p>

        <img src="/images/{{ $experience->image }}" />

        <b>Product:</b> {{ $experience->product->name }} <br />

        <b>Image:</b> {{ $experience->image }} <br />
        <b>Message:</b> {{ $experience->message }} <br />


        @if($experience->reply == true)

            <form method="get" action="/producers/experience/{{ $experience->id }}/reply">
                <button class="btn btn-default">Reply</button>
            </form>

        @else
            <p style="color:red">The User doesnt want a reply.</p>
        @endif

    </p>

@stop