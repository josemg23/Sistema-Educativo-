<?php

namespace App\Http\Controllers\Controladores;

use App\Modelos\Role;
use App\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Gate::authorize('haveaccess', 'rol.index');

        $roles= Role::orderBy('id','Asc')->paginate(5);
    
        return view('Roles.indexr',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      // Gate::authorize('haveaccess', 'rol.create');
        /// añadido la linea de permision y el compact
     $permissions =Permission::get();

        return view('Roles.createroler', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Gate::authorize('haveaccess', 'rol.store');
        
        $request->validate([
        
            'name' => [ 'string', 'max:50','unique:roles,name'],
            'descripcion' => [ 'string', 'max:50','unique:roles,descripcion'],
            'full-access'   => 'required|in:yes,no',
            'estado' => ['required' ,'in:on,off'],

        ]);


        $role = Role::create($request->all());
    
        if ($request->get('permission')) {
           

            $role->permissions()->sync($request->get('permission'));
        }
        return redirect ('sistema/iniciorole '); // en el accion tenemos el index ya que de aqui nos redireccion al index 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modelos\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
      //  Gate::authorize('haveaccess', 'rol.show');
        $permission_role=[];
    
        foreach($role->permissions as $permission){
            $permission_role[]=$permission->id;
   
        }
                  $permissions=Permission::get();
       
             
       
       
        return \view('Roles.showr', compact('permissions', 'role','permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modelos\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
       // Gate::authorize('haveaccess', 'rol.edit');
     $permission_role=[];
    
     foreach($role->permissions as $permission){
         $permission_role[]=$permission->id;

     }
    
        $permissions=Permission::get();
       return view('Roles.editr', compact('permissions', 'role','permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modelos\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //Gate::authorize('haveaccess', 'rol.update');
        $request->validate([
        
            'name' => [ 'string', 'max:50','unique:roles,name,' .$role->id,],
            'descripcion' => [ 'string', 'max:50','unique:roles,descripcion,' .$role->id,],
            'full-access'   =>  ['required' ,'in:yes,no'],
            'estado' => ['required' ,'in:on,off'],


        ]);
        
        $role->update($request->all());
    
        //if ($request->get('permission')) {
             $role->permissions()->sync($request->get('permission')); //solo quite la validacion por caso de si tiene o no permiso
        //}

        return redirect ('sistema/iniciorole ')->with('success','Rol Actualizado con Exito'); // en el accion tenemos el index ya que de aqui nos redireccion al index 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modelos\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Gate::authorize('haveaccess', 'rol.destroy');
        $user= Role::find($id);
        $user->delete();

        return redirect('sistema/iniciorole')->with('success','Haz eliminado un rol con exito');
    }
}