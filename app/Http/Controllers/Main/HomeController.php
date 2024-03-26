<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Donation;
use App\Models\Program;
use App\Models\ProgramActivity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $programs = Program::take(4)->latest()->get();
        $counter = [
            'total_programs' => Program::count(),
            'total_fully_funded_programs' => \DB::table('programs')
                ->selectRaw('programs.id, programs.target_fund')
                ->join('donations', 'programs.id', '=', 'donations.program_id')
                ->groupBy('programs.id', 'programs.target_fund')
                ->havingRaw('SUM(donations.amount) >= programs.target_fund')
                ->count(),
            'total_donations' => Donation::count(),
            'total_program_activities' => ProgramActivity::count(),
        ];
        $articles = Article::take(2)->latest()->get();

        // dd($counter);
        return view('main.home', compact('programs', 'counter', 'articles'));
    }
}
