@extends('templates.layouts.container-fluid')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6" ng-controller="ResumeController">
      @include('templates.locationResumeB')
    </div>
    <div class="col-md-6" ng-controller="MoveResumeController">
      @include('templates.moveResumeB')
    </div>
  </div>
</div>
@endsection