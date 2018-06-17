@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-default" style="margin-top:-1.5em;">
            <h3 class="text-center"><b>{{$dataDefect->title}} <i class="mdi mdi-cube-outline" aria-hidden="true"></i></b></h3>
            @if(isset($dataDefect->detail))
                <h6 class="text-center"><i>{{$dataDefect->detail}}</i></h6>
            @endif
            <div class="text-center">
                <b>Group: </b>
                @if(Auth::user()->permission_id==30)
                    <a href="{{ asset('/manage-defect/group/'.$dataDefect->dataGroup->id)}}"><button class="btn-min btn-detail-view"> {{$dataDefect->dataGroup->name}} <i aria-hidden="true" class="mdi mdi-cube-unfolded"></i></button></a>
                @else
                    {{$dataDefect->dataGroup->name}}
                @endif
            </div>
            <div class="text-center">
                <h5><b>People Involved: </b> {{$VPD->dataPermission->name}} <br class="is-hidden-tablet"><i>({{$VPD->dataPermission->remark}})</i></h5>
            </div>
            <?php
                if($dataDefect->status_id==50){
                    $backgroundColorStatus='#c32e2e;';
                }else if($dataDefect->status_id==40){
                    $backgroundColorStatus='#ec5f2f;';
                }else if($dataDefect->status_id==30){
                    $backgroundColorStatus='#d89421;';
                }else if($dataDefect->status_id==20){
                    $backgroundColorStatus='#706f6e;';
                }else{
                    $backgroundColorStatus='#000000;';
                }
            ?>
            <div class="text-center align-middle">
                <h4 id="deadline"><b style="font-size:1.2em;" id="deadlineCD"></b><b id="deadlineTD"></b></h4>
                <h5><b>Deadline: </b> <span id="deadlineNF"></span></h5>
            </div>
            <div class="text-center align-middle">
                <h5><b>Status: </b> <span style="color:{{$backgroundColorStatus}}"><b>{{$dataDefect->dataStatus->name}}</b></span> <i>({{$dataDefect->dataStatus->remark}})</i></h5>
            </div>
            @if(count($dataImageDefect)>1)
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="{{asset('/image/defects/'.$dataImageDefect[0]->image_name)}}" data-lity><img src="{{asset('/image/defects/'.$dataImageDefect[0]->image_name)}}" style="width:100%;height:auto;"></a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-offset-4 col-md-4">    
                            @for($item=1;$item<count($dataImageDefect);$item++)
                                <a href="{{asset('/image/defects/'.$dataImageDefect[$item]->image_name)}}" data-lity><img src="{{asset('/image/defects50/'.$dataImageDefect[$item]->image_name)}}"></a>
                            @endfor
                        </div>
                    </div>
                </div>
            @elseif(count($dataImageDefect)==1)
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="{{asset('/image/defects/'.$dataImageDefect[0]->image_name)}}" data-lity><img src="{{asset('/image/defects/'.$dataImageDefect[0]->image_name)}}" style="width:100%;height:auto;"></a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-12 text-center align-middle">
                <h5><b>Created By: </b>{{$dataDefect->dataUserCreated->first_name}} {{$dataDefect->dataUserCreated->last_name}} <i>(<a href="mailto:{{$dataDefect->dataUserCreated->email}}">{{$dataDefect->dataUserCreated->email}}</a>)</i></h5>
                <?php
                    $time=strtotime($dataDefect->created_at);
                    $newformat=date('d-m-Y H:i:s',$time);
                    $locationDefect=asset('/defect/'.$dataDefect->id);
                ?>
                <h5><b>Created At: </b>{{$newformat}}</h5>
            </div>
            <div class="col-md-12 text-center align-middle" style="margin-top:1rem;">
                <div class="col-md-offset-4 col-md-4 panel panel-default">
                    <img src="data:image/png;base64,{!!base64_encode(QrCode::format('png')->size(100)->generate($locationDefect))!!}">
                    <h6 style="margin-top:-0.25rem;"><b>URL: </b><a href="{{$locationDefect}}"><i>{{$locationDefect}}</i></a></h6>
                </div>
            </div>
        </div>
    </div>
</div> 
@stop
@section('myJS')
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script type="text/javascript">
    btnClick("{{$layoutLocat}}");
    setArrayTime();
    function setArrayTime(){
        var valEndTime=moment('{{date("d-m-Y")}}',"DD-MM-YYYY");
        var valStartTime = moment('{{$dataDefect->deadline}}',"YYYY-MM-DD");
            var valStartTimeNew=moment(valStartTime).format('DD-MM-YYYY');
            var sumTime=valStartTime.diff(valEndTime,'days');
            var value='{{$dataDefect->deadline}}';
            if(value){
                $("#deadlineNF").text(valStartTimeNew);
            }
            var textColor='';
            if(sumTime){
                if(sumTime<=3&&sumTime>0){
                    textColor='#fb4904';
                }else if(sumTime<=7&&sumTime>3){
                    textColor='#E59E2E';
                }else if(sumTime>7){
                    textColor='#5C737B';
                }else{
                    textColor='#d61c20';
                }
                if(sumTime<=0){
                    $("#deadlineCD").text('Time Out');
                }else if(sumTime>0){
                    $("#deadlineTD").text('Day left');
                    $("#deadlineCD").text(sumTime);
                }
                $("#deadline").css("color",textColor);
            }else{
                $("#deadline").hide();
                $("#deadlineNF").html('-');
            }
        
    }
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b259c33ecbafa72"></script>
@endsection