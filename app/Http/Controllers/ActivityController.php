<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity ;

class ActivityController extends Controller
{
    //
    public function index(Request $request){
       $searchKey = $request->input("s","");
       $filter = $request->input("n",15);

       if(empty($searchKey)){
         $activities =  Activity::orderBy("created_at","DESC")->paginate($filter);
       }else{

         $activities = Activity::join('actions','actions.id','=','action_id')
         ->where('actions.action',"LIKE","%$searchKey%")
         ->orwhere("activity","LIKE","%$searchKey%")
         ->orwhere("activity_type","LIKE","%$searchKey%")
         ->orderBy("created_at","DESC")
         ->paginate($filter);
       }

      // Return to View
      return view('components.activity',compact('activities'));
    }
}
