@extends('adminlayout')

@section('content')

<h1>Update Item</h1>

{!! Form::model($item, ['method' => 'PATCH', 'action' => ['ItemController@update', $item->id]]) !!}

@include('admin.items.form')

{!! Form::close() !!}

@stop