<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserContract
{

    /**
     * @param $data
     * @return Model
     */
    public function store($data): Model;

}
