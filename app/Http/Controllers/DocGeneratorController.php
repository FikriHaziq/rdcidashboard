<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\ListItem;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\Parameter;
use App\Models\DocTemplate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Purifier;

class DocGeneratorController extends Controller
{
    public function KertasKerja($plan_id)
    {
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $plan = DruDistributionPlan::find($plan_id);
        // Create a new PHPWord instance
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Quattrocento Sans');
        $phpWord->setDefaultFontSize(11);
        // Add a section to the document
        $section1 = $phpWord->addSection([
            'orientation' => 'portrait',
            'paperSize' => 'A4',
            'pageSizeW' => Converter::cmToTwip(21.0), // A4 width
            'pageSizeH' => Converter::cmToTwip(29.7), // A4 height
            'marginLeft' => Converter::cmToTwip(2),
            'marginRight' => Converter::cmToTwip(2),
            'marginTop' => Converter::cmToTwip(2),
            'marginBottom' => Converter::cmToTwip(2),
        ]);

        // Define font style
        $quat_10_b = ['size' => 10,'bold' => true];
        $quat_11_b = ['size' => 11,'bold' => true];
        $quat_11_b_w = ['size' => 11,'bold' => true, 'color' => 'FFFFFF'];
        $quat_11 = ['size' => 11];
        $quat_11_b_u = ['size' => 11,'bold' => true, 'underline' => 'single'];
        $quat_11_i = ['size' => 11, 'italic' => true];

        $title_center = [
            'indentation' => [
                'left' => Converter::cmToTwip(3),  // 2 cm left margin
                'right' => Converter::cmToTwip(3)  // 2 cm right margin
            ],
            'alignment' => 'center'  // Center-align the text
        ];
        // Add a header to the section
        $header = $section1->addHeader();
        // Create a table in the header with left and right aligned text
        $headerTable = $header->addTable();
        $headerTable->addRow();
        $headerTable->addCell(6000)->addText('SULIT', $quat_10_b);
        $headerTable->addCell(6000)->addText('KERTAS KERJA UTM/JPU/       /2023', $quat_10_b, ['align' => 'right']);
        $header->addTextBreak();
        // Add text elements
        $section1->addText('UNIVERSITI TEKNOLOGI MALAYSIA',$quat_11_b, $title_center);
        $section1->addText('KERTAS KERJA UNTUK KELULUSAN MESYUARAT JAWATANKUASA PENGURUSAN UNIVERSITI',$quat_11_b, $title_center);
        $section1->addText('CADANGAN AGIHAN PERUNTUKAN BAHARU DANA UNIVERSITI PENYELIDIKAN TAHUN '. $plan->year .' DAN AGIHAN SEMULA BAKI DANA RU (BAJET Q)',$quat_11_b, $title_center);
        $section1->addText('RINGKASAN EKSEKUTIF',$quat_11_b_u, $title_center);
        
        $fullWidth = Converter::cmToTwip(21) - Converter::cmToTwip(4);
        $table_1_width = 500;
        $table_2_width = 3000;
        $tableStyle = [
            'borderSize' => 4,
            'borderColor' => '999999',
            'cellMargin' => 80,
            'width' => $fullWidth
        ];
        $phpWord->addTableStyle('Summary', $tableStyle);

        // Define header cell style with background color
        $headerCellStyle = [
            'bgColor' => 'BEBEBE',
            'valign' => 'center'
        ];

        // Add table to the section
        $table = $section1->addTable('Summary');

        // Add header row with colored background
        $table->addRow();
        $table->addCell($table_1_width, $headerCellStyle)->addText('NO', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table->addCell($table_2_width, $headerCellStyle)->addText('PERKARA', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table->addCell($fullWidth - $table_1_width - $table_2_width, $headerCellStyle)->addText('CATATAN', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);

        $items = DocTemplate::whereParentId($plan_id)->orderBy('order')->get();

        $tujuan = $items->where('type', 'tujuan')->first();
        $table->addRow();
        $table->addCell($table_1_width, ['valign' => 'center'])->addText("1.", $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
        $table->addCell($table_2_width, ['valign' => 'center'])->addText("Tujuan Kertas Kerja", $quat_11, ['spaceAfter' => 0]);
        $contentCell = $table->addCell($fullWidth - $table_1_width - $table_2_width);
        if($tujuan)
        {
            $tujuanContent = str_replace('{{year}}', $plan->year, $tujuan->value);
            $tujuanContent = str_replace('<br>', '<br />', $tujuanContent);
            Html::addHtml($contentCell, $tujuanContent, false, false);
        }

        $latarBelakang = $items->where('type', 'latar_belakang')->first();
        $table->addRow();
        $table->addCell($table_1_width, ['valign' => 'center'])->addText("2.", $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
        $table->addCell($table_2_width, ['valign' => 'center'])->addText("Latar Belakang", $quat_11, ['spaceAfter' => 0]);
        $contentCell = $table->addCell($fullWidth - $table_1_width - $table_2_width);
        if($latarBelakang)
        {
            $latarBelakangContent = str_replace('{{year}}', $plan->year, $latarBelakang->value);
            $latarBelakangContent = str_replace('<br>', '<br />', $latarBelakangContent);
            Html::addHtml($contentCell, $latarBelakangContent, false, false);
        }

        $table->addRow();
        $table->addCell($table_1_width, ['valign' => 'center'])->addText("3.", $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
        $table->addCell($table_2_width, ['valign' => 'center'])->addText("Implikasi Kewangan & Sumber Manusia", $quat_11, ['spaceAfter' => 0]);
        $contentCell = $table->addCell($fullWidth - $table_1_width - $table_2_width);
        $peruntukanBaharu = $items->where('type', 'peruntukan_baharu')->first();
        if($peruntukanBaharu)
        {
            $contentCell->addText("Cadangan Agihan Peruntukan Baharu Dana Universiti Penyelidikan Tahun ".$plan->year." RM ".number_format($plan->amount, 2, '.', ','), $quat_11_b_u);
            $peruntukanBaharuContent = str_replace('{{year}}', $plan->year, $peruntukanBaharu->value);
            $peruntukanBaharuContent = str_replace('<br>', '<br />', $peruntukanBaharuContent);
            Html::addHtml($contentCell, $peruntukanBaharuContent, false, false);
        }
        $agihanSemula = $items->where('type', 'agihan_semula')->first();
        if($agihanSemula)
        {
            $contentCell->addText("Cadangan Agihan Semula Baki Dana Universiti Penyelidikan (Bajet Q)", $quat_11_b_u);
            $agihanSemulaContent = str_replace('{{year}}', $plan->year, $agihanSemula->value);
            $agihanSemulaContent = str_replace('<br>', '<br />', $agihanSemulaContent);
            Html::addHtml($contentCell, $agihanSemulaContent, false, false);
        }
        $cajPenyelenggaraan = $items->where('type', 'caj_penyelenggaraan')->first();
        if($cajPenyelenggaraan)
        {
            $contentCell->addText("Caj Penyelenggaraan Dan Pengurusan R&D", $quat_11_b_u);
            $cajPenyelenggaraanContent = str_replace('{{year}}', $plan->year, $cajPenyelenggaraan->value);
            $cajPenyelenggaraanContent = str_replace('<br>', '<br />', $cajPenyelenggaraanContent);
            Html::addHtml($contentCell, $cajPenyelenggaraanContent, false, false);
        }
        $pihakBertanggungjawab = $items->where('type', 'pihak_bertanggungjawab')->first();
        if($pihakBertanggungjawab)
        {
            $contentCell->addText("Pihak Bertanggungjawab", $quat_11_b_u);
            $pihakBertanggungjawabContent = str_replace('{{year}}', $plan->year, $pihakBertanggungjawab->value);
            $pihakBertanggungjawabContent = str_replace('<br>', '<br />', $pihakBertanggungjawabContent);
            Html::addHtml($contentCell, $pihakBertanggungjawabContent, false, false);
        }

        $keputusan = $items->where('type', 'keputusan')->first();
        $table->addRow();
        $table->addCell($table_1_width, ['valign' => 'center'])->addText("4.", $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
        $table->addCell($table_2_width, ['valign' => 'center'])->addText("Pertimbangan & Keputusan Universiti", $quat_11, ['spaceAfter' => 0]);
        $contentCell = $table->addCell($fullWidth - $table_1_width - $table_2_width);
        if($keputusan)
        {
            $keputusanContent = str_replace('{{year}}', $plan->year, $keputusan->value);
            $keputusanContent = str_replace('<br>', '<br />', $keputusanContent);
            Html::addHtml($contentCell, $keputusanContent, false, false);
        }

        $section1->addPageBreak();

        $fullWidth2 = Converter::cmToTwip(21) - Converter::cmToTwip(10);
        $tableStyle2 = [
            'borderSize' => 4,
            'borderColor' => '999999',
            'cellMargin' => 200,
            'alignment' => Jc::CENTER,
            'width' => $fullWidth2
        ];
        $phpWord->addTableStyle('Result', $tableStyle2);

        // Define header cell style with background color
        $headerCellStyle2 = [
            'valign' => 'center'
        ];

        // Add table to the section
        $table2 = $section1->addTable('Result');
        $table2->addRow();
        $table2->addCell($table_2_width, $headerCellStyle2)->addText('Keputusan', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table2->addCell($fullWidth2-$table_2_width, $headerCellStyle2)->addText('/', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table2->addRow();
        $table2->addCell($table_2_width, $headerCellStyle2)->addText('Makluman', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table2->addCell($fullWidth2-$table_2_width, $headerCellStyle2)->addText('', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);

        $section1->addTextBreak();
        $section1->addText('KERTAS KERJA UNTUK KELULUSAN MESYUARAT JAWATANKUASA PENGURUSAN UNIVERSITI',$quat_11_b, $title_center);
        $section1->addText('CADANGAN AGIHAN PERUNTUKAN BAHARU DANA UNIVERSITI PENYELIDIKAN TAHUN '. $plan->year .' DAN AGIHAN SEMULA BAKI DANA RU (BAJET Q)',$quat_11_b, $title_center);
        $section1->addTextBreak();

        $phpWord->addTableStyle('Signature', $tableStyle);
        $table3 = $section1->addTable('Signature');

        $table3->addRow();
        $table3->addCell($fullWidth/4, $headerCellStyle2)->addText('', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table3->addCell($fullWidth/4, $headerCellStyle2)->addText('Disediakan Oleh', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table3->addCell($fullWidth/4, $headerCellStyle2)->addText('Disahkan Oleh', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
        $table3->addCell($fullWidth/4, $headerCellStyle2)->addText('Diperakukan Oleh', $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);

        $preparedByName = $items->filter(function ($item) {
                return $item->type == 'prepared_by_name';
            })->values();
        $preparedByRole = $items->filter(function ($item) {
                return $item->type == 'prepared_by_role';
            })->values();
        $verifiedByName = $items->filter(function ($item) {
                return $item->type == 'verified_by_name';
            })->values();
        $verifiedByRole = $items->filter(function ($item) {
                return $item->type == 'verified_by_role';
            })->values();
        $confirmedByName = $items->filter(function ($item) {
                return $item->type == 'confirmed_by_name';
            })->values();
        $confirmedByRole = $items->filter(function ($item) {
                return $item->type == 'confirmed_by_role';
            })->values();

        $maxRow = max(count($preparedByName), count($verifiedByName), count($confirmedByName));
        for ($i=0; $i < $maxRow; $i++) {
            $table3->addRow();
            if($i == 0)$table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText("Tandatangan", $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
            else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);

            if(count($preparedByName) > 0){
                if($preparedByName->has($i)){
                    if(!$preparedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart', 'cellMarginTop' => 1000]);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center', 'cellMarginTop' => 1000]);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart', 'cellMarginTop' => 1000]);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }

            if(count($verifiedByName) > 0){
                if($verifiedByName->has($i)){
                    if(!$verifiedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart', 'cellMarginTop' => 1000]);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center', 'cellMarginTop' => 1000]);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart', 'cellMarginTop' => 1000]);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }

            if(count($confirmedByName) > 0){
                if($confirmedByName->has($i)){
                    if(!$confirmedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart', 'cellMarginTop' => 1000]);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center', 'cellMarginTop' => 1000]);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart', 'cellMarginTop' => 1000]);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
        }

        for ($i=0; $i < $maxRow; $i++) {
            $table3->addRow();
            if($i == 0)$table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText("Nama", $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
            else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);

            if(count($preparedByName) > 0){
                if($preparedByName->has($i)){
                    if(!$preparedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText($preparedByName[$i]->value, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center'])->addText($preparedByName[$i]->value, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart']);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }

            if(count($verifiedByName) > 0){
                if($verifiedByName->has($i)){
                    if(!$verifiedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText($verifiedByName[$i]->value, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center'])->addText($verifiedByName[$i]->value, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart']);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }

            if(count($confirmedByName) > 0){
                if($confirmedByName->has($i)){
                    if(!$confirmedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText($confirmedByName[$i]->value, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center'])->addText($confirmedByName[$i]->value, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart']);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
        }

        for ($i=0; $i < $maxRow; $i++) {
            $table3->addRow();
            if($i == 0)$table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText("Jawatan", $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
            else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);

            if(count($preparedByRole) > 0){
                if($preparedByRole->has($i)){
                    if(!$preparedByRole->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText($preparedByRole[$i]->value, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center'])->addText($preparedByRole[$i]->value, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart']);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }

            if(count($verifiedByRole) > 0){
                if($verifiedByRole->has($i)){
                    if(!$verifiedByRole->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText($verifiedByRole[$i]->value, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center'])->addText($verifiedByRole[$i]->value, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart']);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }

            if(count($confirmedByRole) > 0){
                if($confirmedByRole->has($i)){
                    if(!$confirmedByRole->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText($confirmedByRole[$i]->value, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center'])->addText($confirmedByRole[$i]->value, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart']);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);
            }
        }

        for ($i=0; $i < $maxRow; $i++) {
            $table3->addRow();
            if($i == 0)$table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart'])->addText("Tarikh", $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
            else $table3->addCell($fullWidth/4, ['vMerge' => 'continue']);

            if(count($preparedByName) > 0){
                if($preparedByName->has($i)){
                    if(!$preparedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart', 'cellMarginTop' => 1000]);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center', 'cellMarginTop' => 1000]);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart', 'cellMarginTop' => 1000]);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }

            if(count($verifiedByName) > 0){
                if($verifiedByName->has($i)){
                    if(!$verifiedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart', 'cellMarginTop' => 1000]);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center', 'cellMarginTop' => 1000]);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart', 'cellMarginTop' => 1000]);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }

            if(count($confirmedByName) > 0){
                if($confirmedByName->has($i)){
                    if(!$confirmedByName->has($i+1)) $table3->addCell($fullWidth/4, ['valign' => 'center', 'vMerge' => 'restart', 'cellMarginTop' => 1000]);
                    else $table3->addCell($fullWidth/4, ['valign' => 'center', 'cellMarginTop' => 1000]);
                }
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
            else {
                if($i == 0)$table3->addCell($fullWidth/4, ['vMerge' => 'restart', 'cellMarginTop' => 1000]);
                else $table3->addCell($fullWidth/4, ['vMerge' => 'continue', 'cellMarginTop' => 1000]);
            }
        }

        $section1->addPageBreak();
        // Add text elements
        $section1->addText('UNIVERSITI TEKNOLOGI MALAYSIA',$quat_11_b, $title_center);
        $section1->addText('KERTAS KERJA UNTUK KELULUSAN MESYUARAT JAWATANKUASA PENGURUSAN UNIVERSITI',$quat_11_b, $title_center);
        $section1->addText('CADANGAN AGIHAN PERUNTUKAN BAHARU DANA UNIVERSITI PENYELIDIKAN TAHUN '. $plan->year .' DAN AGIHAN SEMULA BAKI DANA RU (BAJET Q)',$quat_11_b, $title_center);
        $section1->addTextBreak();
        $section1->addTextBreak();

        $listCount = 1;
        foreach (Parameter::whereGroupId(5)->get() as $key => $item) {
            $details = $items->where('type', $item->code.'_details')->first();
            if($details){
                $titleContent = str_replace('{{year}}', $plan->year, $item->parameter_name);
                $titleContent = str_replace('{{amount}}', "RM ".number_format($plan->amount, 2, '.', ','), $titleContent);
                $section1->addText($listCount.'.0 '.strtoupper($titleContent), $quat_11_b);
                $indentStyle = [
                    'indentation' => [
                        'left' => Converter::cmToTwip(6), 
                    ],
                ];
                $htmlContent = str_replace('{{year}}', $plan->year, $details->value);
                $htmlContent = str_replace('{{amount}}', "RM ".number_format($plan->amount, 2, '.', ','), $htmlContent);
                $htmlContent = str_replace('<br>', '<br />', $htmlContent);
                Html::addHtml($section1, $htmlContent, false, false, $indentStyle);
                $section1->addTextBreak();
                $listCount++;
            }
        }

        $section1->addText('Disediakan Oleh', $quat_11_i);
        $section1->addText('Unit Strategik & Universiti Penyelidikan, Seksyen Strategik & Korporat. Pusat Pengurusan Penyelidikan', $quat_11_i);
        $section1->addText('Julai '.$plan->year, $quat_11_i);

        $section2 = $phpWord->addSection([
            'orientation' => 'portrait',
            'paperSize' => 'A4',
            'pageSizeW' => Converter::cmToTwip(29.7), // A4 width
            'pageSizeH' => Converter::cmToTwip(21.0), // A4 height
            'marginLeft' => Converter::cmToTwip(0.5),
            'marginRight' => Converter::cmToTwip(0.5),
            'marginTop' => Converter::cmToTwip(2),
            'marginBottom' => Converter::cmToTwip(2),
        ]);
        // Add a header to the section
        $header = $section2->addHeader();
        // Create a table in the header with left and right aligned text
        $headerTable = $header->addTable();
        $headerTable->addRow();
        $headerTable->addCell(Converter::cmToTwip(29.7)/2)->addText('SULIT', $quat_10_b);
        $headerTable->addCell(Converter::cmToTwip(29.7)/2)->addText('KERTAS KERJA UTM/JPU/       /2023', $quat_10_b, ['align' => 'right']);
        $header->addTextBreak();
        // Add text elements
        $section2->addText('LAMPIRAN 1: CADANGAN AGIHAN PERUNTUKAN DANA UNIVERSITI PENYELIDIKAN TAHUN '.$plan->year.' BERJUMLAH RM '.number_format($plan->amount, 2, '.', ','), $quat_11_b);
        
        $tableLFullwidth = Converter::cmToTwip(29.7) - Converter::cmToTwip(1);
        $tableFirstColLFullwidth = 300;
        $tableLWidth = $tableLFullwidth - $tableFirstColLFullwidth;
        $tableLStyle = [
            'borderSize' => 4,
            'borderColor' => '999999',
            'cellMargin' => 80,
            'width' => $fullWidth
        ];
        $phpWord->addTableStyle('Lampiran1', $tableLStyle);

        // Define header cell style with background color
        $headerLCellStyle = [
            'bgColor' => '076FC0',
            'valign' => 'center'
        ];

        $footerLCellStyle = [
            'bgColor' => '00AF50',
            'valign' => 'center'
        ];

        // Add table to the section
        $tableL1 = $section2->addTable('Lampiran1');

        // Add header row with colored background
        $tableL1->addRow();
        $tableL1->addCell($tableFirstColLFullwidth, $headerLCellStyle)->addText('NO.', $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(10/100*$tableLWidth, $headerLCellStyle)->addText('PTJ PIC', $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(20/100*$tableLWidth, $headerLCellStyle)->addText('JENIS AGIHAN', $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(20/100*$tableLWidth, $headerLCellStyle)->addText('CHARGELINE', $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(20/100*$tableLWidth, $headerLCellStyle)->addText('AGIHAN '.$plan->year, $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(30/100*$tableLWidth, $headerLCellStyle)->addText('KPI', $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);

        $plan_forms = getDistributionFormPlans($plan->year, $plan->id)->get();
        $totalAmount = 0;
        foreach ($plan_forms as $key => $plan_form) {
            $chargeline = '';
            if($plan_form->ddf_status == 'active') $chargeline = 'Q.'. getAppendedPtjCode($plan_form->ptj_code, 7) . '.'. $plan_form->ddf_code. '.'. getProjectSecondCode($plan_form->ddf_code_2);                                
            $tableL1->addRow();
            $tableL1->addCell($tableFirstColLFullwidth, ['valign' => 'center'])->addText($key+1, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
            $tableL1->addCell(10/100*$tableLWidth, ['valign' => 'center'])->addText($plan_form->ptj, $quat_11_b, ['spaceAfter' => 0,'alignment' => 'center']);
            $tableL1->addCell(20/100*$tableLWidth, ['valign' => 'center'])->addText(strtoupper($plan_form->ddf_title), $quat_11, ['spaceAfter' => 0]);
            $tableL1->addCell(20/100*$tableLWidth, ['valign' => 'center'])->addText($chargeline, $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
            $tableL1->addCell(20/100*$tableLWidth, ['valign' => 'center'])->addText('RM '.number_format($plan_form->plan_form_amount, 2, '.', ','), $quat_11, ['spaceAfter' => 0,'alignment' => 'center']);
            $kpiCell = $tableL1->addCell(30/100*$tableLWidth, ['valign' => 'center']);
            $mainKpiContent = '<p style="line-height: 1.5;">'.$plan_form->main_kpi_details.'</p>';
            $mainKpiContent =  str_replace('<br>', '<br />', $mainKpiContent);
            Html::addHtml($kpiCell, $mainKpiContent, false, false, ['spaceAfter' => 0]);
            if($plan_form->kpi_details){
                $kpiContent = '<p style="line-height: 1.5;">'.$plan_form->kpi_details.'</p>';
                $kpiContent =  str_replace('<br>', '<br />', $kpiContent);
                Html::addHtml($kpiCell, $kpiContent, false, false, ['spaceAfter' => 0]);
            }
            $totalAmount += $plan_form->plan_form_amount;
        }

        $tableL1->addRow();
        $tableL1->addCell($tableFirstColLFullwidth, ['bgColor' => '00AF50','valign' => 'center', 'gridSpan' => 4])->addText('JUMLAH AGIHAN DANA RU'. $plan->year, $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(20/100*$tableLWidth, $footerLCellStyle)->addText('RM '.number_format($totalAmount, 2, '.', ','), $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        $tableL1->addCell(30/100*$tableLWidth, $footerLCellStyle)->addText('', $quat_11_b_w, ['spaceAfter' => 0,'alignment' => 'center']);
        // Create a temporary file in the system's temp directory
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');

        // Save the document to the temporary file
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        $filename = 'KK_Q_'.date('d_m_Y');
        File::ensureDirectoryExists(storage_path('/app/data/tmp'));
        File::cleanDirectory(storage_path('/app/data/tmp'));
        // Return the file as a download response
        return response()->download($tempFile, $filename.'.docx')->deleteFileAfterSend(true);
        // $templateProcessor = new TemplateProcessor('wordTemplate/kertas_kerja_template.docx');
        // $templateProcessor->setValue("year", "<p>2013</p>");
        
        // $filename = 'KK_Q_'.date('d_m_Y');
        // try{
        //     $templateProcessor->saveAs(storage_path('app/data/doc/'.$filename.'.docx'));
        // }catch (Exception $e){
        //     //handle exception2
        // }
        // return response()->download(storage_path('app/data/doc/'.$filename.'.docx'));
    }

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
            'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
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
            $filename = 'Q_'. getAppendedPtjCode($form->ptj_code, 7) . '_' . $form->ddf_code . '_' . getProjectSecondCode($form->ddf_code_2).'_'.date('d_m_Y');
        }

        $templateProcessor = new TemplateProcessor('wordTemplate/lampiran_a_template.docx');
        $templateProcessor->setValue("ptj_pic", $form->ptj);
        $templateProcessor->setValue("mrun", $form->mrun_desc);
        $templateProcessor->setValue("project", $form->ddf_title);
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
