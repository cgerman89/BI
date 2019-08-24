let sel_data = $('#sel_data');
let btn_save_data = $('#btn_save_data');
let name_data = $('#name_data');

//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#content_load' });
//fin

let getCacheLista = async () => {
    sel_data.find('option').remove();
    sel_data.append('<option value=""></option>');
    const lista = await axios.get('EXT/Lista');
    return lista.data;
};

let RenderHtmlTable = async (key) =>{
   const html = await axios.get('LOAD/'+key.trim()+'/getHtml');
   return html.data;
};

sel_data.select2({theme:"bootstrap",placeholder:'data',allowClear: true});


getCacheLista().then(response => {
    $.each(response, function (index, value) {
        sel_data.append('<option value='+value.key+'>'+value.key+'</option>');
    });
}).catch(error => {
    console.log(error);
    toastr.error('ocurrio un error');
});

sel_data.change(function () {
     if($(this).val() !==''){
         RenderHtmlTable( $(this).val() ).then(response =>{
            $('#dt_table_wrapper').remove();
            $('#html_table_preview_load').append(response.table);
            $('#js_table_preview_load script').remove();
            $('#js_table_preview_load').append("<script>"+response.table_js+"</script>");
         }).catch( error => {
             console.log(error);
         });
     }
});