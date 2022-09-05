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
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" id="tab_2">
                    <table class="table border-collapse border border-slate-500" id="sectionTable">
                        <thead>
                            <tr class="bg-gray-400 dark:bg-dark-1 text-black">
                                <th class="whitespace-nowrap">No.</th>
                                <th class="whitespace-nowrap">Criteria</th>
                                <th class="whitespace-nowrap">Unit Data</th>
                                <th class="whitespace-nowrap">Input Data</th>
                                <th class="whitespace-nowrap">Mark Obtained</th>
                                <th class="whitespace-nowrap">Benchmark</th>
                                <th class="whitespace-nowrap">Benchmark Scores</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="21">1</td>
                                <td class="border border-slate-600 font-bold" colspan="6">Publication</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">a. Total number of Publications in SCOPUS/WOS/ERA Indexed Journals </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;i. Journals </td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">1.74</td>
                                <td class="border border-slate-600 text-center">3.02</td>
                                <td class="border border-slate-600 text-center">2.00</td>
                                <td class="border border-slate-600 text-center">3.465</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;ii. Conference Proceedings </td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.64</td>
                                <td class="border border-slate-600 text-center">0.74</td>
                                <td class="border border-slate-600 text-center">0.50</td>
                                <td class="border border-slate-600 text-center">0.578</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;iii. Joint Publications </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 1. Industrial Collaborations</td>
                                <td class="border border-slate-600 text-center">No. of joint articles/staff</td>
                                <td class="border border-slate-600 text-center">0.02</td>
                                <td class="border border-slate-600 text-center">0.07</td>
                                <td class="border border-slate-600 text-center">0.30</td>
                                <td class="border border-slate-600 text-center">1.040</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 2. International Collaborations</td>
                                <td class="border border-slate-600 text-center">No. of joint articles/staff</td>
                                <td class="border border-slate-600 text-center">1.07</td>
                                <td class="border border-slate-600 text-center">2.08</td>
                                <td class="border border-slate-600 text-center">0.30</td>
                                <td class="border border-slate-600 text-center">1.040</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 3. National Collaborations (UA-UA, UA-US, US-US, Agencies/RI)</td>
                                <td class="border border-slate-600 text-center">No. of joint articles/staff</td>
                                <td class="border border-slate-600 text-center">0.63</td>
                                <td class="border border-slate-600 text-center">1.62</td>
                                <td class="border border-slate-600 text-center">0.30</td>
                                <td class="border border-slate-600 text-center">0.809</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">b. Publication Impact</td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;i. Total Citations of Publications </td>
                                <td class="border border-slate-600 text-center">cumulative citations/institution</td>
                                <td class="border border-slate-600 text-center">100874</td>
                                <td class="border border-slate-600 text-center">9.24</td>
                                <td class="border border-slate-600 text-center">10000</td>
                                <td class="border border-slate-600 text-center">4.620</td>
                            </tr>
                            
                            <tr>
                                <td class="border border-slate-600 ">c. Total Number of Publications in MyCite Indexed Journals </td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.31</td>
                                <td class="border border-slate-600 text-center">0.91</td>
                                <td class="border border-slate-600 text-center">0.50</td>
                                <td class="border border-slate-600 text-center">1.485</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">d. Research Books and Chapters</td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;i. No. of Research Books  </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 1. Books indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.00</td>
                                <td class="border border-slate-600 text-center">0.01</td>
                                <td class="border border-slate-600 text-center">0.10</td>
                                <td class="border border-slate-600 text-center">0.92</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 2. Books not indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.02</td>
                                <td class="border border-slate-600 text-center">0.02</td>
                                <td class="border border-slate-600 text-center">0.10</td>
                                <td class="border border-slate-600 text-center">0.13</td>
                            </tr>
                            
                            <tr>
                                <td class="border border-slate-600 ">&emsp;ii. No. of Chapters in Research Books  </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 1. Chapters indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.04</td>
                                <td class="border border-slate-600 text-center">0.07</td>
                                <td class="border border-slate-600 text-center">0.30</td>
                                <td class="border border-slate-600 text-center">0.50</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600">&emsp;&emsp; 2. Chapters not indexed in SCOPUS/WOS</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.07</td>
                                <td class="border border-slate-600 text-center">0.05</td>
                                <td class="border border-slate-600 text-center">0.30</td>
                                <td class="border border-slate-600 text-center">0.21</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;iii. No. of Case Studies/Technical Reports</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.035</td>
                                <td class="border border-slate-600 text-center">0.15</td>
                                <td class="border border-slate-600 text-center">0.20</td>
                                <td class="border border-slate-600 text-center">0.871</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">e. Policy Papers</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">0.003</td>
                                <td class="border border-slate-600 text-center">0.16</td>
                                <td class="border border-slate-600 text-center">0.01</td>
                                <td class="border border-slate-600 text-center">0.495</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">f. Other Publications (Publications in non-SCOPUS/WOS indexed journals, articles in magazines, newsletters, original writings and publications from conferences, digital or print media)</td>
                                <td class="border border-slate-600 text-center">No./staff</td>
                                <td class="border border-slate-600 text-center">1.57</td>
                                <td class="border border-slate-600 text-center">0.52</td>
                                <td class="border border-slate-600 text-center">1.00</td>
                                <td class="border border-slate-600 text-center">0.33</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="11">2</td>
                                <td class="border border-slate-600 font-bold" colspan="6">Research Grants for Academic Staff</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">a.  Total Amount of Public Funds from Government Agencies/ Parent Bodies/ Home Universities/ Main Campus </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;i. Total Amount Pledged for New Projects </td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;ii. Total Amount Received for Active Projects  </td>
                                <td class="border border-slate-600 text-center">RM/staff</td>
                                <td class="border border-slate-600 text-center">28911.44</td>
                                <td class="border border-slate-600 text-center">6.86</td>
                                <td class="border border-slate-600 text-center">25299.44</td>
                                <td class="border border-slate-600 text-center">6.00</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">b. Total Amount of Private/Industrial/NGO Funds (including Contract Research) </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;i. Total Amount Pledged for New Projects </td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;ii. Total Amount Received for Active Projects  </td>
                                <td class="border border-slate-600 text-center">RM/staff</td>
                                <td class="border border-slate-600 text-center">3683.74</td>
                                <td class="border border-slate-600 text-center">0.99</td>
                                <td class="border border-slate-600 text-center">8955.43</td>
                                <td class="border border-slate-600 text-center">2.40</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">c. Total Amount of International Funds </td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                                <td class="border border-slate-600 text-center"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;i. Total Amount Pledged for New Projects </td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">&emsp;ii. Total Amount Received for Active Projects  </td>
                                <td class="border border-slate-600 text-center">RM/staff</td>
                                <td class="border border-slate-600 text-center">3138.47</td>
                                <td class="border border-slate-600 text-center">1.07</td>
                                <td class="border border-slate-600 text-center">10522.28</td>
                                <td class="border border-slate-600 text-center">3.60</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">d. Total Amount of Research Grants Received  </td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="4">3</td>
                                <td class="border border-slate-600 font-bold" colspan="6">Monitoring of Research Project Performance/ Progress</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">a. Number of Research Projects completed without extension in year of assessment</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">b. Number of Research Projects completed with extension in year of assessment</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                                <td class="border border-slate-600 text-center">-</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 ">c. Percentage of Research Projects completed on time </td>
                                <td class="border border-slate-600 text-center">%</td>
                                <td class="border border-slate-600 text-center">59.21</td>
                                <td class="border border-slate-600 text-center">1.48</td>
                                <td class="border border-slate-600 text-center">60.00</td>
                                <td class="border border-slate-600 text-center">1.50</td>
                            </tr>
                            <tr class="bg-gray-400 text-black">
                                <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section C</td>
                                <td class="border border-slate-600 font-bold text-center">29.05</td>
                                <td class="border border-slate-600 font-bold text-center"></td>
                                <td class="border border-slate-600 font-bold text-center">30</td>
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