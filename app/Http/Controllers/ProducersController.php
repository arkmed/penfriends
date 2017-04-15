<?php

namespace App\Http\Controllers;

use Mail;

use Auth;

use App\Experience;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;


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

    public function sendReply(Experience $experience, Request $r) {

        // Validate
        // # check reply column boolean


        // Store image

        $replyMessage = $r->message;

        $file = $r->file('experience_reply_img');

        $image = \Image::make($file->getRealPath());

        $fileExt = $file->getClientOriginalExtension();

        $rand = rand();

        $filename = 'reply-img-'.$rand.'.'.$fileExt;



        $storage = \Storage::disk('replies');
        $path = $filename;


        // Resize Image (thumbnail)

        $thumbnail = \Image::make(Input::file('experience_reply_img'))->encode()->fit(500)->orientate()->stream();
        $thumbnail = $thumbnail->__toString();

        // Upload thumbnail to s3
        //$s3->put($filename, $thumbnail, 'public');


        $storage->put($filename, $thumbnail);


        $user = Auth::user();

        // Image Full Path to embed in email ! */
        $fullPath = public_path()."/replies/".$filename;


        // Send Mail
        Mail::send('emails.reply', ['user' => $user, 'fullPath' => $fullPath, 'replyMessage' => $replyMessage], function ($m) use ($user, $fullPath, $replyMessage) {
            $m->from('agora@test.com', 'AGORA PROJECT');

            $m->to('stasikdavid1@gmail.com', $user->name)->subject('AGORA TEST MAIL SUBJECT');
            $m->attach($fullPath);
        });



        return $experience;
    }

    public function showImage($filename) {

        return \Image::make(storage_path() . '/app/replies/' . $filename)->response();
    }


}
