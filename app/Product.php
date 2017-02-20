<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Category;

class Product extends Model
{
    protected  $table = "product";    

    protected $appends = ['picture_url', 'crt_human', 'category_title'];

    protected $hidden = ['category_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id',
        'category_id',
        'title',
        'description',
        'short_desc',
        'price_min',
        'price_max',
        'created_by'
    ];

    /**
     * Get the category record associated with the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getPictureUrlAttribute() 
    {
        $gid = $this->attributes['gallery_id'];    

        $request = ['gallery_id' => $gid];        

        $validator = Validator::make($request, [
            'gallery_id' => 'integer|required',
        ]);

        $url = "-";
        if ($validator->passes()) {
            $url = url('images/product/thumbnail')."/".$gid;

            return $url;
        }

        return $url;     
    }

    public function getCrtHumanAttribute()
    {
        $crtat = $this->attributes['created_at'];

        return Carbon::createFromFormat('Y-m-d H:i:s', $crtat)->diffForHumans();        
    }

    public function getCategoryTitleAttribute() 
    {
        $cid = $this->attributes['category_id'];    

        $request = ['category_id' => $cid];        

        $validator = Validator::make($request, [
            'category_id' => 'integer|required',            
        ]);

        $title = "-";
        if ($validator->passes()) {
            if ($cid!=0) {
              $title = Category::find($cid)->title;
            }

            return $title;
        }   

        return $title;     
    }
}
