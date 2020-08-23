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
								<li class=""><a href="{{ URL::to('/') }}"><i class="fa fa-inbox"></i> Inbox</a></li>
								<li class="active"><a href="{{ URL::to('/activities') }}"><i class="fa fa-history" aria-hidden="true"></i> User Activity Inbox ({{$activities->total()}})</a></li>


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
							<table class="table" style="font-size:13px !important; font-weight:400 !important;">

								<thead>
									<tr>
											<th>Date</th>
											<th>Action</th>
											<th>Activity Done </th>
											<th>Done By</th>
									</tr>
								</thead>

								<tbody>

									@if(!empty($activities) && $activities->count())
					@foreach($activities as $key => $activity)

					<tr>
							<td>{{ $activity->created_at}}</td>
							<td>{{ $activity->action()->first()->action}}</td>
							<td>{{ $activity->activity}}</td>
							<td>{{ $activity->activity_type}}</td>
				</tr>
					@endforeach
			@else
					<tr>
							<td colspan="4">There are no activities.</td>
					</tr>
			@endif

							</tbody></table>
						</div>

						<ul class="pagination">
							{!! $activities->links() !!}
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

</script>
