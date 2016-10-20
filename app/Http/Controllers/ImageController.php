<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**

    * Create view file

    *

    * @return void

    */

    public function imageUpload()

    {
    	return "view('image-upload');";

    }


    /**

    * Manage Post Request

    *

    * @return void

    */

    public function imageUploadPost(Request $request)

    {    	
    	$this->validate($request, [

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);    	

        $uname = Auth::user()->username;
        $imageName = $uname.'.'.$request->image->getClientOriginalExtension();
        $path = storage_path() . '/app/photoprofile/';                    
        
        $filesInFolder = \File::files($path);
        foreach($filesInFolder as $delPath)
        {
            $files = pathinfo($delPath);
            if ($files['filename'] == $uname) {     
                $fileToDelete = $files['dirname'].'/'.$files['basename'];
                \File::delete($fileToDelete);
            }
        }

        $request->image->move($path, $imageName);
        $file = $path.$imageName;        
        if(!\File::exists($file)) {
            $success = false;
            $message = "Some Error Occurred!, check your image input.";
        } else {
            $success = true;
            $message = "Image successfully uploaded!";
        }

        return response()->json(['success' => $success, 'msg' => $message]);
    	// return back()
    	// 	->with('success','Image Uploaded successfully.')
    	// 	->with('path', $imageName);

    }

    public function images($filename)
    {                
        $name = "";
        $ext = "";
        $file = storage_path() . '/app/photoprofile'.'/';
        $filesInFolder = \File::files($file);
        
        foreach($filesInFolder as $path)
        {
            $files = pathinfo($path);            
            if ($files['filename'] == $filename) {                
                $name = $files['filename'];
                $ext = $files['extension'];
            }

        }        

        // \File::exists($file)
        if(!$name) {
            $name = 'default-profile';
            $ext = "png";
        }
        
        $file = storage_path() . '/app/photoprofile'.'/'.$name.'.'.$ext;    
        $img = Image::make($file);

        return $img->response($ext);
        // return $manuals;
    }
}
