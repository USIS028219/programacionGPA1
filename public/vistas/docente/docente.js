var $ = el => document.querySelector(el),
    frmdocente = $("#frmdocente");
frmdocente.addEventListener("submit",e=>{
    e.preventDefault();
    e.stopPropagation();

    let docente = {
        accion    : 'nuevo',
        codigo    : $("#txtCodigodocente").value,
        nombre    : $("#txtNombredocente").value,
        direccion : $("#txtDirecciondocente").value,
        telefono  : $("#txtTelefonodocente").value
    };
    fetch(`private/Modulos/docente/procesos.php?proceso=recibirDatos&docente=${JSON.stringify(Docente)}`).then( resp=>resp.json() ).then(resp=>{
        $("#respuestadocente").innerHTML = `
            <div class="alert alert-success" role="alert">
                ${resp.msg}
            </div>
        `;
    });
}); 