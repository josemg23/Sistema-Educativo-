<?php
use Illuminate\Support\Facades\Routes;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 // Route::get('/sistema', function () {
 //       return view('welcome');
 //   })->name('sistema');
Auth::routes();
//Auth::routes(['verify' => true]);
// Auth::routes(["register" => false]);
// Auth::routes(["login" => false]);
// Auth::routes(["logout" => false]);
Route::get('/', function () {
    return view('principal');
})->name('welcome');

///rutas protegidas On 

 Route::group(["prefix"=>"sistema","middleware"=>["auth"]],function(){
//Route::group(["prefix"=>"sistema"],function(){ //por ahora sera la ruta hasta que se arregle lo del login
   
route::get('/home','AdminController@index')->name('administrador'); //ruta administracion

// route::get('home','AdminController@index')->name('administrador'); //ruta administracion

//ruta del menu general de administracion 

route::get('/homedoc','DocenteController@index')->name('docente'); //ruta docente

route::get('/homees','EstudianteController@index')->name('estudiante'); //ruta estudiante

//rutas vue asignaciones////

 Route::post('materiainst','HomeController@buscarMateria')->name('materiainst');
 Route::post('materiasdocentes','HomeController@materiaDocente')->name('materiaDocente');
 Route::post('materiasasig','HomeController@materia')->name('materiassig');
 Route::post('materiataller','HomeController@materiaTalleres')->name('materiaTalleres');
 Route::post('userinst','HomeController@buscarAlumno')->name('userinst');
 Route::post('docinst','HomeController@buscarDocente')->name('docinst');
 Route::post('distinst','HomeController@buscarAsignacion')->name('distinst');
 Route::post('contmateria','HomeController@buscarContenido')->name('contmateria');
 Route::post('asignaciones','HomeController@asignacion')->name('asignacion');
 Route::post('paralelosinst','HomeController@obtenerParalelos')->name('obtenerParalelos');
 Route::post('buscarparalelo','HomeController@buscarparalelo')->name('buscarparalelo');
 Route::post('getcontenidos','DocumentoController@getcontenidos')->name('contenidos.doc');



 ////////////////////////////////////////////////


////////////////////////////////////////////////
 ////////////////Fin Reporte Vuejs//////////////
 ////////////////////////////////////////////////
 ////////////////////////////////////////////////


 
////////////////////////////////////////////////
 //////////////// Reporte Eloquent//////////////

 Route::get('/reportes','PDFController@Reporteindex')->name('Reportes');
 
 ///////////////////////////////////////////////
 ////////////////Descargar Excel////////////////
////////////////////////////////////////////////
 
Route::get('users-list-excel','PDFController@UserExport')->name('users.excel');
Route::get('distribucion-list-excel','PDFController@DistribucionExport')->name('distribucion.excel');
Route::get('asignaciones-list-excel','PDFController@AssigmentExport')->name('asignacion.excel');
Route::get('docentes-list-excel','PDFController@DocenteExport')->name('docente.excel');
Route::get('cursos-list-excel','PDFController@CursoExport')->name('curso.excel');


 ////////////////////////////////////////////////
 ////////////////////////////////////////////////



///rutas menu docente
route::get('materia/{id}', 'DocenteController@contenidos')->name('Contenidos');
route::get('docente/Documento-pdf/{contenido}', 'DocenteController@VerPDF')->name('Contenido.docente'); //para visualizar el documento en el menu docente no descargable
route::get('docente/Documento-pdf2/{contenido}', 'DocenteController@VerPDF2')->name('Contenido2.docente'); //para visualizar el documento en el menu estudiante descargable


//rutas menu estudiante
route::post('admin/cambiarestado','AdminController@status')->name('taller.status');
route::post('admin/registro','DocenteController@registro')->name('taller.registro');
route::get('perfile','EstudianteController@show')->name('perfile');
route::get('unidad/{id}','EstudianteController@unidades')->name('Unidades');
route::get('estudiante/password', 'EstudianteController@password')->name('AlumnoPass'); //para metodo get del password 
route::post('estudiante/password','EstudianteController@updatep')->name('Estudiantes.updatep'); // para guardar el nuevo password
route::get('Contenido-pdf/{contenido}', 'EstudianteController@VisualizacionPDF')->name('Contenido.alumno'); //para visualizar el documento del administrador en el menu estudiante no descargable
route::get('Contenido-pdf2/{contenido}', 'EstudianteController@VisualizacionPDF3')->name('Contenido3.alumno'); //para visualizar el documento del administrador en el menu estudiante y descargable
route::get('Contenido-pdf/docente/{contenido}', 'EstudianteController@VisualizacionPDF2')->name('Contenido2.alumno'); //para visualizar el documento del docente en el menu estudiante
route::get('post-estudiante', 'EstudianteController@PostE')->name('Post.alumno');
route::post('estudiante/post/store', 'EstudianteController@storee')->name('storepost'); //guardar un post desde estudiante
route::DELETE('estudiante/post/delete/{post}', 'EstudianteController@destroype')->name('deletepost');
route::get('post-docentes-estudiantes', 'EstudianteController@Postdocentes')->name('Post.docentes-alumnos');//post de docentes de los estudiantes

//rutas menu docente
route::get('perfil', 'DocenteController@Perfil')->name('Perfil');
route::get('materia/{id}', 'DocenteController@contenidos')->name('Contenidos');

route::get('materia/{id}/paralelo/{nivel}/', 'DocenteController@paralelo')->name('paralelo');
route::get('contenido/{id}/talleres','DocenteController@talleres')->name('contenido.talleres');
route::get('contenido/{id}/talleres/resueltos','DocenteController@resueltos')->name('contenido.resueltos');

route::get('alumnos/{id}', 'DocenteController@cursos')->name('Alumnos');
route::get('docente/password', 'DocenteController@password')->name('DocentePass'); //para metodo get del password 
route::post('docente/password','DocenteController@updatep')->name('Docente.updatep'); // para guardar el nuevo password
route::get('post-docente', 'DocenteController@PostD')->name('Post.docente');
route::post('docente/post/store', 'DocenteController@stored')->name('storepostd'); //guardar un post desde estudiante
route::DELETE('docente/post/delete/{post}', 'DocenteController@destroyped')->name('deletepostd');
 //archivos docentes
 
 route::get('docente/archivos-update', 'DocenteController@Archivos_docente')->name('documentacion.docente');

 route::get('docente/documento/Documento-pdf/{archivodocente}', 'DocenteController@VerDoc')->name('Documentover.docente'); //ver documento que el docente sube en otra vista
/////////////////////////////////////
///////////DOCUMENTO DOCENTE/////////

 route::get('docente/documento/archivos-crear', 'DocenteController@Doc_crear')->name('documentacion.docentecrear'); //ruta crear 
 route::post('docente/archivo-guardar','DocenteController@Guardardoc')->name('documentacion.docentestore');
 route::get('docente/documento/archivo-show/{archivodocente}','DocenteController@docshow')->name('documentaciondoc.show');

 route::get('docente/documento/archivo-edit/{archivodocente}/edit','DocenteController@docedit')->name('documentaciondoc.edit');
 route::PUT('docente/archivo-actualizar/{archivodocente}','DocenteController@docupdate')->name('documentaciondoc.update');
 route::delete('docente/archivos-update/{archivodocente}','DocenteController@destroy')->name('documentaciondoc.destroy');


/////////////////////////////////////
/////////////////////////////////////



route::get('docente/password', 'DocenteController@password')->name('DocentePass'); //para metodo get del password 
route::post('docente/password','DocenteController@updatep')->name('Docente.updatep'); // para guardar el nuevo password


//////fin

//rutas usuario
route::resource('users','UsersController');
Route::post('estadouser','HomeController@EstadoUser')->name('Estado');


// rutas instituto
route::resource('institutos','InstitutoController');// FUNCIONA AL 100%
route::get('institutos/clone/{id}','InstitutoController@clone')->name('institutos.clone');// FUNCIONA AL 100%
route::get('contenido/clone/{id}','InstitutoController@hola')->name('contenido.clone');// FUNCIONA AL 100%

/// rutas roles
route::resource('roles','Controladores\RoleController');// FUNCIONA AL 100%
route::get('iniciorole','Controladores\RoleController@index')->name('roles.inicio');
route::PUT('/roles/roles/{role}','Controladores\RoleController@update')->name('role.update');

//MENU o permisos donde tendra acceso el usuario
route::resource('permissions','PermissionController');// FUNCIONA AL 50%

//Ruta Resource de Niveles que va aliada con el curso
route::resource('nivels','NivelController'); //ojo en este caso le cambie niveles -> nivels como esta en la tabla 
//al parecer el nombre de la tabla en bd tiene relacion con las rutas que asignamos como metodo resource

//Ruta Resource de Cursos que va aliada con el curso
route::resource('cursos','CursoController');

//Ruta Resource de Materias que va aliada con el curso
route::resource('materias','MateriaController');
//ver documento pdf en el archivo
Route::get('Unidad-pdf/{contenido}','HomeController@Verdocumento')->name('Unidad.contenido');
Route::get('Unidad-pdf2/{contenido}','HomeController@Verdocumento2')->name('Unidad2.contenido');


//Ruta Resource de Materias que va aliada con el curso
route::resource('contenidos','ContenidoController');


//Ruta Resource de Documentos-contenido que va aliada con el curso
route::resource('documentos','DocumentoController');


//Ruta Resource par asignacion de cursos y materias prueba 2 
route::resource('distribucionmacus','DistribucionmacuController');

//Ruta Resource para plan de cuentas
route::get('pcuentas','PcuentaController@index')->name('pcuentas.index');
route::get('pcuentas/create','PcuentaController@create')->name('pcuentas.create');
route::post('pcuentas','PcuentaController@store')->name('pcuentas.store');
route::get('pcuentas/{pcuenta}','PcuentaController@show')->name('pcuentas.show');
route::get('pcuentas/{pcuenta}/edit','PcuentaController@edit')->name('pcuentas.edit');
route::post('pcuentas/actualizar','PcuentaController@update')->name('pcuentas.update');
route::delete('pcuentas/{pcuenta}','PcuentaController@destroy')->name('pcuentas.destroy');

//Ruta Resource para distribucion alumno curso/materia
route::resource('distrimas','DistrimaController');

//Ruta Resource para distribucion alumno docente/materia
route::resource('distribuciondos','DistribuciondoController');

//Ruta Resource para clonacion de unidad educativa
route::get('/clinstitutos/create','ClinstitutoController@create')->name('clinstitutos.create');
route::post('/clinstitutos/store','ClinstitutoController@p_clonainstituto')->name('clinstitutos.p_clonainstituto');

//Ruta Resource para Post
route::resource('posts','PostController');

//rutas para comentarios del post
route::post('/comment/store','CommentController@store')->name('comment.add');
route::post('/reply/store','CommentController@replyStore')->name('reply.add');
route::delete('/reply/destroy/{comment}','CommentController@destroy')->name('comment.destroy');
route::get('/reply/{comment}/edit','CommentController@edit')->name('comment.edit');
route::put('/reply/{comment}','CommentController@update')->name('comment.update');



//rutas de nueva asignacion estudiante a materias 
route::resource('assignments','AssignmentController');


//rutas de reportes

// route::get('/pdfDocentes','PDFController@PDFDocentes')->name('descargarPDFDocentes');


});

