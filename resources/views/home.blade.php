@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <iframe width="933" height="700" src="https://msit.powerbi.com/view?r=eyJrIjoiMjdiODU4ZjAtMDFiYy00MmQ2LWJlNGYtMmZkMDYzNmY1MDU4IiwidCI6IjcyZjk4OGJmLTg2ZjEtNDFhZi05MWFiLTJkN2NkMDExZGI0NyIsImMiOjV9" frameborder="0" allowFullScreen="true"></iframe>
        </div>
    </div>
</div>
@stop
@section('myJS')
<script type="text/javascript">
    btnClick("{{$layoutLocat}}");
    btnClick("{{$layoutLocatMobile}}");
    $(document).ready(function(){
    	console.log('OK');
    });
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b259c33ecbafa72"></script>
@endsection