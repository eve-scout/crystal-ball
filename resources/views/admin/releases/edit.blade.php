@extends('adminlayout')

@section('content')

<h1>Update Release</h1>

{!! Form::model($release, ['method' => 'PATCH', 'action' => ['ReleaseController@update', $release->id]]) !!}
@include('admin.releases.form')
{!! Form::close() !!}

@stop