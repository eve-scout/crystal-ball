@extends('layout')

@section('content')
<h1>New Release</h1>
<form>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
    </div>
     <div class="form-group">
        <button type="submit" class="btn btn-default">Save</button>
    </div>
</form>
@stop