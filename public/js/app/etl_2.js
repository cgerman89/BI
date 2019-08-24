    let  schema = $('#schema');
    let  table = $('#tables');
    let  columns = $('#columns');
    let  vista_previa = $('#vista_previa');
    let  btn_add_data = $('#btn_add_data');
    let  btn_cargar_datos = $('#btn_cargar_datos');
    let  txt_name_key = $('#txt_name_key');



    //animacion de carga en la peticion xhr con axios
    NProgress.configure({ trickle: false, showSpinner: true, parent: '#panel_data_source' });
    //fin

    $('[data-toggle="tooltip"]').tooltip();

    schema.select2({theme:"bootstrap",placeholder:'schemas',allowClear: true});

    table.select2({theme:"bootstrap" ,placeholder:'tablas',allowClear: true});

    columns.select2({ theme:"bootstrap",placeholder:'colunmas',multiple: true , tokenSeparators:[',',''],allowClear: true});




    getListSchemas().catch(error => {
        console.log(error);
        toastr.error('Ocurrio un error al cargar lista de esquemas');
    });

    getListTables('-').catch(error => {
        console.log(error);
        toastr.error('ocurrio un error al cargar lista de tablas');
    });

    schema.change(function () {
          getListTables( $(this).val() !=='' ? $(this).val() : 'default' ).catch(error => {
              console.log(error);
              toastr.error('ocurrio un error al cargar lista de tablas');
          });
    });

    txt_name_key.keyup( () =>{
        txt_name_key.val( slugify( txt_name_key.val() ) );
        txt_name_key.val( txt_name_key.val().toUpperCase() );
    });

    table.change(function () {

         let  Schema = schema.val() !=='' ? schema.val() : 'default';
         let  Table  = $(this).val() !=='' ? $(this).val() : '-';

         getListColumns(Schema, Table).then(response => {
             $.each(response.columns, function (index, value) {
                 columns.append('<option value='+value.columns+'>'+value.columns+'</option>');
             });
         }).catch(error => {
             console.log(error);
         });
    });

    vista_previa.click(function (e) {
       e.preventDefault();
        let  Schema = schema.val() !=='' ? schema.val() : '-';
           if(table.val() !==''){
              getDataTablePreview(Schema, table.val() )
                  .then( response => {
                      $('#dt_table_wrapper').remove();
                      $('#html_table_preview').append(response.table);
                      $('#js_table_preview script').remove();
                      $('#js_table_preview').append("<script>"+response.table_js+"</script>");
                  }).catch(error => {
                       console.log(error);
              });
           }else{
               toastr.warning('seleccione tabla');
           }

    });

    btn_add_data.click(function (e) {
       e.preventDefault();
        let  Schema = schema.val() !=='' ? schema.val() : 'default';

            let data = {
                "esquema": Schema,
                "tabla": table.val(),
                "columnas": columns.val(),
                "nombre": txt_name_key.val(),
            };

            if(  ValidarCampos()  )
            {
                table_data_source.row.add(data).draw();
                schema.val('').trigger('change');
                table.val('').trigger('change');
                $('#dt_table_wrapper').remove();
                $('#js_table_preview script').remove();
                txt_name_key.val('');
            }
            else
            {
               toastr.error('campos requeridos..');
            }
    });

    btn_cargar_datos.click(function (e) {
        e.preventDefault();

        if  ( ValidFields() )
        {
            SendDatosCarga().then(response => {
                if ( response === 'store' )
                {
                    toastr.success('Cargada correctamente');
                    schema.val('').trigger('change');
                    table.val('').trigger('change');
                    $('#dt_table_wrapper').remove();
                    $('#js_table_preview script').remove();
                    txt_name_key.val('');
                }
                if (response === 'error_name')
                {
                    toastr.error('nombre collection ya existe', 'Error nombre');
                    txt_name_key.focus();
                }

            }).catch(error =>
            {
                toastr.error('ocurrio un error','Error Cargar Datos');
            });
        }
        else
        {
            toastr.error('campos requeridos','Error Validacion');
        }

    });

    async  function getListSchemas (){
           schema.find('option').remove();
           schema.append('<option value="">schema</option>');
           const resp = await axios.get('DBC/GetSchemas');
           $.each(resp.data.schemas, function (index,value) {
                schema.append('<option value='+value.schema_name+'>'+value.schema_name+'</option>');
           });
           return 'Esquemas Cargados';
    }
    async function getListTables(schema){
        try {
          const resp = await axios.get('DBC/'+schema.trim()+'/GetTables');
          table.find('option').remove();
          table.append('<option value="">tables</option>');
          $.each(resp.data.tables, function (index, value) {
            table.append('<option value='+value.table_name+'>'+value.table_name+'</option>');
          });
        }catch (e) {
            console.error('getTables Error: '+e);
        }
    }
    let getListColumns = async (schema,table) => {
          columns.find('option').remove();
          columns.append('<option value=""></option>');
          const resp = await axios.get('DBC/'+schema.trim()+'/'+table.trim()+'/GetColumns');
          return resp.data;
    };
    let getDataTablePreview = async (schema,table) => {
        const  html = await axios.get('ETL/'+schema.trim()+'/'+table.trim()+'/HtmlTablePreview');
        return html.data;
    };
    let SendDatosCarga = async () => {

        let resp = await axios.post('EXT/Extract',{
            'schema': schema.val() !=='' ? schema.val() : 'default',
            'table':table.val(),
            'columns':columns.val(),
            'name_key':txt_name_key.val()
        });

        return resp.data;
    };

    let slugify = (text) => {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '_')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '_')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    };

    let ValidFields = () => {
        if(table.val() ==='' )
        {
            table.focus();
            return false;
        }
        else if ( columns.find('option:selected').length === 0)
        {
            columns.focus();
            return false;
        }
        else if ( txt_name_key.val() ==='' )
        {
            txt_name_key.focus();
            return false;
        }
        else
        {
           return true;
        }
    };






