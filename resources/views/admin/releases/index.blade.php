@extends('adminlayout')

@section('content')
    <h1>Releases</h1>

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" data-page-length="20">
        <thead>
            <tr>
                <th>Name</th>
                <th>Release Date</th>
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
        ajax: '{!! route('admin.releases.data') !!}',
        columns: [
            { data: 'name', name: 'name', width: '60%' },
            { data: 'release_date', name: 'release_date', width: '20%', defaultContent: '' },
            { data: 'action', name: 'action', width: '20%', sortable: false}
        ]
    });

    $("div.toolbar").html('<a href="/admin/releases/create" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Release</a>');
});
</script>
@endpush