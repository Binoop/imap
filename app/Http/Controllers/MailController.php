<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Webklex\IMAP\Facades\Client;

use App\Models\Mail;

use App\Models\Action;

use App\Models\Activity ;


use Response;


class MailController extends Controller
{

 private $client;


  public function __construct(){
    $this->client = Client::account('default');
    $this->client->connect();
  }

   /**
    * Method to sync mails from server
    */
    public function syncMails(Request $request){

      try{

        // TODO : To Handle User Activities
        $userType = $request->input('type',config('config.usertype.system'));

        $action = Action::actions(config('config.action.mail_fetch'));

        $mailArray = [];
        // Get the Mails from all folders
        $mailFolders = $this->client->getFolders();


        $mailsToBeDeleted = [];
        $mailArray = [];
        // Loop through all folders for Messages
        foreach($mailFolders as $folder){
              $mails = $folder->messages()->all()->get();

              // array_push($mailArray,$mails->all());

              foreach($mails as $mailid => $mail){

                $mailsToBeDeleted[] = $mailid;

                $mailArray[] = [
                "mail_id" => $mailid,
                "subject" => $mail->getSubject(),
                "from_email" => $mail->getSender()[0]->mail,
                "name" => $mail->getSender()[0]->mailbox,
                "body_content" => $mail->getTextBody(),
                "original_content" => \json_encode($mail),
                "uid" => $mail->getUid(),
                "mail_received_at" => $mail->getDate()->toDateTimeString()];

            }
          }


          // Delete All the mails, with similart mailId

          $mailStatus = Mail::whereIn("mail_id",$mailsToBeDeleted)->delete();
          // Batch Insert Mail
          $mailInsertStatus = Mail::insert($mailArray);


          $activityInfo = ["action_id" => $action,
          "activity_type"=>$userType,
          'activity' => config('config.message.sync_success'),
          "created_at" => \Carbon\Carbon::now()
          ];

          Activity::saveActivity($activityInfo);


          return Response::json("Mails Synced Successfully",200);

      }catch(\Exception $e ){

        $activityInfo = ["action_id" => $action,
        "activity_type"=>$userType,
        'activity' => config('config.message.sync_failure'),
        "created_at" => \Carbon\Carbon::now()
        ];

        // Save Activity
        Activity::saveActivity($activityInfo);

        return Response::json("Mails Synced Failure",500);

      }


    }

    /**
     * Delete Mail from DB and Server
     */
    public function deleteMail(Request $request){

        $mailId = $request->input('mail_id',"");

        $mail = Mail::find($mailId);
        $userType = $request->input('type',config('config.usertype.user'));
        $action = Action::actions(config('config.action.mail_delete'));

        try{
               $folder = $this->client->getFolder("INBOX");
               $email = $folder->getMessage($mail->uid);

               if(\is_null($email)){
                 throw new \Exception("Message already deleted!", 404);
               }
               // Move the Mail to Trash
               $email->moveToFolder('[Gmail]/Trash');


               // Update activity
               $activityInfo = ["action_id" => $action,
               "activity_type"=>$userType,
               'activity' => config('config.message.delete_success'),
               "created_at" => \Carbon\Carbon::now()
               ];
               // Save Activity
               Activity::saveActivity($activityInfo);

               $mail->delete();

               return Response::json("Mails Deleted Successfully",200);



       }catch(\Exception $ex){

         if($ex->getCode() == 400){
           $message = $ex->getMessage();
           $code = $ex->getCode();
         }{
           $message = config('config.message.delete_failure');
           $code = 500;
         }

         $activityInfo = ["action_id" => $action,
         "activity_type"=>$userType,
         'activity' => config('config.message.delete_failure'),
         "created_at" => \Carbon\Carbon::now()
         ];

         // Save Activity
         Activity::saveActivity($activityInfo);


         return Response::json($message,$code);
       }
}



}
