@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section C @endslot
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
        <div class="font-medium text-center text-lg text-uppercase">SECTION C: QUANTITY AND QUALITY OF RESEARCH {{ $year }}</div>
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
                                <td class="align-top border border-slate-600 font-bold" rowspan="24">1</td>
                                <td class="border border-slate-600 font-bold">Publication</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total number of Publications in SCOPUS/WOS/ERA Indexed Journals </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Journals </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->journal }}" id="journal" name="journal" onchange="percentQ1Q2Journal()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Conference Proceedings </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->proceeding }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iii. Joint Publications </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 1. Industrial Collaborations</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->joint_industrial }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 2. International Collaborations</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->joint_international }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 3. National Collaborations (UA-UA, UA-US, US-US, Agencies/RI)</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->joint_national }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Publication Impact</td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Total Citations of Publications </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->citation }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Number of Articles Published in Q1 and Q2 Journals </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->q1_q2 }}" id="q1_q2" name="q1_q2" onchange="percentQ1Q2Journal()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iii. Percentage of Articles Published in Q1 and Q2 Journals </td>
                                <td class="border border-slate-600 font-bold text-center"><div id="q1_q2_percent">{{ $data->q1_q2_percent }}</div></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">c. Total Number of Publications in MyCite Indexed Journals </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->mycite }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">d. Research Books and Chapters</td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. No. of Research Books  </td>
                                <td class="border border-slate-600 font-bold text-center"><div id="book"></div></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 1. Books indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->book_indexed }}" name="book_indexed" id="book_indexed" onchange="totalBook()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 2. Books not indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->book_not_indexed }}" name="book_not_indexed" id="book_not_indexed" onchange="totalBook()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 3. National Collaborations (UA-UA, UA-US, US-US, Agencies/RI)</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->book_national }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. No. of Chapters in Research Books  </td>
                                <td class="border border-slate-600 font-bold text-center"><div id="chapter"></div></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 1. Chapters indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->chapter_indexed }}" name="chapter_indexed" id="chapter_indexed" onchange="totalChapter()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 2. Chapters not indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->chapter_not_indexed }}" name="chapter_not_indexed" id="chapter_not_indexed" onchange="totalChapter()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;iii. No. of Case Studies/Technical Reports</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->case_studies }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">e. Policy Papers</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->policy_paper }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">f. Other Publications (Publications in non-SCOPUS/WOS indexed journals, articles in magazines, newsletters, original writings and publications from conferences, digital or print media)</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->other }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="11">2</td>
                                <td class="border border-slate-600 font-bold">Research Grants for Academic Staff</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a.  Total Amount of Public Funds from Government Agencies/ Parent Bodies/ Home Universities/ Main Campus </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Total Amount Pledged for New Projects </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->home_pledge_new }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Total Amount Received for Active Projects  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->home_receive_active }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Amount of Private/Industrial/NGO Funds (including Contract Research) </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Total Amount Pledged for New Projects </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->private_pledge_new }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Total Amount Received for Active Projects  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->private_receive_active }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">c. Total Amount of International Funds </td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;i. Total Amount Pledged for New Projects </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->international_pledge_new }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">&emsp;ii. Total Amount Received for Active Projects  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->international_receive_active }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">d. Total Amount of Research Grants Received  </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->research_grant_received }}</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="4">3</td>
                                <td class="border border-slate-600 font-bold">Monitoring of Research Project Performance/ Progress</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Number of Research Projects completed without extension in year of assessment</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->project_without_ext }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Number of Research Projects completed with extension in year of assessment</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->project_with_ext }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">c. Percentage of Research Projects completed on time </td>
                                <td class="border border-slate-600 font-bold text-center">{{ $data->project_complete_on_time }}</td>
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
                         MyRA I - 30 MARKS & MyRA II - 35 MARKS<br /> (CAPPED AT 200% OUTPUT)
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
                                    <th class="myra-1-header table-border-black" colspan="8">Myra I</th>
                                    <th class="myra-2-header table-border-black" colspan="8">Myra II</th>
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
                                    <th class="whitespace-nowrap">Sub-sub-weightage</th>
                                    <th class="whitespace-nowrap">Benchmark</th>
                                    <th class="whitespace-nowrap">Benchmark Target</th>
                                    <th class="whitespace-nowrap">Benchmark Marks</th>
                                    <th class="whitespace-nowrap">Marks</th>
                                    <th class="whitespace-nowrap">Achievement (%)</th>
                                    <th class="whitespace-nowrap">Weightage</th>
                                    <th class="whitespace-nowrap">Sub-weightage</th>
                                    <th class="whitespace-nowrap">Sub-sub-weightage</th>
                                    <th class="whitespace-nowrap">Benchmark</th>
                                    <th class="whitespace-nowrap">Benchmark Target</th>
                                    <th class="whitespace-nowrap">Benchmark Marks</th>
                                    <th class="whitespace-nowrap">Marks</th>
                                    <th class="whitespace-nowrap">Achievement (%)</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-black">
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="22">1</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="22">Publications</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">a. Total Number of Publications in SCOPUS/WOS/ERA</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Journals</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="21">{{ $data->calculation->myra1_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="9">{{ $data->calculation->myra1_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="21">{{ $data->calculation->myra2_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="6">{{ $data->calculation->myra2_subweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[0] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">ii. Conference Proceedings</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[1], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[1] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">iii. Joint Publications:</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">1. Industrial Collaborations</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[2], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[2], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[2] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[2], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">2. International Collaborations</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[3], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[3], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[3] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[3] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[3], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">3. National Collaboration (UA-UA, UA-US, US-US, Agencies/Research Institutes)</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[4], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[4], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[4] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[4], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[4] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[4], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">b. Publication Impact:</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Total Citations of Publications</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[5] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[5] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[5], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[5] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[5] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[5], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="2">{{ $data->calculation->myra2_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[5] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[5] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[5] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[5], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">ii. Number of Articles Published in Q1 and Q2 Journals</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[6] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[6] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[6] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[6] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[6], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[6] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[6] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[6], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[6], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[6] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[6], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">iii. Percentage of Articles Published in Q1 and Q2 Journals</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[7] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[7] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[7] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[7] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[7]*100, 2) }}%</td>
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
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. Total Number of Publications in MyCite Indexed Journals</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[8] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[8] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[8] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[8] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[8], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[6] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[6] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[6], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[6], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[6], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[6], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[7] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[7] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[7], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[7], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[7] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[7], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">d. Research Books and Chapters</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">i. Number of Research Books</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_1[9], 0) }}</td>
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
                                    <td class="border border-slate-600">1. Indexed Research Books in Scopus/WOS</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[9] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[9] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[9] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[9] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[10], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange" rowspan="6">{{ $data->calculation->myra1_subweightage_1[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subsubweightage_1[7] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[7] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[7], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[7], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[7], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[7], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-orange" rowspan="6">{{ $data->calculation->myra2_subweightage_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[8] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[8] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[8], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-bright-yellow">{{ number_format($data->calculation->myra2_benchmark_mark_1[8], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[8] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[8], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">2. Non-Indexed Research Books</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[10] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[10] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[10] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[10] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[11], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subsubweightage_1[8] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[8] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[8], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[8], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[8], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[8], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[9] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[9] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[9], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-bright-yellow">{{ number_format($data->calculation->myra2_benchmark_mark_1[9], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[9] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[9], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">ii. Number of Chapters in Research Books</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown">{{ number_format($data->calculation->myra_year_1[12], 0) }}</td>
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
                                    <td class="border border-slate-600">1. Chapters in Research Books Indexed in Scopus/WOS</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[11] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[11] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[11] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[11] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[13], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subsubweightage_1[9] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[9] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[9], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra1_benchmark_mark_1[9], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[9], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[9], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[10] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[10] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[10], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra2_benchmark_mark_1[10], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[10] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[10], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">2. Chapters in Non-Indexed Research Books</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[12] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[12] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[12] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[12] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[14], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subsubweightage_1[10] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[10] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[10], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra1_benchmark_mark_1[10], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[10], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[10], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[11] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[11] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[11], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra2_benchmark_mark_1[11], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[11] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[11], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">3. Number of Case Studies/Technical Reports</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[13] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[13] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[13] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[13] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[15], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ $data->calculation->myra1_subsubweightage_1[11] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[11] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[11], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra1_benchmark_mark_1[11], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[11], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[11], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[12] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[12] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[12], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-orange">{{ number_format($data->calculation->myra2_benchmark_mark_1[12], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[12] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[12], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">e. Policy Papers</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[14] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[14] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[14] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[14] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[16], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[3] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[12] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[12] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[12], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[12], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[12], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[12], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[13] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[13] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[13], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[13], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[13] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[13], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">f. Other Publications (Publications in other journal, articles in magazines, newsletters, original writings and publications from conferences, digital or print media)</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[15] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[15] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[15] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[15] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[17], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_1[4] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_1[13] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_1[13] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[13], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[13], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[13], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[13], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_1[5] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_1[14] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_1[14] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[14], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[14], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[14] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[14], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="10">2</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="10">Research Grants for Academic Staff</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">a. Total Amount of Public Funds from Government Agencies/Parent Bodies/Home Universities/Main Campus</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Total Amount Pledged for New Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="9">{{ $data->calculation->myra1_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold" rowspan="9">{{ $data->calculation->myra2_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">ii. Total Amount Received for Active Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_2[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_2[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_2[0] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_2[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">b. Total Amount of Private/Industrial/NGO Funds (including Contract Research)</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Total Amount Pledged for New Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[2], 2) }}</td>
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
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">ii. Total Amount Received for Active Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[3] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[3] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[3] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[3], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_2[1], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_2[1] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_2[1] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_2[1], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_2[1] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_2[1], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">c. Total Amount of Inernational Funds</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">i. Total Amount Pledged for New Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[4] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[4] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[4] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[4], 2) }}</td>
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
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">ii. Total Amount Received for Active Projects</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_2[5] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[5] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_2[5] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[5], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_2[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_2[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_benchmark_2[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_2[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_2[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_2[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_2[2], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subweightage_2[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_subsubweightage_2[2] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_benchmark_2[2] }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_2[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_2[2], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_2[2] , 2)}}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_2[2], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold myra-brown">d. Total amount of Research Grants Received</td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">RM {{ number_format($data->calculation->myra_year_2[6], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                    <td class="border border-slate-600 fw-bold"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="4">3</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="4">Monitoring of Research Project Performance / Progress</td>
                                    <td class="border border-slate-600 fw-bold myra-brown">Monitoring of Research Project Performance/Progress</td>
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
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                    <td class="border border-slate-600 fw-bold myra-brown"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">a. Number of Research Projects Completed Without Extension in Year of Assessment </td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_3[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ $data->calculation->myra1_weightage_3 }}%</td>
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
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">b. Number of Research Projects Completed With Extension in Year of Assessment</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[1] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[1] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_3[1], 0) }}</td>
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
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600">c. Percentage of Research Projects Completed on Time</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_3[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_3[2] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_3[2] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_3[2]*100, 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subweightage_3[0] }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_subsubweightage_3[0] }}%</td>
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
                                    <td class="border border-slate-600 fw-bold myra-dark-gray"></td>
                                </tr>
                                <tr class="text-center total-mark">
                                    <td class="border border-slate-600 fw-bold" colspan="11">Total Mark for Section C</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_benchmark_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" colspan="6"></td>
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
    
    <!-- END: Wizard Layout -->
@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
    function getList(that) {
        window.location = window.location.origin + '/myra/self-assessment/section-c/' + that.val();
    }

    $(document).ready(function () {
        // percentQ1Q2Journal();
        totalBook();
        totalChapter();
    });

    // function percentQ1Q2Journal() {
    //     var journal = parseInt($('#journal').val()||0);
    //     var q1_q2 = parseInt($('#q1_q2').val()||0);
    //     if(journal > 0)$('#q1_q2_percent').html((q1_q2/journal*100).toFixed(2));
    //     else $('#q1_q2_percent').html(0.toFixed(2));
    // }

    function totalBook() {
        var indexed = parseInt($('#book_indexed').val()||0);
        var not_indexed = parseInt($('#book_not_indexed').val()||0);
        $('#book').html(indexed+not_indexed);
    }

    function totalChapter() {
        var indexed = parseInt($('#chapter_indexed').val()||0);
        var not_indexed = parseInt($('#chapter_not_indexed').val()||0);
        $('#chapter').html(indexed+not_indexed);
    }
</script>
@endsection
@endcomponent