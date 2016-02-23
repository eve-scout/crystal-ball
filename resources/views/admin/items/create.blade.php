@extends('adminlayout')

@section('content')

<h1>Add Item</h1>

{!! Form::open(['url' => 'admin/items']) !!}
@include('admin.items.form')
{!! Form::close() !!}

@stop