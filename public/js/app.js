function init(){
    var $ = el => {
        return el.match(/^#/) ? document.querySelector(el) : document.querySelectorAll(el);
    }
    let mostrarVista = $("[class*='mostrar']");
    console.log( mostrarVista );
    mostrarVista.forEach(element => {
        element.addEventListener('click',e=>{
            e.stopPropagation();

            let modulo = e.srcElement.dataset.modulo,
                form   = e.srcElement.dataset.form;
            fetch(`public/vistas/${modulo}/${form}.html`).then( resp=>resp.text() ).then(resp=>{
                $(`#vista-${form}`).innerHTML = resp;
                
                let btnCerrar = $(`#btn-close-${form}`);
                btnCerrar.addEventListener("click",event=>{
                    $(`#vista-${form}`).innerHTML = "";
                });
                import(`../vistas/${modulo}/${form}.js`).then(module=>{
                    module.modulo();
                });
                init();
            }); 
        });
    });
}
<<<<<<< HEAD
init();
=======
init();
>>>>>>> 917cc60443bfb9d5a66e6001838ea4a6ec6701cc
