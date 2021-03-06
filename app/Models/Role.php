<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [ 'title', 'slug', 'status' ];

    public function users(){
        return $this->belongsTo(User::class)->withTimestamps();
    }
}
