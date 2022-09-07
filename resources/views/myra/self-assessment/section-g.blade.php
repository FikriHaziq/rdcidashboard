@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section G @endslot
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
        <div class="font-medium text-center text-lg text-uppercase">SECTION G: NETWORKING AND LINKAGES {{ $year }}</div>
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
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" id="tab_1">
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
                                <td class="border border-slate-600 font-bold">Participation in International Inter-Institution Research Related Activities Under MoA</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of MoAs Signed and Stamped  </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->total_int_moa }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Industry </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->int_moa_industry }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Community/ NGO </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->int_moa_community }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iii. University </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->int_moa_university }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iv. Agency/ Research Institute  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->int_moa_agency }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Number of Staff Involved in Joint Research Projects Under MoA</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->total_staff_int_moa }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                                <td class="border border-slate-600 font-bold">Number of Staff Sent Abroad for Research Activities</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of Staff Sent Abroad for Research Activities</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->staff_sent_abroad }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">3</td>
                                <td class="border border-slate-600 font-bold">Membership in International Academic/ Professional Bodies/ Associations/ NGOs</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of Staff as Members in International Academic/ Professional Bodies/ Associations</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->member_international }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Number of Staff Appointed as Chairman/ Committee Members in International Academic/ Professional Bodies/ Associations/ NGOs</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->other_international }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="7">4</td>
                                <td class="border border-slate-600 font-bold">Participation in National Inter-Institution Research Related Activities Under MoA</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of MoAs Signed and Stamped  </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->total_nat_moa }}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Industry </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->nat_moa_industry }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Community/ NGO </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->nat_moa_community }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iii. University </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->nat_moa_university }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iv. Agency/ Research Institute  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->nat_moa_agency }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Number of Staff Involved in Joint Research Projects Under MoA</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->total_staff_nat_moa }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                                <td class="border border-slate-600 font-bold">Membership in National Academic/ Professional Bodies/ Associations/Ministry/ NGOs</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of Staff as Members in National Academic/ Professional Bodies/ Associations/ Ministry/ NGOs </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->member_national }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Number of Staff Appointed as Chairman/ Committee Members in National Academic/ Professional Bodies/ Associations/ Ministry/ NGOs</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->other_national }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="3">6</td>
                                <td class="border border-slate-600 font-bold">Knowledge/ Technology Diffusion Projects/ Assimilation (Social Innovation)</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of New Community-Related Projects</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->new_ktp }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Number of Communities Receiving/ Benefiting from the Knowledge/ Technology Diffusion Projects</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->benefited_ktp }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="2">7</td>
                                <td class="border border-slate-600 font-bold">Joint Research Projects Between Institution Assessed and Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Number of Collaborative Projects Between Institution Assessed and a Minimum of 3 Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->joint_research_project }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="2">8</td>
                                <td class="border border-slate-600 font-bold">Joint Research Projects between RUs in Each Project</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Number of Collaborative Projects between RUs with a Minimum of 4 Research Universities in Each Project</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->joint_research_project_ru }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                        MyRA I - 13 MARKS & MyRA II - 14 MARKS<br>
                        (CAPPED AT 100%/OUTPUT)
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
                                    <td class="border border-slate-600 fw-bold" rowspan="6">Participation in International Inter-Institution Research Related Activities Under MoA</td>
                                    <td class="border border-slate-600 fw-bold">a. Total Number of MoAs Signed and Stamped</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_1[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="9">{{ $data->calculation->myra1_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="9">{{ $data->calculation->myra2_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Industry</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[1], 0) }}</td>
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
                                    <td class="border border-slate-600">ii. Community/NGO</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[2] }}</td>
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
                                    <td class="border border-slate-600">iii. University</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[3], 0) }}</td>
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
                                    <td class="border border-slate-600">iv. Agency/Research Institute</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[4] }}</td>
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
                                    <td class="border border-slate-600 fw-bold">b. Percentage of Staff Involved in Joint Research Projects Under MoA</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[5] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[5] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[5], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_1[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_1[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">2</td>
                                    <td class="border border-slate-600 fw-bold">Number of Staff Sent Abroad for Research Activities</td>
                                    <td class="border border-slate-600 fw-bold">Total Number of Staff Sent Abroad for Research Activities</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_2[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra1_benchmark_2[0],2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_2[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">3</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Membership in International Academic/ Professional Bodies/Associations/NGOs</td>
                                    <td class="border border-slate-600 fw-bold">a. Total Number of Staff as Members in International Academic/Professional Bodies/ Associations/NGOs</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_3[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_3[0],2 ) }}%</td>
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
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">b. Total Number of Staff Appointed as Chairman/Committee Members in International Academic/Professional Bodies/Associations/NGOs</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_3[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_3[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_3[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_3[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_3[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_3[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_3[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_3[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="6">4</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="6">Participation in National Inter-Institution Research Related Activities Under MoA</td>
                                    <td class="border border-slate-600 fw-bold">a. Total Number of MoAs Signed and Stamped</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_4[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="8">{{ $data->calculation->myra1_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="8">{{ $data->calculation->myra2_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_4[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_4[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_4[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_4[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Industry</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_4[1], 0) }}</td>
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
                                    <td class="border border-slate-600">ii. Community/NGO</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_4[2], 0) }}</td>
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
                                    <td class="border border-slate-600">iii. University</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_4[3], 0) }}</td>
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
                                    <td class="border border-slate-600">iv. Agency/Research Institute</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[4] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_4[4], 0) }}</td>
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
                                    <td class="border border-slate-600 fw-bold">b. Percentage of Staff Involved in Joint Research Projects Under MoA</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_4[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_4[5] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_4[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_4[5] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_4[5], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_4[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_4[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_4[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_4[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_4[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_4[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_4[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">5</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Membership in National Academic/ Professional Bodies/Associations/NGOs</td>
                                    <td class="border border-slate-600 fw-bold">a. Total Number of Staff as Members in National Academic/Professional Bodies/ Associations/NGOs</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_5[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_5[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_5[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_5[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_5[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_5[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_5[0], 2) }}%</td>
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
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">b. Total Number of Staff Appointed as Chairman/Committee Members in National Academic/Professional Bodies/Associations/NGOs</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_5[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_5[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_5[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_5[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_5[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_5[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_5[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_5[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_5[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_5[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_5[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_5[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_5[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_5[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_5[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_5[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_5[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="2">6</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">Knowledge/ Technology Diffusion Projects/Assimilation (Social Innovation)</td>
                                    <td class="border border-slate-600 fw-bold">a. Total Number of New Community-Related Research Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_6[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_6[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_6[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra1_weightage_3 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_6[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_6[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra2_weightage_3 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_6[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_6[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_6[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_6[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">b. Total Number of Communities Receiving/Benefiting the Knowledge/Technology Diffusion Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_6[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_6[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_6[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_6[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_6[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_6[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_6[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_6[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_6[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_6[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_6[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_6[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_6[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_6[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_6[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_6[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_6[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">7</td>
                                    <td class="border border-slate-600 fw-bold">Joint Research Projects Between Institution Assessed and Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                                    <td class="border border-slate-600 fw-bold">Number of Collaborative Projects Between Institution Assessed and a Minimum of 3 Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_7[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_7[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_7[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_7[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_7[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_weightage_4 }}%</td>
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
                                    <td class="border border-slate-600 fw-bold">8</td>
                                    <td class="border border-slate-600 fw-bold">Joint Research Projects Between Research Universities in Each Project</td>
                                    <td class="border border-slate-600 fw-bold">Number of Collaborative Projects Between Research Universities with a Minimum of 4 RUs in Each Project</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_8[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_8[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_8[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_weightage_4 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_8[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_8[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_8[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_8[0], 2) }}%</td>
                                    
                                </tr>
                                <tr class="text-center total-mark">
                                    <td class="border border-slate-600 fw-bold" colspan="10">Total Mark for Section G</td>
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
        window.location = window.location.origin + '/myra/self-assessment/section-g/' + that.val();
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