Route::group(['prefix' => 'sistema/admin'], function() {

route::post('/plantilla', 'AdminController@plantilla')->name('admin.plantilla');
route::get('/plantilla/tallercontable', 'AdminController@tallercontable')->name('admin.tallercontable');
route::post('/taller1', 'AdminController@taller1')->name('admin.taller1');
route::post('/taller2', 'AdminController@taller2')->name('admin.taller2');
route::post('/taller3', 'AdminController@taller3')->name('admin.taller3');
route::post('/taller4', 'AdminController@taller4')->name('admin.taller4');
route::post('/taller5', 'AdminController@taller5')->name('admin.taller5');
route::post('/taller6', 'AdminController@taller6')->name('admin.taller6');
route::post('/taller7', 'AdminController@taller7')->name('admin.taller7');
route::post('/taller8', 'AdminController@taller8')->name('admin.taller8');
route::post('/taller9', 'AdminController@taller9')->name('admin.taller9');
route::post('/taller10', 'AdminController@taller10')->name('admin.taller10');
route::post('/taller11', 'AdminController@taller11')->name('admin.taller11');
route::post('/taller12', 'AdminController@taller12')->name('admin.taller12');
route::post('/taller13', 'AdminController@taller13')->name('admin.taller13');
route::post('/taller14', 'AdminController@taller14')->name('admin.taller14');
route::post('/taller15', 'AdminController@taller15')->name('admin.taller15');
route::post('/taller16', 'AdminController@taller16')->name('admin.taller16');
route::post('/taller17', 'AdminController@taller17')->name('admin.taller17');
route::post('/taller18', 'AdminController@taller18')->name('admin.taller18');
route::post('/taller19', 'AdminController@taller19')->name('admin.taller19');
route::post('/taller20', 'AdminController@taller20')->name('admin.taller20');
route::post('/taller21', 'AdminController@taller21')->name('admin.taller21');
route::post('/taller22', 'AdminController@taller22')->name('admin.taller22');
route::post('/taller23', 'AdminController@taller23')->name('admin.taller23');
route::post('/taller24', 'AdminController@taller24')->name('admin.taller24');
route::post('/taller25', 'AdminController@taller25')->name('admin.taller25');
route::post('/taller26', 'AdminController@taller26')->name('admin.taller26');
route::post('/taller27', 'AdminController@taller27')->name('admin.taller27');
route::post('/taller28', 'AdminController@taller28')->name('admin.taller28');
route::post('/taller29', 'AdminController@taller29')->name('admin.taller29');
route::post('/taller31', 'AdminController@taller31')->name('admin.taller31');
route::post('/taller33', 'AdminController@taller33')->name('admin.taller33');
route::post('/taller34', 'AdminController@taller34')->name('admin.taller34');
route::post('/taller35', 'AdminController@taller35')->name('admin.taller35');
route::post('/taller36', 'AdminController@taller36')->name('admin.taller36');
route::post('/taller37', 'AdminController@taller37')->name('admin.taller37');
route::post('/taller38', 'AdminController@taller38')->name('admin.taller38');
route::post('/taller39', 'AdminController@taller39')->name('admin.taller39');
route::post('/taller40', 'AdminController@taller40')->name('admin.taller40');
route::post('/taller42', 'AdminController@taller42')->name('admin.taller42');
route::post('/taller43', 'AdminController@taller43')->name('admin.taller43');
route::post('/taller44', 'AdminController@taller44')->name('admin.taller44');
route::post('/taller45', 'AdminController@taller45')->name('admin.taller45');
route::post('/taller47', 'AdminController@taller47')->name('admin.taller47');
route::post('/taller48', 'AdminController@taller48')->name('admin.taller48');
route::post('/taller49', 'AdminController@taller49')->name('admin.taller49');
route::post('/tallerprecon', 'AdminController@tallerprecon')->name('admin.tallerprecon');

// route::post('/taller50', 'AdminController@taller50')->name('admin.taller50');
// route::post('/taller57', 'AdminController@taller57')->name('admin.taller57');
	});

