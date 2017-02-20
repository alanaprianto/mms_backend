<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Regnum;
use App\Product;
use App\Category;
use App\Form_question;
use App\Form_result;
use App\Gallery;
use App\User;
use App\Slider;
use \Illuminate\Pagination\Paginator;

class APIController extends Controller
{   
    public function check_rn($rn)
    {
    	$regnum = Regnum::where('regnum', '=', $rn)->first();

    	if (!$regnum||$regnum->regnum=='requested'||$regnum->regnum=='cancelled') {
    		return response()->json(['validity' => false, 'rn' => $rn]);
    	}

    	return response()->json(['validity' => true, 'rn' => $rn]);
    }

    public function get_category($id)
    {
        $cat = Category::where('parent_id', '=', $id)->get();

        return $cat;
    }

    public function list_category()
    {
        $cat = Category::get();

        return $cat;
    }
    
    public function marketplace_list(Request $request)
    {
    	$catid = $request['category'];    	
        $sperusahaan = $request['sperusahaan'];
        $sproduk = $request['sproduk'];
        $crtby = $request['created_by'];
    	$order = $request['order']; // created_at atau updated_at
    	$sort = $request['sort'];
    	$offset = $request['offset']+1;
    	$limit = $request['limit'];
        
    	$category = Category::find($catid);
  		$cat = $category->id;
        $ccat = Category::where('parent_id', '=', $cat)->pluck('id');

    	Paginator::currentPageResolver(function() use ($offset) {
		    return $offset;
		});

    	$fqid = Form_question::whereIn('question', ['Nama Perusahaan', 'Nama Asosiasi/Himpunan'])->pluck('id');    	
    	$perusahaan = Form_result::whereIn('id_question', $fqid);
    	$perusahaan = $perusahaan->where('answer_value', 'like', '%'.$sperusahaan.'%')
    					->pluck('id_user');

    	$product = Product::where('title', 'like', '%'.$sproduk.'%')->whereIn('category_id', $ccat);
        
        if ($crtby) {
            // ada created by
            $product = $product->where('created_by', $crtby);
        }

    	if (!$perusahaan->isEmpty()) {
	    	// ada perusahaan	    	
    		$product = $product->whereIn('created_by', $perusahaan);
    	}

        $slider = Slider::get();

    	$product = $product->orderBy($order, $sort)->paginate($limit);    	
    	return response()->json(['datas' => $product, 'slider' => $slider]);
    }

    public function marketplace_detail(Request $request)
    {
        $product_id = $request['product_id'];

        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id', '=', $product->id)->get();
        $owner = User::find($product->created_by);

        return response()->json(['product' => $product, 'gallery' => $gallery, 'owner' => $owner]);
    }
}
