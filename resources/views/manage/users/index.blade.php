@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default panel-body" style="margin-top:-1.25em;">
            <div class="col-md-12" style="margin-top:-1em;">
                <h3 class="text-center"><b>จัดการผู้ใช้งาน <i class="mdi mdi-account-network" aria-hidden="true"></i></b></h3><h6 class="text-center"><i>(จำนวนของผู้ใช้ทั้งหมด: <span id="count-tablet">{{$countUser}}</span>)</i></h6>
            </div>
        </div>
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.30em;">
            <table id="dataUsers" class="table table-hover">
                <thead>
                    <tr class="width-100">
                        <th class="text-center align-middle width-15">
                            <span class="is-hidden-mobile">สถานะ</span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;">สถานะ</span>
                        </th>
                        <th class="is-hidden-tablet text-center align-middle">
                            <span style="font-size:0.5em;">ชื่อ-นามสกุล</span>
                        </th>
                        <th class="is-hidden-mobile text-center align-middle width-15">ชื่อจริง</th>
                        <th class="is-hidden-mobile text-center align-middle width-15">นามสกุล</th>
                        <th class="is-hidden-mobile text-center align-middle width-30">
                            อีเมล์
                        </th>
                        <th class="text-center align-middle width-10">
                            <span class="is-hidden-mobile">เข้าสู่ระบบ</span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;">เข้าสู่ระบบ</span>
                        </th>
                        <th class="is-hidden-mobile text-center width-5">รูปภาพ</th>
                        <th class="text-center align-middle width-5">
                            <span class="is-hidden-mobile">จัดการ</span>
                            <span class="is-hidden-tablet" style="font-size:0.5em;">จัดการ</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @for($item=0;$item<$countUser;$item++)
                    <?php 
                        $userID = $dataUsers[$item]->id;
                    ?>
                    <tr id="tr-{{$userID}}" class="width-100">
                        <td class="text-center align-middle width-15">
                            <span id="permission-name-tablet-{{$userID}}" class="is-hidden-mobile">{{$dataUsers[$item]->dataPermission->name}}</span>
                            <span id="permission-name-mobile-{{$userID}}" class="is-hidden-tablet" style="font-size:0.5em;">{{$dataUsers[$item]->dataPermission->name}} </span>
                        </td>
                        <td class="is-hidden-tablet text-center align-middle">
                            <span id="name-full-mobile-{{$userID}}" style="font-size:0.5em;">{{$dataUsers[$item]->first_name}} {{$dataUsers[$item]->last_name}}</span>
                        </td>
                        <td class="is-hidden-mobile text-center align-middle width-15">
                            <sapn id="first-name-tablet-{{$userID}}">{{$dataUsers[$item]->first_name}}</sapn>
                        </td>
                        <td class="is-hidden-mobile text-center align-middle width-15">
                            <span id="last-name-tablet-{{$userID}}">{{$dataUsers[$item]->last_name}}</span>
                        </td>
                        <td class="is-hidden-mobile text-center align-middle width-30">
                            <span id="user-email-tablet-{{$userID}}">{{$dataUsers[$item]->email}}</span>
                        </td>
                        <td class="text-center align-middle width-10">
                            <a href="mailto:{{$dataUsers[$item]->email}}"> <i class="mdi mdi-email-outline" aria-hidden="true"></i></a> 
                            @if(isset($dataSocialAuth[$userID]))
                                @if($dataSocialAuth[$userID]['facebook_id']!=null)
                                    <a href="https://www.facebook.com/profile.php?{{$dataSocialAuth[$userID]['facebook_id']}}" target="_blank"><i class="mdi mdi-facebook-box" aria-hidden="true"></i></a>
                                @endif
                                @if($dataSocialAuth[$userID]["google_id"]!=null)
                                    <a href="https://plus.google.com/{{$dataSocialAuth[$userID]['google_id']}}" target="_blank"><i class="mdi mdi-google-plus-box" aria-hidden="true"></i></a>
                                @endif
                            @endif
                        </td>
                        <td class="is-hidden-mobile width-5">
                            @if($dataUsers[$item]->image_name==null)
                                <a id="user-img-tablet-link-{{$userID}}" href="{{ asset('image/profile256.png') }}" data-lity><img id="user-img-tablet-{{$userID}}" class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                            @else
                                <a id="user-img-tablet-link-{{$userID}}" href="{{ asset('image/profile256/'.$dataUsers[$item]->image_name) }}" data-lity><img id="user-img-tablet-{{$userID}}" class="img-responsive" src="{{ asset('image/profile50/'.$dataUsers[$item]->image_name) }}"></a>
                            @endif
                        </td>
                        <td class="text-center align-middle width-5">
                            <div class="is-hidden-mobile dropdown">
                                <button class="btn btn-setting form-control" data-toggle="dropdown"><i aria-hidden="true" class="mdi mdi-settings"></i> <i aria-hidden="true" class="mdi mdi-chevron-down"></i></button>
                                <ul class="dropdown-menu">
                                    <li class="text-center"><a onclick="optionPermission({{$userID}})" href="javascript:void(0)">แก้ไขสถานะ <i class="mdi mdi-account-switch" aria-hidden="true"></i></a></li>
                                    <li class="text-center"><a onclick="editUser({{$userID}})" href="javascript:void(0)">แก้ไขผู้ใช้ <i class="mdi mdi-table-edit" aria-hidden="true"></i></a></li>
                                    <li class="text-center"><a onclick="deleteUser({{$userID}})" href="javascript:void(0)">ลบผู้ใช้ <i class="mdi mdi-delete-empty" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="is-hidden-tablet dropdown">
                                <button class="btn-min btn-setting width-100" data-toggle="dropdown"><i aria-hidden="true" class="mdi mdi-settings"></i> <i aria-hidden="true" class="mdi mdi-chevron-down"></i></button>
                                <ul class="dropdown-menu">
                                    <li class="text-center"><a onclick="optionPermission({{$userID}})" href="javascript:void(0)">แก้ไขสถานะ <i class="mdi mdi-account-switch" aria-hidden="true"></i></a></li>
                                    <li class="text-center"><a onclick="editUser({{$userID}})" href="javascript:void(0)">แก้ไขผู้ใช้ <i class="mdi mdi-table-edit" aria-hidden="true"></i></a></li>
                                    <li class="text-center"><a onclick="deleteUser({{$userID}})" href="javascript:void(0)">ลบผู้ใช้ <i class="mdi mdi-delete-empty" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
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
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script type="text/javascript">
    var valueCountUser = "{{$countUser}}";
    var dataPermissionID = [];
    var dataPermissionText = [];
    var dataPermissionName = [];
    var localtionImg = "{{ asset('image/') }}";
    $(document).ready(function() {
        $('#dataUsers').DataTable();
    });
    <?php
        echo "var dataUser =[";
        for($itemUser=0;$itemUser<$countUser;$itemUser++){
            echo '['.$dataUsers[$itemUser]->id.','.$dataUsers[$itemUser]->permission_id.',"'.$dataUsers[$itemUser]->first_name.'","'.$dataUsers[$itemUser]->last_name.'","'.$dataUsers[$itemUser]->email.'","'.$dataUsers[$itemUser]->image_name.'"]';
            if ($itemUser!=$countUser-1){
                echo ",";
            }
        }
        echo "];";
        for ($itemList = 0;$itemList<count($dataPermission);$itemList++){
            echo 'dataPermissionID['.$itemList.'] ='.$dataPermission[$itemList]->id.';';
            echo 'dataPermissionName['.$dataPermission[$itemList]->id.'] = "'.$dataPermission[$itemList]->name.'";';
            echo 'dataPermissionText['.$dataPermission[$itemList]->id.'] = " '.$dataPermission[$itemList]->name.' ';
            if (isset($dataPermission[$itemList]->remark)){
                echo ' ('.$dataPermission[$itemList]->remark.') ';
            }
            echo '";';
        }
    ?>
    btnClick("{{$layoutLocat}}");
    function checkUser(userID,position){
        var dataUser=this.dataUser;
        for(var itemUser=0;itemUser<dataUser.length;itemUser++){
            if(dataUser[itemUser][0]==userID){
                return dataUser[itemUser][position];
            }
        }
        return null;        
    }
    function setUser(userID,position,value){
        var dataUser=this.dataUser;
        var dataPermissionName = this.dataPermissionName;
        for(var itemUser=0;itemUser<dataUser.length;itemUser++){
            if(dataUser[itemUser][0]==userID){
                this.dataUser[itemUser][position] = value;
                dataUser=this.dataUser;
                $('#permission-name-tablet-'+userID).text(dataPermissionName[dataUser[itemUser][1]]);
                $('#permission-name-mobile-'+userID).text(dataPermissionName[dataUser[itemUser][1]]);
                $('#name-full-mobile-'+userID).text(dataUser[itemUser][2]+' '+dataUser[itemUser][3]);
                $('#first-name-tablet-'+userID).text(dataUser[itemUser][2]);
                $('#last-name-tablet-'+userID).text(dataUser[itemUser][3]);
                $('#user-email-tablet-'+userID).text(dataUser[itemUser][4]);
                if (dataUser[itemUser][5]){
                    $('#user-img-tablet-'+userID).attr("src",this.localtionImg+'/profile50/'+dataUser[itemUser][5]);
                    $('#user-img-tablet-link-'+userID).attr("href",this.localtionImg+'/profile256/'+dataUser[itemUser][5]);
                }else{
                    $('#user-img-tablet-'+userID).attr("src",this.localtionImg+'/profile50.png');
                    $('#user-img-tablet-link-'+userID).attr("src",this.localtionImg+'/profile256.png');
                }
                break;
            }
        }
    }
    function setDisable(valueID,userID,positionID){
        var isValueText = $('#edit-'+valueID).is(':disabled');
        if (!isValueText){
            $('#edit-'+valueID).prop('disabled', true);
            $('#switch-'+valueID).attr('class', 'mdi mdi-toggle-switch-off');
            $('#edit-'+valueID).val(this.checkUser(userID,positionID));
        }else{
            $('#edit-'+valueID).prop('disabled', false);
            $('#switch-'+valueID).attr('class', 'mdi mdi-toggle-switch');
        }
    }
    function editUser(userID){
        var localtionImgNew =this.localtionImg;
        if (this.checkUser(userID,5)){
            localtionImgNew = localtionImgNew+'/profile256/'+this.checkUser(userID,5);
        }else{
            localtionImgNew = localtionImgNew+'/profile256.png';
        }
        swal({
        title: 'แก้ไขผู้ใช้',
        html: '<form id="editUserForm" enctype="multipart/form-data" action="{{ asset("/manage-user/update/user")}}'+'/'+userID+'" method="post" style="margin-top:-1.5rem;"><b>Permission:</b> '+this.dataPermissionName[this.checkUser(userID,1)]+'<br><img id="imgProfile" src="'+localtionImgNew+'" style="width:256px;high:256px;"><br><div class="col-xs-12"><input type="file" class="form-control" name="fileUpload" id="fileUpload"></div><br><div class="col-xs-12"><div class="col-xs-3"><h5><b>First Name:</b></h5></div><div class="col-xs-7"><input id="edit-firstName" name="editFirstName" type="text" class="form-control" value="'+this.checkUser(userID,2)+'" disabled></div><div class="col-xs-2 text-center align-middle"><a onclick="setDisable('+"'firstName'"+','+userID+',2)"><i id="switch-firstName" class="mdi mdi-toggle-switch-off" aria-hidden="true" style="font-size:30px;"></i></a></div></div><br><div class="col-xs-12"><div class="col-xs-3"><h5><b>Last Name:</b></h5></div><div class="col-xs-7"><input id="edit-lastName" name="editLastName" type="text" class="form-control" value="'+this.checkUser(userID,3)+'" disabled></div><div class="col-xs-2 text-center align-middle"><a onclick="setDisable('+"'lastName'"+','+userID+',3)"><i id="switch-lastName" class="mdi mdi-toggle-switch-off" aria-hidden="true" style="font-size:30px;"></i></a></div></div><br><div class="col-xs-12"><div class="col-xs-3"><h5><b>Email:</b></h5></div><div class="col-xs-7"><input id="edit-email" name="editEmail" type="email" class="form-control" value="'+this.checkUser(userID,4)+'" disabled></div><div class="col-xs-2 text-center align-middle"><a onclick="setDisable('+"'email'"+','+userID+',4)"><i id="switch-email" class="mdi mdi-toggle-switch-off" aria-hidden="true" style="font-size:30px;"></i></a></div></div><input type="hidden" name="_token" value="{{ csrf_token() }}"></form>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3286b7',
        cancelButtonColor: '#cf5e51',
        confirmButtonText:
            'Update! <i class="mdi mdi-content-save" aria-hidden="true"></i>',
        cancelButtonText:
            'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function(){
            var isFirstName = false;
            var isLastName = false;
            var isEmail = false;
            if (!$('#edit-firstName').is(':disabled')){
                if ($('#edit-firstName').val()&&$('#edit-firstName').val()!=" "&&$('#edit-firstName').val()){
                    isFirstName=true;
                }
            }else{
                isFirstName=true;
            }
            if (!$('#edit-lastName').is(':disabled')){
                if ($('#edit-lastName').val()&&$('#edit-lastName').val()!=" "&&$('#edit-lastName').val()){
                    isLastName=true;
                }
            }else{
                isLastName=true;
            }
            if (!$('#edit-email').is(':disabled')){
                if ($('#edit-email').val()&&$('#edit-email').val()!=" "&&$('#edit-email').val()){
                    isEmail=true;
                }
            }else{
                isEmail=true;
            }
            if (isFirstName&&isLastName&&isEmail){
                var form = $('#editUserForm')[0];
                var formData = new FormData(form);
                $.ajax({
                    type:'POST',
                    url: "{{ asset('/manage-user/update/user') }}"+'/'+userID,
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        if(data.statusID){
                            if((data.statusEmail==true||data.statusEmail==null)&&(data.statusFirstName==true||data.statusFirstName==null)&&(data.statusLastName==true||data.statusLastName==null)&&(data.statusImage==true||data.statusImage==null)){
                                    var textSuccess='';
                                    if(data.statusEmail==true){
                                        textSuccess=textSuccess+'Update email:'+checkUser(data.valueID,4)+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+data.valueEmail+' success!! <i class="mdi mdi-check-circle-outline" aria-hidden="true"></i><br>';
                                        setUser(data.valueID,4,data.valueEmail);
                                    }
                                    if(data.statusFirstName==true){
                                        textSuccess=textSuccess+'Update first name: '+checkUser(data.valueID,2)+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+data.valueFirstName+' success!! <i class="mdi mdi-check-circle-outline" aria-hidden="true"></i><br>';
                                        setUser(data.valueID,2,data.valueFirstName);
                                    }
                                    if(data.statusLastName==true){
                                        textSuccess=textSuccess+'Update last name: '+checkUser(data.valueID,3)+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+data.valueLastName+' success!! <i class="mdi mdi-check-circle-outline" aria-hidden="true"></i><br>';
                                        setUser(data.valueID,3,data.valueLastName);
                                    }
                                    if(data.statusImage==true){
                                        textSuccess=textSuccess+'Update image success!! <i class="mdi mdi-check-circle-outline" aria-hidden="true"></i><br>';
                                        setUser(data.valueID,5,data.valueImage);
                                        if("{{ Auth::user()->id }}"==data.valueID){
                                            $("#imgProfileUser").attr("src","{{ asset('image/profile50/') }}/"+data.valueImage);
                                        }
                                    }
                                    if(data.statusEmail==null&&data.statusFirstName==null&&data.statusLastName==null&&data.statusImage==null){
                                      swal({
                                            title:'Update User!',
                                            type:'question',
                                            html:'No data changes found of user',
                                            showCloseButton: true,
                                            confirmButtonColor: '#bcb8b9',
                                            confirmButtonText: 'Close'
                                        }).then(function(){},function(dismiss){});
                                    }else{
                                      swal({
                                            title:'Update User!',
                                            type:'success',
                                            html:textSuccess,
                                            showCloseButton: true,
                                            confirmButtonColor: '#bcb8b9',
                                            confirmButtonText: 'Close'
                                        }).then(function(){},function(dismiss){});
                                    }
                            }else{
                                var textError='';
                                if(data.statusEmail==false){
                                    textError=textError+'Not a valid or have duplicate email '+data.valueEmail+' !! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                }else if(data.statusEmail==true){
                                    textError=textError+'Update email:'+checkUser(data.valueID,4)+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+data.valueEmail+' success!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                    setUser(data.valueID,4,data.valueEmail);
                                }
                                if(data.statusFirstName==false){
                                    textError=textError+'First name: '+data.valueFirstName+' interdiction is special character!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                }else if(data.statusFirstName==true){
                                    textError=textError+'Update first name: '+checkUser(data.valueID,2)+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+data.valueFirstName+' success!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                    setUser(data.valueID,2,data.valueFirstName);
                                }
                                if(data.statusLastName==false){
                                    textError=textError+'Last name: '+data.valueLastName+' interdiction is special character!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                }else if(data.statusLastName==true){
                                    textError=textError+'Update last name: '+checkUser(data.valueID,3)+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+data.valueLastName+' success!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                    setUser(data.valueID,3,data.valueLastName);
                                }
                                if(data.statusImage==false){
                                    textError=textError+'Type Image Not JPEG/PNG!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                }else if(data.statusImage==true){
                                    setUser(data.valueID,5,data.valueImage);
                                    textError=textError+'Update image success!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                                    if("{{ Auth::user()->id }}"==data.valueID){
                                        $("#imgProfileUser").attr("src","{{ asset('image/profile50/') }}/"+data.valueImage);
                                    }
                                }
                                swal({
                                title: 'อัพเดทผู้ใช้งาน!',
                                html: textError,
                                type: 'warning',
                                showCancelButton: true,
                                cancelButtonColor: '#d33',
                                confirmButtonText:
                                    'Update! <i class="mdi mdi-content-save" aria-hidden="true"></i>',
                                cancelButtonText:
                                    'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
                                }).then(function(){
                                    this.editUser(userID)
                                },function(dismiss){});
                            }
                        }else{
                            swal({
                                title:'แก้ไขผู้ใช้!',
                                type:'error',
                                html:'Find not User in Server of <br><b>User:</b>'+checkUser(data.valueID,2)+' '+checkUser(data.valueID,3),
                                showCloseButton: true,
                                confirmButtonColor: '#bcb8b9',
                                confirmButtonText: 'Close'
                            }).then(function(){},function(dismiss){});
                        }
                    },
                    error: function(data){
                        swal({
                            title:'Update User!',
                            type:'error',
                            html:'Can Not Update User in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }
                });
            }else{
                var textError='';
                if (!isFirstName){
                    textError=textError+'Input First Name Not Null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                }
                if (!isLastName){
                    textError=textError+'Input Last Name Not Null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                }
                if (!isEmail){
                    textError=textError+'Input Email Not Null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                }
                swal({
                title: 'Update User!',
                html: textError,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText:
                    'Save! <i class="mdi mdi-content-save" aria-hidden="true"></i>',
                cancelButtonText:
                    'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
                }).then(function(){
                    this.editUser(userID)
                },function(dismiss){});
            }
        },function(dismiss){});
        $('#fileUpload').change(function(){
            if(this.files&&this.files[0]){
                var filename=this.files[0].name;
                var reader=new FileReader();
                reader.onload=function(e){
                    $('#imgProfile').attr('src',e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }else{
                var localtionImgOld =localtionImg;
                localtionImgOld=localtionImgOld+'/profile256/'+checkUser(userID,5);
                $('#imgProfile').attr('src',localtionImgOld);
            }
        });  
    }
    function deleteUser(userID){
        swal({
        title: 'Delete User',
        type: 'warning',
        html: '<b>Permission:</b> '+this.dataPermissionName[this.checkUser(userID,1)]+'<br><b>Name:</b> '+this.checkUser(userID,2)+' '+this.checkUser(userID,3)+'<br><b>Email:</b> '+this.checkUser(userID,4),
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#c94a3b',
        cancelButtonColor: '#999999',
        confirmButtonText:
            'Confirm! <i class="mdi mdi-delete" aria-hidden="true"></i>',
        cancelButtonText:
            'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ asset('/manage-user/delete/user') }}",
                type: 'DELETE',
                data: {_token: CSRF_TOKEN,messageID:userID},
                dataType: 'JSON',
                success:function(data){
                    valueCountUser =  parseInt(valueCountUser)-1;
                    $('#count-tablet').text(valueCountUser);
                    $('#tr-'+data.valueID).addClass("is-hidden-data");
                    swal({
                        title:'Delete User!',
                        type:'success',
                        html:'<b>Permission:</b> '+dataPermissionName[checkUser(data.valueID,1)]+'<br><b>Name:</b> '+checkUser(data.valueID,2)+' '+checkUser(data.valueID,3)+'<br><b>Email:</b> '+checkUser(data.valueID,4),
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                    setUser(data.valueID,0,null);
                    setUser(data.valueID,1,null);
                    setUser(data.valueID,2,null);
                    setUser(data.valueID,3,null);
                    setUser(data.valueID,4,null);
                    setUser(data.valueID,5,null);
                },error:function(data){ 
                    swal({
                        title:'Delete User!',
                        type:'error',
                        html:'Can Not Delete User in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
        },function(dismiss){});
    }
    function optionPermission(userID) {
        var permissionUser=this.checkUser(userID,1);
        var optionText = '';
        var dataPermissionID = this.dataPermissionID;
        var dataPermissionText = this.dataPermissionText;
        for (var item=0;item<dataPermissionID.length;item++) {
            if (permissionUser==dataPermissionID[item]){
                optionText = optionText+'<option class="text-center" value="'+permissionUser+'" selected>'+dataPermissionText[permissionUser]+'</option>';
            }else{
                optionText = optionText+'<option class="text-center" value="'+dataPermissionID[item]+'">'+dataPermissionText[dataPermissionID[item]]+'</option>';
            }
        }
        swal({
        title: 'แก้ไขสถานะผู้ใช้',
        html:
            '<select id="selectPermission" class="form-control text-center">'+optionText+'</select>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3286b7',
        cancelButtonColor: '#cf5e51',
        confirmButtonText:
            'อัพเดท! <i class="mdi mdi-content-save" aria-hidden="true"></i>',
        cancelButtonText:
            'ยกเลิก <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ asset('/manage-user/update/permission') }}",
                type: 'PUT',
                data: {_token: CSRF_TOKEN, messageUpdate:$("#selectPermission").val(),message:permissionUser,messageID:userID},
                dataType: 'JSON',
                success:function(data){
                    setUser(data.valueID,1,data.valueUpdate);
                    swal({
                        title:'อัพเดทสถานะ!',
                        type:'success',
                        html:'<b>ผู้ใช้งาน:</b>'+checkUser(data.valueID,2)+' '+checkUser(data.valueID,3)+' <br><b>สถานะ:</b>'+dataPermissionName[data.value]+' <i class="mdi mdi-ray-start-arrow" aria-hidden="true"></i> '+dataPermissionName[data.valueUpdate],
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                },error:function(data){ 
                    swal({
                        title:'อัพเดทสถานะ!',
                        type:'error',
                        html:'ไม่สามารถอัพเดทสถานะในServerได้!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
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