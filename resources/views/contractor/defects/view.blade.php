@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
@stop
@section('content')
<div class="container">
	<div class="row">
        <div class="panel panel-default panel-body" style="margin-top:-1.25em;">
            <div class="col-md-12" style="margin-top:-1em;">
                <h3 class="text-center"><b>View Defect All<i class="mdi mdi-book" aria-hidden="true"></i></b></h3>
                <h6 class="text-center"><b>Select group of view defect</b></h6>
                <h6 class="text-center"><i>(Count of group: <span id="count-tablet">{{$countGroup}}</span>)</i></h6>
            </div>
        </div>
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.30em;">
			<table id="tableDefect" class="table table-hover">
				<thead>
					<tr class="width-100">
                        <th class="text-center align-middle width-20 is-hidden-mobile">
                            <span class="is-hidden-mobile"><b>Project Manager</b></span>
                        </th>
                        <th class="text-center align-middle">
							<span class="is-hidden-mobile"><b>Group</b></span>
							<span class="is-hidden-tablet" style="font-size:0.5em;"><b>Group</b></span>
                        </th>
                        <th class="text-center align-middle width-10 is-hidden-mobile">
							<b>Count User</b>
                        </th>
                        <th class="text-center align-middle width-15">
                            <span class="is-hidden-mobile"><b>View Defect</b></span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;"><b>View Defect</b></span>
                        </th>
					</tr>
				</thead>
				<tbody>
						@for($item=0;$item<$countGroup;$item++)
                        <?php
                            $groupID=$checkGroup[$item];
                            if(isset($dataVPG[$groupID])){
                                $countDataVPG=count($dataVPG[$groupID]);
                            }else{
                                $countDataVPG=0;
                            }
                            if(empty($dataCountVPG[$groupID])){
                                $dataCountVPG[$groupID]=0;
                            }
                        ?>
                        <tr id="tr-{{$groupID}}" class="width-100">
                            <td class="text-center align-middle width-20 is-hidden-mobile">
                                <div id="admin-group-tablet-{{$groupID}}" class="width-100">
                                    @if($countDataVPG!=0)
                                      <ul style="list-style:none;padding:0;margin:0;">
                                        @if($countDataVPG>0)
                                        <li style="float:left;">
                                            @if($dataVPG[$groupID][0]['image_name']==null)
                                                <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                            @else
                                                <a href="{{ asset('image/profile256/'.$dataVPG[$groupID][0]['image_name']) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$groupID][0]['image_name']) }}"></a>
                                            @endif
                                            </li>
                                        @endif
                                        @if($countDataVPG>1)
                                        <li style="float:left;">
                                            @if($dataVPG[$groupID][1]['image_name']==null)
                                                <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                            @else
                                                <a href="{{ asset('image/profile256/'.$dataVPG[$groupID][1]['image_name']) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$groupID][1]['image_name']) }}"></a>
                                            @endif
                                            </li>
                                        @endif
                                        @if($countDataVPG>2)
                                        <li style="float:left;">
                                            @if($dataVPG[$groupID][2]['image_name']==null)
                                                <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                            @else
                                                <a href="{{ asset('image/profile256/'.$dataVPG[$groupID][2]['image_name']) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$groupID][2]['image_name']) }}"></a>
                                            @endif
                                            </li>
                                        @endif
                                        @if($countDataVPG>3)
                                            <li style="float:left;color:#e5e5e5;">
                                                <span class="text-center"><h4><b>...</b></h4></span>
                                            </li>
                                        @endif
                                    </ul>
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <span id="name-group-tablet-{{$groupID}}" class="is-hidden-mobile">{{$dataGroups[$groupID]}}</span>
                                <span id="name-group-mobile-{{$groupID}}" class="is-hidden-tablet" style="font-size:0.5em;">{{$dataGroups[$groupID]}}</span>
                            </td>
                            <td class="text-center align-middle width-10 is-hidden-mobile">
                                <span id="count-user-tablet-{{$groupID}}">
                                    {{$dataCountVPG[$groupID]}}
                                </span>
                            </td>
                            <td class="text-center align-middle width-15">
                                <a href="{{ asset('/view-defect/group/'.$groupID)}}"><button class="is-hidden-tablet btn btn-manage"><i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></button><button class="is-hidden-mobile btn btn-manage"><span class="is-hidden-mobile">View</span> <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></button></a>
                            </td>
                        </tr>
                    @endfor
				</tbody>
			</table>
		</div>
	</div>
</div> 
@stop
@section('myJS')
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script type="text/javascript">
	btnClick("{{$layoutLocat}}");
    $(document).ready(function(){
        $('#tableDefect').DataTable();
    });
</script>
@endsection