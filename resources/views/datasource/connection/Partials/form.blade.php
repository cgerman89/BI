{{ Form::hidden('user_id', auth()->user()->id) }}
<div class="col-sm-4">
    {{ Form::select('collecction_id',$collection->pluck('name','id') , null, ['class'=> 'form-control','id'=>'collecction_id','placeholder' => 'Select DBMS']) }}
</div>
<div class="col-sm-4">
    <div class="form-group has-feedback">
        {{ Form::text('host',null,['class'=>'form-control','id'=>'host','placeholder'=>'host']) }}
        <span class="fa fa-server form-control-feedback"></span>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group has-feedback">
        {{ Form::text('username',null,['class'=>'form-control','id'=>'username','placeholder'=>'user name']) }}
        <span class="fa fa-address-card form-control-feedback"></span>

    </div>
</div>
<div class="col-sm-4">
    <div class="form-group has-feedback">
        {{ Form::text('dbpassword',null,['class'=>'form-control','id'=>'dbpassword','placeholder'=>'password','required'=>'']) }}
        <span class="fa fa fa-key form-control-feedback"></span>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group has-feedback">
        {{ Form::text('dbname',null,['class'=>'form-control','id'=>'dbname','placeholder'=>'db name']) }}
        <span class="fa fa-database form-control-feedback"></span>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group has-feedback">
        {{ Form::text('port',null,['class'=>'form-control','id'=>'port','placeholder'=>'port']) }}
        <span class="fa fa-code-fork form-control-feedback"></span>
    </div>
</div>
<div class="pull-right">
    <div class="col-sm-4">
        <button type="submit" class="btn btn-primary" id="btn_save" name="btn_save">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;
            Save
        </button>
    </div>
</div>

