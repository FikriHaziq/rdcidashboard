<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Upgrade safety net: opens read-only pages as super_admin and compares the numbers
 * on each page with a recorded baseline (tests/snapshots/upgrade-baseline.json).
 *
 * Record baseline : UPGRADE_SNAPSHOT=record php artisan test --filter=UpgradeSmokeTest
 * Compare         : php artisan test --filter=UpgradeSmokeTest
 *
 * Uses the database in .env (RDCI_UPGRADE) as is - never refreshes or writes data.
 * Only routes checked to be read-only are listed here, never delete/import/process/activate routes.
 */
class UpgradeSmokeTest extends TestCase
{
    private const SNAPSHOT_FILE = 'tests/snapshots/upgrade-baseline.json';

    private static $snapshot = null;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::where('role', 'super_admin')->where('status', 'verified')->orderBy('id')->firstOrFail();
        saveUser([
            'id' => $user->id,
            'staff_id' => null,
            'email' => $user->email,
            'name' => $user->name,
            'nric' => null,
            'role' => $user->role,
            'faculty' => getFacultyByCode($user->faculty_code)->description_1 ?? null,
            'faculty_code' => $user->faculty_code,
            'school' => getSchoolByCode($user->school_code)->description_1 ?? null,
            'school_code' => $user->school_code,
        ]);
        $this->actingAs($user)->withSession(['user' => session('user')]);
    }

    /*
     * MyRA data in development goes up to 2022, so pages are opened with 2016-2022 (dashboards)
     * and every year from 2022 back to 2016 (self-assessment), not the current-year defaults.
     *
     * Not covered (already broken before the upgrade, not in the menu):
     *   myra.emyra (view missing), grant.faculty-year/active/all, dana-ru.kewangan.overall (unknown column),
 *   myra.section-c PUBLICATION-FACULTY / FUNDING-FACULTY (unfinished: wrong arguments, views missing, not linked)
     * Not covered locally:
     *   report.myra.download (needs uploaded files in storage/app)
     *   myra.glossary (PDF opened with a relative path, only works when served from public/)
     */
    private const MYRA_YEARS = [2022, 2021, 2020, 2019, 2018, 2017, 2016];

    public function test_myra_dashboard_pages()
    {
        $range = ['search' => 1, 'start_year' => min(self::MYRA_YEARS), 'end_year' => max(self::MYRA_YEARS)];
        $pages = [];
        foreach (['myra.index', 'myra.info.staff', 'myra.info.student', 'myra.section-e', 'myra.section-h'] as $route) {
            $pages[$route] = route($route);
            $pages[$route.' 2016-2022'] = route($route, $range);
        }
        $tabs = [
            'b' => ['INVESTIGATOR', 'AWARD', 'COHORT'],
            'c' => ['PUBLICATION-ALL', 'FUNDING-ALL'],
            'd' => ['ABSORPTION', 'ENROLLMENT', 'POSTGRADUATE'],
            'f' => ['UNIVERSITY'],
            'g' => ['STAFFOVERALL', 'PROJECTOVERALL'],
        ];
        foreach ($tabs as $section => $section_tabs) {
            foreach ($section_tabs as $tab) {
                $pages['myra.section-'.$section.' '.$tab] = route('myra.section-'.$section, $tab);
                $pages['myra.section-'.$section.' '.$tab.' 2016-2022'] = route('myra.section-'.$section, ['tabs' => $tab] + $range);
            }
        }
        $this->checkPages($pages);
    }

    public function test_myra_self_assessment_pages()
    {
        $pages = [];
        foreach (self::MYRA_YEARS as $year) {
            foreach (['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'summary'] as $section) {
                $route = $section === 'summary' ? 'myra.self-assessment.summary' : 'myra.self-assessment.section-'.$section;
                $pages[$route.' '.$year] = route($route, $year);
            }
        }
        $this->checkPages($pages);
    }

    public function test_myra_report_and_masterlist_pages()
    {
        $pages = [];
        foreach (self::MYRA_YEARS as $year) {
            $pages['report.myra.index '.$year] = route('report.myra.index', $year);
            $pages['report.myra.glossary '.$year] = route('report.myra.glossary', $year);
            $pages['masterlist.myra.index '.$year] = route('masterlist.myra.index', $year);
        }
        // Every MyRA masterlist module uploaded for the latest data year
        $modules = DB::table('data_attachments')->whereNotIn('module', ['allocation', 'expenses'])->where('year', max(self::MYRA_YEARS))->distinct()->orderBy('module')->pluck('module');
        foreach ($modules as $module) {
            $pages['masterlist.myra.list '.$module.' '.max(self::MYRA_YEARS)] = route('masterlist.myra.list', [$module, max(self::MYRA_YEARS)]);
        }
        $this->checkPages($pages);
    }

    public function test_research_and_masterlist_pages()
    {
        $pages = [
            'grant.overview' => route('grant.overview'),
            'grant.proposal' => route('grant.proposal'),
            'grant.myra' => route('grant.myra'),
            'masterlist.project-management.index' => route('masterlist.project-management.index'),
        ];
        foreach (['proposal', 'grant', 'activity', 'raro-appointment', 'grasra-appointment', 'wages-claim', 'rmarm-distribution', 'action-list'] as $page) {
            $pages['research.management.'.$page] = route('research.management.'.$page);
        }
        $this->checkPages($pages);
    }

    public function test_dana_ru_pages()
    {
        $plan = DB::table('dru_distribution_plans')->whereIn('type', [1, 2])->orderBy('id')->first();
        $plan_form = DB::table('dru_distribution_plan_forms')->orderBy('id')->first();
        $term = DB::table('dru_expenses_report_terms')->orderBy('id')->first();
        $year = $plan->year ?? date('Y');

        $pages = [
            'dana-ru.dashboard.bpki' => route('dana-ru.dashboard.bpki'),
            'dana-ru.dashboard.bpki (2011-2023)' => route('dana-ru.dashboard.bpki', ['year_from' => 2011, 'year_to' => 2023]),
            'dana-ru.dashboard.mrun' => route('dana-ru.dashboard.mrun'),
            'dana-ru.carian.index' => route('dana-ru.carian.index'),
            'dana-ru.carian.allocation' => route('dana-ru.carian.allocation'),
            'dana-ru.carian.expenses' => route('dana-ru.carian.expenses'),
            'dana-ru.carian.cadangan-agihan' => route('dana-ru.carian.cadangan-agihan'),
            'dana-ru.cadangan-agihan.index' => route('dana-ru.cadangan-agihan.index', $year),
            'dana-ru.kewangan.pengesahan-agihan.index' => route('dana-ru.kewangan.pengesahan-agihan.index', $year),
            'dana-ru.kewangan.agihan-program.index' => route('dana-ru.kewangan.agihan-program.index'),
            'dana-ru.kewangan.perbelanjaan.program.index' => route('dana-ru.kewangan.perbelanjaan.program.index', $year),
            'dana-ru.kewangan.perbelanjaan.sub-projek' => route('dana-ru.kewangan.perbelanjaan.sub-projek', $year),
            'dana-ru.kewangan.mail-template.index' => route('dana-ru.kewangan.mail-template.index', $year),
            'dana-ru.senarai-agihan.index' => route('dana-ru.senarai-agihan.index', $year),
            'dana-ru.masterlist.allocation' => route('dana-ru.masterlist.allocation'),
            'dana-ru.masterlist.allocation.year' => route('dana-ru.masterlist.allocation.year', $year),
            'dana-ru.masterlist.expenses' => route('dana-ru.masterlist.expenses'),
            'dana-ru.masterlist.expenses.year' => route('dana-ru.masterlist.expenses.year', $year),
        ];
        if ($plan) {
            $pages['dana-ru.cadangan-agihan.kertas-kerja'] = route('dana-ru.cadangan-agihan.kertas-kerja', $plan->id);
            $pages['dana-ru.kewangan.pengesahan-agihan.show'] = route('dana-ru.kewangan.pengesahan-agihan.show', $plan->id);
            $pages['dana-ru.kewangan.perbelanjaan.program.term.index'] = route('dana-ru.kewangan.perbelanjaan.program.term.index', $plan->id);
            $pages['dana-ru.kewangan.perbelanjaan.program.term.create'] = route('dana-ru.kewangan.perbelanjaan.program.term.create', $plan->id);
            $pages['dana-ru.senarai-agihan.show'] = route('dana-ru.senarai-agihan.show', $plan->id);
            $pages['dana-ru.senarai-agihan.expenses-record'] = route('dana-ru.senarai-agihan.expenses-record', $plan->id);
        }
        if ($plan_form) {
            $pages['dana-ru.cadangan-agihan.form'] = route('dana-ru.cadangan-agihan.form', [$year, $plan_form->id, 'view' => true]);
            $pages['dana-ru.kewangan.perbelanjaan.program.show'] = route('dana-ru.kewangan.perbelanjaan.program.show', $plan_form->id);
            $pages['dana-ru.senarai-agihan.form'] = route('dana-ru.senarai-agihan.form', [$year, $plan_form->id]);
        }
        if ($term) {
            $pages['dana-ru.kewangan.perbelanjaan.program.term.edit'] = route('dana-ru.kewangan.perbelanjaan.program.term.edit', $term->id);
        }
        $this->checkPages($pages);
    }

    public function test_dana_ru_maintenance_pages()
    {
        $pages = [];
        foreach (['tabung-induk', 'tabung-agihan', 'asas-agihan', 'kpi', 'faculty', 'user', 'verification-label', 'status'] as $page) {
            $pages['dana-ru.maintenance.'.$page] = route('dana-ru.maintenance.'.$page);
        }
        $pages['dana-ru.maintenance.project'] = route('dana-ru.maintenance.project');
        foreach (['tabung-induk', 'tabung-agihan', 'asas-agihan', 'kpi', 'faculty', 'project'] as $page) {
            $pages['dana-ru.maintenance.'.$page.'.create'] = route('dana-ru.maintenance.'.$page.'.create');
        }
        $edit_ids = [
            'tabung-induk' => DB::table('dru_main_funds')->min('id'),
            'tabung-agihan' => DB::table('dru_dist_funds')->min('id'),
            'asas-agihan' => DB::table('dru_kpi_templates')->where('type', 'main')->min('id'),
            'kpi' => DB::table('dru_kpi_templates')->where('type', 'kpi')->min('id'),
            'faculty' => DB::table('parameters')->whereIn('group_id', [1, 2])->min('id'),
            'project' => DB::table('dru_projects')->min('id'),
            'user' => DB::table('users')->min('id'),
        ];
        foreach ($edit_ids as $page => $id) {
            if ($id) $pages['dana-ru.maintenance.'.$page.'.edit'] = route('dana-ru.maintenance.'.$page.'.edit', $id);
        }
        $this->checkPages($pages);
    }

    public function test_dana_ru_datatables()
    {
        // Server-side DataTables requests (the riskiest part of the yajra/laravel-datatables upgrade)
        $year = DB::table('dru_distribution_plans')->max('year') ?? date('Y');
        $pages = [];
        foreach (['tabung-induk', 'tabung-agihan', 'asas-agihan', 'kpi', 'faculty', 'user', 'project'] as $page) {
            $pages['ajax dana-ru.maintenance.'.$page] = ['url' => route('dana-ru.maintenance.'.$page), 'ajax' => true];
        }
        $pages['ajax dana-ru.masterlist.allocation.year'] = ['url' => route('dana-ru.masterlist.allocation.year', $year), 'ajax' => true];
        $pages['ajax dana-ru.masterlist.expenses.year'] = ['url' => route('dana-ru.masterlist.expenses.year', $year), 'ajax' => true];
        $pages['ajax dana-ru.carian.allocation'] = ['url' => route('dana-ru.carian.allocation', ['bpki' => 'GP']), 'ajax' => true];
        $pages['ajax dana-ru.carian.expenses'] = ['url' => route('dana-ru.carian.expenses', ['start_year' => 2023, 'end_year' => 2023]), 'ajax' => true];
        $pages['ajax dana-ru.carian.cadangan-agihan'] = ['url' => route('dana-ru.carian.cadangan-agihan'), 'ajax' => true];
        $this->checkPages($pages);
    }

    public function test_document_generation()
    {
        // PDF (dompdf + libmergepdf), Word (PhpWord) and PowerPoint (PhpPresentation) downloads
        $plan = DB::table('dru_distribution_plans')->whereIn('type', [1, 2])->orderBy('id')->first();
        $plan_form = DB::table('dru_distribution_plan_forms')->orderBy('id')->first();
        $pages = [];
        if ($plan_form) $pages['doc-generator.lampiran-a'] = ['url' => route('doc-generator.lampiran-a', $plan_form->id), 'file' => true];
        if ($plan) $pages['doc-generator.kertas-kerja'] = ['url' => route('doc-generator.kertas-kerja', $plan->id), 'file' => true];
        if ($plan) $pages['dana-ru.kewangan.perbelanjaan.laporan-perbelanjaan'] = ['url' => route('dana-ru.kewangan.perbelanjaan.laporan-perbelanjaan', [$plan->id, 1]), 'file' => true];
        $this->checkPages($pages);
    }

    // ---------------------------------------------------------------------------------

    private function checkPages(array $pages)
    {
        $record = env('UPGRADE_SNAPSHOT') === 'record';
        $snapshot = $this->loadSnapshot();
        $errors = [];
        $changes = [];

        foreach ($pages as $name => $page) {
            $page = is_array($page) ? $page : ['url' => $page];
            $headers = !empty($page['ajax']) ? ['X-Requested-With' => 'XMLHttpRequest', 'Accept' => 'application/json'] : [];
            $url = $page['url'];
            if (!empty($page['ajax'])) $url .= (strpos($url, '?') === false ? '?' : '&').'draw=1&start=0&length=25';

            $response = $this->get($url, $headers);
            $status = $response->getStatusCode();
            if ($status !== 200) {
                $message = $response->exception ? get_class($response->exception).': '.$response->exception->getMessage() : 'redirect to '.$response->headers->get('Location');
                $errors[] = "[$status] $name\n        ".substr($message, 0, 300);
                continue;
            }

            if (!empty($page['file'])) {
                $content = $response->baseResponse instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse
                    ? file_get_contents($response->baseResponse->getFile()->getPathname())
                    : $response->getContent();
                if (strlen((string)$content) === 0) $errors[] = "[empty file] $name";
                continue;
            }

            $numbers = $this->numbersOf($response->getContent(), !empty($page['ajax']));
            $fingerprint = ['count' => count($numbers), 'sha1' => sha1(implode('|', $numbers)), 'sample' => array_slice($numbers, 0, 40)];
            if ($record) {
                $snapshot[$name] = $fingerprint;
            }
            else if (!isset($snapshot[$name])) {
                $changes[] = "$name: no baseline recorded";
            }
            else if ($snapshot[$name]['sha1'] !== $fingerprint['sha1']) {
                $changes[] = "$name: numbers changed (".$snapshot[$name]['count'].' -> '.$fingerprint['count'].' values)'.$this->firstDifference($snapshot[$name]['sample'], $fingerprint['sample']);
            }
        }

        if ($record) $this->saveSnapshot($snapshot);

        $this->assertEmpty($errors, "Pages with errors:\n  ".implode("\n  ", $errors));
        $this->assertEmpty($changes, "Pages whose numbers differ from the baseline (check if expected):\n  ".implode("\n  ", $changes));
    }

    // All numbers in the response, ignoring values that change on every request (CSRF token, asset versions, echoed request input)
    private function numbersOf($content, $json)
    {
        if ($json && is_array($data = json_decode($content, true))) {
            unset($data['input'], $data['queries'], $data['draw']);
            $content = json_encode($data);
        }
        else {
            $content = preg_replace([
                '/<meta name="csrf-token"[^>]*>/',
                '/name="_token"[^>]*>/',
                '/X-CSRF-TOKEN[^\n]*/',
                '/\?(v|id)=\d+/',
                '/##parent-placeholder-[0-9a-f]+##/',
                '/name="migration" value="\d+"/',
                '#https?://[^\s"\'<>)]+#',
            ], '', $content);
        }
        preg_match_all('/-?\d[\d,]*(?:\.\d+)?/', $content, $matches);
        return $matches[0];
    }

    private function firstDifference(array $before, array $after)
    {
        foreach ($before as $i => $value) {
            if (($after[$i] ?? null) !== $value) return " - first difference at #$i: '$value' -> '".($after[$i] ?? 'missing')."'";
        }
        return '';
    }

    private function loadSnapshot()
    {
        if (self::$snapshot === null) {
            $file = base_path(self::SNAPSHOT_FILE);
            self::$snapshot = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        }
        return self::$snapshot;
    }

    private function saveSnapshot(array $snapshot)
    {
        ksort($snapshot);
        self::$snapshot = $snapshot;
        $file = base_path(self::SNAPSHOT_FILE);
        if (!is_dir(dirname($file))) mkdir(dirname($file), 0755, true);
        file_put_contents($file, json_encode($snapshot, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
