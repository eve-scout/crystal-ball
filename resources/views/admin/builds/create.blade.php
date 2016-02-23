@extends('adminlayout')

@section('content')

<h1>Add Build</h1>

{!! Form::open(['url' => 'admin/builds']) !!}
@include('admin.builds.form')
{!! Form::close() !!}

@stop