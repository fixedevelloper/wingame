<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixtureEvent extends Model
{
    use HasFactory;
    public function fixture() {
        return $this->belongsTo(Fixture::class, 'lt_fixture_id', 'id');
    }
}
