<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coche extends Model
{

    public function client(){
        return $this-> BelongsTo(Client::class, 'id');
    }
    public function revisiones(){
        return $this-> HasMany(Revision::class, 'id');
    }
}
