<?php

namespace SON\Models;

use App\Traits\UserableTrait;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use UserableTrait;


    public function __construct()
    {
        $this->user();
    }
}
