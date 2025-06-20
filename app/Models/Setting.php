<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['site_name','email','favicon','logo','facebook','instagram','X','youtube','linkedin','street','city','phone','country'];
}
