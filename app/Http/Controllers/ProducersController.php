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

    public function replyExperience(Experience $experience) {

        if($experience->reply) {
            return view('producers.experience.reply', compact('experience'));
        }

        return "The user doesn't want a reply.";

    }

    public function sendReply(Experience $experience) {

        // Validate


        // Upload Picture (+ Python Script 2)


        // Send Mail


        return $experience;
    }


}
