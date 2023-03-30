<?php

namespace App\Models;

abstract class AppModel extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = ['id'];
}
