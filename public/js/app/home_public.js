$( () =>{
    select_dashboard.change( () =>{

        if ( (select_dashboard.val() !== '') && (select_dashboard.val() !==  null)){
            $('#panels_html div').remove();
            grafico = null;
            getGraficos( select_dashboard.val() ).then(data =>{

            }).catch(error =>{

            });
        }
    });
});
let select_dashboard = $('#select_dashboard');
let panels_html = $('#panels_html');
let grafico = null;
let mybar  = null;


//animacion de carga en la peticion xhr con axios
NProgress.configure({ trickle: false, showSpinner: true, parent: '#home_public' });
//fin


select_dashboard.select2({theme:"bootstrap",placeholder:'select dashboard',allowClear: true});

let getGraficos = async (id) =>{
    const response = await axios.get('dashboard/list/getGraphic/'+id);
    generateGraficos( response.data );
};

let generateGraficos = (data) => {
    data.forEach(function (valor, index, array) {
        grafico =JSON.parse(valor);
        let fecha_hora = grafico.hour.split(' ');
        console.log( 'fecha :'+ moment(fecha_hora[0],'DD-MM-YYYY').startOf('day').fromNow() +' hora :'+fecha_hora[1] );
        createPanel(grafico.options.title.text , grafico.element+index, grafico.hour );
        mybar =  new Chart(grafico.element+index, {
            type: grafico.type,
            data: {labels:grafico.labels , datasets:grafico.datasets },
            options:grafico.options
        });
    });

};

/**
 *
 * @param title string
 * @param element string
 * @param fecha string
 */
let createPanel = (title, element, fecha) =>{
    let panel  = " <div class='col-sm-6'> <div class='box box-primary'> ";
    panel += "<div class='box-header with-border'><h3 class='box-title'>"+title+"</h3> </div>";
    panel += "<div class='box-body'> <canvas  id='"+element+"' style='height: 300px;'></canvas></div>";
    // panel += "<div class='box-footer text-left'> <span class='text-muted text-sm'> created at : "+fecha+"</span></div>";
    panel += "</div>";
    panel += "</div>";
    panels_html.append(panel);
};