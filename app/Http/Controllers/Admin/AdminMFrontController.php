<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Mfront;
use App\Mfront_product;
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
            $mf = Mfront::create($input);

            if (str_contains($input['type'], 'category')) {
                Mfront_product::create([
                    'type' => $input['type'],
                    'id_mfront' => $mf->id,
                    'id_product' => $input['cat_id'],
                    'title' => 'Category Type'
                ]);
            }

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

        $parent_cat = Category::where('status', '=', 'parent')->get();

        return view('admin.marketplace.front.products', compact('notifs', 'mf', 'parent_cat'));
    }

    public function api_product_all(Request $request, $id)
    {
        $category = $request->category;
        $mf = Mfront::find($id);

        if (str_contains($mf->type, 'category')) {
            $product = Product::where('category_id', '!=', $mf->cat_id);
        } else {
            $mfp = Mfront_product::where('id_mfront', '=', $id)->pluck('id_product');
            $product = Product::whereNotIn('id', $mfp);
        }

        if ($category!=0) {
            $categories = Category::where('parent_id', '=', $category)->pluck('id')->toArray();
            $c = array($category);
            array_push($categories, $c);
            $product = $product->whereIn('category_id', $categories);
        }

        $product = $product->orderBy('created_at', 'desc')->get();
        return Datatables::of($product)->make(true);
    }

    public function api_product_id($id)
    {
        $mf = Mfront::find($id);

        if (str_contains($mf->type, 'category')) {
            $product = Product::where('category_id', '=', $mf->cat_id)->get();
        } else {
            $mfp = Mfront_product::where('id_mfront', '=', $id)->pluck('id_product');
            $product = Product::whereIn('id', $mfp)->get();
        }

        return Datatables::of($product)->make(true);
    }

    public function func_add(Request $request)
    {
        $input = $request->all();
        $products = explode(",", $input['products']);
        $idm = $input['id_mfront'];
        $type = $input['type'];

        try {
            $sum = 0;
            foreach ($products as $key => $value) {
                if ($value) {
                    $product = Product::find($value);
                    if ($product) {
                        Mfront_product::create([
                            'type' => $type,
                            'id_mfront' => $idm,
                            'id_product' => $product->id,
                            'title' => 'Added Product'
                        ]);
                    }
                    $sum = $sum+1;
                }
            }

            if ($sum==1) {
                $success = true;
                $msg = "Data added";
            } else if ($sum>1) {
                $success = true;
                $msg = "Datas added";
            } else {
                $success = false;
                $msg = "No Data Provided";
            }
        }catch(\Exception $e){
            $success = false;
            $msg = "Error while adding data";
        }

        return response()->json(['success' => $success, 'msg' => $msg]);
    }

    public function func_remove(Request $request)
    {
        $input = $request->all();
        $products = explode(",", $input['products']);
        $idm = $input['id_mfront'];
        $type = $input['type'];

        try {
            $sum = 0;
            foreach ($products as $key => $value) {
                if ($value) {
                    $product = Product::find($value);
                    if ($product) {
                        $mfp = Mfront_product::where('id_mfront', '=', $idm)->
                                where('id_product', '=', $product->id)->first();
                        $mfp->delete();
                    }
                    $sum = $sum+1;
                }
            }

            if ($sum==1) {
                $success = true;
                $msg = "Data removed";
            } else if ($sum>1) {
                $success = true;
                $msg = "Datas removed";
            } else {
                $success = false;
                $msg = "No Data Provided";
            }
        }catch(\Exception $e){
            $success = false;
            $msg = "Error while removing data";
        }

        return response()->json(['success' => $success, 'msg' => $msg]);
    }
}
