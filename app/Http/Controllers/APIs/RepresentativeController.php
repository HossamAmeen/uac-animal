<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Moderator;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class RepresentativeController extends BackController
{
    public function __construct(Moderator $model)
    {
        $this->model = $model;
    }
  
}
