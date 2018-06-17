@extends('layouts.app')
@section('header')
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/imgNotes.css')}}">
@stop
@section('content')
<div class="container">
	<div class="row">
        <div class="panel panel-default panel-body" style="margin-top:-1.25em;">
            <div class="col-md-12" style="margin-top:-1em;">
				<div class="col-md-2 mt-3">
                    <a href="{{asset('/manage-defect/group/'.$id)}}" style="text-decoration:none;"><button class="form-control">Back <i class="mdi mdi-step-backward" aria-hidden="true"></i></button></a>
				</div>
				<div class="col-md-offset-1 col-md-6 text-center align-middle">
					<h3 class="text-center"><b>{{$dataGroup->name}} <i class="mdi mdi-map" aria-hidden="true"></i></b></h3>
					@if(isset($dataGroup->remark))
					<h5 class="text-center"><b>Remark:</b> <i>{{$dataGroup->remark}}</i></h5>
					@endif
					<button class="btn-min btn-detail-group align-middle text-center" onclick="infoGroup()" style="color:#24b3c5;">Info Group <i class="mdi mdi-lan" aria-hidden="true"></i></button>
					<a href="{{asset('/manage-defect/group/'.$id)}}"><button class="btn-min btn-detail-view align-middle text-center">View Manage Defect <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></button></a>
				</div>
				<div class="col-md-3 mt-4"></div>
			</div>
			<div class="col-md-12 mt-2">
                <div class="col-md-offset-1 col-md-2 mt-2">
                    <h5 class="text-box"><b>Floor:</b></h5>
                </div>
                <div class="col-md-6 mt-2">
                    <?php
                        echo '<select id="floor-defect" name="floorDefect" class="form-control">';
                        echo '<option class="text-center" value="-1">Not Floor</option>';
                        for($item=0;$item<count($dataFloor);$item++){
                            echo '<option class="text-center" value="'.$dataFloor[$item]->id.'">';
                            if($dataFloor[$item]->number_class==0){
                                echo "Basement";
                            }else{
                                echo 'Floor: '.$dataFloor[$item]->number_class;
                            }
                            echo '</option>';
                        }
                        echo '</select>';
                    ?>         
                </div>
            </div>
		</div>
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.30em;">
            <div id="map" class="col-md-12" style="display:none;">
                <table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
                    <tr>
                        <td style="padding:10px;">
                            <div align="center">
                                <img id="imageFloor" style="width:100%;height:auto;" />
                            </div>          
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="text-center"><i><b><span id="numberFloor"></span></b><span id="remarkFloor"></span></i></h5>
                        </td>
                    </tr>
                </table>
                <hr>
            </div>
        </div>
	</div>
