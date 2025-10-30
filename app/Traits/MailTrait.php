<?php

namespace App\Traits;

use App\Mail\BlankEmail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruMailTemplate;
use App\Models\DanaRU\DruDataAttachment;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait MailTrait
{

    public function sendingMail($plan_form_id)
    {
        $plan_form = DruDistributionPlanForm::find($plan_form_id);
        $plan = $plan_form->distribution_plan;
        $mail_template = DruMailTemplate::where('year', $plan->year)->first();
        $file = DruDataAttachment::whereParentId($mail_template->id)->whereTable('mail_template')->first();
        $filepaths = [];
        $filepaths[] = $this->getLampiranA($plan_form_id);
        if($file){
            $mediaItem = $file->getFirstMedia('druDataAttachment');
            $filepath = $mediaItem->getPath();
            $filepaths[] = $filepath;
        }

        $ptj = $plan_form->ptj;
        $pic = $plan_form->pic;
        $members = $plan_form->members;
        $receivers = [trim($pic->email)];
        foreach ($members as $key => $member) {
            $receivers[] = trim($member->email);
        }
        $subject = $ptj->parameter_name . ' - AGIHAN PERUNTUKAN DANA UNIVERSITI PENYELIDIKAN TAHUN '.$plan->year;
        $bcc_email = '';
        $data = [
            'year' => $plan->year,
            'amount' => 'RM '.number_format($plan->amount, 2, '.', ','),
            'filepaths' => $filepaths
        ];
        Mail::to($receivers)->send(new BlankEmail($subject, $data, $bcc_email));
    }

    public function getLampiranA($plan_id)
    {
        DB::statement("SET SQL_MODE=''");
        $form = DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
        ->select([
            'plan.year as plan_year', 'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.updated_at as plan_form_updated_at', 'plan_form.pic_declaration_date as plan_form_declaration_date',
            'mrun.description_1 as mrun_desc', 'bpki.parameter_name as bpki_code',
            'pic.name as pic_name',
            'ptj.description_1 as ptj','ptj.original_code as ptj_code', 'ptj.parameter_name as ptj_short',
            DB::raw('IF(COUNT(DISTINCT member.name) > 1,GROUP_CONCAT(DISTINCT CONCAT("- ", member.name) SEPARATOR "<br>"),GROUP_CONCAT(DISTINCT member.name)) as member_name'),
            DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
            DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
            'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.output','plan_form.outcome','plan_form.notes','plan_form.amount as plan_form_amount',
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
        ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
        ->groupBy('plan_form.id')->where('plan_form.id', $plan_id)->first();

        $filename = 'Q_'.date('d_m_Y');
        $chargeline = 'TIADA';
        $main_dist = str_replace("<br>", '</w:t><w:br/><w:t>', $form->main_kpi_details);
        if($form->ddf_status == "active") {
            $chargeline = 'Q.'. getAppendedPtjCode($form->ptj_code, 7) . '.' . $form->ddf_code . '.' . getProjectSecondCode($form->ddf_code_2);
            $filename = $form->ptj_short. '_'. $form->ddf_title . '_' . $form->plan_year;
        }

        $pdf1 = Pdf::loadView('components.pdf.lampiran-a', compact('form', 'chargeline', 'main_dist'))
                  ->setPaper('a4', 'portrait')->output(); // A4 size
        $pdf2 = Pdf::loadView('components.pdf.lampiran-a-portrait', compact('form', 'chargeline', 'main_dist'))
                ->setPaper('a4', 'landscape')->output();

        $merger = new Merger;
        $merger->addRaw($pdf1);
        $merger->addRaw($pdf2);

        $finalPdf = $merger->merge();

        // 🧩 Save to storage/app/data/pdf/
        Storage::put('data/pdf/' . $filename, $finalPdf);

        File::ensureDirectoryExists(storage_path('/app/data/doc/email'));
        File::cleanDirectory(storage_path('/app/data/doc/email'));
        $filepath = storage_path('app/data/doc/email/'.$filename.'.pdf');
        try{
            Storage::put('data/doc/email/'.$filename.'.pdf', $finalPdf);
        }catch (Exception $e){
            //handle exception2
        }
        return $filepath;
    }
}
