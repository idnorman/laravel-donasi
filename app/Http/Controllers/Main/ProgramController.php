<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function list()
    {
        $programs = Program::latest()->paginate(6);
        return view('main.program.list', compact('programs'));
    }

    public function detail(Program $program)
    {

        $programActivities = $program->programActivities()->latest()->paginate(5, ['*'], 'kegiatan-terbaru');
        $donations = $program->donations()->where('payment_status', 2)->latest()->paginate(5, ['*'], 'donasi-terbaru');
        return view('main.program.detail', compact('program', 'donations', 'programActivities'));
    }
}
