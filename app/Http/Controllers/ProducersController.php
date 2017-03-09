<?php

namespace App\Http\Controllers;

use Auth;

use App\Experience;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProducersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $experiencesReceived = Auth::user()->experiencesReceived();




        return view('producers.index', compact('experiencesReceived'));
    }

    public function showExperience(Experience $experience) {

        return view('producers.experience.show', compact('experience'));


    }


}
