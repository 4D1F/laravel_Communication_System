<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
    public function user_from()
    {
        return $this->belongsTo(user::class, 'from_id', 'id');

    }
    public function user_to()
    {
        return $this->belongsTo(user::class, 'to_id', 'id');

    }
}
