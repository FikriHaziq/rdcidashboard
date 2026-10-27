<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\DB;
use App\Models\MasterList\MasterlistDruAllocation;
use App\Models\MasterList\MasterlistDruExpenses;

trait GraphDanaRUTrait {

    public function tncpiOverall($search_params) {
        $allocations = [];
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['b.code as bpki', 'p.code as program', 'dmf.name as jenis_agihan', 'dmf.code as tabung_induk'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->leftJoin('parameters AS p', function ($join){
            $join->on('p.id', '=', 'mda.program_id');
        })
        ->leftJoin('parameters AS b', function ($join){
            $join->on('b.id', '=', 'mda.bpki_id');
        })
        ->whereNotNull('p.id')->groupBy('dmf.code');
        if($search_params->title) $title_options = $title_options->where('dmf.code', $search_params->title);
        if($search_params->start_year) $title_options = $title_options->where('mda.year', '>=', $search_params->start_year);
        if($search_params->end_year) $title_options = $title_options->where('mda.year', '<=', $search_params->end_year);
        $title_options = $title_options->get();
        foreach ($title_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk);
            if($search_params->start_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $amount = $amount->where('year', '<=', $search_params->end_year);
            $amount = $amount->sum('amount');
            array_push($allocations, [
                'bpki'=> $options->bpki,
                'program'=> $options->program,
                'tabung_induk'=> $options->tabung_induk,
                'jenis_agihan'=> $options->jenis_agihan,
                'amount'=> $amount,
            ]);
        }
        usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        $allocation_bar1_year = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.year'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->orderBy('mda.year')->distinct()->pluck('year')->toArray();
        if($search_params->start_year && $search_params->end_year) {
            $allocation_bar1_year = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.year'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })
            ->where('mda.year', '>=', $search_params->start_year)->where('mda.year', '<=', $search_params->end_year)->orderBy('mda.year')->distinct()->pluck('year')->toArray();
        }
        else if($search_params->start_year) {
            $allocation_bar1_year = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.year'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })
            ->where('mda.year', '>=', $search_params->start_year)->orderBy('mda.year')->distinct()->pluck('year')->toArray();
        }
        else if($search_params->end_year) {
            $allocation_bar1_year = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.year'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })
            ->where('mda.year', '<=', $search_params->end_year)->orderBy('mda.year')->distinct()->pluck('year')->toArray();
        }
        else {
            $allocation_bar1_year = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.year'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })
            ->orderBy('mda.year')->distinct()->pluck('year')->toArray();
        }
        $allocation_bar1_title = [];
        $allocation_bar1_year_allocation_cumulative = [];
        $allocation_bar1_year_allocation = [];
        $allocation_bar1_year_additional_allocation = [];
        $allocation_bar1_year_distribution = [];
        $allocation_bar1_year_allocation = [];
        $allocation_bar1_allocation = [];
        $allocation_bar1_year_expenses = [];
        $allocation_bar1_expenses = [];
        $allocation_cumulative = 0;
        foreach ($allocation_bar1_year as $key => $year) {
            $allocation = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->where('mda.type', 1)->where('mda.year',$year);
            $additional_allocation = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->where('mda.type', 2)->where('mda.year',$year);
            $distribution = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->where('mda.type', 3)->where('mda.year',$year);
            $expense = DB::table('masterlist_dru_expenses as mde')
            ->select(['mde.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mde.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->where('mde.year',$year);

            if($search_params->title){
                $allocation = $allocation->where('dmf.code', $search_params->title);
                $additional_allocation = $additional_allocation->where('dmf.code', $search_params->title);
                $distribution = $distribution->where('dmf.code', $search_params->title);
                $expense = $expense->where('dmf.code', $search_params->title);
            }
            $allocation = $allocation->sum('amount');
            $additional_allocation = $additional_allocation->sum('amount');
            $distribution = $distribution->sum('amount');
            $expense = $expense->sum('amount');
            if ($key == 0)$allocation_cumulative += $additional_allocation + $allocation;
            else $allocation_cumulative += $additional_allocation + $allocation - $expense;

            

            array_push($allocation_bar1_year_allocation_cumulative, (float)$allocation_cumulative);
            array_push($allocation_bar1_year_allocation, (float)$allocation);
            array_push($allocation_bar1_year_additional_allocation, (float)$additional_allocation);
            array_push($allocation_bar1_year_distribution, (float)$distribution);
            array_push($allocation_bar1_year_expenses, (float)$expense);
        }
        foreach ($allocations as $key => $allocation) {
            if($key < 20){
                array_push($allocation_bar1_title, $allocation['jenis_agihan']);
                array_push($allocation_bar1_allocation, (float)$allocation['amount']);
                array_push($allocation_bar1_expenses, (float)$allocation['amount']);
            }
        }

        return [
            "allocations"=>$allocations,
            "bar1_year"=>$allocation_bar1_year,
            "bar1_year_allocation_cumulative"=>$allocation_bar1_year_allocation_cumulative,
            "bar1_year_allocation"=>$allocation_bar1_year_allocation,
            "bar1_year_additional_allocation"=>$allocation_bar1_year_additional_allocation,
            "bar1_year_distribution"=>$allocation_bar1_year_distribution,
            "bar1_year_expenses"=>$allocation_bar1_year_expenses,
            "bar1_title"=>$allocation_bar1_title,
            "bar1_allocation"=>$allocation_bar1_allocation,
            "bar1_expenses"=>$allocation_bar1_expenses,
        ];
    }

    public function bpkiProgram($total_allocation, $search_params) {
        $bpki_titles_options = DB::table('parameters as p')
        ->select(['p.id', 'p.parameter_name'])
        ->where('p.group_id', 4)->get();
        $program_titles_options = DB::table('parameters as p')
        ->select(['p.id', 'p.parameter_name'])
        ->where('p.group_id', 3)->get();
        $bpki_titles = [];
        $bpki_amounts = [];
        $bpki_cumulative = [];
        $program_titles = [];
        $program_amounts = [];
        $program_cumulative = [];
        $cumulative = 0;
        foreach ($bpki_titles_options as $key => $title) {
            $bpki_amount = MasterlistDruAllocation::select(['amount'])->where('bpki_id',$title->id);
            if($search_params->title ?? false) $bpki_amount = $bpki_amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year ?? false) $bpki_amount = $bpki_amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year ?? false) $bpki_amount = $bpki_amount->where('year', '<=', $search_params->end_year);
            if($search_params->faculty_code ?? false) $bpki_amount = $bpki_amount->where('ptj_code', $search_params->faculty_code);
            $bpki_amount = $bpki_amount->sum('amount');
            array_push($bpki_titles, $title->parameter_name);
            array_push($bpki_amounts, (float)$bpki_amount);
        }
        usort($bpki_amounts, function($a, $b) {return $a < $b;});
        // dd($bpki_amounts);
        foreach ($bpki_amounts as $key => $amount) {
            $cumulative += $amount; 
            array_push($bpki_cumulative, (float)round($total_allocation > 0?$cumulative/$total_allocation*100 : 0));
        }
        $cumulative = 0;
        foreach ($program_titles_options as $key => $title) {
            $program_amount = MasterlistDruAllocation::select(['amount'])->where('program_id',$title->id);
            if($search_params->title ?? false) $program_amount = $program_amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year ?? false) $program_amount = $program_amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year ?? false) $program_amount = $program_amount->where('year', '<=', $search_params->end_year);
            if($search_params->faculty_code ?? false) $program_amount = $program_amount->where('ptj_code', $search_params->faculty_code);
            $program_amount = $program_amount->sum('amount');
            array_push($program_titles, $title->parameter_name);
            array_push($program_amounts, (float)$program_amount);
        }
        usort($program_amounts, function($a, $b) {return $a < $b;});
        foreach ($program_amounts as $key => $amount) {
            $cumulative += $amount; 
            array_push($program_cumulative, (float)round($total_allocation > 0?$cumulative/$total_allocation*100 : 0));
        }
        $allocations = [];
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['b.code as bpki', 'p.code as program', 'dmf.name as jenis_agihan', 'dmf.code as tabung_induk'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->leftJoin('parameters AS p', function ($join){
            $join->on('p.id', '=', 'mda.program_id');
        })
        ->leftJoin('parameters AS b', function ($join){
            $join->on('b.id', '=', 'mda.bpki_id');
        })
        ->whereNotNull('p.id')->groupBy('dmf.code');
        if($search_params->title ?? false) $title_options = $title_options->where('dmf.code', $search_params->title);
        if($search_params->start_year ?? false) $title_options = $title_options->where('mda.year', '>=', $search_params->start_year);
        if($search_params->end_year ?? false) $title_options = $title_options->where('mda.year', '<=', $search_params->end_year);
        if($search_params->faculty_code ?? false) $title_options = $title_options->where('mda.ptj_code', $search_params->faculty_code);
        $title_options = $title_options->get();
        foreach ($title_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk);
            if($search_params->start_year ?? false) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year ?? false) $amount = $amount->where('year', '<=', $search_params->end_year);
            if($search_params->faculty_code ?? false) $amount = $amount->where('ptj_code', $search_params->faculty_code);
            $amount = $amount->sum('amount');
            array_push($allocations, [
                'bpki'=> $options->bpki,
                'program'=> $options->program,
                'tabung_induk'=> $options->tabung_induk,
                'jenis_agihan'=> $options->jenis_agihan,
                'amount'=> $amount,
            ]);
        }
        usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        $allocation_pie_title = [];
        $allocation_pie_allocation = [];
        $allocation_pie_expenses = [];
        foreach ($allocations as $key => $allocation) {
            if($key < 20){
                array_push($allocation_pie_title, $allocation['jenis_agihan']);
                array_push($allocation_pie_allocation, (float)$allocation['amount']);
                array_push($allocation_pie_expenses, (float)$allocation['amount']);
            }
        }
        // dd($allocations);
        return [
            "bar1_title" => $bpki_titles,
            "bar1_amount" => $bpki_amounts,
            "bar1_cumulative" => $bpki_cumulative,
            "bar2_title" => $program_titles,
            "bar2_amount" => $program_amounts,
            "bar2_cumulative" => $program_cumulative,
            "allocations"=>$allocations,
            "pie_title"=>$allocation_pie_title,
            "pie_expenses"=>$allocation_pie_expenses,
        ];
    }

    public function ptj($total_allocation, $search_params) {
        $bar1_title_options = DB::table('masterlist_dru_allocations AS mda')
        ->select([
            'f.original_code', 'f.parameter_name as ptj'
        ])
        ->join('parameters AS f', function ($join){
            $join->on('f.original_code', '=', 'mda.ptj_code');
        })->distinct()->get();
        $titles = [];
        $amounts = [];
        $cumulative = [];
        $cumulative_no = 0;
        foreach ($bar1_title_options as $key => $title) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('ptj_code',$title->original_code);
            if($search_params->title) $amount = $amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $amount = $amount->where('year', '<=', $search_params->end_year);
            if($search_params->faculty_code) $amount = $amount->where('ptj_code', $search_params->faculty_code);
            $amount = $amount->sum('amount');
            array_push($titles, $title->ptj);
            array_push($amounts, (float)$amount);
        }
        usort($amounts, function($a, $b) {return $a < $b;});
        foreach ($amounts as $key => $amount) {
            $cumulative_no += $amount; 
            array_push($cumulative, (float)number_format($cumulative_no/$total_allocation*100, 2));
        }
        
        $allocations = [];
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['b.code as bpki', 'p.code as program', 'dmf.name as jenis_agihan', 'dmf.code as tabung_induk'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->leftJoin('parameters AS p', function ($join){
            $join->on('p.id', '=', 'mda.program_id');
        })
        ->leftJoin('parameters AS b', function ($join){
            $join->on('b.id', '=', 'mda.bpki_id');
        })
        ->whereNotNull('p.id')->groupBy('dmf.code');
        if($search_params->title) $title_options = $title_options->where('dmf.code', $search_params->title);
        $title_options = $title_options->get();
        foreach ($title_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk);
            if($search_params->start_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->faculty_code) $amount = $amount->where('ptj_code', $search_params->faculty_code);
            $amount = $amount->sum('amount');
            array_push($allocations, [
                'bpki'=> $options->bpki,
                'program'=> $options->program,
                'tabung_induk'=> $options->tabung_induk,
                'jenis_agihan'=> $options->jenis_agihan,
                'amount'=> $amount,
            ]);
        }
        usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        $allocation_pie_title = [];
        $allocation_pie_allocation = [];
        $allocation_pie_expenses = [];
        foreach ($allocations as $key => $allocation) {
            if($key < 20){
                array_push($allocation_pie_title, $allocation['jenis_agihan']);
                array_push($allocation_pie_allocation, (float)$allocation['amount']);
                array_push($allocation_pie_expenses, (float)$allocation['amount']);
            }
        }

        return [
            "bar1_title" => $titles,
            "bar1_amount" => $amounts,
            "bar1_cumulative" => $cumulative,
            "allocations"=>$allocations,
            "pie_title"=>$allocation_pie_title,
            "pie_expenses"=>$allocation_pie_expenses,
        ];
    }

    public function project($search_params) {
        $allocations = [];
        $titles = [];
        $amounts = [];
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['b.code as bpki', 'p.code as program', 'dmf.name as jenis_agihan', 'dmf.code as tabung_induk'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->leftJoin('parameters AS p', function ($join){
            $join->on('p.id', '=', 'mda.program_id');
        })
        ->leftJoin('parameters AS b', function ($join){
            $join->on('b.id', '=', 'mda.bpki_id');
        })
        ->whereNotNull('p.id')->groupBy('dmf.code');
        if($search_params->title) $title_options = $title_options->where('dmf.code', $search_params->title);
        if($search_params->start_year) $title_options = $title_options->where('mda.year', '>=', $search_params->start_year);
        if($search_params->end_year) $title_options = $title_options->where('mda.year', '<=', $search_params->end_year);
        $title_options = $title_options->get();
        foreach ($title_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk);
            if($search_params->title) $amount = $amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $amount = $amount->where('year', '<=', $search_params->end_year);
            $amount = $amount->sum('amount');
            array_push($allocations, [
                'bpki'=> $options->bpki,
                'program'=> $options->program,
                'tabung_induk'=> $options->tabung_induk,
                'jenis_agihan'=> $options->jenis_agihan,
                'amount'=> $amount,
            ]);
            array_push($titles, $options->jenis_agihan);
            array_push($amounts, (float)$amount);
        }
        usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        $allocation_pie_title = [];
        $allocation_pie_allocation = [];
        $allocation_pie_expenses = [];
        foreach ($allocations as $key => $allocation) {
            if($key < 20){
                array_push($allocation_pie_title, $allocation['jenis_agihan']);
                array_push($allocation_pie_allocation, (float)$allocation['amount']);
                array_push($allocation_pie_expenses, (float)$allocation['amount']);
            }
        }

        return [
            "bar1_title" => $titles,
            "bar1_amount" => $amounts,
            "allocations"=>$allocations,
            "pie_title"=>$allocation_pie_title,
            "pie_expenses"=>$allocation_pie_expenses,
        ];
    }

    public function sodo($search_params) {
        $titles_options = DB::table('masterlist_dru_expenses as dme')
        ->select(['dme.sodo_short as sodo'])
        ->orderBy('dme.sodo_short')->groupBy('dme.sodo_short')->get();
        $titles = [];
        $amounts = [];
        foreach ($titles_options as $key => $title) {
            $amount = MasterlistDruExpenses::select(['amount'])->where('sodo_short',$title->sodo);
            if($search_params->title) $amount = $amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $amount = $amount->where('year', '<=', $search_params->end_year);
            $amount = $amount->sum('amount');
            array_push($titles, $title->sodo);
            array_push($amounts, (float)$amount);
        }
        $allocations = [];
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['b.code as bpki', 'p.code as program', 'dmf.name as jenis_agihan', 'dmf.code as tabung_induk'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->leftJoin('parameters AS p', function ($join){
            $join->on('p.id', '=', 'mda.program_id');
        })
        ->leftJoin('parameters AS b', function ($join){
            $join->on('b.id', '=', 'mda.bpki_id');
        })
        ->whereNotNull('p.id')->groupBy('dmf.code');
        if($search_params->title) $title_options = $title_options->where('dmf.code', $search_params->title);
        if($search_params->start_year) $title_options = $title_options->where('mda.year', '>=', $search_params->start_year);
        if($search_params->end_year) $title_options = $title_options->where('mda.year', '<=', $search_params->end_year);
        $title_options = $title_options->get();
        foreach ($title_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk);
            if($search_params->start_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $amount = $amount->where('year', '>=', $search_params->start_year);
            $amount = $amount->sum('amount');
            array_push($allocations, [
                'bpki'=> $options->bpki,
                'program'=> $options->program,
                'tabung_induk'=> $options->tabung_induk,
                'jenis_agihan'=> $options->jenis_agihan,
                'amount'=> $amount,
            ]);
        }
        usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        $allocation_pie_title = [];
        $allocation_pie_allocation = [];
        $allocation_pie_expenses = [];
        foreach ($allocations as $key => $allocation) {
            if($key < 20){
                array_push($allocation_pie_title, $allocation['jenis_agihan']);
                array_push($allocation_pie_allocation, (float)$allocation['amount']);
                array_push($allocation_pie_expenses, (float)$allocation['amount']);
            }
        }

        return [
            "bar1_title" => $titles,
            "bar1_amount" => $amounts,
            "allocations"=>$allocations,
            "pie_title"=>$allocation_pie_title,
            "pie_expenses"=>$allocation_pie_expenses,
        ];
    }

    // RU Fund Dashboard (BPKI / MRUN) from masterlist_dru_allocations
    // $column : 'bpki_id' or 'program_id'
    // $components : parameters (getBpkiList() / getMrunList())
    public function allocationDashboard($column, $components, $year_from, $year_to) {
        // Transfer rows (type 4/5) may have no BPKI/MRUN, inherit from another row with the same project
        $component_sql = "COALESCE(NULLIF(mda.".$column.", 0), (SELECT x.".$column." FROM masterlist_dru_allocations x WHERE x.project = mda.project AND x.".$column." > 0 LIMIT 1)) AS component_id";
        $rows = DB::table('masterlist_dru_allocations AS mda')
            ->select('mda.year', 'mda.type', 'mda.ptj', 'mda.jenis_agihan', 'mda.amount', DB::raw($component_sql))
            ->whereBetween('mda.year', [$year_from, $year_to])
            ->get();

        // All types are summed (net), but only Agihan Utama/Tambahan/Semula rows count as programmes
        $programmes = $rows->whereIn('type', [1, 2, 3]);
        $years = range($year_from, $year_to);
        $grand_total = (float)$rows->sum('amount');
        $grand_count = $programmes->count();

        $year_total = [];
        foreach ($years as $year) {
            $year_total[$year] = (float)$rows->where('year', $year)->sum('amount');
        }

        $total_by_year = [
            'bar' => array_map(function($year) use ($programmes) { return $programmes->where('year', $year)->count(); }, $years),
            'line' => array_map(function($year) use ($year_total) { return round($year_total[$year], 2); }, $years),
        ];

        $cards = [];
        $trends = [];
        $composition = [];
        $variance = [];
        foreach ($components as $component) {
            $component_rows = $rows->where('component_id', $component->id);
            $component_programmes = $programmes->where('component_id', $component->id);
            $total = (float)$component_rows->sum('amount');
            $count = $component_programmes->count();

            $cards[$component->code] = [
                'total_allocation' => $total,
                'total_programmes' => $count,
                'allocation_share' => $grand_total != 0 ? $total / $grand_total * 100 : 0,
                'avg_allocation_programme' => $count > 0 ? $total / $count : 0,
                'programmes_share' => $grand_count > 0 ? $count / $grand_count * 100 : 0,
            ];

            $trend_bar = [];
            $trend_line = [];
            $composition_data = [];
            $variance_data = [];
            foreach ($years as $year) {
                $amount = (float)$component_rows->where('year', $year)->sum('amount');
                $percent = $year_total[$year] != 0 ? $amount / $year_total[$year] * 100 : 0;
                $trend_bar[] = $component_programmes->where('year', $year)->count();
                $trend_line[] = round($amount, 2);
                // Years with no net allocation are left empty instead of 0%
                $composition_data[] = $year_total[$year] != 0 ? round($percent, 2) : null;
                $variance_data[] = $year_total[$year] != 0 ? round($percent - (float)$component->description_2, 1) : null;
            }
            $trends[$component->code] = ['bar' => $trend_bar, 'line' => $trend_line];
            $composition[] = [
                'name' => $component->code.($component->description_2 ? ' (Target '.$component->description_2.'%)' : ''),
                'data' => $composition_data,
            ];
            if($component->description_2){
                $variance[] = ['name' => $component->code.' Variance (pp)', 'data' => $variance_data];
            }
        }

        $top_programmes = $rows->groupBy('jenis_agihan')->map(function($items) { return (float)$items->sum('amount'); })->sortDesc()->take(10);
        $top_ptj = $rows->groupBy('ptj')->map(function($items) { return (float)$items->sum('amount'); })->sortDesc()->take(10);

        return [
            'years' => $years,
            'cards' => $cards,
            'total_by_year' => $total_by_year,
            'composition' => $composition,
            'variance' => $variance,
            'trends' => $trends,
            'top_programmes' => [
                'categories' => $top_programmes->keys()->map(function($name) { return strtoupper($name); })->values(),
                'values' => [['name' => 'Allocation (RM)', 'data' => $top_programmes->values()->map(function($amount) { return round($amount, 2); })]],
            ],
            'top_ptj' => [
                'categories' => $top_ptj->keys()->values(),
                'values' => [['name' => 'Allocation (RM)', 'data' => $top_ptj->values()->map(function($amount) { return round($amount, 2); })]],
            ],
        ];
    }
}
