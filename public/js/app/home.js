
//configuracion axios peticiones y Nprogres
axios.interceptors.request.use(function(config) {
    NProgress.start();
    return config;
},function(error) {
    NProgress.remove();
    return Promise.reject(error);
});
axios.interceptors.response.use(function(response) {
    NProgress.done();
    return response;
}, function(error) {
    NProgress.remove();
    return Promise.reject(error);
});

// configuraciones de ajax spogres

$(document).ajaxStart( () =>{
   NProgress.start();
});
$(document).ajaxSuccess( () =>{
    NProgress.done();
});
$(document).ajaxError(() =>{
    NProgress.remove();
});
