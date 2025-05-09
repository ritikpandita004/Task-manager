<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Task extends Model
{

    protected $fillable = [
        'title',       
        'description',  
        'status',
        'due_date',
        'user_id',
    ];
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
