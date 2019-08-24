<table class="table table-hover table-bordered" id="connections_table">
    <thead class="bg-gray-light">
    <tr>
        <th>DBMS</th>
        <th>HOST</th>
        <th>USER</th>
        <th>DATABASE</th>
        <th>PORT</th>
        <th>OPTIONS</th>
    </tr>
    </thead>
</table>
<script>
    $(function () {
        $('#connections_table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth:false,
            scrollCollapse: true,
            responsive:true,
            ajax: '{!! route('Query.get_data') !!}',
            columns: [
                { data: 'collection.name'},
                { data: 'host'},
                { data: 'username'},
                { data: 'dbname' },
                { data: 'port'},
                { data: 'OPTIONS', name: 'OPTIONS', orderable: false, searchable: false},
            ],
        });
    });
</script>