</div> 
@stop
@section('myJS')
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/lity.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.mousewheel.js')}}"></script>
<script type="text/javascript" src="{{asset('js/hammer.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-hammerjs.js')}}"></script>
<script type="text/javascript" src="{{asset('js/imgViewer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/imgNotes.js')}}"></script>
<script type="text/javascript">
	btnClick("{{$layoutLocat}}");
    var dataFloor=[
        <?php
            $countFloor=count($dataFloor);
            for($item=0;$item<$countFloor;$item++){ 
                echo '['.$dataFloor[$item]->id.',"'.$dataFloor[$item]->image_name.'","'.$dataFloor[$item]->remark.'",'.$dataFloor[$item]->number_class.']';
                if($item<$countFloor-1){
                    echo ",";
                }
            }
        ?>
    ];
    var dataFloorDefect=[
        <?php
            $countDefect=count($dataDefect);
            for($item=0;$item<$countDefect;$item++){
                $defectID=$dataDefect[$item]->id;
                if(isset($dataFloorDefect[$defectID])){
                	$dataFD=$dataFloorDefect[$defectID];
                	$countFD=count($dataFD);
                	$defectName=$dataDefect[$item]->title;
                	for($itemFD=0;$itemFD<$countFD;$itemFD++){
		                echo '['.$dataFD[$itemFD]->image_floor_id.',"'.$defectName.'","'.$dataFD[$itemFD]->longitude.'","'.$dataFD[$itemFD]->latitude.'"]';
		                if($itemFD<$countFD-1){
		                    echo ",";
		                }
                	}
	                if($item<$countDefect-1){
	                    echo ",";
	                }
                }                
            }
        ?>
    ];
	function infoGroup(){
        var textRemark='';
        var textPerson='';
        if("{{$dataGroup->remark}}"){
            textRemark="<h5><b>Remark:</b> {{$dataGroup->remark}}</h5>";
        }
        <?php
        	$countVPG=count($dataVPG);
        	for($item=0;$item<$countVPG;$item++){
                if(isset($dataVPG[$item]->dataUser->image_name)){
                    echo "textPerson=textPerson+'<tr class=".'"'."width-100".'"'."><td class=".'"'."text-center align-middle".'"'."><a href=".'"'.asset("image/profile256").'/'.$dataVPG[$item]->dataUser->image_name.'"'." data-lity><img class=".'"'."img-responsive".'"'." src=".'"'.asset("image/profile50").'/'.$dataVPG[$item]->dataUser->image_name.'"'."></a></td>';";
                }else{
                    echo "textPerson=textPerson+'<tr class=".'"'."width-100".'"'."><td class=".'"'."text-center align-middle".'"'."><a href=".'"'.asset("image/profile256.png").'"'." data-lity><img class=".'"'."img-responsive".'"'." src=".'"'.asset("image/profile50.png").'"'."></a></td>';";
                }
        		echo "textPerson=textPerson+'<td class=".'"'."text-center align-middle".'"'."><b>".$dataVPG[$item]->dataUser->dataPermission->name."</b>: <br class=".'"'."is-hidden-tablet".'"'.">".$dataVPG[$item]->dataUser->email." <a href=".'"'."mailto:".$dataVPG[$item]->dataUser->email.'"'."><i class=".'"'."mdi mdi-email-outline".'"'." aria-hidden=".'"'."true".'"'."></i></a>';";

        		$userID=$dataVPG[$item]->dataUser->id;
                if(isset($dataSocialAuth[$userID])){
                	if(isset($dataSocialAuth[$userID]['facebook'])){
                     echo "textPerson=textPerson+' <a href=".'"'."https://www.facebook.com/profile.php?".$dataSocialAuth[$userID]['facebook'].'"'." target=".'"'."_blank".'"'."><i class=".'"'."mdi mdi-facebook-box".'"'." aria-hidden=".'"'."true".'"'."></i></a>';";
                 	}
	                if(isset($dataSocialAuth[$userID]['google'])){
	                    echo "textPerson=textPerson+' <a href=".'"'."https://plus.google.com/".$dataSocialAuth[$userID]['google'].'"'." target=".'"'."_blank".'"'."><i class=".'"'."mdi mdi-google-plus-box".'"'." aria-hidden=".'"'."true".'"'."></i></a>';";
	                }
                }

                echo "textPerson=textPerson+'</h5><h5><b>Full Name:</b> ".$dataVPG[$item]->dataUser->first_name." ".$dataVPG[$item]->dataUser->last_name."</h5></td><tr>';";
        	}
			$time=strtotime($dataGroup->created_at);
			$newformat=date('d-m-Y H:i:s',$time);
        ?>
        if(textPerson==''){
            textPerson="<tr><td><h5><i>No users</i></h5><td></tr>";
        }
        swal({
	        title:"{{$dataGroup->name}}",
	        html: textRemark+"<b>User In Group</b> <i class='h6'>(Count User:{{$countVPG}})</i><table class='table table-hover'><tbody>"+textPerson+"</tbody></table><i class='text-center h6'><b>Group created at:</b> {{$newformat}}</i>",
	        showCloseButton: true,
	        confirmButtonColor: '#bcb8b9',
	        confirmButtonText: 'Close'
        }).then(function(){},function(dismiss){});
	}
    function getDataFloor(idFloor,local){
        var data=this.dataFloor;
        for(var item=0;item<data.length;item++){
            if(data[item][0]==idFloor){
                return data[item][local];
            }
        }
    }
    function getlLongLatFloor(idFloor){
    	var data=this.dataFloorDefect;
    	var longlat=[];
        for(var item=0;item<data.length;item++){
            if(data[item][0]==idFloor){
				longlat[longlat.length]={x:data[item][2],y:data[item][3],note:data[item][1]};
            }
        }
        return longlat;
    }
    var imgFloor=null;
	$('#floor-defect').change(function(){
        var valueFloor= $('#floor-defect').val();
        if(imgFloor!=null){
        	imgFloor.imgNotes("destroy");
        }
        if (valueFloor!=-1){
            var textRemark=getDataFloor(valueFloor,2);
            var textNumber=getDataFloor(valueFloor,3);
            var longlat=getlLongLatFloor(valueFloor);
            $('#map').css("display",'block');
            var localImage="{{asset('image/floor')}}"+"/"+getDataFloor(valueFloor,1);
		    $('#imageFloor').attr('src',localImage).one("load",function(){
		    	if (longlat.length!=0){
		    		setFloor(longlat);
		    	}else{
		    		imgFloor=null;
		    	}
		    });
            if(textNumber==0){
                textNumber='Basement';
            }else if(textNumber){
                textNumber='Floor '+textNumber;
            }
            if(textRemark){
                textNumber=textNumber+': ';
            }
            $("#numberFloor").text(textNumber);
            $("#remarkFloor").text(textRemark);
        }else{
        	imgFloor=null;
            $('#map').css("display",'none');
        }
    });
    function setFloor(longlat){
		var imgFloor=$("#imageFloor").imgNotes();
		this.imgFloor=imgFloor;
		imgFloor.imgNotes("import",longlat);
		imgFloor.imgNotes("export");
    }
</script>
@endsection