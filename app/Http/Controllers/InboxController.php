<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mail;

use App\Models\Action;

use App\Models\Activity ;

class InboxController extends Controller
{
    //

    public function index(Request $request){
       $searchKey = $request->input("s","");
       $filter = $request->input("n",5);

       if(empty($searchKey)){
         $mails =  Mail::orderBy("mail_received_at","DESC")->paginate($filter);
       }else{

         $mails = Mail::where("subject","LIKE","%$searchKey%")
         ->orwhere("name","LIKE","%$searchKey%")
         ->orwhere("from_email","LIKE","%$searchKey%")
         ->orwhere("body_content","","%$searchKey%")
         ->orderBy("mail_received_at","DESC")
         ->paginate($filter);


        // Handle Search Activity
         $action = Action::actions(config('config.action.search'));
         $activityInfo = ["action_id" => $action,
         "activity_type"=>config('config.usertype.user'),
         'activity' => config('config.message.search')." '".$searchKey."'",
         "created_at" => \Carbon\Carbon::now()
         ];

         Activity::saveActivity($activityInfo);


       }

      // Return to View
      return view('components.mailbox',compact('mails'));
    }

}
