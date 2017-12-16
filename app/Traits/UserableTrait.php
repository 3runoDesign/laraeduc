<?php

namespace App\Traits;

trait UserableTrait {

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

}


Criando tipos de usuarios