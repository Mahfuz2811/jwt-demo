<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function upload(Request $request)
    {
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension();
        $token = $this->generateRandomString(30);
        \Storage::disk('uploads')->put($token.'.'.$extension,  File::get($cover));
    }


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function uploadImg($file, $path, $token_length)
    {

        //$extension = $file->getClientOriginalExtension();
        $extension = 'png';
        $token = $this->generateRandomString($token_length);

        // Generating new file name...
        $file_name = $token.".".$extension;



        //$file->move('uploads/' . $path, $file_name);

    }
}
