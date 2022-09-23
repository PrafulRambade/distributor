<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;
    protected $fillable = ['name','module','status','created_by','updated_by'];

    function module_details()
    {
        return $this->belongsTo(Module::class,'module','id');
    }
}
