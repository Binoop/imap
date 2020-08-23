<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cache;

class Action extends Model
{
    //

    // Cache the contacts and return the value
    public static function actions($key){

      $actions = Cache::get('actions',[]);

      if(empty($actions)){
        $actionValue = self::all();
        foreach($actionValue as $values){
          $actions[$values->action] = $values->id;
        }
        Cache::set('actions',$actions);
      }
      return $actions[$key];
    }
}
