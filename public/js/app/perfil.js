$( () =>{

    btn_save_pwd.click((e) =>{
        e.preventDefault();
        if ( (ValidSecurePassword()) && (ValidEqualPassword()) ) {
            Save().then(respond =>{
                if ( respond === 'update' ){
                    form_password_user[0].reset();
                    toastr.success('Se actualizo correctamente');
                }
            }).catch(error =>{
                toastr.error('Ocurrio un error al cambiar password');
            });
        }
    });

    txt_password.keypress( () =>{
          return ValidBlank( txt_password );
    });

    txt_re_password.keypress( () =>{
        return ValidBlank( txt_re_password );
    });
});

let form_password_user = $('#form_password_user');
const patron = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/);
let txt_password = $('#txt_password');
let txt_re_password = $('#txt_re_password');
let btn_save_pwd = $('#btn_save_pwd');

let ValidBlank = (object) =>{
    let patron = / /;
    return  patron.test(object.val())? false : true;
};

let ValidSecurePassword = () =>{
   if ( patron.test(txt_password.val()) ){
        return true;
   }else {
       toastr.warning('contraseña no valida');
       txt_re_password.val('');
       txt_password.focus();
       return  false;
    }
};

let ValidEqualPassword = () =>{
    if ( txt_password.val() === txt_re_password.val() ){
        return true;
    }else{
        toastr.error('contraseña no son iguales');
        txt_re_password.val('');
        txt_re_password.focus();
        return false;
    }
};


let Save = async () => {
    const response = await axios.put('changePwd',{ password:txt_password.val()});
    return response.data;
};