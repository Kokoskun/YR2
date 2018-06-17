@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/upload-file.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/HoldOn.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/alertify.min.css')}}">
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row files" id="fileUser">
                                        <h2 class="text-center"><b>Import File</b></h2>
                                        <div class="panel panel-default">
                                            <button class="btn btn-primary btn-file" style="width:20%;">
                                                <i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;Browse<input type="file" name="fileUser" multiple />
                                            </button>
                                        </div>                          
                                        <ul class="fileList list-group"></ul>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <button type="x" id="uploadBtn" class="btn primary start">Start upload</button>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="span16">
                                            <table class="zebra-striped"><tbody class="files"></tbody></table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('myJS')
<script src="{{asset('js/HoldOn.min.js')}}"></script>
<script src="{{asset('js/alertify.min.js')}}"></script>
<script type="text/javascript">
    var countLoadding=0;
    var countLoaddingAll=0;
    var countAll=0;
    var countAPIUpdate=0;
    var countAPICreate=0;
    var countError=0;
    var countUpload=0;
    var countCreate=0;
    var dataCountTime=0;
    var maxAPI=125;
    var idLoad=null;
    var idDowload=null;
    $.fn.fileUploader=function(filesToUpload, sectionIdentifier){
        var fileIdCounter=0;
        this.closest(".files").change(function(evt){
            var output=[];
            $("input").prop('disabled',true);
            for (var item=0;item<evt.target.files.length;item++){
                fileIdCounter++;
                var file=evt.target.files[item];
                var fileId=sectionIdentifier+fileIdCounter;
                filesToUpload.push({
                    id: fileId,
                    file: file
                });
                var removeLink='<a class="removeFile" href="#" data-fileid="'+fileId+'"><button type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Remove</button></a>';
                var fileSize=file.size*0.000001;
                output.push('<li class="list-group-item"><strong>',escape(file.name),"</strong>  (",fileSize.toFixed(4)," MB)&nbsp;&nbsp;",removeLink,"</li>");
            };
            $(this).children(".fileList").append(output.join(""));
            evt.target.value = null;
        });
        $(this).on("click",".removeFile",function(e){
            $("input").prop('disabled',false);
            e.preventDefault();
            var fileId=$(this).parent().children("a").data("fileid");
            for(var item=0;item<filesToUpload.length;++item){
                if(filesToUpload[item].id===fileId){
                    filesToUpload.splice(item,1);
                }
            }
            $(this).parent().remove();
        });
        this.clear = function () {
            for(var item=0;item<filesToUpload.length;++item){
                if(filesToUpload[item].id.indexOf(sectionIdentifier)>=0){
                    filesToUpload.splice(item,1);
                }
            }
            $(this).children(".fileList").empty();
        }
        return this;
    };
    (function () {
        var filesToUpload=[];
        var files1Uploader=$("#fileUser").fileUploader(filesToUpload,"fileUser");
        $("#uploadBtn").click(function(e){
            e.preventDefault();
            var formData=new FormData();
            for(var item=0,len=filesToUpload.length;item<len;item++){
                formData.append("fileUser[]",filesToUpload[item].file);
            }
            HoldOn.open({theme:"sk-cube-grid",message:'กำลังอัพโหลดไฟล์ข้อมูลขึ้นเซิร์ฟเวอร์..'});
            setTimeout(function(){
                HoldOn.close();
                textAPI='มีข้อมูลอัพเดท 80 ข้อมูล และ มีข้อมูลสร้าง 4 ข้อมูล คุณต้องการนำเข้าระบบใช่ไหม?';
                alertify.confirm(textAPI,function(){
                    HoldOn.open({theme:"sk-cube-grid",message:'กำลังอัพเดทไฟล์ข้อมูลขึ้นเซิร์ฟเวอร์..'});
                    setTimeout(function(){
                        HoldOn.close();
                        alertify.alert("File Upload Success", function(){
                            alertify.success('Success Upload');
                        });
                    },4000);
                },
                function(){
                    HoldOn.close();
                });
            },5000);
        });
    })();
</script>
<script type="text/javascript">
    btnClick("{{$layoutLocat}}");
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b259c33ecbafa72"></script>
@endsection