route::get('/sistema/taller/{plant}/{id}', 'TallersController@taller')->name('taller');

route::get('/sistema/homees/taller/{plant}/{id}', 'TallerEstudianteController@taller')->name('taller.estudiante');
route::get('/sistema/homees/taller/vista/{plant}/{id}', 'VistaEstudianteController@taller')->name('vista.taller');
route::get('/sistema/homedoc/taller/{plant}/{id}/{user}', 'TallerDocenteController@taller')->name('taller.docente');
route::get('/sistema/homedoc/tallerresuelto/{plant}/{id}/', 'VistaDocenteController@taller')->name('taller.resuelto');


route::post('/sistema/admin/taller1/{idtaller}', 'TallerEstudianteController@store1')->name('taller1');
route::post('/sistema/admin/taller2/{idtaller}', 'TallerEstudianteController@store2')->name('taller2');
route::post('/sistema/admin/taller3/{idtaller}', 'TallerEstudianteController@store3')->name('taller3');
route::post('/sistema/admin/taller4/{idtaller}', 'TallerEstudianteController@store4')->name('taller4');
route::post('/sistema//admin/taller5/{idtaller}', 'TallerEstudianteController@store5')->name('taller5');
route::post('/sistema/admin/taller6/{idtaller}', 'TallerEstudianteController@store6')->name('taller6');
route::post('/sistema/admin/taller7/{idtaller}', 'TallerEstudianteController@store7')->name('taller7');
route::post('/sistema/admin/taller8/{idtaller}', 'TallerEstudianteController@store8')->name('taller8');
route::post('/sistema/admin/taller9/{idtaller}', 'TallerEstudianteController@store9')->name('taller9');
route::post('/sistema/admin/taller10/{idtaller}', 'TallerEstudianteController@store10')->name('taller10');
route::post('/sistema/admin/taller11/{idtaller}', 'TallerEstudianteController@store11')->name('taller11');
route::post('/sistema/admin/taller12/{idtaller}', 'TallerEstudianteController@store12')->name('taller12');
route::post('/sistema/admin/taller13/{idtaller}', 'TallerEstudianteController@store13')->name('taller13');
route::post('/sistema/admin/taller14/{idtaller}', 'TallerEstudianteController@store14')->name('taller14');
route::post('/sistema/admin/taller15/{idtaller}', 'TallerEstudianteController@store15')->name('taller15');
route::post('/sistema/admin/taller16/{idtaller}', 'TallerEstudianteController@store16')->name('taller16');
route::post('/sistema/admin/taller17/{idtaller}', 'TallerEstudianteController@store17')->name('taller17');
route::post('/sistema/admin/taller18/{idtaller}', 'TallerEstudianteController@store18')->name('taller18');
route::post('/sistema/admin/taller19/{idtaller}', 'TallerEstudianteController@store19')->name('taller19');
route::post('/sistema/admin/taller20/{idtaller}', 'TallerEstudianteController@store20')->name('taller20');
route::post('/sistema/admin/taller21/{idtaller}', 'TallerEstudianteController@store21')->name('taller21');
route::post('/sistema/admin/taller22/{idtaller}', 'TallerEstudianteController@store22')->name('taller22');
route::post('/sistema/admin/taller23/{idtaller}', 'TallerEstudianteController@store23')->name('taller23');
route::post('/sistema/admin/taller24/{idtaller}', 'TallerEstudianteController@store24')->name('taller24');
route::post('/sistema/admin/taller25/{idtaller}', 'TallerEstudianteController@store25')->name('taller25');
route::post('/sistema/admin/taller26/{idtaller}', 'TallerEstudianteController@store26')->name('taller26');
route::post('/sistema/admin/taller27/{idtaller}', 'TallerEstudianteController@store27')->name('taller27');
route::post('/sistema/admin/taller28/{idtaller}', 'TallerEstudianteController@store28')->name('taller28');
route::post('/sistema/admin/taller29/{idtaller}', 'TallerEstudianteController@store29')->name('taller29');
route::post('/sistema/admin/taller30/{idtaller}', 'TallerEstudianteController@store30')->name('taller30');
route::post('/sistema/admin/taller31/{idtaller}', 'TallerEstudianteController@store31')->name('taller31');
route::post('/sistema/admin/taller32/{idtaller}', 'TallerEstudianteController@store32')->name('taller32');
route::post('/sistema/admin/taller33/{idtaller}', 'TallerEstudianteController@store33')->name('taller33');
route::post('/sistema/admin/taller34/{idtaller}', 'TallerEstudianteController@store34')->name('taller34');
route::post('/sistema/admin/taller35/{idtaller}', 'TallerEstudianteController@store35')->name('taller35');
route::post('/sistema/admin/taller36/{idtaller}', 'TallerEstudianteController@store36')->name('taller36');
route::post('/sistema/admin/taller37/{idtaller}', 'TallerEstudianteController@store37')->name('taller37');
route::post('/sistema/admin/taller38/{idtaller}', 'TallerEstudianteController@store38')->name('taller38');
route::post('/sistema/admin/taller39/{idtaller}', 'TallerEstudianteController@store39')->name('taller39');
route::post('/sistema/admin/taller40/{idtaller}', 'TallerEstudianteController@store40')->name('taller40');
route::post('/sistema/admin/taller41/{idtaller}', 'TallerEstudianteController@store41')->name('taller41');
route::post('/sistema/admin/taller42/{idtaller}', 'TallerEstudianteController@store42')->name('taller42');
route::post('/sistema/admin/taller43/{idtaller}', 'TallerEstudianteController@store43')->name('taller43');
route::post('/sistema/admin/taller44/{idtaller}', 'TallerEstudianteController@store44')->name('taller44');
route::post('/sistema/admin/taller45/{idtaller}', 'TallerEstudianteController@store45')->name('taller45');
route::post('/sistema/admin/taller46/{idtaller}', 'TallerEstudianteController@store46')->name('taller46');
route::post('/sistema/admin/taller47/{idtaller}', 'TallerEstudianteController@store47')->name('taller47');
// route::post('/sistema/admin/taller37/{idtaller}', 'TallerEstudianteController@store37')->name('taller_37');
route::post('/sistema/admin/taller48/{idtaller}', 'TallerEstudianteController@store48')->name('taller48');
route::post('/sistema/admin/taller49/{idtaller}', 'TallerEstudianteController@store49')->name('taller49');


