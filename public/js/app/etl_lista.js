//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#panel_etl_collections_list' });
//fin
let table_lista_collection  =  $('#table_lista_collection');

table_lista_collection.DataTable({
    destroy:true,
    processing: true,
    serverSide: true,
    autoWidth:false,
    scrollCollapse: true,
    responsive:true,
    ajax:'GET/COLLECTION',
    columns: [
        { data: 'key'},
        { data: 'created_at' },
        { data: 'updated_at' },
        { orderable: false ,render:function(data, type, row){
                return '<a href="#"  class="btn btn-danger" onclick="ConfirmDelete('+row.id+',\''+row.key+'\');" title="delete collection"> <i class="fas fa-trash-alt"></i> </a> <a href="#"  class="btn btn-info"   onclick="InfoMessage(\''+row.key+'\');" title="info collection"><i class="fa fa-info-circle" aria-hidden="true"></i></a> ';
            }
        }
    ]

});

/**
 *
 * @param id {number}
 * @param key {string}
 */
function ConfirmDelete(id,key) {
    swal({
        text: "Esta seguro de  Eliminar este registro!!!",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
        closeOnEsc: false,
        closeOnClickOutside: false
    }).then((willDelete) => {
        if ( willDelete )
        {
            Delete(id,key).then( response=> {
                    if(response === 'delete'){
                        table_lista_collection.DataTable().ajax.reload();
                        toastr.success('eliminado correctamente','Alert')
                    }
                }).catch( error =>
                        {
                          console.log(error);
                        }
                 );
        }

    });
}

/**
 *
 * @param id {number}
 * @param key {string}
 * @constructor
 */
let Delete = async (id,key) => {
   const resp = await axios.get(`GET/DEL/${id}/${key}/COLLECTION`);
   return  resp.data;
};

function InfoMessage(key){
   getInfo(key).then(response => {
       mensaje = "<div> <b>Name:</b>"+response.info.name+"<br> <b>Number Registers:</b>"+response.info.count+" <br> <b>size:</b>"+response.info.size+"</div>";
       swal({
           text:"Info",
           content: {
               element: 'p',
               attributes: {
                   innerHTML: mensaje,
               },
           },
           closeOnEsc: false,
           closeOnClickOutside: false,
           icon:"info"
       });
   });
}
let getInfo = async (key) =>{
    const  response = await  axios.get('GET/INFO/'+key.trim()+'/COLLECTION');
    return response.data;
};