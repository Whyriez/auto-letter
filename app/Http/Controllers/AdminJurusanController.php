<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use App\Models\LetterTemplate;
use App\Models\LetterTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminJurusanController extends Controller
{
    public function index()
    {
        $totalTemplates = LetterTemplate::count();
        $activeTemplates = LetterTemplate::where('status', 'active')->count();
        $draftTemplates = LetterTemplate::where('status', 'draft')->count();
        $timesUsed = LetterRequests::count();

        // 1) Distribusi status template -> donut
        $rawStatus = LetterTemplate::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();

        $statusList = ['Active', 'Draft', 'Archived'];
        $statusCounts = collect($statusList)->mapWithKeys(fn($s) => [$s => (int)($rawStatus[$s] ?? 0)])->all();

        // 2) Jumlah template per jenis surat -> bar horizontal
        $types = LetterTypes::select('id', 'name')->orderBy('name')->get();
        $rawPerType = LetterTemplate::select('letter_type_id', DB::raw('COUNT(*) as total'))
            ->groupBy('letter_type_id')->pluck('total', 'letter_type_id');

        $typeLabels = $types->pluck('name')->toArray();
        $typeValues = $types->map(fn($t) => (int)($rawPerType[$t->id] ?? 0))->toArray();

        return view('admin.jurusan.index', compact('totalTemplates', 'activeTemplates', 'draftTemplates', 'timesUsed', 'statusCounts', 'typeLabels', 'typeValues'));
    }
}
