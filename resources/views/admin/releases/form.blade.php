@include('common.errors')

<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="release_date">Release Date</label>
    {!! Form::date('release_date', null, ['class' => 'form-control']) !!}
</div>
 <div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>