<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;   
use Illuminate\Database\Eloquent\Relations\HasMany;

class Revision extends Model
{
    public function coches(){
        return $this -> BelongsTo(Coche::class, 'id');
    }
}
