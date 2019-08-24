<script>
    @if ($errors->has('email'))
      toastr.error('{{$errors->first('email')}}');
    @endif
    @if ($errors->has('password'))
       toastr.error('{{$errors->first('password')}}');
    @endif
</script>