(function(){

    var formulario = document.formulario_registro,
        elementos = formulario.elements;
    
   
    
    var validarInputs = function(){
        for (var i = 0; i < elementos.length; i++) {
           
            if (elementos[i].type == "text" | | elementos[i].type == "email" || elementos[i].type == "password") {
           
                if (elementos[i].value.length == 0) {
                    console.log('El campo ' + elementos[i].name + ' esta incompleto');
                    elementos[i].className = elementos[i].className + " error";
                    return false;
                } else {
                    elementos[i].className = elementos[i].className.replace(" error", "");
                }
            }
        }
    
        
        if (elementos.pass.value !== elementos.pass2.value) {
            elementos.pass.value = "";
            elementos.pass2.value = "";
            elementos.pass.className = elementos.pass.className + " error";
            elementos.pass2.className = elementos.pass2.className + " error";
        } else {
            elementos.pass.className = elementos.pass.className.replace(" error", "");
            elementos.pass2.className = elementos.pass2.className.replace(" error", "");
        }
    
        return true;
    };
    
   
    
    
    
    var enviar = function(e){
        if (!validarInputs()) {
            console.log('Falto validar los Input');
            e.preventDefault();
       
    .parentElement.children[0].className = this.parentElement.children[0].className + " error";
        }

    
    }())