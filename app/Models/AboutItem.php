<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "aboutitens";

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
