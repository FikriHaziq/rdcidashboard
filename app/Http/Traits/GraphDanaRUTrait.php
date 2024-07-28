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
        $allocation_bar1_year_allocation = [];
        $allocation_bar1_year_additional_allocation = [];
        $allocation_bar1_year_distribution = [];
        $allocation_bar1_year_allocation = [];
        $allocation_bar1_allocation = [];
        $allocation_bar1_year_expenses = [];
        $allocation_bar1_expenses = [];
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
            if($search_params->title) $bpki_amount = $bpki_amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year) $bpki_amount = $bpki_amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $bpki_amount = $bpki_amount->where('year', '<=', $search_params->end_year);
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
            if($search_params->title) $program_amount = $program_amount->where('tabung_induk', $search_params->title);
            if($search_params->start_year) $program_amount = $program_amount->where('year', '>=', $search_params->start_year);
            if($search_params->end_year) $program_amount = $program_amount->where('year', '<=', $search_params->end_year);
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
}