route::post('/sistema/admin/taller/balance_inicial', 'TallerContabilidadController@balance_inicial')->name('balance_inicial');

route::post('/sistema/admin/taller/balance-obtener-comprobacion', 'TallerContabilidadController@obtenerBalanceCompro')->name('balance.obtenercomprobacion');

route::post('/sistema/admin/taller/balance-obtener-ajustado', 'TallerContabilidadController@obtenerBalanceAjustado')->name('balance.obtenerajustado');

route::post('/sistema/admin/taller/balance-ajustado', 'TallerContabilidadController@balanceAjustado')->name('balance.balance-ajustado');
// RUTAS HOJA DE TRABAJO
route::post('/sistema/admin/taller/balance-comprobacion', 'TallerContabilidadController@balanceComprobacion')->name('balance.comprobacion');
// FIN RUTAS HOJA DE TRABAJO
// 
// // RUTAS HOJA DE TRABAJO
route::post('/sistema/admin/taller/hoja-trabajo', 'TallerContabilidadController@hojaTrabajo')->name('hoja.trabajo');
route::post('/sistema/admin/taller/hoja-obtener-trabajo', 'TallerContabilidadController@obtenerHojaTraba')->name('balance.obtenerhoja');

// FIN RUTAS HOJA DE TRABAJO

