@extends('adminlayout')

@section('content')
	<h1>Builds</h1>

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" data-page-length="20">
        <thead>
            <tr>
                <th>Name</th>
                <th>Build Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        lengthChange: false,
        dom: '<"toolbar">frtip',
        ajax: '{!! route('admin.builds.data') !!}',
        columns: [
            { data: 'name', name: 'name', width: '60%' },
            { data: 'build_date', name: 'build_date', width: '20%', defaultContent: '' },
            { data: 'action', name: 'action', width: '20%', sortable: false}
        ]
    });

    $("div.toolbar").html('<a href="/admin/builds/create" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Build</a>');
});
</script>
@endpush