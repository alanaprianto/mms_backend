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

        if ($ext=="doc"||$ext=="docx") {
            $name = 'default-doc';
            $ext = "png";
        } else if ($ext=="xls"||$ext=="xlsx") {
            $name = 'default-excel';
            $ext = "png";
        } else if ($ext=="ppt"||$ext=="pptx") {
            $name = 'default-ppt';
            $ext = "png";
        } else if ($ext=="pdf") {
            $name = 'default-pdf';
            $ext = "png";
        }   
        
        $file = storage_path() . '/app/photoprofile'.'/'.$name.'.'.$ext;        
        $img = Image::make($file);

        return $img->response($ext);
        // return $manuals;
    }

    public function uploadedfiles($filename)
    {   
        $filepath = explode(":::", $filename);

        $name = "";
        $ext = "";
        // $file = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/'
        $file = storage_path() . '/app/uploadedfiles/'.$filepath[0].'/';
        $filesInFolder = \File::files($file);

        foreach($filesInFolder as $path)
        {
            $files = pathinfo($path);
            $init = false;

            if ($files['filename'] == $filepath[1]) {
                $name = $files['filename'];
                $ext = $files['extension'];                
            } else {
                if (str_contains($filepath[1], '-thumbs')) {
                    $mname = chop($filepath[1], "-thumbs");                    

                    if ($files['filename'] == $mname) {
                        $asdad = $files['extension'];

                        if (str_contains($asdad, 'doc')||str_contains($asdad, 'xls')||str_contains($asdad, 'ppt')||str_contains($asdad, 'pdf')) {
                            $name = $files['filename'];
                            $ext = $files['extension'];
                        }
                    }                    
                }
            }
        }        
        // \File::exists($file)
        if(!$name) {
            $name = 'default-thumbnail';
            $ext = "jpg";
            $path = storage_path() . '/app/uploadedfiles/';
        } else {
            // $path = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/';
            $path = storage_path() . '/app/uploadedfiles/'.$filepath[0].'/';            
        }        
        
        if ($ext=="doc"||$ext=="docx") {
            $path = storage_path() . '/app/uploadedfiles/';
            if (str_contains($filename, '-thumbs')) {
                $name = 'default-doc-thumbs';
            } else {
                $name = 'default-doc';
            }            
            $ext = "png";
        } else if ($ext=="xls"||$ext=="xlsx") {
            $path = storage_path() . '/app/uploadedfiles/';
            if (str_contains($filename, '-thumbs')) {
                $name = 'default-excel-thumbs';
            } else {
                $name = 'default-excel';
            }            
            $ext = "png";
        } else if ($ext=="ppt"||$ext=="pptx") {
            $path = storage_path() . '/app/uploadedfiles/';
            if (str_contains($filename, '-thumbs')) {
                $name = 'default-ppt-thumbs';
            } else {
                $name = 'default-ppt';   
            }            
            $ext = "png";
        } else if ($ext=="pdf") {
            $path = storage_path() . '/app/uploadedfiles/';
            if (str_contains($filename, '-thumbs')) {
                $name = 'default-pdf-thumbs';
            } else {
                $name = 'default-pdf';   
            }            
            $ext = "png";
        }

        $file = $path.$name.'.'.$ext;        
        $img = Image::make($file);

        return $img->response($ext);
        // return $manuals;
    }
}
