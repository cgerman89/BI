$( () =>{


    sel_roles.select2({theme:"bootstrap",placeholder:'role',allowClear: true});

    SetSelRoles();

    table_permisos_users.DataTable({
        processing: true,
        serverSide: true,
        autoWidth:false,
        scrollCollapse: true,
        responsive:true,
        ajax:'getAllUsers',
        columns:[
            { data: 'name'},
            { data: 'email'},
            { data: 'created_at',orderable: false },
            { data: 'updated_at',orderable: false },
            {orderable: false ,render:function(data, type, row){
                    return '<div align="center"> <a href="#"  onclick="ListRoles('+row.id+');"  class="btn btn-sm btn-primary" title="ver roles de usuario"><i class="fas fa-eye"></i></a>&nbsp; </div>  ';

                }
            },
            { orderable: false ,render:function(data, type, row){
                  return '<div align="center">'+
                         '<a href="#" onclick="getDataUser('+row.id+');" class="btn btn-sm btn-success" title="agregar roles de usuario"><i class="far fa-plus-square"></i></a>&nbsp;'+
                         '<a href="#" onclick="AlertDelete('+row.id+');" class="btn btn-sm btn-danger" title="eliminar roles de usuario"><i class="far fa-trash-alt"></i></a>'+
                         '</div>';
                }
            },
        ]

    });

    btn_clean.click((e)=>{
        e.preventDefault();
        CleanForm();
    });

    btn_save.click( (e) =>{
        e.preventDefault();
        if ( FormValid() ){
             Save().then(response => {
                    if (response === 'store'){
                        CleanForm();
                        toastr.success('agregado correctamente');
                    }
             }).catch(error =>{
                    toastr.error('ocurrio un error al agregar rol');
             });
        }else {
           toastr.error('campos obligatorios');
        }

    });
});

let table_permisos_users = $('#table_permisos_users');
let form_users_rol_permissions = $('#form_users_rol_permissions');
let txt_name = $('#txt_name');
let txt_email = $('#txt_email');
let sel_roles = $('#sel_roles');
let list_roles = $('#list_roles');
let modal_list_roles = $('#modal_list_roles');
let btn_save = $('#btn_save');
let btn_clean = $('#btn_clean');
let id = null;


//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent:'#panel_user_permisos_roles' });
//fin

let AlertDelete = (id) =>{
    swal({
        title: "Remover Roles?",
        text: "Esta seguro de  remover roles a este usuario!!!",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
        closeOnEsc: false,
        closeOnClickOutside: false
    }).then((willDelete) => {
        if( willDelete ){
            Destroy(id).then( response =>{
                if( response.data === 'delete')
                {
                   CleanForm();
                   toastr.success('Role(s) eliminado(s) correctamente');
                }
            }).catch( error =>
            {
              toastr.error('Ocurrio un error no se elimino rol','error');
            });
        }
    });
};

/**
 *
 * @param id {int}
 * @constructor
 */
let ListRoles = (id) =>{
    getUserRoles(id).then(response =>{
        list_roles.find('a').remove();
        $.each(response,(index,value) =>{
            list_roles.append('<a href="#" class="list-group-item"> <h4 class="list-group-item-heading text-capitalize">'+value.name+'</h4><p class="list-group-item-text">'+value.description+'</p></a>');
        });
        modal_list_roles.modal('show');
    }).catch(error =>{
        toastr.error('ocurrio un error al listar roles');
    });

};




let getDataUser = (id) =>{
    getUser(id).then(response => {
        SetInputsForm(response);
    }).catch(error =>{
        toastr.error('ocurrio un problema al obtener datos de usuario');
    });
};

let SetInputsForm = (data) =>{
     id = data.id;
     txt_name.val( data.name );
     txt_email.val( data.email );
};

let SetSelRoles = () =>{
    getAllRoles().then(response =>{
         sel_roles.find('option').remove();
         sel_roles.append('<option value="">roles</option>');
         $.each(response,(index,value) =>{
             sel_roles.append('<option value="'+value.id+'">'+value.name+'</option>')
         });
    }).catch(error =>{
        toastr.error('error al listar roles');
    });
};

let getAllRoles = async () =>{
    const response = await axios.get('getRoles');
    return response.data;
};

let getUser = async (id) =>{
    const response = await axios.get(id+'/getUser');
    return response.data;
};

let getUserRoles = async (id) =>{
    const response = await axios.get(id+'/showRoles');
    return response.data;
};

let Save = async () =>{
    const response = await axios.post('store',{id:id,roles:sel_roles.val()});
    return response.data;
};


let Destroy = async (id) =>{
   const response = await axios.delete(id+'/destroy');
   return response;
};


let FormValid = () => {
    if (txt_name.val() === '') {
        return false;
    } else if (txt_email.val() === '') {
        return false;
    } else if (id === null) {
        return false;
    } else if( sel_roles.val().length === 0){
        sel_roles.focus();
        return  false;
    }else {
        return true;
    }
};

let CleanForm = () =>{
    form_users_rol_permissions[0].reset();
    sel_roles.val('').trigger('change');
    id = null;
    table_permisos_users.DataTable().ajax.reload();
};