@extends('adminlayout')

@section('content')
    <h1>Items</h1>

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" data-page-length="20">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Name</th>
                <th>Release</th>
                <th>Build</th>
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
        ajax: '{!! route('admin.items.data') !!}',
        columns: [
            { data: 'itemID', name: 'items.itemID', width: '15%' },
            { data: 'name', name: 'items.name', width: '25%' },
            { data: 'release_name', name: 'releases.name', width: '20%' },
            { data: 'build_name', name: 'builds.name', width: '20%' },
            { data: 'action', name: 'action', width: '20%', sortable: false}
        ]
    });

    $("div.toolbar").html('<a href="/admin/items/create" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Item</a>');
});
</script>
@endpush