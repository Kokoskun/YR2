@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-default panel-body" style="margin-top:-1.9rem;">
            <ul class="list-group">
                <a href="./form/form-project"><li class="list-group-item">Project</li></a>
                <a href="./form/form_camp"><li class="list-group-item">Camp</li></a>
                <a href="./form/form_children"><li class="list-group-item">Children</li></a>
                <a href="./form/form_contract"><li class="list-group-item">Contract</li></a>
                <a href="./form/form_follower"><li class="list-group-item">Follower</li></a>
                <a href="./form/form_labor"><li class="list-group-item">Labor</li></a>
                <a href="./form/form_vaccine-log"><li class="list-group-item">Vaccine Log</li></a>
                <a href="./form/vaccine-history"><li class="list-group-item">Vaccine History</li></a>
            </ul>
        </div>
    </div>
</div> 
@stop
@section('myJS')

@endsection