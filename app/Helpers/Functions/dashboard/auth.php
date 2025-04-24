<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Dashboard\Admin\AdminAttributes;


/* authenticator guard name */
function adminGuardName()
{
    return 'admin';
}



/**
 * Dashboard Auth Info
 */
function adminAuth($get)
{
    if (Auth::guard(adminGuardName())->check()) {
        return auth(adminGuardName())->user()->$get;
    } else {
        return NULL;
    }
}

/**
 * Admin Auth ID
 */
function adminId()
{
    return adminAuth('id');
}





























function canPermission(string $permission)
{
    return auth(adminGuardName())->user()->can($permission);
}

function canRole(string $role)
{
    return auth(adminGuardName())->user()->hasRole($role);
}

function owner()
{
    return 'owner';
}
