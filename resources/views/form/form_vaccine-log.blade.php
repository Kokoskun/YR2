@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<div class="form-group">
  <div class="form-group">
    <label>ชื่อโครงการ</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>ชื่อพ่อแม่</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>นามสกุลพ่อแม่</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>ชื่อเด็ก</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>นามสกุลเด็ก</label>
    <input class="form-control" type="text">
  </div>
  <div class="form-group">
    <label>ID-Kid</label>
    <input class="form-control" type="text">
  </div>
    <div class="form-group">
      <label>เบอร์โทรศัพท์ครอบครัว</label>
      <input class="form-control" type="text">
    </div>
    <div class="form-group">
      <label>ระยะเวลานัด</label>
      <input class="form-control" type="text">
    </div>
</div>
@stop
@section('myJS')

@endsection