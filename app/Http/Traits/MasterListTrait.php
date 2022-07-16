<?php
namespace App\Http\Traits;
use App\Models\MasterList\MasterListStudent;
use App\Models\DataAttachment;

trait MasterListTrait {

    public function getModuleAvailability($year) {
        $ug_student = DataAttachment::whereModule('ug_student')->where('year', $year)->whereStatus('selected')->exists();
        $pg_student = DataAttachment::whereModule('pg_student')->where('year', $year)->whereStatus('selected')->exists();
        $master_student = DataAttachment::whereModule('master_student')->where('year', $year)->whereStatus('selected')->exists();
        $phd_student = DataAttachment::whereModule('phd_student')->where('year', $year)->whereStatus('selected')->exists();
        $doc_student = DataAttachment::whereModule('doc_student')->where('year', $year)->whereStatus('selected')->exists();

        $award = DataAttachment::whereModule('award')->where('year', $year)->whereStatus('selected')->exists();
        $publication = DataAttachment::whereModule('publication')->where('year', $year)->whereStatus('selected')->exists();

        $training = DataAttachment::whereModule('training_course')->where('year', $year)->whereStatus('selected')->exists();
        $conference = DataAttachment::whereModule('conference')->where('year', $year)->whereStatus('selected')->exists();
        $product = DataAttachment::whereModule('product')->where('year', $year)->whereStatus('selected')->exists();
        $consultancy = DataAttachment::whereModule('consultancy')->where('year', $year)->whereStatus('selected')->exists();
        $endowment = DataAttachment::whereModule('endowment')->where('year', $year)->whereStatus('selected')->exists();
        $gift = DataAttachment::whereModule('gift')->where('year', $year)->whereStatus('selected')->exists();
        $operational_expenditure = DataAttachment::whereModule('operational_expenditure')->where('year', $year)->whereStatus('selected')->exists();

        $international_moa = DataAttachment::whereModule('international_moa')->where('year', $year)->whereStatus('selected')->exists();
        $staff_sent_abroad = DataAttachment::whereModule('staff_sent_abroad')->where('year', $year)->whereStatus('selected')->exists();
        $international_membership = DataAttachment::whereModule('international_membership')->where('year', $year)->whereStatus('selected')->exists();
        $national_moa = DataAttachment::whereModule('national_moa')->where('year', $year)->whereStatus('selected')->exists();
        $national_membership = DataAttachment::whereModule('national_membership')->where('year', $year)->whereStatus('selected')->exists();
        $ktp = DataAttachment::whereModule('ktp')->where('year', $year)->whereStatus('selected')->exists();
        $joint_research_project = DataAttachment::whereModule('joint_research_project')->where('year', $year)->whereStatus('selected')->exists();
        $joint_research_project_ru = DataAttachment::whereModule('joint_research_project_ru')->where('year', $year)->whereStatus('selected')->exists();

        $support_facilities = DataAttachment::whereModule('support_facilities')->where('year', $year)->whereStatus('selected')->exists();
        $library_facilities = DataAttachment::whereModule('library_facilities')->where('year', $year)->whereStatus('selected')->exists();
        
        return [
            (object)[
                'group'=>'Student',
                'modules'=>[
                    (object)[
                        'name'=>'Under Graduate Student',
                        'code'=>'ug_student',
                        'available'=>$ug_student
                    ],
                    (object)[
                        'name'=>'Post Graduate Student',
                        'code'=>'pg_student',
                        'available'=>$pg_student
                    ],
                    (object)[
                        'name'=>'Master Student',
                        'code'=>'master_student',
                        'available'=>$master_student
                    ],
                    (object)[
                        'name'=>'PhD Student',
                        'code'=>'phd_student',
                        'available'=>$phd_student
                    ],
                    (object)[
                        'name'=>'Doctoral Student',
                        'code'=>'doc_student',
                        'available'=>$doc_student
                    ],
                ], 
            ],
            (object)[
                'group'=>'Award',
                'modules'=>[
                    (object)[
                        'name'=>'Award',
                        'code'=>'award',
                        'available'=>$award
                    ],
                ]
            ],
            (object)[
                'group'=>'Publication',
                'modules'=>[
                    (object)[
                        'name'=>'Publication',
                        'code'=>'publication',
                        'available'=>$publication
                    ],
                ]
            ],
            (object)[
                'group'=>'Services & Gifts',
                'modules'=>[
                    (object)[
                        'name'=>'Training Courses & PG Fees',
                        'code'=>'training_course',
                        'available'=>$training
                    ],
                    (object)[
                        'name'=>'Conference & Seminar',
                        'code'=>'conference',
                        'available'=>$conference
                    ],
                    (object)[
                        'name'=>'Product Comm & Know-How Licensing',
                        'code'=>'product',
                        'available'=>$product
                    ],
                    (object)[
                        'name'=>'Consultancy & Lab',
                        'code'=>'consultancy',
                        'available'=>$consultancy
                    ],
                    (object)[
                        'name'=>'Endowment',
                        'code'=>'endowment',
                        'available'=>$endowment
                    ],
                    (object)[
                        'name'=>'Gifts',
                        'code'=>'gift',
                        'available'=>$gift
                    ],
                    (object)[
                        'name'=>'Operational Expenditure',
                        'code'=>'operational_expenditure',
                        'available'=>$operational_expenditure
                    ],
                ]
            ],
            (object)[
                'group'=>'G Networking',
                'modules'=>[
                    (object)[
                        'name'=>'International MoA',
                        'code'=>'international_moa',
                        'available'=>$international_moa
                    ],
                    (object)[
                        'name'=>'Staff Sent Abroad',
                        'code'=>'staff_sent_abroad',
                        'available'=>$staff_sent_abroad
                    ],
                    (object)[
                        'name'=>'International Membership',
                        'code'=>'international_membership',
                        'available'=>$international_membership
                    ],
                    (object)[
                        'name'=>'National MoA',
                        'code'=>'national_moa',
                        'available'=>$national_moa
                    ],
                    (object)[
                        'name'=>'National Membership',
                        'code'=>'national_membership',
                        'available'=>$national_membership
                    ],
                    (object)[
                        'name'=>'KTP',
                        'code'=>'ktp',
                        'available'=>$ktp
                    ],
                    (object)[
                        'name'=>'Joint Research Projects',
                        'code'=>'joint_research_project',
                        'available'=>$joint_research_project
                    ],
                    (object)[
                        'name'=>'Joint Research Projects Between RUs',
                        'code'=>'joint_research_project_ru',
                        'available'=>$joint_research_project_ru
                    ],
                ]
            ],
            (object)[
                'group'=>'H Facilities',
                'modules'=>[
                    (object)[
                        'name'=>'Support Facilities',
                        'code'=>'support_facilities',
                        'available'=>$support_facilities
                    ],
                    (object)[
                        'name'=>'Library Facilities',
                        'code'=>'library_facilities',
                        'available'=>$library_facilities
                    ],
                ]
            ],
        ];
    }

