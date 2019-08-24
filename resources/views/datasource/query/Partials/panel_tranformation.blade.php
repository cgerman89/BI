<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4">
                <select class="form-control" id="sel_operation" name="sel_operation">
                    <option value="">select operation</option>
                    @isset($transformer)
                        @foreach($transformer as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="col-md-5">
                <select class="form-control" id="sel_columns" name="sel_columns" style="width: 100%" multiple="multiple">
                    <option value="">select column</option>
                    @isset($columns)
                        @foreach($columns as $item => $value)
                            <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" id="btn_agregar_trans">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;
                    Transform</button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-8 col-md-offset-2">
            <ul class="list-group">

            </ul>
        </div>

    </div>
</div>