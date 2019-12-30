<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Moderator;
use App\Http\Controllers\BackController;
use App\Http\Controllers\Controller;

class RepresentativeController extends BackController
{
    public function __construct(Moderator $model)
    {
        $this->model = $model;
    }
    
    protected function filter($rows)
    {
        return $rows->where('trash' , 0);
    }
  
}
