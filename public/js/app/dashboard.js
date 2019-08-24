$( () =>{

 $('#table_my_dashboard').DataTable({
     "autoWidth":true,
     "responsive":true,
     "searching":false,
     "ordering":false,
     "lengthChange":false,
     "ajax":'allDashboard',
     columns: [
         { data: 'name'},
         { data: 'description'},
         { orderable: false ,render:function(data, type, row){
                 return '<a href="#"   onclick="Editar('+row.id+')" class="btn btn-sm btn-warning" title="edit"><i class="fa fa-edit"></i></a> ' +
                        '<a href="#"  onclick="alertDelete('+row.id+')" class="btn btn-sm btn-danger" title="delete connection"> <i class="far fa-trash-alt"></i> </a>';
             }
         }
     ],

});

btn_add_workspace.click( (e) =>{
    e.preventDefault();
    modal_add_dashboard.modal('show');
});
btn_save_dashboard.click( (e) =>{
    e.preventDefault();
    if( FormValidate() ){
       if( id_dash !== null){
           Update().then(response =>{
               if( response ==='update') {
                   toastr.success('actualizado correctamente');
                   form_save_dashboard[0].reset();
                   id_dash = null;
                   $('#table_my_dashboard').DataTable().ajax.reload();
               }
           }).catch(error =>{
               if ( error.response.status === 403 )
                    toastr.error('Acción no autorizada','403');
           });
       }else{
           Save().then(response =>{
               if( response ==='store') {
                   toastr.success('se guardo correctamente');
                   form_save_dashboard[0].reset();
                   $('#table_my_dashboard').DataTable().ajax.reload();
               }
           }).catch(error =>{
               if ( error.response.status === 403 )
                    toastr.error('Acción no autorizada','403');
           });
       }
    }else{
       toastr.error('campo requerido');
    }

});
modal_add_dashboard.on('hidden.bs.modal', (e) => {
    e.preventDefault();
    form_save_dashboard[0].reset();
});

//end
});

let btn_add_workspace = $('#btn_add_workspace');
let modal_add_dashboard = $('#modal_add_dashboard');
let btn_save_dashboard = $('#btn_save_dashboard');
let form_save_dashboard = $('#form_save_dashboard');
let name = $('#name');
let description = $('#description');
let id_dash = null;

//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#panel_dashboard' });
//fin

/**
 *
 * @param id int
 *
 */
let Editar = (id) =>{
   Edit(id).then(response =>{
       if( response !==null ) {
          id_dash = response[0].id;
          name.val( response[0].name );
          description.val( response[0].description );
          modal_add_dashboard.modal('show');
       }
   }).catch(error =>{
       if ( error.response.status === 403 )
           toastr.error('Acción no autorizada','403');
   });
};

/**
 *
 * @param id int
 *
 */
let alertDelete = (id) => {
    swal({
        title: "Eliminar?",
        text: "Esta seguro de  Eliminar este registro!!!",
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
                     $('#table_my_dashboard').DataTable().ajax.reload();
                 }
            }).catch(error =>{
                if ( error.response.status === 403 )
                    toastr.error('Acción no autorizada','403');
            });
        }
    });
};

let Edit = async (id) =>{
    const response = await axios.get('edit/'+id);
    return response.data;
};

let Save = async () =>{
    const resp = await axios.post('store',{name:name.val(),description:description.val()});
    return resp.data;
};

let Update = async  () =>{
   const response = await axios.put(id_dash+'/update',{name:name.val(),description:description.val()});
   return response.data;
};

let Delete = async (id) => {
   const response = await axios.delete(id+'/delete');
   return response.data;
};

let FormValidate = () =>{
    if (name.val() === ''){
        name.focus();
        return false;
    }else if( description.val() ===''){
        description.focus();
        return  false;
    }else{
        return true;
    }
};