    public function myraSectionA($year) {
        $ug_bachelor_local = MasterListStudent::where('ml_start_year', $year)->whereType('ug_student')->whereCitizenship('LOCAL')->count();
        $ug_bachelor_foreign = MasterListStudent::where('ml_start_year', $year)->whereType('ug_student')->whereCitizenship('FOREIGN')->count();
        $pg = MasterListStudent::where('ml_start_year', $year)->whereType('pg_student')->count();
        $phd = MasterListStudent::where('ml_start_year', $year)->whereType('phd_student')->count();
        $pg_research = MasterListStudent::where('ml_start_year', $year)->whereType('pg_student')->whereStudyMode('PENYELIDIKAN')->count();
        $pg_foreign = MasterListStudent::where('ml_start_year', $year)->whereType('pg_student')->whereCitizenship('ANTARABANGSA')->count();
        $master_local = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->whereCitizenship('TEMPATAN')->count();
        $master_foreign = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->whereCitizenship('ANTARABANGSA')->count();
        $master_research_local_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->whereStudyMode('PENYELIDIKAN')->whereCitizenship('TEMPATAN')->whereStudyType('SEPENUH MASA')->count();
        $master_research_local_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->whereStudyMode('PENYELIDIKAN')->whereCitizenship('TEMPATAN')->whereStudyType('SEPARUH MASA')->count();
        $master_research_foreign_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->whereStudyMode('PENYELIDIKAN')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPENUH MASA')->count();
        $master_research_foreign_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->whereStudyMode('PENYELIDIKAN')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPARUH MASA')->count();
        $master_coursework_local_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('TEMPATAN')->whereStudyType('SEPENUH MASA')->count();
        $master_coursework_local_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('TEMPATAN')->whereStudyType('SEPARUH MASA')->count();
        $master_coursework_foreign_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPENUH MASA')->count();
        $master_coursework_foreign_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('master_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPARUH MASA')->count();
        $phd_local_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('phd_student')->whereCitizenship('TEMPATAN')->whereStudyType('SEPENUH MASA')->count();
        $phd_local_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('phd_student')->whereCitizenship('TEMPATAN')->whereStudyType('SEPARUH MASA')->count();
        $phd_foreign_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('phd_student')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPENUH MASA')->count();
        $phd_foreign_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('phd_student')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPARUH MASA')->count();
        $doc_coursework_local_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('doc_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('TEMPATAN')->whereStudyType('SEPENUH MASA')->count();
        $doc_coursework_local_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('doc_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('TEMPATAN')->whereStudyType('SEPARUH MASA')->count();
        $doc_coursework_foreign_fulltime = MasterListStudent::where('ml_start_year', $year)->whereType('doc_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPENUH MASA')->count();
        $doc_coursework_foreign_parttime = MasterListStudent::where('ml_start_year', $year)->whereType('doc_student')->where('study_mode','!=','PENYELIDIKAN')->whereCitizenship('ANTARABANGSA')->whereStudyType('SEPARUH MASA')->count();

        return (object)[
            'ug_bachelor_local' => $ug_bachelor_local,
            'ug_bachelor_foreign' => $ug_bachelor_foreign,
            'pg' => $pg,
            'phd' => $phd,
            'pg_research' => $pg_research,
            'pg_foreign' => $pg_foreign,
            'master_local' => $master_local,
            'master_foreign' => $master_foreign,
            'master_research_local_fulltime' => $master_research_local_fulltime,
            'master_research_local_parttime' => $master_research_local_parttime,
            'master_research_foreign_fulltime' => $master_research_foreign_fulltime,
            'master_research_foreign_parttime' => $master_research_foreign_parttime,
            'master_coursework_local_fulltime' => $master_coursework_local_fulltime,
            'master_coursework_local_parttime' => $master_coursework_local_parttime,
            'master_coursework_foreign_fulltime' => $master_coursework_foreign_fulltime,
            'master_coursework_foreign_parttime' => $master_coursework_foreign_parttime,
            'phd_local_fulltime' => $phd_local_fulltime,
            'phd_local_parttime' => $phd_local_parttime,
            'phd_foreign_fulltime' => $phd_foreign_fulltime,
            'phd_foreign_parttime' => $phd_foreign_parttime,
            'doc_coursework_local_fulltime' => $doc_coursework_local_fulltime,
            'doc_coursework_local_parttime' => $doc_coursework_local_parttime,
            'doc_coursework_foreign_fulltime' => $doc_coursework_foreign_fulltime,
            'doc_coursework_foreign_parttime' => $doc_coursework_foreign_parttime,
        ];
    }
}