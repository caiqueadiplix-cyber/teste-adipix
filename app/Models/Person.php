<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    // Define quais campos podem ser preenchidos pelo laravel
    protected $fillable = ['name', 'email'];

    // Define o relacionamento muitos para muitos
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'person_task');
    }
}
