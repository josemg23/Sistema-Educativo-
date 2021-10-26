<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{   
    public function contenido(){
        return $this->belongsTo('App\Contenido');
    }
    // public function materia(){
    //     return $this->belongsTo('App\Materia');
    // }

  public function users(){
        return $this->belongsToMany('App\User','taller_user')
            ->withPivot('status','calificacion', 'fecha_entregado');
    }
         public function distribucionmacus(){
        return $this->belongsToMany('App\Distribucionmacu','distribucionmacu_taller')
            ->withPivot('estado','contenido_id', 'fecha_entrega', 'plantilla_id');
    }
    public function Plantilla()
    {
    	return $this->belongsTo('App\Plantilla');
    }
      public function tallerCompletar()
    {
    	return $this->belongsTo('App\Admin\TallerCompletar');
    }
    public function tallerClasificar()
    {
        return $this->belongsTo('App\Admin\TallerClasificar');
    }
     public function tallerCompletarEnunciado()
    {
        return $this->belongsTo('App\Admin\TallerCompletarEnunciado');
    }
     public function tallerDiferencia()
    {
        return $this->belongsTo('App\Admin\TallerDiferencia');
    }
    public function tallerDiferenciaRes()
    {
        return $this->belongsTo('App\TallerDiferenciaRes');
    }
      public function tallerSenalar()
    {
        return $this->belongsTo('App\Admin\TallerSenalar');
    }
        public function tallerIdentificar()
    {
        return $this->belongsTo('App\Admin\TallerIdentificarImagen');
    }
        public function tallerGusanillo()
    {
        return $this->belongsTo('App\Admin\TallerGusanillo');
    }
         public function tallerCirculo()
    {
        return $this->belongsTo('App\Admin\TallerCirculo');
    }
        public function tallerSubrayar()
    {
        return $this->belongsTo('App\Admin\tallerSubrayar');
    }
     public function tallerRelacionar()
    {
        return $this->belongsTo('App\Admin\TallerRelacionar');
    }
    public function taller2Relacionar()
    {
        return $this->belongsTo('App\Admin\Taller2Relacionar');
    }
    public function tallerVerdaderofalso()
    {
        return $this->belongsTo('App\Admin\TallerVerdaderoFalso');
    }
   
     public function tallerIdentificarpersona()
    {
        return $this->belongsTo('App\Admin\TallerIdentificarPersona');
    }
       public function tallerdefinirEnunciado()
    {
        return $this->belongsTo('App\Admin\TallerDefinirEnunciado');
    }
        public function tallerCheque()
    {
        return $this->belongsTo('App\Admin\TallerCheque');
    }
        public function cheque()
    {
        return $this->hasMany('App\Admin\Respuesta\Cheque');
    }
        public function tallerChequeEndoso()
    {
        return $this->belongsTo('App\Admin\TallerChequeEndoso');
    }
        public function chequeEndoso()
    {
        return $this->hasMany('App\Admin\Respuesta\ChequeEndoso');
    }
        public function convertirCheque()
    {
        return $this->hasMany('App\Admin\Respuesta\ConvertirCheque');
    }
        public function tallerConvertirCheque()
    {
        return $this->belongsTo('App\Admin\TallerConvertirCheque');
    }
         public function tallerLetraCambio()
    {
        return $this->belongsTo('App\Admin\TallerLetraCambio');
    }
         public function letraCambio()
    {
        return $this->hasMany('App\Admin\Respuesta\LetraCambio');
    }
         public function tallerCertificadoDeposito()
    {
        return $this->belongsTo('App\Admin\TallerCertificadoDeposito');
    }
         public function certificadoDeposito()
    {
        return $this->hasMany('App\Admin\Respuesta\CertificadoDeposito');
    }
         public function tallerPagare()
    {
        return $this->belongsTo('App\Admin\TallerPagare');
    }
         public function pagare()
    {
        return $this->hasMany('App\Admin\Respuesta\Pagare');
    }
     public function tallerValeCaja()
    {
        return $this->belongsTo('App\Admin\TallerValeCaja');
    }
    public function valeCaja()
    {
        return $this->hasMany('App\Admin\Respuesta\ValeCaja');
    }
     public function tallerNotaPedido()
    {
        return $this->belongsTo('App\Admin\TallerNotaPedido');
    }
     public function tallerNotaPedidoRe()
    {
        return $this->belongsTo('App\TallerNotaPedidoRe');
    }
    public function tallerRecibo()
    {
        return $this->belongsTo('App\Admin\TallerRecibo');
    }
    public function tallerReciboRe()
    {
        return $this->belongsTo('App\TallerReciboRe');
    }
    public function tallerOrdenPago()
    {
        return $this->belongsTo('App\Admin\tallerOrdenPago');
    }
    public function tallerOrdenPagoRe()
    {
        return $this->belongsTo('App\TallerOrdenPagoRe');
    }
    public function tallerFactura()
    {
        return $this->belongsTo('App\Admin\TallerFactura');
    }
    public function tallerFacturaRe()
    {
        return $this->belongsTo('App\TallerFacturaRe');
    }
      public function tallerNotaVenta()
    {
        return $this->belongsTo('App\Admin\TallerNotaVenta');
    }
    public function tallerNotaVentaRe()
    {
        return $this->belongsTo('App\TallerNotaVentaRe');
    }
     public function tallerAbre()
    {
        return $this->belongsTo('App\Admin\TallerAbreviatura');
    }
     public function tallerCollage()
    {
        return $this->belongsTo('App\Admin\TallerCollage');
    }
     public function tallerCollageRe()
    {
        return $this->belongsTo('App\TallerCollageRe');
    }
     public function tallerContabilidad()
    {
        return $this->belongsTo('App\Admin\TallerContabilidad');
    }
       public function balanceInicial()
    {
        return $this->belongsTo('App\Contabilidad\BalanceInicial');
    }
      public function tallerPregunta()
    {
        return $this->belongsTo('App\Admin\TallerPregunta');
    }
      public function tallerTipoSaldo()
    {
        return $this->hasMany('App\Admin\TallerTipoSaldo');
    }
     public function tallerAnalizar()
    {
        return $this->belongsTo('App\Admin\TallerAnalizar');
    }
     public function tallerALectura()
    {
        return $this->belongsTo('App\Admin\TallerALectura');
    }
     public function tallerPalabra()
    {
        return $this->belongsTo('App\Admin\TallerPalabra');
    }
     public function tallerOrdenIdea()
    {
        return $this->hasMany('App\Admin\TallerOrdenIdea');
    }
        public function tallerMConceptual()
    {
        return $this->belongsTo('App\Admin\TallerMConceptual');
    }
      public function tallerCuenta()
    {
        return $this->belongsTo('App\Admin\TallerEscribirCuenta');
    }
       public function tallerSopa()
    {
        return $this->belongsTo('App\Admin\TallerSopaLetra');
    }
        public function identificarAbreviaturas(){

        return $this->hasMany('App\Admin\Respuesta\IdentificarAbreviatura');
    }
        public function abreviaturaCartas(){

        return $this->hasMany('App\Admin\Respuesta\AbreviaturaCarta');
    }
        public function abreviaturaEditorials(){

        return $this->hasMany('App\Admin\Respuesta\AbreviaturaEditorial');
    }
         public function abreviaturaEconomicas(){

        return $this->hasMany('App\Admin\Respuesta\AbreviaturaEconomica');
    }
       public function formulaContables(){

        return $this->hasMany('App\Admin\Respuesta\FormulasContable');
    }
       public function mapaConceptuals(){

        return $this->hasMany('App\Admin\Respuesta\MapaConceptual');
    }
      public function completars(){

        return $this->hasMany('App\Admin\Respuesta\Completar');
    }
      public function completarEnunciados(){

        return $this->hasMany('App\Admin\Respuesta\CompletarEnunciado');
    }
      public function diferencias(){

        return $this->hasMany('App\Admin\Respuesta\Diferencia');
    }
     public function identificarImg(){

        return $this->hasMany('App\Admin\Respuesta\Identificar');
    }
     public function gusanillo(){

        return $this->hasMany('App\Admin\Respuesta\Gusanillo');
    }
     public function circulos(){

        return $this->hasMany('App\Admin\Respuesta\Circulo');
    } public function subrayars(){

        return $this->hasMany('App\Admin\Respuesta\Subrayar');
    }
    public function verdaderoFalso(){

        return $this->hasMany('App\Admin\Respuesta\VerdaderoFalso');
    }
     public function definirEnuncuiado(){

        return $this->hasMany('App\Admin\Respuesta\DefinirEnunciado');
    }
      public function identificarPersona(){

        return $this->hasMany('App\Admin\Respuesta\IdentificarPersona');
    }
     public function recibo(){

        return $this->hasMany('App\Admin\Respuesta\Recibo');
    }
    public function ordenPago(){

        return $this->hasMany('App\Admin\Respuesta\OrdenPago');
    }
     public function abreviatura(){

        return $this->hasMany('App\Admin\Respuesta\Abreviatura');
    }
     public function notaVenta(){

        return $this->hasMany('App\Admin\Respuesta\NotaVenta');
    }
      public function collage(){

        return $this->hasMany('App\Admin\Respuesta\Collage');
    }
       public function pregunta(){

        return $this->hasMany('App\Admin\Respuesta\Pregunta');
    }
     public function tipoSaldo(){

        return $this->hasMany('App\Admin\Respuesta\TipoSaldo');
    }
     public function lectura(){

        return $this->hasMany('App\Admin\Respuesta\Lectura');
    }
     public function analizar(){

        return $this->hasMany('App\Admin\Respuesta\AnalizarPregunta');
    }
      public function palabras(){

        return $this->hasMany('App\Admin\Respuesta\Palabra');
    }
       public function idenTrasa(){

        return $this->hasMany('App\Admin\Respuesta\IdenTrasa');
    }
    public function ordenIdea(){

        return $this->hasMany('App\Admin\Respuesta\OrdenIdea');
    }
     public function mapaConceptual(){

        return $this->hasMany('App\Admin\Respuesta\MapaConceptual2');
    }
     public function escribirCuentas(){

        return $this->hasMany('App\Admin\Respuesta\EscribirCuenta');
    }
    public function ruedaLogica(){

        return $this->hasMany('App\Admin\Respuesta\RuedaLogica');
    }
      public function celda(){

        return $this->hasMany('App\Admin\Respuesta\Celda');
    }
      public function partidaDoble(){

        return $this->hasMany('App\Admin\Respuesta\PartidaDoble');
    }
       public function rAlternativas(){

        return $this->hasMany('App\Admin\TallerRAlternativa');
    }
       public function rAlternativares(){

        return $this->hasMany('App\Admin\Respuesta\RAlternativa');
    }

     
    public function anexocajas(){
          
        return $this->hasMany('App\Anexocaja');
    }

    public function arqueocajas(){
          
        return $this->hasMany('App\Arqueocajas');
    }
    public function conciliacionbancarias(){
          
        return $this->hasMany('App\Conciliacionbancaria');
    }
    
    public function retencionivas(){
        return $this->hasMany('App\Retencioniva');
    }
    
    public function nominaempleados(){ 
        return $this->hasMany('App\Nominaempleado');
    }

    public function provisionsocial(){
        return $this->hasMany('App\Provisionsocial');
     }
      public function tallerArchivo()
    {
        return $this->belongsTo('App\TallerArchivo');
    }
         public function  archivoRes()
    {
        return $this->belongsTo('App\RespuestaArchivo');
    }
       public function plancuentas(){

        return $this->hasMany('App\Admin\PlanCuenta');
    }

         public function plancuentasRes(){

        return $this->hasMany('App\Admin\PlanCuentaRespuesta');
    }
}



