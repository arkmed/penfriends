@extends('layouts.master')

@section('content')
    <h1>Share your Experience</h1>

    <form method="POST" action="/landing-page/add-experience" enctype="multipart/form-data">

        {{ csrf_field() }}

        <input type="file" name="experience_img" />

        <textarea name="message" placeholder="Your Message.."></textarea>

        <button type="submit">SEND</button>
    </form>

    Current Product ID: {{ session()->get('product_id') }}

@stop