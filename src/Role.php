<?php 

namespace Alientronics\CachedEloquent;

use Kodeine\Acl\Models\Eloquent\Role as KodeineRole;
use Illuminate\Support\Facades\Auth;

class Role extends KodeineRole {

    /**
     * List all permissions
     *
     * @return mixed
     */
    public function getPermissions()
    {
        return \Cache::remember('permissionById_'.Auth::user()['id'], config('acl.cacheSeconds'),
            function () {
                return $this->getPermissionsInherited();
            }
        );
    }
}
