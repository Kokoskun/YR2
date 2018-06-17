@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default panel-body" style="margin-top:-1.25em;">
            <div class="col-md-12" style="margin-top:-1em;">
                <div class="col-md-2 mt-3">
                    <a href="{{ asset('/manage-group')}}" style="text-decoration:none;"><button class="form-control">Back <i class="mdi mdi-step-backward" aria-hidden="true"></i></button></a>
                </div>
                <div class="col-md-8 text-center align-middle">
                    <h3 class="text-center"><b>Manage Person</b></h3>
                    <h4 class="text-center"><b>{{$dataGroup->name}}</b></h4>
                    @if(isset($dataGroup->remark))
                    <h5 class="text-center"><b>Remark:</b> <i>{{$dataGroup->remark}}</i></h5>
                    @endif
                    <h6 class="text-center"><i>(Count of person: <span id="count-tablet">{{$countUser}}</span>)</i></h6>
                </div>
            </div>
            <form id="addUsersForm" enctype="multipart/form-data" action="{{asset('/manage-group/'.$id.'/manage-person/confirm/')}}" method="post">
                <div class="col-md-12">
                    <div class="col-md-offset-1 col-md-8 mt-3">
                        <select name="userGroup[]" class="js-example-basic-multiple form-control" multiple style="width:100%;">
                            <?php
                                for($item=0;$item < count($dataUser);$item++){
                                    echo '<option class="text-center" value='.$dataUser[$item]->id.'>'.$dataUser[$item]->dataPermission->name.' : '.$dataUser[$item]->email.' ('.$dataUser[$item]->first_name.' '.$dataUser[$item]->last_name.')'.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 mt-1">
                        <button type="submit" class="text-center btn btn-create-view form-control">Add <i class="mdi mdi-account-multiple-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="groupID" value="{{$id}}">
            </form>
        </div>
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.30em;">
            <table id="dataUsers" class="table table-hover">
                <thead>
                    <tr class="width-100">
                        <th class="text-center align-middle width-10">
                            <span class="is-hidden-mobile"><b>Permission</b></span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Permission</b></span>
                        </th>
                        <th class="is-hidden-tablet text-center align-middle width-20">
                            <span style="font-size:0.5em;"><b>Full Name</b></span>
                        </th>
                        <th class="is-hidden-mobile text-center align-middle width-15">First Name</th>
                        <th class="is-hidden-mobile text-center align-middle width-15">Last Name</th>
                        <th class="is-hidden-mobile text-center align-middle width-20">Email</th>
                        <th class="text-center align-middle width-10">
                            <span class="is-hidden-mobile"><b>Auth</b></span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Auth</b></span>
                        </th>
                        <th class="is-hidden-mobile text-center width-5">Image</th>
                        <th class="text-center align-middle width-10">
                            <span class="is-hidden-mobile"><b>Dismiss</b></span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;"><b>Dismiss</b></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @for($item=0;$item<count($dataVPG);$item++)
                        <tr id="tr-{{$dataVPG[$item]->user_id}}" class="width-100">
                            <td class="text-center align-middle width-10">
                                <span class="is-hidden-mobile">{{$dataVPG[$item]->dataUser->dataPermission->name}}</span>
                                <span class="is-hidden-tablet" style="font-size:0.5em;">{{$dataVPG[$item]->dataUser->dataPermission->name}} </span>
                            </td>
                            <td class="is-hidden-tablet text-center align-middle width-20">
                                <span style="font-size:0.5em;">{{$dataVPG[$item]->dataUser->first_name}} {{$dataVPG[$item]->dataUser->last_name}}</span>
                            </td>
                            <td class="is-hidden-mobile text-center align-middle width-15">
                                {{$dataVPG[$item]->dataUser->first_name}}
                            </td>
                            <td class="is-hidden-mobile text-center align-middle width-15">
                                {{$dataVPG[$item]->dataUser->last_name}}
                            </td>
                            <td class="is-hidden-mobile text-center align-middle">
                                {{$dataVPG[$item]->dataUser->email}}
                            </td>
                            <td class="text-center align-middle width-10">
                                <a href="mailto:{{$dataVPG[$item]->dataUser->email}}"><i class="mdi mdi-email-outline" aria-hidden="true"></i></a> 
                                @if(isset($dataSocialAuth[$dataVPG[$item]->user_id]))
                                    @if($dataSocialAuth[$dataVPG[$item]->user_id]['facebook_id']!=null)
                                        <a href="https://www.facebook.com/profile.php?{{$dataSocialAuth[$dataVPG[$item]->user_id]['facebook_id']}}" target="_blank"><i class="mdi mdi-facebook-box" aria-hidden="true"></i></a>
                                    @endif
                                    @if($dataSocialAuth[$dataVPG[$item]->user_id]["google_id"]!=null)
                                        <a href="https://plus.google.com/{{$dataSocialAuth[$dataVPG[$item]->user_id]['google_id']}}" target="_blank"><i class="mdi mdi-google-plus-box" aria-hidden="true"></i></a>
                                    @endif
                                @endif
                            </td>
                            <td class="is-hidden-mobile width-5">
                                @if($dataVPG[$item]->dataUser->image_name==null)
                                    <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                @else
                                    <a href="{{ asset('image/profile256/'.$dataVPG[$item]->dataUser->image_name) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$item]->dataUser->image_name) }}"></a>
                                @endif
                            </td>
                            <td class="text-center align-middle width-10">
                                <?php
                                    echo '<a onclick="dismissUser('.$dataVPG[$item]->user_id.",'".$dataVPG[$item]->dataUser->dataPermission->name."','".$dataVPG[$item]->dataUser->email."','".$dataVPG[$item]->dataUser->first_name."','".$dataVPG[$item]->dataUser->last_name."')".'" href="javascript:void(0)"><button class="is-hidden-tablet btn-min btn-delete-mobile"><i class="mdi mdi-account-remove" aria-hidden="true"></i></button><button class="is-hidden-mobile btn btn-danger"><i class="mdi mdi-account-remove" aria-hidden="true"></i></button></a>';
                                ?>
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
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript">
    btnClick("{{$layoutLocat}}");
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
        $('#dataUsers').DataTable();
    });
    var valueCountUser={{$countUser}};
    function dismissUser(user_id,permission_name,email,first_name,last_name){
        swal({
        title: 'Dismiss Person',
        type: 'warning',
        html: '<b>Permission:</b> '+permission_name+'<br><b>Name:</b> '+first_name+' '+last_name+'<br><b>Email:</b> '+email,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#c94a3b',
        cancelButtonColor: '#999999',
        confirmButtonText:
            'Confirm! <i class="mdi mdi-delete" aria-hidden="true"></i>',
        cancelButtonText:
            'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ asset('/manage-group/'.$id.'/manage-person/dismiss/') }}",
                type: 'DELETE',
                data: {_token: CSRF_TOKEN,messageID:user_id,groupID:{{$id}}},
                dataType: 'JSON',
                success:function(data){
                    if(data.valueID==null){
                        swal({
                            title:'Dismiss Person!',
                            type:'error',
                            html:'Can Not Dismiss Person in Server!!<br>Please refresh to page <i class="mdi mdi-refresh" aria-hidden="true"></i>',
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }else{
                        valueCountUser =  parseInt(valueCountUser)-1;
                        $('#count-tablet').text(valueCountUser);
                        $('#tr-'+data.valueID).addClass("is-hidden-data");
                        swal({
                            title:'Dismiss Person!',
                            type:'success',
                            html:'Dismiss Person in Group Success',
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }
                },error:function(data){ 
                    swal({
                        title:'Dismiss Person!',
                        type:'error',
                        html:'Can Not Dismiss Person in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
        },function(dismiss){});
    }
</script>
@endsection