<?php
namespace App\Http\Traits;
use App\Models\MasterList\MasterlistUgStudent;
use App\Models\MasterList\MasterlistAward;
use App\Models\MasterList\MasterlistPublication;
use App\Models\DataAttachment;

trait MasterListPmTrait {

    public function getPmModuleAvailability($year) {
        $claim = DataAttachment::whereModule('claim')->where('year', $year)->whereStatus('selected')->exists();
        $elnpt_activity = DataAttachment::whereModule('elnpt_activity')->where('year', $year)->whereStatus('selected')->exists();
        $elnpt_grant_application = DataAttachment::whereModule('elnpt_grant_application')->where('year', $year)->whereStatus('selected')->exists();
        $elnpt_spb_gra = DataAttachment::whereModule('elnpt_spb_gra')->where('year', $year)->whereStatus('selected')->exists();
        $elnpt_proposal = DataAttachment::whereModule('elnpt_proposal')->where('year', $year)->whereStatus('selected')->exists();
        $active_grant = DataAttachment::whereModule('active_grant')->where('year', $year)->whereStatus('selected')->exists();
        $raro_process = DataAttachment::whereModule('raro_process')->where('year', $year)->whereStatus('selected')->exists();
        
        return [
            (object)[
                'group'=>'eLNPT',
                'modules'=>[
                    (object)[
                        'name'=>'Claim SPB',
                        'code'=>'claim',
                        'available'=>$claim
                    ],
                    (object)[
                        'name'=>'Activity',
                        'code'=>'elnpt_activity',
                        'available'=>$elnpt_activity
                    ],
                    (object)[
                        'name'=>'Grant Application',
                        'code'=>'elnpt_grant_application',
                        'available'=>$elnpt_grant_application
                    ],
                    (object)[
                        'name'=>'SPB GRA',
                        'code'=>'elnpt_spb_gra',
                        'available'=>$elnpt_spb_gra
                    ],
                    (object)[
                        'name'=>'Proposal',
                        'code'=>'elnpt_proposal',
                        'available'=>$elnpt_proposal
                    ],
                    (object)[
                        'name'=>'Active Grant',
                        'code'=>'active_grant',
                        'available'=>$active_grant
                    ],
                    (object)[
                        'name'=>'RARO Process',
                        'code'=>'raro_process',
                        'available'=>$raro_process
                    ],
                ], 
            ],
        ];
    }
}