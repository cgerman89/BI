$( () =>{
  //load DOM
    table_graficos.DataTable({
        "autoWidth":true,
        "responsive":true,
        "ordering":false,
        "lengthChange":false,
        "ajax":'AllGraphic',
        columns: [
            { data: 'type'},
            { data: 'operation'},
            { data: 'key_data'},
            { data: 'dimension'},
            { data: 'medida'},
            { data: 'title_graphic'},
            { data: 'title_dataset'},
            { render:
                function(data, type, row){
                   return '<a href="#"  onclick=" AlertDelete('+row.id+')" class="btn btn-sm btn-danger" title="eliminar grafico"> <i class="far fa-trash-alt"></i> </a>';
                }
            }
        ],
        "columnDefs": [
            {
                "targets": [0],
                "render":function(data) {
                    if ( data === 'bar'){
                        return "<span> <i class='fas fa-chart-bar'></i> Bar</span>";
                    }else if( data === 'pie'){
                        return " <span> <i class='fas fa-chart-pie'></i> Pie</span>";
                    }else if( data ==='line'){
                        return "  <span> <i class='fas fa-chart-line'></i> Line</span> ";
                    }

                }
            },
        ],
    });
});
let table_graficos = $('#table_graficos');

//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#panel_list_graficos' });
//fin


let AlertDelete = (id) =>{
    swal({
        title: "Eliminar",
        text: "Esta seguro de eliminar este registro!!!",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
        closeOnEsc: false,
        closeOnClickOutside: false
    }).then((willDelete) => {
        if( willDelete ){
            Delete(id).then(response =>{
                console.log(response);
                if( response === 'delete') {
                    toastr.success('eliminado correctamente');
                    table_graficos.DataTable().ajax.reload();
                }
            }).catch(error =>{
                toastr.error('ocurrio algun error al eliminar');
            });
        }
    });
};

/**
 *
 * @param  id int
 * @constructor
 */
let Delete = async (id)  => {
  const response = await axios.delete(id+'/delete');
  return response.data;
};
