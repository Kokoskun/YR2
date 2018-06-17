<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Report {{Auth::user()->dataPermission->name}} Defect Group {{$dataGroup->name}} ({{$todayAll}})</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
</head>
<body>
	<h4 class="text-center">
		<b>{{$dataGroup->name}}</b>
	</h4>
	@if(isset($dataGroup->remark))
		<h5 class="text-center">
			<i>{{$dataGroup->remark}}</i>
		</h5>
	@endif
	<?php
		$dateInD = number_format($dateIn[8].$dateIn[9]);
		$dateInM = number_format($dateIn[5].$dateIn[6]);
		$dateInY = number_format($dateIn[0].$dateIn[1].$dateIn[2].$dateIn[3]);
		$dateOutD = number_format($dateOut[8].$dateOut[9]);
		$dateOutM = number_format($dateOut[5].$dateOut[6]);
		$dateOutY = number_format($dateOut[0].$dateOut[1].$dateOut[2].$dateOut[3]);
		$textDate = $dateIn[8].$dateIn[9].'/'.$dateIn[5].$dateIn[6].'/'.$dateIn[0].$dateIn[1].$dateIn[2].$dateIn[3].' - '.$dateOut[8].$dateOut[9].'/'.$dateOut[5].$dateOut[6].'/'.$dateOut[0].$dateOut[1].$dateOut[2].$dateOut[3];
	?>
	<h6 class="text-center"><b>Report</b> ({{$textDate}}) <b>created at:</b> {{$todayAll}}</h6>
	@for($item=0;$item<count($dataDefect);$item++)
		<?php
			$timeUser = $dataDefect[$item]->created_at;
			$dateD = number_format($timeUser[8].$timeUser[9]);
			$dateM = number_format($timeUser[5].$timeUser[6]);
			$dateY = number_format($timeUser[0].$timeUser[1].$timeUser[2].$timeUser[3]);
			$isDate=false;
			if($dateInY<$dateY&&$dateOutY>$dateY){
				$isDate=true;
			}else if($dateInY==$dateY&&$dateOutY==$dateY){
				if($dateInM<$dateM&&$dateOutM>$dateM){
					$isDate=true;
				}else if(($dateInM==$dateM&&$dateInD<=$dateD)||($dateOutM==$dateM&&$dateOutD>=$dateD)){
					$isDate=true;
				}
			}
		?>
		@if(isset($dataVerify[$dataDefect[$item]->id])&&$isDate)
			<?php
				$textCountDate='';
				$textTypeDate='';
				$countDate=0;
				if(isset($dataDefect[$item]->deadline)){
					$time = strtotime($dataDefect[$item]->deadline);
					$newformat = date('d-m-Y',$time);
					$nowDate=date("d-m-Y");
					$oldD=intval($newformat[0].$newformat[1]);
					$oldM=intval($newformat[3].$newformat[4]);
					$oldY=intval($newformat[6].$newformat[7].$newformat[8].$newformat[9]);
					$nowD=intval($nowDate[0].$nowDate[1]);
					$nowM=intval($nowDate[3].$nowDate[4]);
					$nowY=intval($nowDate[6].$nowDate[7].$nowDate[8].$nowDate[9]);
					$valueY=$oldY-$nowY;
					$valueM=$oldM-$nowM;
					$valueD=$oldD-$nowD;
					if($valueY>0||$valueM>0){
						$nowMD=cal_days_in_month(CAL_GREGORIAN,$nowM,$nowY);
						$valueNowCMD=$nowMD-$nowD;
						if($oldM+1==$nowM||$nowM+1==$oldM){
							$countDate=$oldD+$valueNowCMD;
						}else if($valueY==0){
							$countDate=$oldD+$valueNowCMD;
							for($itemM=1;$itemM<13;$itemM++){ 
								if($itemM<$oldM&&$itemM>$nowM){
									$countDate+=cal_days_in_month(CAL_GREGORIAN,$itemM,$nowY);
								}
							}
						}else{
							$countDate=$oldD+$valueNowCMD;
							for($itemM=1;$itemM<13;$itemM++){ 
								if($itemM<$oldM){
									$countDate+=cal_days_in_month(CAL_GREGORIAN,$itemM,$oldY);
								}
							}
							for($itemM=1;$itemM<13;$itemM++){ 
								if($itemM>$nowM){
									$countDate+=cal_days_in_month(CAL_GREGORIAN,$itemM,$nowY);
								}
							}
							for($itemY=1;$itemY<$valueY;$itemY++){
								$nowY+=1; 
								$countDate+=cal_days_in_month(CAL_GREGORIAN,1,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,2,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,3,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,4,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,5,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,6,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,7,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,8,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,9,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,10,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,11,$nowY);
								$countDate+=cal_days_in_month(CAL_GREGORIAN,12,$nowY);
							}
						}
	                }else if($valueD>0&&$valueY==0&&$valueM==0){
	                    $countDate=$valueD;
	                }else{
	                    $countDate=0;
	                }
				}else{
					$countDate=-1;
				}
				if($countDate==0){
					$textCountDate='Time Out';
				}else if($countDate>0){
					$textCountDate=$countDate;
					$textTypeDate=' Day left';
				}else{
					$textCountDate='-';
					$newformat='';
				}
				$defectID=$dataDefect[$item]->id;
				$locationDefect=asset('/defect/'.$defectID);
				$timeCreated=strtotime($dataDefect[$item]->created_at);
				$newformatCreated=date('d-m-Y H:i:s',$timeCreated);
				if(isset($dataImage[$defectID][0])){
					$image1='<img style="width:320px;height:180px;" src="'.asset("/image/defects/".$dataImage[$defectID][0]).'">';
				}else{
					$image1='<img style="width:320px;height:180px;" src="'.asset("/image/defects/not_defect.jpg").'">';
				}
			?>
			<div style="margin-bottom:20px;">
				<table class="table-bordered" style="width:100%;">
					<thead style="width:100%;">
						<tr style="width:100%;">
							<td style="width:85%;" class="align-middle text-center">
								<h3><b style="font-size:20px;">{{$dataDefect[$item]->title}}</b></h3>
								@if($dataDefect[$item]->detail)
									<i style="font-size:10px;">{{$dataDefect[$item]->detail}}</i>
								@endif
							</td>
							<th style="width:15%;" class="align-middle">
								<img src="data:image/png;base64,{!!base64_encode(QrCode::format('png')->size(100)->generate($locationDefect))!!}">
							</th>
						</tr>
					</thead>
				</table>
				<table class="table-bordered" style="width:100%;margin-top:-3px;">
					<tbody style="width:100%;">
						<tr style="width:100%;">
							<td style="width:1.25%;"></td>
							<td style="width:50%;" class="align-middle">
								<?php
									echo $image1;
								?>
							</td>
							<td style="width:47.5%;" class="align-middle">
								<h4 style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:12px;">Deadline:</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{$textCountDate}} {{$textTypeDate}}</b> <i style="font-size:10px;">{{$newformat}}</i></h4>
								<h4 style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:12px;">People Involved:</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$dataVerify[$defectID]}} ({{$verifyDetail[$defectID]}})</h4>
								<h4 style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:12px;">Status:</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$dataDefect[$item]->dataStatus->name}} ({{$dataDefect[$item]->dataStatus->remark}})</h4>
								<h5 style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:10px;">Created By:</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$dataDefect[$item]->dataInfoUserCreated->dataUser->first_name}} {{$dataDefect[$item]->dataInfoUserCreated->dataUser->last_name}} <i style="font-size:10px;">({{$dataDefect[$item]->dataInfoUserCreated->dataUser->email}})</i></h5>
								<h5 style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:10px;">Created At:</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$newformatCreated}}</h5>
							</td>
							<td style="width:1.25%;"></td>
						</tr>
						<tr style="width:100%;">
							<td style="width:1.25%;"></td>
							<td style="width:50%;" class="align-middle text-center">
								<i style="font-size:8px;">Image:{{$dataDefect[$item]->title}}</i>
							</td>
							<td style="width:47.5%;" class="align-middle text-center">
								<b style="font-size:8px;">URL: </b><i style="font-size:8px;">{{$locationDefect}}</i>
							</td>
							<td style="width:1.25%;"></td>
						</tr>
					</tbody>
				</table>
			</div>
		@endif
	@endfor
</body>
</html>