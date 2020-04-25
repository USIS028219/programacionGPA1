ue.component('v-select', VueSelect.VueSelect);

var appPuestos = new Vue({

    el:'#frmEstatus',

    data:{

        Puestos:{

            id_estatus  :   '',
            accion              :   $("#frmEstatus").data("accion"),
            estatus              :   '',
            msg                 :   ''

        }

    },
    methods:{

        guardarEstatus:function(){

            console.log(JSON.stringify(this.Estatus));
            
            fetch(`PRIVATE/Module/Estatus/Proceso.php?proceso=recibirDatos&Puestos=${JSON.stringify(this.Estatus)}`).then( resp=>resp.json() ).then(resp=>{
                this.Estatus.msg = resp.msg;
                this.Estatus.id_estatus = 0;
                this.Estatus.estatus = '';
                this.Estatus.accion = 'nuevo';
                
            });

        },
       

    }
    
});


    
    