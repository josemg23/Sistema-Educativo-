//const { update } = require("lodash");

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////FUNCIONES/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const funciones = new Vue({
   data:{
        options: objeto,
        cuentas: cuentas,

      },
      methods:{
        obtenerNombre(id){
        let cuenta = this.cuentas.filter(x => x.id == id);
        let nombre = cuenta[0].nombre;
        return nombre;

        },
    formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
    },
    VueSweetAlert2(component,propsData)
    {
        Swal.fire({
            html: '<div id="VueSweetAlert2"></div>',
            showConfirmButton: false,
            showCloseButton: true,
            customClass: 'swal-wide',
            willOpen: () => {
                let ComponentClass = Vue.extend(Vue.component(component));
                let instance = new ComponentClass({
                    propsData: propsData,
                });
                instance.$mount();
                document.getElementById('VueSweetAlert2').appendChild(instance.$el);
            }
        });
    },
    horasExtras(horas, sueldo){
      let total = 0;
      let horaTrabajo = Number(sueldo) / 30 / 8;
      horas.forEach(function(hora){           
        total += Number(hora.dia) * horaTrabajo * 1.50;  
      });
      return total;
      },

    impuestoAgregado(sueldo, deduciones,fraccion, impuesto_fraccion, interes){
      let total = 0;
      let iies = (sueldo * 9.45) / 100;
      let ingreso_liquido =  sueldo - iies;
      let ingreso_mensual = ingreso_liquido - deduciones;
      let ingreso_anual = ingreso_mensual * 12;
      let fraccion_excedente = ingreso_anual - fraccion;
      let fraccion_excedenteiva = (fraccion_excedente * interes) / 100;
      let total_impuesto = impuesto_fraccion + fraccion_excedenteiva;
      total = total_impuesto / 12;
      
      return Number(total).toFixed(2);
      },

      prestamoHipotecario(valor, tiempo, interes){
      let total = 0;
      let division = Number(valor) / Number(tiempo);
      let porcentaje = (division * Number(interes)) / 100;

      let subtotal = division + porcentaje;
      total = subtotal / 12;

      return Number(total).toFixed(2);
      },
      prestamoQuirografario(valor, meses, interes){
        let total = 0;
      let division = Number(valor) / Number(meses);
      let porcentaje = (division * Number(interes)) / 100;

      total = division + porcentaje;
      

      return Number(total).toFixed(2);
      }
    }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////BALANCE INICIAL HORIZONTAL/////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const b_hori = new Vue({
        el: '#b_horizontal',
        data:{
        options: objeto,
        cuentas: cuentas,
        id_taller: taller,
        tipo: 'horizontal',
        //diarios:[],
        update:0,
        balance_inicial:{ //Nombre y fecha del balance inicial
          nombre:'',
          fecha:''
        },
        patrimonio:{ //Asignar Patrimonio
          nom_cuenta:'',
          cuenta_id:'',
          saldo:'',
        },
        //diarios2:[],
        total_balance_inicial:{ //Totales de activo, pasivo y patrimonio
          t_activo:'',
          t_pasivo:'',
          t_patrimonio_pasivo:''
        },
        b_initotal:{
            t_a_corriente:'', //Total de activo corriente
            t_a_nocorriente:'', //Total de activo no corriente
            t_p_corriente:'', //Total de pasivo corriente
            t_p_no_corriente:'', //Total de pasivo no corriente
            t_patrimonio:'' //Total de patrimonio
        },
        a_corrientes:[], //Array de activos corrientes
        a_nocorrientes:[], //Array de activos no corrientes
        p_corrientes:[], //Array de pasivos corrientes
        p_nocorrientes:[], //Array de pasivos no corrientes
        patrimonios:[], //Array de patrimonios
        registro:{
          activo_corriente:'',
          activo_nocorriente:'',
          pasivo_corriente:'',
          pasivo_nocorriente:'',
          patrimonio:'',
        },
        activo:{
          a_corriente:
            { //Agregar un nuevo activo corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'', 
                edit:false,             
              },
          a_nocorriente:
            { //Agregar un nuevo activo no corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'',
                edit:false,
              },
        },
        bi:{
          const_id:''
        },
        pasivo:{
          p_corriente:
            { //Agregar un nuevo pasivo corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'',
                edit:false,
                total:''
              },
          p_nocorriente:
            { //Agregar un nuevo pasivo no corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'',
                edit:false,
                total:''
              }
        }, 
  },
  mounted: function(){
    this.cambioActivo();
    this.cambioActivoNo();
    this.cambioPasivo();
    this.cambioPasivoNo();
    this.cambioPatrimonio();
    this.TotalActivo();
    this.TotalPasivo();
    this.obtenerBalance();
  },
   methods:{
  decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
    calculadora(){
     let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    abrirActivoC(){
      this.limpiar();
      $('#bih-transaccion').modal('show');
      $('#nav-bih-activo-corriente-tab').tab('show')
      // $('#kardex-promedio-ingreso-edit-tab').tab('show')

    },
      abrirActivoNoC(){
        this.limpiar();
      $('#bih-transaccion').modal('show');    
      $('#nav-bih-activo-no-corriente-tab').tab('show')

    },
      abrirPasivoC(){
        this.limpiar();
      $('#bih-transaccion').modal('show');
      $('#nav-bih-pasivo-corriente-tab').tab('show')

    },
      abrirPasivoNoC(){
        this.limpiar();
      $('#bih-transaccion').modal('show');
      $('#nav-bih-pasivo-no-corriente-tab').tab('show')

    },
      abrirPatrimonio(){
        this.limpiar();
      $('#bih-transaccion').modal('show');
     
      $('#nav-bih-patrimonio-tab').tab('show')

    },
    
//ELIMINAR ELEMENTOS DE UN ARRAY /////////
    deleteAcCooriente(index){
     let nombre = this.a_corrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.a_corrientes.splice(index, 1);   
          this.cambioActivo();                  
          this.TotalActivo();  
          this.limpiar();  
        }
      });
    },
                   
  
     deletePaCooriente(index){
      let nombre = this.p_corrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
       
      this.p_corrientes.splice(index, 1);
      this.cambioPasivo();
      this.TotalPasivo(); 
      this.limpiar();
        }
      });

    },
     deleteAcNoCooriente(index){
      let nombre = this.a_nocorrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.a_nocorrientes.splice(index, 1);
      this.cambioActivoNo();
      this.TotalActivo();
      this.limpiar();
        }
      });

    },
     deletePaNoCooriente(index){
      let nombre = this.p_nocorrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.p_nocorrientes.splice(index, 1);
      this.cambioPasivoNo();
      this.TotalPasivo();
      this.limpiar();
        }
      });
 
    },
     deletePatrimonio(index){
      let nombre = this.patrimonios[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.patrimonios.splice(index, 1);
      this.cambioPatrimonio();
      this.limpiar();
        }
      });
    
    },
    limpiar(){ //LIMPIAR TODOS LOS CAMPOS DE ACTIVOS PASIVOS Y PATRIMONIOS
      this.pasivo.p_corriente.cuenta_id   = '';
      this.pasivo.p_corriente.saldo       = '';
      this.pasivo.p_nocorriente.cuenta_id = '';
      this.pasivo.p_nocorriente.saldo     = '';
      this.activo.a_corriente.cuenta_id   = '';
      this.activo.a_corriente.saldo       = '';
      this.activo.a_nocorriente.cuenta_id = '';
      this.activo.a_nocorriente.saldo     = '';
      this.pasivo.p_corriente.edit        =  false;
      this.pasivo.p_nocorriente.edit      =  false;
      this.activo.a_corriente.edit        =  false;
      this.activo.a_nocorriente.edit      =  false;
      this.patrimonio.edit                =  false;
      this.bi.const_id                    = '';

      },
      agregarActivoCorriente(){
           if(this.activo.a_corriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.activo.a_corriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var a_corriente ={cuenta_id:this.activo.a_corriente.cuenta_id, nom_cuenta:nombre, saldo:this.activo.a_corriente.saldo}
            this.a_corrientes.push(a_corriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.activo.a_corriente.cuenta_id =''
           this.activo.a_corriente.saldo     =''
           this.cambioActivo(); 
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editAcorriente(index){
       this.limpiar();
       this.activo.a_corriente.edit      = true;
       this.registro.a_corriente         = index;
       this.bi.const_id                  = this.a_corrientes[index].cuenta_id;
       this.activo.a_corriente.cuenta_id = this.a_corrientes[index].cuenta_id;
       this.activo.a_corriente.saldo     = this.a_corrientes[index].saldo;
        $('#bih-transaccion').modal('show');
        $('#nav-bih-activo-corriente-tab').tab('show')
              
      },
      actualizarActivoC(){
          if(this.activo.a_corriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.activo.a_corriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                          = funciones.obtenerNombre(id);
            let index                           = this.registro.a_corriente;
            this.a_corrientes[index].cuenta_id  = this.activo.a_corriente.cuenta_id;
            this.a_corrientes[index].nom_cuenta = nombre;
            this.a_corrientes[index].saldo      = this.activo.a_corriente.saldo;
            this.activo.a_corriente.cuenta_id   =''
            this.activo.a_corriente.saldo       =''
            this.activo.a_corriente.edit        = false;
            this.registro.a_corriente           = '';
            this.cambioActivo();
          }
      }
    },
    cancelarEdicionActivoC(){
      this.activo.a_corriente.cuenta_id =''
      this.activo.a_corriente.saldo     =''
      this.activo.a_corriente.edit      = false;
    },
    agregarActivoNoCorriente(){
         if(this.activo.a_nocorriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.activo.a_nocorriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var a_nocorriente ={cuenta_id:this.activo.a_nocorriente.cuenta_id, nom_cuenta:nombre, saldo:this.activo.a_nocorriente.saldo}
            this.a_nocorrientes.push(a_nocorriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.activo.a_nocorriente.cuenta_id =''
           this.activo.a_nocorriente.saldo     =''
           this.cambioActivoNo(); 
         }
           }                      
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editNoAcorriente(index){
        this.limpiar();
       this.activo.a_nocorriente.edit       = true;
       this.registro.a_nocorriente          = index;
       this.bi.const_id                     = this.a_nocorrientes[index].cuenta_id;
       this.activo.a_nocorriente.cuenta_id  = this.a_nocorrientes[index].cuenta_id;
       this.activo.a_nocorriente.saldo      = this.a_nocorrientes[index].saldo;
        $('#bih-transaccion').modal('show');
        $('#nav-bih-activo-no-corriente-tab').tab('show');           
      },
      actualizarActivoNC(){
        if(this.activo.a_nocorriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.activo.a_nocorriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
             let nombre                            = funciones.obtenerNombre(id);
             let index                             = this.registro.a_nocorriente;
             this.a_nocorrientes[index].cuenta_id  = this.activo.a_nocorriente.cuenta_id;
             this.a_nocorrientes[index].nom_cuenta = nombre;
             this.a_nocorrientes[index].saldo      = this.activo.a_nocorriente.saldo;
             this.activo.a_nocorriente.cuenta_id   =''
             this.activo.a_nocorriente.saldo       =''
             this.activo.a_nocorriente.edit        = false;
             this.registro.a_nocorriente           = '';
          this.cambioActivoNo();
          }
      }
    },
    cancelarEdicionActivoNC(){
      this.activo.a_nocorriente.cuenta_id  =''
      this.activo.a_nocorriente.saldo      =''
      this.activo.a_nocorriente.edit       = false;
    },

    agregarPasivoCorriente(){
           if(this.pasivo.p_corriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.pasivo.p_corriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var p_corriente ={cuenta_id:this.pasivo.p_corriente.cuenta_id, nom_cuenta:nombre, saldo:this.pasivo.p_corriente.saldo}
            this.p_corrientes.push(p_corriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.pasivo.p_corriente.cuenta_id ='';
           this.pasivo.p_corriente.saldo     ='';
           this.cambioPasivo();
               
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPcorriente(index){
        this.limpiar();
       this.pasivo.p_corriente.edit      = true;
       this.registro.p_corriente         = index;
       this.bi.const_id                  = this.p_corrientes[index].cuenta_id;
       this.pasivo.p_corriente.cuenta_id = this.p_corrientes[index].cuenta_id;
       this.pasivo.p_corriente.saldo     = this.p_corrientes[index].saldo;
        $('#bih-transaccion').modal('show');
        $('#nav-bih-pasivo-corriente-tab').tab('show')
              
      },
      actualizarPasivoC(){
          if(this.pasivo.p_corriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.pasivo.p_corriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.p_corriente;
            this.p_corrientes[index].cuenta_id = this.pasivo.p_corriente.cuenta_id;
            this.p_corrientes[index].nom_cuenta    = nombre;
            this.p_corrientes[index].saldo     = this.pasivo.p_corriente.saldo;
            this.pasivo.p_corriente.cuenta_id  =''
            this.pasivo.p_corriente.saldo      =''
            this.pasivo.p_corriente.edit       = false;
            this.registro.p_corriente          = '';
          this.cambioPasivo();
          }
      }
    },
    cancelarEdicionPcorriente(){
      this.pasivo.p_corriente.cuenta_id =''
      this.pasivo.p_corriente.saldo      =''
      this.pasivo.p_corriente.edit      = false;
    },

    agregarPasivoNoCorriente(){
           if(this.pasivo.p_nocorriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.pasivo.p_nocorriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var p_nocorriente ={cuenta_id:this.pasivo.p_nocorriente.cuenta_id, nom_cuenta:nombre, saldo:this.pasivo.p_nocorriente.saldo}
            this.p_nocorrientes.push(p_nocorriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.pasivo.p_nocorriente.cuenta_id ='';
           this.pasivo.p_nocorriente.saldo     ='';
           this.cambioPasivoNo();
               
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPNocorriente(index){
        this.limpiar();
       this.pasivo.p_nocorriente.edit      = true;
       this.registro.p_nocorriente    = index;
       this.bi.const_id                  = this.p_nocorrientes[index].cuenta_id;
       this.pasivo.p_nocorriente.cuenta_id = this.p_nocorrientes[index].cuenta_id;
       this.pasivo.p_nocorriente.saldo     = this.p_nocorrientes[index].saldo;
        $('#bih-transaccion').modal('show');
        $('#nav-bih-pasivo-no-corriente-tab').tab('show')
              
      },
      actualizarPasivoNC(){
          if(this.pasivo.p_nocorriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.pasivo.p_nocorriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.p_nocorriente;
            this.p_nocorrientes[index].cuenta_id = this.pasivo.p_nocorriente.cuenta_id;
            this.p_nocorrientes[index].nom_cuenta    = nombre;
            this.p_nocorrientes[index].saldo     = this.pasivo.p_nocorriente.saldo;
            this.pasivo.p_nocorriente.cuenta_id  =''
            this.pasivo.p_nocorriente.saldo      =''
            this.pasivo.p_nocorriente.edit       = false;
            this.registro.p_nocorriente          = '';
          this.cambioPasivoNo();
          }
      }
    },
    cancelarEdicionPNocorriente(){
      this.pasivo.p_nocorriente.cuenta_id =''
      this.pasivo.p_nocorriente.saldo      =''
      this.pasivo.p_nocorriente.edit      = false;
    },
        agregarPatrimonio(){
           if(this.patrimonio.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.patrimonio.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var patrimonio ={cuenta_id:this.patrimonio.cuenta_id, nom_cuenta:nombre, saldo:this.patrimonio.saldo}
            this.patrimonios.push(patrimonio);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.patrimonio.cuenta_id ='';
           this.patrimonio.saldo     ='';
           this.cambioPatrimonio();       
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPatrimonio(index){
        this.limpiar();
       this.patrimonio.edit      = true;
       this.registro.patrimonio    = index;
       this.bi.const_id                  = this.patrimonios[index].cuenta_id;
       this.patrimonio.cuenta_id = this.patrimonios[index].cuenta_id;
       this.patrimonio.saldo     = this.patrimonios[index].saldo;
        $('#bih-transaccion').modal('show');
        $('#nav-bih-patrimonio-tab').tab('show')
              
      },
      actualizarPatrimonio(){
          if(this.patrimonio.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.patrimonio.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.patrimonio;
            this.patrimonios[index].cuenta_id = this.patrimonio.cuenta_id;
            this.patrimonios[index].nom_cuenta    = nombre;
            this.patrimonios[index].saldo     = this.patrimonio.saldo;
            this.patrimonio.cuenta_id  =''
            this.patrimonio.saldo      =''
            this.patrimonio.edit       = false;
            this.registro.patrimonio          = '';
          this.cambioPatrimonio()
        }
      }
    },
    cancelarEdicionPatrimonio(){
      this.patrimonio.cuenta_id =''
      this.patrimonio.saldo      =''
      this.patrimonio.edit      = false;
    },
    Agregar(){
    if(this.diario.nom_cuenta.trim() === ''){
      toastr.error("El campo Nombre de cuenta es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.diario.debe.trim() === '' && this.diario.haber.trim() === ''){
      toastr.warning("Rellena el cambio de Debe o Haber, no puedes dejar ambos vacios", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.diario.debe.trim() != '' && this.diario.haber.trim() != ''){
      toastr.warning("No pueden estar ambos campos llenos a mismo tiempo", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else{
      var diario = {fecha:this.diario.fecha, nom_cuenta:this.diario.nom_cuenta, gloza:this.diario.gloza, debe:this.diario.debe, haber:this.diario.haber};
      this.diarios.push(diario);//añadimos el la variable persona al array
      //Limpiamos los campos
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
            });
      this.diario.fecha =''
      this.diario.nom_cuenta =''
      this.diario.gloza =''
      this.diario.debe =''
      this.diario.haber =''
    }
    },
    deleteDiario(index){
      this.diarios.splice(index, 1);
    },
       guardarDiario: function(){
        var _this = this;
        var url = '/sistema/admin/taller/diario';
            axios.post(url,{
              id: _this.id_taller,
            datos: _this.diarios
        }).then(response => {
            console.log(response.data); 
        }).catch(function(error){

        });
    },
    agregarBalance(){
    if (this.balance.cuenta.trim() === '' ) {
       toastr.error("El campo cuenta es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.balance.suma_debe.trim() === '' && this.balance.suma_haber.trim() === ''){
      toastr.warning("Rellena el cambio de Debe o Haber DE SUMAS, no puedes dejar ambos vacios", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.balance.saldo_debe.trim() === '' && this.balance.saldo_haber.trim() === ''){
      toastr.warning("Rellena el cambio de Debe o Haber de SALDOS, no puedes dejar ambos vacios", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.balance.saldo_debe.trim() != '' && this.balance.saldo_haber.trim() != ''){
      toastr.warning("No pueden estar ambos campos llenos a mismo tiempo", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else{
      var balance = {cuenta:this.balance.cuenta, suma_debe:this.balance.suma_debe, suma_haber:this.balance.suma_haber, saldo_debe:this.balance.saldo_debe, saldo_haber:this.balance.saldo_haber};
      this.balances.push(balance);//añadimos el la variable persona al array
      //Limpiamos los campos
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
            });
      this.balance.cuenta =''
      this.balance.suma_debe =''
      this.balance.suma_haber =''
      this.balance.saldo_debe =''
      this.balance.saldo_haber =''
    }
    },

        verificarCuenta(id){
            if (Number(this.bi.const_id) === id) {
              return false
            }
           let ac  = this.a_corrientes.filter(x => x.cuenta_id == id);
           let anc = this.a_nocorrientes.filter(x => x.cuenta_id == id);
           let pc  = this.p_corrientes.filter(x => x.cuenta_id == id);
           let pnc = this.a_nocorrientes.filter(x => x.cuenta_id == id);
           let p   = this.patrimonios.filter(x => x.cuenta_id == id);
            if (ac.length > 0) {
            return true
             }else if(anc.length > 0) {
            return true
             }else if(pc.length > 0) {
            return true
             }else if(pnc.length > 0) {
            return true
             }else if(p.length > 0) {
            return true
             }else{
              return false
             }
          },
         
            //ACTUALIZAR SUMAS DE PASIVOS, ACTIVOS Y PATRIMONIO
             cambioActivo(){
              this.b_initotal.t_a_corriente = 0;
              var t_activo = this.a_corrientes;           //CARGAR EL ARRAY DE LOS ACTIVOS
              //console.log(t_activo)
              var total = 0;
              t_activo.forEach(function(obj){           //RECORRER ESE ARRAY
                total += Number(obj.saldo);           //SUMAR EL SALDO DE CADA CUENTA EN EL ARRAY UNA Y OTRA VEZ
              });
              //console.log(total);          
              this.b_initotal.t_a_corriente = total;          //IGUALAR LA VARIABLE QUE CONTIENE LA SUMA TOTAL CON LA SUMA REALIZADA
              this.TotalActivo();
             },
                cambioActivoNo(){
              this.b_initotal.t_a_nocorriente = 0;
              var t_noactivo = this.a_nocorrientes;
              //console.log(t_noactivo)
              var total = 0;
              t_noactivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);  
              this.b_initotal.t_a_nocorriente = total;
            this.TotalActivo();

             },
                cambioPasivo(){
              this.b_initotal.t_p_corriente = 0;
              var t_pasivo = this.p_corrientes;
              console.log(t_pasivo)
              var total = 0;
              t_pasivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              console.log(total);
              this.b_initotal.t_p_corriente = total;
                this.TotalPasivo();
             },
                cambioPasivoNo(){
              this.b_initotal.t_p_no_corriente = 0;
              var t_nopasivo = this.p_nocorrientes;
              //console.log(t_nopasivo)
              var total = 0;
              t_nopasivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);
              this.b_initotal.t_p_no_corriente = total;
                this.TotalPasivo();
             },
            cambioPatrimonio(){
              this.b_initotal.t_patrimonio = 0;
              var t_patrimo = this.patrimonios;
              //console.log(t_patrimo)
              var total = 0;
              t_patrimo.forEach(function(obj){
                total += Number(obj.saldo); 
              });
              //console.log(total);
              this.b_initotal.t_patrimonio = total;
             },

             //TOTAL GENERAL DE ACTIVO, PASIVO Y PATRIMONIO       
             TotalActivo(){
              var activo = this.b_initotal.t_a_corriente + this.b_initotal.t_a_nocorriente;
             //console.log(activo);
              this.total_balance_inicial.t_activo = activo;
             },
              TotalPasivo(){
              var pasivo = this.b_initotal.t_p_corriente + this.b_initotal.t_p_no_corriente;
              //onsole.log(pasivo);
              this.total_balance_inicial.t_pasivo = pasivo;
             },
               totalPasivoPatrimonio(){
                  $('#pasivo_patrimonio').modal('hide');
                toastr.success("Total Agregado Correctamente", "Smarmoddle", {
                    "timeOut": "3000"
                   });
            },
            //GUARDAR BALANCE INICIAL
                guardarBalanceInicial: function(){
                if (this.balance_inicial.nombre.trim() === '') {
                  toastr.error("Campo Nombre es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if (this.balance_inicial.fecha.trim() === '') {
                  toastr.error("Campo Fecha es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.total_balance_inicial.t_patrimonio_pasivo.trim() === ''){
                  toastr.error("Debes calcular el Total del Pasivo + Patrimonio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else{
                var _this = this;
                var url = '/sistema/admin/taller/balance_inicial';
                    axios.post(url,{
                    id: _this.id_taller,
                    nombre: _this.balance_inicial.nombre,
                    fecha: _this.balance_inicial.fecha,
                    tipo: _this.tipo,
                    a_corriente: _this.a_corrientes,
                    a_nocorriente: _this.a_nocorrientes,
                    p_corriente: _this.p_corrientes,
                    p_nocorriente: _this.p_nocorrientes,
                    patrimonio: _this.patrimonios,
                    totales_iniciales:_this.total_balance_inicial,
                    totales_totales:_this.b_initotal,
                    t_patrimonio: _this.total_balance_inicial.t_patrimonio_pasivo
                }).then(response => {
                  if (response.data.success == true) {
                     toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    // diario.obtenerBalanceInicial();
                    // $('#list-tab a:nth-child(3)').tab('show');
                    console.log(response.data); 
                  } else {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    // diario.obtenerBalanceInicial();
                  }                     
                }).catch(function(error){
                  toastr.error(error.response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                });
              }
            },
            obtenerBalance:function(){
              var _this = this;
                var url = '/sistema/admin/taller/obtenerbalance';
                    axios.post(url,{
                    id: _this.id_taller,
                    tipo: _this.tipo
                }).then(response => {
                  if (response.data.tipo == _this.tipo || response.data.datos == true ) {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.balance_inicial.nombre                    = response.data.nombre
                    _this.balance_inicial.fecha                     = response.data.fecha
                    _this.a_corrientes                              = response.data.a_corriente;
                    _this.a_nocorrientes                            = response.data.a_nocorriente;
                    _this.p_corrientes                              = response.data.p_corriente;
                    _this.p_nocorrientes                            = response.data.p_nocorriente;
                    _this.patrimonios                               = response.data.patrimonios;
                    _this.total_balance_inicial.t_patrimonio_pasivo = response.data.total_pasivo_patrimonio;
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    // diario.obtenerBalanceInicial();
                    console.log(response.data);                 
                  } else {

                  }
                }).catch(function(error){
                
                });

            }
  }   
});



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////BALANCE INICIAL VERTICAL///////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const b_ver = new Vue({
        el: '#b_vertical',
     data:{
        id_taller: taller,
        tipo: 'vertical',
        //diarios:[],
        update:0,
        balance_inicial:{ //Nombre y fecha del balance inicial
          nombre:'',
          fecha:''
        },
        patrimonio:{ //Asignar Patrimonio
          nom_cuenta:'',
          cuenta_id:'',
          saldo:'',
        },
        bi:{const_id:''},
         options: objeto,
        cuentas: cuentas,
        //diarios2:[],
        total_balance_inicial:{ //Totales de activo, pasivo y patrimonio
          t_activo:'',
          t_pasivo:'',
          t_patrimonio_pasivo:''
        },
        b_initotal:{
            t_a_corriente:'', //Total de activo corriente
            t_a_nocorriente:'', //Total de activo no corriente
            t_p_corriente:'', //Total de pasivo corriente
            t_p_no_corriente:'', //Total de pasivo no corriente
            t_patrimonio:'' //Total de patrimonio
        },
        a_corrientes:[], //Array de activos corrientes
        a_nocorrientes:[], //Array de activos no corrientes
        p_corrientes:[], //Array de pasivos corrientes
        p_nocorrientes:[], //Array de pasivos no corrientes
        patrimonios:[], //Array de patrimonios
         registro:{
          activo_corriente:'',
          activo_nocorriente:'',
          pasivo_corriente:'',
          pasivo_nocorriente:'',
          patrimonio:'',
        },
        activo:{
          a_corriente:
            { //Agregar un nuevo activo corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'', 
                edit:false,             
              },
          a_nocorriente:
            { //Agregar un nuevo activo no corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'',
                edit:false,
              },
        },
        pasivo:{
          p_corriente:
            { //Agregar un nuevo pasivo corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'',
                edit:false,
                total:''
              },
          p_nocorriente:
            { //Agregar un nuevo pasivo no corriente al array
                nom_cuenta:'',
                cuenta_id:'',
                saldo:'',
                edit:false,
                total:''
              }
        },   
  },
  mounted: function(){
    this.cambioActivo();
    this.cambioActivoNo();
    this.cambioPasivo();
    this.cambioPasivoNo();
    this.cambioPatrimonio();
    this.TotalActivo();
    this.TotalPasivo();
    this.obtenerBalance();
  },
   methods:{
      decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
     calculadora(){
     let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
      abrirActivoC(){
      this.limpiar();
      $('#biv-transaccion').modal('show');
      $('#nav-biv-activo-corriente-tab').tab('show')

    },
      abrirActivoNoC(){
        this.limpiar();
      $('#biv-transaccion').modal('show');
      
      $('#nav-biv-activo-no-corriente-tab').tab('show')

    },
      abrirPasivoC(){
        this.limpiar();
      $('#biv-transaccion').modal('show');
      
      $('#nav-biv-pasivo-corriente-tab').tab('show')

    },
      abrirPasivoNoC(){
        this.limpiar();
      $('#biv-transaccion').modal('show');
      
      $('#nav-biv-pasivo-no-corriente-tab').tab('show')

    },
      abrirPatrimonio(){
        this.limpiar();
      $('#biv-transaccion').modal('show');
     
      $('#nav-biv-patrimonio-tab').tab('show')

    },
    
//ELIMINAR ELEMENTOS DE UN ARRAY /////////
    deleteAcCooriente(index){
     let nombre = this.a_corrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.a_corrientes.splice(index, 1);   
          this.cambioActivo();                  
          this.TotalActivo();    
        }
      });
    },
                   
  
     deletePaCooriente(index){
      let nombre = this.p_corrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
       
      this.p_corrientes.splice(index, 1);
      this.cambioPasivo();
      this.TotalPasivo(); 
        }
      });

    },
     deleteAcNoCooriente(index){
      let nombre = this.a_nocorrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.a_nocorrientes.splice(index, 1);
      this.cambioActivoNo();
      this.TotalActivo();
        }
      });

    },
     deletePaNoCooriente(index){
      let nombre = this.p_nocorrientes[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.p_nocorrientes.splice(index, 1);
      this.cambioPasivoNo();
      this.TotalPasivo();
        }
      });
 
    },
     deletePatrimonio(index){
      let nombre = this.patrimonios[index].nom_cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.patrimonios.splice(index, 1);
      this.cambioPatrimonio();
        }
      });
    
    },
    limpiar(){ //LIMPIAR TODOS LOS CAMPOS DE ACTIVOS PASIVOS Y PATRIMONIOS
      this.pasivo.p_corriente.cuenta_id = '';
      this.pasivo.p_corriente.saldo = '';
      this.pasivo.p_nocorriente.cuenta_id = '';
      this.pasivo.p_nocorriente.saldo = '';
      this.activo.a_corriente.cuenta_id = '';
      this.activo.a_corriente.saldo = '';
      this.activo.a_nocorriente.cuenta_id = '';
      this.activo.a_nocorriente.saldo = '';

      this.pasivo.p_corriente.edit = false;
      this.pasivo.p_nocorriente.edit = false;
      this.activo.a_corriente.edit = false;
      this.activo.a_nocorriente.edit = false;
      this.bi.const_id = '';

      },
      agregarActivoCorriente(){
           if(this.activo.a_corriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.activo.a_corriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var a_corriente ={cuenta_id:this.activo.a_corriente.cuenta_id, nom_cuenta:nombre, saldo:this.activo.a_corriente.saldo}
            this.a_corrientes.push(a_corriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.activo.a_corriente.cuenta_id =''
           this.activo.a_corriente.saldo     =''
           this.cambioActivo(); 
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editAcorriente(index){
       this.activo.a_corriente.edit      = true;
       this.registro.a_corriente    = index;
       this.bi.const_id                  = this.a_corrientes[index].cuenta_id;
       this.activo.a_corriente.cuenta_id = this.a_corrientes[index].cuenta_id;
       this.activo.a_corriente.saldo     = this.a_corrientes[index].saldo;
        $('#biv-transaccion').modal('show');
        $('#nav-biv-activo-corriente-tab').tab('show')
              
      },
      actualizarActivoC(){
          if(this.activo.a_corriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.activo.a_corriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.a_corriente;
            this.a_corrientes[index].cuenta_id = this.activo.a_corriente.cuenta_id;
            this.a_corrientes[index].nom_cuenta    = nombre;
            this.a_corrientes[index].saldo     = this.activo.a_corriente.saldo;
            this.activo.a_corriente.cuenta_id  =''
            this.activo.a_corriente.saldo      =''
            this.activo.a_corriente.edit       = false;
            this.registro.a_corriente          = '';
          this.cambioActivo();
          }
      }
    },
    cancelarEdicionActivoC(){
      this.activo.a_corriente.cuenta_id =''
      this.activo.a_corriente.saldo      =''
      this.activo.a_corriente.edit      = false;
    },
    agregarActivoNoCorriente(){
         if(this.activo.a_nocorriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.activo.a_nocorriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var a_nocorriente ={cuenta_id:this.activo.a_nocorriente.cuenta_id, nom_cuenta:nombre, saldo:this.activo.a_nocorriente.saldo}
            this.a_nocorrientes.push(a_nocorriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.activo.a_nocorriente.cuenta_id =''
           this.activo.a_nocorriente.saldo     =''
           this.cambioActivoNo(); 
         }
           }                      
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editNoAcorriente(index){
       this.activo.a_nocorriente.edit       = true;
       this.registro.a_nocorriente          = index;
       this.bi.const_id                     = this.a_nocorrientes[index].cuenta_id;
       this.activo.a_nocorriente.cuenta_id  = this.a_nocorrientes[index].cuenta_id;
       this.activo.a_nocorriente.saldo      = this.a_nocorrientes[index].saldo;
        $('#biv-transaccion').modal('show');
        $('#nav-biv-activo-no-corriente-tab').tab('show');           
      },
      actualizarActivoNC(){
        if(this.activo.a_nocorriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.activo.a_nocorriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.a_nocorriente;
            this.a_nocorrientes[index].cuenta_id = this.activo.a_nocorriente.cuenta_id;
            this.a_nocorrientes[index].nom_cuenta    = nombre;
            this.a_nocorrientes[index].saldo     = this.activo.a_nocorriente.saldo;
            this.activo.a_nocorriente.cuenta_id  =''
            this.activo.a_nocorriente.saldo      =''
            this.activo.a_nocorriente.edit       = false;
            this.registro.a_nocorriente          = '';
          this.cambioActivoNo();
          }
      }
    },
    cancelarEdicionActivoNC(){
      this.activo.a_nocorriente.cuenta_id  =''
      this.activo.a_nocorriente.saldo      =''
      this.activo.a_nocorriente.edit       = false;
    },

    agregarPasivoCorriente(){
           if(this.pasivo.p_corriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.pasivo.p_corriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var p_corriente ={cuenta_id:this.pasivo.p_corriente.cuenta_id, nom_cuenta:nombre, saldo:this.pasivo.p_corriente.saldo}
            this.p_corrientes.push(p_corriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.pasivo.p_corriente.cuenta_id ='';
           this.pasivo.p_corriente.saldo     ='';
           this.cambioPasivo();
               
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPcorriente(index){
       this.pasivo.p_corriente.edit      = true;
       this.registro.p_corriente    = index;
       this.bi.const_id                  = this.p_corrientes[index].cuenta_id;
       this.pasivo.p_corriente.cuenta_id = this.p_corrientes[index].cuenta_id;
       this.pasivo.p_corriente.saldo     = this.p_corrientes[index].saldo;
        $('#biv-transaccion').modal('show');
        $('#nav-biv-pasivo-corriente-tab').tab('show')
              
      },
      actualizarPasivoC(){
          if(this.pasivo.p_corriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.pasivo.p_corriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.p_corriente;
            this.p_corrientes[index].cuenta_id = this.pasivo.p_corriente.cuenta_id;
            this.p_corrientes[index].nom_cuenta    = nombre;
            this.p_corrientes[index].saldo     = this.pasivo.p_corriente.saldo;
            this.pasivo.p_corriente.cuenta_id  =''
            this.pasivo.p_corriente.saldo      =''
            this.pasivo.p_corriente.edit       = false;
            this.registro.p_corriente          = '';
            this.cambioPasivo();
          }
      }
    },
    cancelarEdicionPcorriente(){
      this.pasivo.p_corriente.cuenta_id =''
      this.pasivo.p_corriente.saldo      =''
      this.pasivo.p_corriente.edit      = false;
    },

    agregarPasivoNoCorriente(){
           if(this.pasivo.p_nocorriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.pasivo.p_nocorriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var p_nocorriente ={cuenta_id:this.pasivo.p_nocorriente.cuenta_id, nom_cuenta:nombre, saldo:this.pasivo.p_nocorriente.saldo}
            this.p_nocorrientes.push(p_nocorriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.pasivo.p_nocorriente.cuenta_id ='';
           this.pasivo.p_nocorriente.saldo     ='';
           this.cambioPasivoNo();
               
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPNocorriente(index){
       this.pasivo.p_nocorriente.edit      = true;
       this.registro.p_nocorriente    = index;
       this.bi.const_id                  = this.p_nocorrientes[index].cuenta_id;
       this.pasivo.p_nocorriente.cuenta_id = this.p_nocorrientes[index].cuenta_id;
       this.pasivo.p_nocorriente.saldo     = this.p_nocorrientes[index].saldo;
        $('#biv-transaccion').modal('show');
        $('#nav-biv-pasivo-no-corriente-tab').tab('show')
              
      },
      actualizarPasivoNC(){
          if(this.pasivo.p_nocorriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.pasivo.p_nocorriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.p_nocorriente;
            this.p_nocorrientes[index].cuenta_id = this.pasivo.p_nocorriente.cuenta_id;
            this.p_nocorrientes[index].nom_cuenta    = nombre;
            this.p_nocorrientes[index].saldo     = this.pasivo.p_nocorriente.saldo;
            this.pasivo.p_nocorriente.cuenta_id  =''
            this.pasivo.p_nocorriente.saldo      =''
            this.pasivo.p_nocorriente.edit       = false;
            this.registro.p_nocorriente          = '';
          this.cambioPasivoNo();
          }
      }
    },
    cancelarEdicionPNocorriente(){
      this.pasivo.p_nocorriente.cuenta_id =''
      this.pasivo.p_nocorriente.saldo      =''
      this.pasivo.p_nocorriente.edit      = false;
    },
        agregarPatrimonio(){
           if(this.patrimonio.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.patrimonio.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var patrimonio ={cuenta_id:this.patrimonio.cuenta_id, nom_cuenta:nombre, saldo:this.patrimonio.saldo}
            this.patrimonios.push(patrimonio);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.patrimonio.cuenta_id ='';
           this.patrimonio.saldo     ='';
           this.cambioPatrimonio();       
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPatrimonio(index){
       this.patrimonio.edit      = true;
       this.registro.patrimonio    = index;
       this.bi.const_id                  = this.patrimonios[index].cuenta_id;
       this.patrimonio.cuenta_id = this.patrimonios[index].cuenta_id;
       this.patrimonio.saldo     = this.patrimonios[index].saldo;
        $('#biv-transaccion').modal('show');
        $('#nav-biv-patrimonio-tab').tab('show')
              
      },
      actualizarPatrimonio(){
          if(this.patrimonio.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.patrimonio.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.patrimonio;
            this.patrimonios[index].cuenta_id = this.patrimonio.cuenta_id;
            this.patrimonios[index].nom_cuenta    = nombre;
            this.patrimonios[index].saldo     = this.patrimonio.saldo;
            this.patrimonio.cuenta_id  =''
            this.patrimonio.saldo      =''
            this.patrimonio.edit       = false;
            this.registro.patrimonio          = '';
          this.cambioPatrimonio()
        }
      }
    },
    cancelarEdicionPatrimonio(){
      this.patrimonio.cuenta_id =''
      this.patrimonio.saldo      =''
      this.patrimonio.edit      = false;
    },
   
    Agregar(){
    if(this.diario.nom_cuenta.trim() === ''){
      toastr.error("El campo Nombre de cuenta es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.diario.debe.trim() === '' && this.diario.haber.trim() === ''){
      toastr.warning("Rellena el cambio de Debe o Haber, no puedes dejar ambos vacios", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.diario.debe.trim() != '' && this.diario.haber.trim() != ''){
      toastr.warning("No pueden estar ambos campos llenos a mismo tiempo", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else{
      var diario = {fecha:this.diario.fecha, nom_cuenta:this.diario.nom_cuenta, gloza:this.diario.gloza, debe:this.diario.debe, haber:this.diario.haber};
      this.diarios.push(diario);//añadimos el la variable persona al array
      //Limpiamos los campos
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
            });
      this.diario.fecha =''
      this.diario.nom_cuenta =''
      this.diario.gloza =''
      this.diario.debe =''
      this.diario.haber =''
    }
    },
    deleteDiario(index){
      this.diarios.splice(index, 1);
    },
       guardarDiario: function(){
        var _this = this;
        var url = '/sistema/admin/taller/diario';
            axios.post(url,{
              id: _this.id_taller,
            datos: _this.diarios
        }).then(response => {
            console.log(response.data); 
        }).catch(function(error){

        });
    },
    agregarBalance(){
    if (this.balance.cuenta.trim() === '' ) {
       toastr.error("El campo cuenta es obligatorio", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.balance.suma_debe.trim() === '' && this.balance.suma_haber.trim() === ''){
      toastr.warning("Rellena el cambio de Debe o Haber DE SUMAS, no puedes dejar ambos vacios", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.balance.saldo_debe.trim() === '' && this.balance.saldo_haber.trim() === ''){
      toastr.warning("Rellena el cambio de Debe o Haber de SALDOS, no puedes dejar ambos vacios", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else if(this.balance.saldo_debe.trim() != '' && this.balance.saldo_haber.trim() != ''){
      toastr.warning("No pueden estar ambos campos llenos a mismo tiempo", "Smarmoddle", {
                "timeOut": "3000"
            });
    }else{
      var balance = {cuenta:this.balance.cuenta, suma_debe:this.balance.suma_debe, suma_haber:this.balance.suma_haber, saldo_debe:this.balance.saldo_debe, saldo_haber:this.balance.saldo_haber};
      this.balances.push(balance);//añadimos el la variable persona al array
      //Limpiamos los campos
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
            });
      this.balance.cuenta =''
      this.balance.suma_debe =''
      this.balance.suma_haber =''
      this.balance.saldo_debe =''
      this.balance.saldo_haber =''
    }
    },
        verificarCuenta(id){
           if (Number(this.bi.const_id) === id) {
              return false
            }
           let ac  = this.a_corrientes.filter(x => x.cuenta_id == id);
           let anc = this.a_nocorrientes.filter(x => x.cuenta_id == id);
           let pc  = this.p_corrientes.filter(x => x.cuenta_id == id);
           let pnc = this.a_nocorrientes.filter(x => x.cuenta_id == id);
           let p   = this.patrimonios.filter(x => x.cuenta_id == id);
            if (ac.length > 0) {
            return true
             }else if(anc.length > 0) {
            return true
             }else if(pc.length > 0) {
            return true
             }else if(pnc.length > 0) {
            return true
             }else if(p.length > 0) {
            return true
             }else{
              return false
             }
          },
          
            //ACTUALIZAR SUMAS DE PASIVOS, ACTIVOS Y PATRIMONIO
             cambioActivo(){
              this.b_initotal.t_a_corriente = 0;
              var t_activo = this.a_corrientes;           //CARGAR EL ARRAY DE LOS ACTIVOS
              //console.log(t_activo)
              var total = 0;
              t_activo.forEach(function(obj){           //RECORRER ESE ARRAY
                total += Number(obj.saldo);           //SUMAR EL SALDO DE CADA CUENTA EN EL ARRAY UNA Y OTRA VEZ
              });
              //console.log(total);          
              this.b_initotal.t_a_corriente = total;          //IGUALAR LA VARIABLE QUE CONTIENE LA SUMA TOTAL CON LA SUMA REALIZADA
              this.TotalActivo();
             },
                cambioActivoNo(){
              this.b_initotal.t_a_nocorriente = 0;
              var t_noactivo = this.a_nocorrientes;
              //console.log(t_noactivo)
              var total = 0;
              t_noactivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);  
              this.b_initotal.t_a_nocorriente = total;
            this.TotalActivo();

             },
                cambioPasivo(){
              this.b_initotal.t_p_corriente = 0;
              var t_pasivo = this.p_corrientes;
              //console.log(t_pasivo)
              var total = 0;
              t_pasivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);
              this.b_initotal.t_p_corriente = total;
                this.TotalPasivo();
             },
                cambioPasivoNo(){
              this.b_initotal.t_p_no_corriente = 0;
              var t_nopasivo = this.p_nocorrientes;
              //console.log(t_nopasivo)
              var total = 0;
              t_nopasivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);
              this.b_initotal.t_p_no_corriente = total;
                this.TotalPasivo();
             },
            cambioPatrimonio(){
              this.b_initotal.t_patrimonio = 0;
              var t_patrimo = this.patrimonios;
              //console.log(t_patrimo)
              var total = 0;
              t_patrimo.forEach(function(obj){
                total += Number(obj.saldo); 
              });
              //console.log(total);
              this.b_initotal.t_patrimonio = total;
             },

             //TOTAL GENERAL DE ACTIVO, PASIVO Y PATRIMONIO       
             TotalActivo(){
              var activo = this.b_initotal.t_a_corriente + this.b_initotal.t_a_nocorriente;
             //console.log(activo);
              this.total_balance_inicial.t_activo = activo;
             },
              TotalPasivo(){
              var pasivo = this.b_initotal.t_p_corriente + this.b_initotal.t_p_no_corriente;
              //onsole.log(pasivo);
              this.total_balance_inicial.t_pasivo = pasivo;
             },
               totalPasivoPatrimonio(){
                  $('#pasivo_patrimonio').modal('hide');
                toastr.success("Total Agregado Correctamente", "Smarmoddle", {
                    "timeOut": "3000"
                   });
            },
            //GUARDAR BALANCE INICIAL
                guardarBalanceInicial: function(){
                if (this.balance_inicial.nombre.trim() === '') {
                  toastr.error("Campo Nombre es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if (this.balance_inicial.fecha.trim() === '') {
                  toastr.error("Campo Fecha es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.total_balance_inicial.t_patrimonio_pasivo.trim() === ''){
                  toastr.error("Debes calcular el Total del Pasivo + Patrimonio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else{
                var _this = this;
                var url = '/sistema/admin/taller/balance_inicial';
                    axios.post(url,{
                    id: _this.id_taller,
                    nombre: _this.balance_inicial.nombre,
                    fecha: _this.balance_inicial.fecha,
                    tipo: _this.tipo,
                    a_corriente: _this.a_corrientes,
                    a_nocorriente: _this.a_nocorrientes,
                    p_corriente: _this.p_corrientes,
                    p_nocorriente: _this.p_nocorrientes,
                    patrimonio: _this.patrimonios,
                    totales_iniciales:_this.total_balance_inicial,
                    totales_totales:_this.b_initotal,
                    t_patrimonio: _this.total_balance_inicial.t_patrimonio_pasivo
                }).then(response => {
                  if (response.data.success == true) {
                     toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                
                    console.log(response.data); 
                  } else {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                   
                  }                     
                }).catch(function(error){
                  toastr.error(error.response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                });
              }
            },
            obtenerBalance:function(){
              var _this = this;
                var url = '/sistema/admin/taller/obtenerbalance';
                    axios.post(url,{
                    id: _this.id_taller,
                    tipo: _this.tipo
                }).then(response => {
                  if (response.data.tipo == _this.tipo || response.data.datos == true ) {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.balance_inicial.nombre = response.data.nombre
                    _this.balance_inicial.fecha = response.data.fecha
                    _this.a_corrientes = response.data.a_corriente;
                    _this.a_nocorrientes = response.data.a_nocorriente;
                    _this.p_corrientes = response.data.p_corriente;
                    _this.p_nocorrientes = response.data.p_nocorriente;
                    _this.patrimonios = response.data.patrimonios;
                    _this.total_balance_inicial.t_patrimonio_pasivo = response.data.total_pasivo_patrimonio;
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    //diario.obtenerBalanceInicial();
                    console.log(response.data);                 
                  } else {

                  }
                }).catch(function(error){
                
                });

            }
  }   
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////DIARIO GENERAL//////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const diario = new Vue({
 el: '#diario',
    data:{
      id_taller: taller,
      datos_diario: '',
      producto_id: 1,
      nombre:'',
      fechabalance:'',
      complete:false,
      options: objeto,
      cuentas: cuentas,
      balanceInicial:{
        debe:[],
        haber:[],
        totaldebe:0,
        totalhaber:0
       },
       kardex:[],
nombre_kardex:'',
producto_kardex:'',
transacciones:'',
       registros:[
       ],
       eliminar:{
        index:''
       },
       ajustes:[],
       porcentajes:{
        porcentaje:0,
        index_cuenta:'',
        tipo:'',
        cantidad:0
       },
       registerindex: 0,
       cuentaindex: 0,
        diarios:{
           debe:[],
          haber:[],
          comentario:'',
          fecha:'',
          ajustado:false,
          tipo:''
        },
         edit:{
           debe:[],
          haber:[],
          comentario:''
        },
        diario:{
          debe:{
            edit: false,
            index:'',
            fecha:'',
            nom_cuenta:'',
            saldo:'0.00',
          },
          haber:{
            edit: false,
            index:'',
            fecha:'',
            nom_cuenta:'',
            saldo:'0.00'
          },
          comentario:''
        },
        pasan:{ 
          debe:0, 
          haber:0
        },
        total:{
          debe:0,
          haber:0,
        },
        update:false,
        dato:[]
    },
    mounted: function () {
      this.obtenerDiarioGeneral();

    },

   
    methods:{
          calculadora(){
     let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
    decimales(saldo){
      if (saldo !== null) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
    abrirTransaccion(){
      this.update             = false;
      this.diarios.debe      =[];
      this.diarios.haber      =[];
      this.diarios.fecha      =[];
      this.diarios.comentario =[];
      this.diarios.ajustado = false;
      this.diario.haber.fecha =''
      this.diario.haber.nom_cuenta =''
      this.diario.haber.saldo =''
      this.diario.haber.edit =false
      this.diario.debe.fecha =''
      this.diario.debe.nom_cuenta =''
      this.diario.debe.saldo =''
      this.diario.debe.edit =false
              

      this.limpiar();
      $('#dg-transaccion').modal('show');
      $('#comentario-diario-tab').tab('show'); 


    },
    limpiar(){
      this.update                  = false;
      this.diarios.debe            =[];
      this.diarios.haber           =[];
      this.diarios.fecha           =[];
      this.diarios.comentario      =[];
      this.diarios.ajustado        = false;
      this.diario.haber.fecha      ='';
      this.diario.haber.nom_cuenta ='';
      this.diario.haber.saldo      ='';
      this.diario.haber.edit       =false;
      this.diario.debe.fecha       ='';
      this.diario.debe.nom_cuenta  ='';
      this.diario.debe.saldo       ='';
      this.diario.debe.edit        = false;
    },
    valorPorcentual(porcentaje, valor){
     
      let total = Number((valor * porcentaje) / 100);
      return total;
    },
      obtenerKardexFifo: function() {
        let _this = this;
        let url = '/sistema/admin/taller/kardex-obtener-fifo';
            axios.post(url,{
              id: _this.id_taller,
              producto_id: _this.producto_id
        }).then(response => {
          if (response.data.datos == true) {
              _this.kardex = response.data.kardex_fifo;
              _this.nombre_kardex =  response.data.informacion.nombre;
              _this.producto_kardex = response.data.informacion.producto;
        
            }else{
              _this.kardex = [];
              _this.nombre =  '';
              _this.producto = '';     
            }        
        }).catch(function(error){

        }); 
     },
    obtenerBalanceInicial: function(){
      
      let verificar = this.registros.filter(x => x.tipo == 'inicial');

      if (verificar.length >= 1) {
          toastr.warning("Ya tienes cargado los datos del balance inicial", "Smarmoddle", {
                "timeOut": "3000"
                });
          return
      }

      var _this = this;
      var url = '/sistema/admin/taller/b_inicial_diario';
        axios.post(url,{
          id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
            let inicial = response.data.inicial;
            inicial.debe[0].fecha = inicial.fecha;
            _this.registros.unshift(inicial);
         
            console.log(response.data); 
             this.totalDebe();
              this.totalHaber();
            this.totalesFinales();

           
          }else{
             toastr.warning("Aun no has creado tu balance Inicial", "Smarmoddle", {
                "timeOut": "3000"
                });
          }
                    
        }).catch(function(error){

        });

    },
    agregarHaber(){
      if (this.diario.haber.nom_cuenta === '') {
        toastr.error("No has registrado una cuenta", "Smarmoddle", {
                "timeOut": "3000"
                });
      }else{

      let id = this.diario.haber.nom_cuenta;
      let cuenta = this.cuentas.filter(x => x.id == id);
      let valor = this.diario.haber.saldo;
     
            if (cuenta[0].porcentual == 1) {
                  let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
                  let haber = {cuenta_id: cuenta[0].id, fecha:this.diario.haber.fecha, nom_cuenta: cuenta[0].nombre, saldo:calculo};
                  this.diarios.haber.push(haber);//añadimos el la variable persona al array
            }else{
                  let haber = {cuenta_id: cuenta[0].id, fecha:this.diario.haber.fecha, nom_cuenta: cuenta[0].nombre, saldo:this.diario.haber.saldo};
                  this.diarios.haber.push(haber);
            }
               
                //Limpiamos los campos
                toastr.success("Activo agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diario.haber.fecha =''
                this.diario.haber.nom_cuenta =''
                this.diario.haber.saldo =''
        }
    },
     agregarDebe(){
      
      let id = this.diario.debe.nom_cuenta;
      let cuenta = this.cuentas.filter(x => x.id == id);
      let valor = this.diario.debe.saldo;

     
          if(this.diario.debe.nom_cuenta === ''){
           toastr.error("La cuenta es obligatoria", "Smarmoddle", {
                "timeOut": "3000"
            });
        }else{
            if (cuenta[0].porcentual == 1) {
                  let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
                  
                  let debe = {cuenta_id: cuenta[0].id, fecha:this.diario.debe.fecha, nom_cuenta: cuenta[0].nombre, saldo:calculo};
                  this.diarios.debe.push(debe);//añadimos el la variable persona al array
            }else{
                  let debe = {cuenta_id: cuenta[0].id, fecha:this.diario.debe.fecha, nom_cuenta: cuenta[0].nombre, saldo:this.diario.debe.saldo};
                  this.diarios.debe.push(debe);
            }
                toastr.success("Activo agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diario.debe.fecha =''
                this.diario.debe.nom_cuenta =''
                this.diario.debe.saldo =''
      }
          // }     
    },
    agregarComentario(){
      this.diarios.comentario = this.diario.comentario;
      this.diario.comentario = '';
    },
  deleteHaber(index){
      this.diarios.haber.splice(index, 1);
        this.diario.debe.fecha      ='';
        this.diario.debe.nom_cuenta ='';
        this.diario.debe.saldo      ='';
        this.diario.debe.edit       = false;
        this.diario.haber.fecha      ='';
        this.diario.haber.nom_cuenta ='';
        this.diario.haber.saldo      ='';
        this.diario.haber.edit       = false;

    },
  deleteDebe(index){
        this.diarios.debe.splice(index, 1);
        this.diario.haber.fecha      ='';
        this.diario.haber.nom_cuenta ='';
        this.diario.haber.saldo      ='';
        this.diario.haber.edit       = false;
         this.diario.debe.fecha      ='';
        this.diario.debe.nom_cuenta ='';
        this.diario.debe.saldo      ='';
        this.diario.debe.edit       = false;

    },
    guardarRegistro(){
      let total_debe = 0;
      let total_haber = 0;
      
      this.diarios.debe.forEach(function(debe, id){
                let saldo = debe.saldo;
                    total_debe += Number(saldo);
              });
      this.diarios.haber.forEach(function(haber, id){
                let saldo = haber.saldo;
                    total_haber += Number(saldo);
              });

      if (this.diarios.debe == 0) {
         toastr.error("No tienes transaccion para guardar", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.comentario == '') {
         toastr.error("Debes agregar un comentario", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.fecha == '') {
         toastr.error("Debes agregar la fecha", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (total_haber.toFixed(2) != total_debe.toFixed(2)) {
         toastr.error("El Total de Debe y Haber no coinciden", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else{
        this.diarios.debe[0].fecha = this.diarios.fecha;

              if (this.diarios.ajustado == true) {
                let registro = {tipo: 'ajustado', debe:this.diarios.debe, haber:this.diarios.haber, comentario:this.diarios.comentario, fecha: this.diarios.fecha};
                this.ajustes.push(registro);//añadimos el la variable persona al array

              } else {

                let registro = {tipo: 'normal', debe:this.diarios.debe, haber:this.diarios.haber, comentario:this.diarios.comentario, fecha: this.diarios.fecha};
                this.registros.push(registro);//añadimos el la variable persona al array

              }
                //Limpiamos los campos
                toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diarios.debe =[];
                this.diarios.haber =[];
                this.diarios.comentario = '';
                this.diarios.ajustado = false;
                this.totalDebe();
                this.totalHaber();
            this.totalesFinales();
        this.limpiar();


      $('#dg-transaccion').modal('hide');

                
      }
    },
    debeEditRegister(id){

      let register = JSON.parse(JSON.stringify(this.registros));
      this.update             = true;
      this.registerindex      = id;
      this.diarios.debe       =[];
      this.diarios.haber      =[];
      this.diarios.debe       = register[id].debe;
      this.diarios.haber      = register[id].haber;
      this.diarios.comentario = register[id].comentario;
      this.diarios.fecha = register[id].fecha;
      if (register[id].tipo == 'ajustado') {
        this.diarios.ajustado = true;
      } else {
      this.diarios.ajustado = false;
      }
      this.diarios.tipo = register[id].tipo;

  
      $('#dg-transaccion').modal('show');

    },
     debeEditAjustado(id){

      let register = JSON.parse(JSON.stringify(this.ajustes));
      this.update             = true;
      this.registerindex      = id;
      this.diarios.debe       =[];
      this.diarios.haber      =[];
      this.diarios.debe       = register[id].debe;
      this.diarios.haber      = register[id].haber;
      this.diarios.comentario = register[id].comentario;
      this.diarios.fecha = register[id].fecha;
      if (register[id].tipo == 'ajustado') {
        this.diarios.ajustado = true;
      } else {
      this.diarios.ajustado = false;
      }
      this.diarios.tipo = register[id].tipo;

  
      $('#dg-transaccion').modal('show');

    },

    deleteRegistro(id){
       Swal.fire({
        title: 'Seguro que deseas eliminar este registro??',
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro se elimino',
            'success'
          );
           this.registros.splice(id, 1);
            this.totalDebe();
            this.totalHaber();
            this.totalesFinales();
        }
      });
     

    },

    deleteAjuste(id){
             Swal.fire({
        title: 'Seguro que deseas eliminar este registro??',
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro se elimino',
            'success'
          );
       this.ajustes.splice(id, 1);
      this.totalDebe();
      this.totalHaber();
      this.totalesFinales();
        }
      });
      

    },
    updaterRegister(){
    let id = this.registerindex;
    let total_debe = 0;
      let total_haber = 0;
      
      this.diarios.debe.forEach(function(debe, id){
                let saldo = debe.saldo;
                    total_debe += Number(saldo);
              });
      this.diarios.haber.forEach(function(haber, id){
                let saldo = haber.saldo;
                    total_haber += Number(saldo);
              });

      if (this.diarios.debe == 0) {
         toastr.error("No tienes transaccion para guardar", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.comentario.trim() === '') {
         toastr.error("Debes agregar un comentario", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.fecha.trim() === '') {
         toastr.error("Debes agregar la fecha", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (total_haber != total_debe) {
         toastr.error("El Total de Debe y Haber no coinciden", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else{
          if (this.diarios.tipo == 'ajustado' && this.diarios.ajustado == true) {
            
            this.diarios.debe.forEach(function(sal, id){
                sal.fecha = '';
              });
            this.diarios.debe[0].fecha  = this.diarios.fecha;
            this.ajustes[id].debe       = this.diarios.debe;
            this.ajustes[id].haber      = this.diarios.haber;
            this.ajustes[id].comentario = this.diarios.comentario;
            this.ajustes[id].fecha      = this.diarios.fecha;
          } else if(this.diarios.tipo == 'ajustado' && this.diarios.ajustado !== true){

            let register = JSON.parse(JSON.stringify(this.ajustes[id]));

            this.diarios.debe.forEach(function(sal, id){
              sal.fecha = '';
            });
            this.diarios.debe[0].fecha = this.diarios.fecha;
            register.debe               = this.diarios.debe;
            register.haber              = this.diarios.haber;
            register.comentario         = this.diarios.comentario;
            register.fecha              = this.diarios.fecha;
            register.tipo               = 'normal';
            this.registros.push(register);
            this.ajustes.splice(id, 1);



          }else if(this.diarios.tipo == 'normal' && this.diarios.ajustado == false){
             this.diarios.debe.forEach(function(sal, id){
              sal.fecha = '';
            });
            this.diarios.debe[0].fecha    = this.diarios.fecha;
            this.registros[id].debe       = this.diarios.debe;
            this.registros[id].haber      = this.diarios.haber;
            this.registros[id].comentario = this.diarios.comentario;
            this.registros[id].fecha      = this.diarios.fecha;

          }else if(this.diarios.tipo == 'normal' && this.diarios.ajustado == true){

            let register = JSON.parse(JSON.stringify(this.registros[id]));
           this.diarios.debe.forEach(function(sal, id){
              sal.fecha = '';
            console.log(sal.fecha);

            });
            console.log(register);
            this.diarios.debe[0].fecha = this.diarios.fecha;
            register.debe              = this.diarios.debe;
            register.haber             = this.diarios.haber;
            register.comentario        = this.diarios.comentario;
            register.fecha             = this.diarios.fecha;
            register.tipo              = 'ajustado';
            this.ajustes.push(register);
            this.registros.splice(id, 1);


          }
          this.diarios.debe =   [];
          this.diarios.haber = [];
          this.diarios.comentario = '';
          this.diarios.fecha = '';
          this.diarios.tipo = '';
          this.diarios.ajustado = false;

          this.totalDebe();
          this.totalHaber();
          this.totalesFinales();

          $('#dg-transaccion').modal('hide');

        }
    },
  
    updateHaber(){
      let id     =  this.diario.haber.nom_cuenta;
      let index  = this.diario.haber.index;
      let cuenta = this.cuentas.filter(x => x.id == id);
      console.log(cuenta)
      let valor  = this.diario.haber.saldo;
      if (cuenta[0].porcentual == 1) {
        let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
        this.diarios.haber[index].nom_cuenta = cuenta[0].nombre;
        this.diarios.haber[index].saldo      = calculo;
      }else{
        this.diarios.haber[index].cuenta_id = id;
        this.diarios.haber[index].nom_cuenta = cuenta[0].nombre;
        this.diarios.haber[index].saldo      = valor;
      }
        this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo      = '';
        this.diario.haber.edit       = false;
    },
    habediarioEdit(index){
        this.diario.debe.fecha = '';
        this.diario.debe.nom_cuenta = '';
        this.diario.debe.saldo      = '';
        this.diario.debe.edit       = false;
      this.diario.haber.index = index;
      let id_cuenta = this.diarios.haber[index].cuenta_id;

      let cuenta = this.cuentas.filter(x => x.id == id_cuenta);
      console.log(cuenta)
      if (cuenta[0].porcentual == 1){

        this.diario.haber.nom_cuenta = id_cuenta;
        this.diario.haber.saldo      = '';
      }else{

        this.diario.haber.nom_cuenta = id_cuenta;
        this.diario.haber.saldo      = this.diarios.haber[index].saldo;
      }
        this.diario.haber.edit       = true;

      $('#haber-diario-tab').tab('show'); 
    },

   totalesFinales: function(){
        this.total.debe = 0;
        this.total.haber = 0;
        var regis = this.ajustes;
        var total = 0;        
        var total1 = 0;        
        regis.forEach(function(obj, index){
          obj.debe.forEach(function(sal, id){
            total += Number(sal.saldo);
          })
        });
        // console.log(total);
        this.total.debe = Number(this.pasan.debe + total).toFixed(2);

          regis.forEach(function(obj, index){
          obj.haber.forEach(function(sal, id){
            total1 += Number(sal.saldo);
          })
        });
        this.total.haber = Number(this.pasan.haber + total1).toFixed(2);


      },
    
     debediairoEdit(index){
       this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo      = '';
        this.diario.haber.edit       = false;
      this.diario.debe.index = index;
      let id_cuenta = this.diarios.debe[index].cuenta_id;

      if (this.diarios.debe[index].fecha !== '') {
        this.diario.debe.fecha  = this.diarios.debe[index].fecha;  
      }else{
        this.diario.debe.fecha  = '';  
      }
      let cuenta = this.cuentas.filter(x => x.id == id_cuenta);
      // console.log(cuenta)
      if (cuenta[0].porcentual == 1){
        this.diario.debe.nom_cuenta = id_cuenta;
        this.diario.debe.saldo      = '';
      }else{
        this.diario.debe.nom_cuenta = id_cuenta;
        this.diario.debe.saldo      = this.diarios.debe[index].saldo;
      }
        this.diario.debe.edit       = true;
      $('#debe-diario-tab').tab('show'); 
    },
    cancelarEdicion(cuenta){
      if (cuenta == 'debe') {
        this.diario.debe.fecha = '';
        this.diario.debe.nom_cuenta = '';
        this.diario.debe.saldo      = '';
        this.diario.debe.edit       = false;
      } else {
        this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo      = '';
        this.diario.haber.edit       = false;
      }
    },
    updateDebe(){
      let id     =  this.diario.debe.nom_cuenta;
      let index  = this.diario.debe.index;
      let cuenta = this.cuentas.filter(x => x.id == id);
      console.log(cuenta)
      let valor  = this.diario.debe.saldo;
      if (this.diario.debe.fecha !== '') {
         this.diarios.debe[index].fecha = this.diario.debe.fecha; 
      }
      if (cuenta[0].porcentual == 1) {
        let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
        this.diarios.debe[index].nom_cuenta = cuenta[0].nombre;
        this.diarios.debe[index].saldo      = calculo;
      }else{
        this.diarios.debe[index].nom_cuenta = cuenta[0].nombre;
        this.diarios.debe[index].saldo      = valor;
      }
        this.diarios.debe[index].cuenta_id = id;
      
      if (this.diario.debe.fecha !== '') {
        this.diario.debe.fecha = ''; 
      }
        this.diario.debe.nom_cuenta = '';
        this.diario.debe.saldo      = '';
        this.diario.debe.edit       = false;

    },
    debeDelete(index){
      this.edit.debe.splice(index, 1);
    },
     totalDebeBi: function(){
            let balan = this.balanceInicial;
            let total = 0; 
            balan.debe.forEach(function(obj, index){
                total += Number(obj.saldo);
            });
            // console.log(total);        
            this.balanceInicial.totaldebe = total;
            

          },
    totalHaberBi: function(){
            let balan = this.balanceInicial;
            let total = 0; 
            balan.haber.forEach(function(obj, index){
                total += Number(obj.saldo);
            });
            // console.log(total);        
            this.balanceInicial.totalhaber = total;
            this.totalesFinales();
            
          },
    totalDebe: function(){
            this.pasan.debe = 0;
            let regis = this.registros;
            let total = 0;        
            regis.forEach(function(obj, index){
              obj.debe.forEach(function(sal, id){
                total += Number(sal.saldo);
              })
            });
            // console.log(total);
            this.pasan.debe = this.balanceInicial.totaldebe + total;
          },
        totalHaber: function(){
            this.pasan.haber = 0;
            let regis = this.registros;
            let total = 0;
            
            regis.forEach(function(obj, index){
              obj.haber.forEach(function(sal, id){
                total += Number(sal.saldo);
              })
            });
            // console.log(total);  
            this.pasan.haber =  this.balanceInicial.totalhaber +  total;
          }, 
  guardarDiario: function(){
      const union = this.registros.concat(this.ajustes);
      if (union.length == 0) {
           toastr.error('No tienes registros para guardar', "Smarmoddle", {
                    "timeOut": "3000"
                   });
      }else{
         console.log(union)
        let _this = this;
        let url = '/sistema/admin/taller/diario';
            axios.post(url,{
              id: _this.id_taller,
              registro: union,
              nombre: _this.nombre,
              total_debe: _this.total.debe,
              total_haber: _this.total.haber,
             
        }).then(response => {
          if (response.data.success == false) {
                    toastr.error(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
          }else if(response.data.success == 'act'){
            toastr.success("Diario General Actualizado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
           mayor_general.obtenerDiarioGeneral();
           librocaja.obtenerDiarioGeneral();
           librosbanco.obtenerDiarioGeneral();
           reten_iva.obtenerDiarioGeneral();
           
          }else{
           toastr.success("Diario General Creado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
          
          _this.dato     = response.data;
   
           mayor_general.obtenerDiarioGeneral();
           librocaja.obtenerDiarioGeneral();
           librosbanco.obtenerDiarioGeneral();
           reten_iva.obtenerDiarioGeneral();


            //
            }          
        }).catch(function(error){
        });  



      }
     
      },
    obtenerDiarioGeneral: function(){
        var _this = this;
        var url = '/sistema/admin/taller/diariogeneral';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.registros = response.data.registros;
          _this.ajustes = response.data.ajustes;
          _this.nombre = response.data.nombre;
          if ( response.data.tieneinicial == true) {
            let inicial = response.data.inicial;
            _this.registros.unshift(inicial);
          }
          
          // _this.complete = true;
           this.totalDebe();
           this.totalHaber();
           this.totalesFinales();
           toastr.success("Diairo General cargado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
            }          
        }).catch(function(error){

        }); 
    }

    }
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////MAYOR GENERAL//////// /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
let mayor_general = new Vue({
  el: "#mayor_general",
  data:{
     id_taller: taller,
      nombre:'',
      nombre_dgral:'',
      fechabalance:'',
      complete:false,
      options: objeto,
      cuentas: cuentas,
       dgeneral:[],
        nombre_kardex:'',
        producto_kardex:'',
        registros:[],
        eliminar:{
        index:''
       },
       eliminar:{
        nombre:'',
        index:'',
       },
       ajustes:[],
       registerindex: 0,
       cuentaindex: 0,
        mayores:{
          registros:[],
          cierres:[],
          cuenta:'',
          total_debe:'',
          total_haber:'',
          total_saldo:'',
        },
        mayor:{
          seleccion:'',
          registro:{
            edit: false,
            cierre:false,
            index:'',
            fecha:'',
            detalle:'',
            debe:'',
            haber:'',
            saldo:'',
          },
          cuenta:'',
          tipo:'',
        },
        update:false,
        registros_cierres:[],
nombre_cierre:''
  },
  mounted: function() {
    this.obtenerDiarioGeneral();
    this.obtenerMayorGeneral();
    this.obtenerAsientoCierre();
  },
  methods:{
    calculadora(){
     let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    obtenerAsientoCierre: function(){
        var _this = this;
        var url = '/sistema/admin/taller/asiento-cierre-obtener';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.registros_cierres = response.data.registros;
          _this.nombre_cierre = response.data.nombre;  
       
            }          
        }).catch(function(error){

        }); 
    },

    formatoFecha(fecha){
      if (fecha !== null ) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
    onSelect(){
      if (this.mayor.seleccion == null) {
        this.update            = false;

      this.mayores.registros =[];
      this.mayores.cierres   =[];
      this.mayores.cuenta   = '';
     
      this.mayor.registro.cierre = false;
      this.mayor.registro.detalle = '';
      this.mayor.registro.fecha = '';
      this.mayor.registro.debe = '';
      this.mayor.registro.haber = '';
      this.mayor.registro.saldo = '';
        return

      }
      let id = this.mayor.seleccion.value;
      let cuenta = this.registros.filter(x => x.cuenta_id == id);
      console.log(id);
      if (cuenta.length > 0) {
      this.update            = true;

      this.mayores.registros = cuenta[0].registros;
      this.mayores.cierres   = cuenta[0].cierres;
      this.mayor.cuenta   = cuenta[0].cuenta_id;
      }else{
      this.update            = false;
      this.mayores.registros =[];
      this.mayores.cierres   =[];
      this.mayor.cuenta   = id;
      this.mayor.registro.cierre = false;
      this.mayor.registro.detalle = '';
      this.mayor.registro.fecha = '';
      this.mayor.registro.debe = '';
      this.mayor.registro.haber = '';
      this.mayor.registro.saldo = '';
      }

    
      
    },
     abrirTransaccion(){
      this.update            = false;
      this.mayores.registros =[];
      this.mayores.cierres   =[];
      this.mayor.cuenta      = '';
      this.mayores.cuenta      = '';
      this.mayor.seleccion      = '';
      this.mayor.registro.cierre = false;
      this.mayor.registro.detalle = '';
      this.mayor.registro.fecha = '';
      this.mayor.registro.debe = '';
      this.mayor.registro.haber = '';
      this.mayor.registro.saldo = '';

      $('#mg-transaccion').modal('show');
    },
    numberFormat(numero){
      let number = numero;

      let nuevo = new Intl.NumberFormat("de-DE").format(numero);
      return nuevo;
    },
    agregarCelda(){
    if(this.mayor.registro.fecha == ''){
      toastr.error("El campo fecha es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });

     } else if(this.mayor.registro.detalle == ''){
      toastr.error("El campo detalle es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });
     }else{
      let saldo = Number(this.mayor.registro.saldo).toFixed(2);
      let debe = this.decimales(this.mayor.registro.debe);
      let haber = this.decimales(this.mayor.registro.haber);
      if (this.mayor.registro.cierre == true) {
         let registro = {tipo:'', fecha:this.mayor.registro.fecha, detalle:this.mayor.registro.detalle, debe:debe, haber:haber, saldo:saldo};
          this.mayores.cierres.push(registro);
      }else{
          let registro = {tipo:'', fecha:this.mayor.registro.fecha, detalle:this.mayor.registro.detalle, debe:debe, haber:haber, saldo:saldo};
          this.mayores.registros.push(registro);
      }
      toastr.success("Movimiento agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
      });
                this.mayor.registro.fecha ='';
                this.mayor.registro.detalle ='';
                this.mayor.registro.debe ='';
                this.mayor.registro.haber ='';
                this.mayor.registro.saldo ='';
                this.mayor.registro.cierre = false;
      }     
    },
    deleteNormal(index){
      this.mayores.registros.splice(index, 1);
    },
    deleteCierre(index){
      this.mayores.cierres.splice(index, 1);
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return '';
    }
     
    },
    guardarRegistro(){
      if (this.mayores.registros.length == 0) {
         toastr.error("No tienes transaccion para guardar", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.mayor.cuenta == '') {
         toastr.error("Debes seleccionar una cuenta", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else{

      let tdebe = 0;
      let thaber = 0;
      
      this.mayores.registros.forEach(function(debe, id){
                let saldo = debe.debe;
                    tdebe += Number(saldo);
              });
      this.mayores.registros.forEach(function(haber, id){
                let saldo = haber.haber;
                    thaber += Number(saldo);
              });

      let id       = this.mayor.cuenta;
      let nombre   = funciones.obtenerNombre(id);
    
      if (this.mayores.cierres.length >= 1) {
         let registro = {cuenta_id: id, cuenta:nombre, registros:this.mayores.registros, cierres:this.mayores.cierres, total_debe: tdebe, total_haber: thaber, total_saldo:'-0-'};
        this.registros.push(registro);//añadimos el la variable persona al array
      }else{
        let registro = {cuenta_id: id, cuenta:nombre, registros:this.mayores.registros, cierres:this.mayores.cierres, total_debe: tdebe, total_haber: thaber, total_saldo:''};
        this.registros.push(registro);//añadimos el la variable persona al array
      }
    

                //Limpiamos los campos
                toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.mayores.registros =[];
                this.mayores.cierres   =[];
                this.mayor.cuenta      = '';
                this.mayor.seleccion   = '';
                this.mayor.registro.cierre  = false;
          
      }
     
    },
    editarTransaccion(id){
      let register = JSON.parse(JSON.stringify(this.registros));
      this.update            = true;
      this.registerindex     = id;
      this.mayores.registros =[];
      this.mayores.cierres   =[];
      this.mayores.registros = register[id].registros;
      this.mayores.cierres   = register[id].cierres;
      this.mayor.seleccion   ={text: register[id].cuenta, value: register[id].cuenta_id};
      this.onSelect();
      $('#mg-transaccion').modal('show');
    },
        updaterRegister(){
      let id = this.mayor.cuenta;
      let tdebe = 0;
      let thaber = 0;
      let cuenta  = this.registros.filter(x => x.cuenta_id == id);
      console.log(cuenta)
      cuenta[0].registros.forEach(function(debe, id){
                let saldo = debe.debe;
                    tdebe += Number(saldo);
              });
      cuenta[0].registros.forEach(function(haber, id){
                let saldo = haber.haber;
                    thaber += Number(saldo);
              });
      cuenta[0].total_debe = tdebe;
      cuenta[0].total_haber = thaber;
      if (this.mayores.cierres.length >= 1) {
        cuenta[0].total_saldo = '-0-';
      }else{
        cuenta[0].total_saldo = '';
      }
      this.mayores.registros =[];
      this.mayores.cierres   =[];
      this.mayor.cuenta      = '';
      this.mayores.cuenta      = '';
      this.mayor.seleccion      = '';
      this.mayor.registro.cierre = false;
      this.mayor.registro.detalle = '';
      this.mayor.registro.fecha = '';
      this.mayor.registro.debe = '';
      this.mayor.registro.haber = '';
      this.mayor.registro.saldo = '';
            toastr.success("Registro Actualizado Correctamente ", "Smarmoddle", {
                "timeOut": "3000"
            });
        
    },
        obtenerDiarioGeneral: function(){
        var _this = this;
        var url = '/sistema/admin/taller/diariogeneral';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.dgeneral = response.data.registros;
          _this.ajustes = response.data.ajustes;
          _this.nombre_dgral = response.data.nombre;
          let inicial = response.data.inicial;
            _this.dgeneral.unshift(inicial);
            }          
        }).catch(function(error){

        }); 
    },
    warningEliminar(id){
      this.eliminar.index = id;
      this.eliminar.nombre = this.registros[id].cuenta;
            Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+this.eliminar.nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.eliminar.nombre,
            'success'
          );
          this.registros.splice(id, 1);
          
        }
      });

    },
    eliminarRegistro(){
      let id = this.eliminar.index;
      this.registros.splice(id, 1);
      this.eliminar.index = '';
      this.eliminar.nombre = '';
      $('#eliminar-mg').modal('hide');

    },
      guardarMayor: function(){
     
      if (this.registros.length == 0) {
           toastr.error('No tienes registros para guardar', "Smarmoddle", {
                    "timeOut": "3000"
                   });
      }else{
        let _this = this;
        let url = '/sistema/admin/taller/mayor';
            axios.post(url,{
              id: _this.id_taller,
              registro: _this.registros,
              nombre: _this.nombre,
        }).then(response => {
          if (response.data.success == false) {
                    toastr.error(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
          }else if(response.data.success == 'act'){
            toastr.success("Mayor General Actualizado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
         
            balance_comp.obtenerMayorGeneral();
            hoja_trabajo.obtenerMayorGeneral();
          }else{
           toastr.success("Mayor General Creado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
             balance_comp.obtenerMayorGeneral();
            hoja_trabajo.obtenerMayorGeneral();
            }          
        }).catch(function(error){
        });  



      }
     
      },
          obtenerMayorGeneral: function(){
        var _this = this;
        var url = '/sistema/admin/taller/mayorgeneral';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.registros = response.data.registros;
          _this.nombre = response.data.nombre;
          console.log(response.data.registros)
         
           toastr.success("Mayor General cargado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
            }          
        }).catch(function(error){

        }); 
    }
  }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////BALANCE DE COMPROBACION /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


const balance_comp = new Vue({
  el: '#balance_comp',
  data:{
    nombre:'',
    fecha:'',
    enunciados: ``,
    id_taller: taller,
    nombre_mayor:'',
    options: objeto,
    cuentas: cuentas,
    balances:[], //array del balance de COMPROBACION
    balance:{ //variables a utilizar para el balance de COMPROBACION
      cuenta:'',
      suma_debe:'',
      suma_haber:'',
      saldo_debe:'',
      saldo_haber:'',
      edit:false,
      const_id:''
    },
    mayorgeneral:[],
    suman:{ //suma total del balance COMPROBACION
      sum_debe:0,
      sum_haber:0,
      sal_debe:0,
      sal_haber:0,
    },
    update: false,
    registro_id:0

  },
  mounted: function(){
    this.obtenerBalanceCom();
    this.obtenerMayorGeneral();
  },
  methods:{
    calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
        verificarCuenta(id){
        if (Number(this.balance.const_id) === id) {
            return false
          }
           let ac  = this.balances.filter(x => x.cuenta_id == id);
           
            if (ac.length > 0) {
            return true
             }else{
              return false
            }
          },
          decimales(saldo){
            let vacio = '';
          if (saldo !== null && saldo !== '' && saldo !== 0) {
             let total = Number(saldo).toFixed(2);
          return total;
        }else{
          return vacio
        }
         
        },
        formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
      obtenerMayorGeneral: function(){
        var _this = this;
        var url = '/sistema/admin/taller/mayorgeneral';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.mayorgeneral = response.data.registros;
          _this.nombre_mayor = response.data.nombre;
         
         
                     }          
        }).catch(function(error){

        }); 
    },
    abrirTransaccion(){
      this.update             = false;
      this.balance.cuenta      ='';
      this.balance.edit      =false;
      this.balance.suma_debe   ='';
      this.balance.suma_haber  ='';
      this.balance.saldo_debe ='';
      this.balance.saldo_haber = '';
      $('#bc-transaccion').modal('show');
      


    },
    sumas(){
      let debe = Number(this.balance.suma_debe);
      let haber = Number(this.balance.suma_haber);
      if (debe > haber) {
        this.balance.saldo_debe = Number(debe - haber).toFixed(2);
        this.balance.saldo_haber = '';
      }else{
        this.balance.saldo_haber = Number(haber - debe).toFixed(2);
        this.balance.saldo_debe = '';

      }
    },
    mover(){
      this.update = false;
      this.balance.cuenta =''
     this.balance.suma_debe=''
     this.balance.suma_haber=''
    },
        log: function(evt) {
      window.console.log(evt);
    },
    totales: function(){
            this.suman.sum_debe  = 0;
            this.suman.sum_haber = 0;
            this.suman.sal_debe  = 0;
            this.suman.sal_haber = 0;
            let regis = this.balances;
            let total1 = 0;
            let total2 = 0;
            let total3 = 0;
            let total4 = 0;
            
            regis.forEach(function(obj, index){
                total1 += Number(obj.suma_debe );
            });

             regis.forEach(function(obj, index){
                total2 += Number(obj.suma_haber );
            }); 
             regis.forEach(function(obj, index){
                total3 += Number(obj.saldo_debe );
            }); 
             regis.forEach(function(obj, index){
                total4 += Number(obj.saldo_haber );
            });  
            this.suman.sum_debe =   total1.toFixed(2);
            this.suman.sum_haber =   total2.toFixed(2);
            this.suman.sal_debe =   total3.toFixed(2);
            this.suman.sal_haber =   total4.toFixed(2);

          }, 

    agregarRegistro(){

     if(this.balance.cuenta ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });


     }else {
      let id       = this.balance.cuenta;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{

      let nombre   = funciones.obtenerNombre(id);
      // this.sumas()
      var balance ={ cuenta_id: id, cuenta:nombre, suma_debe:this.balance.suma_debe, suma_haber:this.balance.suma_haber, saldo_debe:this.balance.saldo_debe, saldo_haber:this.balance.saldo_haber}
      this.balances.push(balance);
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
    });

     this.balance.cuenta      =''
     this.balance.suma_debe   =''
     this.balance.saldo_debe  =''
     this.balance.suma_haber  =''
     this.balance.saldo_haber =''
     this.totales();

     }    
     }            
      }, //fin metodo agregar registro   
      deleteBalance(index){
             Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+this.balances[index].cuenta ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.balances[index].cuenta ,
            'success'
          );
           this.balances.splice(index, 1);
           this.cancelarEdicion();
        this.totales();
        }
      });
       
      },//fin metodo delete cuenta 
      

      editBalance(index){
       this.balance.edit = true;
       this.registro_id = index;
       this.balance.const_id = this.balances[index].cuenta_id;
       this.balance.cuenta     = this.balances[index].cuenta_id;
       this.balance.suma_debe  = this.balances[index].suma_debe;
       this.balance.suma_haber = this.balances[index].suma_haber;
       this.balance.saldo_debe = this.balances[index].saldo_debe;
       this.balance.saldo_haber = this.balances[index].saldo_haber;
              
      },
        editBalanceFuera(index){
       this.balance.edit = true;
       this.registro_id = index;
       this.balance.const_id = this.balances[index].cuenta_id;
       this.balance.cuenta     = this.balances[index].cuenta_id;
       this.balance.suma_debe  = this.balances[index].suma_debe;
       this.balance.suma_haber = this.balances[index].suma_haber;
       this.balance.saldo_debe = this.balances[index].saldo_debe;
       this.balance.saldo_haber = this.balances[index].saldo_haber;
      $('#bc-transaccion').modal('show');


              
      },
       cancelarEdicion(){
        this.balance.cuenta      =''
        this.balance.suma_debe   =''
        this.balance.suma_haber  =''
        this.balance.saldo_haber =''
        this.balance.saldo_debe =''
        this.balance.edit        = false;
     
    },
    actualizarBalance(){
      if(this.balance.cuenta ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });


     }else {
        // this.sumas();
        let index = this.registro_id;
        let id       = this.balance.cuenta;
        let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
        let nombre   = funciones.obtenerNombre(id);
        this.balances[index].cuenta     = nombre;
        this.balances[index].cuenta_id  = id;
        this.balances[index].suma_debe  = this.balance.suma_debe;
        this.balances[index].suma_haber = this.balance.suma_haber;
        this.balances[index].saldo_debe = this.balance.saldo_debe;
        this.balances[index].saldo_haber = this.balance.saldo_haber;

        this.balance.cuenta      =''
        this.balance.suma_debe   =''
        this.balance.suma_haber  =''
        this.balance.saldo_debe =''
        this.balance.saldo_haber =''
        this.balance.edit        = false;
        this.totales();

      }
    }
    },
    guardarBalance: function() {
        if(this.balances.length == 0){
          toastr.error("Debe haber al menos un registro en el Balance", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else if(this.fecha == '' || this.nombre == ''){
          toastr.error("Fecha y Nombre son obligaorios", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else{
        let _this = this;
        let url = '/sistema/admin/taller/balance-comprobacion';
            axios.post(url,{
              id: _this.id_taller,
              nombre:_this.nombre,
              fecha:_this.fecha,
              balances: _this.balances,
              sum_debe: _this.suman.sum_debe,
              sum_haber: _this.suman.sum_haber,
              sal_debe: _this.suman.sal_debe,
              sal_haber: _this.suman.sal_haber,

        }).then(response => {
          if (response.data.estado == 'guardado') {
              toastr.success("Balance creado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              hoja_trabajo.obtenerBalanceCom();

            }else if (response.data.estado == 'actualizado') {
              toastr.warning("Balance actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });

              console.log(this.balances)
              hoja_trabajo.obtenerBalanceCom();
            }        
        }).catch(function(error){

        }); 

     } 
     
     },
        obtenerBalanceCom: function() {
        let _this = this;
        let url = '/sistema/admin/taller/balance-obtener-comprobacion';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              toastr.info("Balance de Comprobacion cargado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              this.balances = response.data.bcomprobacion;
              this.nombre = response.data.nombre;
              this.fecha = response.data.fecha;
              this.totales();
            }          
        }).catch(function(error){

        }); 
     } 
     
  }
  
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////HOJA DE TRABAJO ////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



let hoja_trabajo = new Vue({
  el: "#hoja_trabajo",
  data:{
    id_taller: taller,
    nombre:'',
     options: objeto,
    cuentas: cuentas,
    balances:[],
    nombre_mayor:'',
    mayorgeneral:[],
    nombre_balance:'',
    eliminar:{
      index:'',
      nombre:''
    },
    fecha_balance:'',
    registros:[],
    registro_id:'',
    registro:{
      edit:false,
      const_id:'',
      cuenta_id:'',
      balance_comp:{
        debe:'',
        haber:''
      },
       ajustes:{
        debe:'',
        haber:''
      },
       balance_ajustado:{
        debe:'',
        haber:''
      },
       estado_resultado:{
        debe:'',
        haber:''
      },
       balance_general:{
        debe:'',
        haber:''
      },
    },
    suman:{
      balance_comp:{
        total_debe:0,
        total_haber:0
      },
       ajustes:{
        total_debe:0,
        total_haber:0
      },
       balance_ajustado:{
        total_debe:0,
        total_haber:0
      },
       estado_resultado:{
        total_debe:0,
        total_haber:0
      },
       balance_general:{
        total_debe:0,
        total_haber:0
      },
    },
    update:false
  },
  mounted: function () {
    this.obtenerBalanceCom();
    this.obtenerMayorGeneral();
    this.obtenerHojita();
  },
  methods:{
  calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    sumasTotales(){
      let registros    = this.registros;
      let bc_debe      = 0;
      let bc_haber     = 0;
      let ajuste_debe  = 0;
      let ajuste_haber = 0;
      let ba_debe      = 0;
      let ba_haber     = 0;
      let er_debe      = 0;
      let er_haber     = 0;
      let bg_debe      = 0;
      let bg_haber     = 0;

        //INGRESO CANTIDAD
       registros.forEach(function(registro, i){
                let temp = registro.bc_debe;
                if (temp != null && temp !=='') {
                    bc_debe += Number(temp);
                } 
            });
       this.suman.balance_comp.total_debe = bc_debe.toFixed(2);

         registros.forEach(function(registro, i){
                let temp = registro.bc_haber;
                if (temp != null && temp !=='') {
                    bc_haber += Number(temp);
                } 
            });
       this.suman.balance_comp.total_haber = bc_haber.toFixed(2);


             registros.forEach(function(registro, i){
                let temp = registro.ajuste_debe;
                if (temp != null && temp !=='') {
                    ajuste_debe += Number(temp);
                } 
            });
       this.suman.ajustes.total_debe = ajuste_debe.toFixed(2);

         registros.forEach(function(registro, i){
                let temp = registro.ajuste_haber;
                if (temp != null && temp !=='') {
                    ajuste_haber += Number(temp);
                } 
            });
       this.suman.ajustes.total_haber = ajuste_haber.toFixed(2);

                registros.forEach(function(registro, i){
                let temp = registro.ba_debe;
                if (temp != null && temp !=='') {
                    ba_debe += Number(temp);
                } 
            });
       this.suman.balance_ajustado.total_debe = ba_debe.toFixed(2);

         registros.forEach(function(registro, i){
                let temp = registro.ba_haber;
                if (temp != null && temp !=='') {
                    ba_haber += Number(temp);
                } 
            });
       this.suman.balance_ajustado.total_haber = ba_haber.toFixed(2);

              registros.forEach(function(registro, i){
                let temp = registro.er_debe;
                if (temp != null && temp !=='') {
                    er_debe += Number(temp);
                } 
            });
       this.suman.estado_resultado.total_debe = er_debe.toFixed(2);

         registros.forEach(function(registro, i){
                let temp = registro.er_haber;
                if (temp != null && temp !=='') {
                    er_haber += Number(temp);
                } 
            });
       this.suman.estado_resultado.total_haber = er_haber.toFixed(2);

         registros.forEach(function(registro, i){
                let temp = registro.bg_debe;
                if (temp != null && temp !=='') {
                    bg_debe += Number(temp);
                } 
            });
       this.suman.balance_general.total_debe = bg_debe.toFixed(2);

         registros.forEach(function(registro, i){
                let temp = registro.bg_haber;
                if (temp != null && temp !=='') {
                    bg_haber += Number(temp);
                } 
            });
       this.suman.balance_general.total_haber = bg_haber.toFixed(2);
       
       


    },
  verificarCuenta(id){
    if (Number(this.registro.const_id) === id) {
      return false
    }
     let ac  = this.registros.filter(x => x.cuenta_id == id);

      if (ac.length > 0) {
      return true
       }else{
        return false
      }
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
  formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
    abrirTransaccion(){
       this.update             = false;
     

      $('#ht-transaccion').modal('show');
    },
  agregarRegistro(){
    if(this.registro.cuenta_id == ''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });
    }else{
      let id = this.registro.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
      let nombre   = funciones.obtenerNombre(id);
      
      let balance ={ cuenta_id: id, cuenta:nombre, bc_debe:this.registro.balance_comp.debe, bc_haber:this.registro.balance_comp.haber, ajuste_debe:this.registro.ajustes.debe, ajuste_haber:this.registro.ajustes.haber, ba_debe:this.registro.balance_ajustado.debe, ba_haber:this.registro.balance_ajustado.haber, er_debe:this.registro.estado_resultado.debe, er_haber:this.registro.estado_resultado.haber, bg_debe:this.registro.balance_general.debe, bg_haber:this.registro.balance_general.haber}
      this.registros.push(balance);
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
      });
      this.registro.cuenta_id              = '';
      this.registro.balance_comp.debe      = '';
      this.registro.balance_comp.haber     = '';
      this.registro.ajustes.debe           = '';
      this.registro.ajustes.haber          = '';
      this.registro.balance_ajustado.debe  = '';
      this.registro.balance_ajustado.haber = '';
      this.registro.estado_resultado.debe  = '';
      this.registro.estado_resultado.haber = '';
      this.registro.balance_general.debe   = '';
      this.registro.balance_general.haber  = '';
      this.sumasTotales();
      }    
     }            
      },  

      editBalance(index){
       this.registro.edit = true;
       this.registro_id = index;
      this.registro.const_id              = this.registros[index].cuenta_id;
      this.registro.cuenta_id              = this.registros[index].cuenta_id;
      this.registro.balance_comp.debe      = this.registros[index].bc_debe;
      this.registro.balance_comp.haber     = this.registros[index].bc_haber;
      this.registro.ajustes.debe           = this.registros[index].ajuste_debe;
      this.registro.ajustes.haber          = this.registros[index].ajuste_haber;
      this.registro.balance_ajustado.debe  = this.registros[index].ba_debe;
      this.registro.balance_ajustado.haber = this.registros[index].ba_haber;
      this.registro.estado_resultado.debe  = this.registros[index].er_debe;
      this.registro.estado_resultado.haber = this.registros[index].er_haber;
      this.registro.balance_general.debe   = this.registros[index].bg_debe;
      this.registro.balance_general.haber  = this.registros[index].bg_haber;
      
      },
       editBalanceFuera(index){
      this.registro.edit = true;
      this.registro_id = index;
      this.registro.const_id              = this.registros[index].cuenta_id;
      this.registro.cuenta_id              = this.registros[index].cuenta_id;
      this.registro.balance_comp.debe      = this.registros[index].bc_debe;
      this.registro.balance_comp.haber     = this.registros[index].bc_haber;
      this.registro.ajustes.debe           = this.registros[index].ajuste_debe;
      this.registro.ajustes.haber          = this.registros[index].ajuste_haber;
      this.registro.balance_ajustado.debe  = this.registros[index].ba_debe;
      this.registro.balance_ajustado.haber = this.registros[index].ba_haber;
      this.registro.estado_resultado.debe  = this.registros[index].er_debe;
      this.registro.estado_resultado.haber = this.registros[index].er_haber;
      this.registro.balance_general.debe   = this.registros[index].bg_debe;
      this.registro.balance_general.haber  = this.registros[index].bg_haber;
      $('#ht-transaccion').modal('show');   
      },
       cancelarEdicion(){
      this.registro.const_id              = '';
      this.registro.cuenta_id              = '';
      this.registro.balance_comp.debe      = '';
      this.registro.balance_comp.haber     = '';
      this.registro.ajustes.debe           = '';
      this.registro.ajustes.haber          = '';
      this.registro.balance_ajustado.debe  = '';
      this.registro.balance_ajustado.haber = '';
      this.registro.estado_resultado.debe  = '';
      this.registro.estado_resultado.haber = '';
      this.registro.balance_general.debe   = '';
      this.registro.balance_general.haber  = '';
      this.registro.edit        = false;
     
    },
     actualizarBalance(){
      if(this.registro.cuenta_id ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });
     }else {
        let index = this.registro_id;
        let id    = this.registro.cuenta_id;
           let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
        }else{
        let nombre   = funciones.obtenerNombre(id);
        this.registros[index].cuenta       = nombre;
        this.registros[index].cuenta_id    = id;
        this.registros[index].bc_debe      = this.registro.balance_comp.debe;
        this.registros[index].bc_haber     =  this.registro.balance_comp.haber;
        this.registros[index].ajuste_debe  = this.registro.ajustes.debe ;
        this.registros[index].ajuste_haber = this.registro.ajustes.haber;
        this.registros[index].ba_debe      = this.registro.balance_ajustado.debe ;
        this.registros[index].ba_haber     = this.registro.balance_ajustado.haber;
        this.registros[index].er_debe      = this.registro.estado_resultado.debe;
        this.registros[index].er_haber     = this.registro.estado_resultado.haber;
        this.registros[index].bg_debe      = this.registro.balance_general.debe ;
        this.registros[index].bg_haber     = this.registro.balance_general.haber;
        this.cancelarEdicion();
        this.sumasTotales();

        toastr.error("Registro actualizado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
        // this.totales();

      }
    }
    },
      eliminarRegistro(){
      let id = this.eliminar.index;
      this.registros.splice(id, 1);
      this.eliminar.index = '';
      this.eliminar.nombre = '';
      $('#eliminar-ht').modal('hide');

    },
      deleteBalance(index){
        this.registros.splice(index, 1);
        this.sumasTotales();
        
      },
    warningEliminar(id){
      this.eliminar.index = id;
      this.eliminar.nombre = this.registros[id].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+this.eliminar.nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.eliminar.nombre,
            'success'
          );
          this.registros.splice(id, 1);
          this.cancelarEdicion();
          this.sumasTotales();
        }
      });
 

    },
        obtenerBalanceCom: function() {
        let _this = this;
        let url = '/sistema/admin/taller/balance-obtener-comprobacion';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              this.balances       = response.data.bcomprobacion;
              this.nombre_balance = response.data.nombre;
              this.fecha_balance  = response.data.fecha;
            }          
        }).catch(function(error){

        }); 
     },
     obtenerMayorGeneral: function(){
        var _this = this;
        var url = '/sistema/admin/taller/mayorgeneral';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.mayorgeneral = response.data.registros;
          _this.nombre_mayor = response.data.nombre;
          
         
                     }          
        }).catch(function(error){

        }); 
    },
    guardarHoja: function() {
        if(this.registros.length == 0){
          toastr.error("Debe haber al menos un registro en la Hoja", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else if(this.nombre == ''){
          toastr.error("Nombre es obligaorios", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else{
        let _this = this;
        let url = '/sistema/admin/taller/hoja-trabajo';
            axios.post(url,{
              id: _this.id_taller,
              nombre:_this.nombre,
              registros: _this.registros,
              bc_total_debe: _this.suman.balance_comp.total_debe,
              bc_total_haber: _this.suman.balance_comp.total_haber,
              ajuste_total_debe: _this.suman.ajustes.total_debe,
              ajuste_total_haber: _this.suman.ajustes.total_haber,
              ba_total_debe: _this.suman.balance_ajustado.total_debe,
              ba_total_haber: _this.suman.balance_ajustado.total_haber,
              er_total_debe: _this.suman.estado_resultado.total_debe,
              er_total_haber: _this.suman.estado_resultado.total_haber,
              bg_total_debe: _this.suman.balance_general.total_debe,
              bg_total_haber: _this.suman.balance_general.total_haber,

        }).then(response => {
          if (response.data.estado == 'guardado') {
              toastr.success("Hoja de Trabajo Creada Correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              balance_ajustado.obtenerHojita();
              estado_resultado.obtenerHojita();
              balance_general.obtenerHojita();
              asientos_cierre.obtenerHojita();


            }else if (response.data.estado == 'actualizado') {
              toastr.warning("Hoja de Trabajo Actualizada correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              balance_ajustado.obtenerHojita();
              estado_resultado.obtenerHojita();
              balance_general.obtenerHojita();
              asientos_cierre.obtenerHojita();


            }        
        }).catch(function(error){

        }); 

     } 
     
     },
      obtenerHojita: function() {
        let _this = this;
        let url = '/sistema/admin/taller/hoja-obtener-trabajo';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              this.registros = response.data.hojatrabajo;
              this.nombre = response.data.nombre;
              this.sumasTotales();
            }          
        }).catch(function(error){

        }); 
     } 

  }

});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////BALANCE DE COMPROBACION AJUSTADO /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const balance_ajustado = new Vue({
  el: "#balance_ajustado",
  data:{
      id_taller: taller,
      hojatrabajo:[],
      options: objeto,
    cuentas: cuentas,
      nombre_hoja:'',
      nombre:'',
      fecha:'',
    balances_ajustados:[], //array del balance de COMPROBACION
    balance:{ //variables a utilizar para el balance de COMPROBACION
      cuenta_id:'',
      debe:'',
      haber:'',
      const_id:'',
      edit:false,
    },
    suman:{ //suma total del balance COMPROBACION
      debe:0,
      haber:0,
    },
    update: false,
    registro_id:0
  },
   mounted: function(){
    this.obtenerBalanceAjus();
    this.obtenerHojita();
  },
  methods:{
      calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    obtenerHojita: function() {
        let _this = this;
        let url = '/sistema/admin/taller/hoja-obtener-trabajo';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              this.hojatrabajo = response.data.hojatrabajo;
              this.nombre_hoja = response.data.nombre;
             
            }          
        }).catch(function(error){

        }); 
     },
     verificarCuenta(id){
    if (Number(this.balance.const_id) === id) {
      return false
    }
     let ac  = this.balances_ajustados.filter(x => x.cuenta_id == id);

      if (ac.length > 0) {
      return true
       }else{
        return false
      }
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
  formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
     totales: function(){
            this.suman.debe  = 0;
            this.suman.haber = 0;
            let regis = this.balances_ajustados;
            let total1 = 0;
            let total2 = 0;
            
            regis.forEach(function(obj, index){
                total1 += Number(obj.debe );
            });

             regis.forEach(function(obj, index){
                total2 += Number(obj.haber );
            }); 
            this.suman.debe =   total1.toFixed(2);
            this.suman.haber =   total2.toFixed(2);

          }, 
    abrirTransaccion(){
       this.update             = false;
      

      $('#ba-transaccion').modal('show');
    },
    agregarRegistro(){
     if(this.balance.cuenta_id  ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });

 
     }else {
       let id = this.balance.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
      let nombre   = funciones.obtenerNombre(id);
      var balance ={cuenta_id:this.balance.cuenta_id, cuenta:nombre, debe:this.balance.debe, haber:this.balance.haber}
      this.balances_ajustados.push(balance);
      toastr.success("Registro agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
    });

     this.balance.cuenta_id =''
     this.balance.debe      =''
     this.balance.haber     =''
     this.totales();
   }
     }                
      }, //fin metodo agregar registro  

      deleteBalance(index){
        this.balances_ajustados.splice(index, 1);
        this.totales();
      },//fin metodo delete cuenta 
      

      editBalance(index){
       this.balance.edit   = true;
       this.registro_id    = index;
       this.balance.const_id = this.balances_ajustados[index].cuenta_id;
       this.balance.cuenta_id = this.balances_ajustados[index].cuenta_id;
       this.balance.debe   = this.balances_ajustados[index].debe;
       this.balance.haber  = this.balances_ajustados[index].haber;
              
      },
      
      editBalanceFuera(index){
       this.balance.edit   = true;
       this.registro_id    = index;
       this.balance.const_id = this.balances_ajustados[index].cuenta_id;
       this.balance.cuenta_id = this.balances_ajustados[index].cuenta_id;
       this.balance.debe   = this.balances_ajustados[index].debe;
       this.balance.haber  = this.balances_ajustados[index].haber;
      $('#ba-transaccion').modal('show');
        
      },

    cancelarEdicion(){
      this.balance.cuenta_id =''
      this.balance.debe      =''
      this.balance.haber     =''
      this.balance.edit      = false;
     
    },
      actualizarBalance(){
          if(this.balance.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });

    

        }else {
          let id = this.balance.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre   = funciones.obtenerNombre(id);
            let index                             = this.registro_id;
            this.balances_ajustados[index].cuenta_id = this.balance.cuenta_id;
            this.balances_ajustados[index].cuenta = nombre;
            this.balances_ajustados[index].debe   = this.balance.debe;
            this.balances_ajustados[index].haber  = this.balance.haber;
            this.balance.cuenta_id =''
            this.balance.debe   =''
            this.balance.haber  =''
            this.balance.edit   = false;
            this.registro_id = '';
            this.totales();
          }

      }
    },
     warningEliminar(id){
      
      let nombre = this.balances_ajustados[id].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.balances_ajustados.splice(id, 1);
          this.cancelarEdicion();
        }
      });
      

    },
     guardarBalance: function() {
        if(this.balances_ajustados.length == 0){
          toastr.error("Debe haber al menos un registro en el Balance", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else  if(this.nombre == ''){
          toastr.error("El nombre es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else  if(this.fecha == ''){
          toastr.error("La fecha es obligatoria", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else{
        let _this = this;
        let url = '/sistema/admin/taller/balance-ajustado';
            axios.post(url,{
              id: _this.id_taller,
              balances: _this.balances_ajustados,
              total_debe: _this.suman.debe,
              total_haber: _this.suman.haber,
              nombre: _this.nombre,
              fecha: _this.fecha

        }).then(response => {
          if (response.data.estado == 'guardado') {
              toastr.success("Balance creado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            }else if (response.data.estado == 'actualizado') {
              toastr.warning("Balance actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            }        
        }).catch(function(error){

        }); 

     } 
     
     },
      obtenerBalanceAjus: function() {
        let _this = this;
        let url = '/sistema/admin/taller/balance-obtener-ajustado';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              toastr.info("Balance de Comprobacion Ajustado cargado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              this.balances_ajustados = response.data.bcomprobacionAjustado;
              this.nombre = response.data.nombre;
              this.fecha = response.data.fecha;
              this.totales();
            }          
        }).catch(function(error){

        }); 
     } 

  }

  
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////ESTADO RESULTADO ///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



const estado_resultado = new Vue({

  el: "#estado_resultado",
   data:{
    id_taller: taller,
    hojatrabajo:[],
    options: objeto,
    cuentas: cuentas,
    nombre_hoja:'',
    venta:'',
    costo_venta:'',
    producto:'',
    nombre:'',
    fecha:'',
    ingresos:[],
    gastos:[],
    ingreso:{
      cuenta_id:'',
      saldo:'',
      edit:false,
      const_id:''
    },
    utilidad_bruta:{
      costo:'',
      costo_venta:'',
    },
    gasto:{
      cuenta_id:'',
      saldo:'',
      edit:false,
      const_id:''
    },
    utilida:{
      cuenta_id:'',
      saldo:'',
      edit:false,
      create:false,
      const_id:''
    },
    utilidades:[],
    utilidad:'',
  
    update:false,
    registro:{
      ingreso:'',
      gasto:'',
      utilida:'',
    },
    totales:{
        ingreso:0,
      gastos:0,
      utilidad_bruta_ventas:'',
      utilidad_neta_o:0,
      utilidad_ejercicio:'',
      utilidad_liquida:''
    }
  },

  mounted: function () {
    this.obtenerHojita();
    this.obtenerEstadoResultado();
  },
  methods:{
    calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    agregarBruta(){
      this.venta                      = this.utilidad_bruta.venta;
      this.costo_venta                = this.utilidad_bruta.costo_venta;
      toastr.info("Datos agregados", "Smarmoddle", {
            "timeOut": "3000"
            });
 

      let suma_ventas = Number(this.venta - this.costo_venta);
      this.totales.utilidad_bruta_ventas = suma_ventas;
      console.log(suma_ventas)
      this.totale();
    },
    subtotal(){
      let total = Number(this.totales.ingreso) + Number(this.totales.utilidad_bruta_ventas);
      console.log(total);
      this.totales.utilidad_neta_o = Number(total).toFixed(2);
    },
  warningEliminarIngreso(id){
      let nombre = this.ingresos[id].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.ingresos.splice(id, 1);
          this.totale();
     this.subtotal();
        }
      });
     

    },
      warningEliminarGastos(id){
      let nombre = this.gastos[id].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.gastos.splice(id, 1);
          this.totale();
          this.subtotal();
        }
      });
      

    },
      warningEliminarUtilidad(id){
      let nombre = this.utilidades[id].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.utilidades.splice(id, 1);
        }
      });
    

    },
   VueSweetAlert2(component,propsData)
    {
        Swal.fire({
            html: '<div id="VueSweetAlert2"></div>',
            showConfirmButton: false,
            showCloseButton: true,
            willOpen: () => {
                let ComponentClass = Vue.extend(Vue.component(component));
                let instance = new ComponentClass({
                    propsData: propsData,
                });
                instance.$mount();
                document.getElementById('VueSweetAlert2').appendChild(instance.$el);
            }
        });
    },
   totale: function(){
      this.totales.ingreso = 0;
      this.totales.gastos   = 0;
      let ingreso  = this.ingresos;
      let gasto  = this.gastos;
      let total1 = 0;
      let total2 = 0;
      
      ingreso.forEach(function(obj, index){
          total1 += Number(obj.saldo );
      });

       gasto.forEach(function(obj, index){
          total2 += Number(obj.saldo );
      }); 
      this.totales.ingreso =   total1.toFixed(2);
      this.totales.gastos =   total2.toFixed(2);

      console.log(total1)
      console.log(total2)
      this.subtotal();

    }, 
    selectUtilidad(){
      if (this.utilidad == 'perdida') {

      }else if (this.utilidad == 'ganancia') {

      }
    },
  obtenerHojita: function() {
        let _this = this;
        let url = '/sistema/admin/taller/hoja-obtener-trabajo';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              this.hojatrabajo = response.data.hojatrabajo;
              this.nombre_hoja = response.data.nombre;
             
            }          
        }).catch(function(error){

        }); 
     },
      verificarCuentaIngreso(id){
    if (Number(this.ingreso.const_id) === id) {
      return false
    }
     let ac  = this.ingresos.filter(x => x.cuenta_id == id);
     let ga  = this.gastos.filter(x => x.cuenta_id == id);
     let u  = this.utilidades.filter(x => x.cuenta_id == id);

      if (ac.length > 0) {
      return true
      }else if(ga.length > 0) {
        return true
      }else if(u.length > 0) {
        return true
      }else{
        return false
      }
    },
    verificarCuentaGasto(id){
    if (Number(this.gasto.const_id) === id) {
      return false
    }
      let ac  = this.ingresos.filter(x => x.cuenta_id == id);
     let ga  = this.gastos.filter(x => x.cuenta_id == id);
     let u  = this.utilidades.filter(x => x.cuenta_id == id);

      if (ac.length > 0) {
      return true
      }else if(ga.length > 0) {
        return true
      }else if(u.length > 0) {
        return true
      }else{
        return false
      }
    },
  verificarCuentaUtilidad(id){
    if (Number(this.utilida.const_id) === id) {
      return false
    }
        let ac  = this.ingresos.filter(x => x.cuenta_id == id);
     let ga  = this.gastos.filter(x => x.cuenta_id == id);
     let u  = this.utilidades.filter(x => x.cuenta_id == id);

      if (ac.length > 0) {
      return true
      }else if(ga.length > 0) {
        return true
      }else if(u.length > 0) {
        return true
      }else{
        return false
      }
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
  formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
    abrirIngreso(){
      $('#er-ingreso').modal('show');
      $('#nav-er-ingreso-tab').tab('show');


    },
      abrirGastos(){
      $('#er-ingreso').modal('show');
      $('#nav-er-gastos-tab').tab('show');


    },
      abrirUtilidades(){
      $('#er-ingreso').modal('show');
      $('#nav-er-utilidad-tab').tab('show');


    },
    mostrarUtilidades(){
      this.utilida.create = true;
    },
    cerrarUtilidades(){
      this.utilida.create    = false;
      this.utilida.cuenta_id = '' ;
      this.utilida.saldo     = '' ;
      this.utilida.edit      = false ;
      this.utilida.create    = false ;
      this.const_id          = '';
    },
    agregarIngreso(){
     if(this.ingreso.cuenta_id  ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });
  }else {
       let id = this.ingreso.cuenta_id;
         let verificar = this.verificarCuentaIngreso(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
      let nombre   = funciones.obtenerNombre(id);
      var ingreso ={cuenta_id:this.ingreso.cuenta_id, cuenta:nombre, saldo:this.ingreso.saldo}
      this.ingresos.push(ingreso);
      toastr.success("Ingreso agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
      });
     this.ingreso.cuenta_id =''
     this.ingreso.saldo     =''
     this.totale();
     this.subtotal();
   }
     }                
      }, 
      agregarGasto(){
     if(this.gasto.cuenta_id  ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });
  }else {
       let id = this.gasto.cuenta_id;
         let verificar = this.verificarCuentaGasto(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
      let nombre   = funciones.obtenerNombre(id);
      var gasto ={cuenta_id:this.gasto.cuenta_id, cuenta:nombre, saldo:this.gasto.saldo}
      this.gastos.push(gasto);
      toastr.success("Gasto agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
      });
     this.gasto.cuenta_id =''
     this.gasto.saldo     =''
     this.totale();
     this.subtotal();
   }
     }                
      }, 
    agregarUtilidad(){
     if(this.utilida.cuenta_id  ==''){
      toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });
  }else {
       let id = this.utilida.cuenta_id;
         let verificar = this.verificarCuentaUtilidad(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
      let nombre   = funciones.obtenerNombre(id);
      var utilida ={cuenta_id:this.utilida.cuenta_id, cuenta:nombre, saldo:this.utilida.saldo}
      this.utilidades.push(utilida);
      toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
      });
     this.utilida.cuenta_id =''
     this.utilida.saldo     =''
     this.totale();
     this.subtotal();
   }
     }                
      }, 


      editIngreso(index){
       this.ingreso.edit      = true;
       this.registro.ingreso  = index;
       this.ingreso.const_id  = this.ingresos[index].cuenta_id;
       this.ingreso.cuenta_id = this.ingresos[index].cuenta_id;
       this.ingreso.saldo      = this.ingresos[index].saldo;
              
      },
      
      editIngresoFuera(index){
       this.ingreso.edit      = true;
       this.registro.ingreso  = index;
       this.ingreso.const_id  = this.ingresos[index].cuenta_id;
       this.ingreso.cuenta_id = this.ingresos[index].cuenta_id;
       this.ingreso.saldo      = this.ingresos[index].saldo;
       $('#er-ingreso').modal('show');
      $('#nav-er-ingreso-tab').tab('show');
        
      },

    cancelarEdicionIngreso(){
      this.ingreso.cuenta_id =''
      this.ingreso.saldo      =''
      this.ingreso.edit      = false;
     
    },
      actualizarIngreso(){
          if(this.ingreso.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.ingreso.cuenta_id;
         let verificar = this.verificarCuentaIngreso(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                     = funciones.obtenerNombre(id);
            let index                      = this.registro.ingreso;
            this.ingresos[index].cuenta_id = this.ingreso.cuenta_id;
            this.ingresos[index].cuenta    = nombre;
            this.ingresos[index].saldo      = this.ingreso.saldo;
            this.ingreso.cuenta_id         =''
            this.ingreso.saldo             =''
            this.ingreso.edit              = false;
            this.registro.ingreso              = '';
            this.totale();
            this.subtotal();
          }

      }
    },

      editGasto(index){
       this.gasto.edit      = true;
       this.registro.gasto  = index;
       this.gasto.const_id  = this.gastos[index].cuenta_id;
       this.gasto.cuenta_id = this.gastos[index].cuenta_id;
       this.gasto.saldo      = this.gastos[index].saldo;
              
      },
      
      editGastoFuera(index){
       this.gasto.edit      = true;
       this.registro.gasto  = index;
       this.gasto.const_id  = this.gastos[index].cuenta_id;
       this.gasto.cuenta_id = this.gastos[index].cuenta_id;
       this.gasto.saldo      = this.gastos[index].saldo;
       $('#er-ingreso').modal('show');
      $('#nav-er-gastos-tab').tab('show');
        
      },

    cancelarEdicionGasto(){
      this.gasto.cuenta_id =''
      this.gasto.saldo      =''
      this.gasto.edit      = false;
     
    },
      actualizarGasto(){
          if(this.gasto.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.gasto.cuenta_id;
         let verificar = this.verificarCuentaGasto(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                   = funciones.obtenerNombre(id);
            let index                    = this.registro.gasto;
            this.gastos[index].cuenta_id = this.gasto.cuenta_id;
            this.gastos[index].cuenta    = nombre;
            this.gastos[index].saldo     = this.gasto.saldo;
            this.gasto.cuenta_id         =''
            this.gasto.saldo             =''
            this.gasto.edit              = false;
            this.registro.gasto          = '';
           
            this.totales();
            this.subtotal();
          }

      }
    },
      editUtilidad(index){
       this.utilida.create      = true;
       this.utilida.edit      = true;
       this.registro.utilida  = index;
       this.utilida.const_id  = this.utilidades[index].cuenta_id;
       this.utilida.cuenta_id = this.utilidades[index].cuenta_id;
       this.utilida.saldo     = this.utilidades[index].saldo;
              
      },
      
      editUtilidadFuera(index){
       this.utilida.edit      = true;
       this.registro.utilida  = index;
       this.utilida.const_id  = this.utilidades[index].cuenta_id;
       this.utilida.cuenta_id = this.utilidades[index].cuenta_id;
       this.utilida.saldo     = this.utilidades[index].saldo;
       $('#er-ingreso').modal('show');
      $('#nav-er-utilidad-tab').tab('show');
        
      },

    cancelarEdicionUtilidad(){
      this.utilida.cuenta_id =''
      this.utilida.saldo     =''
      this.utilida.edit      = false;
     
    },
      actualizarUtilidad(){
          if(this.utilida.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.utilida.cuenta_id;
         let verificar = this.verificarCuentaUtilidad(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                       = funciones.obtenerNombre(id);
            let index                        = this.registro.utilida;
            this.utilidades[index].cuenta_id = this.utilida.cuenta_id;
            this.utilidades[index].cuenta    = nombre;
            this.utilidades[index].saldo     = this.utilida.saldo;
            this.utilida.cuenta_id           =''
            this.utilida.saldo               =''
            this.utilida.edit                = false;
            this.utilida.create                = false;
            this.registro.utilidad           = '';
            this.totale();
            this.subtotal();
          }

      }
    },
              guardarEstadoResultado: function(){
                if (this.nombre.trim() === '') {
                  toastr.error("Campo Nombre es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if (this.fecha.trim() === '') {
                  toastr.error("Campo Fecha es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else{
                let _this = this;
                let url = '/sistema/admin/taller/estado-resultado';
                    axios.post(url,{
                    id: _this.id_taller,
                    nombre: _this.nombre,
                    fecha: _this.fecha,
                    ingresos: _this.ingresos,
                    gastos: _this.gastos,
                    utilidades: _this.utilidades,
                    utilidad: _this.utilidad,
                    totales:_this.totales,
                    venta: _this.venta,
                    costo_venta: _this.costo_venta,
                }).then(response => {
                  if (response.data.success == 'actualizado') {
                     toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                  balance_general.obtenerEstadoResultado();
                  asientos_cierre.obtenerEstadoResultado();


                  }else{
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                  balance_general.obtenerEstadoResultado();
                  asientos_cierre.obtenerEstadoResultado();


                  }                     
                }).catch(function(error){
                  toastr.error(error.response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                });
              }
            },
        obtenerEstadoResultado: function() {
        let _this = this;
        let url = '/sistema/admin/taller/estado-obtener-resultado';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
                    _this.nombre                        = response.data.estadoresultado.nombre
                    _this.fecha                         = response.data.estadoresultado.fecha
                    _this.ingresos                      = response.data.ingresos;
                    _this.gastos                        = response.data.gastos;
                    _this.utilidades                    = response.data.utilidades;
                    _this.utilidad                      = response.data.estadoresultado.utilidad;
                    _this.venta                         = response.data.estadoresultado.venta
                    _this.costo_venta                   = response.data.estadoresultado.costo_venta
                    _this.totales.utilidad_bruta_ventas = response.data.estadoresultado.utilidad_bruta_ventas
                    _this.utilidad_bruta.venta          = response.data.estadoresultado.venta
                    _this.utilidad_bruta.costo_venta    = response.data.estadoresultado.costo_venta
                    _this.totales.utilidad_ejercicio    = response.data.estadoresultado.utilidad_ejercicio
                    _this.totales.utilidad_liquida      = response.data.estadoresultado.utilidad_liquida
                    console.log(response.data.estadoresultado)
              this.totale();
            this.subtotal();
            }          
        }).catch(function(error){

        }); 
     } 



  }


});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////BALANCE GENERAL ///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


const balance_general = new Vue({

  el: "#balance_general",
  data:{
    nombre:'',
    fecha:'',
        id_taller: taller,
        hojatrabajo:[],
        nombre_hoja:'',
        estadoresultado:{
          nombre_e_resultado:'',
          fecha_e_resultado:'',
          ingresos:[],
          gastos:[],
          utilidades:[],
          utilidad:'',
          venta_e_resultado:'',
          costo_venta_e_resultado:'',
          totales:{
            ingreso:'',
            gasto:'',
            utilidad_bruta_ventas_e_resultado:'',
            utilidad_ejercicio_e_resultado:'',
            utilidad_liquida_e_resultado:'',
          }
        },
        //diarios:[],
        update:0,
        balance_general:{ //Nombre y fecha del balance inicial
          nombre:'',
          fecha:''
        },
        patrimonio:{ //Asignar Patrimonio
          cuenta_id:'',
          edit:false,
          saldo:'',
        },
        bi:{
          const_id:'',
          const_id2:''
        },
         options: objeto,
        cuentas: cuentas,
        //diarios2:[],
        total_balance_inicial:{ //Totales de activo, pasivo y patrimonio
          t_activo:'',
          t_pasivo:'',
          t_patrimonio_pasivo:''
        },
        registro:{
          activo_corriente:'',
          activo_nocorriente:'',
          pasivo_corriente:'',
          pasivo_nocorriente:'',
          patrimonio:'',
        },
        b_initotal:{
            t_a_corriente:'', //Total de activo corriente
            t_a_nocorriente:'', //Total de activo no corriente
            t_p_corriente:'', //Total de pasivo corriente
            t_p_no_corriente:'', //Total de pasivo no corriente
            t_patrimonio:'' //Total de patrimonio
        },
        a_corrientes:[], //Array de activos corrientes
        a_nocorrientes:[], //Array de activos no corrientes
        p_corrientes:[], //Array de pasivos corrientes
        p_nocorrientes:[], //Array de pasivos no corrientes
        patrimonios:[], //Array de patrimonios
        activo:{
          a_corriente:
            { //Agregar un nuevo activo corriente al array
                cuenta_id:'',
                saldo:'',
                cuenta_id2:'',
                total_saldo:'',
                total_saldo2:'',
                saldo2:'',
                edit:false,
                double:false           
              },
          a_nocorriente:
            { //Agregar un nuevo activo no corriente al array
                cuenta_id:'',
                saldo:'',
                cuenta_id2:'',
                total_saldo:'',
                total_saldo2:'',
                saldo2:'',
                edit:false,
                double:false
              },
        },
        pasivo:{
          p_corriente:
            { 
                cuenta_id:'',
                saldo:'',
                total:'',
                edit:false
              },
          p_nocorriente:
            { 
                cuenta_id:'',
                saldo:'',
                total:'',
                edit:false
              }
        },
  
  },
  mounted: function(){
    this.obtenerHojita();
    this.cambioActivo();
    this.cambioActivoNo();
    this.cambioPasivo();
    this.cambioPasivoNo();
    this.cambioPatrimonio();
    this.TotalActivo();
    this.TotalPasivo();
    this.obtenerBalance();
    this.obtenerEstadoResultado();
  },
   methods:{
        calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
        obtenerEstadoResultado: function() {
        let _this = this;
        let url = '/sistema/admin/taller/estado-obtener-resultado';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
                    _this.estadoresultado.nombre_e_resultado                        = response.data.estadoresultado.nombre
                    _this.estadoresultado.fecha_e_resultado                         = response.data.estadoresultado.fecha
                    _this.estadoresultado.ingresos                                  = response.data.ingresos;
                    _this.estadoresultado.totales.ingreso                           = response.data.estadoresultado.total_ingresos;
                    _this.estadoresultado.totales.gasto                             = response.data.estadoresultado.total_gastos;
                    _this.estadoresultado.gastos                                    = response.data.gastos;
                    _this.estadoresultado.utilidades                                = response.data.utilidades;
                    _this.estadoresultado.utilidad                                  = response.data.estadoresultado.utilidad;
                    _this.estadoresultado.venta_e_resultado                         = response.data.estadoresultado.venta
                    _this.estadoresultado.costo_venta_e_resultado                   = response.data.estadoresultado.costo_venta
                    _this.estadoresultado.totales.utilidad_bruta_ventas_e_resultado = response.data.estadoresultado.utilidad_bruta_ventas
                    _this.estadoresultado.totales.utilidad_ejercicio_e_resultado    = response.data.estadoresultado.utilidad_ejercicio
                    _this.estadoresultado.totales.utilidad_liquida_e_resultado      = response.data.estadoresultado.utilidad_liquida
                    _this.estadoresultado.totales.utilidad_neta_o      = response.data.estadoresultado.utilidad_neta_o
                    console.log(response.data.estadoresultado)
              this.totale();
            this.subtotal();
            }          
        }).catch(function(error){

        }); 
     }, 
      decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
      obtenerHojita: function() {
        let _this = this;
        let url = '/sistema/admin/taller/hoja-obtener-trabajo';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              this.hojatrabajo = response.data.hojatrabajo;
              this.nombre_hoja = response.data.nombre;
             
            }          
        }).catch(function(error){

        }); 
     },
    abrirActivoC(){
      this.limpiar();
      $('#bg-transaccion').modal('show');
      $('#nav-bg-activo-corriente-tab').tab('show')
      // $('#kardex-promedio-ingreso-edit-tab').tab('show')

    },
      abrirActivoNoC(){
        this.limpiar();
      $('#bg-transaccion').modal('show');
      
      $('#nav-bg-activo-no-corriente-tab').tab('show')

    },
      abrirPasivoC(){
        this.limpiar();
      $('#bg-transaccion').modal('show');
      
      $('#nav-bg-pasivo-corriente-tab').tab('show')

    },
      abrirPasivoNoC(){
        this.limpiar();
      $('#bg-transaccion').modal('show');
      
      $('#nav-bg-pasivo-no-corriente-tab').tab('show')

    },
      abrirPatrimonio(){
        this.limpiar();
      $('#bg-transaccion').modal('show');
     
      $('#nav-bg-patrimonio-tab').tab('show')

    },
    
//ELIMINAR ELEMENTOS DE UN ARRAY /////////
    deleteAcCooriente(index){
     let nombre = this.a_corrientes[index].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
          this.a_corrientes.splice(index, 1);   
          this.cambioActivo();                  
          this.TotalActivo();  
          this.limpiar();  
        }
      });
    },
                   
  
     deletePaCooriente(index){
      let nombre = this.p_corrientes[index].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
       
      this.p_corrientes.splice(index, 1);
      this.cambioPasivo();
      this.TotalPasivo(); 
          this.limpiar();  

        }
      });

    },
     deleteAcNoCooriente(index){
      let nombre = this.a_nocorrientes[index].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.a_nocorrientes.splice(index, 1);
      this.cambioActivoNo();
      this.TotalActivo();
          this.limpiar();  

        }
      });

    },
     deletePaNoCooriente(index){
      let nombre = this.p_nocorrientes[index].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.p_nocorrientes.splice(index, 1);
      this.cambioPasivoNo();
      this.TotalPasivo();
          this.limpiar();  

        }
      });
 
    },
     deletePatrimonio(index){
      let nombre = this.patrimonios[index].cuenta;
      Swal.fire({
        title: 'Seguro que deseas eliminar la cuenta '+nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+nombre,
            'success'
          );
      this.patrimonios.splice(index, 1);
      this.cambioPatrimonio();
          this.limpiar();  

        }
      });
    
    },
    limpiar(){ //LIMPIAR TODOS LOS CAMPOS DE ACTIVOS PASIVOS Y PATRIMONIOS
       this.pasivo.p_corriente.cuenta_id   = '';
       this.pasivo.p_corriente.saldo       = '';
       this.pasivo.p_nocorriente.cuenta_id = '';
       this.pasivo.p_nocorriente.saldo     = '';

       this.activo.a_corriente.cuenta_id   = '';
       this.activo.a_corriente.saldo       = '';
      this.activo.a_corriente.cuenta_id2   = '';
       this.activo.a_corriente.saldo2       = '';
       this.activo.a_corriente.double       = '';

       this.activo.a_nocorriente.cuenta_id = '';
       this.activo.a_nocorriente.saldo     = '';
        this.activo.a_nocorriente.cuenta_id2 = '';
       this.activo.a_nocorriente.saldo2     = '';
       this.activo.a_nocorriente.double     = '';

       this.bi.const_id                    = '';
       this.activo.a_corriente.edit        = false;
       this.activo.a_nocorriente.edit      = false;
       this.pasivo.p_corriente.edit        = false;
       this.pasivo.p_nocorriente.edit      = false;
       this.patrimonio.edit                = false;


      },
      agregarActivoCorriente(){
        //    if(this.activo.a_corriente.cuenta_id  ==''){
        //     toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
        //       "timeOut": "3000"
        //   });
        // }else {
        //      let id = this.activo.a_corriente.cuenta_id;
        //        let verificar = this.verificarCuenta(id);
        //            if (verificar == true) {
        //              toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
        //               "timeOut": "3000"
        //               });
        //            }else{
        //     let nombre   = funciones.obtenerNombre(id);
        //     var a_corriente ={resta:'', cuenta_id2:'', cuenta2:'', total_saldo2:'', saldo2:'', total_saldo:'', cuenta_id:this.activo.a_corriente.cuenta_id, cuenta:nombre, saldo:this.activo.a_corriente.saldo}
        //     this.a_corrientes.push(a_corriente);
        //     toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
        //       "timeOut": "3000"
        //     });
        //    this.activo.a_corriente.cuenta_id =''
        //    this.activo.a_corriente.saldo     =''
        //    this.cambioActivo(); 
        //  }
        //    }   
        //    
        if(this.activo.a_corriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id  = this.activo.a_corriente.cuenta_id;
             let id2 = this.activo.a_corriente.cuenta_id2;
              if (id == id2) {
                    toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               return     
              }
             if (id2 !== '') {
              let verificar2 = this.verificarCuenta(id2);
              if (verificar2 == true) {
                    toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               return     
              }
           
             }
              let verificar = this.verificarCuenta(id);

               if (verificar == true) {
                 toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               }else{
                let nombre   = funciones.obtenerNombre(id);
                
                if (id2 != '' && id2 != undefined) {
                this.activo.a_corriente.nombre1   = funciones.obtenerNombre(id2);
                console.log('HAS ENTRADO AQUI')
                 let resta = Number(this.activo.a_corriente.saldo) - Number(this.activo.a_corriente.saldo2);
                 this.activo.a_corriente.total_saldo2 = resta;

                let a_corriente ={resta:'si', cuenta_id:this.activo.a_corriente.cuenta_id, cuenta:nombre, saldo:this.activo.a_corriente.saldo, cuenta2:this.activo.a_corriente.nombre1,  total_saldo:this.activo.a_corriente.total_saldo, cuenta_id2:this.activo.a_corriente.cuenta_id2, saldo2:this.activo.a_corriente.saldo2, total_saldo2: this.activo.a_corriente.total_saldo2}
                this.a_corrientes.push(a_corriente);
                toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
                  "timeOut": "3000"
                });

                 }else{

            let a_corriente ={resta:'no',cuenta_id:this.activo.a_corriente.cuenta_id, cuenta:nombre, saldo:this.activo.a_corriente.saldo, cuenta2:'', saldo2:'', total_saldo:this.activo.a_corriente.saldo, cuenta_id2:this.activo.a_corriente.cuenta_id2,  total_saldo2: this.activo.a_corriente.total_saldo2}
            this.a_corrientes.push(a_corriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });


                 }
            this.activo.a_corriente.cuenta_id    =''
            this.activo.a_corriente.saldo        =''
            this.activo.a_corriente.cuenta_id2   =''
            this.activo.a_corriente.saldo2       =''
            this.activo.a_corriente.total_saldo  =''
            this.activo.a_corriente.total_saldo2 =''
            this.activo.a_corriente.double       = false;

          this.cambioActivo();          
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editAcorriente(index){
      this.activo.a_corriente.edit       = true;
       this.registro.a_corriente          = index;
       this.bi.const_id                     = this.a_corrientes[index].cuenta_id;
       this.bi.const_id2                     = this.a_corrientes[index].cuenta_id2;
       this.activo.a_corriente.cuenta_id  = this.a_corrientes[index].cuenta_id;
       this.activo.a_corriente.saldo      = this.a_corrientes[index].saldo;
       this.activo.a_corriente.cuenta_id2 = this.a_corrientes[index].cuenta_id2;
       this.activo.a_corriente.saldo2     = this.a_corrientes[index].saldo2;
       if (this.a_corrientes[index].resta == 'si') {
        this.activo.a_corriente.double       = true;
       }
       // this.activo.a_corriente.edit      = true;
       // this.registro.a_corriente    = index;
       // this.bi.const_id                  = this.a_corrientes[index].cuenta_id;
       // this.activo.a_corriente.cuenta_id = this.a_corrientes[index].cuenta_id;
       // this.activo.a_corriente.saldo     = this.a_corrientes[index].saldo;
        $('#bg-transaccion').modal('show');
        $('#nav-bg-activo-corriente-tab').tab('show')
              
      },
      actualizarActivoC(){
         if(this.activo.a_corriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {

          let id  = this.activo.a_corriente.cuenta_id;
          let id2 = this.activo.a_corriente.cuenta_id2;
          if (id == id2) {
              toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
            "timeOut": "3000"
            });
         return     
        }

         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                           = funciones.obtenerNombre(id);
            let index                            = this.registro.a_corriente;
            this.a_corrientes[index].cuenta_id = this.activo.a_corriente.cuenta_id;
            this.a_corrientes[index].cuenta    = nombre;
            this.a_corrientes[index].saldo     = this.activo.a_corriente.saldo;
          if (id2 !== '' && id2 !== undefined) {
              let verificar2 = this.verificarCuentaAct(id2);
              if (verificar2 == true) {
                    toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               return     
              }
            let nombre2                           = funciones.obtenerNombre(id2);
            this.a_corrientes[index].cuenta_id2   = this.activo.a_corriente.cuenta_id2;
            this.a_corrientes[index].cuenta2      = nombre2;
            this.a_corrientes[index].saldo2       = this.activo.a_corriente.saldo2;
            this.a_corrientes[index].total_saldo  = '';
            let resta                             = Number(this.activo.a_corriente.saldo) - Number(this.activo.a_corriente.saldo2);
            this.a_corrientes[index].total_saldo2 = resta;
            console.log(resta)
             }else{
             this.a_corrientes[index].cuenta_id2   = '';
             this.a_corrientes[index].cuenta2      ='' ;
             this.a_corrientes[index].saldo2       = '';
             this.a_corrientes[index].total_saldo2 = '';
             this.a_corrientes[index].total_saldo  = this.activo.a_corriente.saldo;
             }
             this.activo.a_corriente.cuenta_id     =''
             this.activo.a_corriente.saldo         =''
             this.activo.a_corriente.edit          = false;
             this.registro.a_corriente             = '';
             this.activo.a_corriente.cuenta_id2    =''
             this.activo.a_corriente.saldo2        =''
             this.activo.a_corriente.double        = false;
            this.cambioActivo();
          }
      }
      //     if(this.activo.a_corriente.cuenta_id ==''){
      //     toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
      //       "timeOut": "3000"
      //   });
      //   }else {
      //     let id = this.activo.a_corriente.cuenta_id;
      //    let verificar = this.verificarCuenta(id);
      //        if (verificar == true) {
      //          toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
      //           "timeOut": "3000"
      //           });
      //        }else{
      //       let nombre                         = funciones.obtenerNombre(id);
      //       let index                          = this.registro.a_corriente;
      //       this.a_corrientes[index].cuenta_id = this.activo.a_corriente.cuenta_id;
      //       this.a_corrientes[index].cuenta    = nombre;
      //       this.a_corrientes[index].saldo     = this.activo.a_corriente.saldo;
      //       this.activo.a_corriente.cuenta_id  =''
      //       this.activo.a_corriente.saldo      =''
      //       this.activo.a_corriente.edit       = false;
      //       this.registro.a_corriente          = '';
      //     this.cambioActivo();
      //     }
      // }
    },
    cancelarEdicionActivoC(){
      this.activo.a_corriente.cuenta_id  =''
      this.activo.a_corriente.saldo      =''
      this.activo.a_corriente.edit       = false;
      this.activo.a_corriente.double     = false;
      this.activo.a_corriente.cuenta_id2 = '';
      this.activo.a_corriente.saldo2     = '';
    },
    DoubleCouenta(){
      this.activo.a_nocorriente.double = true;
    },
       DoubleCouentaC(){
      this.activo.a_nocorriente.double = false;
    },
      DoubleAcorriente(){
      this.activo.a_corriente.double = true;
    },
       DoubleAcorrienteC(){
      this.activo.a_corriente.double = false;
    },
    agregarActivoNoCorriente(){
           if(this.activo.a_nocorriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id  = this.activo.a_nocorriente.cuenta_id;
             let id2 = this.activo.a_nocorriente.cuenta_id2;
             if (id2 !== '') {
              let verificar2 = this.verificarCuenta(id2);
              if (verificar2 == true) {
                    toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               return     
              }
           
             }
              let verificar = this.verificarCuenta(id);

               if (verificar == true) {
                 toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               }else{
                let nombre   = funciones.obtenerNombre(id);
                
                if (id2 != '' && id2 != undefined) {
                this.activo.a_nocorriente.nombre1   = funciones.obtenerNombre(id2);
                console.log('HAS ENTRADO AQUI')
                 let resta = Number(this.activo.a_nocorriente.saldo) - Number(this.activo.a_nocorriente.saldo2);
                 this.activo.a_nocorriente.total_saldo2 = resta;

                let a_nocorriente ={resta:'si', cuenta_id:this.activo.a_nocorriente.cuenta_id, cuenta:nombre, saldo:this.activo.a_nocorriente.saldo, cuenta2:this.activo.a_nocorriente.nombre1,  total_saldo:this.activo.a_nocorriente.total_saldo, cuenta_id2:this.activo.a_nocorriente.cuenta_id2, saldo2:this.activo.a_nocorriente.saldo2, total_saldo2: this.activo.a_nocorriente.total_saldo2}
                this.a_nocorrientes.push(a_nocorriente);
                toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
                  "timeOut": "3000"
                });

                 }else{

            let a_nocorriente ={resta:'no',cuenta_id:this.activo.a_nocorriente.cuenta_id, cuenta:nombre, saldo:this.activo.a_nocorriente.saldo, cuenta2:'', saldo2:'', total_saldo:this.activo.a_nocorriente.saldo, cuenta_id2:this.activo.a_nocorriente.cuenta_id2,  total_saldo2: this.activo.a_nocorriente.total_saldo2}
            this.a_nocorrientes.push(a_nocorriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });


                 }
            this.activo.a_nocorriente.cuenta_id    =''
            this.activo.a_nocorriente.saldo        =''
            this.activo.a_nocorriente.cuenta_id2   =''
            this.activo.a_nocorriente.saldo2       =''
            this.activo.a_nocorriente.total_saldo  =''
            this.activo.a_nocorriente.total_saldo2 =''
            this.activo.a_nocorriente.double       = false;

          this.cambioActivoNo();          
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editNoAcorriente(index){
       this.activo.a_nocorriente.edit       = true;
       this.registro.a_nocorriente          = index;
       this.bi.const_id                     = this.a_nocorrientes[index].cuenta_id;
       this.bi.const_id2                     = this.a_nocorrientes[index].cuenta_id2;
       this.activo.a_nocorriente.cuenta_id  = this.a_nocorrientes[index].cuenta_id;
       this.activo.a_nocorriente.saldo      = this.a_nocorrientes[index].saldo;
       this.activo.a_nocorriente.cuenta_id2 = this.a_nocorrientes[index].cuenta_id2;
       this.activo.a_nocorriente.saldo2     = this.a_nocorrientes[index].saldo2;
       if (this.a_nocorrientes[index].resta == 'si') {
        this.activo.a_nocorriente.double       = true;
       }
        $('#bg-transaccion').modal('show');
        $('#nav-bg-activo-no-corriente-tab').tab('show');           
      },
      actualizarActivoNC(){
          if(this.activo.a_nocorriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {

          let id  = this.activo.a_nocorriente.cuenta_id;
          let id2 = this.activo.a_nocorriente.cuenta_id2;

         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                           = funciones.obtenerNombre(id);
            let index                            = this.registro.a_nocorriente;
            this.a_nocorrientes[index].cuenta_id = this.activo.a_nocorriente.cuenta_id;
            this.a_nocorrientes[index].cuenta    = nombre;
            this.a_nocorrientes[index].saldo     = this.activo.a_nocorriente.saldo;
          if (id2 !== '' && id2 !== undefined) {
              let verificar2 = this.verificarCuentaAct(id2);
              if (verificar2 == true) {
                    toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                  "timeOut": "3000"
                  });
               return     
              }
            let nombre2                           = funciones.obtenerNombre(id2);
            this.a_nocorrientes[index].cuenta_id2 = this.activo.a_nocorriente.cuenta_id2;
            this.a_nocorrientes[index].cuenta2    = nombre2;
            this.a_nocorrientes[index].saldo2     = this.activo.a_nocorriente.saldo2;
            this.a_nocorrientes[index].total_saldo     = '';

            let resta = Number(this.activo.a_nocorriente.saldo) - Number(this.activo.a_nocorriente.saldo2);

            this.a_nocorrientes[index].total_saldo2 = resta;

            console.log(resta)

             }else{
             this.a_nocorrientes[index].cuenta_id2 = '';
            this.a_nocorrientes[index].cuenta2    ='' ;
            this.a_nocorrientes[index].saldo2     = '';

            this.a_nocorrientes[index].total_saldo2 = '';

            this.a_nocorrientes[index].total_saldo = this.activo.a_nocorriente.saldo;
             }
            this.activo.a_nocorriente.cuenta_id  =''
            this.activo.a_nocorriente.saldo      =''
            this.activo.a_nocorriente.edit       = false;
            this.registro.a_nocorriente          = '';
             this.activo.a_nocorriente.cuenta_id2  =''
            this.activo.a_nocorriente.saldo2      =''
        this.activo.a_nocorriente.double       = false;

            this.cambioActivoNo();
          }
      }
    },
    cancelarEdicionActivoNC(){
      this.activo.a_nocorriente.cuenta_id  =''
      this.activo.a_nocorriente.saldo      =''
      this.activo.a_nocorriente.edit       = false;
      this.activo.a_nocorriente.double       = false;
      this.activo.a_nocorriente.cuenta_id2 = '';
      this.activo.a_nocorriente.saldo2     = '';
    },

    agregarPasivoCorriente(){
           if(this.pasivo.p_corriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.pasivo.p_corriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var p_corriente ={cuenta_id:this.pasivo.p_corriente.cuenta_id, cuenta:nombre, saldo:this.pasivo.p_corriente.saldo}
            this.p_corrientes.push(p_corriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.pasivo.p_corriente.cuenta_id ='';
           this.pasivo.p_corriente.saldo     ='';
           this.cambioPasivo();
               
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPcorriente(index){
       this.pasivo.p_corriente.edit      = true;
       this.registro.p_corriente    = index;
       this.bi.const_id                  = this.p_corrientes[index].cuenta_id;
       this.pasivo.p_corriente.cuenta_id = this.p_corrientes[index].cuenta_id;
       this.pasivo.p_corriente.saldo     = this.p_corrientes[index].saldo;
        $('#bg-transaccion').modal('show');
        $('#nav-bg-pasivo-corriente-tab').tab('show')
              
      },
      actualizarPasivoC(){
          if(this.pasivo.p_corriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.pasivo.p_corriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.p_corriente;
            this.p_corrientes[index].cuenta_id = this.pasivo.p_corriente.cuenta_id;
            this.p_corrientes[index].cuenta    = nombre;
            this.p_corrientes[index].saldo     = this.pasivo.p_corriente.saldo;
            this.pasivo.p_corriente.cuenta_id  =''
            this.pasivo.p_corriente.saldo      =''
            this.pasivo.p_corriente.edit       = false;
            this.registro.p_corriente          = '';
            this.cambioPasivo();
          }
      }
    },
    cancelarEdicionPcorriente(){
      this.pasivo.p_corriente.cuenta_id =''
      this.pasivo.p_corriente.saldo      =''
      this.pasivo.p_corriente.edit      = false;
    },

    agregarPasivoNoCorriente(){
           if(this.pasivo.p_nocorriente.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.pasivo.p_nocorriente.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var p_nocorriente ={cuenta_id:this.pasivo.p_nocorriente.cuenta_id, cuenta:nombre, saldo:this.pasivo.p_nocorriente.saldo}
            this.p_nocorrientes.push(p_nocorriente);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.pasivo.p_nocorriente.cuenta_id ='';
           this.pasivo.p_nocorriente.saldo     ='';
           this.cambioPasivoNo();
               
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPNocorriente(index){
       this.pasivo.p_nocorriente.edit      = true;
       this.registro.p_nocorriente    = index;
       this.bi.const_id                  = this.p_nocorrientes[index].cuenta_id;
       this.pasivo.p_nocorriente.cuenta_id = this.p_nocorrientes[index].cuenta_id;
       this.pasivo.p_nocorriente.saldo     = this.p_nocorrientes[index].saldo;
        $('#bg-transaccion').modal('show');
        $('#nav-bg-pasivo-no-corriente-tab').tab('show')
              
      },
      actualizarPasivoNC(){
          if(this.pasivo.p_nocorriente.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.pasivo.p_nocorriente.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.p_nocorriente;
            this.p_nocorrientes[index].cuenta_id = this.pasivo.p_nocorriente.cuenta_id;
            this.p_nocorrientes[index].cuenta    = nombre;
            this.p_nocorrientes[index].saldo     = this.pasivo.p_nocorriente.saldo;
            this.pasivo.p_nocorriente.cuenta_id  =''
            this.pasivo.p_nocorriente.saldo      =''
            this.pasivo.p_nocorriente.edit       = false;
            this.registro.p_nocorriente          = '';
          this.cambioPasivoNo();
          }
      }
    },
    cancelarEdicionPNocorriente(){
      this.pasivo.p_nocorriente.cuenta_id =''
      this.pasivo.p_nocorriente.saldo      =''
      this.pasivo.p_nocorriente.edit      = false;
    },
        agregarPatrimonio(){
           if(this.patrimonio.cuenta_id  ==''){
            toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else {
             let id = this.patrimonio.cuenta_id;
               let verificar = this.verificarCuenta(id);
                   if (verificar == true) {
                     toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                   }else{
            let nombre   = funciones.obtenerNombre(id);
            var patrimonio ={cuenta_id:this.patrimonio.cuenta_id, cuenta:nombre, saldo:this.patrimonio.saldo}
            this.patrimonios.push(patrimonio);
            toastr.success("Cuenta agregada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
           this.patrimonio.cuenta_id ='';
           this.patrimonio.saldo     ='';
           this.cambioPatrimonio();       
           
         }
           }                
      }, 

    //EDITAR ELEMENTOS DE UN ARRAY
      editPatrimonio(index){
       this.patrimonio.edit      = true;
       this.registro.patrimonio    = index;
       this.bi.const_id                  = this.patrimonios[index].cuenta_id;
       this.patrimonio.cuenta_id = this.patrimonios[index].cuenta_id;
       this.patrimonio.saldo     = this.patrimonios[index].saldo;
        $('#bg-transaccion').modal('show');
        $('#nav-bg-patrimonio-tab').tab('show')
              
      },
      actualizarPatrimonio(){
          if(this.patrimonio.cuenta_id ==''){
          toastr.error("El campo Cuenta es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let id = this.patrimonio.cuenta_id;
         let verificar = this.verificarCuenta(id);
             if (verificar == true) {
               toastr.error("No puedes agregar una cuenta repetida", "Smarmoddle", {
                "timeOut": "3000"
                });
             }else{
            let nombre                         = funciones.obtenerNombre(id);
            let index                          = this.registro.patrimonio;
            this.patrimonios[index].cuenta_id = this.patrimonio.cuenta_id;
            this.patrimonios[index].cuenta    = nombre;
            this.patrimonios[index].saldo     = this.patrimonio.saldo;
            this.patrimonio.cuenta_id  =''
            this.patrimonio.saldo      =''
            this.patrimonio.edit       = false;
            this.registro.patrimonio          = '';
          this.cambioPatrimonio()
        }
      }
    },
    cancelarEdicionPatrimonio(){
      this.patrimonio.cuenta_id =''
      this.patrimonio.saldo      =''
      this.patrimonio.edit      = false;
    },


        verificarCuenta(id){
           if (Number(this.bi.const_id) === id) {
              return false;
            }else if (Number(this.bi.const_id2) === id) {
              return false;
            }
           let ac  = this.a_corrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let anc = this.a_nocorrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let pc  = this.p_corrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let pnc = this.a_nocorrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let p   = this.patrimonios.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
            if (ac.length > 0) {
            return true
             }else if(anc.length > 0) {
            return true
             }else if(pc.length > 0) {
            return true
             }else if(pnc.length > 0) {
            return true
             }else if(p.length > 0) {
            return true
             }else{
              return false
             }
          },
          verificarCuentaAct(id){
            if (this.bi.const_id == this.bi.const_id2) {
                return true;
            }
                 if (Number(this.bi.const_id) === id) {
              return false;
            }else if (Number(this.bi.const_id2) === id) {
              return false;
            }
           let ac  = this.a_corrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let anc = this.a_nocorrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let pc  = this.p_corrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let pnc = this.a_nocorrientes.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
           let p   = this.patrimonios.filter(x => x.cuenta_id == id || x.cuenta_id2 == id);
            if (ac.length > 0) {
            return true
             }else if(anc.length > 0) {
            return true
             }else if(pc.length > 0) {
            return true
             }else if(pnc.length > 0) {
            return true
             }else if(p.length > 0) {
            return true
             }else{
              return false
             }
          },
           
            //ACTUALIZAR SUMAS DE PASIVOS, ACTIVOS Y PATRIMONIO
             cambioActivo(){
              this.b_initotal.t_a_corriente = 0;
              var t_activo = this.a_corrientes;           //CARGAR EL ARRAY DE LOS ACTIVOS
              //console.log(t_activo)
              var total = 0;
              t_activo.forEach(function(obj){           //RECORRER ESE ARRAY
                total += Number(obj.total_saldo);           //SUMAR EL SALDO DE CADA CUENTA EN EL ARRAY UNA Y OTRA VEZ
              });
                t_activo.forEach(function(obj2){
                total += Number(obj2.total_saldo2);
              });
              //console.log(total);          
              this.b_initotal.t_a_corriente = total;          //IGUALAR LA VARIABLE QUE CONTIENE LA SUMA TOTAL CON LA SUMA REALIZADA
              this.TotalActivo();
             },
                cambioActivoNo(){
              this.b_initotal.t_a_nocorriente = 0;
              var t_noactivo = this.a_nocorrientes;
              //console.log(t_noactivo)
              var total = 0;

              t_noactivo.forEach(function(obj){
                total += Number(obj.total_saldo);
              });

               t_noactivo.forEach(function(obj2){
                total += Number(obj2.total_saldo2);
              });
              console.log(total);  
              this.b_initotal.t_a_nocorriente = total;
            this.TotalActivo();

             },
                cambioPasivo(){
              this.b_initotal.t_p_corriente = 0;
              var t_pasivo = this.p_corrientes;
              //console.log(t_pasivo)
              var total = 0;
              t_pasivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);
              this.b_initotal.t_p_corriente = total;
                this.TotalPasivo();
             },
                cambioPasivoNo(){
              this.b_initotal.t_p_no_corriente = 0;
              var t_nopasivo = this.p_nocorrientes;
              //console.log(t_nopasivo)
              var total = 0;
              t_nopasivo.forEach(function(obj){
                total += Number(obj.saldo);
              });
              //console.log(total);
              this.b_initotal.t_p_no_corriente = total;
                this.TotalPasivo();
             },
            cambioPatrimonio(){
              this.b_initotal.t_patrimonio = 0;
              var t_patrimo = this.patrimonios;
              //console.log(t_patrimo)
              var total = 0;
              t_patrimo.forEach(function(obj){
                total += Number(obj.saldo); 
              });
              //console.log(total);
              this.b_initotal.t_patrimonio = total;
             },

             //TOTAL GENERAL DE ACTIVO, PASIVO Y PATRIMONIO       
             TotalActivo(){
              var activo = this.b_initotal.t_a_corriente + this.b_initotal.t_a_nocorriente;
             //console.log(activo);
              this.total_balance_inicial.t_activo = activo;
             },
              TotalPasivo(){
              var pasivo = this.b_initotal.t_p_corriente + this.b_initotal.t_p_no_corriente;
              //onsole.log(pasivo);
              this.total_balance_inicial.t_pasivo = pasivo;
             },
               totalPasivoPatrimonio(){
                  $('#pasivo_patrimonio').modal('hide');
                toastr.success("Total Agregado Correctamente", "Smarmoddle", {
                    "timeOut": "3000"
                   });
            },
            //GUARDAR BALANCE INICIAL
                guardarBalanceGeneral: function(){
                if (this.balance_general.nombre.trim() === '') {
                  toastr.error("Campo Nombre es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if (this.balance_general.fecha.trim() === '') {
                  toastr.error("Campo Fecha es obligatorio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.a_corrientes.length == 0){
                  toastr.error("Debe haber al menos un Activo Corriente", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.a_nocorrientes.length == 0){
                  toastr.error("Debe haber al menos un Activo No Corriente", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.p_corrientes.length == 0){
                  toastr.error("Debe haber al menos un Pasivo Corriente", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.p_nocorrientes.length == 0){
                  toastr.error("Debe haber al menos un Pasivo No Corriente", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.patrimonios.length == 0){
                  toastr.error("Debe haber al menos un Patrimonio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else if(this.total_balance_inicial.t_patrimonio_pasivo.trim() === ''){
                  toastr.error("Debes calcular el Total del Pasivo + Patrimonio", "Smarmoddle", {
                    "timeOut": "3000"
                   }); 
                }else{
                var _this = this;
                var url = '/sistema/admin/taller/balance-general';
                    axios.post(url,{
                    id: _this.id_taller,
                    nombre: _this.balance_general.nombre,
                    fecha: _this.balance_general.fecha,
                    a_corriente: _this.a_corrientes,
                    a_nocorriente: _this.a_nocorrientes,
                    p_corriente: _this.p_corrientes,
                    p_nocorriente: _this.p_nocorrientes,
                    patrimonio: _this.patrimonios,
                    totales: _this.b_initotal,
                    total_balance_inicial: _this.total_balance_inicial,
                    t_patrimonio: _this.total_balance_inicial.t_patrimonio_pasivo

                }).then(response => {
                  if (response.data.success == true) {
                     toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    console.log(response.data); 
                    asientos_cierre.obtenerBalance();
                  } else {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    asientos_cierre.obtenerBalance();
                    // diario.obtenerBalanceInicial();
                  }                     
                }).catch(function(error){
                  console.log(error.response.data.message)
                 
                });
              }
            },
            obtenerBalance:function(){
              var _this = this;
                var url = '/sistema/admin/taller/obtener-balance-general';
                    axios.post(url,{
                    id: _this.id_taller,
                }).then(response => {
                  if ( response.data.datos == true ) {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.balance_general.nombre                    = response.data.nombre
                    _this.balance_general.fecha                     = response.data.fecha
                    _this.a_corrientes                              = response.data.a_corriente;
                    _this.a_nocorrientes                            = response.data.a_nocorriente;
                    _this.p_corrientes                              = response.data.p_corriente;
                    _this.p_nocorrientes                            = response.data.p_nocorriente;
                    _this.patrimonios                               = response.data.patrimonios;
                    _this.total_balance_inicial.t_patrimonio_pasivo = response.data.total_pasivo_patrimonio;
                    _this.cambioActivo();
                    _this.cambioActivoNo();
                    _this.cambioPasivo();
                    _this.cambioPasivoNo();
                    _this.cambioPatrimonio();
                    //diario.obtenerBalanceInicial();
                    console.log(response.data);                 
                  } else {

                  }
                }).catch(function(error){
                
                });

            }
  }   
});



const asientos_cierre = new Vue({
 el: '#asientos_cierre',
    data:{
      id_taller: taller,
      producto_id: 1,
      nombre:'',
      fechabalance:'',
      complete:false,
      options: objeto,
      cuentas: cuentas,
      balanceInicial:{
        debe:[],
        haber:[],
        totaldebe:0,
        totalhaber:0
       },
       kardex:[],
        nombre_kardex:'',
        producto_kardex:'',
       registros:[
       ],
       eliminar:{
        index:''
       },
          porcentajes:{
        porcentaje:0,
        index_cuenta:'',
        tipo:'',
        cantidad:0
       },
       registerindex: 0,
       cuentaindex: 0,
        diarios:{
           debe:[],
          haber:[],
          comentario:'',
          fecha:'',
          tipo:''
        },
         edit:{
           debe:[],
          haber:[],
          comentario:''
        },
        diario:{
          debe:{
            edit: false,
            index:'',
            fecha:'',
            nom_cuenta:'',
            saldo:'',
          },
          haber:{
            edit: false,
            index:'',
            fecha:'',
            nom_cuenta:'',
            saldo:''
          },
          comentario:''
        },
        pasan:{ 
          debe:0, 
          haber:0
        },
        total:{
          debe:0,
          haber:0,
        },
        update:false,
        dato:[],

        estadoresultado:{
          nombre_e_resultado:'',
          fecha_e_resultado:'',
          ingresos:[],
          gastos:[],
          utilidades:[],
          utilidad:'',
          venta_e_resultado:'',
          costo_venta_e_resultado:'',
          totales:{
            ingreso:'',
            gasto:'',
            utilidad_bruta_ventas_e_resultado:'',
            utilidad_ejercicio_e_resultado:'',
            utilidad_liquida_e_resultado:'',
          }
        },
        balance_general:{
          a_corrientes:[],
          a_nocorrientes:[],
          p_corrientes:[],
          p_nocorrientes:[],
          patrimonios:[],
          total_balance_inicial:{
              t_activo:'',
              t_pasivo:'',
              t_patrimonio:'',
              t_patrimonio_pasivo:'',
          },
        },
        hojatrabajo:[],
    nombre_hoja:'',
        b_initotal:{
          t_a_corriente:'', //Total de activo corriente
          t_a_nocorriente:'', //Total de activo no corriente
          t_p_corriente:'', //Total de pasivo corriente
          t_p_no_corriente:'', //Total de pasivo no corriente
          t_patrimonio:'' //Total de patrimonio
      },
    },
    mounted: function () {
      this.obtenerAsientoCierre();
      this.obtenerHojita();
      // this.obtenerBalance();

    },

    methods:{
        obtenerHojita: function() {
        let _this = this;
        let url = '/sistema/admin/taller/hoja-obtener-trabajo';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
              this.hojatrabajo = response.data.hojatrabajo;
              this.nombre_hoja = response.data.nombre;
             
            }          
        }).catch(function(error){

        }); 
     },
          calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    obtenerEstadoResultado: function() {
        let _this = this;
        let url = '/sistema/admin/taller/estado-obtener-resultado';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
                    _this.estadoresultado.nombre_e_resultado                        = response.data.estadoresultado.nombre
                    _this.estadoresultado.fecha_e_resultado                         = response.data.estadoresultado.fecha
                    _this.estadoresultado.ingresos                                  = response.data.ingresos;
                    _this.estadoresultado.totales.ingreso                           = response.data.estadoresultado.total_ingresos;
                    _this.estadoresultado.totales.gasto                             = response.data.estadoresultado.total_gastos;
                    _this.estadoresultado.gastos                                    = response.data.gastos;
                    _this.estadoresultado.utilidades                                = response.data.utilidades;
                    _this.estadoresultado.utilidad                                  = response.data.estadoresultado.utilidad;
                    _this.estadoresultado.venta_e_resultado                         = response.data.estadoresultado.venta
                    _this.estadoresultado.costo_venta_e_resultado                   = response.data.estadoresultado.costo_venta
                    _this.estadoresultado.totales.utilidad_bruta_ventas_e_resultado = response.data.estadoresultado.utilidad_bruta_ventas
                    _this.estadoresultado.totales.utilidad_ejercicio_e_resultado    = response.data.estadoresultado.utilidad_ejercicio
                    _this.estadoresultado.totales.utilidad_liquida_e_resultado      = response.data.estadoresultado.utilidad_liquida
                    _this.estadoresultado.totales.utilidad_neta_o      = response.data.estadoresultado.utilidad_neta_o

                    console.log(response.data.estadoresultado)
            //   this.totale();
            // this.subtotal();
            }          
        }).catch(function(error){

        }); 
     }, 
         limpiar(){
      this.update                  = false;
      this.diarios.debe            =[];
      this.diarios.haber           =[];
      this.diarios.fecha           =[];
      this.diarios.comentario      =[];
      this.diarios.ajustado        = false;
      this.diario.haber.fecha      ='';
      this.diario.haber.nom_cuenta ='';
      this.diario.haber.saldo      ='';
      this.diario.haber.edit       =false;
      this.diario.debe.fecha       ='';
      this.diario.debe.nom_cuenta  ='';
      this.diario.debe.saldo       ='';
      this.diario.debe.edit        = false;
    },
        obtenerBalance:function(){
              var _this = this;
                var url = '/sistema/admin/taller/obtener-balance-general';
                    axios.post(url,{
                    id: _this.id_taller,
                }).then(response => {
                  if ( response.data.datos == true ) {
                      toastr.success(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });
                    _this.balance_general.nombre                                    = response.data.nombre
                    _this.balance_general.fecha                                     = response.data.fecha
                    _this.balance_general.a_corrientes                              = response.data.a_corriente;
                    _this.balance_general.a_nocorrientes                            = response.data.a_nocorriente;
                    _this.balance_general.p_corrientes                              = response.data.p_corriente;
                    _this.balance_general.p_nocorrientes                            = response.data.p_nocorriente;
                    _this.balance_general.patrimonios                               = response.data.patrimonios;
                    _this.balance_general.total_balance_inicial.t_patrimonio_pasivo = response.data.total_pasivo_patrimonio;  
                    _this.balance_general.total_balance_inicial.t_pasivo            = response.data.bgneral.t_pasivo;  
                    _this.balance_general.total_balance_inicial.t_activo            = response.data.bgneral.t_activo;  
                    _this.balance_general.total_balance_inicial.t_patrimonio        = response.data.bgneral.t_patrimonio;  
                    _this.b_initotal.t_a_corriente                                  = response.data.bgneral.t_a_corriente;  
                    _this.b_initotal.t_a_nocorriente                                = response.data.bgneral.t_a_nocorriente;  
                    _this.b_initotal.t_p_corriente                                  = response.data.bgneral.t_p_corriente;  
                    _this.b_initotal.t_p_no_corriente                               = response.data.bgneral.t_p_no_corriente;  
                    _this.b_initotal.t_patrimonio                               = response.data.bgneral.t_patrimonio;  

                  } else {

                  }
                }).catch(function(error){
                
                });

            },
    formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
    decimales(saldo){
      if (saldo !== null) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
    abrirTransaccion(){
   this.update             = false;
      this.diarios.debe      =[];
      this.diarios.haber      =[];
      this.diarios.fecha      =[];
      this.diarios.comentario =[];
      this.diarios.ajustado = false;
      this.diario.haber.fecha =''
      this.diario.haber.nom_cuenta =''
      this.diario.haber.saldo =''
      this.diario.haber.edit =false
      this.diario.debe.fecha =''
      this.diario.debe.nom_cuenta =''
      this.diario.debe.saldo =''
      this.diario.debe.edit =false

      this.limpiar();
      $('#as-transaccion').modal('show');
      $('#comentario-asiento-tab').tab('show'); 


    },
    llamarDiario()
    {

      $('#list-mayor-general-list').tab('show')
      $('#mg-transaccion').modal('show')
    },
    valorPorcentual(porcentaje, valor){
      // let porcentaje = this.cuentas[index].porcentaje;
      let total = Number((valor * porcentaje) / 100);
      return total;
    },
    
    agregarHaber(){
      if (this.diario.haber.nom_cuenta === '') {
        toastr.error("No has registrado una cuenta", "Smarmoddle", {
                "timeOut": "3000"
                });
      }else{
      let id = this.diario.haber.nom_cuenta;
      let cuenta = this.cuentas.filter(x => x.id == id);
      let valor = this.diario.haber.saldo;

            // if (cuenta[0].porcentual == 1) {
            //       let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
            //       let haber = {cuenta_id: cuenta[0].id, fecha:this.diario.haber.fecha, nom_cuenta: cuenta[0].nombre, saldo:calculo};
            //       this.diarios.haber.push(haber);//añadimos el la variable persona al array
            // }else{
                  let haber = {cuenta_id: cuenta[0].id, fecha:this.diario.haber.fecha, nom_cuenta: cuenta[0].nombre, saldo:this.diario.haber.saldo};
                  this.diarios.haber.push(haber);
            // }
               
                //Limpiamos los campos
                toastr.success("Activo agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diario.haber.fecha =''
                this.diario.haber.nom_cuenta =''
                this.diario.haber.saldo =''
                

        }
    },
     agregarDebe(){
      let id = this.diario.debe.nom_cuenta;
      let cuenta = this.cuentas.filter(x => x.id == id);
      let valor = this.diario.debe.saldo;
          if(this.diario.debe.nom_cuenta === ''){
           toastr.error("La cuenta es obligatoria", "Smarmoddle", {
                "timeOut": "3000"
            });
        }else{
            // if (cuenta[0].porcentual == 1) {
            //       let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
                  
            //       let debe = {cuenta_id: cuenta[0].id, fecha:this.diario.debe.fecha, nom_cuenta: cuenta[0].nombre, saldo:calculo};
            //       this.diarios.debe.push(debe);
            // }else{
                  let debe = {cuenta_id: cuenta[0].id, fecha:this.diario.debe.fecha, nom_cuenta: cuenta[0].nombre, saldo:this.diario.debe.saldo};
                  this.diarios.debe.push(debe);
            // }
                toastr.success("Activo agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diario.debe.fecha =''
                this.diario.debe.nom_cuenta =''
                this.diario.debe.saldo =''
     

      }   
    },
    agregarComentario(){
      this.diarios.comentario = this.diario.comentario;
      this.diario.comentario = '';
    },
    deleteHaber(index){
        this.diarios.haber.splice(index, 1);
        this.diario.debe.fecha      ='';
        this.diario.debe.nom_cuenta ='';
        this.diario.debe.saldo      ='';
        this.diario.debe.edit       = false;
        this.diario.haber.fecha      ='';
        this.diario.haber.nom_cuenta ='';
        this.diario.haber.saldo      ='';
        this.diario.haber.edit       = false;

      },
    deleteDebe(index){
        this.diarios.debe.splice(index, 1);
        this.diario.debe.fecha      ='';
        this.diario.debe.nom_cuenta ='';
        this.diario.debe.saldo      ='';
        this.diario.debe.edit       = false;
        this.diario.haber.fecha      ='';
        this.diario.haber.nom_cuenta ='';
        this.diario.haber.saldo      ='';
        this.diario.haber.edit       = false;

      },
    guardarRegistro(){
      let total_debe = 0;
      let total_haber = 0;
      
      this.diarios.debe.forEach(function(debe, id){
                let saldo2 = debe.saldo;
                    total_debe += Number(saldo2);
              });
      this.diarios.haber.forEach(function(haber, id){
                let saldo = haber.saldo;
                    total_haber += Number(saldo);
              });
      console.log(total_debe)
      console.log(total_haber);

      if (this.diarios.debe == 0) {
         toastr.error("No tienes transaccion para guardar", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.comentario == '') {
         toastr.error("Debes agregar un comentario", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.fecha == '') {
         toastr.error("Debes agregar la fecha", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (total_haber.toFixed(2) != total_debe.toFixed(2)) {
         toastr.error("El Total de Debe y Haber no coinciden", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else{
        this.diarios.debe[0].fecha = this.diarios.fecha;
                let registro = {debe:this.diarios.debe, haber:this.diarios.haber, comentario:this.diarios.comentario, fecha: this.diarios.fecha};
                this.registros.push(registro);//añadimos el la variable persona al array
                //Limpiamos los campos
                toastr.success("Registro agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diarios.debe =[];
                this.diarios.haber =[];
                this.diarios.comentario = '';
                this.diarios.ajustado = false;
                this.totalDebe();
                this.totalHaber();
                this.limpiar();

                

      $('#as-transaccion').modal('hide');

                
      }
    },
    debeEditRegister(id){
      let register = JSON.parse(JSON.stringify(this.registros));
      this.update             = true;
      this.registerindex      = id;
      this.diarios.debe       =[];
      this.diarios.haber      =[];
      this.diarios.debe       = register[id].debe;
      this.diarios.haber      = register[id].haber;
      this.diarios.comentario = register[id].comentario;
      this.diarios.fecha = register[id].fecha;
      // this.diarios.tipo = register[id].tipo;

      // console.log(this.registros[id]);
      $('#as-transaccion').modal('show');

    },


    deleteRegistro(id){
       Swal.fire({
        title: 'Seguro que deseas eliminar este registro??',
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro se elimino',
            'success'
          );
           this.registros.splice(id, 1);
            this.totalDebe();
            this.totalHaber();
            
        }
      });
     

    },

    updaterRegister(){
    let id = this.registerindex;
    let total_debe = 0;
      let total_haber = 0;
      
      this.diarios.debe.forEach(function(debe, id){
                let saldo = debe.saldo;
                    total_debe += Number(saldo);
              });
      this.diarios.haber.forEach(function(haber, id){
                let saldo = haber.saldo;
                    total_haber += Number(saldo);
              });

      if (this.diarios.debe == 0) {
         toastr.error("No tienes transaccion para guardar", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.comentario.trim() === '') {
         toastr.error("Debes agregar un comentario", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (this.diarios.fecha.trim() === '') {
         toastr.error("Debes agregar la fecha", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else  if (total_haber != total_debe) {
         toastr.error("El Total de Debe y Haber no coinciden", "Smarmoddle", {
                "timeOut": "3000"
            });
      }else{
    
            this.registros[id].debe       = this.diarios.debe;
            this.registros[id].haber      = this.diarios.haber;
            this.registros[id].comentario = this.diarios.comentario;
            this.registros[id].fecha      = this.diarios.fecha;
            this.diarios.debe             = [];
            this.diarios.haber            = [];
            this.diarios.comentario       = '';
            this.diarios.fecha            = '';
            // this.diarios.tipo             = '';
            this.diarios.ajustado         = false;
            
            this.totalDebe();
            this.totalHaber();
            this.limpiar();

            // 

          $('#as-transaccion').modal('hide');

        }
    },
 
  agregarEdit(){
     var haber = {fecha:this.diario.haber.fecha, nom_cuenta:this.diario.haber.nom_cuenta, saldo:this.diario.haber.saldo};
              this.edit.haber.push(haber);//añadimos el la variable persona al array
                //Limpiamos los campos
            toastr.success("Activo agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
            });
                this.diario.haber.fecha =''
                this.diario.haber.nom_cuenta =''
                this.diario.haber.saldo =''
   },
   agregarEditPasivo(){

         var debe = {fecha:'', nom_cuenta:this.diario.debe.nom_cuenta, saldo:this.diario.debe.saldo};
                this.edit.debe.push(debe);//añadimos el la variable persona al array
                //Limpiamos los campos
                toastr.success("Activo agregado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.diario.debe.fecha =''
                this.diario.debe.nom_cuenta =''
                this.diario.debe.saldo =''
             
   },
    haberEdit(index){
      var edit = this.edit;
      this.cuentaindex  = index;
      this.diario.haber.nom_cuenta  = edit.haber[index].nom_cuenta;
      this.diario.haber.saldo       = edit.haber[index].saldo;
      $('#haber_a').modal('show'); 
    },
    updateHaber(){
      let id     =  this.diario.haber.nom_cuenta;
      let index  = this.diario.haber.index;
      let cuenta = this.cuentas.filter(x => x.id == id);
      console.log(cuenta)
      let valor  = this.diario.haber.saldo;
      // if (cuenta[0].porcentual == 1) {
      //   let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
      //   this.diarios.haber[index].nom_cuenta = cuenta[0].nombre;
      //   this.diarios.haber[index].saldo      = calculo;
      // }else{
        this.diarios.haber[index].cuenta_id  = id;
        this.diarios.haber[index].nom_cuenta = cuenta[0].nombre;
        this.diarios.haber[index].saldo      = valor;
      // }
        this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo      = '';
        this.diario.haber.edit       = false;
    },
    habediarioEdit(index){
        this.diario.debe.fecha = '';
        this.diario.debe.nom_cuenta = '';
        this.diario.debe.saldo      = '';
        this.diario.debe.edit       = false;
      this.diario.haber.index = index;
      let id_cuenta = this.diarios.haber[index].cuenta_id;

      let cuenta = this.cuentas.filter(x => x.id == id_cuenta);
      console.log(cuenta)
      // if (cuenta[0].porcentual == 1){

      //   this.diario.haber.nom_cuenta = id_cuenta;
      //   this.diario.haber.saldo      = '';
      // }else{

        this.diario.haber.nom_cuenta = id_cuenta;
        this.diario.haber.saldo      = this.diarios.haber[index].saldo;
      // }
        this.diario.haber.edit       = true;
      
   
      $('#haber-asiento-tab').tab('show'); 
    },
      updateHaber1(){
      var id = this.cuentaindex;
      this.diarios.haber[id].nom_cuenta  = this.diario.haber.nom_cuenta;
      this.diarios.haber[id].saldo       = this.diario.haber.saldo;
      $('#haber_d').modal('hide'); 
        this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo = '';
    },
    haberDelete(index){
      this.edit.haber.splice(index, 1);
    },
 
     debediairoEdit(index){
        this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo      = '';
        this.diario.haber.edit       = false;
      this.diario.debe.index = index;
      // this.cuentaindex     = index;
      let cuenta_id = this.diarios.debe[index].cuenta_id;

      if (this.diarios.debe[index].fecha !== '') {
        this.diario.debe.fecha  = this.diarios.debe[index].fecha;  
      }else{
        this.diario.debe.fecha  = '';  
      }
      let cuenta = this.cuentas.filter(x => x.id == cuenta_id);
      // console.log(cuenta)
      // if (cuenta[0].porcentual == 1){
      //   this.diario.debe.nom_cuenta = cuenta_id;
      //   this.diario.debe.saldo      = '';
      // }else{
        this.diario.debe.nom_cuenta = cuenta_id;
        this.diario.debe.saldo      = this.diarios.debe[index].saldo;
      // }
        this.diario.debe.edit       = true;
      $('#debe-asiento-tab').tab('show'); 
    },
    cancelarEdicion(cuenta){
      if (cuenta == 'debe') {
        this.diario.debe.fecha      = '';
        this.diario.debe.nom_cuenta = '';
        this.diario.debe.saldo      = '';
        this.diario.debe.edit       = false;
      } else {
        this.diario.haber.nom_cuenta = '';
        this.diario.haber.saldo      = '';
        this.diario.haber.edit       = false;
      }
    },
    updateDebe(){
      let id     =  this.diario.debe.nom_cuenta;
      let index  = this.diario.debe.index;
      let cuenta = this.cuentas.filter(x => x.id == id);
      console.log(cuenta)
      let valor  = this.diario.debe.saldo;
      if (this.diario.debe.fecha !== '') {
         this.diarios.debe[index].fecha = this.diario.debe.fecha; 
      }
      // if (cuenta[0].porcentual == 1) {
      //   let calculo = this.valorPorcentual(cuenta[0].porcentaje, valor);
      //   this.diarios.debe[index].nom_cuenta = cuenta[0].nombre;
      //   this.diarios.debe[index].saldo      = calculo;
      // }else{
        this.diarios.debe[index].nom_cuenta = cuenta[0].nombre;
        this.diarios.debe[index].saldo      = valor;
      // }
        this.diarios.debe[index].cuenta_id = id;
      
      if (this.diario.debe.fecha !== '') {
        this.diario.debe.fecha = ''; 
      }
        this.diario.debe.nom_cuenta = '';
        this.diario.debe.saldo      = '';
        this.diario.debe.edit       = false;

    },
    debeDelete(index){
      this.edit.debe.splice(index, 1);
    },
     totalDebeBi: function(){
            let balan = this.balanceInicial;
            let total = 0; 
            balan.debe.forEach(function(obj, index){
                total += Number(obj.saldo);
            });
            // console.log(total);        
            this.balanceInicial.totaldebe = total;
            

          },
    totalHaberBi: function(){
            let balan = this.balanceInicial;
            let total = 0; 
            balan.haber.forEach(function(obj, index){
                total += Number(obj.saldo);
            });
            // console.log(total);        
            this.balanceInicial.totalhaber = total;
            
            
          },
    totalDebe: function(){
            this.pasan.debe = 0;
            let regis = this.registros;
            let total = 0;        
            regis.forEach(function(obj, index){
              obj.debe.forEach(function(sal, id){
                total += Number(sal.saldo);
              })
            });
            // console.log(total);
            this.pasan.debe = this.balanceInicial.totaldebe + total;
          },
    totalHaber: function(){
            this.pasan.haber = 0;
            let regis = this.registros;
            let total = 0;
            
            regis.forEach(function(obj, index){
              obj.haber.forEach(function(sal, id){
                total += Number(sal.saldo);
              })
            });
            // console.log(total);  
            this.pasan.haber =  this.balanceInicial.totalhaber +  total;
          }, 
  guardarDiario: function(){
      if (this.registros.length == 0) {
           toastr.error('No tienes registros para guardar', "Smarmoddle", {
                    "timeOut": "3000"
          });
      }else{
         // console.log(union)
        let _this = this;
        let url = '/sistema/admin/taller/asiento-cierre';
            axios.post(url,{
              id: _this.id_taller,
              registro: _this.registros,
              nombre: _this.nombre,
              total_debe: _this.pasan.debe,
              total_haber: _this.pasan.haber,
        }).then(response => {
          if (response.data.success == false) {
                    toastr.error(response.data.message, "Smarmoddle", {
                    "timeOut": "3000"
                   });

          }else if(response.data.success == 'act'){
            toastr.success("Asiento de Cierre Actualizado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
           mayor_general.obtenerDiarioGeneral();
           mayor_general.obtenerAsientoCierre();
          }else{
           toastr.success("Asiento de Cierre Creado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
          _this.dato = response.data;
           mayor_general.obtenerDiarioGeneral();
           mayor_general.obtenerAsientoCierre();

            //
            }          
        }).catch(function(error){
        });  
      }
      },
    obtenerAsientoCierre: function(){
        var _this = this;
        var url = '/sistema/admin/taller/asiento-cierre-obtener';
            axios.post(url,{
              id: _this.id_taller,
        }).then(response => {
          if (response.data.datos == true) {
          _this.registros = response.data.registros;
          _this.nombre = response.data.nombre;
           this.totalDebe();
           this.totalHaber();
           
           toastr.success("Diairo General cargado Correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
            }          
        }).catch(function(error){

        }); 
    }

    }
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////KARDEX ///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


const kardex = new Vue({
  el: "#kardex",
  data:{
    id_taller: taller,

    exis:{
      cantidad:'',
      precio:'',
      total:''
    },
    producto:'',
    producto_id:'',
    productos:[],
    nombre:'',
    suman:{
      ingreso_cantidad:0,
      ingreso_total:0,
      egreso_cantidad:0,
      egreso_total:0,
      muestra:0
    },
    datos_transacciones:'',
    totales:{
      cantidad:'',
      precio:'',
      subtotal:'',
      total:''
    },
      prueba:{
      cantidad:{
        inventario_inicial:'',
        adquicisiones:'',
        ventas:'',
        inventario_final:''
      },
      precio:{
        inventario_inicial:'',
        adquicisiones:'',
        ventas:'',
        inventario_final:''
      }
    },
    ejercicio:[],
    actuingreso:{
      estado:false,
      index:'',
    },
    modales:{
      modal_ingreso:[],
      existencia_ingreso: false,
      modal_devolucion_compra:[],
      modal_egreso:[],
      modal_devolucion_venta:[]
    },
    actuegreso:{
      estado:false,
      index:'',
      tipo:false
    },
    egresos:[],
    existencias:[],
    transacciones:[

    ],
    update: false,
    inicial:{
      fecha:'',
      movimiento:'',
      cantidad:'',
      precio:'',
      total:''
    },
    edit:{
      egreso:{
          cantidad:'',
          precio:'',
          total:'',
          temp:'',
        }
    },
    movimientos:[],
    transaccion:{
      fecha:'',
      movimiento:'',
        ingreso:{
          cantidad:'',
          precio:'',
          total:''
        },
        egreso:{
          cantidad:'',
          precio:'',
          total:'',
          temp:'',
          edit:false,
          add:false,
          active:false
        },
        existencia:{
          cantidad:'',
          precio:'',
          total:''
        },
        exis:{
          cantidad:'',
          precio:'',
        }

    }
  },
  mounted: function(){
     this.obtenerKardexFifo();
    
  },
  methods:{
       VueSweetAlert2(component,propsData)
    {
        Swal.fire({
            html: '<div id="VueSweetAlert2"></div>',
            showConfirmButton: false,
            showCloseButton: true,
            heightAuto: true,
            customClass: 'swal-wide',
            willOpen: () => {
                let ComponentClass = Vue.extend(Vue.component(component));
                let instance = new ComponentClass({
                    propsData: propsData,
                });
                instance.$mount();
                document.getElementById('VueSweetAlert2').appendChild(instance.$el);
            }
        });
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
    formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
      reverseFecha(fecha){
      let date = fecha.split('/').reverse().join('-');
      return date;
    },
    sumasTotales(){
      let transacciones = this.transacciones;
      let in_cantidad = 0;
      let in_total    = 0;
      let eg_cantidad = 0;
      let eg_total    = 0;

        //INGRESO CANTIDAD
       transacciones.forEach(function(transaccion, i){
              transaccion.forEach(function(ingreso_cantidad, id){
                let temp = ingreso_cantidad.ingreso_cantidad;

                if (temp != null && temp !=='') {
                    in_cantidad += parseInt(temp)
                  // console.log(temp);
                } 
              })
            });
       this.suman.ingreso_cantidad = in_cantidad;

        //INGRESO TOTAL

        transacciones.forEach(function(transaccion, i){
              transaccion.forEach(function(ingreso_total, id){
                let temp1 = ingreso_total.ingreso_total;

                if (temp1 != null && temp1 !=='') {
                    in_total += Number(temp1)
                  // console.log(temp1);
                } 
              })
            });
       this.suman.ingreso_total = in_total.toFixed(2);

       console.log(in_total)


        //EGRESO CANTIDAD
       transacciones.forEach(function(transaccion, i){
              transaccion.forEach(function(egreso_cantidad, id){
                let temp = egreso_cantidad.egreso_cantidad;

                if (temp != null && temp !=='') {
                    eg_cantidad += parseInt(temp)
                  // console.log(temp);
                } 
              })
            });
       this.suman.egreso_cantidad = eg_cantidad;

        //EGRESO TOTAL

        transacciones.forEach(function(transaccion, i){
              transaccion.forEach(function(egreso_total, id){
                let temp1 = egreso_total.egreso_total;

                if (temp1 != null && temp1 !=='') {
                    eg_total += Number(temp1)
                  // console.log(temp1);
                } 
              })
            });
       this.suman.egreso_total = eg_total.toFixed(2);

       console.log(in_total)

    },
    modalIngreso:function () {
      if (this.transacciones.length >= 1) {
   
      const existencias = JSON.parse(JSON.stringify(this.existencias));
      const ventas = JSON.parse(JSON.stringify(this.existencias));
      

      this.modales.modal_ingreso = existencias;
      this.modales.modal_devolucion_venta = ventas;
      }
      $('#ingreso').modal('show');

      $('#tableingreso-tab').tab('show')
    },
       modalInicial:function () {
        this.cerrarInicial();
      if (this.transacciones.length >= 1) {
         let i =  this.transacciones.length - 1;
      console.log(this.transacciones[i]);
      this.movimientos =  this.transacciones[i];
      }
      $('#saldo_inicial').modal('show');
    },
    modalEgreso:function () {
      if (this.transacciones.length >= 1) {
        const existencias = JSON.parse(JSON.stringify(this.existencias));
        const compras = JSON.parse(JSON.stringify(this.existencias));
      

      this.modales.modal_egreso = existencias;
      this.modales.modal_devolucion_compra = compras;

     
      }
      $('#egreso').modal('show');
      $('#tablaegreso-tab').tab('show')

    },
    
    totalIng(id){
      let i = id;
      let exis = this.totales.total
      let cantidad = Number(this.ejercicio[i].ingreso_cantidad);
      let precio = Number(this.ejercicio[i].ingreso_precio);
      let total1 = this.ejercicio[i].ingreso_total;

      
      let multiplicacion =  cantidad * precio;
      

      this.ejercicio[i].ingreso_total = multiplicacion.toFixed(2);

    
    },

    ventaIng(id){
      let i        = id;
      let exis     = this.totales.total
      let cantidad = Number(this.ejercicio[i].ingreso_cantidad);
      let precio   = Number(this.ejercicio[i].ingreso_precio);
      let total1   = this.ejercicio[i].ingreso_total;

      
      let multiplicacion =  cantidad * precio;


      this.ejercicio[i].ingreso_total = multiplicacion.toFixed(2);
    
    },

    actuaIng(id){
      let i = id;
      let exis = this.totales.total
      let cantidad = Number(this.modales.modal_ingreso[i].ingreso_cantidad);
      let precio = Number(this.modales.modal_ingreso[i].ingreso_precio);
      let total1 = this.modales.modal_ingreso[i].ingreso_total;
      let multiplicacion =  cantidad * precio;
     
      this.modales.modal_ingreso[i].ingreso_total = multiplicacion.toFixed(2);
    

        let suma = multiplicacion + exis
        this.totales.subtotal = suma

        toastr.error("Datos Actualizado", "Smarmoddle", {
        "timeOut": "3000"
        });
    
    },
    actuaVenta(id){
      let i = id;
      let exis = this.totales.total
      let cantidad = Number(this.modales.modal_devolucion_venta[i].ingreso_cantidad);
      let precio = Number(this.modales.modal_devolucion_venta[i].ingreso_precio);
      let total1 = this.modales.modal_devolucion_venta[i].ingreso_total;
      let multiplicacion =  cantidad * precio;

      this.modales.modal_devolucion_venta[i].ingreso_total = multiplicacion.toFixed(2);
    
      
        let suma = multiplicacion + exis
        this.totales.subtotal = suma
    
        toastr.error("Datos Actualizado", "Smarmoddle",{
        "timeOut": "3000"
        });  
    },
    bajarExis(estado){

    let id = this.transacciones.length + 1;
    var existencia ={identificador: id, fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.exis.cantidad, existencia_precio:this.exis.precio, existencia_total:''}
      this.modales.modal_ingreso.unshift(existencia);
      toastr.success("Agregado", "Smarmoddle", {
        "timeOut": "3000"
    });
      this.exis.cantidad = '';
      this.exis.precio = '';
      this.modales.existencia_ingreso = false;
     
    },

    actuExiIng(estado){
    let id = this.ejercicio[0].id;
    var existencia ={identificador: id, fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.exis.cantidad, existencia_precio:this.exis.precio, existencia_total:''}

      this.ejercicio.unshift(existencia);
      toastr.success("Agregado", "Smarmoddle", {
        "timeOut": "3000"
    });
    },

    agregarTran(){
    if(this.inicial.fecha.trim() ==='' || this.inicial.movimiento.trim() ==='' || this.inicial.cantidad.trim() ==='' || this.inicial.precio.trim() ==='' ){
      toastr.error("Todos lo campos son obligatorios", "Smarmoddle", {
        "timeOut": "3000"
    });
     }else {
    

      this.inicial.total = Number(this.inicial.cantidad * this.inicial.precio).toFixed(2);
      let existencia = {tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:this.inicial.cantidad, existencia_precio:this.inicial.precio, existencia_total:''}
      this.existencias.push(existencia);
      let registro = [];
     
      var array = {tipo:'inicial', fecha:this.inicial.fecha, movimiento:this.inicial.movimiento, ingreso_cantidad:'', ingreso_precio:'', egreso_total:'', egreso_cantidad:'', egreso_precio:'', ingreso_total:'', existencia_cantidad:this.inicial.cantidad, existencia_precio: this.inicial.precio, existencia_total:this.inicial.total};
      registro.push(array)
      this.transacciones.unshift(registro) ;
   
      toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
    });
      this.totales.cantidad      = this.inicial.cantidad;
      this.totales.precio        = this.inicial.precio;
      this.totales.total         = this.inicial.total;
      this.inicial.fecha      = '';
      this.inicial.movimiento = '';
      this.inicial.cantidad   = '';
      this.inicial.precio     = '';
      $('#saldo_inicial').modal('hide');
    }
    this.sumasTotales();
    this.ultimaExistencia();
  },
  ultimaExistencia(){

    let a = this.transacciones.length;
    let u = this.transacciones.length - 1;
    if (a >= 1) {
      let ultima = this.transacciones[u];
      let filtro = ultima.filter(x => x.existencia_cantidad !== '' &&  x.existencia_cantidad !== null || x.existencia_precio !== '' && x.existencia_precio !== null);

      let exis = [];
         filtro.forEach(function(existencia, id){
          let agregar = {tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:existencia.existencia_cantidad, existencia_precio:existencia.existencia_precio, existencia_total:''}
            exis.push(agregar);
            });
         console.log(this.transacciones[u]);
      this.existencias = JSON.parse(JSON.stringify(exis));
    }else{
       this.existencias = [];
    }
    
  },
  cerrarInicial(){
      this.update = false;
      this.inicial.fecha      = '';
      this.inicial.movimiento = '';
      this.inicial.cantidad   = '';
      this.inicial.precio     = '';    
      this.inicial.fecha      = '';
      this.inicial.movimiento = '';
      this.inicial.cantidad   = '';
      this.inicial.precio     = '';
  },
  actualizarInicial(){
        if(this.inicial.fecha.trim() ==='' || this.inicial.movimiento.trim() ==='' || this.inicial.cantidad.trim() ==='' || this.inicial.precio.trim() ==='' ){
      toastr.error("Todos lo campos son obligatorios", "Smarmoddle", {
        "timeOut": "3000"
    });
     }else {
      // let fecha = this.formatoFecha(this.inicial.fecha)
      this.transacciones[0][0].fecha = this.inicial.fecha;
      this.transacciones[0][0].movimiento = this.inicial.movimiento
      this.transacciones[0][0].existencia_cantidad = this.inicial.cantidad
      this.transacciones[0][0].existencia_precio = this.inicial.precio


      let total =  JSON.parse(JSON.stringify(this.inicial.total));
      let newTotal = Number(this.inicial.cantidad) * Number(this.inicial.precio);
      this.inicial.total = newTotal;
      this.transacciones[0][0].existencia_total = newTotal.toFixed(2);
      let transacciones = (this.transacciones);
      let identificador = transacciones.length - 1;
          

      this.totales.cantidad      = this.inicial.cantidad;
      this.totales.precio        = this.inicial.precio;
      // this.totales.total         = this.inicial.total;
      this.update = false;
      this.inicial.fecha      = '';
      this.inicial.movimiento = '';
      this.inicial.cantidad   = '';
      this.inicial.precio     = '';
      $('#saldo_inicial').modal('hide');
      this.ultimaExistencia();
     }

  },
  agregarIngreso(){
   
    if(this.transaccion.fecha.trim() ==='' || this.transaccion.movimiento.trim() ==='' || this.transaccion.ingreso.cantidad.trim() ==='' || this.transaccion.ingreso.precio.trim() ==='' ){
      toastr.error("Todos los campos son obligatorios", "Smarmoddle", {
        "timeOut": "3000"
    });
     }else {
      let id = this.transacciones.length + 1;
  
      this.transaccion.ingreso.total = Number(this.transaccion.ingreso.cantidad * this.transaccion.ingreso.precio).toFixed(2);
      let calculo = Number(this.transaccion.ingreso.total + this.totales.total);

      let array = {identificador: id, tipo:'ingreso', fecha: this.transaccion.fecha, movimiento:this.transaccion.movimiento, ingreso_cantidad:this.transaccion.ingreso.cantidad, ingreso_precio:this.transaccion.ingreso.precio, ingreso_total:this.transaccion.ingreso.total, egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total:''};
     
      this.modales.modal_ingreso.push(array)
      
      toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
    });
      
      this.transaccion.fecha            = '';
      this.transaccion.movimiento       = '';
      this.transaccion.ingreso.cantidad = '';
      this.transaccion.ingreso.precio   = '';
      this.transaccion.ingreso.cantidad = '';
      this.transaccion.ingreso.precio   = '';
      this.transaccion.exis.cantidad = this.transaccion.existencia.cantidad;
      this.transaccion.exis.precio = this.transaccion.existencia.precio;
      this.transaccion.existencia.cantidad          = '';
      this.transaccion.existencia.precio            = '';
      

    }
  },
  borrarIngreso(index, tipo){
    let id = index;
    if (tipo == 'ingreso') {
      if (this.ejercicio[index].tipo == 'ingreso') {
          console.log('Si eliminas este ingreso se borrara el movimiento')
      }else if(this.ejercicio[index].tipo == 'ingreso_venta'){
          console.log('Si eliminas este ingreso se borrara el movimiento')
      }else{
        this.ejercicio.splice(index, 1);
      }
      return
    }

    if (tipo == 'venta') {
       if (this.modales.modal_devolucion_venta[id].tipo == 'ingreso_venta' ) {
     

      this.modales.modal_devolucion_venta.splice(index, 1);
      }else if(this.modales.modal_devolucion_venta[id].tipo == 'existencia' ){
      this.modales.modal_devolucion_venta.splice(index, 1);
    }
    }else{
       if (this.modales.modal_ingreso[id].tipo == 'ingreso' ) {
      this.modales.modal_ingreso.splice(index, 1);
    }else if(this.modales.modal_ingreso[id].tipo == 'existencia' ){
      this.modales.modal_ingreso.splice(index, 1);
    }

    }
   

  },

  agregarTransaccion(tipo){
     if (tipo == 'ingreso') {
     let prueba1 = this.modales.modal_ingreso.filter(x => x.tipo == 'ingreso');
      if(prueba1.length == 0){
          toastr.error("No puedes enviar solo existencias", "Smarmoddle", {
          "timeOut": "3000"
      });
       return
     }

      let ingreso = this.modales.modal_ingreso.filter(x => x.tipo == 'ingreso');
      let id = this.transacciones.length + 1;

      let filtro_existencias = this.modales.modal_ingreso.filter(x => x.tipo == 'existencia');

     
      let existencia = {tipo:'existencia', fecha:'', movimiento:'', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:ingreso[0].existencia_cantidad, existencia_precio:ingreso[0].existencia_precio, existencia_total:''}


      filtro_existencias.push(existencia);
        this.existencias = JSON.parse(JSON.stringify(filtro_existencias));

        let exi_total = 0;

        filtro_existencias.forEach(function(existencia, i){
                   
            let cantidad = existencia.existencia_cantidad;
            let precio = existencia.existencia_precio;

            let subtotal = Number(cantidad) * Number(precio);
                                                                  
                exi_total += Number(subtotal);

                  });

        let ultimo = this.modales.modal_ingreso.length - 1;

        this.modales.modal_ingreso[ultimo].existencia_total = exi_total.toFixed(2);



      this.transacciones.push(this.modales.modal_ingreso);

      this.modales.modal_ingreso = [];

      this.totales.total = exi_total;
        console.log(exi_total);
        this.suman.muestra = exi_total;
      
      this.transaccion.ingreso.total    = '';
      $('#ingreso').modal('hide');
      this.sumasTotales();
      this.ultimaExistencia();


     }else{
       let prueba = this.modales.modal_devolucion_venta.filter(x => x.tipo == 'ingreso_venta');
     if (prueba.length == 0) {
       toastr.error("No puedes enviar solo existencias", "Smarmoddle", {
          "timeOut": "3000"
      });
       return

     }

      let venta = this.modales.modal_devolucion_venta.filter(x => x.tipo == 'ingreso_venta');
       let id = this.transacciones.length + 1;
      let filtro_existencias = this.modales.modal_devolucion_venta.filter(x => x.tipo == 'existencia');
      let existencia = {identificador: id, tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:venta[0].existencia_cantidad, existencia_precio:venta[0].existencia_precio, existencia_total:''}
          filtro_existencias.unshift(existencia);
        this.existencias = JSON.parse(JSON.stringify(filtro_existencias));

           let exi_total = 0;

          filtro_existencias.forEach(function(existencia, i){
          
            let cantidad = existencia.existencia_cantidad;
            let precio = existencia.existencia_precio;

            let subtotal = Number(cantidad) * Number(precio);
                                                                  
                exi_total += Number(subtotal);

                  });

        let ultimo = this.modales.modal_devolucion_venta.length - 1;

        this.modales.modal_devolucion_venta[ultimo].existencia_total = exi_total.toFixed(2);
         this.totales.total = exi_total;
        console.log(exi_total);
        this.transacciones.push(this.modales.modal_devolucion_venta);
        this.modales.modal_devolucion_venta = [];
     
        this.transaccion.ingreso.cantidad = '';
        this.transaccion.ingreso.precio   = '';
        this.transaccion.ingreso.total    = '';
      $('#ingreso').modal('hide');
      this.sumasTotales();
    this.ultimaExistencia();

     }
  },

  editarTransaccion(index, id){
    // let id = index;
     if (this.transacciones[index][id].tipo == 'inicial') {
     
      this.update = true;

      this.inicial.fecha = this.transacciones[index][id].fecha;
      this.inicial.movimiento = this.transacciones[index][id].movimiento;
      this.inicial.cantidad = this.transacciones[index][id].existencia_cantidad;
      this.inicial.precio = this.transacciones[index][id].existencia_precio;

      $('#saldo_inicial').modal('show');
    }
    else if(this.transacciones[index][id].tipo == 'ingreso'){
      this.actuingreso.index = index;
      this.actuingreso.estado = true;
      this.actuegreso.estado = false;

      const second = JSON.parse(JSON.stringify(this.transacciones[index]));
      this.ejercicio = second;
    }
      else if(this.transacciones[index][id].tipo == 'egreso'){
      this.actuegreso.index = index;
      this.actuegreso.estado = true;
      this.actuingreso.estado = false;
      this.actuegreso.tipo = true;

      const egre = JSON.parse(JSON.stringify(this.transacciones[index]));
      this.egresos = egre;
    }else if(this.transacciones[index][id].tipo == 'ingreso_venta'){
      this.actuingreso.index = index;
      this.actuingreso.estado = true;
      this.actuegreso.estado = false;

      const venta = JSON.parse(JSON.stringify(this.transacciones[index]));
      this.ejercicio = venta;
    }
    else if(this.transacciones[index][id].tipo == 'egreso_compra'){
      this.actuegreso.index = index;
      this.actuegreso.estado = true;
      this.actuingreso.estado = false;

      const comprea = JSON.parse(JSON.stringify(this.transacciones[index]));
      this.egresos = comprea;
    }

  },
  cancelarActualizacion(tipo){
    if (tipo == 'egresos') {
      this.actuegreso.index = '';
      this.actuegreso.estado = false;
      this.actuegreso.tipo = false;
      this.egresos = [];
    }else if(tipo == 'ingresos'){
      this.actuingreso.index = '';
      this.actuingreso.estado = false;
      this.ejercicio = [];
    }

  },
  actualizarIngreso(){
    let ingreso = this.ejercicio.filter(x => x.tipo == 'ingreso' ||  x.tipo == 'ingreso_venta' );
    let id = this.transacciones.length + 1;

    let multi = Number(ingreso[0].ingreso_cantidad * ingreso[0].ingreso_precio).toFixed(2);
    ingreso[0].ingreso_total = multi;
    let filtro_existencias = this.ejercicio.filter(x => x.tipo == 'existencia');
    
    let existencia = {identificador: id, tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:ingreso[0].existencia_cantidad, existencia_precio:ingreso[0].existencia_precio, existencia_total:''}

      filtro_existencias.push(existencia);
       
      let exi_total = 0;

      filtro_existencias.forEach(function(existencia, i){
                   
            let cantidad = existencia.existencia_cantidad;
            let precio = existencia.existencia_precio;

            let subtotal = Number(cantidad) * Number(precio);
                                                                  
                exi_total += Number(subtotal);

                  });

        let ultimo = this.ejercicio.length - 1;

        this.ejercicio[ultimo].existencia_total = exi_total.toFixed(2);

    let index = this.actuingreso.index;
    this.transacciones[index] = this.ejercicio;
    this.ejercicio = [];
    this.actuingreso.estado = false;
    this.actuingreso.index = '';
    this.sumasTotales();
    this.ultimaExistencia();

  },
    nuevoEgreso(metodo){


    if (metodo == 'agregar') {
       this.transaccion.egreso.add = true;
    } else if(metodo == 'cerrar'){
       this.transaccion.egreso.add = false;
    }else if(metodo == 'crear'){
    if(this.edit.egreso.cantidad.trim() ==='' || this.edit.egreso.precio.trim() ==='' ){
      toastr.error("Todos lo campos son obligatorios", "Smarmoddle", {
        "timeOut": "3000"
    });
    
    }else{
      let egresos = this.modales.modal_egreso.filter(x => x.tipo == 'egreso');
      let id = this.transacciones.length + 1;
       let ultimo = egresos.length - 1;
        this.edit.egreso.total = Number(this.edit.egreso.cantidad * this.edit.egreso.precio);
       
        let array = {identificacion: id, tipo:'egreso', fecha:'', movimiento:'', egreso_cantidad:this.edit.egreso.cantidad, egreso_precio:this.edit.egreso.precio, egreso_total:this.edit.egreso.total, existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total: ''};
        this.modales.modal_egreso.splice(ultimo + 1, 0, array);
           this.edit.egreso.cantidad   = '';
     this.edit.egreso.precio     = '';
     this.edit.egreso.total      = '';
     this.transaccion.egreso.add = false;
   }
    }
  
   
  },
    agregarEgreso(tipo){

    if(this.transaccion.egreso.cantidad.trim() ==='' || this.transaccion.egreso.precio.trim() ==='' ){
      toastr.error("Todos lo campos son obligatorios", "Smarmoddle", {
        "timeOut": "3000"
    });
    }else {
      if (tipo == 'compra') {
        let id = this.transacciones.length + 1;
        this.transaccion.egreso.total = Number(this.transaccion.egreso.cantidad * this.transaccion.egreso.precio).toFixed(2);
        let calculo = Number(this.totales.total) - Number(this.transaccion.egreso.total);
        let array = {identificacion: id, fecha:'', movimiento:'', tipo:'egreso_compra', fecha:this.transaccion.fecha, movimiento:this.transaccion.movimiento, ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:this.transaccion.egreso.cantidad, egreso_precio:this.transaccion.egreso.precio, egreso_total:this.transaccion.egreso.total, existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total: ''};
        this.modales.modal_devolucion_compra.push(array)
        
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
        this.exis.cantidad                   = '';
        this.exis.precio                     = '';
        this.transaccion.fecha               = '';
        this.transaccion.movimiento          = '';
        this.transaccion.egreso.cantidad     = '';
        this.transaccion.egreso.precio       = '';
        this.transaccion.egreso.total        = '';
        this.transaccion.existencia.cantidad = '';
        this.transaccion.existencia.precio   = '';

        return
      }
      let egreso = this.modales.modal_egreso.filter(x => x.tipo == 'egreso');
      let id = this.transacciones.length + 1;
      if (egreso.length == 0) {
        this.transaccion.egreso.total = Number(this.transaccion.egreso.cantidad * this.transaccion.egreso.precio).toFixed(2);
        let calculo = Number(this.totales.total) - Number(this.transaccion.egreso.total);
        let array = {identificacion: id, fecha:'', movimiento:'', tipo:'egreso', fecha:this.transaccion.fecha, movimiento:this.transaccion.movimiento, ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:this.transaccion.egreso.cantidad, egreso_precio:this.transaccion.egreso.precio, egreso_total:this.transaccion.egreso.total, existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total: ''};
        this.modales.modal_egreso.unshift(array)
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
        this.exis.cantidad                   = '';
        this.exis.precio                     = '';
        this.transaccion.fecha               = '';
        this.transaccion.movimiento          = '';
        this.transaccion.egreso.cantidad     = '';
        this.transaccion.egreso.precio       = '';
        this.transaccion.egreso.total        = '';
        this.transaccion.existencia.cantidad = '';
        this.transaccion.existencia.precio   = '';
        this.transaccion.egreso.active        = true;
      }else{
      let egresos = this.modales.modal_egreso.filter(x => x.tipo == 'egreso');

        let ultimo = egresos.length - 1;
     
        let total = Number(this.modales.modal_egreso[ultimo].existencia_total);
        this.transaccion.egreso.total = Number(this.transaccion.egreso.cantidad * this.transaccion.egreso.precio).toFixed(2);
        let calculo =  total - Number(this.transaccion.egreso.total);
        let array = {identificacion: id, fecha:'', movimiento:'', tipo:'egreso', fecha:this.transaccion.fecha, movimiento:this.transaccion.movimiento, ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'',  egreso_cantidad:this.transaccion.egreso.cantidad, egreso_precio:this.transaccion.egreso.precio, egreso_total:this.transaccion.egreso.total, existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total: ''};
        this.modales.modal_egreso.splice(ultimo + 1, 0, array);
   
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
        this.exis.cantidad                   = '';
        this.exis.precio                     = '';
        this.transaccion.fecha               = '';
        this.transaccion.movimiento          = '';
        this.transaccion.egreso.cantidad     = '';
        this.transaccion.egreso.precio       = '';
        this.transaccion.egreso.total        = '';
        this.transaccion.existencia.cantidad = '';
        this.transaccion.existencia.precio   = '';
      }
    }

    },

    agregarEgresoNew(tipo){

      if(this.transaccion.egreso.cantidad.trim() ==='' || this.transaccion.egreso.precio.trim() ==='' ){
        toastr.error("Cantidad y Precio son obligatorios", "Smarmoddle", {
          "timeOut": "3000"
      });
        }else {
      let transacciones = this.transacciones;

        let index = this.actuegreso.index;
       
        let ultimo = this.egresos.length - 1;
     
        this.transaccion.egreso.total = Number(this.transaccion.egreso.cantidad * this.transaccion.egreso.precio).toFixed(2);
        
        let array = {identificacion: index, fecha:'', movimiento:'', tipo:'egreso', fecha:this.transaccion.fecha, movimiento:this.transaccion.movimiento, ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:this.transaccion.egreso.cantidad, egreso_precio:this.transaccion.egreso.precio, egreso_total:this.transaccion.egreso.total, existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total: ''};
        this.egresos.splice(ultimo + 1, 0, array);
        this.transaccion.egreso.edit = false;

         
       
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
          this.exis.cantidad                   = '';
          this.exis.precio                     = '';
          this.transaccion.fecha               = '';
          this.transaccion.movimiento          = '';
          this.transaccion.egreso.cantidad     = '';
          this.transaccion.egreso.precio       = '';
          this.transaccion.egreso.total        = '';
          this.transaccion.existencia.cantidad = '';
          this.transaccion.existencia.precio   = '';
        }
      },
    existenciaEgreso(tipo){

    let id = this.transacciones.length + 1;
    var existencia ={identificador: id, fecha:'', movimiento:'',  tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.exis.cantidad, existencia_precio:this.exis.precio, existencia_total:''}
    if (tipo == 'compra') {
      this.modales.modal_devolucion_compra.unshift(existencia);
    }else{
      this.modales.modal_egreso.push(existencia);
    }
      
      toastr.success("Agregado", "Smarmoddle", {
        "timeOut": "3000"
    });
      this.exis.cantidad = '';
      this.exis.precio = '';
      this.modales.existencia_ingreso = false;
    
    },
        exisEgresoAct(tipo){

    let id = this.transacciones.length + 1;
    var existencia ={identificador: id, tipo:'existencia', fecha:'', movimiento:'', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.exis.cantidad, existencia_precio:this.exis.precio, existencia_total:''}
    if (tipo == 'compra') {
      this.egresos.unshift(existencia);
    }else{
      this.egresos.push(existencia);
    }
      
      toastr.success("Agregado", "Smarmoddle", {
        "timeOut": "3000"
    });
      this.exis.cantidad = '';
      this.exis.precio = '';
      this.modales.existencia_ingreso = false;
    },
    agregarEgresos(){

      let egresos = this.modales.modal_egreso.filter(x => x.tipo == 'egreso');
      let u= egresos.length - 1;
      let existencia_total = JSON.parse(JSON.stringify(egresos[u].existencia_total));
      let iden = this.transacciones.length + 1;
      let exis = this.modales.modal_egreso.filter(x => x.tipo == 'existencia');
      let conteo = this.modales.modal_egreso.filter(x => x.tipo == 'existencia');
      let existencias_egresos = this.modales.modal_egreso.filter(x => x.tipo == 'egreso' &&  x.existencia_cantidad > 0 && x.existencia_cantidad !== '');
        existencias_egresos.forEach(function(existencia, id){
          let agregar = {identificador: iden, tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:existencia.existencia_cantidad, existencia_precio:existencia.existencia_precio, existencia_total:''}
          exis.unshift(agregar);
            });
       
          this.existencias = JSON.parse(JSON.stringify(exis));

          let exi_total = 0;

          exis.forEach(function(existencia, i){
           
            let cantidad = existencia.existencia_cantidad;
            let precio = existencia.existencia_precio;

            let subtotal = Number(cantidad) * Number(precio);
                                                                 
                exi_total += Number(subtotal);

                  });

        let ultimo = this.modales.modal_egreso.length - 1;

        this.modales.modal_egreso[ultimo].existencia_total = exi_total.toFixed(2);
         this.totales.total = exi_total;
        console.log(exi_total);



      this.transacciones.push(this.modales.modal_egreso);
      this.modales.modal_egreso = [];
      $('#egreso').modal('hide');

      this.transaccion.fecha      = '';
      this.transaccion.movimiento = '';
      this.transaccion.egreso.cantidad = '';
      this.transaccion.egreso.precio   = '';
      this.transaccion.egreso.total    = '';
      this.sumasTotales();
    this.ultimaExistencia();


    },
    agregarDevolucionCompra(){
      
      let egresos = this.modales.modal_devolucion_compra.filter(x => x.tipo == 'egreso_compra');
      let u= egresos.length - 1;
      let existencia_total = JSON.parse(JSON.stringify(egresos[u].existencia_total));
      let iden = this.transacciones.length + 1;


      let exis = this.modales.modal_devolucion_compra.filter(x => x.tipo == 'existencia');
      let conteo = this.modales.modal_devolucion_compra.filter(x => x.tipo == 'existencia');
     


   

      let existencias_egresos = this.modales.modal_devolucion_compra.filter(x => x.tipo == 'egreso_compra' &&  x.existencia_cantidad > 0);
        existencias_egresos.forEach(function(existencia, id){
          let agregar = {identificador: iden, tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:existencia.existencia_cantidad, existencia_precio:existencia.existencia_precio, existencia_total:''}
          exis.push(agregar);
            });
       
          let exi_total = 0;

          exis.forEach(function(existencia, i){
          
            let cantidad = existencia.existencia_cantidad;
            let precio = existencia.existencia_precio;

            let subtotal = Number(cantidad) * Number(precio);
                                                                 
                exi_total += Number(subtotal);

                  });

        let ultimo = this.modales.modal_devolucion_compra.length - 1;

        this.modales.modal_devolucion_compra[ultimo].existencia_total = exi_total.toFixed(2);
         this.totales.total = exi_total;
        console.log(exi_total);
       this.existencias = JSON.parse(JSON.stringify(exis));
     
        

    
      this.transacciones.push(this.modales.modal_devolucion_compra);
      this.modales.modal_devolucion_compra = [];
      $('#egreso').modal('hide');
    
      this.transaccion.fecha      = '';
      this.transaccion.movimiento = '';
      this.transaccion.egreso.cantidad = '';
      this.transaccion.egreso.precio   = '';
      this.transaccion.egreso.total    = '';
      this.sumasTotales();
    this.ultimaExistencia();


    }, 
     actualEgre(id, tipo){

      if (tipo == 'devolucion_compra') {
      let i = id;
      let totales = this.totales.total;
      let egresos = this.modales.modal_devolucion_compra.filter(x => x.tipo == 'egreso_compra');
      let ul = egresos.length - 1;
      let exis           =  Number(egresos[ul].existencia_total);

      let cantidad       = Number(this.modales.modal_devolucion_compra[i].egreso_cantidad);
      let precio         = Number(this.modales.modal_devolucion_compra[i].egreso_precio);
      let total1         = this.modales.modal_devolucion_compra[i].egreso_total;
      let multiplicacion =  cantidad * precio;



    this.modales.modal_devolucion_compra[i].egreso_total = multiplicacion.toFixed(2);
      if (total1 > multiplicacion) {
        let dife = total1 - multiplicacion;
        let suma = exis + dife  
        this.totales.subtotal = suma
      }else{
        let adi = multiplicacion - total1 ;
        let suma =exis - adi  
        this.totales.subtotal = suma
      }

        toastr.error("Datos Actualizado", "Smarmoddle", {
        "timeOut": "3000"
        });

        return
      }

      let i = id;
      let totales = this.totales.total;
      let egresos = this.modales.modal_egreso.filter(x => x.tipo == 'egreso');
      if (egresos.length >= 1) {
        let cantidad       = Number(this.modales.modal_egreso[i].egreso_cantidad);
      let precio         = Number(this.modales.modal_egreso[i].egreso_precio);
      let total1         = this.modales.modal_egreso[i].egreso_total;
      let multiplicacion =  cantidad * precio;
      this.modales.modal_egreso[i].egreso_total = multiplicacion.toFixed(2);
  
      }
      
   
    

    },
    totaEgre(id){
      let i              = id;
      let exis           = this.totales.total
      let cantidad       = Number(this.egresos[i].egreso_cantidad);
      let precio         = Number(this.egresos[i].egreso_precio);
      let total1         = this.egresos[i].egreso_total;
      let multiplicacion =  cantidad * precio;



      this.egresos[i].egreso_total = multiplicacion.toFixed(2);

    

    },
    ActualizarEgresos(){
    

   
    let exis = [];
    let existencias_egresos = this.egresos.filter(x => x.tipo == 'egreso'  &&  x.existencia_cantidad > 0 & x.existencia_cantidad !== '' || x.tipo == 'egreso_compra' &&  x.existencia_cantidad > 0 & x.existencia_cantidad !== '');
        existencias_egresos.forEach(function(existencia, id){
      let agregar = {tipo:'existencia', fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:existencia.existencia_cantidad, existencia_precio:existencia.existencia_precio, existencia_total:''}
      exis.push(agregar);
        });
       console.log(exis + 'inu')
      
   
      existencias_egresos.forEach(function(egreso, id){
            let cantidad = egreso.egreso_cantidad;
            let precio = egreso.egreso_precio;
            let total = Number(cantidad * precio);
            existencias_egresos[id].egreso_total = total.toFixed(2);
        });

   
    let existencias_filtro = this.egresos.filter(x => x.tipo == 'existencia');
    if (existencias_filtro.length >= 1) {  
      filtro_existencias = exis.concat(existencias_filtro);
       console.log('filtros')

    }else{
       console.log(exis)
      filtro_existencias = exis;
    }
      let exi_total = 0;
      this.existencias = JSON.parse(JSON.stringify(filtro_existencias));
      filtro_existencias.forEach(function(existencia, i){
                   
            let cantidad = existencia.existencia_cantidad;
            let precio = existencia.existencia_precio;

            let subtotal = Number(cantidad) * Number(precio);
                                                                  
                exi_total += Number(subtotal);

                  });

        let ultimo = this.egresos.length - 1;

        this.egresos[ultimo].existencia_total = exi_total.toFixed(2);

        let index = this.actuegreso.index;
        this.transacciones[index] = this.egresos;
        this.egresos = [];
        this.actuegreso.estado = false;
        this.actuegreso.tipo = false;
        this.actuegreso.index = '';
        this.sumasTotales();
       this.ultimaExistencia();

        },
    borrarEgresoAct(index, tipo){
      let transacciones = this.transacciones;
      let puesto = this.actuegreso.index;
      let id = index;
      let ultimo = this.modales.modal_devolucion_compra.length - 1;

      if (tipo == 'existencia') {

    if (this.egresos[index].tipo == 'existencia') {
        this.egresos.splice(index, 1);
     }
        return
    }
    if (tipo == 'egreso_compra') {

      if (this.modales.egresos[id].tipo == 'existencia') {
        this.modales.egresos.splice(index, 1);
      }else if (id == ultimo && this.modales.egresos[id].tipo == 'egreso_compra') {
        console.log('No puede eliminar todos los egresos')

     
      }
        return
    }
    
      let egresos = this.egresos.filter(x => x.tipo == 'egreso');

                    //ELIMINAR UN EGRESO
      if ( this.egresos[id].tipo == 'existencia' && this.egresos[id].existencia_total > 0) {
     
        this.egresos.splice(index, 1);

      }else if ( this.egresos[id].tipo == 'existencia' && this.egresos[id].existencia_total == '') {
     
        this.egresos.splice(index, 1);

      }else if ( this.egresos[id].tipo == 'egreso' && egresos.length == 1) {
       
        console.log('No puede eliminar todos los egresos')
      

      }else if (this.egresos[id].tipo == 'egreso' && this.egresos[id].existencia_total > 0) {
      
        this.egresos.splice(index, 1);





      }else if (this.egresos[id].tipo == 'egreso' && this.egresos[id].existencia_total == ''){
  
        this.egresos.splice(index, 1);

    

        }
  },
    borrarEgreso(index, tipo){
    let id = index;
    let ultimo = this.modales.modal_devolucion_compra.length - 1;

    if (tipo == 'egreso_compra') {

      if (this.modales.modal_devolucion_compra[id].tipo == 'existencia') {
        this.modales.modal_devolucion_compra.splice(index, 1);
      }else if (id == ultimo && this.modales.modal_devolucion_compra[id].tipo == 'egreso_compra') {
        let total =  this.modales.modal_devolucion_compra[id].existencia_total;
        this.modales.modal_devolucion_compra.splice(index, 1);
      }
        return
    }
      let egresos = this.modales.modal_egreso.filter(x => x.tipo == 'egreso');

                    //ELIMINAR UN EGRESO
      if ( this.modales.modal_egreso[id].tipo == 'existencia') {
       
        this.modales.modal_egreso.splice(index, 1);

      }else if ( this.modales.modal_egreso[id].tipo == 'egreso' ) {

     
        this.modales.modal_egreso.splice(index, 1);

      }
     
    },
    agregarDevolucion(){

    if(this.transaccion.fecha.trim() ==='' || this.transaccion.movimiento.trim() ==='' || this.transaccion.ingreso.cantidad.trim() ==='' || this.transaccion.ingreso.precio.trim() ===''){
      toastr.error("Todos los campos son obligatorios", "Smarmoddle", {
        "timeOut": "3000"
    });
     }else {
      let id = this.transacciones.length + 1;
     
      this.transaccion.ingreso.total = Number(this.transaccion.ingreso.cantidad * this.transaccion.ingreso.precio).toFixed(2);
      let calculo = Number(this.transaccion.ingreso.total) +  Number(this.totales.total);
      let array = {identificador: id, fecha:'', movimiento:'',  tipo:'ingreso_venta', fecha: this.transaccion.fecha, movimiento:this.transaccion.movimiento, ingreso_cantidad:this.transaccion.ingreso.cantidad, ingreso_precio:this.transaccion.ingreso.precio, ingreso_total:this.transaccion.ingreso.total, egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total:''};
     
      this.modales.modal_devolucion_venta.unshift(array);
  
      toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
    });
      this.transaccion.exis.cantidad = this.transaccion.existencia.cantidad;
      this.transaccion.exis.precio = this.transaccion.existencia.precio;
      this.transaccion.fecha            = '';
      this.transaccion.movimiento       = '';
      this.transaccion.ingreso.cantidad = '';
      this.transaccion.ingreso.precio   = '';
      this.transaccion.ingreso.total    = '';
      this.transaccion.existencia.precio   = '';
      this.transaccion.existencia.cantidad    = '';

    }
    },

    existenciaVenta(){

    let id = this.transacciones.length + 1;
          let ultimo = this.modales.modal_devolucion_venta.length - 1;
          let total = this.modales.modal_devolucion_venta[ultimo].existencia_total;
          let existencia ={identificador: id, fecha:'', movimiento:'', tipo:'existencia', ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'', existencia_cantidad:this.exis.cantidad, existencia_precio:this.exis.precio, existencia_total:''}
          this.modales.modal_devolucion_venta.push(existencia);
          this.modales.modal_devolucion_venta[ultimo].existencia_total = '';
          toastr.success("Agregado", "Smarmoddle", {
            "timeOut": "3000"
            });
          this.exis.cantidad                = '';
          this.exis.precio                  = '';
          this.transaccion.fecha            = '';
          this.transaccion.movimiento       = '';
          this.transaccion.ingreso.cantidad = '';
          this.transaccion.ingreso.precio   = '';
          this.transaccion.ingreso.total    = '';
     // }
    },
    agregarNewEgreso(tipo){
    if (tipo == 'agregar') {
      this.transaccion.egreso.edit = true;

      }else{
      this.transaccion.egreso.edit = false;
      this.transaccion.egreso.cantidad = '';
      this.transaccion.egreso.precio   = '';
      }
    },
     guardarKardex: function() {
    if(this.transacciones.length == 0){
          toastr.error("Debe haber al menos un registro en el Kardex", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else if(this.nombre.trim() === ''  || this.producto.trim() === ''){
          toastr.error("Nombre & Producto es Obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else{
        let _this = this;
        let url = '/sistema/admin/taller/kardex-fifo';
            axios.post(url,{
              id: _this.id_taller,
              nombre: _this.nombre,
              producto_id: _this.producto_id,
              producto: _this.producto,
              kardex_fifo: _this.transacciones,
              inv_inicial_cantidad: _this.prueba.cantidad.inventario_inicial,
              adquisicion_cantidad: _this.prueba.cantidad.adquicisiones,
              ventas_cantidad: _this.prueba.cantidad.ventas,
              inv_final_cantidad: _this.prueba.cantidad.inventario_final,
              inv_inicial_precio: _this.prueba.precio.inventario_inicial,
              adquisicion_precio: _this.prueba.precio.adquicisiones,
              ventas_precio: _this.prueba.precio.ventas,
              inv_final_precio: _this.prueba.precio.inventario_final,

        }).then(response => {
          if (response.data.estado == 'guardado') {
              toastr.success("Kardex creado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            }else if (response.data.estado == 'actualizado') {
              toastr.warning("kardex actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            }        
        }).catch(function(error){

        }); 

     } 
     
     },
        obtenerKardexFifo: function() {
        let _this = this;
        let url = '/sistema/admin/taller/kardex-obtener-fifo';
            axios.post(url,{
              id: _this.id_taller,
              producto_id: _this.producto_id
        }).then(response => {
          if (response.data.datos == true) {
              toastr.info("Kardex Fifo cargado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              _this.transacciones = response.data.kardex_fifo;
              _this.nombre =  response.data.informacion.nombre;
              _this.producto = response.data.informacion.producto;
               _this.prueba.cantidad.inventario_inicial = response.data.informacion.inv_inicial_cantidad;
               _this.prueba.cantidad.adquicisiones      = response.data.informacion.adquisicion_cantidad;
               _this.prueba.cantidad.ventas             = response.data.informacion.ventas_cantidad;
               _this.prueba.cantidad.inventario_final   = response.data.informacion.inv_final_cantidad;
               _this.prueba.precio.inventario_inicial = response.data.informacion.inv_inicial_precio;
               _this.prueba.precio.adquicisiones      = response.data.informacion.adquisicion_precio;
               _this.prueba.precio.ventas             = response.data.informacion.ventas_precio;
               _this.prueba.precio.inventario_final   = response.data.informacion.inv_final_precio;

             
              _this.datos_transacciones =  response.data.transacciones.transacciones; 
              console.log('nO SE RECIBIO NADA')      

              this.sumasTotales();
            this.ultimaExistencia();
              
            }else if (response.data.datos == false){
              _this.transacciones = [];
              _this.nombre =  '';
              _this.producto = '';
               _this.prueba.cantidad.inventario_inicial = '';
               _this.prueba.cantidad.adquicisiones      = '' ;
               _this.prueba.cantidad.ventas             = '' ;
               _this.prueba.cantidad.inventario_final   = '' ;
               _this.prueba.precio.inventario_inicial = '' ;
               _this.prueba.precio.adquicisiones      = '' ;
               _this.prueba.precio.ventas             = '' ;
               _this.prueba.precio.inventario_final   = '' ;
              _this.datos_transacciones =  response.data.transacciones.transacciones; 
            this.sumasTotales();
            this.ultimaExistencia();
                
            }        
        }).catch(function(error){

        }); 
     },
    borrarTransaccion(index, id){
       Swal.fire({
        title: 'Seguro que deseas eliminar este registro??',
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro se elimino',
            'success'
          );
        let u = this.transacciones.length - 1;

      if (u == index) {

      this.transacciones.splice(index, 1);
      if (this.transacciones.length == 0) {
         this.sumasTotales();
        this.ultimaExistencia();
        return
      }

      let last = this.transacciones.length - 1;
      let ultima_transaccion = JSON.parse(JSON.stringify(this.transacciones[last]));

        let consulta1 = ultima_transaccion.filter(x => x.tipo == 'ingreso');

        if (consulta1.length >= 1) {
            let ingreso = ultima_transaccion.filter(x => x.tipo == 'ingreso');
            let filtro_existencias = ultima_transaccion.filter(x => x.tipo == 'existencia');
            let existencia = {tipo:'existencia', existencia_cantidad:ingreso[0].existencia_cantidad, existencia_precio:ingreso[0].existencia_precio};
            filtro_existencias.push(existencia);
            this.existencias = JSON.parse(JSON.stringify(filtro_existencias));
            this.sumasTotales();
            this.ultimaExistencia();
            
            return
        }
        let consulta2 = ultima_transaccion.filter(x => x.tipo == 'egreso');

        if (consulta2.length >= 1) {

              let exis = ultima_transaccion.filter(x => x.tipo == 'existencia');
              let existencias_egresos = ultima_transaccion.filter(x => x.tipo == 'egreso' &&  x.existencia_cantidad > 0);
              existencias_egresos.forEach(function(existencia, id){
                let agregar = {tipo:'existencia', existencia_cantidad:existencia.existencia_cantidad, existencia_precio:existencia.existencia_precio, existencia_total:''}
                exis.unshift(agregar);
              });
              this.existencias = JSON.parse(JSON.stringify(exis));
                 this.sumasTotales();
              this.ultimaExistencia();
              
              return

        }
        let consulta3 = ultima_transaccion.filter(x => x.tipo == 'egreso_compra');

        if (consulta3.length >= 1) {
              let egresos = ultima_transaccion.filter(x => x.tipo == 'egreso_compra');
              let exis = ultima_transaccion.filter(x => x.tipo == 'existencia');
              let existencias_egresos = ultima_transaccion.filter(x => x.tipo == 'egreso_compra' &&  x.existencia_cantidad > 0);
              existencias_egresos.forEach(function(existencia, id){
                let agregar = { tipo:'existencia', existencia_cantidad:existencia.existencia_cantidad, existencia_precio:existencia.existencia_precio, existencia_total:''}
                exis.push(agregar);
              });
              this.existencias = JSON.parse(JSON.stringify(exis));
              this.sumasTotales();
              this.ultimaExistencia();
              
              return

        }
        let consulta4 = ultima_transaccion.filter(x => x.tipo == 'ingreso_venta');

        if (consulta4.length >= 1) {
              let venta = ultima_transaccion.filter(x => x.tipo == 'ingreso_venta');
              let filtro_existencias = ultima_transaccion.filter(x => x.tipo == 'existencia');
              let existencia = { tipo:'existencia', existencia_cantidad:venta[0].existencia_cantidad, existencia_precio:venta[0].existencia_precio}
              filtro_existencias.unshift(existencia);
              this.existencias = JSON.parse(JSON.stringify(filtro_existencias));
                 this.sumasTotales();
       this.ultimaExistencia();
              
              return
        }
        let consulta5 = ultima_transaccion.filter(x => x.tipo == 'inicial');

        if (consulta5.length >= 1) {
           
              this.existencias = [];
              this.sumasTotales();
              this.ultimaExistencia();
              return
        }
      }else{
        this.transacciones.splice(index, 1);
        this.sumasTotales();
        this.ultimaExistencia();
        

      }
      


        }
      });


        }   
}
});


const kardex_promedio = new Vue({

  el: "#kardex_promedio",
  data:{
    id_taller: taller,
    kardex_id:'',
    producto:'',
    producto_id:'',
    nombre:'',
    transacciones:[],
    update:false,
    inicial:{
      fecha:'',
      movimiento:'',
      cantidad:'',
      precio:'',
      index:''

    },
    prueba:{
      cantidad:{
        inventario_inicial:'',
        adquicisiones:'',
        ventas:'',
        inventario_final:''
      },
      precio:{
        inventario_inicial:'',
        adquicisiones:'',
        ventas:'',
        inventario_final:''
      }
    },
    ultima_existencia:[],
    suman:{
      ingreso_cantidad:0,
      ingreso_total:0,
      egreso_cantidad:0,
      egreso_total:0,
      muestra:0
    },
    datos_transacciones:'',
    modales:{
      modal_ingreso:[],
      modal_egreso:[]
    },
    ingresos:[],
    egresos:[],
    transaccion:{
      fecha:'',
      movimiento:'',
        ingreso:{
          fecha:'',
          movimiento:'',
          cantidad:'',
          precio:'',
          total:'',
          edit:false,
          index:''
        },
        egreso:{
          fecha:'',
          movimiento:'',
          cantidad:'',
          precio:'',
          total:'',
          temp:'',
          edit:false,
          index:''
        },
        existencia:{
          cantidad:'',
          precio:'',
          total:''
        }
    }
  },
  mounted: function() {
    this.obtenerKardexPromedio();
  },
  methods:{
  calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
      decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
     
    },
    formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },
      cancelarActualizacion(tipo){
    if (tipo == 'egresos') {
      this.transaccion.egreso.index = '';
     this.transaccion.egreso.edit = false;
      this.egresos = [];
    }else if(tipo == 'ingresos'){
      this.transaccion.ingreso.index = '';
     this.transaccion.ingreso.edit = false;
  
      this.ingresos = [];
    }

  },
    exitenciaFinal(){
   let u = this.transacciones.length - 1;
    this.ultima_existencia = [JSON.parse(JSON.stringify(this.transacciones[u]))];
    },
     sumasTotales(){
      let transacciones = this.transacciones;
      let in_cantidad = 0;
      let in_total    = 0;
      let eg_cantidad = 0;
      let eg_total    = 0;
      let conteo = transacciones.length;
      if (conteo == 0 ) {
         this.suman.ingreso_cantidad = 0;
         this.suman.ingreso_total = 0;
        this.suman.egreso_cantidad = 0;
         this.suman.egreso_total = 0;
         return
      }
        //INGRESO CANTIDAD
            transacciones.forEach(function(ingreso_cantidad, id){
                let temp = ingreso_cantidad.ingreso_cantidad;

                if (temp != null && temp !=='') {
                    in_cantidad += parseInt(temp)
                  // console.log(temp);
                } 
            });
       this.suman.ingreso_cantidad = in_cantidad;

        //INGRESO TOTAL

              transacciones.forEach(function(ingreso_total, id){
                let temp1 = ingreso_total.ingreso_total;

                if (temp1 != null && temp1 !=='') {
                    in_total += Number(temp1)
                  // console.log(temp1);
                } 
            });
       this.suman.ingreso_total = in_total.toFixed(2)

       console.log(in_total)


        //EGRESO CANTIDAD
              transacciones.forEach(function(egreso_cantidad, id){
                let temp = egreso_cantidad.egreso_cantidad;

                if (temp != null && temp !=='') {
                    eg_cantidad += parseInt(temp)
                  // console.log(temp);
                } 
            });
       this.suman.egreso_cantidad = eg_cantidad;

        //EGRESO TOTAL

              transacciones.forEach(function(egreso_total, id){
                let temp1 = egreso_total.egreso_total;

                if (temp1 != null && temp1 !=='') {
                    eg_total += Number(temp1)
                  // console.log(temp1);
                } 
            });
       this.suman.egreso_total = eg_total.toFixed(2)

       console.log(in_total)

    },
     modalInicial:function () {
      this.cerrarInicial();
      if (this.transacciones.length >= 1) {
        let i =  this.transacciones.length - 1;
        console.log(this.transacciones[i]);
        this.movimientos =  this.transacciones[i];
        }
      $('#inicial').modal('show');
    },
      modalTransacciones:function () {
      $('#ingreso-kardex').modal('show');
    },
    calcularTotalIngreso(){
    if(this.transaccion.ingreso.cantidad.trim() ==='' || this.transaccion.ingreso.precio.trim() ==='' ){
      toastr.error("La Cantidad & Precio es Obligatoria", "Smarmoddle", {
        "timeOut": "3000"
      });
    }else {
      this.transaccion.ingreso.total = Number(this.transaccion.ingreso.cantidad * this.transaccion.ingreso.precio).toFixed(2);
      let array = {tipo:'ingreso', fecha: this.transaccion.ingreso.fecha, movimiento:this.transaccion.ingreso.movimiento, ingreso_cantidad:this.transaccion.ingreso.cantidad, ingreso_precio:this.transaccion.ingreso.precio, ingreso_total:this.transaccion.ingreso.total, egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total:''};
      this.modales.modal_ingreso.push(array);
      this.transaccion.ingreso.fecha       = '';
      this.transaccion.ingreso.movimiento  = '';
      this.transaccion.ingreso.cantidad    = '';
      this.transaccion.ingreso.precio      = '';
      this.transaccion.ingreso.total       = '';
   

     }
    },
      actuaIng(id){
      let i = id;
      
      let cantidad = Number(this.modales.modal_ingreso[i].ingreso_cantidad);
      let precio = Number(this.modales.modal_ingreso[i].ingreso_precio);
      let total1 = this.modales.modal_ingreso[i].ingreso_total;
      let multiplicacion =  cantidad * precio;
      this.modales.modal_ingreso[i].ingreso_total = multiplicacion.toFixed(2);
        toastr.success("Datos Actualizado", "Smarmoddle", {
        "timeOut": "3000"
        });
    
    },
      actuaEgre(id){
      let i = id;
     
      let cantidad = Number(this.modales.modal_egreso[i].egreso_cantidad);
      let precio = Number(this.modales.modal_egreso[i].egreso_precio);
      let total1 = this.modales.modal_egreso[i].egreso_total;
      let multiplicacion =  cantidad * precio;
      this.modales.modal_egreso[i].egreso_total = multiplicacion.toFixed(2);
        toastr.success("Datos Actualizado", "Smarmoddle", {
        "timeOut": "3000"
        });
    
    },
    calcularTotalEgreso(){
    if(this.transaccion.egreso.cantidad.trim() ==='' || this.transaccion.egreso.precio.trim() ==='' ){
      toastr.error("La Cantidad & Precio es Obligatoria", "Smarmoddle", {
        "timeOut": "3000"
      });
    }else {
      this.transaccion.egreso.total = Number(this.transaccion.egreso.cantidad * this.transaccion.egreso.precio).toFixed(2);
      let array = {tipo:'egreso', fecha: this.transaccion.egreso.fecha, movimiento:this.transaccion.egreso.movimiento, ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:this.transaccion.egreso.cantidad, egreso_precio:this.transaccion.egreso.precio, egreso_total:this.transaccion.egreso.total, existencia_cantidad:this.transaccion.existencia.cantidad, existencia_precio: this.transaccion.existencia.precio, existencia_total:''};
      this.modales.modal_egreso.push(array);
      this.transaccion.egreso.fecha       = '';
      this.transaccion.egreso.movimiento  = '';
      this.transaccion.egreso.cantidad    = '';
      this.transaccion.egreso.precio      = '';
      this.transaccion.egreso.total       = '';
   

     }
    },

    agregarInicial(){
      if(this.inicial.fecha.trim() ==='' || this.inicial.movimiento.trim() ==='' ||   this.inicial.cantidad.trim() ==='' || this.inicial.precio.trim() ==='' ){
      toastr.error("Todos los campos son Obligatorios", "Smarmoddle", {
        "timeOut": "3000"
      });
    }else {
      let cantidad = this.inicial.cantidad;
      let precio = this.inicial.precio;
      this.inicial.total = Number(cantidad * precio).toFixed(2);

      let inicial = {tipo:'inicial', fecha: this.inicial.fecha, movimiento:this.inicial.movimiento, ingreso_cantidad:'', ingreso_precio:'', ingreso_total:'', egreso_cantidad:'', egreso_precio:'', egreso_total:'',  existencia_cantidad:this.inicial.cantidad, existencia_precio: this.inicial.precio, existencia_total:this.inicial.total};
      this.transacciones.unshift(inicial)
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
          });
      this.update = false;

          this.inicial.fecha               = '';
          this.inicial.movimiento          = '';
          this.inicial.cantidad            = '';
          this.inicial.precio              = '';
          this.inicial.total               = '';
          $('#inicial').modal('hide');
          let ultima = this.transacciones.length - 1;
          this.ultima_existencia = [JSON.parse(JSON.stringify(this.transacciones[ultima]))];
          this.sumasTotales();


     }
    },
    cerrarInicial(){
      this.update = false;
      this.inicial.fecha      = '';
      this.inicial.movimiento = '';
      this.inicial.cantidad   = '';
      this.inicial.precio     = '';    
      this.inicial.fecha      = '';
      this.inicial.movimiento = '';
      this.inicial.cantidad   = '';
      this.inicial.precio     = '';
  },
    agregarIngreso(){
      
      this.transacciones.push(this.modales.modal_ingreso[0])
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
          });
          this.modales.modal_ingreso = [];
          $('#ingreso-kardex').modal('hide');
          let ultima = this.transacciones.length - 1;

          this.ultima_existencia = [JSON.parse(JSON.stringify(this.transacciones[ultima]))];
          this.sumasTotales();
     
    },
      agregarEgreso(){

           this.transacciones.push(this.modales.modal_egreso[0])
        toastr.success("Transaccion agregada correctamente", "Smarmoddle", {
        "timeOut": "3000"
          });
          this.modales.modal_egreso = [];
          $('#ingreso-kardex').modal('hide');
          let ultima = this.transacciones.length - 1;

          this.ultima_existencia = [JSON.parse(JSON.stringify(this.transacciones[ultima]))];
          this.sumasTotales();
    },
    editarTransaccion(id, tipo){
      if (tipo == 'ingreso'){
        this.transaccion.ingreso.edit = true;
        this.transaccion.egreso.edit = false;

        this.ingresos = [JSON.parse(JSON.stringify(this.transacciones[id]))];
        this.transaccion.ingreso.index = id;
      }else if(tipo == 'egreso'){
        this.transaccion.egreso.edit = true;
        this.transaccion.ingreso.edit = false;

        this.egresos = [JSON.parse(JSON.stringify(this.transacciones[id]))];
        this.transaccion.egreso.index = id;

      }else if(tipo == 'inicial'){
        this.transaccion.ingreso.edit = false;
        this.transaccion.egreso.edit = false;

          this.inicial.index      = id;
          this.inicial.fecha      = this.transacciones[id].fecha;
          this.inicial.movimiento = this.transacciones[id].movimiento;
          this.inicial.cantidad   = this.transacciones[id].existencia_cantidad;
          this.inicial.precio     = this.transacciones[id].existencia_precio;
          this.update             = true;
          $('#inicial').modal('show');
      }

    },
    actualizarIngreso(){
      let id                         = this.transaccion.ingreso.index;
      let cantidad                   = this.ingresos[0].ingreso_cantidad;
      let precio                     = this.ingresos[0].ingreso_precio;
      let total                      = Number(cantidad * precio).toFixed(2);
      this.ingresos[0].ingreso_total = total;
      let ingreso                    = this.ingresos[0];
      this.transacciones.splice(id, 1, ingreso);
      this.transaccion.ingreso.index = '';

   
      this.ingresos = [];
      this.exitenciaFinal();
          this.sumasTotales();
        this.transaccion.ingreso.edit = false;


    },
      actualizarEgreso(){
      let id                        = this.transaccion.egreso.index;
      let cantidad                  = this.egresos[0].egreso_cantidad;
      let precio                    = this.egresos[0].egreso_precio;
      let total                     = Number(cantidad * precio).toFixed(2);
      this.egresos[0].egreso_total  = total;
      let egreso                    = this.egresos[0];
      this.transacciones.splice(id, 1, egreso);
      this.transaccion.egreso.index = '';

 
      this.egresos = [];
      this.exitenciaFinal();
          this.sumasTotales();
        this.transaccion.egreso.edit = false;



    },
    actualizarInicial(){
      let id                            = this.inicial.index;
      let cantidad                      = this.inicial.cantidad;
      let precio                        = this.inicial.precio;
      let total                         = Number(cantidad * precio).toFixed(2);
      this.inicial.total                = total;
      this.transacciones[id].fecha      = this.inicial.fecha     ;
      this.transacciones[id].movimiento = this.inicial.movimiento;
      this.transacciones[id].existencia_cantidad   = this.inicial.cantidad  ;
      this.transacciones[id].existencia_precio     = this.inicial.precio    ;
      this.transacciones[id].existencia_total      = this.inicial.total    ;
      this.update                       = false;
      
      this.inicial.fecha                = '';
      this.inicial.movimiento           = '';
      this.inicial.cantidad             = '';
      this.inicial.precio               = '';
      this.inicial.total                = '';
      this.exitenciaFinal();
          this.sumasTotales();


      $('#inicial').modal('hide');
    },
    totalIng(id){
      let cantidad                   = this.ingresos[0].ingreso_cantidad;
      let precio                     = this.ingresos[0].ingreso_precio;
      let total                      = Number(cantidad * precio).toFixed(2);
      this.ingresos[0].ingreso_total = total;
    },
    totaEgre(id){
      let cantidad                 = this.egresos[0].egreso_cantidad;
      let precio                   = this.egresos[0].egreso_precio;
      let total                    = Number(cantidad * precio).toFixed(2);
      this.egresos[0].egreso_total = total;
    },

    borrarTransaccion(index){

       Swal.fire({
        title: 'Seguro que deseas eliminar este registro?? ',
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta se elimino correctamente',
            'success'
          );
         let u = this.transacciones.length - 1;

     if (index == u) {
        if (u == 0) {
          this.ultima_existencia = [];
           this.transacciones.splice(index, 1);
        }else{
           this.transacciones.splice(index, 1);
          this.ultima_existencia = [JSON.parse(JSON.stringify(this.transacciones[u - 1]))];
        }
     } else {
      this.transacciones.splice(index, 1);

     }
       toastr.info("Transaccion eliminada correctamente", "Smarmoddle", {
        "timeOut": "3000"
          });
      this.sumasTotales();

        }
      });

     
    },
      guardarKardex: function() {
    if(this.transacciones.length == 0){
          toastr.error("Debe haber al menos un registro en el Kardex", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else if(this.nombre.trim() === ''  || this.producto.trim() === ''){
          toastr.error("Nombre & Producto es Obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });

     }else{
        let _this = this;
        let url = '/sistema/admin/taller/kardex-promedio';
            axios.post(url,{
              id: _this.id_taller,
              nombre: _this.nombre,
              producto: _this.producto,
              producto_id: _this.producto_id,
              kardex_promedio: _this.transacciones,
              inv_inicial_cantidad: _this.prueba.cantidad.inventario_inicial,
              adquisicion_cantidad: _this.prueba.cantidad.adquicisiones,
              ventas_cantidad: _this.prueba.cantidad.ventas,
              inv_final_cantidad: _this.prueba.cantidad.inventario_final,
              inv_inicial_precio: _this.prueba.precio.inventario_inicial,
              adquisicion_precio: _this.prueba.precio.adquicisiones,
              ventas_precio: _this.prueba.precio.ventas,
              inv_final_precio: _this.prueba.precio.inventario_final,

        }).then(response => {
          if (response.data.estado == 'guardado') {
              toastr.success("Kardex creado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            }else if (response.data.estado == 'actualizado') {
              toastr.warning("kardex actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            }        
        }).catch(function(error){

        }); 

     } 
     
     },
        obtenerKardexPromedio: function() {
        let _this = this;
        let url = '/sistema/admin/taller/kardex-obtener-promedio';
            axios.post(url,{
              id: _this.id_taller,
              producto_id: _this.producto_id,
        }).then(response => {
          if (response.data.datos == true) {
              toastr.info("Kardex Promedio cargado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
              _this.transacciones = response.data.kardex_promedio;
              _this.nombre =  response.data.informacion.nombre;
              _this.producto = response.data.informacion.producto;
               _this.prueba.cantidad.inventario_inicial = response.data.informacion.inv_inicial_cantidad;
               _this.prueba.cantidad.adquicisiones      = response.data.informacion.adquisicion_cantidad;
               _this.prueba.cantidad.ventas             = response.data.informacion.ventas_cantidad;
               _this.prueba.cantidad.inventario_final   = response.data.informacion.inv_final_cantidad;
               _this.prueba.precio.inventario_inicial = response.data.informacion.inv_inicial_precio;
               _this.prueba.precio.adquicisiones      = response.data.informacion.adquisicion_precio;
               _this.prueba.precio.ventas             = response.data.informacion.ventas_precio;
               _this.prueba.precio.inventario_final   = response.data.informacion.inv_final_precio;

              _this.datos_transacciones =  response.data.transacciones.transacciones; 

              this.sumasTotales();
              this.exitenciaFinal();
            }else{
               _this.transacciones                      = [];
               _this.nombre                             =  '';
               _this.producto                           = '';
               _this.prueba.cantidad.inventario_inicial = '';
               _this.prueba.cantidad.adquicisiones      = '';
               _this.prueba.cantidad.ventas             = '';
               _this.prueba.cantidad.inventario_final   = '';
               _this.prueba.precio.inventario_inicial   = '';
               _this.prueba.precio.adquicisiones        = '';
               _this.prueba.precio.ventas               = '';
               _this.prueba.precio.inventario_final     = '';
              _this.datos_transacciones =  response.data.transacciones.transacciones; 

            }         
        }).catch(function(error){

        }); 
     } 
  }

});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////LIBRO CAJA ANEXO //////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


let librocaja = new Vue({
  el: "#librocaja",
  data:{
    id_taller: taller,
    nombre:'',
    libros_caja:[], //donde se almacenara todos los datos del libro CAJA
    caja:{ // variables a utilizar para el libro CAJA
      fecha:'',
      edit:false,
      detalle:'',
      debe:'',
      haber:'',
      saldo:'',
    },
    eliminar:{
      index:'',
      nombre:''
    },
    suman:{ //suma total del libro CAJA
      debe:0,
      haber:0,
    },
    update: false,
    registro_id:'',
    dgeneral:[],
    registros_cierres:[],
    ajustes:[],
    nombre_cierre:''
  },
  mounted: function() {
    this.obtenerLibroCaja();
    this.obtenerDiarioGeneral();
  },
  methods:{

    obtenerDiarioGeneral: function(){
      var _this = this;
      var url = '/sistema/admin/taller/diariogeneral';
          axios.post(url,{
            id: _this.id_taller,
      }).then(response => {
        if (response.data.datos == true) {
        _this.dgeneral = response.data.registros;
        _this.nombre_dgral = response.data.nombre;
        let inicial = response.data.inicial;
          _this.dgeneral.unshift(inicial);
          }          
      }).catch(function(error){

      }); 
  },

  calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
  },
  formatoFecha(fecha){
    if (fecha !== null) {
       let date = fecha.split('-').reverse().join('-');
    return date;
  }else{
    return
  }
   
  },
    totales: function(){
       this.suman.debe  =0;
       this.suman.haber =0;
       let regis  = this.libros_caja;
       let total1 = 0;
       let total2 = 0;

       regis.forEach(function(obj, index){
         total1 += Number(obj.debe);
       });
       regis.forEach(function(obj, index){
        total2 += Number(obj.haber);
      });
     
      this.suman.debe  = total1.toFixed(2);
      this.suman.haber = total2.toFixed(2);
    },

    abrirLibro(){ //solo para acceder al modal para agregar todo pilas 
      this.update             = false;   
     $('#libro-caja').modal('show');
   }, //fin de metodo abrirtransaccion


    agregarRegistro(){
         
      if(this.caja.fecha.trim() === ''){
        toastr.error("La fecha es obligatoria ", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else if(this.caja.detalle.trim() === ''){
          toastr.error("El campo Detalle es Obligatorio", "Smartmoodle", {
            "timeOut": "3000"
          });
      }else if(this.caja.debe.trim() !='' && this.caja.haber.trim() !=''){
          toastr.error("No puede llenar ambos campos de debe y haber", "Smartmoodle",{
            "timeOut": "30000"
          });
      }else {

        var caja = {fecha:this.caja.fecha, detalle:this.caja.detalle, debe:this.caja.debe, haber:this.caja.haber, saldo:this.caja.saldo  }
        this.libros_caja.push(caja);
        toastr.success("Registro agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
      this.caja.fecha   =''
      this.caja.detalle =''
      this.caja.debe    =''
      this.caja.haber   =''
      this.caja.saldo   =''
      this.totales();
      }

    }, // function agregarregistro
 
 

    editLibroCaja(index){
      this.caja.edit =true;
      this.registro_id  = index;
      this.caja.fecha   = this.libros_caja[index].fecha;
      this.caja.detalle = this.libros_caja[index].detalle;
      this.caja.debe    = this.libros_caja[index].debe;
      this.caja.haber   = this.libros_caja[index].haber;
      this.caja.saldo   = this.libros_caja[index].saldo;
    },


    editlibrocajafuera(index){

      this.caja.edit =true;
      this.registro_id  = index;
      this.caja.fecha   = this.libros_caja[index].fecha;
      this.caja.detalle = this.libros_caja[index].detalle;
      this.caja.debe    = this.libros_caja[index].debe;
      this.caja.haber   = this.libros_caja[index].haber;
      this.caja.saldo   = this.libros_caja[index].saldo;
      $('#libro-caja').modal('show');

    },//fin editlibrocajafuera


    cancelarEditlibro(){

      this.caja.fecha   =''
      this.caja.detalle =''
      this.caja.debe    =''
      this.caja.haber   =''
      this.caja.saldo   =''
      this.caja.edit       =false;
    },


    actualizarLibroCaja(){

      if(this.caja.fecha.trim() === ''){
        toastr.error("La fecha es obligatoria ", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else if(this.caja.detalle.trim() === ''){
          toastr.error("El campo Detalle es Obligatorio", "Smartmoodle", {
            "timeOut": "3000"
          });
     
      }else {
       let id                        = this.registro_id;
       this.libros_caja[id].fecha    = this.caja.fecha;
       this.libros_caja[id].detalle  = this.caja.detalle;
       this.libros_caja[id].debe     = this.caja.debe;
       this.libros_caja[id].haber    = this.caja.haber;
       this.libros_caja[id].saldo    = this.caja.saldo;
       this.cancelarEditlibro();
       this.totales();
       toastr.error("Registro actualizado correctamente", "Smarmoddle", {
        "timeOut": "3000"
        });
      }
     
    },//fin de actualizar libro de caja

   
     WarningEliminarLibro(id){
      this.eliminar.index = id;
      this.eliminar.nombre = this.libros_caja[id].detalle;

      Swal.fire({
        title: 'Seguro que deseas eliminar el Registro de '+this.eliminar.nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.eliminar.nombre,
            'success'
          );
          this.libros_caja.splice(id, 1);
          this.totales();
          }
          
      });
    }, //fin metodo warningeliminarcompra


      guardarLibro : function(){
        if(this.nombre.length == 0){
          toastr.error("Debe Ingresar el Nombre Comercial", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else if(this.libros_caja.length == 0){
          toastr.error("Debe haber al menos un registro en el Balance", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else {
          let _this = this;
          let url ='/sistema/admin/taller/anexo_caja';
               axios.post(url,{
                 id: _this.id_taller,
                 libros_caja:  _this.libros_caja,
                 nombre:       _this.nombre,
                 debe:         _this.suman.debe,
                 haber:        _this.suman.haber,
               }).then(response=>{
                if (response.data.estado == 'guardado') {
                  toastr.success("Anexo creado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                arqueo_caja.obtenerLibroCaja();
                }else if (response.data.estado == 'actualizado') {
                  toastr.warning("Anexo actualizado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                arqueo_caja.obtenerLibroCaja();
                this.totales();
                }        
            }).catch(function(error){
               });

        }
          
      }, //fin metodo guardar

      obtenerLibroCaja: function(){
        let _this = this;
        let url ='/sistema/admin/taller/anexo-obtener-caja';
              axios.post(url,{
                id: _this.id_taller, 
                }).then(response =>{
                  if(response.data.datos == true){
                    toastr.info("Anexo Libro Caja cargado correctamente", "Smarmoddle", {
                      "timeOut": "3000"
                      });
                      this.libros_caja = response.data.banexocaja;
                      this.nombre = response.data.nombre;
                      this.totales();
                  }
                }).catch(function(error){

                });
      },

  },

});




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////ARQUEO CAJA ANEXO /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const arqueo_caja = new Vue ({
  el: "#arqueo_caja",
 
  data:{
    id_taller : taller,
    libros_caja:[],
    debe_lb:'',
    haber_lb:'',
    nombre_lb:'',
    t_saldo:[], // array de saldos 
    saldo:{
      edit:false,
       detalle:'',
       s_debe   :'',
       s_haber  :'',
    },

    t_exis:[], // array de existencias
    exis:{
      edit:false,
      detalle:'',
      e_debe   :'',
      e_haber  :'',
    },
    sumas:{  // totales de Saldo debe y haber
      td:0,
      th:0,
    },  
    eliminar:{
      index:'',
      nombre:''
    },
    update: false,
    registro_id:'',
    
  },
  mounted: function() {
    this.ObtenerArqueo();
    this.obtenerLibroCaja();
  },
  methods:{
      calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },

    obtenerLibroCaja: function(){
      let _this = this;
      let url ='/sistema/admin/taller/anexo-obtener-caja';
            axios.post(url,{
              id: _this.id_taller, 
              }).then(response =>{
                if(response.data.datos == true){
                  
                    this.libros_caja = response.data.banexocaja;
                    this.nombre_lb   = response.data.nombre;
                    this.debe_lb     = response.data.totaldebe;
                    this.haber_lb     = response.data.totalhaber;
                   
                }
              }).catch(function(error){

              });
    }, //end function obtener libro caja


    formatoFecha(fecha){
      if (fecha !== null) {
         let date = fecha.split('-').reverse().join('-');
      return date;
    }else{
      return
    }
     
    },// fin fecha
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
  },

    totales_s: function(){
      this.sumas.td =0;
      this.sumas.th =0;
      
      
      let rg = this.t_saldo;
      let re = this.t_exis;
      let t1 =0;
      let t2 =0;
      let t3 =0;
      let t4 =0;

      rg.forEach(function(obj, index){
        //if(obj.s_debe !== '' || obj.s_debe !== null){
         t1 += Number(obj.s_debe);
        //}
      });
      rg.forEach(function(obj, index){
        //if(obj.s_haber !== '' || obj.s_haber !== null){
          t2 += Number(obj.s_haber);
         //}
     });

     re.forEach(function(obj, index){
      //if(obj.e_debe !== '' || obj.e_debe !== null){
        t3 += Number(obj.e_debe);
       //}
    });
    re.forEach(function(obj, index){
      //if(obj.e_haber !== '' || obj.e_haber !== null){
        t4 += Number(obj.e_haber);
       //}
    });
     var td1 = t1 + t3;
     var th1 = t2 + t4;
     console.log(t1)
    //  this.sumas.td = t1.toFixed(2);
    //  this.sumas.th = t2.toFixed(2);

     this.sumas.td = td1.toFixed(2);
     this.sumas.th = th1.toFixed(2);

    },

    abrirArqueo(){ //solo para acceder al modal para agregar todo pilas 
      this.update             = false;   
     $('#arqueo-caja').modal('show');
   }, //fin de metodo abrirtransaccion

    agregarsaldo(){
       
      if(this.saldo.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.saldo.s_debe.trim() !='' && this.saldo.s_haber.trim() !=''){
      toastr.error("No puede llenar ambos campos de debe y haber ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
        var saldo ={detalle:this.saldo.detalle, s_debe:this.saldo.s_debe, s_haber:this.saldo.s_haber}
        this.t_saldo.push(saldo);
        toastr.success("Saldo agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
       
      this.saldo.detalle =''
      this.saldo.s_debe  =''
      this.saldo.s_haber =''
      this.totales_s();// esta enobservacion la utilizacion de totales
      }

    },//fin metodo agregar saldo


         
    editSaldo(index){
      this.registro_id = index;
      this.saldo.edit= true;
      this.saldo.detalle   = this.t_saldo[index].detalle;
      this.saldo.s_debe    = this.t_saldo[index].s_debe;
      this.saldo.s_haber   = this.t_saldo[index].s_haber;
      $('#ht-dato-saldo-tab').tab('show');
     
    },//end edit saldos

     editSaldoFuera(index){
      this.registro_id = index;
      this.saldo.edit= true;
      this.saldo.detalle   = this.t_saldo[index].detalle;
      this.saldo.s_debe    = this.t_saldo[index].s_debe;
      this.saldo.s_haber   = this.t_saldo[index].s_haber;
      $('#arqueo-caja').modal('show'); 
      $('#ht-dato-saldo-tab').tab('show');    
     
    },//end edit saldos


    cancelarEditSaldo(){
      this.saldo.detalle =''
      this.saldo.s_debe  =''
      this.saldo.s_haber =''
      this.saldo.edit       =false;
     
    }, //fin de cancelar edicion


    actualizarSaldo (){
      if(this.saldo.detalle == ''){
        toastr.error("El campo Detalle es obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else {
        
        let index  = this.registro_id;
        
        this.t_saldo[index].detalle      =   this.saldo.detalle;
        this.t_saldo[index].s_debe       =   this.saldo.s_debe;
        this.t_saldo[index].s_haber      =   this.saldo.s_haber;
        this.cancelarEditSaldo();
        this.totales_s();
        toastr.error("Registro actualizado correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
      }
    }, //fin de function  actualizar 



    
    WarningEliminarSaldo(id){
      this.eliminar.index = id;
      this.eliminar.nombre = this.t_saldo[id].detalle;

      Swal.fire({
        title: 'Seguro que deseas eliminar este Registro '+this.eliminar.nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.eliminar.nombre,
            'success'
          );
          this.t_saldo.splice(id, 1);
          this.totales_s();
        }
      });
    }, //fin metodo warningeliminarcompra




    agregarExistencia(){
       
      if(this.exis.detalle.trim()=== ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

      }else if(this.exis.e_debe.trim() !='' && this.exis.e_haber.trim() !=''){
        toastr.error("No puede llenar ambos campos de debe y haber ", "Smarmoddle", {
          "timeOut": "3000"
      });
      } else{
        var exis ={detalle:this.exis.detalle, e_debe:this.exis.e_debe, e_haber:this.exis.e_haber}
        this.t_exis.push(exis);
        toastr.success("Existencias agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
       
      this.exis.detalle =''
      this.exis.e_debe  =''
      this.exis.e_haber =''
      this.totales_s();// esta enobservacion la utilizacion de totales
      }

    },//fin metodo agregar existencia

    
    editExis(index){
      this.exis.edit= true;
      this.registro_id = index;
      this.exis.detalle   = this.t_exis[index].detalle;
      this.exis.e_debe    = this.t_exis[index].e_debe;
      this.exis.e_haber   = this.t_exis[index].e_haber;
      $('#ht-dato-exis-tab').tab('show');
      
    },//end edit EXISTENCIAS
   
    editExisFuera(index){
      this.exis.edit= true;
      this.registro_id = index;
      this.exis.detalle   = this.t_exis[index].detalle;
      this.exis.e_debe    = this.t_exis[index].e_debe;
      this.exis.e_haber   = this.t_exis[index].e_haber;
      $('#arqueo-caja').modal('show');   
      $('#ht-dato-exis-tab').tab('show');
    },//end edit EXISTENCIAS
    
  
    cancelarEditExis(){
      this.exis.detalle =''
      this.exis.e_debe  =''
      this.exis.e_haber =''
      this.exis.edit       =false;
     
    }, //fin de cancelar edicion



   
    actualizarExis (){
      if(this.exis.detalle == ''){
        toastr.error("El campo Detalle es obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else {
        
        let index  = this.registro_id;
        this.t_exis[index].detalle      =   this.exis.detalle;
        this.t_exis[index].e_debe       =   this.exis.e_debe;
        this.t_exis[index].e_haber      =   this.exis.e_haber;
       
        this.cancelarEditExis();
        this.totales_s();
        toastr.error("Registro actualizado correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
      }
    }, //fin de function  actualizar 

    

    WarningEliminarExis(id){
      this.eliminar.index = id;
      this.eliminar.nombre = this.t_exis[id].detalle;

      Swal.fire({
        title: 'Seguro que deseas eliminar este Registro '+this.eliminar.nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.eliminar.nombre,
            'success'
          );
          this.t_exis.splice(id, 1);
          this.totales_s();
        }
      });
    }, //fin metodo warningeliminarcompra

   

   guardaArqueo: function(){

    if(this.t_saldo.length == 0){
      toastr.error("Debe haber al menos un Saldo Registrado", "Smarmoddle", {
        "timeOut": "3000"
    });
    }else if (this.t_exis.length == 0){
      toastr.error("Debe haber al menos una Existencia Registrado", "Smarmoddle", {
        "timeOut": "3000"
    });
    }else{

    var _this = this;
    var url ='/sistema/admin/taller/arqueo_caja';
      axios.post(url,{
             id:    _this.id_taller,
        t_saldo:    _this.t_saldo,
         t_exis:    _this.t_exis,
             td:    _this.sumas.td,
             th:    _this.sumas.th,
      }).then(response =>{
        if (response.data.estado == 'guardado') {
          toastr.success("Arqueo Caja creado correctamente", "Smarmoddle", {
          "timeOut": "3000"
        });
        this.totales_s();
      }else if (response.data.estado == 'actualizado') {
        toastr.warning("Arqueo Caja actualizado correctamente", "Smarmoddle", {
       "timeOut": "3000"
     });
     this.totales_s();
     }  
      }).catch(function(error){

      });
    }
   }, //fin metodo guardar
    
   ObtenerArqueo: function(){
    let _this = this;
    let  url = '/sistema/admin/taller/arqueo-obtener-caja';
   
    axios.post(url,{
      id: _this.id_taller,
    }).then(response =>{
      if(response.data.datos == true){
        toastr.info("Anexo Arqueo Caja cargado correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
          this.t_saldo = response.data.saldo;
          this.t_exis = response.data.exis;
          this.totales_s();
      }
    }).catch(function(error){

    });
   }  //fin function obtener
  
  },

});



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////LIBRO BANCO ANEXO /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
let librosbanco = new Vue({
  el: "#librosbanco",

  data:{
    id_taller: taller,
    nombre:'',
    n_banco:'',
    c_banco:'',

     lb_banco:[],
     eliminar:{
      index:'',
      nombre:''
    },
      banco:{
      edit:false,
      fecha:'',
      detalle:'',
      cheque:'',
      debe:'',
      haber:'',
      saldo:'',
    },
    suman:{ //suma total del libro CAJA
      debe:0,
      haber:0,
    },
    update: false,
    registro_id:'',
    dgeneral:[],
    registros_cierres:[],
    ajustes:[],
    nombre_cierre:''

  },
  mounted: function() {
    this.obtenerLibroBanco();
    this.obtenerDiarioGeneral();
  },

  methods:{
    obtenerDiarioGeneral: function(){
      var _this = this;
      var url = '/sistema/admin/taller/diariogeneral';
          axios.post(url,{
            id: _this.id_taller,
      }).then(response => {
        if (response.data.datos == true) {
        _this.dgeneral = response.data.registros;
        _this.nombre_dgral = response.data.nombre;
        let inicial = response.data.inicial;
          _this.dgeneral.unshift(inicial);
          }          
      }).catch(function(error){

      }); 
  },
      calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
  },
  formatoFecha(fecha){
    if (fecha !== null) {
       let date = fecha.split('-').reverse().join('-');
    return date;
  }else{
    return
  }
   
  },
        totales: function(){
          this.suman.debe  =0;
          this.suman.haber =0;
          let regis  = this.lb_banco;
          let total1 = 0;
          let total2 = 0;

          regis.forEach(function(obj, index){
            total1 += Number(obj.debe);
          });
          regis.forEach(function(obj, index){
          total2 += Number(obj.haber);
        });
        
        this.suman.debe  = total1.toFixed(2);
        this.suman.haber = total2.toFixed(2);
      },

      abrirLibroB(){ //solo para acceder al modal para agregar todo pilas 
        this.update             = false;   
       $('#libro-banco').modal('show');
     }, //fin de metodo abrirtransaccion

      agregarBanco(){
        if(this.banco.fecha.trim() === ''){
          toastr.error("La fecha es obligatoria ", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.banco.detalle.trim() === ''){
            toastr.error("El campo Detalle es Obligatorio", "Smartmoodle", {
              "timeOut": "3000"
            });
        }else if(this.banco.debe.trim() !='' && this.banco.haber.trim() !=''){
            toastr.error("No puede llenar ambos campos de debe y haber", "Smartmoodle",{
              "timeOut": "30000"
            });
        }else {

          var banco = {fecha:this.banco.fecha, detalle:this.banco.detalle,cheque:this.banco.cheque, debe:this.banco.debe, haber:this.banco.haber, saldo:this.banco.saldo  }
          this.lb_banco.push(banco);
          toastr.success("Registro agregado correctamente", "Smarmoddle", {
            "timeOut": "3000"
        });
        this.banco.fecha   =''
        this.banco.detalle =''
        this.banco.cheque  =''
        this.banco.debe    =''
        this.banco.haber   =''
        this.banco.saldo   =''
        this.totales(); 
        }

      },  // function agregarbanco end


      editLibroBanco(index){
        this.banco.edit =true;
        this.registro_id   = index;
        this.banco.fecha   = this.lb_banco[index].fecha;
        this.banco.detalle = this.lb_banco[index].detalle;
        this.banco.cheque  = this.lb_banco[index].cheque;
        this.banco.debe    = this.lb_banco[index].debe;
        this.banco.haber   = this.lb_banco[index].haber;
        this.banco.saldo   = this.lb_banco[index].saldo;
      }, //end edit

      editLibroBancoFuera(index){
        this.banco.edit =true;
        this.registro_id   = index;
        this.banco.fecha   = this.lb_banco[index].fecha;
        this.banco.detalle = this.lb_banco[index].detalle;
        this.banco.cheque  = this.lb_banco[index].cheque;
        this.banco.debe    = this.lb_banco[index].debe;
        this.banco.haber   = this.lb_banco[index].haber;
        this.banco.saldo   = this.lb_banco[index].saldo;
        $('#libro-banco').modal('show');
      }, //end edit
   
   
      cancelarEditlibroBanco(){

        this.banco.fecha   =''
        this.banco.detalle =''
        this.banco.cheque  =''
        this.banco.debe    =''
        this.banco.haber   =''
        this.banco.saldo   =''
        this.banco.edit       =false;
      },
    
  

    actualizarLibroBanco(){

      if(this.banco.fecha.trim() === ''){
        toastr.error("La fecha es obligatoria ", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else if(this.banco.detalle.trim() === ''){
          toastr.error("El campo Detalle es Obligatorio", "Smartmoodle", {
            "timeOut": "3000"
          });
    
        }else {
        let id                        = this.registro_id;
        this.lb_banco[id].fecha       = this.banco.fecha;
        this.lb_banco[id].detalle     = this.banco.detalle;
        this.lb_banco[id].cheque      = this.banco.cheque;
        this.lb_banco[id].debe        = this.banco.debe;
        this.lb_banco[id].haber       = this.banco.haber;
        this.lb_banco[id].saldo       = this.banco.saldo;

        this.cancelarEditlibroBanco();
        this.totales();
        toastr.error("Registro actualizado correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
      
       }
   
    },//fin de actualizar libro Banco

    eliminarLibro(){
      let id = this.eliminar.index;
      this.lb_banco.splice(id, 1);
      this.eliminar.index ='';
      this.eliminar.nombre ='';
      $('#eliminar-banco').modal('hide'); // en prueba para eliminar
    }, //fin metodo eliminar compra 

    deleteLibroBanco(index){
      this.lb_banco.splice(index, 1);
      this.totales();
    },//finde delete

    WarningEliminarLibro(id){
      this.eliminar.index = id;
      this.eliminar.nombre = this.lb_banco[id].detalle;

      Swal.fire({
        title: 'Seguro que deseas eliminar el Registro de '+this.eliminar.nombre ,
        text: "Esta accion no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El Registro de la cuenta '+this.eliminar.nombre,
            'success'
          );
          this.lb_banco.splice(id, 1);
          this.totales(); 
        }
      });
    }, //fin metodo warningeliminarcompra



     guardarlbBAnco(){
     
      if(this.nombre.length == 0){
        toastr.error("Debe Ingresar el Nombre del Comercial", "Smarmoddle", {
          "timeOut": "3000"
      });

      }else if(this.n_banco.length == 0){
        toastr.error("Debe Ingresar el Nombre del Banco", "Smarmoddle", {
          "timeOut": "3000"
      });

      }else if(this.c_banco.length == 0){
        toastr.error("Debe Ingresar la Cuenta del Banco", "Smarmoddle", {
          "timeOut": "3000"
      });

      }else if(this.lb_banco.length == 0){
        toastr.error("Debe haber al menos un Registro", "Smarmoddle", {
          "timeOut": "3000"
      });

      } else {
         
        let _this = this;
        let url='/sistema/admin/taller/libro_banco';
        axios.post(url,{
                id:  _this.id_taller,
          lb_banco:  _this.lb_banco,
            nombre:  _this.nombre,
           n_banco:  _this.n_banco,
           c_banco:  _this.c_banco,
              debe:  _this.suman.debe,
             haber:  _this.suman.haber,
        }).then(response=>{
          if (response.data.estado == 'guardado') {
            toastr.success("Arqueo Libro Banco creado correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
          conciliacionb.obtenerLibroBanco();
          }else if (response.data.estado == 'actualizado') {
           toastr.warning("Arqueo Libro Banco actualizado correctamente", "Smarmoddle", {
          "timeOut": "3000"
        });
        conciliacionb.obtenerLibroBanco();
        this.totales(); 
        }  

      }).catch(function(error){
      });
      }

     },// fin metodo guardar libro Banco 
     
     obtenerLibroBanco: function (){
       let _this = this;
       let   url = '/sistema/admin/taller/libro-obtener-banco';
       axios.post(url,{
         id: _this.id_taller,
       }).then(response=>{
        if(response.data.datos == true){
          toastr.info("Anexo Libro Banco cargado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
            this.lb_banco = response.data.mb;
            this.nombre = response.data.nombre;
            this.n_banco = response.data.n_banco;
            this.c_banco = response.data.c_banco;
            this.totales();
        }
      }).catch(function(error){

      });

     } //fin obtener libro banco
  
 }
});




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////CONCILIACION BANCARIA /////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const conciliacionb = new Vue({
   el: "#conciliacionb",
   data:{
    id_taller: taller,
     nombre:'',
     n_banco:'',
     fecha : '',
     lb_nombre:'',
    lb_n_banco:'',
    lb_c_banco:'',
    debe_lbanco:'',
    haber_lbanco:'',

     lb_banco:[],
     c_saldos:[],
     saldo:{
      edit:false,
       fecha:'',
      detalle:'',
      saldo:'',
     },
     c_debitos:[],
     debito:{
      edit:false,
       fecha:'',
       detalle:'',
       saldo:'',
     },
     c_creditos:[],
     credito:{
      edit:false,
      fecha:'',
       detalle:'',
       saldo:'',
     },
     c_cheques:[],
     cheques:{
      edit:false,
       fecha:'',
       detalle:'',
       saldo:'',
     },
     c_depositos:[],
     deposito:{
      edit:false,
       fecha:'',
       detalle:'',
       saldo:'',
     },

     suman:{
   
       saldo_c :0,
       saldo_ch:0,
       saldo_d :0,
       saldo_depositos:0,
       total   :0,

     },
     update:false,
     registro_id:'',


   },
   mounted: function() {
    this.obtenerConciliacionBancaria();
    this.obtenerLibroBanco();
  },
      methods:{
    calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
      obtenerLibroBanco: function (){
       let _this = this;
       let   url = '/sistema/admin/taller/libro-obtener-banco';
       axios.post(url,{
         id: _this.id_taller,
       }).then(response=>{
        if(response.data.datos == true){
            this.lb_banco = response.data.mb;
            this.lb_nombre = response.data.nombre;
            this.lb_n_banco = response.data.n_banco;
            this.lb_c_banco = response.data.c_banco;
            this.debe_lbanco = response.data.totaldebe;
            this.haber_lbanco = response.data.totalhaber;
            // this.totales();
        }
      }).catch(function(error){

      });

     },

    decimales(saldo){
      if (saldo !== null && saldo !== '' && saldo !== 0) {
         let total = Number(saldo).toFixed(2);
      return total;
    }else{
      return
    }
  }, //fin metodo decimal 
  formatoFecha(fecha){
    if (fecha !== null) {
       let date = fecha.split('-').reverse().join('-');
    return date;
  }else{
    return
  }
   
  },// fin fecha

  
    totales: function(){
      
       this.suman.saldo_c =0;
       this.suman.saldo_ch =0;
       this.suman.saldo_d =0;
       this.suman.saldo_depositos=0;
       this.suman.total =0;

       let r1 = this.c_saldos;
       let r2 = this.c_debitos;
       let r3 = this.c_creditos;
       let r4 = this.c_cheques;
       let r5 = this.c_depositos;
       
       let t1 =0;
       let t2 =0;
       let t3 =0;
       let t4 =0;
       let t5 =0;
     

       r1.forEach(function(obj, index){
          t1 +=Number(obj.saldo);
       });

       r2.forEach(function(obj, index){
        t2 +=Number(obj.saldo);
       });

      r3.forEach(function(obj, index){
       t3 +=Number(obj.saldo);
      });

      r4.forEach(function(obj, index){
        t4 +=Number(obj.saldo);
     });

      r5.forEach(function(obj, index){
      t5 +=Number(obj.saldo);
      });

      var tsd  = t1 + t2 + t5;
      var tsdc = tsd - t3;
      var tch  = tsdc - t4;
     
     
      this.suman.saldo_d   = t2.toFixed(2);
      this.suman.saldo_c   = t3.toFixed(2);
      this.suman.saldo_ch  = t4.toFixed(2);
      this.suman.saldo_depositos = t5.toFixed(2);
      this.suman.total     = tch.toFixed(2);
      
       
    }, //fin function totales


    abrirSaldos(){ //solo para acceder al modal para agregar todo pilas 
    this.limpiar(); 
     $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-saldo-tab').tab('show');
    
   }, //fin de metodo abrirtransaccion

   abrirDebito(){ //solo para acceder al modal para agregar todo pilas 
    this.limpiar(); 
     $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-debito-tab').tab('show');
    
   }, //fin de metodo abrirtransaccion

   abrirCredito(){ //solo para acceder al modal para agregar todo pilas 
    this.limpiar(); 
     $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-credito-tab').tab('show');
    
   }, //fin de metodo abrirtransaccion

   abrirCheques(){ //solo para acceder al modal para agregar todo pilas 
    this.limpiar(); 
     $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-cheque-tab').tab('show');
    
   }, //fin de metodo abrirtransaccion

   abrirDepositos(){ //solo para acceder al modal para agregar todo pilas 
    this.limpiar(); 
     $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-deposito-tab').tab('show');
    
   }, //fin de metodo abrirtransaccion


   agregarDeposito(){
       
    if(this.deposito.fecha.trim() === ''){
      toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });

  }else if(this.deposito.detalle.trim() === ''){
      toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });

  }else if(this.deposito.saldo.trim() ===''){
    toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
      "timeOut": "3000"
  });
  } else{
      var deposito ={fecha:this.deposito.fecha, detalle:this.deposito.detalle, saldo:this.deposito.saldo,}
      this.c_depositos.push(deposito);
      toastr.success("El Valor agregado correctamente", "Smarmoddle", {
        "timeOut": "3000"
    });
    this.deposito.fecha =''
    this.deposito.detalle =''
    this.deposito.saldo  =''
    this.totales();
    }

  },//fin metodo agregar deposito

  editDepositos(index){
    this.deposito.edit =true;
    this.registro_id  = index;
    this.deposito.fecha     = this.c_depositos[index].fecha;
    this.deposito.detalle   = this.c_depositos[index].detalle;
    this.deposito.saldo     = this.c_depositos[index].saldo;
    $('#nav-bih-conciliacion-deposito-tab').tab('show');
     
   
  },//end edit saldos

  editDepositoFuera(index){
     
    this.deposito.edit =true;
    this.registro_id  = index;
    this.deposito.fecha     = this.c_depositos[index].fecha;
    this.deposito.detalle   = this.c_depositos[index].detalle;
    this.deposito.saldo     = this.c_depositos[index].saldo;
    $('#conciliacion-bancaria').modal('show');  
    $('#nav-bih-conciliacion-deposito-tab').tab('show');

   }, //fin udpate saldo


   cancelarEditDeposito(){
    this.deposito.fecha     =''
    this.deposito.detalle   =''
    this.deposito.saldo     =''
    this.deposito.edit      =false;
   },

   EliminarDeposito(index){
    let nombre = this.c_depositos[index].detalle;
     Swal.fire({
       title: 'Seguro que deseas eliminar la cuenta '+nombre ,
       text: "Esta accion no se puede revertir",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Si, eliminar!'
         }).then((result) => {
       if (result.isConfirmed) {
         Swal.fire(
           'Eliminado!',
           'El Registro de la cuenta '+nombre,
           'success'
         );
         this.c_depositos.splice(index, 1);   
                         
         this.totales();    
       }
     });
   }, // fin eliminar deposito


   actualizarDeposito(){

    if(this.deposito.fecha.trim() === ''){
      toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });

  }else if(this.deposito.detalle.trim() === ''){
      toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
        "timeOut": "3000"
    });

  }else if(this.deposito.saldo.trim() ===''){
    toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
      "timeOut": "3000"
  });
  } else{
     let id                      = this.registro_id;
     this.c_depositos[id].fecha     = this.deposito.fecha;
     this.c_depositos[id].detalle   = this.deposito.detalle;
     this.c_depositos[id].saldo     = this.deposito.saldo;
   
     this.cancelarEditDeposito();
     this.totales();
     toastr.error("Registro actualizado correctamente", "Smarmoddle", {
      "timeOut": "3000"
      });
    }
   
  },//fin de actualizar saldo




    agregarSaldo(){
       
      if(this.saldo.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.saldo.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.saldo.saldo.trim() ===''){
      toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
        var saldo ={fecha:this.saldo.fecha, detalle:this.saldo.detalle, saldo:this.saldo.saldo,}
        this.c_saldos.push(saldo);
        toastr.success("El Valor agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
      this.saldo.fecha =''
      this.saldo.detalle =''
      this.saldo.saldo  =''
      this.totales();
      }

    },//fin metodo agregar saldo

    editSaldo(index){
      this.saldo.edit =true;
      this.registro_id  = index;
      this.saldo.fecha     = this.c_saldos[index].fecha;
      this.saldo.detalle   = this.c_saldos[index].detalle;
      this.saldo.saldo     = this.c_saldos[index].saldo;
      $('#nav-bih-conciliacion-saldo-tab').tab('show');
       
     
    },//end edit saldos

    editSaldoFuera(index){
     
      this.saldo.edit =true;
      this.registro_id  = index;
      this.saldo.fecha     = this.c_saldos[index].fecha;
      this.saldo.detalle   = this.c_saldos[index].detalle;
      this.saldo.saldo     = this.c_saldos[index].saldo;
      $('#conciliacion-bancaria').modal('show');  
      $('#nav-bih-conciliacion-saldo-tab').tab('show');  

     }, //fin udpate saldo


     cancelarEditSaldo(){
      this.saldo.fecha     =''
      this.saldo.detalle   =''
      this.saldo.saldo     =''
      this.saldo.edit      =false;
     },

     EliminarSaldo(index){
      let nombre = this.c_saldos[index].detalle;
       Swal.fire({
         title: 'Seguro que deseas eliminar la cuenta '+nombre ,
         text: "Esta accion no se puede revertir",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, eliminar!'
           }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'Eliminado!',
             'El Registro de la cuenta '+nombre,
             'success'
           );
           this.c_saldos.splice(index, 1);   
                           
           this.totales();    
         }
       });
     },

     actualizarSaldo(){

      if(this.saldo.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.saldo.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.saldo.saldo.trim() ===''){
      toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
       let id                      = this.registro_id;
       this.c_saldos[id].fecha     = this.saldo.fecha;
       this.c_saldos[id].detalle   = this.saldo.detalle;
       this.c_saldos[id].saldo     = this.saldo.saldo;
     
       this.cancelarEditSaldo();
       this.totales();
       toastr.error("Registro actualizado correctamente", "Smarmoddle", {
        "timeOut": "3000"
        });
      }
     
    },//fin de actualizar saldo





    agregarCreditos(){
       
      if(this.credito.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.credito.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.credito.saldo.trim() ===''){
      toastr.error("El Valor es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
        var credito ={fecha:this.credito.fecha, detalle:this.credito.detalle, saldo:this.credito.saldo,}
        this.c_creditos.push(credito);
        toastr.success("El Credito agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
      this.credito.fecha =''
      this.credito.detalle =''
      this.credito.saldo  =''
      this.totales();
      }

    },//fin metodo agregar saldo


    editCredito(index){
      this.credito.edit =true;
      this.registro_id  = index;
      this.credito.fecha     = this.c_creditos[index].fecha;
      this.credito.detalle   = this.c_creditos[index].detalle;
      this.credito.saldo     = this.c_creditos[index].saldo;
      
     $('#nav-bih-conciliacion-credito-tab').tab('show');
       
     
    },//end edit saldos

    editCreditoFuera(index){
     
      this.credito.edit =true;
      this.registro_id  = index;
      this.credito.fecha     = this.c_creditos[index].fecha;
      this.credito.detalle   = this.c_creditos[index].detalle;
      this.credito.saldo     = this.c_creditos[index].saldo;
     
      $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-credito-tab').tab('show');
     }, //fin udpate saldo


     cancelarEditCredito(){
      this.credito.fecha =''
      this.credito.detalle =''
      this.credito.saldo  =''
      this.credito.edit =false;
     },

     EliminarCredito(index){
      let nombre = this.c_creditos[index].detalle;
       Swal.fire({
         title: 'Seguro que deseas eliminar la cuenta '+nombre ,
         text: "Esta accion no se puede revertir",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, eliminar!'
           }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'Eliminado!',
             'El Registro de la cuenta '+nombre,
             'success'
           );
           this.c_creditos.splice(index, 1);   
                           
           this.totales();    
         }
       });
     },

     actualizarCredito(){

      if(this.credito.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.credito.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.credito.saldo.trim() ===''){
      toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
       let id                        = this.registro_id;
       this.c_creditos[id].fecha     = this.credito.fecha;
       this.c_creditos[id].detalle   = this.credito.detalle;
       this.c_creditos[id].saldo     = this.credito.saldo;
     
       this.cancelarEditCredito();
       this.totales();
       toastr.error("Registro actualizado correctamente", "Smarmoddle", {
        "timeOut": "3000"
        });
      }
     
    },//fin de actualizar credito





    agregarDebitos(){
       
      if(this.debito.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.debito.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.debito.saldo.trim() ===''){
      toastr.error("El Valor es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
        var debito ={fecha:this.debito.fecha, detalle:this.debito.detalle, saldo:this.debito.saldo,}
        this.c_debitos.push(debito);
        toastr.success("El Debito agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
      });
      this.debito.fecha =''
      this.debito.detalle =''
      this.debito.saldo  =''
      this.totales();
      }

    },//fin metodo agregar saldo


    editDebito(index){
      this.debito.edit      =true;
      this.registro_id      = index;
      this.debito.fecha     = this.c_debitos[index].fecha;
      this.debito.detalle   = this.c_debitos[index].detalle;
      this.debito.saldo     = this.c_debitos[index].saldo;
      $('#nav-bih-conciliacion-debito-tab').tab('show');   
       
     
    },//end edit saldos

    editDebitoFuera(index){
     
      this.debito.edit =true;
      this.registro_id  = index;
      this.debito.fecha     = this.c_debitos[index].fecha;
      this.debito.detalle   = this.c_debitos[index].detalle;
      this.debito.saldo     = this.c_debitos[index].saldo;
     
      $('#conciliacion-bancaria').modal('show');
      $('#nav-bih-conciliacion-debito-tab').tab('show');   

     }, //fin udpate saldo


     cancelarEditDebito(){
      this.debito.fecha =''
      this.debito.detalle =''
      this.debito.saldo  =''
      this.debito.edit =false;
     },

     EliminarDebito(index){
      let nombre = this.c_debitos[index].detalle;
       Swal.fire({
         title: 'Seguro que deseas eliminar la cuenta '+nombre ,
         text: "Esta accion no se puede revertir",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, eliminar!'
           }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'Eliminado!',
             'El Registro de la cuenta '+nombre,
             'success'
           );
           this.c_debitos.splice(index, 1);   
                           
           this.totales();    
         }
       });
     },

     actualizarDebito(){

      if(this.debito.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.debito.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.debito.saldo.trim() ===''){
      toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
       let id                        = this.registro_id;
       this.c_debitos[id].fecha     = this.debito.fecha;
       this.c_debitos[id].detalle   = this.debito.detalle;
       this.c_debitos[id].saldo     = this.debito.saldo;
     
       this.cancelarEditDebito();
       this.totales();
       toastr.error("Registro actualizado correctamente", "Smarmoddle", {
        "timeOut": "3000"
        });
      }
     
    },//fin de actualizar debito




    agregarCheques(){
          
        if(this.cheques.fecha.trim() === ''){
          toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });

       }else if(this.cheques.detalle.trim() === ''){
            toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
              "timeOut": "3000"
          });

        }else if(this.cheques.saldo.trim() ===''){
          toastr.error("El Valor es Obligatorio ", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else{
            var cheques ={fecha:this.cheques.fecha,detalle:this.cheques.detalle, saldo:this.cheques.saldo,}
            this.c_cheques.push(cheques);
            toastr.success("El Cheque agregado correctamente", "Smarmoddle", {
              "timeOut": "3000"
          });

          this.cheques.fecha =''
          this.cheques.detalle =''
          this.cheques.saldo  =''
          this.totales();
          }

     },//fin metodo agregar cheque


     editCheque(index){
      this.cheques.edit      =true;
      this.registro_id      = index;
      this.cheques.fecha     = this.c_cheques[index].fecha;
      this.cheques.detalle   = this.c_cheques[index].detalle;
      this.cheques.saldo     = this.c_cheques[index].saldo;
     
      $('#nav-bih-conciliacion-cheque-tab').tab('show');
     
    },//end edit saldos

    editChequeFuera(index){
     
      this.cheques.edit =true;
      this.registro_id  = index;
      this.cheques.fecha     = this.c_cheques[index].fecha;
      this.cheques.detalle   = this.c_cheques[index].detalle;
      this.cheques.saldo     = this.c_cheques[index].saldo;
     
      $('#conciliacion-bancaria').modal('show');
     $('#nav-bih-conciliacion-cheque-tab').tab('show');
     }, //fin udpate saldo


     cancelarEditCheque(){
      this.cheques.fecha =''
      this.cheques.detalle =''
      this.cheques.saldo  =''
      this.cheques.edit =false;
     },

     EliminarCheque(index){
      let nombre = this.c_cheques[index].detalle;
       Swal.fire({
         title: 'Seguro que deseas eliminar la cuenta '+nombre ,
         text: "Esta accion no se puede revertir",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, eliminar!'
           }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'Eliminado!',
             'El Registro de la cuenta '+nombre,
             'success'
           );
           this.c_cheques.splice(index, 1);   
                           
           this.totales();    
         }
       });
     },

     actualizarCheque(){

      if(this.cheques.fecha.trim() === ''){
        toastr.error("La Fecha es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.cheques.detalle.trim() === ''){
        toastr.error("El Detalle es Obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });

    }else if(this.cheques.saldo.trim() ===''){
      toastr.error("El Saldo es Obligatorio ", "Smarmoddle", {
        "timeOut": "3000"
    });
    } else{
       let id                        = this.registro_id;
       this.c_cheques[id].fecha     = this.cheques.fecha;
       this.c_cheques[id].detalle   = this.cheques.detalle;
       this.c_cheques[id].saldo     = this.cheques.saldo;
     
       this.cancelarEditCheque()
       this.totales();
      
       toastr.error("Registro actualizado correctamente", "Smarmoddle", {
        "timeOut": "3000"
        });
      }
     
    },//fin de actualizar debito


    
 
      limpiar(){
        this.saldo.fecha       ='';     
        this.saldo.detalle     ='';
        this.saldo.saldo       ='';
        this.debito.fecha      ='';
        this.debito.detalle    ='';
        this.debito.saldo      ='';
        this.credito.fecha     ='';
        this.credito.detalle   ='';
        this.credito.saldo     ='';
        this.cheques.detalle   ='';
        this.cheques.saldo     ='';
        this.cheques.fecha     ='';
        this.deposito.detalle  ='';
        this.deposito.saldo    ='';
        this.deposito.fecha    ='';
  
      },//fin metodo limpiar todos los campos

       
       guardarConciliacionB(){

       
        if(this.nombre.length == 0){
          toastr.error("Debe Registrar el Nombre del Comercial", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.fecha.length == 0){
          toastr.error("Debe Ingresar la Fecha", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.n_banco.length == 0){
          toastr.error("Debe Ingresar el Nombre del Banco", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.c_saldos.length == 0){
          toastr.error("Debe haber al menos un Saldo Registrado", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if (this.c_debitos.length == 0){
          toastr.error("Debe haber al menos un Débito Registrado", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if (this.c_depositos.length == 0){
          toastr.error("Debe haber al menos un Depósito Registrado", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if (this.c_creditos.length == 0){
          toastr.error("Debe haber al menos un Crédito Registrado", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if (this.c_cheques.length == 0){
          toastr.error("Debe haber al menos un Cheque Registrado", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
          let _this = this;
          let url= '/sistema/admin/taller/conciliacion_bancaria';
          axios.post(url,{
                 id:  _this.id_taller,
             nombre:  _this.nombre,
            n_banco:  _this.n_banco,
              fecha:  _this.fecha,
            saldo_c:  _this.suman.saldo_c,
    saldo_depositos:  _this.suman.saldo_depositos,
            saldo_d:  _this.suman.saldo_d,
           saldo_ch:  _this.suman.saldo_ch,
              total:  _this.suman.total,
           c_saldos:  _this.c_saldos,
          c_debitos:  _this.c_debitos,
         c_creditos:  _this.c_creditos,
          c_cheques:  _this.c_cheques,
        c_depositos:  _this.c_depositos,
          
          }).then(response=>{
            if (response.data.estado == 'guardado') {
              toastr.success("Conciliación Bancaria creada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
            }else if (response.data.estado == 'actualizado') {
             toastr.warning("Conciliación Bancaria actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
          this.totales(); 
          }  
  
        }).catch(function(error){
        });
        
        }//end else
       },//fin guardado conciliacion
      
       obtenerConciliacionBancaria : function(){
         let _this = this;
         let   url = '/sistema/admin/taller/conciliacion-obtener-bancaria';
         axios.post(url,{
          id: _this.id_taller,
        }).then(response=>{
          if(response.data.datos == true){
            toastr.info("Anexo Conciliación Bancaria cargado correctamente", "Smarmoddle", {
              "timeOut": "3000"
              });
              this.c_saldos   = response.data.saldo;
              this.c_debitos  = response.data.debito;
              this.c_depositos  = response.data.deposito;
              this.c_creditos = response.data.credito;
              this.c_cheques  = response.data.cheque;
              this.nombre     = response.data.nombre;
              this.n_banco    = response.data.n_banco;
              this.fecha      = response.data.fecha;
              this.totales();
          }
        }).catch(function(error){
  
        });
  

       }//fin metodo obtener conciliacion bancaria

    },


});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////RETENCION DEL IVA /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
let reten_iva = new Vue({
    el:"#retencion_iva",
  data:{
    id_taller: taller,
    nombre_c:'', 
    fecha:'',
    contribuyente:'',
    ruc:'',
    dgeneral:[],
    eliminar:{
      index:'',
      nombre:''
    },
    t_ventas:[],
    t_compras:[],
      compra:{
        edit:false,
        fecha_c:'',
        detalle:'',
        proveedor:'',
        base_im:'',
        porcentaje:'',
        v_retenido:'',
        iva:'',
        ret_10:'',
        ret_20:'',
        ret_30:'',
        ret_70:'',
        ret_100:'',
      },
      suma_c:{
          suma_base:0,
          suma_reten:0,
          suma_ivac:0,
          suma_10:0,
          suma_20:0,
          suma_30:0,
          suma_70:0,
          suma_100:0,
      },
    
      venta:{
        edit:false,
        fecha_v:'',
        detalle:'',
        cliente:'',
        base_im:'',
        porcentaje:'',
        v_retenido:'',
        iva:'',
        ret_10:'',
        ret_20:'',
        ret_30:'',
        ret_70:'',
        ret_100:'',
      },
      suma_v:{
          suma_base:0,
          suma_reten:0,
          suma_ivav:0,
          suma_10:0,
          suma_20:0,
          suma_30:0,
          suma_70:0,
          suma_100:0,
      },
      total:{
        t_ivacompra:'',
        t_ivaventa:'',
        total_pagar:'',
        result_iva:'',
        t_reten:'',
        
      }, 
      update:false,
      registro_id:'',

  }, //fin del data
  mounted: function() {
    this.obtenerDiarioGeneral();
    this.obtenerRetencionIva();
    },
    
      methods:{
          calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
        obtenerDiarioGeneral: function(){
          var _this = this;
          var url = '/sistema/admin/taller/diariogeneral';
              axios.post(url,{
                id: _this.id_taller,
          }).then(response => {
            if (response.data.datos == true) {
            _this.dgeneral = response.data.registros;
            _this.ajustes = response.data.ajustes;
            _this.nombre_dgral = response.data.nombre;
            let inicial = response.data.inicial;
              _this.dgeneral.unshift(inicial);
              }          
          }).catch(function(error){
  
          }); 
      }, //fin metodo obtener diario general 

        formatoFecha(fecha){
          if (fecha !== null ) {
             let date = fecha.split('-').reverse().join('-');
          return date;
        }else{
          return
        }
         
        }, //fin metodo formatofecha

        decimales(saldo){
          if (saldo !== null && saldo !== '' && saldo !== 0) {
             let total = Number(saldo).toFixed(2);
          return total;
        }else{
          return
        }
         
        }, //fin metodo decimales

        Totales(){
         let r1 =this.t_compras;
         let r2 = this.t_ventas;
         
         let c1 = 0;
         let c2 = 0;
         let c3 = 0;
         let c4 = 0;
         let c5 = 0;
         let c6 = 0;
         let c7 = 0;
         let c8 = 0;
       
         let v1 = 0;
         let v2 = 0;
         let v3 = 0;
         let v4 = 0;
         let v5 = 0;
         let v6 = 0;
         let v7 = 0
         let v8 = 0;

         //suma compras
 
         r1.forEach(function(r1,i){
          let temp = r1.base_im;
          if(temp != null && temp !==''){
            c1 += Number(temp);
          }
         });
         this.suma_c.suma_base = c1.toFixed(2);
        
         r1.forEach(function(r1,i){
          let temp = r1.v_retenido;
          if(temp != null && temp !==''){
            c2 += Number(temp);
          }
         });
         this.suma_c.suma_reten = c2.toFixed(2);
        
         r1.forEach(function(r1,i){
          let temp = r1.iva;
          if(temp != null && temp !==''){
            c3 += Number(temp);
          }
         });
         this.suma_c.suma_ivac = c3.toFixed(2);

         r1.forEach(function(r1,i){
          let temp = r1.ret_10;
          if(temp != null && temp !==''){
            c4 += Number(temp);
          }
         });
         this.suma_c.suma_10 = c4.toFixed(2);

         r1.forEach(function(r1,i){
          let temp = r1.ret_20;
          if(temp != null && temp !==''){
            c5 += Number(temp);
          }
         });
         this.suma_c.suma_20 = c5.toFixed(2);

         r1.forEach(function(r1,i){
          let temp = r1.ret_30;
          if(temp != null && temp !==''){
            c6 += Number(temp);
          }
         });
         this.suma_c.suma_30 = c6.toFixed(2);

         r1.forEach(function(r1,i){
          let temp = r1.ret_70;
          if(temp != null && temp !==''){
            c7 += Number(temp);
          }
         });
         this.suma_c.suma_70 = c7.toFixed(2);

         r1.forEach(function(r1,i){
          let temp = r1.ret_100;
          if(temp != null && temp !==''){
            c8 += Number(temp);
          }
         });
         this.suma_c.suma_100 = c8.toFixed(2);
         //
         //sumas ventas
         //

         r2.forEach(function(r2,i){
          let temp = r2.base_im;
          if(temp != null && temp !==''){
            v1 += Number(temp);
          }
         });
         this.suma_v.suma_base = v1.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.v_retenido;
          if(temp != null && temp !==''){
            v2 += Number(temp);
          }
         });
         this.suma_v.suma_reten = v2.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.iva;
          if(temp != null && temp !==''){
            v3 += Number(temp);
          }
         });
         this.suma_v.suma_ivav = v3.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.ret_10;
          if(temp != null && temp !==''){
            v4 += Number(temp);
          }
         });
         this.suma_v.suma_10 = v4.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.ret_20;
          if(temp != null && temp !==''){
            v5 += Number(temp);
          }
         });
         this.suma_v.suma_20 = v5.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.ret_30;
          if(temp != null && temp !==''){
            v6 += Number(temp);
          }
         });
         this.suma_v.suma_30 = v6.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.ret_70;
          if(temp != null && temp !==''){
            v7 += Number(temp);
          }
         });
         this.suma_v.suma_70 = v7.toFixed(2);

         r2.forEach(function(r2,i){
          let temp = r2.ret_100;
          if(temp != null && temp !==''){
            v8 += Number(temp);
          }
         });
         this.suma_v.suma_100 = v8.toFixed(2);
        
        }, //fin de sumatotales

        abrirCompra(){ //solo para acceder al modal para agregar todo pilas 
         
         $('#modal-retencion').modal('show');
         $('#ht-retencion-compra-tab').tab('show');

       }, //fin de metodo abrirtransaccion
       abrirVenta(){ //solo para acceder al modal para agregar todo pilas 
         
        $('#modal-retencion').modal('show');
        $('#ht-retencion-venta-tab').tab('show');

      }, //fin de metodo abrirtransaccion


       agregarCompra(){
        
        if(this.compra.fecha_c == ''){
          toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.compra.detalle == ''){
          toastr.error("El campo de Compra de Bienes y Servicios es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else {
           let compra = {fecha_c:this.compra.fecha_c, detalle:this.compra.detalle, proveedor:this.compra.proveedor, base_im:this.compra.base_im, porcentaje:this.compra.porcentaje, v_retenido:this.compra.v_retenido, iva:this.compra.iva, ret_10:this.compra.ret_10,ret_20:this.compra.ret_20,ret_30:this.compra.ret_30,ret_70:this.compra.ret_70,ret_100:this.compra.ret_100,}
           this.t_compras.push(compra);
           toastr.success("Registro agregado correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
           this.compra.fecha_c    ='';
           this.compra.detalle    ='';
           this.compra.proveedor  ='';
           this.compra.base_im    ='';
           this.compra.porcentaje ='';
           this.compra.v_retenido ='';
           this.compra.iva        ='';
           this.compra.ret_10     ='';
           this.compra.ret_20     ='';
           this.compra.ret_30     ='';
           this.compra.ret_70     ='';
           this.compra.ret_100    ='';
           this.Totales()
        }
        
       }, //fin de agregarCompra

       editCompra(index){
        this.compra.edit =true;
        this.registro_id = index;
        this.compra.fecha_c       = this.t_compras[index].fecha_c;
        this.compra.detalle       = this.t_compras[index].detalle;
        this.compra.proveedor     = this.t_compras[index].proveedor;
        this.compra.base_im       = this.t_compras[index].base_im;
        this.compra.porcentaje    = this.t_compras[index].porcentaje;
        this.compra.v_retenido    = this.t_compras[index].v_retenido;
        this.compra.iva           = this.t_compras[index].iva;
        this.compra.ret_10        = this.t_compras[index].ret_10;
        this.compra.ret_20        = this.t_compras[index].ret_20;
        this.compra.ret_30        = this.t_compras[index].ret_30;
        this.compra.ret_70        = this.t_compras[index].ret_70;
        this.compra.ret_100       = this.t_compras[index].ret_100;
    
        $('#ht-retencion-compra-tab').tab('show');
       }, //fin de edit modal

       editCompraFuera(index){
        this.compra.edit =true;
        this.registro_id = index;
        this.compra.fecha_c       = this.t_compras[index].fecha_c;
        this.compra.detalle       = this.t_compras[index].detalle;
        this.compra.proveedor     = this.t_compras[index].proveedor;
        this.compra.base_im       = this.t_compras[index].base_im;
        this.compra.porcentaje    = this.t_compras[index].porcentaje;
        this.compra.v_retenido    = this.t_compras[index].v_retenido;
        this.compra.iva           = this.t_compras[index].iva;
        this.compra.ret_10        = this.t_compras[index].ret_10;
        this.compra.ret_20        = this.t_compras[index].ret_20;
        this.compra.ret_30        = this.t_compras[index].ret_30;
        this.compra.ret_70        = this.t_compras[index].ret_70;
        this.compra.ret_100       = this.t_compras[index].ret_100;
      
        $('#modal-retencion').modal('show');
        $('#ht-retencion-compra-tab').tab('show');
       }, //fin de edit modal

       cancelarEditCompra(){
        this.compra.fecha_c    ='';
        this.compra.detalle    ='';
        this.compra.proveedor  ='';
        this.compra.base_im    ='';
        this.compra.porcentaje ='';
        this.compra.v_retenido ='';
        this.compra.iva        ='';
        this.compra.ret_10     ='';
        this.compra.ret_20     ='';
        this.compra.ret_30     ='';
        this.compra.ret_70     ='';
        this.compra.ret_100    ='';
        this.compra.edit       =false;
       
      }, //fin de cancelar edicion

      actualizarCompra (){

        if(this.compra.fecha_c == ''){
          toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.compra.detalle == ''){
          toastr.error("El campo de Compra de Bienes y Servicios es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else {
          
          let index  = this.registro_id;
          
          this.t_compras[index].fecha_c    =   this.compra.fecha_c;
          this.t_compras[index].detalle    =   this.compra.detalle;
          this.t_compras[index].proveedor  =   this.compra.proveedor;
          this.t_compras[index].base_im    =   this.compra.base_im;
          this.t_compras[index].porcentaje =   this.compra.porcentaje;
          this.t_compras[index].v_retenido =   this.compra.v_retenido;
          this.t_compras[index].iva        =   this.compra.iva ;
          this.t_compras[index].ret_10     =   this.compra.ret_10 ; 
          this.t_compras[index].ret_20     =   this.compra.ret_20;
          this.t_compras[index].ret_30     =   this.compra.ret_30 ;
          this.t_compras[index].ret_70     =   this.compra.ret_70;
          this.t_compras[index].ret_100    =   this.compra.ret_100 ;
          this.cancelarEditCompra();
          this.Totales();
          toastr.error("Registro actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
        }
      }, //fin de function  actualizar 
   
  
      WarningEliminarCompra(id){
        this.eliminar.index = id;
        this.eliminar.nombre = this.t_compras[id].detalle;

        Swal.fire({
          title: 'Seguro que deseas eliminar este Registro '+this.eliminar.nombre ,
          text: "Esta accion no se puede revertir",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Eliminado!',
              'El Registro de la cuenta '+this.eliminar.nombre,
              'success'
            );
            this.t_compras.splice(id, 1);
            this.Totales();
          }
        });
      }, //fin metodo warningeliminarcompra


      agregarVenta(){
        
        if(this.venta.fecha_v == ''){
          toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.venta.detalle == ''){
          toastr.error("El campo de Venta de Bienes y Servicios es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else {
           let venta = {fecha_v:this.venta.fecha_v, detalle:this.venta.detalle, cliente:this.venta.cliente, base_im:this.venta.base_im, porcentaje:this.venta.porcentaje, v_retenido:this.venta.v_retenido, iva:this.venta.iva, ret_10:this.venta.ret_10,ret_20:this.venta.ret_20,ret_30:this.venta.ret_30,ret_70:this.venta.ret_70,ret_100:this.venta.ret_100,}
           this.t_ventas.push(venta);
           toastr.success("Registro agregado correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
           this.venta.fecha_v    ='';
           this.venta.detalle    ='';
           this.venta.cliente  ='';
           this.venta.base_im    ='';
           this.venta.porcentaje ='';
           this.venta.v_retenido ='';
           this.venta.iva        ='';
           this.venta.ret_10     ='';
           this.venta.ret_20     ='';
           this.venta.ret_30     ='';
           this.venta.ret_70     ='';
           this.venta.ret_100    ='';
           this.Totales()
        }
        
       }, //fin de agregarVenta

       editVenta(index){
        this.venta.edit =true;
        this.registro_id = index;
        this.venta.fecha_v       = this.t_ventas[index].fecha_v;
        this.venta.detalle       = this.t_ventas[index].detalle;
        this.venta.cliente       = this.t_ventas[index].cliente;
        this.venta.base_im       = this.t_ventas[index].base_im;
        this.venta.porcentaje    = this.t_ventas[index].porcentaje;
        this.venta.v_retenido    = this.t_ventas[index].v_retenido;
        this.venta.iva           = this.t_ventas[index].iva;
        this.venta.ret_10        = this.t_ventas[index].ret_10;
        this.venta.ret_20        = this.t_ventas[index].ret_20;
        this.venta.ret_30        = this.t_ventas[index].ret_30;
        this.venta.ret_70        = this.t_ventas[index].ret_70;
        this.venta.ret_100       = this.t_ventas[index].ret_100;
      
        $('#ht-retencion-venta-tab').tab('show');
       }, //fin de edit modal


       editVentaFuera(index){
        this.venta.edit =true;
        this.registro_id = index;
        this.venta.fecha_v       = this.t_ventas[index].fecha_v;
        this.venta.detalle       = this.t_ventas[index].detalle;
        this.venta.cliente       = this.t_ventas[index].cliente;
        this.venta.base_im       = this.t_ventas[index].base_im;
        this.venta.porcentaje    = this.t_ventas[index].porcentaje;
        this.venta.v_retenido    = this.t_ventas[index].v_retenido;
        this.venta.iva           = this.t_ventas[index].iva;
        this.venta.ret_10        = this.t_ventas[index].ret_10;
        this.venta.ret_20        = this.t_ventas[index].ret_20;
        this.venta.ret_30        = this.t_ventas[index].ret_30;
        this.venta.ret_70        = this.t_ventas[index].ret_70;
        this.venta.ret_100       = this.t_ventas[index].ret_100;
        
        $('#modal-retencion').modal('show');
        $('#ht-retencion-venta-tab').tab('show');
       }, //fin de edit modal venta

       cancelarEditVenta(){
        this.venta.fecha_v    ='';
        this.venta.detalle    ='';
        this.venta.cliente    ='';
        this.venta.base_im    ='';
        this.venta.porcentaje ='';
        this.venta.v_retenido ='';
        this.venta.iva        ='';
        this.venta.ret_10     ='';
        this.venta.ret_20     ='';
        this.venta.ret_30     ='';
        this.venta.ret_70     ='';
        this.venta.ret_100    ='';
        this.venta.edit       =false;
       
      }, //fin de cancelar edicion venta

      actualizarVenta (){

        if(this.venta.fecha_v == ''){
          toastr.error("El campo Fecha es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.venta.detalle == ''){
          toastr.error("El campo de Venta de Bienes y Servicios es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        } else {
          
          let index  = this.registro_id;
          
          this.t_ventas[index].fecha_v    =   this.venta.fecha_v;
          this.t_ventas[index].detalle    =   this.venta.detalle;
          this.t_ventas[index].cliente    =   this.venta.cliente;
          this.t_ventas[index].base_im    =   this.venta.base_im;
          this.t_ventas[index].porcentaje =   this.venta.porcentaje;
          this.t_ventas[index].v_retenido =   this.venta.v_retenido;
          this.t_ventas[index].iva        =   this.venta.iva ;
          this.t_ventas[index].ret_10     =   this.venta.ret_10 ; 
          this.t_ventas[index].ret_20     =   this.venta.ret_20;
          this.t_ventas[index].ret_30     =   this.venta.ret_30 ;
          this.t_ventas[index].ret_70     =   this.venta.ret_70;
          this.t_ventas[index].ret_100    =   this.venta.ret_100 ;
          this.cancelarEditVenta();
          this.Totales();
          toastr.error("Registro actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
        }
      }, //fin de function  actualizar 

      


       WarningEliminarVenta(id){
        this.eliminar.index = id;
        this.eliminar.nombre = this.t_ventas[id].detalle;

        Swal.fire({
          title: 'Seguro que deseas eliminar este Registro '+this.eliminar.nombre ,
          text: "Esta accion no se puede revertir",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Eliminado!',
              'El Registro de la cuenta '+this.eliminar.nombre,
              'success'
            );
            this.t_ventas.splice(id, 1);
            this.Totales();
          }
        });
      }, //fin metodo warningeliminarcompra

       guardaretencioniva(){
              if(this.nombre_c.length == 0){
                toastr.error("Debe Registrar el Nombre del Comercial", "Smarmoddle", {
                  "timeOut": "3000"
              });
            }else if(this.fecha.length == 0){
              toastr.error("Debe Ingresar la Fecha", "Smarmoddle", {
                "timeOut": "3000"
            });
            }else if(this.contribuyente.length == 0){
              toastr.error("Debe Ingresar El Contribuyente", "Smarmoddle", {
                "timeOut": "3000"
            });
            }else if(this.ruc.length == 0){
              toastr.error("Debe Ingresar el Ruc ", "Smarmoddle", {
                "timeOut": "3000"
            });
           
            }else {

            let _this = this;
            let url   = '/sistema/admin/taller/retencion_iva';
            axios.post(url,{
                     id:  _this.id_taller,
               nombre_c:  _this.nombre_c,
          contribuyente:  _this.contribuyente,
                  fecha:  _this.fecha,
                    ruc:  _this.ruc,   
             sumac_base:  _this.suma_c.suma_base,
            sumac_reten:  _this.suma_c.suma_reten,
             sumac_ivac:  _this.suma_c.suma_ivac,
               sumac_10:  _this.suma_c.suma_10,
               sumac_20:  _this.suma_c.suma_20,
               sumac_30:  _this.suma_c.suma_30,
               sumac_70:  _this.suma_c.suma_70,
              sumac_100:  _this.suma_c.suma_100,
             sumav_base:  _this.suma_v.suma_base,
            sumav_reten:  _this.suma_v.suma_reten,
             sumav_ivav:  _this.suma_v.suma_ivav,
               sumav_10:  _this.suma_v.suma_10,
               sumav_20:  _this.suma_v.suma_20,
               sumav_30:  _this.suma_v.suma_30, 
               sumav_70:  _this.suma_v.suma_70,
              sumav_100:  _this.suma_v.suma_100,
            t_ivacompra:  _this.total.t_ivacompra,
             t_ivaventa:  _this.total.t_ivaventa,
                  total:  _this.total.total_pagar,
                t_reten:  _this.total.t_reten,
             result_iva:  _this.total.result_iva,
               t_compras:  _this.t_compras,
               t_ventas:  _this.t_ventas,

          }).then(response=>{
            if (response.data.estado == 'guardado') {
              toastr.success("Retención del Iva creada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
            }else if (response.data.estado == 'actualizado') {
            toastr.warning("Retención del Iva actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
          this.Totales()
          }  

            }).catch(function(error){
          });
        } //else fin
      }, //fin metodo guardar
        
      obtenerRetencionIva: function(){
        let _this = this;
        let url   = '/sistema/admin/taller/retencion-obtener-iva';
        axios.post(url,{
          id: _this.id_taller,  
        }).then(response=>{
           if(response.data.datos == true){
            toastr.info("Anexo Retencion del Iva cargado correctamente", "Smarmoddle", {
              "timeOut": "3000"
              });
              this.t_compras    = response.data.compra;
              this.t_ventas     = response.data.venta;
              this.nombre_c     = response.data.nombre;
              this.ruc          = response.data.ruc;
              this.contribuyente= response.data.contribuyente;
              this.fecha        = response.data.fecha;
              this.total.t_ivacompra  = response.data.t_ivacompra;
              this.total.t_ivaventa   = response.data.t_ivaventa;
              this.total.t_reten      = response.data.t_reten;
              this.total.result_iva   = response.data.result_iva;
              this.total.total_pagar        = response.data.total;
              this.Totales();
           }

        }).catch(function(error){
          });
        
      }, //fin metodo obtener retencion del iva





}, //fin de methods
     
     

});




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////NOMINA DE EMPLEADOS ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const nomina_em = new Vue({
 el: '#nomina_empleado',
 data:{
  id_taller: taller,
  fecha:'',
  nombre:'',
  t_nomina:[],
    nomina:{
      edit: false,
      nombre_e:'',
      cargo:'',
      sueldo:'',
      s_tiempo:'',
      ingresos:'',
      iees:'',
      pres_iees:'',
      pres_cia:'',
      anticipo:'',
      imp_renta:'',
      egresos:'',
      neto_pagar:'',  
    },
    eliminar:{
      index:'',
      nombre:''
    },
    sobretiempo:{
      sueldo:'',
      hora_trabajo:'',
      total_suple:'',
      total_extra:'',
      suma_suple:'',
      suma_extra:'',

      total:''
    },
    calculo:{

      valor:'',
      tiempo:'',
      interes:'',
      total :'',
    },
    calculo1:{

      valor:'',
      mes:'',
      interes:'',
      total :'',
    },
    suma:{
     
      s_sueldo:0,
      s_sobretiempo:0,
      s_tingreso:0,
      s_iess:0,
      s_piess:0,
      s_pcias:0,
      s_anticipo:0,
      s_impr:0,
      s_tegresos:0,
      s_netopagar:0,
    },
    deduccion:{
      valor:'',
      descripcion:''
    },
    deducciones:[],
    impuesto:{
      iva:'',
      fraccion_excedente_iva:'',
      ingreso_gravable:'',
      iies:'',
      ingreso_liquido:'',
      sueldo:'',
      comisiones:'',
      fraccion:'',
      fraccion_excedente:'',
      impuesto_fraccion:'',
      ingreso_mensual:'',
      base_imponible:'',
      ingreso_anual:'',
      interes:'',
      total:'',
      total_impuesto:''
    },

    update: false,
    registro_id:'',

 }, //end data
 mounted: function() {
   this.obtenerNomina();

  },

methods:{
  calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
  calculoHora(){
    if (this.sobretiempo.sueldo == '') {
        toastr.error("No ha agregado el sueldo", "Smarmoddle", {
          "timeOut": "3000"
        });
      }else{
        let hora_trabajo = Number(this.sobretiempo.sueldo) / 30 / 8;
        this.sobretiempo.hora_trabajo = Number(hora_trabajo).toFixed(2);
      }
  },
  calculoSobre(){
      let suplementaria           = Number(this.sobretiempo.total_suple) * Number(this.sobretiempo.hora_trabajo) * 1.5;
      let extraordinaria          = Number(this.sobretiempo.total_extra) * Number(this.sobretiempo.hora_trabajo) * 2;
      this.sobretiempo.suma_suple = Number(suplementaria).toFixed(2);
      this.sobretiempo.suma_extra = Number(extraordinaria).toFixed(2);
      this.sobretiempo.total      = Number(suplementaria + extraordinaria).toFixed(2);
  },
  limpiarSobre(){
    this.sobretiempo.sueldo       = '';
    this.sobretiempo.hora_trabajo = '';
    this.sobretiempo.total_suple  = '';
    this.sobretiempo.total_extra  = '';
    this.sobretiempo.suma_suple   = '';
    this.sobretiempo.suma_extra   = '';
    this.sobretiempo.total        = '';
  },
          impuestoAgregado(tipo){
            if (tipo == 'ingresos') {
              let sueldo = Number(this.impuesto.sueldo);
              let comision = Number(this.impuesto.comisiones);

              let ingreso_gravable = sueldo - comision;
              this.impuesto.ingreso_gravable = Number(ingreso_gravable).toFixed(2);

              let iies            = (ingreso_gravable * 9.45) / 100;
              this.impuesto.iies  = Number(iies).toFixed(2);;

              let ingreso_liquido =  ingreso_gravable - iies;
              this.impuesto.ingreso_liquido = Number(ingreso_liquido).toFixed(2);
              this.impuestoAgregado('deduccion')

            }else if (tipo == 'deduccion'){
              let deduccion = 0;
              let deducciones = this.deducciones;
                deducciones.forEach(function(d){           
                  deduccion  += Number(d.valor); 
                });
             let ingreso_liquido     = Number(this.impuesto.ingreso_liquido);
              let ingreso_mensual = ingreso_liquido - deduccion;
              let ingreso_anual   = ingreso_mensual * 12;

              this.impuesto.ingreso_mensual = Number(ingreso_mensual).toFixed(2);
              this.impuesto.ingreso_anual   = Number(ingreso_anual).toFixed(2);
              this.impuesto.base_imponible  = Number(ingreso_anual).toFixed(2);

            }else if (tipo == 'final'){
             let iva               = Number(this.impuesto.interes)
             let base_imponible    = Number(this.impuesto.base_imponible);
             let fraccion          = Number(this.impuesto.fraccion);
             let impuesto_fraccion = Number(this.impuesto.impuesto_fraccion)

              let fraccion_excedente    = base_imponible - Number(fraccion);
              let fraccion_excedenteiva = (fraccion_excedente * Number(iva)) / 100;
              let total_impuesto        = Number(impuesto_fraccion) + fraccion_excedenteiva;


              this.impuesto.fraccion_excedente    = Number(fraccion_excedente).toFixed(2);
              this.impuesto.fraccion_excedente_iva = Number(fraccion_excedenteiva).toFixed(2);
              this.impuesto.total_impuesto        = Number(total_impuesto).toFixed(2);
              let total = total_impuesto / 12;
              this.impuesto.total = Number(total).toFixed(2);
              this.impuesto.iva = iva;
            }
      
             
          },

         


          agregardeduccion(){
            if (this.deduccion.valor == '') {
                  toastr.error("No puede dejar el campo vacio", "Smarmoddle", {
                    "timeOut": "3000"
                  });
            }else{
          let valor =  Number(this.deduccion.valor);
          let deduccio  = {valor:valor , descripcion: this.deduccion.descripcion};
          this.deducciones.push(deduccio);
          this.deduccion.descripcion = '';
          this.deduccion.valor = '';
          this.impuestoAgregado('deduccion')
            }

          },
          limpiar(){
              this.impuesto.total                  = ''
              this.impuesto.sueldo                 = '';
              this.impuesto.fraccion               = '';
              this.impuesto.impuesto_fraccion      = '';
              this.impuesto.interes                = '';
              this.deducciones                     =[];
              this.impuesto.comisiones             ='';
              this.impuesto.ingreso_gravable       = '';
              this.impuesto.iies                   = '';
              this.impuesto.ingreso_liquido        = '';
              this.impuesto.ingreso_mensual        = '';
              this.impuesto.ingreso_anual          = '';
              this.impuesto.base_imponible         = '';
              this.impuesto.fraccion_excedente     = '';
              this.impuesto.fraccion_excedente_iva = '';
              this.impuesto.total_impuesto         = '';
              this.impuesto.iva                    = '';
               toastr.error("Limpiado Correctamente", "Smarmoddle", {
                    "timeOut": "3000"
                  });
          },
          borrarDeduccion(index){
          this.deducciones.splice(index, 1);
          this.impuestoAgregado('deduccion')
          },
          impuestoRenta(){
        
             if(this.impuesto.fraccion == ''){
               toastr.error("No has agregado la fraccion basica", "Smarmoddle", {
                    "timeOut": "3000"
                  });
            }else if(this.impuesto.impuesto_fraccion == ''){
               toastr.error("No has agregado el impuesto a fraccion basica", "Smarmoddle", {
                    "timeOut": "3000"
                  });
            }else if(this.impuesto.interes == ''){
                 toastr.error("No has agregado el porcentaje", "Smarmoddle", {
                    "timeOut": "3000"
                  });
            }else{
            this.impuestoAgregado('final')
            
            }
          },

          //impuesto agregado




      prestamoHipotecario(valor, tiempo, interes){
        let total =0;
        let division = Number(valor)/Number(tiempo);
        let porcentaje = (division * Number(interes))/100;

        let subtotal = division + porcentaje;

        total = subtotal/12;

        return Number(total).toFixed(2);
      
        }, //end prestamo hipotecario

        calculoHipo(){


            if (this.calculo.valor == '') {
                toastr.error("No has agregado el valor", "Smarmoddle", {
                    "timeOut": "3000"
                  });
            }else if(this.calculo.tiempo == ''){
              toastr.error("No has agregado el tiempo", "Smarmoddle", {
                  "timeOut": "3000"
                });
            }else if(this.calculo.interes == ''){
              toastr.error("Debe agregar el Interes", "Smarmoddle", {
                  "timeOut": "3000"
                });
            }else{

              let calculo = this.calculo.valor;
              let tiempo  = this.calculo.tiempo;
              let interes = this.calculo.interes;
              let hipo = this.prestamoHipotecario(calculo,tiempo,interes);                 
              
              this.calculo.total = hipo;
              this.calculo.valor ='';
              this.calculo.tiempo ='';
              this.calculo.interes ='';
            }        
        },//fin calculo 

        prestamoQuirografario(valor, meses, interes){
          let total =0;
          let division = Number(valor)/Number(meses);
          let porcentaje = (division * Number(interes))/100;
         
         total = division + porcentaje;

          return Number(total).toFixed(2);
       },//end prestamo

        calculoquiro(){

          if (this.calculo1.valor == '') {
            toastr.error("No has agregado el valor", "Smarmoddle", {
                "timeOut": "3000"
              });
        }else if(this.calculo1.mes == ''){
          toastr.error("No has agregado el Mes", "Smarmoddle", {
              "timeOut": "3000"
            });
        }else if(this.calculo1.interes == ''){
          toastr.error("Debe agregar el Interes", "Smarmoddle", {
              "timeOut": "3000"
            });
        }else{

            let valor    = this.calculo1.valor;
            let mes      = this.calculo1.mes;
            let interes  = this.calculo1.interes;
            let hipo      = this.prestamoQuirografario(valor,mes,interes);                 
            
              this.calculo1.total = hipo;
              this.calculo1.valor ='';
              this.calculo1.mes ='';
              this.calculo1.interes ='';
        }
        
        },//fin calculo 


  decimales(saldo){
    if (saldo !== null && saldo !== '' && saldo !== 0) {
       let total = Number(saldo).toFixed(2);
    return total;
  }else{
    return
  }
}, //fin metodo decimal 
formatoFecha(fecha){
  if (fecha !== null) {
     let date = fecha.split('-').reverse().join('-');
  return date;
}else{
  return
}
 
},// fin fecha

abrirNomina(){ //solo para acceder al modal para agregar todo pilas 
  this.update             = false;   
 $('#modal_nomina').modal('show');
}, //fin de metodo abrirtransaccion
 
    totales :function(){

        let r1 = this.t_nomina;
        let c1 = 0;
        let c2 = 0;
        let c3 = 0;
        let c4 = 0;
        let c5 = 0;
        let c6 = 0;
        let c7 = 0;
        let c8 = 0;
        let c9 = 0;
        let c10 = 0;

        r1.forEach(function(r1,i){
          let temp = r1.sueldo;
          if(temp != null && temp !==''){
            c1 += Number(temp);
          }
        });
        this.suma.s_sueldo = c1.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.s_tiempo;
          if(temp != null && temp !==''){
            c2 += Number(temp);
          }
        });
        this.suma.s_sobretiempo = c2.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.ingresos;
          if(temp != null && temp !==''){
            c3 += Number(temp);
          }
        });
        this.suma.s_tingreso = c3.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.iees;
          if(temp != null && temp !==''){
            c4 += Number(temp);
          }
        });
        this.suma.s_iess = c4.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.pres_iees;
          if(temp != null && temp !==''){
            c5 += Number(temp);
          }
        });
        this.suma.s_piess = c5.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.pres_cia;
          if(temp != null && temp !==''){
            c6 += Number(temp);
          }
        });
        this.suma.s_pcias = c6.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.anticipo;
          if(temp != null && temp !==''){
            c7 += Number(temp);
          }
        });
        this.suma.s_anticipo = c7.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.imp_renta;
          if(temp != null && temp !==''){
            c8 += Number(temp);
          }
        });
        this.suma.s_impr = c8.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.egresos;
          if(temp != null && temp !==''){
            c9 += Number(temp);
          }
        });
        this.suma.s_tegresos = c9.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.neto_pagar;
          if(temp != null && temp !==''){
            c10 += Number(temp);
          }
        });
        this.suma.s_netopagar = c10.toFixed(2);
    },

    agregarNomina(){

      if(this.nomina.nombre_e == ''){
        toastr.error("El Nombre del Empleado es obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else if(this.nomina.cargo == ''){
        toastr.error("El Cargo del Empleado es Obligatorio es obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else {

         let nomina ={nombre_e:this.nomina.nombre_e, cargo:this.nomina.cargo, sueldo:this.nomina.sueldo, s_tiempo:this.nomina.s_tiempo, ingresos:this.nomina.ingresos, iees:this.nomina.iees, pres_iees:this.nomina.pres_iees, pres_cia:this.nomina.pres_cia, anticipo:this.nomina.anticipo, imp_renta:this.nomina.imp_renta, egresos:this.nomina.egresos, neto_pagar:this.nomina.neto_pagar}
         this.t_nomina.push(nomina);
         toastr.success("Registro agregado correctamente", "Smarmoddle", {
          "timeOut": "3000"
        });
        this.nomina.nombre_e  ='';
        this.nomina.cargo     ='';
        this.nomina.sueldo    ='';
        this.nomina.s_tiempo  ='';
        this.nomina.ingresos  ='';
        this.nomina.iees      ='';
        this.nomina.pres_iees ='';
        this.nomina.pres_cia  ='';
        this.nomina.anticipo  ='';
        this.nomina.imp_renta ='';
        this.nomina.egresos   ='';
        this.nomina.neto_pagar='';
        this.totales();

      }

    }, //fin metodo agregar

    editNomina (index){
    this.nomina.edit =true;
    this.registro_id = index;
    this.nomina.nombre_e   =  this.t_nomina[index].nombre_e;
    this.nomina.cargo      =  this.t_nomina[index].cargo;
    this.nomina.sueldo     =  this.t_nomina[index].sueldo;
    this.nomina.s_tiempo   =  this.t_nomina[index].s_tiempo;
    this.nomina.ingresos   =  this.t_nomina[index].ingresos;
    this.nomina.iees       =  this.t_nomina[index].iees;
    this.nomina.pres_iees  =  this.t_nomina[index].pres_iees;
    this.nomina.pres_cia   =  this.t_nomina[index].pres_cia;
    this.nomina.anticipo   =  this.t_nomina[index].anticipo;
    this.nomina.imp_renta  =  this.t_nomina[index].imp_renta;
    this.nomina.egresos    =  this.t_nomina[index].egresos;
    this.nomina.neto_pagar =  this.t_nomina[index].neto_pagar;
    
  }, //fin edit modal

  editNominaFuera(index){
    this.nomina.edit =true;
    this.registro_id = index;
    this.nomina.nombre_e   =  this.t_nomina[index].nombre_e;
    this.nomina.cargo      =  this.t_nomina[index].cargo;
    this.nomina.sueldo     =  this.t_nomina[index].sueldo;
    this.nomina.s_tiempo   =  this.t_nomina[index].s_tiempo;
    this.nomina.ingresos   =  this.t_nomina[index].ingresos;
    this.nomina.iees       =  this.t_nomina[index].iees;
    this.nomina.pres_iees  =  this.t_nomina[index].pres_iees;
    this.nomina.pres_cia   =  this.t_nomina[index].pres_cia;
    this.nomina.anticipo   =  this.t_nomina[index].anticipo;
    this.nomina.imp_renta  =  this.t_nomina[index].imp_renta;
    this.nomina.egresos    =  this.t_nomina[index].egresos;
    this.nomina.neto_pagar =  this.t_nomina[index].neto_pagar;
    $('#modal_nomina').modal('show');
  }, //fin edit fuera

    cancelarEditNomina(){
      this.nomina.nombre_e  ='';
      this.nomina.cargo     ='';
      this.nomina.sueldo    ='';
      this.nomina.s_tiempo  ='';
      this.nomina.ingresos  ='';
      this.nomina.iees      ='';
      this.nomina.pres_iees ='';
      this.nomina.pres_cia  ='';
      this.nomina.anticipo  ='';
      this.nomina.imp_renta ='';
      this.nomina.egresos   ='';
      this.nomina.neto_pagar='';
      this.nomina.edit      =false;

    }, //fin cancelar edit de nomina

    actualizarNomina(){

      if(this.nomina.nombre_e == ''){
        toastr.error("El Nombre del Empleado es obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else if(this.nomina.cargo == ''){
        toastr.error("El Cargo del Empleado es Obligatorio es obligatorio", "Smarmoddle", {
          "timeOut": "3000"
      });
      }else{

        let index  = this.registro_id;
        this.t_nomina[index].nombre_e    = this.nomina.nombre_e;
        this.t_nomina[index].cargo       = this.nomina.cargo;
        this.t_nomina[index].sueldo      = this.nomina.sueldo;
        this.t_nomina[index].s_tiempo    = this.nomina.s_tiempo;
        this.t_nomina[index].ingresos    = this.nomina.ingresos;
        this.t_nomina[index].iees        = this.nomina.iees;
        this.t_nomina[index].pres_iees   = this.nomina.pres_iees;
        this.t_nomina[index].pres_cia    = this.nomina.pres_cia;
        this.t_nomina[index].anticipo    = this.nomina.anticipo;
        this.t_nomina[index].imp_renta   = this.nomina.imp_renta;
        this.t_nomina[index].egresos     = this.nomina.egresos;
        this.t_nomina[index].neto_pagar  = this.nomina.neto_pagar;
        this.cancelarEditNomina();
        this.totales();
        toastr.error("Registro actualizado correctamente", "Smarmoddle", {
          "timeOut": "3000"
          });
       }
     }, //fin actualizar nomina

        eliminarNomina(){
          
          let id = this.eliminar.index;
          this.t_nomina.splice(id, 1);
          this.eliminar.index ='',
          this.eliminar.nombre='',
          $('#eliminar_nomina').modal('hide'); // en prueba para eliminar
          
        }, //fin eliminar nomina

        deleteNomina(index){
          this.t_nomina.splice(index, 1);
          this.Totales();
         
         }, //fin metodo delete

         WarningEliminarNomina(id){
          this.eliminar.index = id;
          this.eliminar.nombre = this.t_nomina[id].nombre_e;
  
          Swal.fire({
            title: 'Seguro que deseas eliminar el Registro de  '+this.eliminar.nombre ,
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
              }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Eliminado!',
                'El Registro de la Nomina '+this.eliminar.nombre,
                'success'
              );
              this.t_nomina.splice(id, 1);
              this.totales()
            }
          });
        }, //fin metodo warningeliminarnomina


        guardarNomina(){
      
          if(this.nombre.length == 0){
            toastr.error("Debe Registrar el Nombre del Comercial", "Smarmoddle", {
              "timeOut": "3000"
          });
        }else if(this.fecha.length == 0){
          toastr.error("Debe Ingresar la Fecha", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
           let _this = this;
           let url ='/sistema/admin/taller/nomina_empleado';

           axios.post(url,{
                 id:   _this.id_taller,
             nombre:   _this.nombre,
             fecha:    _this.fecha,
           t_nomina:   _this.t_nomina,
           s_sueldo:   _this.suma.s_sueldo,
      s_sobretiempo:   _this.suma.s_sobretiempo,
         s_tingreso:   _this.suma.s_tingreso,
             s_iess:   _this.suma.s_iess,
            s_piess:   _this.suma.s_piess,
            s_pcias:   _this.suma.s_pcias,
         s_anticipo:   _this.suma.s_anticipo,
             s_impr:   _this.suma.s_impr,
         s_tegresos:   _this.suma.s_tegresos,
        s_netopagar:   _this.suma.s_netopagar,

           }).then(response=>{
            if (response.data.estado == 'guardado') {
              toastr.success("Nómina de Empleados creada correctamente", "Smarmoddle", {
              "timeOut": "3000"
            });
            provision_b.obtenerNomina();
          
            }else if (response.data.estado == 'actualizado') {
               
            toastr.warning("Nómina de Empleados actualizado", "Smarmoddle", {
            "timeOut": "3000"
          });
            provision_b.obtenerNomina();
            this.totales();
          

          }  

            }).catch(function(error){
          });

        } //end else
        }, //fin metodo guardar nomina

        obtenerNomina: function(){
   
          let _this = this;
          let   url = '/sistema/admin/taller/nomina-obtener-empleado';

          axios.post(url,{
            id: _this.id_taller,
          }).then(response =>{
            if(response.data.datos == true){
              toastr.info("Anexo Nómina de Empleado cargado correctamente", "Smarmoddle", {
                "timeOut": "3000"
                });
                this.nombre       = response.data.nombre;
                this.fecha        = response.data.fecha;
                this.t_nomina     = response.data.nomina;
                this.totales();
            }
          }).catch(function(error){
          });
        }, //fin metodo obtener nomina

}, //fin methods


});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////PROVISIONDE BENEFICIOS SOCIALES////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
const provision_b = new Vue({
  el:'#provision_beneficio',
   data:{
    id_taller: taller,
    t_nomina:[], // de la nomina
    nombre:'',   //de la nomina
    fecha:'',    //de la nomina
    t_pro:[],
   
    pro:{
      edit: false,
       nombre_em:'',
       dias:'',
       v_recibido:'',
       d_tercero:'',
       d_cuarto:'',
       vacaciones:'',
       f_reserva:'',
     },

     eliminar:{
      index:'',
      nombre:''
    },
     suma:{
  
      s_valor:'',
      s_tercero:'',
      s_cuarto:'',
      s_vacaciones:'',
      s_res:'',
     },

     update: false,
     registro_id:'',
   },// end data

   mounted: function (){
     this.obtenerProvision();
     this.obtenerNomina();
   },

   methods:{
      calculadora(){
    let propsData = {title: 'Called from basic js', noteProp: ['Note number 1', 'Note number 2']};
    let component = 'example-component';
    funciones.VueSweetAlert2(component,propsData);
    },
        obtenerNomina: function(){
          let _this = this;
          let   url = '/sistema/admin/taller/nomina-obtener-empleado';

          axios.post(url,{
            id: _this.id_taller,
          }).then(response =>{
            if(response.data.datos == true){
            
                _this.nombre       = response.data.nombre;
                _this.fecha        = response.data.fecha;
                _this.t_nomina     = response.data.nomina;
              
            }
          }).catch(function(error){
          });
        }, //fin metodo obtener nomina

        decimales(saldo){
          if (saldo !== null && saldo !== '' && saldo !== 0) {
            let total = Number(saldo).toFixed(2);
          return total;
        }else{
          return
        }
         }, //fin metodo decimal 
      
      
      abrirProvision(){ //solo para acceder al modal para agregar todo pilas 
        this.update             = false;   
       $('#modal_provision').modal('show');
      }, //fin de metodo abrirtransaccion
       
      totales :function(){

        let r1 = this.t_pro;

        let c1 = 0;
        let c2 = 0;
        let c3 = 0;
        let c4 = 0;
        let c5 = 0;

        r1.forEach(function(r1,i){
          let temp = r1.v_recibido;
          if(temp != null && temp !==''){
            c1 += Number(temp);
          }
        });
        this.suma.s_valor = c1.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.d_tercero;
          if(temp != null && temp !==''){
            c2 += Number(temp);
          }
        });
        this.suma.s_tercero = c2.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.d_cuarto;
          if(temp != null && temp !==''){
            c3 += Number(temp);
          }
        });
        this.suma.s_cuarto = c3.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.vacaciones;
          if(temp != null && temp !==''){
            c4 += Number(temp);
          }
        });
        this.suma.s_vacaciones = c4.toFixed(2);

        r1.forEach(function(r1,i){
          let temp = r1.f_reserva;
          if(temp != null && temp !==''){
            c5 += Number(temp);
          }
        });
        this.suma.s_res = c5.toFixed(2);
      }, //end totales

      agregarProvision(){

        if(this.pro.nombre_em == ''){
          toastr.error("El Nombre del Empleado es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.pro.dias == ''){
          toastr.error("Este campo es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.pro.v_recibido == ''){
          toastr.error("El Valor recibido es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {
 
          let pro ={nombre_em:this.pro.nombre_em, dias:this.pro.dias, v_recibido:this.pro.v_recibido, d_tercero:this.pro.d_tercero, d_cuarto:this.pro.d_cuarto, vacaciones:this.pro.vacaciones, f_reserva:this.pro.f_reserva}
          this.t_pro.push(pro);
          toastr.success("Registro agregado correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
          this.pro.nombre_em    ='';
          this.pro.dias        ='';
          this.pro.v_recibido  ='';
          this.pro.d_tercero   ='';
          this.pro.d_cuarto    ='';
          this.pro.vacaciones  ='';
          this.pro.f_reserva   ='';
          this.totales();
        } //end else  
      }, //end agregar

      editProvision(index){
        this.pro.edit =true;
        this.registro_id = index;
        this.pro.nombre_em   =this.t_pro[index].nombre_em;
        this.pro.dias        =this.t_pro[index].dias;
        this.pro.v_recibido  =this.t_pro[index].v_recibido;
        this.pro.d_tercero   =this.t_pro[index].d_tercero;
        this.pro.d_cuarto    =this.t_pro[index].d_cuarto;
        this.pro.vacaciones  =this.t_pro[index].vacaciones;
        this.pro.f_reserva   =this.t_pro[index].f_reserva;
      },//end editprovision

      editProvisionFuera(index){
        this.pro.edit =true;
        this.registro_id = index;
        this.pro.nombre_em   =this.t_pro[index].nombre_em;
        this.pro.dias        =this.t_pro[index].dias;
        this.pro.v_recibido  =this.t_pro[index].v_recibido;
        this.pro.d_tercero   =this.t_pro[index].d_tercero;
        this.pro.d_cuarto    =this.t_pro[index].d_cuarto;
        this.pro.vacaciones  =this.t_pro[index].vacaciones;
        this.pro.f_reserva   =this.t_pro[index].f_reserva;
        $('#modal_provision').modal('show');
      },//end editprovision

      cancelarEditProvision(){
        this.pro.nombre_em    ='';
        this.pro.dias        ='';
        this.pro.v_recibido  ='';
        this.pro.d_tercero   ='';
        this.pro.d_cuarto    ='';
        this.pro.vacaciones  ='';
        this.pro.f_reserva   ='';
        this.pro.edit        =false;
      },//end cancelaredit


      actualizarProvision(){

        if(this.pro.nombre_em == ''){
          toastr.error("El Nombre del Empleado es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.pro.dias == ''){
          toastr.error("Este campo es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else if(this.pro.v_recibido == ''){
          toastr.error("El Valor recibido es obligatorio", "Smarmoddle", {
            "timeOut": "3000"
        });
        }else {

          let index  = this.registro_id;
          this.t_pro[index].nombre_em     = this.pro.nombre_em;
          this.t_pro[index].dias          = this.pro.dias;
          this.t_pro[index].v_recibido    = this.pro.v_recibido;
          this.t_pro[index].d_tercero     = this.pro.d_tercero;
          this.t_pro[index].d_cuarto      = this.pro.d_cuarto;
          this.t_pro[index].vacaciones    = this.pro.vacaciones;
          this.t_pro[index].f_reserva     = this.pro.f_reserva;
          this.cancelarEditProvision();
          this.totales();
          toastr.error("Registro actualizado correctamente", "Smarmoddle", {
            "timeOut": "3000"
            });
        }//end else
      },//end provision actualizar

      eliminarProvision(){    
        let id = this.eliminar.index;
        this.t_pro.splice(id, 1);
        this.eliminar.index ='',
        this.eliminar.nombre='',
        $('#eliminar_p').modal('hide'); // en prueba para eliminar
        
      }, //fin eliminar provision
   

      deleteProvision(index){
        this.t_pro.splice(index, 1);
        this.totales();
       
       }, //fin metodo delete
   
       WarningEliminarProvision(id){
        this.eliminar.index = id;
        this.eliminar.nombre = this.t_pro[id].nombre_em;

        Swal.fire({
          title: 'Seguro que deseas eliminar el Registro de  '+this.eliminar.nombre ,
          text: "Esta accion no se puede revertir",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Eliminado!',
              'El Registro de la Provision '+this.eliminar.nombre,
              'success'
            );
            this.t_pro.splice(id, 1);
            this.totales();
          }
        });
      }, //fin metodo warningeliminarnomina


      guardarProvision(){

      if(this.t_pro.length == 0){
          toastr.error("Debe haber al menos un  Registrado", "Smarmoddle", {
            "timeOut": "3000"
        });
      }else {
        let _this = this;
        let url   = '/sistema/admin/taller/provision_social';
        axios.post(url,{
                 id:   _this.id_taller,
            s_valor:   _this.suma.s_valor,
          s_tercero:   _this.suma.s_tercero,
           s_cuarto:   _this.suma.s_cuarto,
       s_vacaciones:   _this.suma.s_vacaciones,
              s_res:   _this.suma.s_res,
              t_pro:   _this.t_pro,
        }).then(response=>{
          if (response.data.estado == 'guardado') {
            toastr.success("Provisión de Beneficio creada correctamente", "Smarmoddle", {
            "timeOut": "3000"
          });
          }else if (response.data.estado == 'actualizado') {
          toastr.warning("Provisión de Beneficio actualizado correctamente", "Smarmoddle", {
          "timeOut": "3000"
        });
        }  

          }).catch(function(error){
        });
      } //end else
      }, //end guardarprovision


      obtenerProvision: function(){

        let _this = this;
        let url   = '/sistema/admin/taller/provision-obtener-beneficio';
        axios.post(url,{
          id: _this.id_taller,  
        }).then(response=>{
          if(response.data.datos == true){
            toastr.success("Anexo Provisión Beneficio Social cargado correctamente", "Smarmoddle", {
              "timeOut": "3000"
              });

              this.t_pro = response.data.pro;
              this.totales();
            }
          }).catch(function(error){
          });
      } // end obtener   
    }, // end methods
});

