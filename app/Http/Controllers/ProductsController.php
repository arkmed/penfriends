<?php

namespace App\Http\Controllers;

use App\Product;

use App\Experience;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Http\Requests;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProductsController extends Controller
{
    public function submitCode(Request $r) {

        // validate
        $this->validate($r, [
            'product_code' => 'required|integer',
        ]);

        $code = $r->product_code;

        //return $this->checkCode($code);

        $productID = $this->checkCode($code);

        if($productID) {

            // set product_id session
            session(['product_id' => $productID]);

            return redirect('/landing-page');
        }

        return redirect('/')->withErrors('Product Code does not exist.');
    }

    /**
     * Executes Python Script ( placeholder )
     */
    private function runPython() {

        ///////////////////
        // EXECUTE PYTHON SCRIPT

        $pythonPath = storage_path().'/python/test.py';


        $command = "python ".$pythonPath;
        $process = new Process($command);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();

        ///////////////////

    }


    /**
     * @param $code
     * @return Product ID or false
     */
    private function checkCode($code) {


        // check product code against db
        $result = Product::select('id')->where('code', '=', $code)->get();

        if(!count($result)) {
            return false;
        }

        $productID = $result[0]->id;

        return $productID;

    }

    public function addExperience(Request $r) {

        // validate
        # ...

        ###################################

        //return $image;

        // Validate Image
        $this->validate($r, [
            'experience_img' => 'required|image|max:5000'
        ]);

        $file = $r->file('experience_img');

        $image = \Image::make($file->getRealPath());


        // Store image

        $fileExt = $file->getClientOriginalExtension();

        $rand = rand();

        $filename = 'experience-img-'.$rand.'.'.$fileExt;



        //$s3 = \Storage::disk('s3');
        $storage = \Storage::disk('uploads');
        $path = $filename;


        // Resize Image (thumbnail)

        $thumbnail = \Image::make(Input::file('experience_img'))->encode()->fit(500)->orientate()->stream();
        $thumbnail = $thumbnail->__toString();

        // Upload thumbnail to s3
        //$s3->put($filename, $thumbnail, 'public');


        $storage->put($filename, $thumbnail);


        #####################################################

        //return $this->runPython();


        #####################################################

        // Get the product ID by session (if exists)
        if(session()->has('product_id')) {
            $productID = session()->get('product_id');
        }
        else
            return "Something went wrong with the product ID session..";



        // Store experience
        $experience = new Experience;
        $experience->image = $filename;   // FIX THIS !
        $experience->message = $r->message;
        $experience->reply = false;   // default
        $experience->product_id = $productID;
        $experience->created_at = \Carbon\Carbon::now();

        $experience->save();

        session(['experience_id' => $experience->id]);


        return redirect('/thank-you');

    }

    public function setReplyTrue(Request $r) {


        // update experience reply if yes was selected
        if($r->want_response == true) {

            // validate email
            $this->validate($r, [
                'email' => 'required'
            ]);



            // Check if email was given
//            if(empty($r->email)) {
//                return "You have to enter your email so that the producer can reply!";
//            }

            $experienceID = session()->get('experience_id');
            $experience = Experience::find($experienceID);

            $experience->update([
                'reply' => true,
                'user_email' => $r->email
            ]);

        }

        return redirect('/');

    }

    public function showImage($filename) {

        return \Image::make(storage_path() . '/app/uploads/' . $filename)->response();
    }

}