// RUTAS DEL KARDEX PROMEDIO
route::post('/sistema/admin/taller/kardex-promedio', 'TallerContabilidadController@kardexPromedio')->name('kardex.promedio');
route::post('/sistema/admin/taller/kardex-obtener-promedio', 'TallerContabilidadController@obtenerKardexPromedio')->name('kardex.obtenerkardexpromedio');
//FIN RUTAS DEL KARDEX PROMEDIO



// RUTAS DEL KARDEX PROMEDIO
route::post('/sistema/admin/taller/estado-resultado', 'TallerContabilidadController@estadoResultado')->name('estado.resultado');
route::post('/sistema/admin/taller/estado-obtener-resultado', 'TallerContabilidadController@obtenerEstado')->name('estado.obtenerresultado');
//FIN RUTAS DEL KARDEX PROMEDIO

//// RUTAS DEL KARDEX FIFO
route::post('/sistema/admin/taller/kardex-fifo', 'TallerContabilidadController@kardexFifo')->name('kardex.fifo');
route::post('/sistema/admin/taller/kardex-obtener-fifo', 'TallerContabilidadController@obtenerKardexFifo')->name('kardex.obtenerkardexfifo');
//FIN RUTAS DEL KARDEX FIFO

route::post('/sistema/admin/taller/b_inicial_diario', 'TallerContabilidadController@b_inicial_diario')->name('b_inicial_diario');

