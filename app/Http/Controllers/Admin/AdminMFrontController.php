<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Mfront;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class AdminMFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        return view('admin.marketplace.front.index', compact('notifs'));
    }

    public function indexAjax() {
        $mfs = Mfront::get();
        return Datatables::of($mfs)->make(true);
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
        return view('admin.marketplace.front.create', compact('notifs', 'parent_cat'));
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

        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required',
            'position' => 'required',
        ]);

        if ($validator->passes()) {
            Mfront::create($input);

            return redirect('/admin/marketplace/frontend');
        } else {
            return Redirect::to('/admin/marketplace/frontend_/create')->withErrors($validator);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();

        $mf = Mfront::find($id);
        $parent_cat = Category::where('status', '=', 'parent')->get();

        return view('admin.marketplace.front.edit', compact('notifs', 'parent_cat', 'mf'));
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
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required',
            'position' => 'required',
        ]);

        if ($validator->passes()) {
            $mf = Mfront::findOrFail($id);

            $mf->update($request->all());

            return redirect('/admin/marketplace/frontend');
        } else {
            return Redirect::to('/admin/marketplace/frontend/'.$id.'/edit')->withErrors($validator);
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
        $mf = Mfront::findOrFail($id);

        try {
            $mf->delete();
            $deleted = true;
            $deletedMsg = "Data " . $mf->name . " is deleted";
        }catch(\Exception $e){
            $deleted = false;
            $deletedMsg = "Error while deleting data";
        }

        return response()->json(['success' => $deleted, 'msg' => $deletedMsg]);
    }

    public function detail_product($id)
    {
        $notifs = \App\Helpers\Notifs::getNotifs();
        $mf = Mfront::find($id);

        return view('admin.marketplace.front.products', compact('notifs', 'mf'));
    }

    public function api_product_all()
    {
        $product = Product::orderBy('created_at', 'desc')->get();
        return Datatables::of($product)->make(true);
    }
}
