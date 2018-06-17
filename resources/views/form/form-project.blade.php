@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<div class="form-group">
  <div class="form-group">
    <label>รหัสโครงการ</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>ชื่อโครงการ ภาษาไทย</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>จังหวัด</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>วันเริ่มต้นโครงการ</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>วันสิ้นสุดโครงการ</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>ชื่อโครงการ ภาษาไทย</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>ชื่อโครงการ ภาษาอังกฤษ</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        ประเภทโครงการ
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item" type="button">แนวราบ</button>
        <button class="dropdown-item" type="button">แนวสูง</button>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>ข้อมูล Project Manager</label>
    <div class="form-group">
      <label>ชื่อ</label>
      <input class="form-control" type="text">
    </div>
    <div class="form-group">
      <label>นามสกุล</label>
      <input class="form-control" type="text">
    </div>
    <div class="form-group">
      <label>เบอร์โทรศัทท์</label>
      <input class="form-control" type="text">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input class="form-control" type="text">
    </div>
  </div>
  <div class="form-group">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        สถานะโครงการ
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">ส่งแล้ว</a>
        <a class="dropdown-item" href="#">ยังไม่ได้ส่ง</a>
      </div>
    </div>
  </div>
</div>
@stop
@section('myJS')

@endsection