@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
        <div class="panel panel-default panel-body" style="margin-top:-1.25em;">
            <div class="col-md-12" style="margin-top:-1em;">
				<div class="col-md-2 mt-3">
	                <a onclick="goBack()" href="javascript:void(0)" style="text-decoration:none;"><button class="form-control">Back <i class="mdi mdi-step-backward" aria-hidden="true"></i></button></a>
				</div>
				<div class="col-md-offset-1 col-md-6 text-center align-middle">
					<h3 class="text-center"><b>{{$dataGroup->name}} <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></b></h3>
					@if(isset($dataGroup->remark))
					<h5 class="text-center"><b>Remark:</b> <i>{{$dataGroup->remark}}</i></h5>
					@endif
					<button class="btn-min btn-detail-group align-middle text-center" onclick="infoGroup()" style="color:#24b3c5;">Info Group <i class="mdi mdi-lan" aria-hidden="true"></i></button>
					<h6 class="text-center"><i>(Count of Floor: <span id="count-tablet">{{$countFloor}}</span>)</i></h6>
				</div>
				<div class="col-md-3 mt-4">
				</div>
			</div>
		</div>
	</div>
</div> 
@stop
@section('myJS')
<script type="text/javascript">
	var valueCountDefect="{{$countFloor}}";
	btnClick("{{$layoutLocat}}");
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b259c33ecbafa72"></script>
@endsection