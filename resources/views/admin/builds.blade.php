@extends('layout')

@section('content')
<h1>New Build</h1>
<form>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Release</label>
        <select class="form-control">
            <option>Parallax</option>
            <option>December 2015</option>
            <option>January 2015</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Patch Notes Link</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
    </div>
     <div class="form-group">
        <button type="submit" class="btn btn-default">Save</button>
    </div>
</form>
@stop