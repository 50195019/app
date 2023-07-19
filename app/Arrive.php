<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arrive extends Model
{
    use SoftDeletes;
    
    public function product() {
    }

}
