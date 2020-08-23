$(document).ready(function(e){

  var isSystemTrigger = false;
  // Mail Sync Initiation, Every 1 minute
  setTimeout(function(){
    console.log("Sync Initiated")
    isSystemTrigger = true;
    $("#mail_sync").trigger('click');
  }, 60000)


  // Manual mail sync trigger
  $("#mail_sync").click(function(e){

    if(isSystemTrigger){
      type= config.system;
    }else{
      type = config.usertype;
    }
    $.ajax({
      url:config.routes.syncMail,
      data:{"type":type},
      beforeSend:function(){
        $("#mail_sync").find('i').show();
        $("#mail_sync").find('span').html("Syncing Mail");
      },
      type:"GET",
      success:function(){
        window.location.reload();
      },
      error:function(){
        window.location.reload();
      }
    })

  });


  // Delete Email
  $('.mailDelete').click(function(e){

    mailId = $(this).data('id');

    $.ajax({
      url:config.routes.deleteMail,
      data:{"mail_id":mailId,"_token": config.token},
      type:"POST",
      beforeSend:function(){

      },
      statusCode:{
        200:function(){
          alert("Mail has been deleted!");
          window.location.reload();
        },
        400:function(){
          alert("Mail not available in server, resyncing emails")
          $("#mail_sync").trigger('click');
        },
        500:function(){
          alert("Mail not available in server, resyncing emails")
          $("#mail_sync").trigger('click');
        }
      }
    })

  });

});
