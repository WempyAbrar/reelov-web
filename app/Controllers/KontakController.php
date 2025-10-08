<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use function PHPUnit\Framework\returnArgument;

class KontakController extends BaseController
{
    public function index() 
    {
        return view('v_kontak');
    }

}