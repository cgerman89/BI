<div class="col-sm-8 col-lg-offset-2">
    <select id="select_dashboard" class="form-control" style="width: 100%">
        <option value="">select dashboard</option>
        @if(  isset($dashboards) && (!empty($dashboards)) )
            @foreach( $dashboards as $dashboard )
                <option value="{{$dashboard->id}}"> {{$dashboard->name}} </option>
            @endforeach
        @endif
    </select>
</div>
