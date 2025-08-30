<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateSurat extends Controller
{
    public function index()
    {
        return view('admin.jurusan.template-surat');
    }
}
