$( () =>{

    columns.select2({ theme:"bootstrap",placeholder:'colunmas',multiple: true , tokenSeparators:[',',''],allowClear: true});

    txt_file.change( () =>{
         if (! ValidaExtension( txt_file.val() ) ) {
             toastr.error('tipo de archivo no soportado','Error Tipo Archivo');
             txt_file.val('');
             txt_file.focus();
         }
    });

    txt_name_key.keyup( () =>{
        txt_name_key.val( slugify( txt_name_key.val() ) );
        txt_name_key.val( txt_name_key.val().toUpperCase() );
    });


    btn_load_file.click( (e) =>{

        e.preventDefault();

        if ( txt_file.val() !== '' )
        {
            loadFile().then(response =>
            {
                  if ( response.file === 'store' )
                  {
                      toastr.success('cargado','Archivo');

                      $('#dt_table_wrapper').remove();
                      $('#html_table_preview').append(response.table);

                      $('#js_table_preview script').remove();
                      $('#js_table_preview').append("<script>"+response.table_js+"</script>");

                      $.each(response.columns, function (index, value)
                         {
                          columns.append('<option value='+value+'>'+value+'</option>');
                         }
                      );

                  }
            }).catch(error =>
                {
                    toastr.error( error.response.data.message +'<br>'+ error.response.data.errors.file[0] , error.response.status);
                }
            );
        }else {
            toastr.error('selecione un archivo','error');
            txt_file.focus();
        }


    });

    btn_add_data.click( (e) =>{
        e.preventDefault();
        if ( ValidarCampos() )
        {
            Store().then(response =>
            {
                  if (response.data === 'store')
                  {
                      toastr.success('Creado correctamente','Carga');
                      $('#dt_table_wrapper').remove();
                      $('#js_table_preview script').remove();
                      columns.val('').trigger('change');
                      txt_name_key.val('');
                      txt_file.val('');

                  }
                  if ( response.data === 'error_name')
                  {
                     toastr.error('nombre collection ya existe','Error nombre');
                     txt_name_key.focus();
                  }
            }).catch(error =>
            {
                toastr.error('Ocurrio algo al cargar la informacion ','Error carga');
            });

        }
        else
        {
            toastr.error('campos requerido','validate');
        }

    });



});
let btn_load_file = $('#btn_load_file');
let txt_file = $('#txt_file');
let columns = $('#columns');
let txt_name_key = $('#txt_name_key');
let btn_add_data = $('#btn_add_data');




const config = {
    headers: {
        'content-type': 'multipart/form-data'
    }
};

//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#panel_file_load' });

//fin

let Store = async () =>{
    const resp = axios.post('file/store',{
          'name_key': txt_name_key.val(),
          'columns':columns.val()
    });
    return resp;
};

let loadFile = async () =>{
    const form_data = new FormData();
    form_data.append('file', txt_file.prop('files')[0] );
    const resp = await axios.post('file/import',form_data, config);
    return resp.data;
};

let  ValidaExtension = (file) =>{
     let ext = file.split('.').pop();
     return ( (ext === "csv") || (ext === "xlsx") || (ext === "xls") );
};

let ValidarCampos = () => {
    if(columns.find('option:selected').length === 0){
        columns.focus();
        return false;
    }else if(txt_name_key.val() ===''){
        txt_name_key.focus();
        return false;
    }else {
        return true;
    }
};

let slugify = (text) => {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '_')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '_')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
};