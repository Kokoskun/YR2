@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


        </div>
    </div>
</div>
@stop
@section('myJS')
<script type="text/javascript">
    btnClick("{{$layoutLocat}}");
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b259c33ecbafa72"></script>
@endsection