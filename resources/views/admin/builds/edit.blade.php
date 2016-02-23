@extends('adminlayout')

@section('content')

<h1>Update Release</h1>

{!! Form::model($build, ['method' => 'PATCH', 'action' => ['BuildController@update', $build->id]]) !!}
@include('admin.builds.form')
{!! Form::close() !!}

@stop