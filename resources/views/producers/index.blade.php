@extends('layouts.producers')

@section('content')

    <h1>Producers Panel</h1>

    <h3>Experiences Received</h3>

    @foreach($experiencesReceived as $experience)
        <a href="/producers/experience/{{ $experience->id }}">Experience for: {{  $experience->product->name }} </a><br />
    @endforeach

@stop

