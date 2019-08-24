
//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#panel_connections' });

//fin

let form_connection = $('#form_connection');
let dbms_id = $('#dbms_id');
let id_conn = 0;

GetInfoDBMS();
GetDbms();


TableConnections();

$('#btn_save').click(function (e) {
    form_connection.validate({
        rules: {
            dbms_id:{required: true},
            host:{required: true},
            username:{required: true},
            db_password:{required:true},
            dbname:{required:true},
            port:{required:true,number:true}
        },
        messages: {
            dbms_id:"seleccione su gestor DBMS",
            host: "ingrese su host",
            username:"ingrese su username",
            db_password: "ingrese la contraseña",
            dbname:"database name requqrido",
            port:"port requerido"
        },
        submitHandler:function (form) {
            e.preventDefault();
            id_conn === 0 ? Save(): Update();
        }
    });

});


function LLenaForm(data) {
   id_conn = data.id;
   $('#dbms_id').val(data.collecction_id).prop('selected','selected').trigger('change');
   $('#host').val(data.host);
   $('#username').val(data.username);
   $('#db_password').val(data.dbpassword);
   $('#dbname').val(data.dbname);
   $('#port').val(data.port);
}

function AlertDelete(id){
    swal({
        title: "Eliminar Conexion?",
        text: "Esta seguro de  Eliminar este registro!!!",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
        closeOnEsc: false,
        closeOnClickOutside: false
    }).then((willDelete) => {
           willDelete ? Delete(id): null;
    });
}

function EditarConnection(id){
    swal({
        title: "Editar Registro",
        icon: "info",
        closeOnEsc: false,
        closeOnClickOutside: false,
        buttons: ["Cancelar","Editar"],
    }).then((willEdit) => {
        willEdit ? Edit(id) : null;
    });

}

function Connection(id) {
    swal({
        title:'Conectar a Esta Base?',
        icon:'info',
        closeOnEsc: false,
        closeOnClickOutside: false,
        closeModal: false,
        buttons:{
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: "Connect",
                value: true,
                visible: true,
                className: "",
                closeModal: false
            },
        },
    }).then((willConect) => {
        if(willConect) {
            axios.get('Connections/'+id+'/Connect')
                .then(function (response) {
                    if (response.status === 200) {
                       if(response.data ==='Error'){
                            swal("Error!",'Ocurrio un error, revise parametros de conexion', "error");
                        }else if(response.data ==='Success'){
                            swal("Connect", "Connexion exitosa!!", "success");
                            window.location.href = '/home';
                        }
                    }
                }).catch(function (error) {
                    console.log(error);
                });
        }
    }).catch(err => {
            if (err) {
                swal("Oh noes!", "The AJAX request failed!", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
    });
}

/**
 * delete a  register the type connection
 * @param id {number}
 * @constructor
 */
function Delete(id){
    axios.delete('Connections/'+id+'/delete').then(function (response) {
        if(response.status === 200){
            if(response.data.result === false) {
                toastr.error('ha ocurrido un error');
            }
            toastr.success('Eliminado Correctamente')
            $('#connections_table').DataTable().ajax.reload();
        }
    });
}

/**
 * save register
 * @constructor
 */
function Save() {
    axios.post('Connections/store',{
        collecction_id:$('#dbms_id').val(),
        host:$('#host').val(),
        username:$('#username').val(),
        dbpassword:$('#db_password').val(),
        dbname:$('#dbname').val(),
        port:$('#port').val()
    }).then(function (response){
        if(response.status === 200){
           if(response.data ==='Created') {
               form_connection[0].reset();
               $('#connections_table').DataTable().ajax.reload();
               toastr.success('Creado correctamente');
           }
        }
    }).catch(function (error) {
        if ( error.response.status === 403 )
            toastr.error('Acción no autorizada','403');
    });


}

/**
 * update data register
 * @constructor
 */
function Update(){
   axios.put('Connections/'+id_conn+'',{
       collecction_id:$('#dbms_id').val(),
       host:$('#host').val(),
       username:$('#username').val(),
       dbpassword:$('#db_password').val(),
       dbname:$('#dbname').val(),
       port:$('#port').val()
   }).then(function (response) {
       if(response.status === 200){
           console.log(response);
           if( response.data === 'Update'){
               id_conn=0;
               form_connection[0].reset();
               $('#connections_table').DataTable().ajax.reload();
               toastr.success('Actualizado correctamente');
           }else{
               toastr.error('ocurrio un error!!!');
           }
       }
   }).catch(function (error) {
       if ( error.response.status === 403 )
           toastr.error('Acción no autorizada','403');
   });
}

/**
 * get data the connection
 * @param id {number}
 * @constructor
 */
function Edit(id) {
    axios.get('Connections/'+id+'/edit')
        .then(function (response) {
           if(response.status === 200){
              LLenaForm(response.data);
           }
        }).catch(error =>{
        if ( error.response.status === 403 )
            toastr.error('Acción no autorizada','403');
    });
}

/**
 * get dbms list
 * @constructor
 */
function GetDbms() {
    dbms_id.find('option').remove();
    dbms_id.append('<option value="">select dbms</option>');
    axios.get('DBC/GetDBMS')
        .then(function (response) {
            if(response.status === 200){
                $.each(response.data, function (index, value) {
                    dbms_id.append('<option value='+index+'>'+value+'</option>');
                });
            }
        });
}

function TableConnections(){
    $('#connections_table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth:false,
        scrollCollapse: true,
        responsive:true,
        ajax: {
            url: 'Connections/get_data',
            error: function (jqXHR, textStatus, errorThrown) {
                if ( jqXHR.status === 403 )
                    toastr.error('Acción no autorizada ','403');
            }
        },
        columns: [
            { data: 'collection.name'},
            { data: 'host'},
            { data: 'username'},
            { data: 'dbname' },
            { data: 'port'},
            { orderable: false ,render:function(data, type, row){
                    return '<a href="#" onclick="Connection('+row.id+')" class="btn btn-sm btn-primary"  title="connection"><i class="fa fa-plug"></i></a> <a href="#"   onclick="EditarConnection('+row.id+')" class="btn btn-sm btn-warning" title="edit connection"><i class="fa fa-edit"></i></a> ' +
                        '<a href="#"  onclick="AlertDelete('+row.id+')" class="btn btn-sm btn-danger" title="delete connection"> <i class="far fa-trash-alt"></i> </a>';
                }
            }
        ],
});
}

function GetInfoDBMS(){
    axios.get('Connections/get_info').then(function (response){
        if(response.status === 200){
            $('#sp_dbms').val('mmmmmm');
            $('#lbl_dbname').val(response.data.dbname);
        }
    });
}