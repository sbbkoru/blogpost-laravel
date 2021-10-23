<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke()
    {
        return 'Its single page.'; // DİREKT ÇALIŞAN FONKSİYON
    }
}
