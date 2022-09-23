<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    use HasFactory;
    protected $fillable = [ 'role_id','company_id','permission_id','user_id','created_by','updated_by' ];
}
