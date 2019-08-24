$(  () =>{

    SetPermission();
    //table roles datatables
     table_roles.DataTable({
         processing: true,
         serverSide: true,
         autoWidth:false,
         scrollCollapse: true,
         responsive:true,
         ajax:'roles/getAll',
         columns:[
             { data: 'name'},
             { data: 'slug'},
             { data: 'description'},
             { data: 'special'},
             { data: 'created_at'},
             { data: 'updated_at'},
             {orderable: false ,render:function(data, type, row){
                        return '<a href="#" onclick="ListPermissions('+row.id+')" class="btn btn-flat btn-sm bg-olive"  data-toggle="tooltip" title="listar permisos"><i class="fas fa-shield-alt"></i></a>&nbsp;';
                 }
             },
             { width: "10%" ,orderable: false ,render:function(data, type, row){
                     return '<a href="#" onclick="AlertEdit('+row.id+')" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit rol"><i class="far fa-edit"></i></a> '+
                         '<a href="#" onclick="AlertDelete('+row.id+')" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete rol"><i class="far fa-trash-alt"></i></a>';
                 }
             },
         ],
     });

     txt_name.keyup( () =>{
         txt_name.val( txt_name.val().toUpperCase() );
         txt_slug.val( slugify( txt_name.val() ) );
     });

     btn_save_rol.click((e) =>{
         e.preventDefault();
         if ( FormValid() ){
              if ( id != null ){
                  Update(id).then(response =>{
                             if ( response === "update" ){
                                 FormClear();
                                 toastr.success('se actualizo correctamente');
                             }
                  }).catch(error =>{ console.log(error); });
              }else {
                  Save().then(resp =>{
                      if ( resp === 'store' ){
                          FormClear();
                          toastr.success('se guardo correctamente');
                      }
                  }).catch(error => {
                      toastr.error('ocurrio un erro al guardar rol');
                  });
              }

         }else {
            toastr.error('campo obligatorio');
         }
     });
});

let table_roles = $('#table_roles');
let txt_name = $('#txt_name');
let txt_slug = $('#txt_slug');
let txt_descripcion = $('#txt_descripcion');
let btn_save_rol = $('#btn_save_rol');
let sel_special = $('#sel_special');
let list_permissions = $('#list_permissions');
let permissions_check = [];
let id = null;
let modal_list_permissions = $('#modal_list_permissions');
let list_permissions_rol = $('#list_permissions_rol');

//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent:'#row_roles_permisos' });
//fin

let ListPermissions = (id) =>{
    getRolPermisos(id).then(resp =>{
        list_permissions_rol.find('a').remove();
        $.each(resp, (index,value) =>{
            list_permissions_rol.append('<a href="#" class="list-group-item"> <h4 class="list-group-item-heading">'+value.name+'</h4> <p class="list-group-item-text">('+value.description+')</p> </a>');
        });
        modal_list_permissions.modal('show');
    }).catch(error =>{
        toastr.error('ocurrio un error al listar permisos');
    });

};

let AlertEdit = (id) =>{
    swal({
        title: "Editar Registro",
        icon: "info",
        closeOnEsc: false,
        closeOnClickOutside: false,
        buttons: ["Cancelar","Editar"],
    }).then((willEdit) => {
        if ( willEdit ){
            Edit(id).then(response =>{
                FormClear();
                SetForm(response);
            }).catch(error =>{
                toastr.error('Ocurrio un error');
            });
        }
    });
};

let AlertDelete = (id) =>{
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
            Destroy(id).then(response =>{
                if( response === 'delete') {
                    FormClear();
                    toastr.success('eliminado correctamente');
                }
            }).catch(error =>{
                toastr.error('ocurrio un error al eliminar');
            });
        }
    });
};

let slugify = (text) => {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '_')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '_')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
};

/**
 *
 * @param index int
 * @constructor
 */
let Checked = (index) =>{
     if ( $('input:checkbox[id='+index+']').is(':checked') ){
         permissions_check.push( index );
     }else{
         permissions_check.splice( permissions_check.indexOf(index) , 1 );
     }
};

let SetPermission = () =>{
    getAllPermisos().then(resp =>{
        $.each(resp, function (index,value) {
            list_permissions.append('<li class="list-group-item"> <div class="icheck-peterriver"><input type="checkbox" onclick="Checked('+value.id+')" class="permissions_check" id="'+value.id+'" value="'+value.id+'"><label for="'+value.id+'" class="text-capitalize">'+value.name+'<br>('+value.description+')</label> </div> </li>');
        });
    }).catch(error =>{
        toastr.error('error al cargar los pemrisos');
    });
};

let getAllPermisos = async () =>{
    const response = await axios.get('roles/getAllPermission');
    return response.data;
};

let getRolPermisos = async (id) =>{
    const response = await axios.get('roles/'+id+'/getPermissions');
    return response.data;
};

let Edit = async (id) =>{
    const response =  await axios.get('roles/'+id+'/edit');
    return response.data;
};

let Save = async () =>{
    const response = await axios.post('roles/store',{
                                name:txt_name.val(),
                                slug:txt_slug.val(),
                                description:txt_descripcion.val(),
                                special: sel_special.val(),
                                permissions: permissions_check
                           });
    return response.data;
};

/**
 *
 * @param id {int}
 * @returns {Promise<any>}
 * @constructor
 */
let Update = async (id) =>{
    const response = await axios.put('roles/'+id,{
                                name:txt_name.val(),
                                slug:txt_slug.val(),
                                description:txt_descripcion.val(),
                                special: sel_special.val(),
                                permissions: permissions_check
                            });
    return  response.data;
};

/**
 *
 * @param id {int}
 * @returns {Promise<*>}
 * @constructor
 */
let Destroy = async (id) =>{
    const response = await  axios.delete('roles/'+id+'/destroy');
    return response.data;
};

let FormValid = () =>{
    if ( txt_name.val() === '' ){
        txt_name.focus();
        return false;
    } else if ( txt_slug.val() === '' ){
        txt_slug.focus();
        return false;
    } else if ( txt_descripcion.val() === ''){
        txt_descripcion.focus();
        return false;
    }else {
        return true;
    }
};

let SetForm = (data) =>{
    id = data.rol.id;
    txt_name.val(data.rol.name);
    txt_slug.val(data.rol.slug);
    txt_descripcion.val( data.rol.description);
    sel_special.val(data.rol.special).change();
    data.permissions ? SetPermissions(data.permissions) : null ;
};

let SetPermissions = (permissions) =>{
    $.each(permissions, (index, value ) =>{
        $('input:checkbox[id='+value.id+']').prop('checked','checked');
        Checked(value.id);
    });
};

let FormClear = () =>{
    $('#form_roles')[0].reset();
    PermissionsClear();
    id = null;
    sel_special.val('').prop('selected','selected').trigger('change');
    table_roles.DataTable().ajax.reload();
};

let PermissionsClear = () =>{
    $('input:checkbox[class="permissions_check"]:checked').each(() =>{
        $('input:checkbox[class="permissions_check"]').prop( "checked", false );
    });
    permissions_check = [];
};
