{!! Form::open(['url' => 'Query/GetRowsTable','method'=>'GET','id'=>'form_schema_table']) !!}
     <div class="col-sm-5">
         {{ Form::select('schemas',$Schemas, null, ['placeholder' => 'select schemas','class' => 'form-control','id'=>'schemas']) }}
     </div>
    <div class="col-lg-5">
        {{ Form::select('tables', $Tables, null, ['placeholder' => 'select tables','class' => 'form-control','id'=>'tables']) }}
         @if($errors->has('tables'))
             <span class="text-danger">
                  {{ $errors->first('tables') }}
             </span>
         @endif
    </div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary" id="btn_search"><i class="fa fa-search" aria-hidden="true"></i> &nbsp; Extract</button>
    </div>
{!! Form::close() !!}