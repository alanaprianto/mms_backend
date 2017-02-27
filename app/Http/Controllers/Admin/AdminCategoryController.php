<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Datatables;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('admin.marketplace.category.index', compact('notifs'));
    }

    public function indexAjax() {        
        $cat = Category::get();
        return Datatables::of($cat)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $cat = Category::pluck('title', 'id');

        return view('admin.marketplace.category.create', compact('notifs', 'cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $lower = strtolower($input['title']);
        $img = str_replace(' ', '_', $lower);
        $input['main_img'] = $img;

        $validator = Validator::make($input, [
            'title' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            Category::create($input);
        } else {
            return Redirect::to('/admin/marketplace/category/create')->withErrors($validator);
        }
        
        return redirect('/admin/marketplace/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/marketplace/category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $cat = Category::pluck('title', 'id');

        $notifs = \App\Helpers\Notifs::getNotifs();
        return view('admin.marketplace.category.edit', compact('category', 'cat', 'notifs'));
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
        $input = $request->all();
        $lower = strtolower($input['title']);
        $img = str_replace(' ', '_', $lower);
        $input['main_img'] = $img;

        $validator = Validator::make($input, [
            'title' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            $category = Category::find($id);
            $category->update($input);
        }
        
        return redirect('/admin/marketplace/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);         

        try {
            $category->delete();
            $deleted = true;
            $deletedMsg = "Data " . $category->name . " is deleted";      
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";      
        }
        
        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }
}
