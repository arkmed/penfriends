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

        @if($errors->has())
            @foreach ($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif

    </form>
@stop