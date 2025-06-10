<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComplaintType extends Model
{
    //
    protected $fillable = [
        'type'
    ];
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
    
}
