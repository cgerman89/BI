
    let  sel_schemas =  $('#sel_schemas');
    let  sel_tables  = $('#sel_tables');
    let  sel_operation = $('#sel_operation');
    let  sel_columns   = $('#sel_columns');
    let  tabs_etl = $('#tabs_etl');
    let  schema;
    let table;
    NProgress.configure({ trickle: false, showSpinner: true, parent: '#content_tabs' });


    $(document).ajaxStart(function () {
        NProgress.start();
    });
    $(document).ajaxSuccess(function () {
        NProgress.done();
    });

    axios.interceptors.request.use(function(config) {
         NProgress.start();
        return config;
    },function(error) {
        return Promise.reject(error);
    });

    axios.interceptors.response.use(function(response) {
        NProgress.done();
        return response;
    }, function(error) {
        // Do something with response error
        console.log('Error fetching the data');
        return Promise.reject(error);
    });


    sel_schemas.select2();
    sel_tables.select2();
    sel_operation.select2();
    sel_columns.select2();



    GetSchemas();
    GetTables('-');
    GetOperation();

    sel_schemas.change(function () {
        if( $(this).val() !=='') {
            GetTables($(this).val());
        }
    });

    sel_tables.change(function () {
       // GetColumns(sel_schemas.val() !==''? sel_schemas.val():'-',sel_tables.val());
    });

    $('#btn_extract').click(function (e) {
        e.preventDefault();
        schema = sel_schemas.val() !==''? sel_schemas.val():'-';
        table = sel_tables.val() !==''? sel_tables.val():'-';
        console.log(schema+' '+table);
        GetDataTable(schema,table);
    });

    $('#btn_transformer').click(function (e) {
        e.preventDefault();
        if( (schema !=='') && (table !=='') ) {
            let operation = $('#sel_operation').val();
            let fields = Array.from($('#sel_columns').val());
            SendTranformer(schema, table, operation, fields);
        }else {
            toastr.error("select operation or fields");
        }
    });

    $('#btn_load_etl').click(function (e) {
        e.preventDefault();
        SendLoad(schema,table);
    });


    /**
     * return a list of tablename's, that are  in the  schema
     * @param schema {string}
     */
    function GetTables(schema) {
        sel_tables.find('option').remove();
        sel_tables.append('<option value="">select a table</option>');
        $.get('DBC/'+schema.trim()+'/GetTables',
            function (response,status){
                if (status === 'success') $.each(response.tables, function (index, value) {
                    sel_tables.append('<option value='+value.table_name+'>'+value.table_name+'</option>');
                });
            }
            ,'json');
    }

    function GetSchemas() {
        sel_schemas.find('option').remove();
        sel_schemas.append('<option value="">select a schema</option>');
        $.get('DBC/GetSchemas',
            function (response,status){
                if (status === 'success') $.each(response.schemas, function (index, value) {
                    sel_schemas.append('<option value='+value.schema_name+'>'+value.schema_name+'</option>');
                });
            },'json');
    }

    function GetOperation() {
        sel_operation.find('option').remove();
        sel_operation.append('<option value="">select a operation</option>');
        $.get('DBC/GetOperation',
            function (response,status) {
                if (status === 'success') $.each(response.operation, function (index, value) {
                    sel_operation.append('<option value='+value.name+'>'+value.name+'</option>');
                });
            },'json');
    }

    function GetColumns(schema,table){
        sel_columns.find('option').remove();
        $.get('ETL/Extract/'+schema.trim()+'/'+table.trim()+'/GetColumns',
            function (response,status) {
                if (status === 'success') $.each(response, function (index, value) {
                    sel_columns.append('<option value='+value+'>'+value+'</option>');
                });
            },'json');
    }

    /**
     *
     * @param schema {string}
     * @param table  {string}
     */
    async function GetDataTable(schema,table){
        let route = "ETL/Extract/"+schema.trim()+"/"+table.trim()+"/GetHtml";
        try {
            const response = await axios.get(route);
            $('#dt_table_wrapper').remove();
            $('#result_extract').append(response.data.table);
            $('#table_js script').remove();
            $('#table_js').append("<script>"+response.data.table_js+"</script>");
            GetColumns(schema,table);
        } catch (error) {
            console.error('getDataTable Error: '+error);
        }
    }

    /**
     * send information to be  transformer
      * @param schema {string}
     * @param table  {string}
     * @param operation {string}
     * @param fields {Object}
     */
    function SendTranformer(schema,table,operation,fields) {
        let url_trn = "ETL/Transformer/"+schema.trim()+"/"+table.trim()+"/"+operation.trim()+"/"+fields+"/TransformerData";
        axios.get(url_trn)
            .then(function (response) {
                if(response.status === 200){
                    $('#dt_load_wrapper').remove();
                    $('#table_load').append(response.data.table);
                    $('#js_load script').remove();
                    sel_operation.val('').trigger('change');
                    sel_columns.val('').trigger('change');
                    $('#js_load').append("<script>"+response.data.table_js+"</script>");
                    $('#table_operations tbody').append(" <tr> <td>"+operation+"</td> <td>"+fields+"</td> <td> </td> <td>"+response.statusText+"</td> </tr>");
                }
            });

    }

    /**
     * send data load a mongo db
     * @param schema {string}
     * @param table  {string}
     */
    function SendLoad(schema,table){
        let url_load = "ETL/Load/"+schema.trim()+"/"+table.trim()+"/LoadData";
        axios.get(url_load)
            .then(function (response) {
                if(response.status === 200){
                    $('#dt_load_wrapper').remove();
                    $('#js_load script').remove();
                    swal(response.data.mensaje);
                }
            });
    }

