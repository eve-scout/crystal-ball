@extends('layout')

@section('content')


<h1>New Item</h1>
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
        <label for="exampleInputPassword1">Build</label>
        <select class="form-control">
            <option>Tranquility 9995554</option>
            <option>Tranquility 8888877</option>
            <option>Tranquility 7777555</option>
            <option>Tranquility 5587778</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Tags</label>
        <input type="text" class="form-control" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Status</label>
        <select class="form-control">
            <option>Draft</option>
            <option>Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Notes</label>
        <textarea class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Attachments</label>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Some Audio Attachment</td>
                    <td>MP3</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Some Image Attachment</td>
                    <td>PNG</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Some Image Attachment</td>
                    <td>PNG</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Revision History</label>
        <ul>
            <li>Chris changed name from 'Something' to 'Something else'</li>
            <li>Chris changed build from 'News' to 'Breaking news'</li>
            <li>Matt changed build from 'Breaking news' to 'News'</li>
        </ul>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Save</button>
    </div>
</form>



@stop