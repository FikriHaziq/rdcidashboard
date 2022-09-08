@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section D @endslot
@section('custom-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
<style>
    td.highlight {
        background-color: whitesmoke !important;
    }
</style>
@endsection
@slot('content')
<div class="intro-y d-flex flex-column flex-sm-row align-items-center mt-5">
    <h2 class="fs-lg fw-medium me-auto">
        RAW DATA MyRA-I (SELF ASSESSMENT)
    </h2>
    <div class="w-full w-sm-auto d-flex mt-4 mt-sm-0">
        <div class="input-group">
            <div class="input-group-text">YEAR</div>
            <select class="form-select me-sm-2" onchange="getList($(this))">
                @for ($i = date('Y') - 8; $i <= date('Y'); $i++)
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
        <div class="font-medium text-center text-lg text-uppercase">SECTION D: QUANTITY AND QUALITY OF POSTGRADUATES {{ $year }}</div>
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
                <div class="px-5 sm:px-20 border-t border-gray-200 dark:border-dark-5" id="tab_1">
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
                                <td class="align-top border border-slate-600 font-bold" rowspan="7">1</td>
                                <td class="border border-slate-600 font-bold">Number of PhDs Graduated in the Year of Assessment</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of PhDs Graduated</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->total_phd }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i.Total Number of Local PhDs Graduated  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_local }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii.Total Number of International PhDs Graduated  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_foreign }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Ratio of PhDs Graduated to Active Academic Staff</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->phd_ratio }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">c. Number of PhDs Graduated within 7 Semesters or 42 Months</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_graduate_7 }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">d. Percentage of PhDs Graduated within 7 Semesters or 42 Months </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->phd_graduate_7_percent }}</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                                <td class="border border-slate-600 font-bold">Number of Masters Graduated in the Year of Assessment</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of Masters (Research Mode) Graduated</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->total_master }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="4">3</td>
                                <td class="border border-slate-600 font-bold">Number of PhDs Enrolled in the Year of Assessment</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of PhDs Enrolled</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->total_phd_enrolled }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Ratio of PhDs Enrolled to Active Academic Staff</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->phd_enrolled_ratio }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">c. Total Number of PhDs Enrolled in S&T </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->total_phd_st_enrolled }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">4</td>
                                <td class="border border-slate-600 font-bold">Postgraduate Enrolment in the Year of Assessment</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Ratio of Postgraduates Enrolled to Active Academic Staff</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->pg_enrolled_ratio }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Ratio of Postgraduates Enrolled (based on research and mixed modes only) to Undergraduates Enrolled</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->pg_enrolled_mixed_mode_ratio }}</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                                <td class="border border-slate-600 font-bold">Number of International Postgraduates Enrolled in the Year of Assessment</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of International Postgraduates Enrolled</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->int_pg_enrolled }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Percentage of International Postgraduates to Total Number of Postgraduates Enrolled</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->int_pg_enrolled_percent }}</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">6</td>
                                <td class="border border-slate-600 font-bold">Entry Qualification Level of Postgraduates</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Number of Postgraduates Enrolled with CGPA >=3.0 or Equivalent for their First Degree</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->entry_enrolled }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Percentage of Postgraduates Enrolled with CGPA >=3.0 or Equivalent for their First Degree</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->entry_enrolled_percent }}</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">7</td>
                                <td class="border border-slate-600 font-bold">Total Number of Fellowships/ Grants Awarded by Prestigious Bodies to Postgraduates via Research Mode</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Number of Postgraduates Enrolled via Research Mode with Fellowships/ Grants in the Year of Assessment </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->fellowship_enrolled }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Percentage of Postgraduates Enrolled via Research Mode with Fellowships/ Grants</td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->fellowship_enrolled_percent }}</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">8</td>
                                <td class="border border-slate-600 font-bold">Number of Post-doctorals in the Year of Assessment </td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Local PostDocs</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->local_post_doc }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Foreign PostDocs</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->foreign_post_doc }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                        MyRA I - 15 MARKS (CAPPED AT 200%/INPUT & OUTPUT) <br>
                        MyRA II - 10 MARKS (CAPPED AT 200% EXCEPT POST- DOCS APPOINTMENT/INPUT & OUTPUT)
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
                        <table class="table table-sm border-collapse" id="sectionTable">
                            <thead>
                                <tr class="text-center">
                                    <th class="" colspan="6"></th>
                                    <th class="myra-1-header table-border-black" colspan="7">Myra I</th>
                                    <th class="myra-2-header table-border-black" colspan="7">Myra II</th>
                                </tr>
                                <tr class="myra-blue text-black text-center table-border-black">
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
                            <tbody class="table-border-black">
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="6">1</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="6">Number of PhDs Graduated</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">a. Total Number of PhDs Graduated in the Year</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_1[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Total Number of Local PhDs (Research Mode) Graduated in the Year</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="13">{{ $data->calculation->myra1_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold" rowspan="5">{{ $data->calculation->myra2_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">ii. Total Number of International PhDs (Research Mode) Graduated in the Year</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[2], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Ratio of PhDs Graduated to Active Academic Staff</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. Number of PhDs Graduated within 7 Semesters or 42 Months</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[4], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">d. Percentage of PhDs Graduated within 7 Semesters or 42 Months</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_1[5]*100, 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">2</td>
                                    <td class="border border-slate-600 fw-bold">Number of Masters Graduated</td>
                                    <td class="border border-slate-600">a. Total Number of Masters (Research Mode) Graduated in the Year</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_2[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold" >{{ $data->calculation->myra2_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="3">3</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">Number of PhDs Enrolled</td>
                                    <td class="border border-slate-600">a. Total Number of PhDs Enrolled</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_3[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Ratio of PhDs Enrolled to Active Academic Staff</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_3[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subweightage_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_3[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. Total Number of PhDs Enrolled in S&T</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_3[2], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">4</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Postgraduates Enrolment</td>
                                    <td class="border border-slate-600">a. Ratio of Postgraduates Enrolled to Active Academic Staff</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_4[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange" rowspan="2">{{ $data->calculation->myra1_subweightage_4[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Ratio of Postgraduates Enrolled (based on Research and Mixed Modes only) to Undergraduates Enrolled</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_4[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">5</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Number of International Postgraduates</td>
                                    <td class="border border-slate-600">a. Total Number of International Postgraduates Enrolled</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_5[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_5[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_5[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_5[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_5[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange" rowspan="2">{{ $data->calculation->myra1_subweightage_5[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Percentage of International Postgraduates to Total Number of Postgraduates Enrolled</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_5[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_5[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_5[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_5[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_5[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_5[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_5[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_5[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_5[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_5[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">6</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Entry Qualification Level of Postgraduates</td>
                                    <td class="border border-slate-600">a. Number of Postgraduates Enrolled with CGPA ≥ 3.0 or Equivalent for their First Degree</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_6[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_6[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_6[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="4">{{ $data->calculation->myra1_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-orange" rowspan="3">{{ $data->calculation->myra1_subweightage_6[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Percentage of Postgraduates Enrolled with CGPA ≥ 3.0 or Equivalent for their First Degree</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_6[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_6[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_6[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_6[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_6[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_6[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">7</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Total Number of Fellowships/Grants Awarded to Postgraduates via Research Mode</td>
                                    <td class="border border-slate-600">a. Number of Postgraduates Enrolled via Research Mode with Fellowships/Grants</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_7[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_7[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_7[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_7[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_7[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Percentage of Postgraduates Enrolled via Research Mode with Fellowships/Grants</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_7[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_7[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_7[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_7[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_7[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_7[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_7[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_7[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_7[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_7[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_7[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="3">8</td>
                                    <td class="border border-slate-300 fw-bold" rowspan="3">Postdoctoral Appointments</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">Number of Postdoctoral Research Fellows :</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_8[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">a. Number of Local Postdoctoral</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_8[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_8[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_8[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra1_weightage_3 }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra1_subweightage_8[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra1_benchmark_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ number_format($data->calculation->myra1_benchmark_target_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ number_format($data->calculation->myra1_benchmark_mark_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ number_format($data->calculation->myra1_mark_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink" rowspan="2">{{ number_format($data->calculation->myra1_achievement_8[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra2_weightage_3 }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra2_subweightage_8[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra2_benchmark_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ number_format($data->calculation->myra2_benchmark_target_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ number_format($data->calculation->myra2_benchmark_mark_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ number_format($data->calculation->myra2_mark_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink" rowspan="2">{{ number_format($data->calculation->myra2_achievement_8[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">a. Number of Foreign Postdoctoral</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_8[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_8[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_8[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_8[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_8[2], 0) }}</td>
                                </tr>
                                <tr class="text-center total-mark">
                                    <td class="border border-slate-600 fw-bold" colspan="10">Total Mark for Section D</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_benchmark_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" colspan="5"></td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra2_benchmark_mark, 2) }}</td>
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
        window.location = window.location.origin + '/myra/self-assessment/section-d/' + that.val();
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