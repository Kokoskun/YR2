@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
@stop
@section('content')
<div class="container loader">
    <div class="row">
        <div class="col-md-12" style="margin-top:-1.25em;">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color:#415161;color:#ffffff;"><h4><b>My Defect<i class="mdi mdi-chart-gantt" aria-hidden="true"></i></b></h4></div>
                    <div class="panel-body">
                        <?php
                            $groupInvolved=[];
                            $countGroup=0;
                        ?>
                        @for($itemVPG=0;$itemVPG<count($dataGroups);$itemVPG++)
                            <?php
                                $groupID=$dataGroups[$itemVPG]->group_id;
                                $groupInvolved[$countGroup]=[];
                                $groupInvolved[$countGroup][0]=$groupID;
                                $groupInvolved[$countGroup][1]=$dataGroups[$itemVPG]->dataGroup->name;
                                $countGroup+=1;
                            ?>
                            @if(isset($dataDefect[$groupID]))
                                <div class="text-center">
                                    <span class="is-hidden-mobile h4 text-center"><b>{{$dataGroups[$itemVPG]->dataGroup->name}}</b></span>
                                    <span class="is-hidden-tablet h6 text-center"><b>{{$dataGroups[$itemVPG]->dataGroup->name}}</b></span>
                                    <a href="{{ asset('/manage-defect/group/'.$groupID)}}"><button class="btn-min btn-detail-view"> Manage <i aria-hidden="true" class="mdi mdi-cube-unfolded"></i></button></a>
                                </div>
                                <table id="dataDefects{{$groupID}}" class="table table-hover">
                                    <thead>
                                        <tr class="width-100">
                                            <th class="text-center align-middle width-20">
                                                <span class="is-hidden-mobile"><b>Deadline</b></span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Deadline</b></span>
                                            </th>
                                            <th class="text-center align-middle width-30">
                                                <span class="is-hidden-mobile"><b>Defect</b></span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Defect</b></span>
                                            </th>
                                            <th class="text-center align-middle width-20">
                                                <span class="is-hidden-mobile"><b>People Involved</b></span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;"><b>People Involved</b></span>
                                            </th>
                                            <th class="text-center align-middle width-20">
                                                <span class="is-hidden-mobile"><b>Status</b></span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Status</b></span>
                                            </th>
                                            <th class="text-center align-middle width-10">
                                                <span class="is-hidden-mobile"><b>Info</b></span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Info</b></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for($item=0;$item<count($dataDefect[$groupID]);$item++)
                                        <?php
                                            if($dataDefect[$groupID][$item][6]==50){
                                                $backgroundColorStatus='#c32e2e;';
                                            }else if($dataDefect[$groupID][$item][6]==40){
                                                $backgroundColorStatus='#ec5f2f;';
                                            }else if($dataDefect[$groupID][$item][6]==30){
                                                $backgroundColorStatus='#d89421;';
                                            }else if($dataDefect[$groupID][$item][6]==20){
                                                $backgroundColorStatus='#706f6e;';
                                            }else{
                                                $backgroundColorStatus='#000000;';
                                            }
                                             $defectID=$dataDefect[$groupID][$item][13];
                                        ?>
                                        <tr class="width-100">
                                             <td class="text-center align-middle width-20">
                                                <span id="deadline{{$defectID}}" class="is-hidden-mobile"><b id="deadlineCD{{$defectID}}" style="font-size:1.2em;"></b><b id="deadlineTD{{$defectID}}"></b><br><i class="h6" id="deadlineNF{{$defectID}}"></i></span>
                                                <span id="deadlineM{{$defectID}}" class="is-hidden-tablet" style="font-size:0.5em;"><b id="deadlineMCD{{$defectID}}"></b><br><b id="deadlineMTD{{$defectID}}"></b></span>
                                            </td>
                                            <td class="text-center align-middle width-30">
                                                <a style="text-decoration:none;" href="{{asset('/defect/'.$dataDefect[$groupID][$item][13])}}" target="_blank">
                                                    <span class="is-hidden-mobile">{{$dataDefect[$groupID][$item][2]}}</span>
                                                    <span class="is-hidden-tablet" style="font-size:0.5em;">{{$dataDefect[$groupID][$item][2]}}</span><i class="mdi mdi-open-in-new" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td class="text-center align-middle width-20">
                                                <span class="is-hidden-mobile">{{$dataDefect[$groupID][$item][5]}}</span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;">{{$dataDefect[$groupID][$item][5]}}</span>
                                            </td>
                                            <td class="text-center align-middle width-20" style="color:{{$backgroundColorStatus}};">
                                                <span class="is-hidden-mobile"><b>{{$dataDefect[$groupID][$item][7]}}</b></span> <span class="is-hidden-touch h6"><br><i>{{$dataDefect[$groupID][$item][8]}}</i></span>
                                                <span class="is-hidden-tablet" style="font-size:0.5em;"><b>{{$dataDefect[$groupID][$item][7]}}</b></span>
                                            </td>
                                            <td class="text-center align-middle width-10">
                                                <a onclick="infoDefect({{$defectID}},{{$groupID}},'{{$dataDefect[$groupID][$item][1]}}','{{$dataDefect[$groupID][$item][2]}}','{{$dataDefect[$groupID][$item][3]}}','{{$dataDefect[$groupID][$item][5]}}','{{$dataDefect[$groupID][$item][7]}}','{{$dataDefect[$groupID][$item][8]}}','{{$dataDefect[$groupID][$item][9]}}','{{$dataDefect[$groupID][$item][10]}}','{{$dataDefect[$groupID][$item][11]}}','{{$dataDefect[$groupID][$item][12]}}','{{$dataDefect[$groupID][$item][14]}}')"><button class="is-hidden-tablet btn-min btn-info-mobile"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button><button class="is-hidden-mobile btn btn-info"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button></a>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                                <hr>
                            @endif
                        @endfor
                    </div>
                </div>  
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color:#0392A3;color:#ffffff;"><h4><b>Chart Defect<i class="mdi mdi-chart-pie" aria-hidden="true"></i></b></h4></div>
                    <div class="panel-body">
                        @for($item=0;$item<count($groupInvolved);$item++)
                            @if(isset($dataInvolved[$groupInvolved[$item][0]]))
                                <div class="text-center">
                                    <span class="is-hidden-mobile h4 text-center"><b>{{$groupInvolved[$item][1]}}</b></span>
                                    <span class="is-hidden-tablet h6 text-center"><b>{{$groupInvolved[$item][1]}}</b></span>
                                </div>
                                <div class="canvas-holder" style="width:100%">
                                    <canvas id="chart-area-{{$groupInvolved[$item][0]}}" />
                                </div>
                                <div class="text-center">
                                    <span class="is-hidden-mobile h5 text-center"><b>People Involved</b></span>
                                    <span class="is-hidden-tablet h6 text-center"><b>People Involved</b></span>
                                </div>
                                <br>
                                <?php
                                    $dataChart='';
                                    $labelChart="";
                                    for($itemP=0;$itemP<count($dataPermission);$itemP++){
                                        if(isset($dataInvolved[$groupInvolved[$item][0]][$dataPermission[$itemP]->id])){
                                            $dataChart=$dataChart.$dataInvolved[$groupInvolved[$item][0]][$dataPermission[$itemP]->id].',';
                                            $labelChart=$labelChart."'".$dataPermission[$itemP]->name."',";
                                        }
                                    }

                                    $dataChartS='';
                                    $labelChartS="";
                                    for($itemP=0;$itemP<count($listStatus);$itemP++){
                                        if(isset($dataStatus[$groupInvolved[$item][0]][$listStatus[$itemP]->id])){
                                            $dataChartS=$dataChartS.$dataStatus[$groupInvolved[$item][0]][$listStatus[$itemP]->id].',';
                                            $labelChartS=$labelChartS."'".$listStatus[$itemP]->name."',";
                                        }
                                    }
                                ?>
                                <div class="canvas-holder" style="width:100%">
                                    <canvas id="chart-area-s{{$groupInvolved[$item][0]}}" />
                                </div>
                                <script type="text/javascript">
                                    var config{{$groupInvolved[$item][0]}}={
                                        type:'pie',
                                        data:{
                                            datasets: [{
                                                data: [
                                                    {{$dataChart}}
                                                ],
                                                backgroundColor: [
                                                    '#44546a',
                                                    '#49657a',
                                                    '#4c7ea1',
                                                    '#7eafd0',
                                                    '#36454f',
                                                ],
                                                label: "{{$groupInvolved[$item][1]}}"
                                            }],
                                            labels: [
                                                <?php
                                                    echo $labelChart;
                                                ?>
                                            ]
                                        },
                                        options:{
                                            responsive: true
                                        }
                                    };
                                </script>
                                <script type="text/javascript">
                                    var configS{{$groupInvolved[$item][0]}}={
                                        type:'pie',
                                        data:{
                                            datasets: [{
                                                data: [
                                                    {{$dataChartS}}
                                                ],
                                                backgroundColor: [
                                                    '#73d09f',
                                                    '#1fc0a6',
                                                    '#28b2bf',
                                                    '#3982ab',
                                                    '#1e5661',
                                                ],
                                                label: "{{$groupInvolved[$item][1]}}"
                                            }],
                                            labels: [
                                                <?php
                                                    echo $labelChartS;
                                                ?>
                                            ]
                                        },
                                        options:{
                                            responsive: true
                                        }
                                    };
                                    </script>

                                <div class="text-center">
                                    <span class="is-hidden-mobile h5 text-center"><b>Status</b></span>
                                    <span class="is-hidden-tablet h6 text-center"><b>Status</b></span>
                                </div>
                                <hr>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('myJS')
