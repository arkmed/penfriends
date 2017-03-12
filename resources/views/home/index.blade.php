@extends('layouts.master')

@section('content')
    <h1>Entrance Page</h1>

    <label>Please enter product code</label>

    <form class="form-inline" method="POST" action="/entrance/submit-code">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="text" name="product_code" />
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@stop