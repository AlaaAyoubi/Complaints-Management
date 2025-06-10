<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    //
    protected $fillable =[
            'user_id',
            'complaint_type_id',
            'details'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function complaint_types(): BelongsTo
    {
        return $this->belongsTo(ComplaintType::class);
    }
}