<script src="{{asset('chart/chart.js/dist/Chart.bundle.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script type="text/javascript">
    btnClick("{{$layoutLocat}}");
    btnClick("{{$layoutLocatMobile}}");
    <?php
        for($item=0;$item<count($dataGroups);$item++){
            $groupID=$dataGroups[$item]->group_id;
            if(isset($dataDefect[$groupID])){
                echo "$(document).ready(function(){";
                echo "$('#dataDefects".$groupID."').DataTable();";
                echo "});";
            }
        }
        echo 'var dataImageDefect=[';
        for($item=0;$item<count($dataImageDefect);$item++){
            echo '['.$dataImageDefect[$item][0].',"'.$dataImageDefect[$item][1].'"]';
            if($item<count($dataImageDefect)-1){
                echo ",";
            }
        }
        echo '];';
        echo 'var dataDefect=[';
        for($item=0;$item<count($dataGroups);$item++){
            $groupID=$dataGroups[$item]->group_id;
            if(isset($dataDefect[$groupID])){
                for($item2=0;$item2<count($dataDefect[$groupID]);$item2++){
                    echo '['.$dataDefect[$groupID][$item2][13].','.$groupID.',"'.$dataDefect[$groupID][$item2][4].'",null,null,null]';
                    if($item2<count($dataDefect[$groupID])-1){
                        echo ",";
                    }
                }
            }
        }
        echo '];';
    ?>
    setArrayTime();
    function setArrayTime(){
        var valEndTime=moment('{{date("d-m-Y")}}',"DD-MM-YYYY");
        for(var item=0;item<this.dataDefect.length;item++){
            var defectID=this.dataDefect[item][0];
            var valStartTime = moment(this.dataDefect[item][2],"YYYY-MM-DD");
            var valStartTimeNew=moment(valStartTime).format('DD-MM-YYYY');
            var sumTime=valStartTime.diff(valEndTime,'days');
            if(this.dataDefect[item][2]){
                this.dataDefect[item][2]=valStartTimeNew;
                $("#deadlineNF"+defectID).text(valStartTimeNew);
            }
            if(sumTime){
                if(sumTime<=3&&sumTime>0){
                    this.dataDefect[item][5]='#fb4904';
                }else if(sumTime<=7&&sumTime>3){
                    this.dataDefect[item][5]='#E59E2E';
                }else if(sumTime>7){
                    this.dataDefect[item][5]='#5C737B';
                }else{
                    this.dataDefect[item][5]='#d61c20';
                }
                if(sumTime<=0){
                    this.dataDefect[item][3]='Time Out';
                    this.dataDefect[item][4]='';
                    $("#deadlineCD"+defectID).text('Time Out');
                    $("#deadlineMCD"+defectID).text('Time Out');
                }else if(sumTime>0){
                    this.dataDefect[item][3]=sumTime;
                    this.dataDefect[item][4]='Day left';
                    $("#deadlineTD"+defectID).text('Day left');
                    $("#deadlineMTD"+defectID).text('Day left');
                    $("#deadlineCD"+defectID).text(sumTime);
                    $("#deadlineMCD"+defectID).text(sumTime);
                }
                $("#deadline"+defectID).css("color",this.dataDefect[item][5]);
                $("#deadlineM"+defectID).css("color",this.dataDefect[item][5]);
            }else{
                this.dataDefect[item][3]='-';
                this.dataDefect[item][4]='';
                this.dataDefect[item][5]='';
                $("#deadlineCD"+defectID).text('-');
                $("#deadlineMCD"+defectID).text('-');
            }
        }
    }
    function getDataDeadline(defectID,groupID){
        for(var item=0;item<this.dataDefect.length;item++){
            if(this.dataDefect[item][0]==defectID&&this.dataDefect[item][1]==groupID){
                return [this.dataDefect[item][2],this.dataDefect[item][3],this.dataDefect[item][4]];
                break;
            }
        }
    }
    function getImageDefect(defectID){
        var dataImageDefect=this.dataImageDefect;
        var dataArray=[];
        var countArray=0;
        for(var item=0;item<dataImageDefect.length;item++){
            if(defectID==dataImageDefect[item][0]){
                dataArray[countArray]=dataImageDefect[item][1];
                countArray=countArray+1;
            }
        }
        return dataArray;
    }
    function infoDefect(defectID,groupID,groupName,defectTitle,defectDetail,permissionName,statusName,statusRemark,createdAt,email,firstName,lastName,permissionRemark){
        var array=this.getDataDeadline(defectID,groupID);
        var textCountDate=array[1];
        var textTypeDate=array[2];
        var newformat=array[0];
        var textDetail='';
        var textDeadline='';
        var textInfoCreated='';
        var dataImage=this.getImageDefect(defectID);
        var htmlImage='';
        if(textCountDate!='-'&&textCountDate){
            textDeadline='<h4>'+textCountDate+' '+textTypeDate+'</h4><h5><b>Deadline:</b> '+newformat+'</h5>';
        }
        if(defectDetail){
            textDetail='<h5><i>'+defectDetail+'</i></h5>';
        }
        if(email){
            textInfoCreated='<h5><b>Created By: </b>'+firstName+' '+lastName+' <i>(<a href="mailto:'+email+'">'+email+'</a>)</i></h5><h5><b>Created At: </b>'+createdAt+'</h5>';
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
            title: 'Info Defect<i class="mdi mdi-information-outline" aria-hidden="true"></i>',
            html: '<h4><b>'+defectTitle+'</b></h4>'+textDetail+'<h5><b>Group:</b> '+groupName+'</h5><h5><b>People Involved: </b>'+permissionName+' <i>('+permissionRemark+')</i></h5>'+textDeadline+'<h5><b>Status: </b>'+statusName+' <i>('+statusRemark+')</i></h5>'+htmlImage+textInfoCreated,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText:
                'Close'
        }).then(function(){},function(dismiss){});
    }
    window.onload=function(){
        <?php
            for($item=0;$item<count($groupInvolved);$item++){
                if(isset($dataInvolved[$groupInvolved[$item][0]])){
                    echo 'var ctx'.$groupInvolved[$item][0].'=document.getElementById("chart-area-'.$groupInvolved[$item][0].'").getContext("2d");';
                    echo 'var chart'.$groupInvolved[$item][0].' = new Chart(ctx'.$groupInvolved[$item][0].',config'.$groupInvolved[$item][0].');';
                    echo 'var ctxS'.$groupInvolved[$item][0].'=document.getElementById("chart-area-s'.$groupInvolved[$item][0].'").getContext("2d");';
                    echo 'var chartS'.$groupInvolved[$item][0].' = new Chart(ctxS'.$groupInvolved[$item][0].',configS'.$groupInvolved[$item][0].');';
                }
            }
        ?>
    };
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b259c33ecbafa72"></script>
@endsection