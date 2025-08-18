<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use App\Models\LetterTemplate;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    public function index()
    {
        $totalTemplates = LetterTemplate::count();
        $activeTemplates = LetterTemplate::where('status', 'active')->count();
        $draftTemplates = LetterTemplate::where('status', 'draft')->count();
        $timesUsed = LetterRequests::count();
        return view('admin.jurusan.index', compact('totalTemplates', 'activeTemplates', 'draftTemplates', 'timesUsed'));
    }

}
