<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{{ asset('resources/css/mail.css') }}" rel="stylesheet" / >
<div class="container">
<div class="row">
	<!-- BEGIN INBOX -->
	<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3">
						<h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>

						<hr>

						<div>
							<ul class="nav nav-pills nav-stacked">
								<li class="header">Folders</li>
								<li class="active"><a href="{{ URL::to('/') }}"><i class="fa fa-inbox"></i> Inbox ({{$mails->total()}})</a></li>
								<li class=""><a href="{{ URL::to('/activities') }}"><i class="fa fa-history" aria-hidden="true"></i> User Activity </a></li>

							</ul>
						</div>
					</div>
					<!-- END INBOX MENU -->

					<!-- BEGIN INBOX CONTENT -->
					<div class="col-md-9">
						<div class="row">
							<div class="col-sm-6">
								<label style="margin-right: 8px;" class="">
									<div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" id="check-all" class="icheck" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
								</label>

								<button id="mail_sync"><i style="display:none" class="fa fa-circle-o-notch fa-spin"></i> <span>Sync Mail</span></button>

							</div>

							<div class="col-md-6 search-form">
								<form action="#" class="text-right">
									<div class="input-group">
										<input type="text" class="form-control input-sm" name="s" placeholder="Search" value="{{ app('request')->input('s') }}">
										<span class="input-group-btn">
                    <button type="submit" name="" class="btn_ btn-primary btn-sm search"><i class="fa fa-search"></i></button></span>
									</div>
								</form>
							</div>
						</div>

						<div class="padding"></div>

						<div class="table-responsive">
							<table class="table" style="font-size:13px !important">


								<tbody>

									@if(!empty($mails) && $mails->count())
					@foreach($mails as $key => $mail)
					<tr>
							<td class="action"><a class="mailDelete" data-id={{$mail->id}} href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
							<td class="name"><a href="#">{{$mail->from_email}}</a></td>
							<td class="subject"><a href="#">{{$mail->subject}}</a></td>
							<td class="time">{{$mail->mail_received_at}}</td>
				</tr>
					@endforeach
			@else
					<tr>
							<td colspan="4">There are no mails for now.</td>
					</tr>
			@endif

							</tbody></table>
						</div>

						<ul class="pagination">
							{!! $mails->links() !!}
						</ul>
					</div>
					<!-- END INBOX CONTENT -->


				</div>
			</div>
		</div>
	</div>
	<!-- END INBOX -->
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    // global app configuration object
    var config = {
        routes: {
            syncMail: "{{ URL::to('syncMails') }}",
						deleteMail: "{{ URL::to('mail/delete') }}",

        },
				usertype:"{{config('config.usertype.user')}}",
				system:"{{config('config.usertype.system')}}",
				token: "{{ csrf_token() }}",
    };
</script>
<script src="{{ asset('resources/js/mail.js') }}"></script>
