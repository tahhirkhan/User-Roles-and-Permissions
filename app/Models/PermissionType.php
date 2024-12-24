<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Translation\FileLoader;
use Spatie\Permission\Models\Permission;

class PermissionType extends Model
{
    protected $fillable = ['name'];
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_type');
    }
}
