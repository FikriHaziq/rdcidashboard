<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruSubProject;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'id' => 1,
                'year' => 2023,
                'title' => 'Skim Zamalah',
                'code' => '21A1',
                'program_id' => 46,
                'is_fixed_subproject' => 'Y',
                'type' => 'single',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'year' => 2023,
                'title' => 'Pelantikan Pasca Doctoral',
                'code' => '21A2',
                'program_id' => 46,
                'is_fixed_subproject' => 'N',
                'type' => 'many',
                'status' => 'active',
            ],
        ];

        $subprojects = [
            [
                'year' => 2023,
                'project_id' => 1,
                'title' => 'Skim Zamalah',
                'code' => '00A00',
                'status' => 'active',
            ],
            [
                'year' => 2023,
                'project_id' => 2,
                'title' => 'Pelantikan Pasca Doctoral',
                'code' => '00000',
                'status' => 'active',
            ]
            ];

        foreach ($projects as $key => $project) {
            DruProject::create($project);
        }

        foreach ($subprojects as $key => $subproject) {
            DruSubProject::create($subproject);
        }
    }
}
