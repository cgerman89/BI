$( () =>{
    table_permisos.DataTable({
        processing: true,
        serverSide: true,
        autoWidth:false,
        scrollCollapse: true,
        responsive:true,
        "ajax":'permission/getAll',
        "columns":[
            { data: 'name'},
            { data: 'slug'},
            { data: 'description'},
            { data: 'created_at'},
            { data: 'updated_at'},
            { orderable: false ,render:function(data, type, row){
                    return '<a href="#" onclick="AlertEdit('+row.id+')" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit permiso"><i class="far fa-edit"></i></a> '+
                           '<a href="#" onclick="AlertDelete('+row.id+')" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete permiso"><i class="far fa-trash-alt"></i></a>';
                }
            },
        ],
    });

    btn_save_permiso.click( (e) =>{
        e.preventDefault();
        if ( ValidForm() ){
            id === null ?
                Save().then(response =>{
                    if ( response === 'store' ){
                         FormClear();
                         toastr.success('creado correctamente');
                    }
                }).catch(error =>{
                    toastr.error('ocurrio un error al crear permiso');
                })
            :
                Update(id).then(response =>{
                    if ( response === 'update' ){
                        FormClear();
                        toastr.success('actualizado correctamente');
                    }
                }).catch(error =>{
                    toastr.error('ocurrio un error al actualizar permiso');
                });
        }else {
           toastr.error('campo obligatorio');
        }
    });

});

let table_permisos = $('#table_permisos');
let txt_name = $('#txt_name');
let txt_slug = $('#txt_slug');
let txt_description = $('#txt_description');
let btn_save_permiso = $('#btn_save_permiso');
let id = null;

//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent:'#panel_permisos' });
//fin

$('[data-toggle="tooltip"]').tooltip();


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
                SetForm(response);
            }).catch(error =>{
                console.log('error get permission '+error);
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
                    toastr.success('eliminado correctamente');
                    table_permisos.DataTable().ajax.reload();
                }
            }).catch(error =>{
                toastr.error('ocurrio un error al eliminar');
            });
        }
    });
};


let Edit = async (id) =>{
   const resp = await axios.get('permission/'+id+'/edit');
   return resp.data;
};

let Update =  async (id) =>{
    const resp = await axios.put('permission/'+id,{
                             name:txt_name.val(),slug:txt_slug.val(),description:txt_description.val() });
    return resp.data;
};

let Destroy = async (id) => {
    const resp = await axios.delete('permission/'+id+'/destroy');
    return resp.data;
};

let Save = async () =>{
    const resp = await axios.post('permission/store',{name:txt_name.val(),slug:txt_slug.val(), description: txt_description.val()});
    return resp.data;
};

let ValidForm = () => {
    if (txt_name.val() === '') {
        txt_name.focus();
        return false;
    } else if (txt_slug.val() === '') {
        txt_slug.focus();
        return false;
    }else if( txt_description.val() === '' ){
         txt_description.focus();
         return  false;
    }else{
        return true;
    }
};

let SetForm = (data) =>{
    id = data.id;
    txt_name.val(data.name);
    txt_slug.val(data.slug);
    txt_description.val( data.description);
};

let FormClear = () =>{
    $('#form_permisos')[0].reset();
    id = null;
    table_permisos.DataTable().ajax.reload();
};