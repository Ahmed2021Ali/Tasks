<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        \DB::statement("SET SQL_MODE=''");;
        $role_permission = Permission::select('name','id')->groupBy('name')->get();

        $custom_permission = array();

        foreach($role_permission as $per){

            $key = substr($per->name, 0, strpos($per->name, "."));

            if(str_starts_with($per->name, $key)){

                $custom_permission[$key][] = $per;
            }

        }
        return view('premission.index')->with('permissions',$custom_permission);
    }
}
