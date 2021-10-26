const llamartalleres = new Vue({
        el: '#tallerlist',
        data:{

        	numbreTaller: '',
        	instituto: 'Seleccionar el Instituto',
            materia:'Seleccionar una materia',
            materias: [],
            contenido:[],
        },
        methods:{
        onMateria() {
            let set = this;
            set.materias = [];
            axios.post('/sistema/materiataller', {
                id: set.instituto
            }).then(response => {
                set.materias = response.data;
                console.log(set.materias);
            }).catch(e => {
                console.log(e);
            });
        },
        onContenido(){
            let set = this;
            set.contenido = [];
            axios.post('/sistema/contmateria', {
                id: set.materia
            }).then(response => {
                set.contenido = response.data;
                if (set.contenido == 0) {
                     toastr.error("Esta Materia no tiene contenidos", "Smarmoddle", {
                    "timeOut": "3000"
                });
                    set.materia = 'Seleccionar una materia';
                } 
                //console.log(set.contenido);
            }).catch(e => {
                console.log(e);
            });
        },
       }


});