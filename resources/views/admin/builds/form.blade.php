@include('common.errors')

<div class="form-group">
    <label for="name">name</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="build_date">Build Date</label>
    {!! Form::date('build_date', null, ['class' => 'form-control']) !!}
</div>
 <div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>