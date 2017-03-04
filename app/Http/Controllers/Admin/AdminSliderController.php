<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Slider;
use Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Image;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('admin.marketplace.slider.index', compact('notifs'));
    }

    public function indexAjax() {        
        $slider = Slider::get();
        return Datatables::of($slider)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();        

        $slider = null;
        return view('admin.marketplace.slider.create', compact('notifs', 'slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if ($request->hasFile('img')) {
//            return 'ada file';
//        } else {
//            return 'tidak ada file';
//        }

        $input = $request->all();        

        $validator = Validator::make($input, [
            'title' => 'required',
            'link' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
            $path = storage_path().'/app/slider/';
            if(!\File::exists($path)) {
              \File::makeDirectory($path,0777,true);
            }

            $file = $input['img'];
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $imageName = $name;

            $names = explode(".", $name);
            $thmbName = $names[0].'-thumbs.'.$names[1];
            $image = Image::make($file);
            $image->fit(100, 100)->save($path.$thmbName);

            $file->move($path, $imageName);
            $file = $path.$imageName;
            if(\File::exists($file)) {
                $input['img'] = $imageName;
                Slider::create($input);
            }

            return redirect('/admin/marketplace/slider');
        } else {
            return Redirect::to('/admin/marketplace/slider_/create')->withErrors($validator);
        }            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/marketplace/slider');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);        

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('admin.marketplace.slider.edit', compact('slider', 'notifs'));
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
        if ($request->hasFile('img')) {
            return 'ada file';
        } else {
            return 'tidak ada file';
        }

        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);         

        try {
            $names = explode(".", $slider->img);
            $thmbName = $names[0].'-thumbs.'.$names[1];

            $path1 = storage_path() . '/app/slider/'.$slider->img;
            $path2 = storage_path() . '/app/slider/'.$thmbName;
            \File::deleteDirectory($path1);
            \File::deleteDirectory($path2);

            $slider->delete();

            $deleted = true;
            $deletedMsg = "Data " . $slider->title . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
