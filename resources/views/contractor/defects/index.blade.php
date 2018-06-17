@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/multiple-select.css')}}">
@stop
@section('content')
<div class="container">
	<div class="row">
        <div class="panel panel-default panel-body" style="margin-top:-1.25em;">
            <div class="col-md-12" style="margin-top:-1em;">
				<div class="col-md-2 mt-3">
	                <a href="{{asset('/view-defect')}}" style="text-decoration:none;"><button class="form-control">View <i class="mdi mdi-step-backward" aria-hidden="true"></i></button></a>
				</div>
				<div class="col-md-offset-1 col-md-6 text-center align-middle">
					<h3 class="text-center"><b>{{$dataGroup->name}} <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></b></h3>
					<h4 class="text-center"><b>{{Auth::user()->dataPermission->name}} ({{Auth::user()->dataPermission->remark}})</b></h4>
					@if(isset($dataGroup->remark)&&$dataGroup->remark!='')
						<h5 class="text-center"><b>Remark:</b> <i>{{$dataGroup->remark}}</i></h5>
					@endif
					<button class="btn-min btn-detail-group align-middle text-center" onclick="infoGroup()" style="color:#24b3c5;">Info Group <i class="mdi mdi-lan" aria-hidden="true"></i></button>
					<a href="{{asset('/view-defect/group/'.$id.'/view/floor')}}"><button class="btn-min btn-detail-view align-middle text-center">View Floor Defect <i class="mdi mdi-map" aria-hidden="true"></i></button></a>
					<h6 class="text-center"><i>(Count of defect: <span id="count-tablet">0</span>)</i></h6>
				</div>
				<div class="col-md-3 mt-4">
					<button onclick="getPDF()" class="btn btn-pdf-mobile align-middle text-center form-control mt-4" type="button">PDF<i class="mdi mdi-file-pdf" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.30em;">
			<table id="dataDefects" class="display table table-hover" cellspacing="0" width="100%">
				<thead>
					<tr class="width-100">
						<th class="text-center align-middle width-10">
							<span class="is-hidden-mobile">Deadline</span>
							<span class="is-hidden-tablet" style="font-size:0.5em;">Deadline</span>
						</th>
						<th class="text-center align-middle">
							<span class="is-hidden-mobile">Title</span>
							<span class="is-hidden-tablet" style="font-size:0.5em;">Title</span>
						</th>
						<th class="is-hidden-mobile text-center align-middle width-10">
							Status
						</th>
						<th class="text-center align-middle width-5">
							<span class="is-hidden-mobile">Info</span>
							<span class="is-hidden-tablet" style="font-size:0.5em;">Info</span>
						</th>
                        <th class="text-center align-middle width-10">
                            <span class="is-hidden-mobile">Start Time</span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;">Start Time</span>
                        </th>
                        <th class="text-center align-middle width-15">
                            <span class="is-hidden-mobile">Update Defect</span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;">Update Defect</span>
                        </th>
					</tr>
				</thead>
				<tbody id="tableDefect">
					<?php
						$countDefect=0;
					?>
					@for($item=0;$item<count($dataDefect);$item++)
						@if(isset($dataVPD[$dataDefect[$item]->id]))
							<?php
								if($dataDefect[$item]->status_id==50){
									$backgroundColorStatus='#c32e2e;';
								}else if($dataDefect[$item]->status_id==40){
									$backgroundColorStatus='#ec5f2f;';
								}else if($dataDefect[$item]->status_id==30){
									$backgroundColorStatus='#d89421;';
								}else if($dataDefect[$item]->status_id==20){
									$backgroundColorStatus='#706f6e;';
								}else{
									$backgroundColorStatus='#000000;';
								}
								$defectID=$dataDefect[$item]->id;
								$countDefect++;
							?>
							<tr id="trDefect{{$defectID}}" class="width-100">
								<td class="text-center align-middle width-10">
									<span id="deadline{{$defectID}}" class="is-hidden-mobile"><b id="deadlineCD{{$defectID}}" style="font-size:1.2em;"></b><b id="deadlineTD{{$defectID}}"></b><br><i class="h6" id="deadlineNF{{$defectID}}"></i></span>
									<span id="deadlineM{{$defectID}}" class="is-hidden-tablet" style="font-size:0.5em;"><b id="deadlineMCD{{$defectID}}"></b><br><b id="deadlineMTD{{$defectID}}"></b></span>
								</td>
								<td class="text-center align-middle">
									<a style="text-decoration:none;" href="{{asset('/defect/'.$defectID)}}" target="_blank">
										<span class="is-hidden-mobile">{{$dataDefect[$item]->title}}</span>
										<span class="is-hidden-tablet" style="font-size:0.5em;">{{$dataDefect[$item]->title}}</span><i class="mdi mdi-open-in-new" aria-hidden="true"></i>
									</a>
								</td>
								<td class="is-hidden-mobile text-center align-middle width-10" style="color:{{$backgroundColorStatus}};">
									<b>{{$dataDefect[$item]->dataStatus->name}}</b> <span class="is-hidden-touch h6"><br><i>{{$dataDefect[$item]->dataStatus->remark}}</i></span>
								</td>
								<td class="text-center align-middle width-5">
									<a onclick="infoDefect({{$defectID}})"><button class="is-hidden-tablet btn-min btn-info-mobile"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button><button class="is-hidden-mobile btn btn-info form-control"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button></a>
								</td>
								@if(isset($dataDefect[$item]->start_time))
									<td class="text-center align-middle width-10">
		                                <div id="ST{{$defectID}}" class="is-hidden-mobile dropdown text-center">
		                                	{{$dataDefect[$item]->start_time}}
		                                </div>
		                                <div id="mST{{$defectID}}" class="is-hidden-tablet dropdown text-center">
		                                	{{$dataDefect[$item]->start_time}}
		                                </div>
									</td>
								@else
									<td class="text-center align-middle width-10">
		                                <div id="ST{{$defectID}}" class="is-hidden-mobile dropdown text-center">
		                                    <button class="btn btn-manage form-control" onclick="sendTime({{$defectID}})"><i aria-hidden="true" class="mdi mdi-cube-send"></i> Send</button>
		                                </div>
		                                <div id="mST{{$defectID}}" class="is-hidden-tablet dropdown text-center">
		                                    <button class="btn-min btn-manage width-100" onclick="sendTime({{$defectID}})"><i aria-hidden="true" class="mdi mdi-cube-send" style="font-size:0.5em;"></i> <span style="font-size:0.5em;">Send</span></button>
		                                </div>
									</td>
								@endif
								<td class="text-center align-middle width-15">
	                                <div class="is-hidden-mobile dropdown">
	                                    <button class="btn btn-manage form-control" onclick="updateDefect({{$defectID}})"><i aria-hidden="true" class="mdi mdi-apple-keyboard-caps"></i> Update</button>
	                                </div>
	                                <div class="is-hidden-tablet dropdown">
	                                    <button class="btn-min btn-manage width-100" onclick="updateDefect({{$defectID}})"><i aria-hidden="true" class="mdi mdi-apple-keyboard-caps" style="font-size:0.5em;"></i> <span style="font-size:0.5em;">Update</span></button>
	                                </div>
	                            </td>
							</tr>
						@endif
					@endfor
				</tbody>
			</table>
		</div>
	</div>