//// RUTAS DEL DIARIO
route::post('/sistema/admin/taller/diario', 'TallerContabilidadController@diario')->name('diario');
route::post('/sistema/admin/taller/diariogeneral', 'TallerContabilidadController@obtenerdiario')->name('obtenerdiario');

//// FIN RUTAS DEL DIARIO


/////// RUTAS DEL ASIENTOS DE CIERRE
route::post('/sistema/admin/taller/asiento-cierre', 'TallerContabilidadController@asientosCierre')->name('asiento.cierre');
route::post('/sistema/admin/taller/asiento-cierre-obtener', 'TallerContabilidadController@obtenerAsientoCierre')->name('obtenercierre');

//// FIN RUTAS DEL ASIENTOS DE CIERRE


/////// RUTAS DEL MAYOR
route::post('/sistema/admin/taller/mayor', 'TallerContabilidadController@mayorGeneral')->name('mayor');
route::post('/sistema/admin/taller/mayorgeneral', 'TallerContabilidadController@obtenermayor')->name('obtenermayor');

//// FIN RUTAS DEL DIARIO


/// RUTAS DEL BALANCE GENERAL
route::post('/sistema/admin/taller/balance-general', 'TallerContabilidadController@balanceGeneral')->name('balance-general');
route::post('/sistema/admin/taller/obtener-balance-general', 'TallerContabilidadController@obtenerbalanceGeneral')->name('balance-obtener-general');

//// FIN RUTAS DEL BALANCE GENERAL


route::post('/sistema/admin/taller/obtenerbalance', 'TallerContabilidadController@obtenerbalance')->name('obtenerbalance');

//rutas anexos
route::post('/sistema/admin/taller/anexo_caja', 'TallerContabilidadController@AnexoCaja')->name('anexo_caja');
route::post('/sistema/admin/taller/anexo-obtener-caja', 'TallerContabilidadController@obtenerLibroCaja')->name('anexocaja.obtener');

route::post('/sistema/admin/taller/arqueo_caja', 'TallerContabilidadController@ArqueoCaja')->name('arqueo_caja');
route::post('/sistema/admin/taller/arqueo-obtener-caja', 'TallerContabilidadController@obtenerArqueo')->name('arqueocaja.obtener');

route::post('/sistema/admin/taller/libro_banco', 'TallerContabilidadController@LibroBanco')->name('libro_banco');
route::post('/sistema/admin/taller/libro-obtener-banco', 'TallerContabilidadController@obtenerLbanco')->name('librobanco.obtener');


