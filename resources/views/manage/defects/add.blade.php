@extends('layouts.app')
@section('header')
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
                    <h3 class="text-center"><b>Add Defect</b></h3>
                    <h4 class="text-center"><b>{{$dataGroup->name}} <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></b></h4>
                    @if(isset($dataGroup->remark)&&$dataGroup->remark!='')
                        <h5 class="text-center"><b>Remark:</b> <i>{{$dataGroup->remark}}</i></h5>
                    @endif
                </div>
                <div class="col-md-3 mt-4"></div>
            </div>
        </div>
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.9rem;">
            <form id="addDefectForm" enctype="multipart/form-data" action='{{ asset("/manage-defect/group/".$id."/create/")}}' method="post">
                <div class="col-md-12 mt-2">
                    <div class="col-md-2 mt-2">
                        <h5 class="text-box"><b>Floor:</b></h5>
                    </div>
                    <div class="col-md-2 mt-2">
                        <?php
                            echo '<select id="floor-defect" name="floorDefect" class="form-control">';
                            echo '<option class="text-center" value="-1">Not Floor</option>';
                            for($item=0;$item<count($dateFloor);$item++){
                                echo '<option class="text-center" value="'.$dateFloor[$item]->id.'">';
                                if($dateFloor[$item]->number_class==0){
                                    echo "Basement";
                                }else{
                                    echo 'Floor: '.$dateFloor[$item]->number_class;
                                }
                                echo '</option>';
                            }
                            echo '</select>';
                        ?>         
                    </div>
                    <div class="col-md-1 mt-2">
                        <h5 class="text-box"><b>Status:</b></h5>
                    </div>
                    <div class="col-md-3 mt-2">
                        <?php
                            echo '<select name="createStatusDefect" class="form-control">';
                            for($item=0;$item<count($dataStatus);$item++){
                                echo '<option class="text-center" value="'.$dataStatus[$item]->id.'">'.$dataStatus[$item]->name.' '.$dataStatus[$item]->remark.'</option>';
                            }
                            echo '</select>';
                        ?>
                    </div>
                    <div id="longlat" class="col-md-4" style="display: none;margin-top:-0.5rem;">
                        <br class="is-hidden-desktop">
                        <h5 class="text-center"><b>Location Floor</b><br><span id="longitude"></span>,<span id="latitude"></span><br><i>(Longitude,Latitude)</i></h5>
                    </div>
                </div>
                <div id="map" class="col-md-12" style="display:none;">
                    <hr>
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
                                <h5 class="text-center"><i>(<b><span id="numberFloor"></span></b><span id="remarkFloor"></span>)</i></h5>
                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>Title:</b></h5>
                    </div>
                    <div class="col-md-9">
                        <input id="create-title-defect" name="createTitleDefect" type="text" class="form-control" placeholder="Title of Defect">
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>Detail:</b></h5>
                    </div>
                    <div class="col-md-9">
                        <textarea id="create-detail-defect" name="createDetailDefect" class="form-control" placeholder="Detail of Defect"></textarea>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>People Involved:</b></h5></div>
                    <div class="col-md-5">
                        <?php
                            echo '<select id="create-permission-defect" name="createPermissionDefect" class="form-control">';
                            for($item=0;$item<count($dataPermission);$item++){
                                echo '<option value="'.$dataPermission[$item]->id.'">'.$dataPermission[$item]->name.' '.$dataPermission[$item]->remark.'</option>';
                            }
                            echo "</select>";
                        ?>
                    </div>
                    <div class="col-md-1">
                        <h5 class="text-box"><b>Deadline:</b></h5>
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="create-deadline-defect" name="createDeadlineDefect" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>Localtion:</b></h5>
                    </div>
                    <div class="col-md-9">
                        <input id="create-localtion-defect" name="createLocaltionDefect" type="text" class="form-control" placeholder="Localtion of Defect">
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-3">
                        <h5 class="text-box"><b>Image Defect1:</b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control mt-1" name="fileUploadDefect1" id="fileUploadDefect1">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <h5 class="text-box"><b>Image Defect2:</b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control mt-1" name="fileUploadDefect2" id="fileUploadDefect2">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <h5 class="text-box"><b>Image Defect3:</b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control mt-1" name="fileUploadDefect3" id="fileUploadDefect3">
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="col-md-3">
                        <h5 class="text-box"><b>Image Defect4:</b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control mt-1" name="fileUploadDefect4" id="fileUploadDefect4">
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="col-md-3">
                        <h5 class="text-box"><b>Image Defect5:</b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control mt-1" name="fileUploadDefect5" id="fileUploadDefect5">
                    </div>
                </div>
                <ul class="col-md-12 text-center" style="float:left;display:inline;list-style-type:none;">
                    <li id="create-list-defect1" class="text-center" style="display:inline;"></li>
                    <li id="create-list-defect2" class="text-center" style="display:inline;"></li>
                    <li id="create-list-defect3" class="text-center" style="display:inline;"></li>
                    <li id="create-list-defect4" class="text-center" style="display:inline;"></li>
                    <li id="create-list-defect5" class="text-center" style="display:inline;"></li>
                </ul>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-12 mt-2">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 mt-2">
                        <button type="button" onclick="sendForm()" class="btn btn-save form-control">Save <i class="mdi mdi-content-save" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-md-4 mt-2">
                        <a href="{{ asset('manage-defect/group/'.$id) }}" style="text-decoration:none;"><button type="button" class="btn btn-cancel form-control">Cancel <i class="mdi mdi-close" aria-hidden="true"></i></button></a>
                    </div>
                </div>
                <input type="hidden" id="longitudeDefect" name="longitudeDefect" value="null">
                <input type="hidden" id="latitudeDefect" name="latitudeDefect" value="null">
            </form>
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
    var xval=null;
    var yval=null;
    var elemImage=null;
    var dataImgFloor=null;
    function removeFloor(isElem){
        isElem.trigger("remove");
    }
    function setFloor(x,y,elems){
        var isPin=$('#pinFloor').val();
        if(typeof isPin!='undefined'){
            this.xval=x;
            this.yval=y;
            this.elemImage=elems;
            $("#longitude").text(x);
            $("#latitude").text(y);
            $("#longitudeDefect").val(x);
            $("#latitudeDefect").val(y);
        }else{
            this.xval=null;
            this.yval=null;
            this.elemImage=null;
        }
    }
    var dataFloor=[
        <?php
            $countFloor=count($dateFloor);
            for($item=0;$item<$countFloor;$item++){ 
                echo '['.$dateFloor[$item]->id.',"'.$dateFloor[$item]->image_name.'","'.$dateFloor[$item]->remark.'",'.$dateFloor[$item]->number_class.']';
                if($item<$countFloor-1){
                    echo ",";
                }
            }
        ?>
    ];
    btnClick("{{$layoutLocat}}");
    function getDataFloor(idFloor,local){
        var dataFloor=this.dataFloor;
        for (var item=0;item<dataFloor.length;item++){
            if(dataFloor[item][0]==idFloor){
                return dataFloor[item][local];
            }
        }
    }
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
    function setListImage(localtionList,localtionIamge,idFileDefect,actionImage){
        if(actionImage==1){
            var nameImage = $('#'+idFileDefect).val().split('\\').pop();
            $('#'+localtionList).html('<a href="'+localtionIamge+'" data-lity><img src="'+localtionIamge+'" style="width:20%;height:auto;margin-top:1em;"></a> <span style="font-size:0.75em;">'+nameImage+'</span> <a href="#" style="color:#e57373;" onclick="setListImage('+"'"+localtionList+"',null,'"+idFileDefect+"',0"+')"><i class="mdi mdi-close" aria-hidden="true"></i></a><br>');
        }else if(actionImage==0){
            $('#'+localtionList).html('');
            $('#'+idFileDefect).val(null);
        }
    }
    $('#floor-defect').change(function(){
        var valueFloor= $('#floor-defect').val();
        if(dataImgFloor!=null){
            dataImgFloor.imgNotes("destroy");
            if(elemImage!=null){
                removeFloor(elemImage);
            }
            setFloor(null,null,null);
            dataImgFloor=null;
        }        
        if (valueFloor!=-1){
            var textRemark=getDataFloor(valueFloor,2);
            var textNumber=getDataFloor(valueFloor,3);
            $('#map').css("display",'block');
            $('#longlat').css("display",'block');
            var localImage="{{asset('image/floor')}}"+"/"+getDataFloor(valueFloor,1);
            $("#imageFloor").attr("src",localImage);
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
            $("#longitude").text(0);
            $("#latitude").text(0);
            $("#longitudeDefect").val(null);
            $("#latitudeDefect").val(null);
            var imgFloor=$("#imageFloor").imgNotes({
                onEdit: function(ev,elem){
                var elemFloor = $(elem);
                var notes = imgFloor.imgNotes('export');
                var isX=xval;
                var isY=yval;
                var isElem=elemImage;
                var x=notes[notes.length-1]['x'];
                var y=notes[notes.length-1]['y'];
                var elems=elemFloor;
                if(x!=isX&&y!=isY&&isX!=null&&isY!=null&&isElem!=null){
                    removeFloor(isElem);
                }
                    setFloor(x,y,elems);  
                }
            });
            imgFloor.imgNotes("option","canEdit",true);
            dataImgFloor=imgFloor;
        }else{
            $('#map').css("display",'none');
            $('#longlat').css("display",'none');
        }
    });
    function sendForm(){
        swal({
          title: 'Loading',
          onOpen: function () {
            swal.showLoading();
            var form = $('#addDefectForm')[0];
            var formData = new FormData(form);
            $.ajax({
                type:'POST',
                url: "{{ asset('/manage-defect/group/'.$id.'/create')}}",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.isDefect){
                        var textDeadline=null;
                        var textDetail='';
                        var textLocaltion='';
                        var locationDefect="{{asset('/defect/')}}"+'/'+data.defectID;
                        if(data.newformat){
                            textDeadline='<span><b style="font-size:1.2em;">'+data.textCountDate+'</b><b>'+data.textTypeDate+'</b></span><br><span class="h6"><b>Deadline: </b></span><i class="h6">'+data.newformat+'</i>';
                        }else{
                            textDeadline='<b>Deadline: </b>-';
                        }
                        if(data.valueDetail){
                            textDetail='<span class="h6"><i>'+data.valueDetail+'</i></span><br>';
                        }
                        if(data.valueLocaltion){
                            textLocaltion='<span class="h6"><b>Localtion: </b>'+data.valueLocaltion+'</span><br>';
                        }
                        swal({
                            title:'Create Defect',
                            type: 'success',
                            html:'<b><a style="text-decoration:none;" href="'+locationDefect+'" target="_blank">'+data.valueTitle+'<i class="mdi mdi-open-in-new" aria-hidden="true"></i></a></b><br>'+textDetail+'<span class="h6"><b>Group:</b> {{$dataGroup->name}}</span><br><span class="h6"><b>People Involved:</b> '+data.namePermission+' <i>('+data.remarkPermission+')</i></span><br>'+textLocaltion+textDeadline+'<br><span class="h6"><b>Status: </b> '+data.nameStatus+' <i>('+data.remarkStatus+')</i></span><br>',
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){
                            location.reload();
                        },function(dismiss){
                            location.reload();
                        });
                    }else{
                        var textError='';
                        if(data.isStatus==false){
                            textError=textError+'status of defect id:'+data.valueStatus+' not on server!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }else if(data.isStatus==null){
                            textError=textError+'status of defect not null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isTitle==null){
                            textError=textError+'title of defect not null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isPermission==false){
                            textError=textError+'people involved of defect id:'+data.valuePermission+' not on server!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }else if(data.isPermission==null){
                            textError=textError+'not people involved of defect!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isImage1){
                            textError=textError+'type image1 not jpeg/png!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isImage2){
                            textError=textError+'type image2 not jpeg/png!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isImage3){
                            textError=textError+'type image3 not jpeg/png!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isImage4){
                            textError=textError+'type image4 not jpeg/png!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.isImage5){
                            textError=textError+'type image5 not jpeg/png!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        swal({
                            title:'Error Create Defect!',
                            type:'error',
                            html:textError,
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }
                },error: function(data){
                    swal({
                        title:'Create Defect!',
                        type:'error',
                        html:'Can Not Create Defect in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
          }
        }).then(
          function(){},
          function(dismiss){
            if(dismiss==='timer'){
            
            }
          });
    }
</script>
@endsection