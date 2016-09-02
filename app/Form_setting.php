<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_setting extends Model
{
	protected  $table = "form_setting";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'html_tag',        
    ];

    /**
     * Get the question record associated with the setting.
     */
    public function question()
    {
        return $this->hasMany('App\Form_question', 'answer_type');
    }
}
