<script>
    @if(session('delete'))
        swal({title:'Deleted Connection',icon: "success"});
    @elseif(session('store'))
        swal({title:'Saved Connection',icon: "success"});
    @elseif(session('update'))
        swal({title:'Updated Connection',icon: "success"});
    @elseif(session('state') == 'Connect')
        swal({title: 'Connected' ,icon: "success"});
    @elseif(session('state'))
        swal({title: '{{ session('state') }}',icon: "error"});
    @endif
</script>
