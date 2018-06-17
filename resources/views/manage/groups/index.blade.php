@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.min.css')}}">
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top:-1.25em;">
            <div class="panel panel-default panel-body">
                <div class="col-md-12" style="margin-top:-1em;">
                    <div class="col-md-offset-3 col-md-6">
                        <h3 class="text-center"><b>Manage Groups <i class="mdi mdi-lan" aria-hidden="true"></i></b></h3>
                        <h6 class="text-center"><i>(Count of group: <span id="count-tablet">{{$countGroup}}</span>)</i></h6>
                    </div>
                    <div class="text-center col-md-3 mt-5">
                        <button class="is-hidden-mobile btn btn-create-view align-middle text-center form-control" onclick="addGroup()">Add Group <i class="mdi mdi-plus" aria-hidden="true"></i></button>
                        <button class="is-hidden-tablet btn-min btn-create-view align-middle text-center" onclick="addGroup()">Add Group <i class="mdi mdi-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div class="panel panel-default" style="margin-top:-1.30em;">
                <div class="panel-body">
                    <table id="tableGroup" class="table table-hover">
                        <thead>
                            <tr class="width-100">
                                <th class="is-hidden-mobile text-center align-middle width-20">
                                    Project Manager
                                </th>
                                <th class="text-center align-middle width-5">
                                    <span class="is-hidden-mobile">Count User</span>
                                    <span class="is-hidden-tablet" style="font-size:0.5em;">Count User</span>
                                </th>
                                <th class="text-center align-middle">
                                    <span class="is-hidden-mobile">Name Group</span>
                                    <span class="is-hidden-tablet" style="font-size:0.5em;">Group</span>
                                </th>
                                <th class="text-center align-middle width-5">
                                    <span class="is-hidden-mobile">Info</span>
                                    <span class="is-hidden-tablet" style="font-size:0.5em;">Info</span>
                                </th>
                                <th class="text-center align-middle width-10">
                                    <span class="is-hidden-mobile">Manage Person/Floor</span>
                                    <span class="is-hidden-tablet" style="font-size:0.5em;">Manage Person/Floor</span>
                                </th>
                                <th class="text-center align-middle width-5">
                                    <span class="is-hidden-mobile">Setting Group</span>
                                    <span class="is-hidden-tablet" style="font-size:0.5em;">Setting Group</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($item=0;$item<$countGroup;$item++)
                                <?php
                                    $groupID=$dataGroups[$item]->id;
                                    if(isset($dataVPG[$groupID])){
                                        $countDataVPG=count($dataVPG[$groupID]);
                                    }else{
                                        $countDataVPG=0;
                                    }
                                    if(empty($dataCountVPG[$groupID])){
                                        $dataCountVPG[$groupID]=0;
                                    }
                                ?>
                                <tr id="tr-{{$groupID}}" class="width-100">
                                    <td class="is-hidden-mobile text-center align-middle width-20">
                                        <div id="admin-group-tablet-{{$groupID}}" class="width-100">
                                            @if($countDataVPG!=0)
                                              <ul style="list-style:none;padding:0;margin:0;">
                                                @if($countDataVPG>0)
                                                <li style="float:left;">
                                                    @if($dataVPG[$groupID][0]['image_name']==null)
                                                        <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                                    @else
                                                        <a href="{{ asset('image/profile256/'.$dataVPG[$groupID][0]['image_name']) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$groupID][0]['image_name']) }}"></a>
                                                    @endif
                                                    </li>
                                                @endif
                                                @if($countDataVPG>1)
                                                <li style="float:left;">
                                                    @if($dataVPG[$groupID][1]['image_name']==null)
                                                        <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                                    @else
                                                        <a href="{{ asset('image/profile256/'.$dataVPG[$groupID][1]['image_name']) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$groupID][1]['image_name']) }}"></a>
                                                    @endif
                                                    </li>
                                                @endif
                                                @if($countDataVPG>2)
                                                <li style="float:left;">
                                                    @if($dataVPG[$groupID][2]['image_name']==null)
                                                        <a href="{{ asset('image/profile256.png') }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50.png') }}"></a>
                                                    @else
                                                        <a href="{{ asset('image/profile256/'.$dataVPG[$groupID][2]['image_name']) }}" data-lity><img class="img-responsive" src="{{ asset('image/profile50/'.$dataVPG[$groupID][2]['image_name']) }}"></a>
                                                    @endif
                                                    </li>
                                                @endif
                                                @if($countDataVPG>3)
                                                    <li style="float:left;color:#e5e5e5;">
                                                        <span class="text-center"><h4><b>...</b></h4></span>
                                                    </li>
                                                @endif
                                            </ul>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center align-middle width-5">
                                        <span id="count-user-tablet-{{$groupID}}" class="is-hidden-mobile">{{$dataCountVPG[$groupID]}}</span>
                                        <span id="count-user-mobile-{{$groupID}}" class="is-hidden-tablet" style="font-size:0.5em;">{{$dataCountVPG[$groupID]}}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span id="name-group-tablet-{{$groupID}}" class="is-hidden-mobile">{{$dataGroups[$item]->name}}</span>
                                        <span id="name-group-mobile-{{$groupID}}" class="is-hidden-tablet" style="font-size:0.5em;">{{$dataGroups[$item]->name}}</span>
                                    </td>
                                    <td class="text-center align-middle width-5">
                                        <a onclick="infoGroup({{$groupID}})" href="javascript:void(0)"><button class="is-hidden-tablet text-center btn-min btn-info-mobile"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button><button class="is-hidden-mobile btn btn-info form-control"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button></a>
                                    </td>
                                    <td class="text-center align-middle width-10">
                                        <div class="is-hidden-mobile dropdown">
                                            <button class="btn btn-manage form-control" data-toggle="dropdown">Manage<i aria-hidden="true" class="mdi mdi-chevron-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center"><a href="{{ asset('/manage-group/'.$groupID.'/manage-person/')}}">Manage Person <i class="mdi mdi-account-multiple" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="is-hidden-tablet dropdown">
                                            <button class="btn-min btn-manage width-100" data-toggle="dropdown">Manage<i aria-hidden="true" class="mdi mdi-chevron-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center"><a href="{{ asset('/manage-group/'.$groupID.'/manage-person/')}}">Manage Person <i class="mdi mdi-account-multiple" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle width-5">
                                        <div class="is-hidden-mobile dropdown">
                                            <button class="btn btn-setting form-control" data-toggle="dropdown"><i aria-hidden="true" class="mdi mdi-settings"></i> <i aria-hidden="true" class="mdi mdi-chevron-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center"><a onclick="editGroup({{$groupID}})" href="javascript:void(0)">Edit Group <i class="mdi mdi-table-edit" aria-hidden="true"></i></a></li>
                                                <li class="text-center"><a onclick="deleteGroup({{$groupID}})" href="javascript:void(0)">Delete Group <i class="mdi mdi-delete-empty" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="is-hidden-tablet dropdown">
                                            <button class="btn-min btn-setting width-100" data-toggle="dropdown"><i aria-hidden="true" class="mdi mdi-settings"></i> <i aria-hidden="true" class="mdi mdi-chevron-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center"><a onclick="editGroup({{$groupID}})" href="javascript:void(0)">Edit Group <i class="mdi mdi-table-edit" aria-hidden="true"></i></a></li>
                                                <li class="text-center"><a onclick="deleteGroup({{$groupID}})" href="javascript:void(0)">Delete Group <i class="mdi mdi-delete-empty" aria-hidden="true"></i></a></li>
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
    </div>
