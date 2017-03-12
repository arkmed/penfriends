@extends('layouts.master')

@section('content')
    <h1>Share your Experience</h1>

    <form method="POST" action="/landing-page/add-experience" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <input type="file"  name="experience_img" />
        </div>

        <div class="form-group">
            <textarea class="form-control" name="message" placeholder="Your Message.."></textarea>
        </div>



        <button class="btn btn-primary" type="submit">SEND</button>
    </form>

    Current Product ID: {{ session()->get('product_id') }}

@stop