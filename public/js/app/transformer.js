let cache_list = $('#cache_list');
let operaciones_list = $('#operaciones_list');
let columns_list = $('#columns_list');
let btn_agregar_trnf = $('#btn_agregar_trnf');
let btn_enviar_trnf = $('#btn_enviar_trnf');


cache_list.select2({theme:"bootstrap",placeholder:'data',allowClear: true});
operaciones_list.select2({theme:"bootstrap",placeholder:'operaciones',allowClear: true});
columns_list.select2({ theme:"bootstrap",multiple:true ,placeholder:'colunmas',tags: true, tokenSeparators:[' , ',' '],allowClear: true});

btn_enviar_trnf.prop('disabled',true);


//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#transformer_panel' });
//fin

// inicializando datatables
let tabla_cola_transformation = $('#tabla_cola_transformation').DataTable({
    "autoWidth":true,
    "responsive":true,
    "scrollX": true,
    "columns":[
        {"data":"Data","width": "15%"},
        {"data":"Campos","width": "65%"},
        {"data":"Operations","width": "15%"},
        {"data": null ,"width": "5%"}
    ],
    "columnDefs": [
        {
            "targets": [3],
            "render": function(data, type, row) {
                return '<a href="#"  class="quitar btn btn-sm btn-danger" title="quitar"><i class="far fa-trash-alt"></i></a>';
            }
        }
    ],
});
//fin


let getCacheLista = async () => {
    cache_list.find('option').remove();
    cache_list.append('<option value=""></option>');
    const  lista = await axios.get('EXT/Lista');
    return lista.data;
};

let getOperacionesData = async () => {
    operaciones_list.find('option').remove();
    operaciones_list.append('<option value=""></option>');
    const  op_lista = await axios.get('DBC/GetOperation');
    return op_lista.data;
};

let getColumns = async (key) => {
    columns_list.find('option').remove();
    const  operations = await axios.get('TRNF/'+key.trim()+'/ColumnsDataCache');
    return operations.data;
};

let sendTransfromation = async (data) => {
    const sendData = await  axios.post('TRNF/TransformerData',data);
    return sendData.data;
};

tabla_cola_transformation.on('click', 'a.quitar', function () {
    let indice = tabla_cola_transformation.row( $(this).parents("tr")).index();
    swal({
        title: "Quitar  elemento?",
        icon: "warning",
        buttons: ["Mantener", "Quitar"],
        dangerMode: true,
        closeOnEsc: false,
        closeOnClickOutside: false
    }).then((willDelete) => {
        willDelete ? tabla_cola_transformation.row(indice).remove().draw() : null;
    });
});

tabla_cola_transformation.on( 'draw', function () {
    tabla_cola_transformation.data().length > 0 ? btn_enviar_trnf.prop('disabled',false ) : btn_enviar_trnf.prop('disabled',true) ;
} );

btn_agregar_trnf.click(function (e) {
    e.preventDefault();
    if( (cache_list.val() !=='') && (operaciones_list.val() !=='') && (columns_list.val() !=='')){
        tabla_cola_transformation.row.add({"Data":cache_list.val(), 'Campos':columns_list.val(), 'Operations':operaciones_list.val()}).draw();
        cache_list.val('').trigger('change');
        operaciones_list.val('').trigger('change');
        columns_list.val('').trigger('change');
    }else {
        toastr.error('No ha seleccionado');
    }
});


btn_enviar_trnf.click(function (e) {
   e.preventDefault();
    let rows = tabla_cola_transformation.data().toArray();
    sendTransfromation(rows).then( response => {
        if(response) {
            tabla_cola_transformation.clear().draw();
            toastr.success('Realizado Correctamente');
        }
    }).catch(error => {
        console.log(error);
        toastr.error('ocurrio un error');
    });
});

getCacheLista().then(response => {
    $.each(response, function (index, value) {
        cache_list.append('<option value='+value.key+'>'+value.key+'</option>');
    });
}).catch(error =>{
    console.log('error al cargar lista cache'+error);
});

getOperacionesData().then(response =>{
    $.each(response.operation, function (index, value) {
        operaciones_list.append('<option value='+value.name+'>'+value.name+'</option>');
    });
});

cache_list.change(function () {
   if($(this).val()!=='') {
       getColumns($(this).val()).then(response => {
           $.each(response, function (index, value) {
               columns_list.append('<option value=' + value + '>' + value + '</option>');
           });
       }).catch(error => {
           console.log(error);
       });
   }
});

