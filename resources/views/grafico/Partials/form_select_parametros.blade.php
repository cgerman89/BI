<form>
    <div class="col-md-11">
        <label for="sel_etl" class="control-label">Datos</label>
        <div class="form-group">
            <select name="sel_etl" id="sel_etl" class="form-control">
                <option value="">seleccione</option>
                @if(  isset($collections) && (!empty($collections)) )
                      @foreach( $collections as $collection )
                        <option value="{{$collection}}"> {{$collection}} </option>
                      @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <label for="sel_operacion" class="control-label">Operación</label>
        <div class="form-group">
            <select name="sel_operacion" id="sel_operacion" class="form-control">
                <option value="">seleecione</option>
                @if(  isset($operations) && (!empty($operations)) )
                    @foreach( $operations as $operation )
                        <option value="{{$operation}}"> {{$operation}} </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="sel_dimension" class="control-label">DIMENSION(eje y)</label>
        <div class="form-group">
            <select name="sel_dimension" id="sel_dimension" class="form-control">
                <option value="">seleecione</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="sel_medida" class="control-label">MEDIDA(eje x)</label>
        <div class="form-group">
            <select name="sel_medida" id="sel_medida" class="form-control">
                <option value="">seleecione</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <label for="titulo_grafico" class="control-label">Titulo</label>
        <div class="form-group">
            <input type="text" class="form-control" id="titulo_grafico" name="titulo_grafico" placeholder="titulo grafico">
        </div>
    </div>
    <div class="col-md-4">
        <label for="datasetTitle" class="control-label">DatasetTitulo</label>
        <div class="form-group">
            <input type="text" class="form-control" id="datasetTitle" name="datasetTitle" placeholder="dataset titulo">
        </div>
    </div>
</form>