route::post('/sistema/admin/taller/conciliacion_bancaria', 'TallerContabilidadController@ConciliacionBancaria')->name('conciliacion_bancaria');
route::post('/sistema/admin/taller/conciliacion-obtener-bancaria', 'TallerContabilidadController@ObtenerConciliacionB')->name('conciliacionbancaria.obtener');




route::post('/sistema/admin/taller/retencion_iva', 'TallerContabilidadController@RetencionIva')->name('retencion_iva');
route::post('/sistema/admin/taller/retencion-obtener-iva', 'TallerContabilidadController@ObtenerRetencionIva')->name('retencioniva.obtener');

route::post('/sistema/admin/taller/nomina_empleado', 'TallerContabilidadController@NominaEmpleado')->name('nomina_empleado');
route::post('/sistema/admin/taller/nomina-obtener-empleado', 'TallerContabilidadController@obtenerNomina')->name('nominaempleado.obtener');

route::post('/sistema/admin/taller/provision_social', 'TallerContabilidadController@ProvisionB')->name('provision_social');
route::post('/sistema/admin/taller/provision-obtener-beneficio', 'TallerContabilidadController@ObtenerProvison')->name('provisionbeneficio.obtener');


//MODULOS CONTABLES
route::post('/sistema/admin/modulo/balance-inicial', 'AdminController@balance_inicial')->name('modulo.balance_inicial');
route::post('/sistema/admin/modulo/kardex-fifo', 'AdminController@kardex')->name('modulo.kardex_fifo');
route::post('/sistema/admin/modulo/diario-general', 'AdminController@crearDiario')->name('modulo.diariogeneral');
route::post('/sistema/admin/modulo/mayor-general', 'AdminController@crearMayor')->name('modulo.mayor');
route::post('/sistema/admin/modulo/balance-comprobacion', 'AdminController@crearBalanceCompro')->name('modulo.balancecompro');
route::post('/sistema/admin/modulo/hoja-trabajo', 'AdminController@crearHojaTrabajo')->name('modulo.hojatrabajo');
route::post('/sistema/admin/modulo/balance-comprobacion-ajustado', 'AdminController@crearBalanceAjustado')->name('modulo.balanajustado');
route::post('/sistema/admin/modulo/estado-resultado', 'AdminController@crearEtadoResultado')->name('modulo.estadoresultado');
route::post('/sistema/admin/modulo/balance-general', 'AdminController@crearBalanceGeneral')->name('modulo.balance-general');
route::post('/sistema/admin/modulo/asiento-cierre', 'AdminController@crearAsientosCierre')->name('modulo.asientocierre');
route::post('/sistema/admin/modulo/librocaja', 'AdminController@crearLibroCaja')->name('modulo.librocaja');
route::post('/sistema/admin/modulo/conciliacionbancaria', 'AdminController@crearConciliacion')->name('modulo.conciliacionbancaria');
route::post('/sistema/admin/modulo/arqueocaja', 'AdminController@crearArqueo')->name('modulo.arqueocaja');
route::post('/sistema/admin/modulo/librobanco', 'AdminController@libroBanco')->name('modulo.librobanco');
route::post('/sistema/admin/modulo/retencioniva', 'AdminController@retencionIva')->name('modulo.retencioniva');
route::post('/sistema/admin/modulo/nominaempleados', 'AdminController@crearNomina')->name('modulo.nominaempleados');
route::post('/sistema/admin/modulo/provisiondebeneficio', 'AdminController@crearProvision')->name('modulo.provisiondebeneficio');
route::post('/sistema/admin/modulo/taller-concatenado', 'AdminController@tallerConcatenado')->name('modulo.tallerconcatenado');

route::post('/sistema/admin/modulo/cheque', 'ModuloDocumentoController@cheque')->name('modulo.cheque');
route::post('/sistema/admin/modulo/factura', 'ModuloDocumentoController@factura')->name('modulo.factura');
route::post('/sistema/admin/modulo/nota_credito', 'ModuloDocumentoController@nota_credito')->name('modulo.nota_credito');
route::post('/sistema/admin/modulo/letra-cambio', 'ModuloDocumentoController@letra_cambio')->name('modulo.letra_cambio');
route::post('/sistema/admin/modulo/pagare', 'ModuloDocumentoController@pagare')->name('modulo.pagare');
route::post('/sistema/admin/modulo/papeleta', 'ModuloDocumentoController@papeleta')->name('modulo.papeleta');
route::post('/sistema/admin/modulo/documentos', 'ModuloDocumentoController@documentos')->name('modulo.documentos');
route::post('/sistema/admin/modulo/documento/show', 'ModuloDocumentoController@vista')->name('modulo.vistadocumento');
route::post('/sistema/admin/modulo/documento/edit', 'ModuloDocumentoController@edicion')->name('modulo.editdocument');
route::post('/sistema/admin/modulo/documento/delete', 'ModuloDocumentoController@eliminar')->name('modulo.eliminardocument');
//FIN DE MODULOS CONTABLES
//
//

