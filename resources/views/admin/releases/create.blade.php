@extends('adminlayout')

@section('content')

<h1>Add Release</h1>

{!! Form::open(['url' => 'admin/releases']) !!}
@include('admin.releases.form')
{!! Form::close() !!}

@stop