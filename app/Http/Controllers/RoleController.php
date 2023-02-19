<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    function createRole(Request $request)
    {
        $role = Role::create([
            "role_name" => $request->role_name,
        ]);
        if ($role)
        {
            return ['result' => 'success', 'role' => $role];
        } 
        else 
        {
            return ["result" => 'fail'];
        }
        
    }
}
