@extends('layouts.master')

@section('content')
    <h1>Entrance Page</h1>

    <p>Please enter product code</p>

    <form method="POST" action="/entrance/submit-code">
        {{ csrf_field() }}

        <input type="text" name="product_code" />
        <button type="submit">Submit</button>
    </form>
@stop