</div>
@stop
@section('myJS')
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/lity.min.js')}}"></script>
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('js/dataTables.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tableGroup').DataTable();
    });
    <?php 
        echo 'var countGroup='.$countGroup.';';
        echo 'var dataGroups=[';
        for($item=0;$item<$countGroup;$item++){
            $newTimeCreated = strtotime($dataGroups[$item]->created_at);
            $newformatTimeCreated = date('d-m-Y H:i:s',$newTimeCreated);
            $newTimeUpdated = strtotime($dataGroups[$item]->updated_at);
            $newformatTimeUpdated = date('d-m-Y H:i:s',$newTimeUpdated);
            echo '['.$dataGroups[$item]->id.',"'.$dataGroups[$item]->name.'","'.$dataGroups[$item]->remark.'","'.$newformatTimeCreated.'","'.$newformatTimeUpdated.'"]';
            if($item<$countGroup-1){
                echo ",";
            }
        }
        echo '];';
        echo 'var dataVPG=[';
        for($item=0;$item<count($listVPG);$item++){
            echo '['.$listVPG[$item]->id.','.$listVPG[$item]->group_id.','.$listVPG[$item]->user_id.']';
            if($item<count($listVPG)-1){
                echo ",";
            }
        }
        echo '];';
        echo 'var dataUser=[';
        for($item=0;$item<count($dataUser);$item++){
            echo '['.$dataUser[$item]->id.',"'.$dataUser[$item]->email.'","'.$dataUser[$item]->first_name.'","'.$dataUser[$item]->last_name.'","'.$dataUser[$item]->image_name.'","'.$dataUser[$item]->dataPermission->name.'"';
                if(isset($dataSocialAuth[$dataUser[$item]->id])){
                    if($dataSocialAuth[$dataUser[$item]->id]['facebook_id']!=null){
                        echo ",'".$dataSocialAuth[$dataUser[$item]->id]['facebook_id']."'";
                    }else{
                        echo ",null";
                    }
                    if($dataSocialAuth[$dataUser[$item]->id]["google_id"]!=null){
                        echo ",'".$dataSocialAuth[$dataUser[$item]->id]["google_id"]."'";
                    }else{
                        echo ",null";
                    }
                }
            echo "]";
            if($item<count($dataUser)-1){
                echo ",";
            }
        }
        echo '];';
    ?>
    btnClick("{{$layoutLocat}}");
    function setDataGroup(idGroup,local,valueUpdate){
        var dataGroup=this.dataGroups;
        var countGroup=this.dataGroups.length;
        var statusGroup=true;
        for(var item=0;item<countGroup;item++){
            if(dataGroup[item][0]==idGroup){
                statusGroup=false;
                this.dataGroups[item][local]=valueUpdate;
            }
        }
        if(statusGroup){
            this.dataGroups[countGroup]=[];
            this.dataGroups[countGroup][local]=valueUpdate;
        }
    }
    function getGroup(idGroup,localGroup){
        var dataGroup=this.dataGroups;
        for(var item=0;item<dataGroup.length;item++){
            if(dataGroup[item][0]==idGroup){
                return dataGroup[item][localGroup];
            }
        }
    }
    function getUser(idUser,localUser){
        var dataUser=this.dataUser;
        for(var item=0;item<dataUser.length;item++){
            if(dataUser[item][0]==idUser){
                return dataUser[item][localUser];
            }
        }
    }
    function setTRGroup(idGroup,nameTR,localGroup){
        var dataGroup=this.dataGroups;
        for(var item=0;item<dataGroup.length;item++){
            if(dataGroup[item][0]==idGroup){
                $('#'+nameTR).text(dataGroup[item][localGroup]);
            }
        }
    }
    function infoGroup(idGroup){
        var textRemark='';
        var textPerson='';
        var countUser=0;
        if(this.getGroup(idGroup,2)){
            textRemark='<h5><b>Remark:</b> '+this.getGroup(idGroup,2)+'</h5>';
        }
        for(var item=0;item<this.dataVPG.length;item++){
            if(this.dataVPG[item][1]==idGroup){
                var idUser=this.dataVPG[item][2];
                countUser=1;
                if(this.getUser(idUser,4)){
                    textPerson=textPerson+'<tr class="width-100"><td class="text-center align-middle"><a href='+"'"+'{{ asset("image/profile256")}}/'+this.getUser(idUser,4)+"'"+' data-lity><img class="img-responsive" src='+"'"+'{{ asset("image/profile50") }}/'+this.getUser(idUser,4)+"'"+'></a></td>';
                }else{
                    textPerson=textPerson+'<tr class="width-100"><td class="text-center align-middle"><a href='+"'"+'{{asset("image/profile256.png")}}'+"'"+' data-lity><img class="img-responsive" src='+"'"+'{{asset("image/profile50.png")}}'+"'"+'></a></td>';
                }
                textPerson=textPerson+'<td class="text-center align-middle"><h5><b>'+this.getUser(idUser,5)+'</b>: <br class="is-hidden-tablet">'+this.getUser(idUser,1)+' <a href="mailto:'+this.getUser(idUser,1)+'"><i class="mdi mdi-email-outline" aria-hidden="true"></i></a>';
                if(this.getUser(idUser,6)!=null){
                     textPerson=textPerson+' <a href="https://www.facebook.com/profile.php?'+this.getUser(idUser,6)+'" target="_blank"><i class="mdi mdi-facebook-box" aria-hidden="true"></i></a>'
                }
                if(this.getUser(idUser,7)!=null){
                    textPerson=textPerson+' <a href="https://plus.google.com/'+this.getUser(idUser,6)+'" target="_blank"><i class="mdi mdi-google-plus-box" aria-hidden="true"></i></a>'
                }
                textPerson=textPerson+'</h5><h5><b>Full Name:</b> '+this.getUser(idUser,2)+' '+this.getUser(idUser,3)+'</h5></td></tr>';
                countUser=countUser+1;
            }
        }
        if(textPerson==''){
            textPerson="<h5><i>No users</i></h5>"
        }
        swal({
            title:this.getGroup(idGroup,1),
            html:textRemark+"<b>User In Group</b> <i class='h6'>(Count User:"+countUser+")</i><table class='table table-hover'><tbody>"+textPerson+"</tbody></table>",
            showCloseButton: true,
            confirmButtonColor: '#bcb8b9',
            confirmButtonText: 'Close'
        }).then(function(){},function(dismiss){});
    }
    function createTR(idGroup){
        var idGroup=this.getGroup(idGroup,0);
        var nameGroup=this.getGroup(idGroup,1);
        var remarkGroup=this.getGroup(idGroup,2);
        this.countGroup =  parseInt(countGroup)+1;
        $('#count-tablet').text(this.countGroup);
        var htmlTR='<tr id="tr-'+idGroup+'" class="width-100"><td class="is-hidden-mobile text-center align-middle width-20"><span id="count-user-mobile-'+idGroup+'" style="font-size:0.5em;">-</span></td><td class="text-center align-middle width-5"><span id="count-user-tablet-'+idGroup+'" class="is-hidden-mobile">0</span><span id="count-user-mobile-'+idGroup+'" class="is-hidden-tablet" style="font-size:0.5em;">0</span></td><td class="text-center align-middle"><span id="name-group-tablet-'+idGroup+'" class="is-hidden-mobile">'+nameGroup+'</span><span id="name-group-mobile-'+idGroup+'" class="is-hidden-tablet" style="font-size:0.5em;">'+nameGroup+'</span></td><td class="text-center align-middle width-5"><a onclick="infoGroup('+idGroup+')" href="javascript:void(0)"><button class="is-hidden-tablet text-center btn-min btn-info-mobile"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button><button class="is-hidden-mobile btn btn-info form-control"><i class="mdi mdi-information-outline" aria-hidden="true"></i></button></a></td><td class="text-center align-middle width-10"><div class="is-hidden-mobile dropdown"><button class="btn btn-manage form-control" data-toggle="dropdown">Manage<i aria-hidden="true" class="mdi mdi-chevron-down"></i></button><ul class="dropdown-menu"><li class="text-center"><a href="{{ asset("/manage-group/")}}'+'/'+idGroup+'/manage-person">Manage Person <i class="mdi mdi-account-multiple" aria-hidden="true"></i></a></li><li class="text-center"><a href="{{ asset("/manage-group/")}}'+'/'+idGroup+'/manage-floor">Manage Floor <i class="mdi mdi-map" aria-hidden="true"></i></a></li><li class="text-center"><a href="{{ asset("/manage-group/")}}'+'/'+idGroup+'/manage-status-defect">Manage Status Defect <i class="mdi mdi-map-marker-circle" aria-hidden="true"></i></a></li></ul></div><div class="is-hidden-tablet dropdown"><button class="btn-min btn-manage width-100" data-toggle="dropdown">Manage<i aria-hidden="true" class="mdi mdi-chevron-down"></i></button><ul class="dropdown-menu"><li class="text-center"><a href="{{ asset("/manage-group/")}}'+'/'+idGroup+'/manage-person">Manage Person <i class="mdi mdi-account-multiple" aria-hidden="true"></i></a></li><li class="text-center"><a href="{{ asset("/manage-group/")}}'+'/'+idGroup+'/manage-floor">Manage Floor <i class="mdi mdi-map" aria-hidden="true"></i></a></li><li class="text-center"><a href="{{ asset("/manage-group/")}}'+'/'+idGroup+'/manage-status-defect">Manage Status Defect <i class="mdi mdi-map-marker-circle" aria-hidden="true"></i></a></li></ul></div></td><td class="text-center align-middle width-5"><div class="is-hidden-mobile dropdown"><button class="btn btn-setting form-control" data-toggle="dropdown"><i aria-hidden="true" class="mdi mdi-settings"></i> <i aria-hidden="true" class="mdi mdi-chevron-down"></i></button><ul class="dropdown-menu"><li class="text-center"><a onclick="editGroup('+idGroup+')" href="javascript:void(0)">Edit Group <i class="mdi mdi-table-edit" aria-hidden="true"></i></a></li><li class="text-center"><a onclick="deleteGroup('+idGroup+')" href="javascript:void(0)">Delete Group <i class="mdi mdi-delete-empty" aria-hidden="true"></i></a></li></ul></div><div class="is-hidden-tablet dropdown"><button class="btn-min btn-setting width-100" data-toggle="dropdown"><i aria-hidden="true" class="mdi mdi-settings"></i> <i aria-hidden="true" class="mdi mdi-chevron-down"></i></button><ul class="dropdown-menu"><li class="text-center"><a onclick="editGroup('+idGroup+')" href="javascript:void(0)">Edit Group <i class="mdi mdi-table-edit" aria-hidden="true"></i></a></li><li class="text-center"><a onclick="deleteGroup('+idGroup+')" href="javascript:void(0)">Delete Group <i class="mdi mdi-delete-empty" aria-hidden="true"></i></a></li></ul></div></td></tr>';
            $('#tableGroup tbody tr:first').before(htmlTR);
    }
    function editGroup(idGroup){
        swal({
        title: 'Edit Group',
        html: '<form id="editGroupForm" enctype="multipart/form-data" action="{{ asset("/manage-group/update")}}'+'/'+idGroup+'" method="post"><input type="hidden" name="groupID" value="'+idGroup+'"><div class="col-xs-12"><div class="col-xs-3"><h5><b>Group Name:</b></h5></div><div class="col-xs-7"><input id="edit-groupName" name="editGroupName" type="text" class="form-control" value="'+this.getGroup(idGroup,1)+'" disabled></div><div class="col-xs-2 text-center align-middle"><a onclick="setDisable('+"'groupName'"+','+idGroup+',1)"><i id="switch-groupName" class="mdi mdi-toggle-switch-off" aria-hidden="true" style="font-size:30px;"></i></a></div></div><br><div class="col-xs-12"><div class="col-xs-3"><h5><b>remark:</b></h5></div><div class="col-xs-7"><textarea id="edit-remark" name="editRemark" type="text" class="form-control" disabled>'+this.getGroup(idGroup,2)+'</textarea></div><div class="col-xs-2 text-center align-middle"><a onclick="setDisable('+"'remark'"+','+idGroup+',2)"><i id="switch-remark" class="mdi mdi-toggle-switch-off" aria-hidden="true" style="font-size:30px;"></i></a></div></div><input type="hidden" name="_token" value="{{ csrf_token() }}"></form>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3286b7',
        cancelButtonColor: '#cf5e51',
        confirmButtonText:
            'Save! <i class="mdi mdi-content-save" aria-hidden="true"></i>',
        cancelButtonText:
            'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function(){
            $('#edit-remark').prop('disabled', false);
            $('#edit-groupName').prop('disabled', false);
            var form = $('#editGroupForm')[0];
            var formData = new FormData(form);
            $.ajax({
                type:'POST',
                url: "{{asset('/manage-group/update')}}",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.countGroup==0){
                        swal({
                            title:'Update Group!',
                            type:'error',
                            html:'Not Find Group in Server!!<br>Refresh Web <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }else if(data.statusName!=true||data.statusRemark==false){
                        var textWarning='';
                        if(data.statusName==false){
                            textWarning=textWarning+'name of group "'+data.valueName+'" interdiction is special character!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }else if(data.statusName==null){
                            textWarning=textWarning+'name of group not null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }else{
                            textWarning=textWarning+'Update name:"'+data.valueName+'" success!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                            setDataGroup(data.idGroup,1,data.valueName);
                            setTRGroup(data.idGroup,'name-group-tablet-'+data.idGroup,1);
                            setTRGroup(data.idGroup,'name-group-mobile-'+data.idGroup,1);
                        }
                        if(data.statusRemark==false){
                            textWarning=textWarning+'remark of group "'+data.valueRemark+'" interdiction is special character!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }else{
                            textWarning=textWarning+'Update remark:"'+data.valueRemark+'" success!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                            setDataGroup(data.idGroup,2,data.valueRemark);
                        }
                        swal({
                            title:'Update Group!',
                            type:'warning',
                            html:textWarning,
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }else{
                        var textRemark='';
                        setDataGroup(data.idGroup,1,data.valueName);
                        if(data.valueRemark){
                            setDataGroup(data.idGroup,2,data.valueRemark);
                            textRemark='<br><h5><b>Remark: </b>: '+data.valueRemark+'</h5>';
                        }else{
                            setDataGroup(data.idGroup,2,"");
                        }
                        swal({
                            title:'Update Group!',
                            type:'success',
                            html:'<b>Group Name:</b> '+data.valueName+textRemark,
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                        setTRGroup(data.idGroup,'name-group-tablet-'+data.idGroup,1);
                        setTRGroup(data.idGroup,'name-group-mobile-'+data.idGroup,1);
                    }
                },error: function(data){
                    swal({
                        title:'Update Group!',
                        type:'error',
                        html:'Can Not Update Group in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
        },function(dismiss){});
    }
    function setDisable(valueID,groupID,positionID){
        var isValueText = $('#edit-'+valueID).is(':disabled');
        if (!isValueText){
            $('#edit-'+valueID).prop('disabled', true);
            $('#switch-'+valueID).attr('class', 'mdi mdi-toggle-switch-off');
            $('#edit-'+valueID).val(this.getGroup(groupID,positionID));
        }else{
            $('#edit-'+valueID).prop('disabled', false);
            $('#switch-'+valueID).attr('class', 'mdi mdi-toggle-switch');
        }
    }
    function addGroup(){
        swal({
        title: 'Add Group',
        html: '<form id="addGroupForm" enctype="multipart/form-data" action="{{ asset("/manage-group/create")}}" method="post" style="margin-top:-1.5rem;"><div class="col-xs-12 mt-2"><div class="col-xs-3"><h6><b>Name Group:</b></h6></div><div class="col-xs-9"><input id="create-name-group" name="createNameGroup" type="text" class="form-control"></div></div><br><div class="col-xs-12 mt-2"><div class="col-xs-3"><h6><b>Remark:</b></h6></div><div class="col-xs-9"><textarea id="create-remark-group" name="createRemarkGroup" class="form-control"></textarea></div></div><input type="hidden" name="_token" value="{{ csrf_token() }}"></form>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3286b7',
        cancelButtonColor: '#cf5e51',
        confirmButtonText:
            'Save! <i class="mdi mdi-content-save" aria-hidden="true"></i>',
        cancelButtonText:
            'Cancel <i class="mdi mdi-close" aria-hidden="true"></i>'
        }).then(function(){
            var form = $('#addGroupForm')[0];
            var formData = new FormData(form);
            $.ajax({
                type:'POST',
                url: "{{asset('/manage-group/create')}}",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.statusName!=true||data.statusRemark==false){
                        var textError='';
                        if(data.statusName==false){
                            textError=textError+'name of group "'+data.valueName+'" interdiction is special character!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }else if(data.statusName==null){
                            textError=textError+'name of group not null!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        if(data.statusRemark==false){
                            textError=textError+'remark of group "'+data.valueRemark+'" interdiction is special character!! <i class="mdi mdi-close-octagon-outline" aria-hidden="true"></i><br>';
                        }
                        swal({
                            title:'Error Create Group!',
                            type:'error',
                            html:textError,
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }else{
                        var textRemark='';
                        setDataGroup(data.idGroup,0,parseInt(data.idGroup));
                        setDataGroup(data.idGroup,1,data.valueName);
                        if(data.valueRemark){
                            setDataGroup(data.idGroup,2,data.valueRemark);
                            textRemark='<br><h5><b>Remark: </b>: '+data.valueRemark+'</h5>'
                        }else{
                            setDataGroup(data.idGroup,2,"");
                        }
                        createTR(data.idGroup);
                        swal({
                            title:'Create Group!',
                            type:'success',
                            html:'<b>Group Name:</b> '+data.valueName+textRemark,
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }
                },error: function(data){
                    swal({
                        title:'Create Group!',
                        type:'error',
                        html:'Can Not Create Group in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
                        showCloseButton: true,
                        confirmButtonColor: '#bcb8b9',
                        confirmButtonText: 'Close'
                    }).then(function(){},function(dismiss){});
                }
            });
        },function(dismiss){});
    }
    function deleteGroup(groupID){
        var remark=this.getGroup(groupID,2);
        var textRemark='';
        if(remark){
            textRemark='<h5><b>remark: </b>'+remark+' </h5>';
        }
        swal({
        title: 'Delete Group',
        type: 'warning',
        html: '<b>Group Name:</b> '+this.getGroup(groupID,1)+' '+textRemark,
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
                url: "{{ asset('/manage-group/delete') }}",
                type: 'DELETE',
                data: {_token: CSRF_TOKEN,messageID:groupID},
                dataType: 'JSON',
                success:function(data){
                    if(data.valueID!=null){
                        var remark=getGroup(data.valueID,2);
                        var textRemark='';
                        if(remark){
                            textRemark='<h5><b>remark: </b>'+remark+' </h5>';
                        }
                        $('#tr-'+data.valueID).addClass("is-hidden-data");
                        countGroup =  parseInt(countGroup)-1;
                        $('#count-tablet').text(countGroup);
                        swal({
                            title:'Delete Group!',
                            type:'success',
                            html:'<b>Group Name:</b> '+getGroup(data.valueID,1)+' '+textRemark,
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                        setDataGroup(data.valueID,0,null);
                        setDataGroup(data.valueID,1,null);
                        setDataGroup(data.valueID,2,null);
                        setDataGroup(data.valueID,3,null);
                        setDataGroup(data.valueID,4,null);
                    }else{
                        swal({
                            title:'Delete Group!',
                            type:'error',
                            html:'Can Not Delete Group in Server!!<br>Please refresh to page <i class="mdi mdi-refresh" aria-hidden="true"></i>',
                            showCloseButton: true,
                            confirmButtonColor: '#bcb8b9',
                            confirmButtonText: 'Close'
                        }).then(function(){},function(dismiss){});
                    }
                },error:function(data){
                    swal({
                        title:'Delete Group!',
                        type:'error',
                        html:'Can Not Delete Group in Server!!<br>Check connect internet <i class="mdi mdi-wifi-off" aria-hidden="true"></i>',
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