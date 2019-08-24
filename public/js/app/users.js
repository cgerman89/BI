$( () => {
    $('[data-toggle="tooltip"]').tooltip();

    tabla_usuarios.DataTable({
        processing: true,
        serverSide: true,
        autoWidth:false,
        scrollCollapse: true,
        responsive:true,
        "ajax":{
            url: 'users/getAll',
            error: function (jqXHR, textStatus, errorThrown) {
                // Do something here
            }
        },
        "columns":[
            { data: 'name'},
            { data: 'email'},
            { data: 'created_at'},
            { data: 'updated_at'},
            { orderable: false ,render:function(data, type, row){
                    return '<a href="#" onclick="ResetPwd('+row.id+')" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Reset Password"><i class="fas fa-reply"></i></a>&nbsp;'+
                        '<a href="#" onclick="Editar('+row.id+')" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit User"><i class="fas fa-user-edit"></i></a> '+
                        '<a href="#" onclick="Eliminar('+row.id+')" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete User"><i class="fas fa-user-minus"></i></a>';
                }
            },
        ],
    });

    btn_save.click( (e) =>{
        e.preventDefault();
        if ( FormValidate() ){
            id === null ?
                    Save().then(resp =>{
                       if( resp ==='store' ){
                           FormClear();
                           toastr.success('creado correctamente');
                           tabla_usuarios.DataTable().ajax.reload();
                       }
                    }).catch(error => {})
                :
                    Update(id).then(response=>{
                        if ( response === 'update') {
                            FormClear();
                            toastr.success('actualizado correctamente');
                            tabla_usuarios.DataTable().ajax.reload();
                        }
                    }).catch(error=>{
                        console.log(error.toString());
                        toastr.error('ocurrio un error al actualizar');
                    });
        }
    });
});

let tabla_usuarios = $('#tabla_usuarios');
let txt_name = $('#txt_name');
let txt_email = $('#txt_email');
let btn_save = $('#btn_save');
let id = null;



//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent:'#panel_users' });
//fin



/**
 *
 * @param user int
 * @constructor
 */
let Editar = (user) =>{
    swal({
        title: "Editar Registro",
        icon: "info",
        closeOnEsc: false,
        closeOnClickOutside: false,
        buttons: ["Cancelar","Editar"],
    }).then((willEdit) => {
        if ( willEdit ){
            Edit(user).then(response =>{
                SetFormUser(response);
            }).catch(error =>{
                console.log('error get user '+error);
                toastr.error('Ocurrio un error');
            });
        }
    });
};

let Eliminar = (user) => {
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
            Destroy(user).then(response =>{
                console.log(response);
                if( response === 'delete') {
                    toastr.success('eliminado correctamente');
                    tabla_usuarios.DataTable().ajax.reload();
                }
            }).catch(error =>{
                toastr.error('ocurrio algun error al eliminar');
            });
        }
    });
};

/**
 *
 * @param user int
 * @constructor
 */
let ResetPwd = (user) => {
    swal({
        title: "Reset Password",
        content: {
            element: 'p',
            attributes: {
                innerHTML: "Se enviara por <b>Email</b> un  <b>nuevo Password</b> al Usuario, desea <b>Resetear</b>? ",
            },
        },
        icon: "info",
        buttons: ["Cancel", "Reset"],
        closeOnClickOutside: false,
        dangerMode: true,
        closeOnEsc: false,
    }).then((willEdit) => {
        if ( willEdit ) {
            ResetPassword(user).then(resp =>{
                if( resp === 'reset'){
                    toastr.success('reseteo de password correctamente');
                }
            }).catch(error =>{
                toastr.error('ocurrio un error al resetear password');
            });
        }

    });
};

let ResetPassword = async (user) =>{
    const resp = await axios.get('users/'+user+'/resetPwd');
    return  resp.data;
};

let  Edit = async (user) => {
    const response = await axios.get('users/'+user+'/edit');
    return response.data;
};
let Save =  async () =>{
   const response = await axios.post('users/store',{name:txt_name.val(), email:txt_email.val()});
   return response.data;
};

let Destroy = async (user) =>{
    const response = await axios.delete('users/'+user+'/destroy');
    return response.data;
};

let Update = async (user) =>{
    const response = await axios.put('users/'+user,{name:txt_name.val() , email:txt_email.val() });
    return response.data;
};
let SetFormUser = (data) => {
    id = data.id;
    txt_name.val( data.name);
    txt_email.val( data.email);
};

let FormValidate = () => {
    if( txt_name.val() === ''){
         txt_name.focus();
         toastr.error('campo obligatorio');
         return false;
    }else if( txt_email.val() === '' ){
         txt_email.focus();
         toastr.error('campo obligatorio');
         return false;
    }else if( txt_email.val() ){
        if  ( !validateEmail( txt_email.val() ) ){
                txt_email.focus();
                toastr.error('ingrese email valido');
                return false;
        }else{
           return true;
        }
    }
};

let FormClear = () =>{
    $('#form_user')[0].reset();
    id = null;
};

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}