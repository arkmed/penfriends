<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImagesController extends Controller
{
    public function upload() {
        return view('images.upload');
    }

    public function show() {
        return view('images.show');
    }

    public function test() {
        // Test database connection
        try {
            \DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration.");
        }
    }
}
