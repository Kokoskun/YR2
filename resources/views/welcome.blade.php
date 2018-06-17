@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.9rem;">
            <table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
                <tr>
                    <td style="padding:10px;">
                        <div id="map" align="center">
                            <img id="imageFloor" src="{{asset('image/floor/H1lTWEAnst6678605703f2cd0198abde4d07714fa6.jpg')}}" style="width:100%;height:auto;" />
                        </div>          
                    </td>
                </tr>
            </table>
                <div class="col-md-12 mt-4">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>Floor:</b></h5>
                    </div>
                    <div class="col-md-1">
                        <h5 class="text-box"><b>Status:</b></h5>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>Title:</b></h5>
                    </div>
                    <div class="col-md-9">
                        <input id="create-title-defect" name="createTitleDefect" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>Detail:</b></h5>
                    </div>
                    <div class="col-md-9">
                        <textarea id="create-detail-defect" name="createDetailDefect" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="col-md-2">
                        <h5 class="text-box"><b>People Involved:</b></h5></div>
                    <div class="col-md-1">
                        <h5 class="text-box"><b>Deadline:</b></h5>
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="create-deadline-defect" name="createDeadlineDefect" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mt-3">
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

        </div>
    </div>
</div> 
@stop
@section('myJS')
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
		<script type="text/javascript" src="https://unpkg.com/jquery-mousewheel@3.1.13"></script>
		<script type="text/javascript" src="{{asset('js/hammer.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/jquery-hammerjs.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/imgViewer.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{asset('css/imgNotes.css')}}">
		<script type="text/javascript" src="{{asset('js/imgNotes.js')}}"></script>
		<script type="text/javascript">
			var imageA=null;
            var imgFloor=$("#imageFloor").imgNotes({
                onEdit: function(ev,elem){
                    var elemFloor = $(elem);
                    var notes = imgFloor.imgNotes('export');
                    if(imageA!=null){
                    	imageA.trigger("remove");
                    }else{
                    	imageA=elemFloor;
                    }
                    console.log(imageA);
                }
            });
            imgFloor.imgNotes("option","canEdit",true);


					
//$img.imgNotes('clear');
		</script>
@endsection