</div> 
@stop
@section('myJS')
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/multiple-select.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script type="text/javascript">
	var valueCountDefect="{{$countDefect}}";
	$("#count-tablet").text(valueCountDefect);
	btnClick("{{$layoutLocat}}");
	$(document).ready(function(){
		$('#dataDefects').DataTable();
	});
	<?php	
		echo 'var dataDefect =[';
		for($item=0;$item<count($dataDefect);$item++){
			$defectID=$dataDefect[$item]->id;
			if(isset($dataVPD[$defectID])){
				echo '['.$defectID.','.$dataDefect[$item]->status_id.',"'.$dataDefect[$item]->title.'",';
				if(isset($dataDefect[$item]->detail)){
					echo '"'.$dataDefect[$item]->detail.'",';
				}else{
					echo 'null,';
				}
				if(isset($dataVPD[$defectID])){
					echo $dataVPD[$defectID].',"';
				}else{
					echo 'null,"';
				}
				echo $dataDefect[$item]->deadline.'",null,null,null,"';
				if(isset($dataDefect[$item]->created_at)){
					$time=strtotime($dataDefect[$item]->created_at);
					$newformat=date('d-m-Y H:i:s',$time);
					echo $newformat.'","'.$dataDefect[$item]->dataUserCreated->first_name.'","'.$dataDefect[$item]->dataUserCreated->last_name.'","'.$dataDefect[$item]->dataUserCreated->email.'",'.$dataDefect[$item]->dataUserCreated->dataPermission->id.',"';
				}else{
					echo '",null,null,null,null,"';
				}
				if(isset($dataDefect[$item]->info_user_updated_id)){
					$time=strtotime($dataDefect[$item]->dataInfoUserUpdated->updated_at);
					$newformat=date('d-m-Y H:i:s',$time);
					echo $newformat.'","'.$dataDefect[$item]->dataInfoUserUpdated->dataUser->first_name.'","'.$dataDefect[$item]->dataInfoUserUpdated->dataUser->last_name.'","'.$dataDefect[$item]->dataInfoUserUpdated->dataUser->email.'",'.$dataDefect[$item]->dataInfoUserUpdated->dataUser->dataPermission->id.',"';
				}else{
					echo '",null,null,null,null,"';
				}
				if(isset($dataDefect[$item]->approved_at)){
					$time=strtotime($dataDefect[$item]->approved_at);
					$newformat=date('d-m-Y H:i:s',$time);
					echo $newformat.'","'.$dataDefect[$item]->dataUserApproved->first_name.'","'.$dataDefect[$item]->dataUserApproved->last_name.'","'.$dataDefect[$item]->dataUserApproved->email.'",'.$dataDefect[$item]->dataUserApproved->dataPermission->id.'';
				}else{
					echo '",null,null,null,null';
				}
				echo ']';
				if($item<count($dataDefect)-1){
					echo ",";
				}
			}
		}
		echo '];';
		$countImage=count($dataImageDefect);
		echo 'var dataImageDefect=[';
		for($item=0;$item<$countImage;$item++){
			if(isset($dataVPD[$dataImageDefect[$item]->defect_id])){
				echo '['.$dataImageDefect[$item]->defect_id.',"'.$dataImageDefect[$item]->image_name.'"]';
				if($item<$countImage-1){
					echo ",";
				}
			}
		}
		echo '];';
		echo 'var dataStatus=[';
		for($item=0;$item<count($dataStatus);$item++){
			echo '['.$dataStatus[$item]->id.',"'.$dataStatus[$item]->name.'","'.$dataStatus[$item]->remark.'"]';
			if($item<count($dataStatus)-1){
				echo ",";
			}
		}
		echo '];';
		echo 'var dataPermission =[';
		for($item=0;$item<count($dataPermission);$item++){
			echo '['.$dataPermission[$item]->id.',"'.$dataPermission[$item]->name.'","'.$dataPermission[$item]->remark.'"]';
			if($item<count($dataPermission)-1){
				echo ",";
			}
		}
		echo '];';
	?>
	setArrayTime();
    function setArrayTime(){
    	var valEndTime=moment('{{date("d-m-Y")}}',"DD-MM-YYYY");
    	for(var item=0;item<this.dataDefect.length;item++){
    		var defectID=this.dataDefect[item][0];
    		var valStartTime = moment(this.dataDefect[item][5],"YYYY-MM-DD");
    		var valStartTimeNew=moment(valStartTime).format('DD-MM-YYYY');
    		var sumTime=valStartTime.diff(valEndTime,'days');
    		if(this.dataDefect[item][5]){
    			this.dataDefect[item][5]=valStartTimeNew;
    			$("#deadlineNF"+defectID).text(valStartTimeNew);
    		}
    		if(sumTime){
    			if(sumTime<=3&&sumTime>0){
					this.dataDefect[item][8]='#fb4904';
    			}else if(sumTime<=7&&sumTime>3){
    				this.dataDefect[item][8]='#E59E2E';
    			}else if(sumTime>7){
    				this.dataDefect[item][8]='#5C737B';
    			}else{
    				this.dataDefect[item][8]='#d61c20';
    			}
    			if(sumTime<=0){
					this.dataDefect[item][6]='Time Out';
					this.dataDefect[item][7]='';
					$("#deadlineCD"+defectID).text('Time Out');
					$("#deadlineMCD"+defectID).text('Time Out');
    			}else if(sumTime>0){
					this.dataDefect[item][6]=sumTime;
					this.dataDefect[item][7]='Day left';
					$("#deadlineTD"+defectID).text('Day left');
					$("#deadlineMTD"+defectID).text('Day left');
					$("#deadlineCD"+defectID).text(sumTime);
					$("#deadlineMCD"+defectID).text(sumTime);
    			}
    			$("#deadline"+defectID).css("color",this.dataDefect[item][8]);
    			$("#deadlineM"+defectID).css("color",this.dataDefect[item][8]);
    		}else{
				this.dataDefect[item][6]='-';
				this.dataDefect[item][7]='';
				this.dataDefect[item][8]='';
				$("#deadlineCD"+defectID).text('-');
				$("#deadlineMCD"+defectID).text('-');
    		}
    	}
    }
	function getDefect(idDefect,localDefect){
		var dataDefect=this.dataDefect;
		for(var item=0;item<dataDefect.length;item++){
			if(dataDefect[item][0]==idDefect){
				return dataDefect[item][localDefect];
			}
		}
	}
	function getDefectImage(idDefect){
		var dataImageDefect=this.dataImageDefect;
		var dataNameImage=[];
		var countImage=0;
		for(var item=0;item<dataImageDefect.length;item++){
			if(dataImageDefect[item][0]==idDefect){
				dataNameImage[countImage]=dataImageDefect[item][1];
				countImage=countImage+1;
			}
		}
		return dataNameImage;
	}
	function getStatus(idStatus,localStatus){
		var dataStatus=this.dataStatus;
		for(var item=0;item<dataStatus.length;item++){
			if(dataStatus[item][0]==idStatus){
				return dataStatus[item][localStatus];
			}
		}
	}
	function getPermission(idPermission,localPermission){
		var dataPermission=this.dataPermission;
		for(var item=0;item<dataPermission.length;item++){
			if(dataPermission[item][0]==idPermission){
				return dataPermission[item][localPermission];
			}
		}
	}
	function sendTime(defectID){
		var idStatus=this.getDefect(defectID,1);
		var textDetail='';
		var valueDetail=this.getDefect(defectID,3);
		var valueDeadline=this.getDefect(defectID,5);
		var textDeadline='';
		if(valueDeadline){
			textDeadline='<h4>'+this.getDefect(defectID,6)+' '+this.getDefect(defectID,7)+'</h4><h5><b>Deadline:</b> '+valueDeadline+'</h5>';
		}
		if(valueDetail){
			textDetail='<h5><i>'+valueDetail+'</i></h5>';
		}
        swal({
	        title:'Start Time <i class="mdi mdi-cube-send" aria-hidden="true"></i>',
	        html:'<h4><b>'+this.getDefect(defectID,2)+'</b></h4>'+textDetail+'<h5><b>Group:</b> {{$dataGroup->name}}</h5><h5><b>Status: </b>'+this.getStatus(idStatus,1)+' <i>('+this.getStatus(idStatus,2)+')</i></h5>'+textDeadline+'<div class="col-md-12"><div class="col-md-2"></div><div class="col-md-8"><input type="date" id="dateStart" class="form-control text-center" value="{{date("Y-m-d")}}"></div><div class="col-md-2"></div></div>',
			showCloseButton: true,
			showCancelButton: true,
			confirmButtonColor: '#3286b7',
			cancelButtonColor: '#cf5e51',
			confirmButtonText:
			    'Send! <i class="mdi mdi-send" aria-hidden="true"></i>',
			cancelButtonText:
			    'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var dateStart=$("#dateStart").val();
            $.ajax({
                url: "{{asset('/view-defect/group/'.$id.'/start/')}}",
                type: 'POST',
                data: {_token: CSRF_TOKEN,dateStart:dateStart,defectID:defectID},
                dataType: 'JSON',
                success:function(data){
                	var defectID=data['defectID'];
					var idStatus=getDefect(defectID,1);
					var textDetail='';
					var valueDetail=getDefect(defectID,3);
					var valueDeadline=getDefect(defectID,5);
					var textDeadline='';
					var dataTime=data['valueID'];
					if(valueDeadline){
						textDeadline='<h4>'+getDefect(defectID,6)+' '+getDefect(defectID,7)+'</h4><h5><b>Deadline:</b> '+valueDeadline+'</h5>';
					}
					if(valueDetail){
						textDetail='<h5><i>'+valueDetail+'</i></h5>';
					}
                	var textStart='<h4><b>'+getDefect(defectID,2)+'</b></h4>'+textDetail+'<h5><b>Group:</b> {{$dataGroup->name}}</h5><h5><b>Status: </b>'+getStatus(idStatus,1)+' <i>('+getStatus(idStatus,2)+')</i></h5>'+textDeadline;
                	var typeStart='';
                	if(data['isTime']==true){
						var textTime=dataTime[8]+dataTime[9]+'-'+dataTime[5]+dataTime[6]+'-'+dataTime[0]+dataTime[1]+dataTime[2]+dataTime[3];
						textStart=textStart+'<h5><b>Start Time Defect:</b> '+textTime+'</h5>';
						typeStart='success';
						$("div#ST"+defectID).html(textTime);
						$("div#mST"+defectID).html(textTime);
                	}else if(data['isTime']==false){
                		textStart=textStart+'<h5><b>Have Start Time in Server!!</b></h5>';
                		typeStart='error';
                	}else{
                		textStart=textStart+'<h5><b>Not Value Start Time or Input Start Time not Format!!</b> ('+dataTime+')</h5>';
                		typeStart='error';
                	}
                    swal({
                        title:'Save Start Time!',
                        type:typeStart,
                        html:textStart,
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                },error:function(data){ 
                    swal({
                        title:'Delete Defect!',
                        type:'error',
                        html:'Can Not Delete Defect in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
        },function(dismiss){});
	}
	function infoDefect(defectID){
		var idStatus=this.getDefect(defectID,1);
		var idPT=this.getDefect(defectID,4);
		var valueDeadline=this.getDefect(defectID,5);
		var dataImage=this.getDefectImage(defectID);
		var dateCreated=this.getDefect(defectID,9);
		var firstNameCreated=this.getDefect(defectID,10);
		var lastNameCreated=this.getDefect(defectID,11);
		var emailCreated=this.getDefect(defectID,12);
		var htmlImage='';
		var textDeadline='';
		var textDetail='';
		var textInfoCreated='';
		var valueDetail=this.getDefect(defectID,3);
		if(valueDeadline){
			textDeadline='<h4>'+this.getDefect(defectID,6)+' '+this.getDefect(defectID,7)+'</h4><h5><b>Deadline:</b> '+valueDeadline+'</h5>';
		}
		if(valueDetail){
			textDetail='<h5><i>'+valueDetail+'</i></h5>';
		}
		if(emailCreated){
			textInfoCreated='<h5><b>Created By: </b>'+firstNameCreated+' '+lastNameCreated+' <i>(<a href="mailto:'+emailCreated+'">'+emailCreated+'</a>)</i></h5><h5><b>Created Date: </b>'+dateCreated+'</h5>';
		}else{
			textInfoCreated='This user has been deleted!';
		}
		if(dataImage){
			for(var item=0;item<dataImage.length;item++){
				if(dataImage[item]){
					htmlImage=htmlImage+'<a href="{{asset("/image/defects/")}}/'+dataImage[item]+'" data-lity><img src="{{asset("/image/defects/")}}/'+dataImage[item]+'" style="width:50%;height:auto;margin-top:1em;"></a><br>'
				}
			}
		}
        swal({
	        title: 'Info Defect <i class="mdi mdi-information-outline" aria-hidden="true"></i>',
	        html: '<h4><b>'+this.getDefect(defectID,2)+'</b></h4>'+textDetail+'<h5><b>Group:</b> {{$dataGroup->name}}</h5><h5><b>People Involved: </b>'+this.getPermission(idPT,1)+' <i>('+getPermission(idPT,2)+')</i></h5>'+textDeadline+'<h5><b>Status: </b>'+this.getStatus(idStatus,1)+' <i>('+this.getStatus(idStatus,2)+')</i></h5>'+htmlImage+textInfoCreated,
	        showCancelButton: true,
	        showConfirmButton: false,
	        cancelButtonText:
	            'Close'
        }).then(function(){},function(dismiss){});
	}
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
	function updateDefect(defectID){
		var idStatus=this.getDefect(defectID,1);
		var valueDeadline=this.getDefect(defectID,5);
		var dataImage=this.getDefectImage(defectID);
		var dateCreated=this.getDefect(defectID,9);
		var firstNameCreated=this.getDefect(defectID,10);
		var lastNameCreated=this.getDefect(defectID,11);
		var emailCreated=this.getDefect(defectID,12);
		var htmlImage='';
		var textDeadline='';
		var textDetail='';
		var textInfoCreated='';
		var valueDetail=this.getDefect(defectID,3);
		if(valueDeadline){
			textDeadline='<h4>'+this.getDefect(defectID,6)+' '+this.getDefect(defectID,7)+'</h4><h5><b>Deadline:</b> '+valueDeadline+'</h5>';
		}
		if(valueDetail){
			textDetail='<h5><i>'+valueDetail+'</i></h5>';
		}
		if(emailCreated){
			textInfoCreated='<h5><b>Created By: </b>'+firstNameCreated+' '+lastNameCreated+' <i>(<a href="mailto:'+emailCreated+'">'+emailCreated+'</a>)</i></h5><h5><b>Created Date: </b>'+dateCreated+'</h5>';
		}else{
			textInfoCreated='This user has been deleted!';
		}
		if(dataImage){
			for(var item=0;item<dataImage.length;item++){
				if(dataImage[item]){
					htmlImage=htmlImage+'<a href="{{asset("/image/defects/")}}/'+dataImage[item]+'" data-lity><img src="{{asset("/image/defects/")}}/'+dataImage[item]+'" style="width:50%;height:auto;margin-top:1em;"></a><br>'
				}
			}
		}
		swal({
		    title:"Update Defect",
		    html: '<form id="formUpdateDefect"><h4><b>'+this.getDefect(defectID,2)+'</b></h4>'+textDetail+'<h5><b>Group:</b> {{$dataGroup->name}}</h5><h5 class="text-center">{{Auth::user()->dataPermission->name}} ({{Auth::user()->dataPermission->remark}})</h5>'+textDeadline+'<h5><b>Status: </b>'+this.getStatus(idStatus,1)+' <i>('+this.getStatus(idStatus,2)+')</i></h5>'+htmlImage+textInfoCreated+'<hr><h4 class="text-center"><b>Update Defects</b></h4><div class="col-md-12 text-left"><h5><b>Comment:</b></h5><textarea class="form-control" name="comment"></textarea></div><div class="col-md-12 mt-2"><input type="file" class="form-control mt-1" name="fileUploadDefect1" id="fileUploadDefect1"></div><div class="col-md-12"><input type="file" class="form-control mt-1" name="fileUploadDefect2" id="fileUploadDefect2"></div><div class="col-md-12"><input type="file" class="form-control mt-1" name="fileUploadDefect3" id="fileUploadDefect3"></div><div class="col-md-12"><input type="file" class="form-control mt-1" name="fileUploadDefect4" id="fileUploadDefect4"></div><div class="col-md-12"><input type="file" class="form-control mt-1" name="fileUploadDefect5" id="fileUploadDefect5"></div><ul class="col-md-12 text-center" style="float:left;display:inline;list-style-type:none;"><li id="create-list-defect1" class="text-center" style="display:inline;"></li><li id="create-list-defect2" class="text-center" style="display:inline;"></li><li id="create-list-defect3" class="text-center" style="display:inline;"></li><li id="create-list-defect4" class="text-center" style="display:inline;"></li><li id="create-list-defect5" class="text-center" style="display:inline;"></li></ul><input type="hidden" name="_token" value="{{csrf_token()}}"></form>',
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:'Update Defect! <i class="mdi mdi-cube-send" aria-hidden="true"></i>',
        	confirmButtonColor:'#3286b7',
			cancelButtonText:'Close',
			cancelButtonColor: '#bcb8b9'
		}).then(function(){
            var form = $('#formUpdateDefect')[0];
            var formData = new FormData(form);
            $.ajax({
                type:'POST',
                url: '{{asset("/view-defect/group/".$id."/defect/")}}'+'/'+defectID+'/update',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                	console.log(data.idGroup);
                	console.log(data.isCDC);
                	console.log(data.idDefect);
                	console.log(data.isImage1);
                	console.log(data.isImage2);
                	console.log(data.isImage3);
                	console.log(data.isImage4);
                	console.log(data.isImage5);
                	console.log(data.isUpdate);
                	console.log(data.dataComment);
                },error: function(data){
                    swal({
                        title:'Update Defect!',
                        type:'error',
                        html:'Can Not Update Defect in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
		},function(dismiss){});
	    $('#fileUploadDefect1').change(function(){
	        if (this.files && this.files[0]) {
	            var filename = this.files[0].name;
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                setListImage('create-list-defect1',e.target.result,'fileUploadDefect1',1);
	            }
	            reader.readAsDataURL(this.files[0]);
	        }else{
	            setListImage('create-list-defect1',null,'fileUploadDefect1',0);
	        }
	    }); 
	    $('#fileUploadDefect2').change(function () {
	        if (this.files && this.files[0]) {
	            var filename = this.files[0].name;
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                setListImage('create-list-defect2',e.target.result,'fileUploadDefect2',1);
	            }
	            reader.readAsDataURL(this.files[0]);
	        }else{
	            setListImage('create-list-defect2',null,'fileUploadDefect2',0);
	        }
	    }); 
	    $('#fileUploadDefect3').change(function(){
	        if (this.files && this.files[0]) {
	            var filename = this.files[0].name;
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                setListImage('create-list-defect3',e.target.result,'fileUploadDefect3',1);
	            }
	            reader.readAsDataURL(this.files[0]);
	        }else{
	            setListImage('create-list-defect3',null,'fileUploadDefect3',0);
	        }
	    }); 
	    $('#fileUploadDefect4').change(function () {
	        if (this.files && this.files[0]) {
	            var filename = this.files[0].name;
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                setListImage('create-list-defect4',e.target.result,'fileUploadDefect4',1);
	            }
	            reader.readAsDataURL(this.files[0]);
	        }else{
	            setListImage('create-list-defect4',null,'fileUploadDefect4',0);
	        }
	    }); 
	    $('#fileUploadDefect5').change(function () {
	        if (this.files && this.files[0]) {
	            var filename = this.files[0].name;
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                setListImage('create-list-defect5',e.target.result,'fileUploadDefect5',1);
	            }
	            reader.readAsDataURL(this.files[0]);
	        }else{
	            setListImage('create-list-defect5',null,'fileUploadDefect5',0);
	        }
	    });
	}
    function setListImage(localtionList,localtionIamge,idFileDefect,actionImage){
        if(actionImage==1){
            var nameImage = $('#'+idFileDefect).val().split('\\').pop();
            $('#'+localtionList).html('<a href="'+localtionIamge+'" data-lity><img src="'+localtionIamge+'" style="width:20%;height:auto;margin-top:1em;"></a> <span style="font-size:0.75em;">'+nameImage+'</span> <a href="#" style="color:#e57373;" onclick="setListImage('+"'"+localtionList+"',null,'"+idFileDefect+"',0"+')"><i class="mdi mdi-close" aria-hidden="true"></i></a><br>');
        }else if(actionImage==0){
            $('#'+localtionList).html('');
            $('#'+idFileDefect).val(null);
        }
    }
	function getPDF(){
		var arrayStatus='<select id="idFormStatus" name="idFormStatus[]" style="width:80%;" multiple="multiple" class="h5 text-left">';
		for (var item=0;item<this.dataStatus.length;item++){
			arrayStatus=arrayStatus+'<option class="h5 text-left" value="'+this.dataStatus[item][0]+'">'+this.dataStatus[item][1]+' ('+this.dataStatus[item][2]+')</option>';
		}
		arrayStatus=arrayStatus+'</select>';
		swal({
		    title:"Print Report",
		    html: '<form id="formReportPDF" action="{{asset("/view-defect/group/".$id."/report/")}}" method="post" target="_blank"><h4 class="text-center"><b>Time Report</b></h4><table class="width-100"><tbody><tr><td class="width-20 h5"><b>Time In <i class="mdi mdi-clock-in" aria-hidden="true"></i>:</b> </td><td class="width-80"><input name="dateIn" class="form-control h5" type="date" value="{{date("Y-m-d")}}"></td></tr><tr><td class="width-20 h5"><b>Time Out <i class="mdi mdi-clock-out" aria-hidden="true"></i>:</b> </td><td class="width-80"><input name="dateOut" class="form-control h5" type="date" value="{{date("Y-m-d")}}"></td></tr></tbody></table><hr><h4 class="text-center"><b>Option Select Report</b></h4><table class="width-100"><tbody><tr><td class="width-20 h5"><b>Status <i class="mdi mdi-account-star" aria-hidden="true"></i>:</b> </td><td class="width-80">'+arrayStatus+'</td></tr></tbody></table><input type="hidden" name="_token" value="{{csrf_token()}}"></form>',
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText:'Get PDF! <i class="mdi mdi-printer" aria-hidden="true"></i>',
        	confirmButtonColor:'#3286b7',
			cancelButtonText:'Close',
			cancelButtonColor: '#bcb8b9'
		}).then(function(){
			document.getElementById('formReportPDF').submit();
		},function(dismiss){});
		$('#idFormStatus').multipleSelect();
		$("#idFormStatus").multipleSelect("checkAll");
	}
</script>
@endsection