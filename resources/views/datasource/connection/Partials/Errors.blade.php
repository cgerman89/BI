<script>
    @if ($errors->any())
    let msm = "";
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                msm += "{{$error}} \n";
            @endforeach
            swal({ title:'Error!',text: msm, icon: 'error'});
        @endif
    @endif
</script>




