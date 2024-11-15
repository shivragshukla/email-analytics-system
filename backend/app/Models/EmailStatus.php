<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailStatus extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'recipient_email', 'status', 'message_id', 'user_id'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
