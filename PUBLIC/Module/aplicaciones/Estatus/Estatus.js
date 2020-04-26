Vue.component('v-select', VueSelect.VueSelect);

var appEstatus = new Vue({

    el:'#frmEstatus',

    data:{

        Estatus:{

            idEstatus :   '',
            accion              :   $("#frmEstatus").data("accion"),
            Estatus             :   '',
            msg                 :   ''

        }

    },
    methods:{

        guardarEstatus:function(){

            console.log(JSON.stringify(this.Estatus));
            
            fetch(`PRIVATE/Module/Estatus/Proceso.php?proceso=recibirDatos&Estatus=${JSON.stringify(this.Estatus)}`).then( resp=>resp.json() ).then(resp=>{
                this.Estatus.msg = resp.msg;
                this.Estatus.idEstatus = 0;
                this.Estatus.Estatus = '';
                this.Estatus.accion = 'nuevo';
                
            });

        },

    }
    
});

