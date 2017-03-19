<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Mfront extends Model
{
    protected  $table = "mfrontend";

    protected $fillable = [
        'type', 'cat_id', 'name', 'position', 'description'
    ];

    protected $appends = ['cat_name'];

    public function getCatNameAttribute()
    {
        $id = $this->attributes['cat_id'];

        $request = ['cat_id' => $id];
        $validator = Validator::make($request, [
            'cat_id' => 'required|integer',
        ]);

        if ($validator->passes()) {
            $name = Category::find($id);
            if ($name) {
                return $name->title;
            } else {
                return '-';
            }
        } else {
            return '-';
        }
    }
}
