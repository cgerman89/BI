<form role="form" id="form_connection">
 @csrf
<div class="row">
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-database" aria-hidden="true"></i></span>
            <select name="dbms_id" id="dbms_id" class="form-control">
                <option value="">select dbms</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-server" aria-hidden="true"></i></span>
            <input id="host" type="text" class="form-control" name="host" placeholder="enter host">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
            <input type="text" id="username" name="username" class="form-control" placeholder="enter username">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" name="db_password" id="db_password" class="form-control" placeholder="enter password">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-hdd-o" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="dbname" name="dbname" placeholder="database name">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-plug" aria-hidden="true"></i></span>
            <input type="text" name="port" id="port" class="form-control" placeholder="enter port">
        </div>
    </div>
</div>
    <br>
<div class="row">
    <div class="pull-right">
        <div class="col-sm-4">
            <button type="submit" class="btn btn-default" id="btn_save"> <i class="fas fa-save"></i>
                &nbsp;Save
            </button>
        </div>
    </div>
</div>

</form>