@extends('layouts.producers')

@section('content')
    <h1>Reply to Experience ID:  {{ $experience->id }}</h1>

    <p>
        To User Email: {{ $experience->user_email }} <br />
    </p>

    <form method="POST" action="/producers/experience/{{ $experience->id }}/sendReply" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <input type="file" name="experience_reply_img" />
        </div>

        <div class="form-group">
            <textarea class="form-control" name="message" placeholder="Your Message.."></textarea>
        </div>


        <button class="btn btn-primary" type="submit">Reply</button>
    </form>
@stop