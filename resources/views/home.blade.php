@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <dir class="col-md-12">
                <h4><b>การนัดรับวัคซีน: </b></h4>
                <iframe style="width:100%;" height="700" src="https://msit.powerbi.com/view?r=eyJrIjoiMjdiODU4ZjAtMDFiYy00MmQ2LWJlNGYtMmZkMDYzNmY1MDU4IiwidCI6IjcyZjk4OGJmLTg2ZjEtNDFhZi05MWFiLTJkN2NkMDExZGI0NyIsImMiOjV9" frameborder="0" allowFullScreen="true"></iframe>
            </dir>
            <dir class="col-md-12">
                <h4><b>จำนวนคนงานแต่ละจังหวัด: </b></h4>
                <iframe style="width:100%;" height="700" src="https://msit.powerbi.com/view?r=eyJrIjoiNTc4MDk5ODQtMTljMy00NzUwLWJkODYtODUwNTEwMjI0Y2YxIiwidCI6IjcyZjk4OGJmLTg2ZjEtNDFhZi05MWFiLTJkN2NkMDExZGI0NyIsImMiOjV9" frameborder="0" allowFullScreen="true"></iframe>
            </dir>    
            <dir class="col-md-12">
                <h4><b>โครงการเข้าร่วมกับ Good Space: </b></h4>
                <iframe style="width:100%;" height="700" src="https://msit.powerbi.com/view?r=eyJrIjoiMDQyYjY1MjMtYjBjOS00MTVmLWI2MmMtOTBmNzc1NmRmMmE3IiwidCI6IjcyZjk4OGJmLTg2ZjEtNDFhZi05MWFiLTJkN2NkMDExZGI0NyIsImMiOjV9" frameborder="0" allowFullScreen="true"></iframe>
            </dir>  
            <dir class="col-md-12">
                <h4><b>สัดส่วนพนักงานตามสัญชาติและพนักงานต่อผู้ติดตาม: </b></h4>
                <iframe style="width:100%;" height="700" src="https://msit.powerbi.com/view?r=eyJrIjoiNGEyNWFlMzEtZGYzMC00ZWIwLWFiYzEtMjhiY2NkMzk0ZDNkIiwidCI6IjcyZjk4OGJmLTg2ZjEtNDFhZi05MWFiLTJkN2NkMDExZGI0NyIsImMiOjV9" frameborder="0" allowFullScreen="true"></iframe>
            </dir>  
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