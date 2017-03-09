@extends('layouts.master')

@section('content')
    <h1>Thank your for sharing</h1>

    <p>Would you like a response?</p>

    <form method="POST" action="/thank-you/store">

        {{  csrf_field()  }}

        <input id="want_response_yes" type="radio" name="want_response" value="1"> Yes<br>
        <input id="email" type="email" name="email" placeholder="Enter your email here.." /><br />

        <input id="want_response_no" type="radio" name="want_response" value="0" checked> No<br>

        <button type="submit">OK</button>
    </form>

    Current Product ID : {{ session()->get('product_id') }} <br />
    Current Experience ID: {{ session()->get('experience_id') }}



@stop

@section('scripts')
    <script>


        $('#want_response_yes').click(function() {
            $("#email").show();
        });

        $('#want_response_no').click(function() {
            $("#email").hide();
        });

    </script>
@stop