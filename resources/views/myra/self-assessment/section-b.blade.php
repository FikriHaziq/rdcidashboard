@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-8">
    <h2 class="fs-lg fw-medium me-auto">
        RAW DATA MyRA-I (SELF ASSESSMENT)
    </h2>
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0">
        <div class="input-group">
            <div class="input-group-text">YEAR</div>
            <select class="form-select me-sm-2" onchange="getList($(this))">
                @for ($i = date('Y') - 5; $i <= date('Y'); $i++)
                <option value="{{$i}}" @if((int)$year===(int)$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
@include('myra.self-assessment.filter')
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-10 sm:py-20 mt-5">
    @include('myra.self-assessment.tabs', compact('year'))
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg text-uppercase">SECTION B: QUANTITY AND QUALITY OF RESEARCHERS {{ $year }}</div>
    </div>
</div>
<div class="intro-y box g-col-12 g-col-xxl-6 my-4">
    <div class="d-flex align-items-center px-5 py-5 py-sm-0 border-bottom border-gray-200 dark-border-dark-5">
        <ul class="nav nav-link-tabs ms-auto d-none d-sm-flex" role="tablist">
            <li class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-5 px-0 ms-6 active" data-bs-toggle="pill" data-bs-target="#criteria" role="tab" aria-controls="criteria-tab" aria-selected="true">Criteria</a> </li>
            <li class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-5 px-0 ms-6" data-bs-toggle="pill" data-bs-target="#calculation" role="tab" aria-controls="calculation-tab" aria-selected="false">Calculation</a> </li>
        </ul>
    </div>
    <div class="p-5">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="criteria" role="tabpanel" aria-labelledby="criteria-tab">
                <div class="px-5 sm:px-20 border-t border-gray-200 dark:border-dark-5">
                    <table class="table border-collapse border border-slate-500" id="sectionTable">
                        <thead>
                            <tr class="table-dark text-black">
                                <th class="whitespace-nowrap">No</th>
                                <th class="whitespace-nowrap">Criteria</th>
                                <th class="whitespace-nowrap">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="14">1</td>
                                <td class="border border-slate-600 font-bold">Critical Mass</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">Total Number of Active Academic Staff involved as Principal Investigators of Research Grants (FTE) </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->active_staff }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;a. University Grants </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->uni_staff }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->uni_staff_fulltime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->uni_staff_parttime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;b. National Grants  </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->national_staff }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->national_staff_fulltime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->national_staff_parttime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;c. Industrial/NGO/Private Grants </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->private_staff }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->private_staff_fulltime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->private_staff_parttime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;d. International Grants </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->international_staff }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->international_staff_fulltime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->international_staff_parttime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="7">2</td>
                                <td class="border border-slate-600 font-bold">PhDs or Professional Qualifications (FTE) </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->phd_pro }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;a. Total Number of Active Staff with PhDs/DSc, DEng, etc. </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->phd }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_fulltime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_parttime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;b. Total Number of Active Staff with Professional Postgraduate Qualifications  </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->pro }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->pro_fulltime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->pro_parttime }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="5">3</td>
                                <td class="border border-slate-600 font-bold">Research Experience of Active and Full Time Staff </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">Total Number of Staff in each Age Group (3 Cohorts)  </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->cohort_staff }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;a. >50 Years Old </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->a50 }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;b. 40-50 Years Old </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->a40 }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;c. <40 Years Old </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->b40 }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="7">4</td>
                                <td class="border border-slate-600 font-bold">Awards/ Stewardships Conferred by National and International Academic and Professional Bodies for Research Excellence </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;a. Total Number of Awards Conferred by International Academic and Professional Bodies for Research Excellence  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->award_int }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;b. Total Number of Recognitions/ Stewardships Conferred by International Academic and Professional Bodies for Research Excellence </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->recog_int }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;c. Total Number of Awards Conferred by National Academic and Professional Bodies for Research Excellence </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->award_nat }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;d. Total Number of Recognitions/ Stewardships Conferred by National Academic and Professional Bodies for Research Excellence </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->recog_nat }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;e. Research Exhibition Awards (gold medal / special awards)  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->exhibition }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;f. Other Research Awards </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->other }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                        
                            {{-- @foreach (getSection('A') as $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $item->criteria_name }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $item->criteria_name }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $item->criteria_data }}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="calculation" role="tabpanel" aria-labelledby="calculation-tab">
                <div class="px-5 sm:px-20 border-t border-gray-200 dark:border-dark-5">
                    <div class="alert alert-primary-soft d-flex align-items-center mb-2 fw-bolder fs-medium" role="alert">
                         MyRA I - 22 MARKS & MyRA II -13 MARKS<br /> (CAPPED AT 200% EXCEPT RESEARCH EXPERIENCE/INPUT)
                    </div>
                    <div class="box p-5 my-5">
                        <div class="d-flex">
                            <div class="me-auto">Total No. Active Staff</div>
                            <div class="fw-medium">{{ $data->calculation->active_acad_staff }}</div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="me-auto">No. of S&T</div>
                            <div class="fw-medium">{{ $data->calculation->active_st }}</div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="me-auto">No. of Non S&T</div>
                            <div class="fw-medium">{{ $data->calculation->active_nonst }}</div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-sm border-collapse border border-slate-500" id="sectionTable">
                            <thead>
                                <tr class="text-center">
                                    <th class="" colspan="6" style="border: 0px solid white!important;"></th>
                                    <th class="myra-1-header" colspan="7">Myra I</th>
                                    <th class="myra-2-header" colspan="7">Myra II</th>
                                </tr>
                                <tr class="myra-blue text-black text-center">
                                    <th class="whitespace-nowrap">No.</th>
                                    <th class="whitespace-nowrap">Criteria</th>
                                    <th class="whitespace-nowrap">KPI</th>
                                    <th class="whitespace-nowrap">Myra I</th>
                                    <th class="whitespace-nowrap">Myra II</th>
                                    <th class="whitespace-nowrap">{{ $year }}</th>
                                    <th class="whitespace-nowrap">Weightage</th>
                                    <th class="whitespace-nowrap">Sub-weightage</th>
                                    <th class="whitespace-nowrap">Benchmark</th>
                                    <th class="whitespace-nowrap">Benchmark Target</th>
                                    <th class="whitespace-nowrap">Benchmark Marks</th>
                                    <th class="whitespace-nowrap">Marks</th>
                                    <th class="whitespace-nowrap">Achievement (%)</th>
                                    <th class="whitespace-nowrap">Weightage</th>
                                    <th class="whitespace-nowrap">Sub-weightage</th>
                                    <th class="whitespace-nowrap">Benchmark</th>
                                    <th class="whitespace-nowrap">Benchmark Target</th>
                                    <th class="whitespace-nowrap">Benchmark Marks</th>
                                    <th class="whitespace-nowrap">Marks</th>
                                    <th class="whitespace-nowrap">Achievement (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="5">1</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="5">Critical Mass</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">Total Number of Active Academic Staff involved as Principal Investigator of Research Grants</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra_year_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra1_benchmark_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra2_benchmark_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">a. University Funded</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="4">{{ $data->calculation->myra1_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="4">{{ $data->calculation->myra2_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. National Grants</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. Industrial/NGO/Private Grants</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[2], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[2], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">d. International Grants</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[3], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[3], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">2</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">PhDs or Professional Qualifications</td>
                                    <td class="border border-slate-600">a. Total Number of Active Academic Staff with PhD/DSc, D.Eng., etc</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra1_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_2[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra2_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_2[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Total Number of Active Academic Staff with Professional Qualifications</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_2[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_2[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="4">3</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="4">Research Experience (3 cohorts)</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">Total Number of Active Academic Staff in each Age Group (3 Cohorts):</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra1_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra2_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra_year_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra1_benchmark_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_benchmark_target_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_benchmark_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra1_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ $data->calculation->myra2_benchmark_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_benchmark_target_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_benchmark_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra2_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">a. > 50 years old</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ $data->calculation->myra1_weightage_3 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_3[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_3[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ $data->calculation->myra2_weightage_3 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_3[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_3[1] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_3[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. 40-50 years old</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_3[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_3[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_3[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_3[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_3[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_3[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_3[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_3[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_3[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_3[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_3[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_3[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. < 40 years old</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_3[3] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_3[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_3[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_3[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_3[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_3[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_3[2], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_3[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_3[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_3[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_3[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_3[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_3[2], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="6">4</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="6">Awards and Recognitions Conferred by National and International Academic and Professional Bodies for Research Excellence</td>
                                    <td class="border border-slate-600">a. Total Number of AWARDS Conferred by INTERNATIONAL Academic and Professional Bodies for Research Excellence</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="6">{{ $data->calculation->myra1_weightage_4 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="6">{{ $data->calculation->myra2_weightage_4 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_4[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_4[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Total Number of RECOGNITION/STEWARDSHIP Conferred by INTERNATIONAL Academic and Professional Bodies for Research Excellence</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_4[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_4[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_4[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. Total Number of AWARDS Conferred by NATIONAL Academic and Professional Bodies for Research Excellence</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_4[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[2], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_4[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_4[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_4[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_4[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_4[2], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">d. Total Number of RECOGNITION/STEWARDSHIP Conferred by NATIONAL Academic and Professional Bodies for Research Excellence</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_4[3] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[3], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_4[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_4[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_4[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_4[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_4[3], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">e. Research Exhibition Awards (gold medals/ special awards)</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[4] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_4[4] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[4], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">f. Others Research Awards</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[5] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[5] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ $data->calculation->myra_year_4[5] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[5] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[5], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center total-mark">
                                    <td class="border border-slate-600 fw-bold" colspan="6">Total Mark for Section B</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->total_myra1_weightage }}%</td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->total_myra1_benchmark_mark }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->total_myra2_weightage }}%</td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->total_myra2_benchmark_mark }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra2_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold"></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- END: Wizard Layout -->
@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
    function getList(that) {
        window.location = window.location.origin + '/myra/self-assessment/section-b/' + that.val();
    }
    // $(document).ready(function () {
    //     $('#sectionTable').DataTable({
    //         "searching": false,
    //         "lengthChange": false,
    //         "paging": false
    //     });
    // });
</script>
@endsection
@endcomponent