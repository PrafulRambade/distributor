<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserrolePermission extends Model
{
    use HasFactory;
    protected $fillable = [ 'role_id','permission_id','created_by','updated_by' ];
}