//MODULOS DOCENTES
route::post('/sistema/admin/docente/balance-obtener-comprobacion', 'TallerContabilidadDocenteController@obtenerBalanceCompro')->name('balance.obtenercomprobacion');

route::post('/sistema/admin/docente/balance-obtener-ajustado', 'TallerContabilidadDocenteController@obtenerBalanceAjustado')->name('balance.obtenerajustado');

route::post('/sistema/admin/docente/hoja-obtener-trabajo', 'TallerContabilidadDocenteController@obtenerHojaTraba')->name('balance.obtenerhoja');

route::post('/sistema/admin/docente/kardex-obtener-promedio', 'TallerContabilidadDocenteController@obtenerKardexPromedio')->name('kardex.obtenerkardexpromedio');

route::post('/sistema/admin/docente/estado-obtener-resultado', 'TallerContabilidadDocenteController@obtenerEstado')->name('estado.obtenerresultado');

route::post('/sistema/admin/docente/kardex-obtener-fifo', 'TallerContabilidadDocenteController@obtenerKardexFifo')->name('kardex.obtenerkardexfifo');

route::post('/sistema/admin/docente/diariogeneral', 'TallerContabilidadDocenteController@obtenerdiario')->name('obtenerdiario');

route::post('/sistema/admin/docente/asiento-cierre-obtener', 'TallerContabilidadDocenteController@obtenerAsientoCierre')->name('obtenercierre');

route::post('/sistema/admin/docente/mayorgeneral', 'TallerContabilidadDocenteController@obtenermayor')->name('obtenermayor');

route::post('/sistema/admin/docente/obtener-balance-general', 'TallerContabilidadDocenteController@obtenerbalanceGeneral')->name('balance-obtener-general');

route::post('/sistema/admin/docente/obtenerbalance', 'TallerContabilidadDocenteController@obtenerbalance')->name('obtenerbalance');
route::post('/sistema/admin/docente/balance-vertical', 'TallerContabilidadDocenteController@balance_vertical')->name('balance_vertical');

route::post('/sistema/admin/docente/anexo-obtener-caja', 'TallerContabilidadDocenteController@obtenerLibroCaja')->name('anexocaja.obtener');

route::post('/sistema/admin/docente/arqueo-obtener-caja', 'TallerContabilidadDocenteController@obtenerArqueo')->name('arqueocaja.obtener');

route::post('/sistema/admin/docente/libro-obtener-banco', 'TallerContabilidadDocenteController@obtenerLbanco')->name('librobanco.obtener');

route::post('/sistema/admin/docente/conciliacion-obtener-bancaria', 'TallerContabilidadDocenteController@ObtenerConciliacionB')->name('conciliacionbancaria.obtener');

route::post('/sistema/admin/docente/retencion-obtener-iva', 'TallerContabilidadDocenteController@ObtenerRetencionIva')->name('retencioniva.obtener');

route::post('/sistema/admin/docente/nomina-obtener-empleado', 'TallerContabilidadDocenteController@obtenerNomina')->name('nominaempleado.obtener');

route::post('/sistema/admin/docente/provision-obtener-beneficio', 'TallerContabilidadDocenteController@ObtenerProvison')->name('provisionbeneficio.obtener');
	

// FIN MODULOS DOCENTES


route::post('/sistema/homedoc/respuesta/taller1/{idtaller}', 'TallerDocenteController@store1')->name('taller1.docente');
route::get('/sistema/admin/create', 'AdminController@admin')->name('admin.create');
route::get('/sistema/admin/leccion', 'AdminController@leccion')->name('leccion.create');
route::post('/sistema/admin', 'AdminController@store')->name('admin');
route::post('/sistema/delete', 'AdminController@delete')->name('delete');
Route::post('/sistema/admin/ramdom','HomeController@ramdom')->name('ramdom');
Route::post('/sistema/admin/leccion','AdminController@crear_leccion')->name('crear_leccion');
// route::get('/sistema/taller33','TallersController@taller33')->name('taller33');
