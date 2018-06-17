<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Sansiri">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="msapplication-TileImage" content="{{asset('image/logo/sansiri144.png')}}" sizes="144x144">
    <meta name="msapplication-TileColor" content="#22384D">
    <meta name="theme-color" content="#22384D"/>
    <link rel="apple-touch-icon" href="{{asset('image/logo/sansiri120.png')}}">
    <link rel="icon" href="{{asset('image/logo/sansiri192.png')}}" sizes="192x192">
    <link rel="icon" href="{{asset('image/logo/sansiri128.png')}}" sizes="128x128">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Sansiri</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/materialdesignicons.min.css')}}">
    @yield('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/lity.min.css')}}">
</head>
<body>
    <?php
        if(!Auth::guest()){
            if (Auth::user()->image_name==null) {
                $imgLocale = asset('image/profile50.png');
            }else{
                $imgLocale = asset('image/profile50/'.Auth::user()->image_name);
            }
            $userID=Auth::user()->id;
            $listVPG=DB::table('verify_permission_groups')->where('user_id',$userID)->get();
            $listGroups=DB::table('groups')->get();
            $dataCheckVPG=[];
            $dataGroups=[];
            $countGroup=0;
            for($item=0;$item<count($listVPG);$item++){
                $idVPG=$listVPG[$item]->group_id;
                if($userID==$listVPG[$item]->user_id&&empty($dataCheckVPG[$idVPG])){
                    $dataCheckVPG[$idVPG]=true;
                }else if(empty($dataCheckVPG[$idVPG])){
                    $dataCheckVPG[$idVPG]=false;
                }
            }
        }
    ?>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header text-center">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand text-center" href="{{url('/')}}">
                        <img id="imgLogo" src="{{asset('image/logo/sansiri.png')}}" style="margin-top:-1em;">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    @if(!Auth::guest())
                    <ul class="nav navbar-nav navbar-left text-center is-hidden-notebook2">
                        <li><a id="a-home" href="{{route('home')}}" onclick="btnClick('home')"><b>แดชบอร์ด <i class="mdi mdi-home-assistant" aria-hidden="true"></i></b></a></li>
                    </ul>
                    @endif
                    <ul class="nav navbar-nav navbar-right text-center">
                        <li class="is-hidden-notebook"><a id="a-home-mobile" href="{{route('home')}}" onclick="btnClick('home-mobile')"><b>Home <i class="mdi mdi-home-assistant" aria-hidden="true"></i></b></a></li>
                        @if(Auth::guest())
                            <li><a href="{{route('login')}}"><b>ลงชื่อเข้าใช้ <i class="mdi mdi-login-variant" aria-hidden="true"></i></b></a></li>
                            <!--<li><a href="{{route('register')}}"><b>Register <i class="mdi mdi-account-plus" aria-hidden="true"></i></b></a></li>-->
                        @else
                            @if(Auth::user()->permission_id==80)
                            <li id="li-manage-group" class="background-color-minor">
                                <a id="a-manage-group" href="{{asset('/manage-group')}}" onclick="btnClick('manage-group')">
                                    <b>จัดการโครงการ <i class="mdi mdi-lan" aria-hidden="true"></i></b>
                                </a>
                            </li>
                            <li id="li-manage-user" class="background-color-minor">
                                <a id="a-manage-user" href="{{asset('/manage-user')}}" onclick="btnClick('manage-user')">
                                    <b>จัดการผู้ใช้งาน <i class="mdi mdi-account-network" aria-hidden="true"></i></b>
                                </a>
                            </li>
                            @elseif(Auth::user()->permission_id==30)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <b>Manage Defect<i class="mdi mdi-chevron-down" aria-hidden="true"></i></b>
                                </a>
                                <ul class="dropdown-menu text-center" role="menu">
                                    <li id="li-manage-defect">
                                        <a id="a-manage-defect" href="{{asset('/manage-defect')}}" onclick="btnClick('manage-defect')" class="text-center">
                                            Manage Defect All<i class="mdi mdi-book" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <?php

                                        for($item=0;$item<count($listGroups);$item++){
                                            if(isset($dataCheckVPG[$listGroups[$item]->id])){
                                                $idGroup=$listGroups[$item]->id;
                                                echo '<li id="li-manage-defect-'.$idGroup.'" class="text-center"><a id="a-manage-defect-'.$idGroup.'" href="'.asset('/manage-defect/group/'.$idGroup).'" onclick="btnClick('."'".'manage-defect-'.$idGroup."'".')">'.$listGroups[$item]->name.' <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </li>
                            @elseif(Auth::user()->permission_id==21||Auth::user()->permission_id==22||Auth::user()->permission_id==23)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <b>View Defect<i class="mdi mdi-chevron-down" aria-hidden="true"></i></b>
                                </a>
                                <ul class="dropdown-menu text-center" role="menu">
                                    <li id="li-view-defect">
                                        <a id="a-view-defect" href="{{asset('/view-defect')}}" onclick="btnClick('view-defect')" class="text-center">
                                            View Defect All<i class="mdi mdi-book" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <?php
                                        for($item=0;$item<count($listGroups);$item++){
                                            if(isset($dataCheckVPG[$listGroups[$item]->id])){
                                                $idGroup=$listGroups[$item]->id;
                                                echo '<li id="li-view-defect-'.$idGroup.'" class="text-center"><a id="a-view-defect-'.$idGroup.'" href="'.asset('/view-defect/group/'.$idGroup).'" onclick="btnClick('."'".'view-defect-'.$idGroup."'".')">'.$listGroups[$item]->name.' <i class="mdi mdi-cube-unfolded" aria-hidden="true"></i></a></li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <b>{{Auth::user()->first_name}} {{Auth::user()->last_name}}<i class="mdi mdi-chevron-down" aria-hidden="true"></i></b>
                                </a>
                                <ul class="dropdown-menu text-center" role="menu">
                                    <li>
                                        <a class="text-center" href="{{route('logout')}}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout <i class="mdi mdi-logout-variant" aria-hidden="true"></i>
                                        </a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                            {{csrf_field()}}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <img id="imgProfileUser" class="is-hidden-mobile" src="{{$imgLocale}}" style="margin-top:0.35em;">
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>  
    <script type="text/javascript">
        $( "#imgLogo" ).mouseover(function() {
            $("#imgLogo").attr("src","{{asset('image/logo/sansiri_sky.png')}}");
        });
        $( "#imgLogo" ).mouseout(function() {
            $("#imgLogo").attr("src","{{asset('image/logo/sansiri.png')}}");
        });
        function btnClick(domID){
            $('#a-'+domID).css("background-color", "#1a242f");
            $('#a-'+domID).css("color", "#ffffff");
        }
    </script>
    @yield('myJS')
</body>
</html>