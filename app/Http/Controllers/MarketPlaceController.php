<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Category;
use App\Product;
use App\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Image;
use Datatables;

class MarketPlaceController extends Controller
{        
    public function __construct()
    {        
        $this->role = Auth::user()->role;
        if ($this->role!=2||$this->role!=6) {
            return redirect('/');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        
        
        return view('common.marketplace.index', compact('notifs', 'barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        $parent_cat = Category::where('status', '=', 'parent')->get();

        return view('common.marketplace.create', compact('notifs', 'parent_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // return $request->all();
        $cby = Auth::user()->id;
        $product = Product::create([
                'gallery_id' => 0,
                'category_id' => 0,
                'title' => '',
                'description' => '',
                'short_desc' => '',
                'price_min' => 0,
                'price_max' => 0,
                'created_by' => $cby
            ]);

        if ($product->id) {
            $success = true;
            $id = $product->id;
        } else {
            $success = false;
            $id = 0;
        }    
        
        return response()->json(['success' => $success, 'id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            if ($this->role==2) {
                return redirect('/member/marketplace');
            } else if ($this->role==6) {
                return redirect('/alb/marketplace');
            }
        }

        $parent_cat = Category::where('status', '=', 'parent')->get();
        $gallery = Gallery::where('product_id', '=', $id)->get();

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('common.marketplace.edit', compact('product', 'notifs', 'parent_cat', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $cby = Auth::user()->id;
        $request['created_by'] = $cby ;
        $request['short_desc'] = str_limit($request['description'], 20);
        $product = Product::find($id);
        $product->update($request->all());

        if ($this->role==2) {
            return redirect('/member/marketplace');
        } else if ($this->role==6) {
            return redirect('/alb/marketplace');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $galleries = Gallery::where('product_id', '=', $product->id)->get();

        try {
            $product->delete();
            foreach ($galleries as $key => $gallery) {
              $gallery->delete();
            }

            $pathold = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/product/'.$id."/";
            \File::deleteDirectory($pathold);

            $deleted = true;
            $deletedMsg = "Data " . $product->name . " is deleted";
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function create_gallery(Request $request)
    {
        $files = $request['file'];
        $pid = $request['product_id'];
        $size = $request['size'];        
        
        $dt = new Collection;
        foreach ($files as $key => $file) {
            $path = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/product/'.$pid."/";
            if(!\File::exists($path)) {
              \File::makeDirectory($path,0777,true);
            }

            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $imageName = $name;

            $file->move($path, $imageName);
            $file = $path.$imageName;
            if(\File::exists($file)) {
              $input['product_id'] = $pid;
              $input['created_by'] = Auth::User()->id;
              $input['filename'] = $imageName;
              $input['size'] = $size;
              $gallery = Gallery::create($input);
                            
              $names = explode(".", $name);
              $thmbName = $names[0].'-thumbs.'.$ext;
              $image = Image::make($file);
              $image->fit(200, 200)->save($path.$thmbName);

              $dt->push([
                    'key' => $key,
                    'filename' => $imageName,
                    'success' => true,
                    'msg' => 'File successfully Uploaded',
                ]);

              if ($key==0) {
                $product = Product::find($pid);
                $product->update([
                    'gallery_id' => $gallery->id
                ]);
              }

            } else {
                $dt->push([
                    'key' => $key,
                    'filename' => $imageName,
                    'success' => false,
                    'msg' => 'Problem Uploading File',
                ]);
            }
        }

        return response()->json($dt);
    }

    public function delete_gallery(Request $request)
    {
        $file = $request['file'];
        $pid = $request['id_product'];
        
        $path = storage_path() . '/app/uploadedfiles/'.Auth::user()->username.'/product/'.$pid."/";
        if(!\File::exists($path)) {
          return response()->json(['success' => false, 'msg' => 'Path Not Exist!']);
        }

        $imageName = $file;

        $names = explode(".", $file);
        $thmbName = $names[0].'-thumbs.'.$names[1];

        $file1 = $path.$imageName;
        $file2 = $path.$thmbName;        
        \File::delete($file1);
        \File::delete($file2);

        if(\File::exists($file1)||\File::exists($file2)) {
          return response()->json(['success' => false, 'msg' => 'Error Deleting File!']);
        } else {
          $gallery = Gallery::where('product_id', '=', $pid)->where('filename', '=', $file)->first();
                    
          try {
              $gallery->delete();
              $deleted = true;
              $deletedMsg = "Data " . $gallery->filename . " is deleted";      
          }catch(\Exception $e){
              $deleted = false;
              $deletedMsg = "Error while deleting data";      
          }
          return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
        }
    }

    public function listBarang()
    {
      $id = Auth::user()->id;      
      $ccat = Category::where('parent_id', '=', 1)->pluck('id');
      $product = Product::where('created_by', '=', $id)->whereIn('category_id', $ccat)->get();

      return Datatables::of($product)->make(true);
    }

    public function listJasa()
    {
      $id = Auth::user()->id;      
      $ccat = Category::where('parent_id', '=', 2)->pluck('id');
      $product = Product::where('created_by', '=', $id)->whereIn('category_id', $ccat)->get();

      return Datatables::of($product)->make(true);
    }    
}
