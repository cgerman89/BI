let sel_etl = $('#sel_etl');
let sel_dimension = $('#sel_dimension');
let sel_medida = $('#sel_medida');
let sel_operacion = $('#sel_operacion');
let barras = document.getElementById("myChart").getContext('2d');
let mybar  = null;
let btn_chart_bar = $('#btn_chart_load');
let btn_chart_line = $('#btn_chart_line');
let btn_chart_pie = $('#btn_chart_pie');
let btn_print_pdf = $('#btn_print_pdf');
let titulo_grafico = $('#titulo_grafico');
let modal_previa_pdf = $('#modal_previa_pdf');
let url_logo = $('#url_logo');
let pdf_view = $('#pdf_view');
let  doc = new jsPDF();
$('[data-toggle="tooltip"]').tooltip();
GetKeyETL();
getOperations();

sel_etl.change(function () {
    let key = sel_etl.val()  !==''? sel_etl.val() :'-';
    GetColumnsEtl(key);
});

btn_chart_bar.click(function (e) {
    e.preventDefault();

    mybar = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Simple Column Chart with Index Labels"
        },
        data: [{
            type: "column", //change type to bar, line, area, pie, etc
            //indexLabel: "{y}", //Shows y value on all Data Points
            indexLabelFontColor: "#5A5757",
            indexLabelPlacement: "outside",
            dataPoints: [
                { x: 10, y: 71 },
                { x: 20, y: 55 },
                { x: 30, y: 50 },
                { x: 40, y: 65 },
                { x: 50, y: 92, indexLabel: "Highest" },
                { x: 60, y: 68 },
                { x: 70, y: 38 },
                { x: 80, y: 71 },
                { x: 90, y: 54 },
                { x: 100, y: 60 },
                { x: 110, y: 36 },
                { x: 120, y: 49 },
                { x: 130, y: 21, indexLabel: "Lowest" }
            ]
        }]
    });
    mybar.render();

    /*
    if ( ValidaCampos() ){
        getData(sel_etl.val() ,sel_dimension.val() ,sel_medida.val() ,sel_operacion.val(),'bar').then(response =>{
            if (mybar !=null){
                mybar.destroy();
            }
            let datos = { labels:response.labels , datasets:response.datasets };
            mybar = new Chart(barras, {
                type: response.type,
                data: datos,
                options: response.options
            });
        }).catch(error => {
            toastr.error('Ocurrio un Error');
        });
    }else {
        toastr.error('campos requeridos');
    }
 */
});

btn_chart_line.click(function (e) {
    e.preventDefault();
    if ( ValidaCampos() ){
        getData(sel_etl.val() ,sel_dimension.val() ,sel_medida.val() ,sel_operacion.val(),'line').then(response =>{
            if (mybar !=null){
                mybar.destroy();
            }
            //line chart data
            let data = { labels: response.labels, datasets: response.datasets };
            //create Chart class object
            mybar = new Chart(barras, {
                type:response.type,
                data: data,
                options: response.options
            });
        }).catch(error =>{

        });
    }else {
        toastr.error('campos requeridos');
    }

});

btn_chart_pie.click(function (e) {
    e.preventDefault();
    if ( ValidaCampos() ){
        getData(sel_etl.val() , sel_dimension.val() ,sel_medida.val() ,sel_operacion.val(),'pie').then(response =>{
            if (mybar !=null){
                mybar.destroy();
            }
            let datos = { labels:response.labels , datasets:response.datasets };
            mybar = new Chart(barras, {
                type: response.type,
                data: datos,
                options:response.options
            });
        }).catch(error => {

        });
    }else {
        toastr.error('campos requeridos');
    }
});

btn_print_pdf.click(function (e) {
     e.preventDefault();
     mybar.print();

     let url_base64 = document.getElementById('chartContainer');
     console.log(url_base64);
     let pdf = new jsPDF('l', 'cm', 'letter');
    // let width = pdf.internal.pageSize.getWidth() - 5;
    // let height = pdf.internal.pageSize.getHeight() - 8;
    // let imgData = 'data:image/jpeg;base64,'+btoa(url_logo.val());

     // pdf.addImage(imgData,'JPEG',3,0,3,4,'LOW');
    //title
     //pdf.setFontSize(14);
     //pdf.text(21, 2.5,"Reporte Grafico");
    //add image
     pdf.addImage(url_base64,'JPEG',3, 3,width,height,'grafico','LOW');
    //pie doc
    // pdf.setFontSize(9);
    //  pdf.setFont("times");
    //  pdf.setFontStyle("italic");
    //  pdf.text(6, 20,"Usuario: "+user_data.name);
    //  pdf.text(20, 20,"Fecha / Hora: "+Hour_now);

    //generando base64 data imprimir pdf
     let url =  pdf.output('datauristring');
    //agregando al embed el pdf
     pdf_view.attr('src',url);
     // abre modal y muestra pdf
     modal_previa_pdf.modal('show');

});


function getImgFromUrl(logo_url, callback) {
    var img = new Image();
    img.src = logo_url;
    img.onload = function () {
        callback(img);
    };
}

function GetKeyETL(){
    sel_etl.find('option').remove();
    sel_etl.append('<option value="">seleecione</option>');
    axios.get('Bar/KEY/ETL')
        .then(function (response) {
            if(response.status === 200){
               $.each(response.data.keys_etl, function (index, value) {
                    sel_etl.append('<option value='+value+'>'+value+'</option>');
               });
            }
        });
}

function GetColumnsEtl(key) {
    axios.get('Bar/'+key.trim()+'/COLUMNS')
        .then(function (response) {
            if(response.status === 200){
                SetColumnsCombo(sel_dimension,response.data.columns);
                SetColumnsCombo(sel_medida,response.data.columns);
            }
        });
}

function SetColumnsCombo(combo, options){
    combo.find('option').remove();
    combo.append('<option value="">seleecione</option>');
    $.each(options, function (index, value) {
        combo.append('<option value='+value+'>'+value+'</option>');
    });
}

let getData = async (collection,ejeY,ejeX,option,type) =>{
    let url =''+collection+'/'+ejeY+'/'+ejeX+'/'+option+'/'+type+'/getData';
    const resp = await axios.get(url);
    Hour_now = resp.data.hour;
    return resp.data;
};

function getOperations() {
    axios.get('getOperaciones').then(function (response) {
        if(response.status === 200){
           SetColumnsCombo(sel_operacion,response.data);
        }
    });
}

let ValidaCampos = () => {
    if( sel_etl.val()  ==='' ){
        sel_etl.focus();
        return false;
    }else if ( sel_operacion.val() ==='') {
        sel_operacion.focus();
        return false;
    }else  if( sel_dimension.val()  ==='' ){
        sel_dimension.focus();
        return false;
    }else if(  sel_medida.val() === '' ) {
        sel_medida.focus();
        return false;
    }else if( titulo_grafico.val() === ''){
        titulo_grafico.focus();
        return false;
    }else {
       return true;
    }
};