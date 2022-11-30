<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use App\Models\MasterList\MasterlistAcademicStaff;
use Maatwebsite\Excel\Concerns\Exportable;

class AcadStaffExport implements FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $year;
    protected $faculty;
    
    public function __construct($year, $faculty = null)
    {
        $this->year = $year;
        $this->faculty = $faculty;
    }

    public function query()
    {
        $year = $this->year;
        $faculty = $this->faculty;
        return MasterlistAcademicStaff::query()->where('ml_end_year', $this->year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}});
    }
}
