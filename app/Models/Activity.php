<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Action;


class Activity extends Model
{
    //
    protected $table = 'activities';


    // Relations to Action Model
    public function action(){
       return $this->belongsTo(Action::class,'action_id','id');
    }

    // Save Activity Info
    public static function saveActivity($params = []){

        if(!empty($params)){
          return self::insert($params);
        }else {
          return false;
        }
    }

}
