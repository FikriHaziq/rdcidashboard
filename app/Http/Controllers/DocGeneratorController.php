<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\DanaRU\DruDistributionPlanForm;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DocGeneratorController extends Controller
{
    public function LampiranA($plan_id)
    {
        DB::statement("SET SQL_MODE=''");
        $form = DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
        ->select([
            'plan.year as plan_year', 'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.updated_at as plan_form_updated_at', 'plan_form.pic_declaration_date as plan_form_declaration_date',
            'mrun.description_1 as mrun_desc', 'bpki.parameter_name as bpki_code',
            'pic.name as pic_name', 'member.name as member_name',
            'ptj.description_1 as ptj','ptj.original_code as ptj_code',
            DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
            DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
            'pro.status as pro_status','pro.code as pro_code','pro.title as pro_title','pro.code_2 as pro_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
        ])
        ->join('dru_distribution_plans as plan', function ($join) {
            $join->on('plan.id', '=', 'plan_form.distribution_plan_id');
        })
        ->join('parameters as mrun', function ($join) {
            $join->on('mrun.id', '=', 'plan_form.mrun')
                ->where('mrun.active','Y');
        })
        ->join('parameters as bpki', function ($join) {
            $join->on('bpki.id', '=', 'plan_form.bpki')
                ->where('bpki.active','Y');
        })
        ->join('parameters as ptj', function ($join) {
            $join->on('ptj.id', '=', 'plan_form.ptj_id')
                ->where('ptj.active','Y');
        })
        ->join('dru_members as pic', function ($join) {
            $join->on('pic.distribution_plan_form_id', '=', 'plan_form.id')->where('pic.type','leader');
        })
        ->leftjoin('dru_members as member', function ($join) {
            $join->on('member.distribution_plan_form_id', '=', 'plan_form.id')->where('member.type','member');
        })
        ->leftjoin('dru_kpis as main_kpi', function ($join) {
            $join->on('main_kpi.distribution_plan_form_id', '=', 'plan_form.id')
            ->where('main_kpi.type','main')->where('main_kpi.status','active');
        })
        ->leftjoin('dru_kpi_templates as main_kpi_template', function ($join) {
            $join->on('main_kpi_template.id', '=', 'main_kpi.kpi_template_id')
            ->where('main_kpi_template.active','Y');
        })
        ->leftjoin('dru_kpis as kpi', function ($join) {
            $join->on('kpi.distribution_plan_form_id', '=', 'plan_form.id')
            ->where('kpi.type','kpi')->where('kpi.status','active');
        })
        ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
            $join->on('kpi_template.id', '=', 'kpi.kpi_template_id')
            ->where('kpi_template.active','Y');
        })
        ->join('dru_projects as pro','pro.id', '=', 'plan_form.project_id')
        ->groupBy('plan_form.id')->where('plan_form.id', $plan_id)->first();

        $filename = 'Q_'.date('d_m_Y');
        $chargeline = 'TIADA';
        $main_dist = str_replace("<br>", '</w:t><w:br/><w:t>', $form->main_kpi_details);
        if($form->pro_status == "active") {
            $chargeline = 'Q.'. getAppendedPtjCode($form->ptj_code, 7) . '.' . $form->pro_code . '.' . getProjectSecondCode($form->pro_code_2);
            $filename = 'Q_'. getAppendedPtjCode($form->ptj_code, 7) . '_' . $form->pro_code . '_' . getProjectSecondCode($form->pro_code_2).'_'.date('d_m_Y');
        }

        $templateProcessor = new TemplateProcessor('wordTemplate/lampiran_a_template.docx');
        $templateProcessor->setValue("ptj_pic", $form->ptj);
        $templateProcessor->setValue("mrun", $form->mrun_desc);
        $templateProcessor->setValue("project", $form->pro_title);
        $templateProcessor->setValue("chargeline", $chargeline);
        $templateProcessor->setValue("ref_no", $form->plan_form_ref_no);
        $templateProcessor->setValue("amount", number_format($form->plan_form_amount, 2, '.', ','));
        $templateProcessor->setValue("main_dist", $main_dist);
        $templateProcessor->setValue("pic_name", $form->pic_name);
        $templateProcessor->setValue("member_name", $form->member_name);
        $templateProcessor->setValue("year", $form->plan_year);
        $templateProcessor->setValue("updated_at", $form->plan_form_declaration_date ? date('j/n/Y', strtotime($form->plan_form_declaration_date)): '');

        File::ensureDirectoryExists(storage_path('/app/data/doc'));
        File::cleanDirectory(storage_path('/app/data/doc'));

        try{
            $templateProcessor->saveAs(storage_path('app/data/doc/'.$filename.'.docx'));
        }catch (Exception $e){
            //handle exception2
        }
        return response()->download(storage_path('app/data/doc/'.$filename.'.docx'));
    }
}
