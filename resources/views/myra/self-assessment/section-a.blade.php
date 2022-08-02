@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section A @endslot
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
<!-- BEGIN: Wizard Layout -->
@include('myra.self-assessment.filter')
<div class="intro-y box py-10 sm:py-20 mt-5">
    @include('myra.self-assessment.tabs', compact('year'))
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg text-uppercase">SECTION A: GENERAL INFORMATION {{ $year }}</div>
    </div>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="41">1</td>
                    <td class="border border-slate-600 font-bold">Total Number of Academic Staff (permanent/contract staff)</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Number of Academic Staff (including staff on study leave) (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">1605</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Professors (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">193</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="193" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Associate Professors (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">360</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="360" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Senior Lecturers (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">992</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="992" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Lecturers (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">60</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="60" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Research Fellows (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">0</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Number of Active Academic Staff (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">1593</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Professors (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">187</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="187" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Associate Professors (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">359</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="359" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Senior Lecturers (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">989</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="989" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Lecturers (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">58</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="58" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Research Fellows (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">0</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">c. Total Number of Active S&T Academic Staff (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">1177</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="1177" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">d. Total Number of Active Non-S&T Academic Staff (FTE)  </td>
                    <td class="border border-slate-600 font-bold text-center">416</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">e. Percentage of Active S&T Academic Staff </td>
                    <td class="border border-slate-600 font-bold text-center">73.89</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">f. Total Number of Active Foreign Academic Staff (FTE)  </td>
                    <td class="border border-slate-600 font-bold text-center">53</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="53" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="41">2</td>
                    <td class="border border-slate-600 font-bold">Total Number of Fulltime Students</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="total_fulltime"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Number of Local and Foreign Undergraduate Students </td>
                    <td class="border border-slate-600 font-bold text-center"><div id="total_ug"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;i. Bachelor (Local)</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->ug_bachelor_local }}" id="ug_bachelor_local" name="ug_bachelor_local" onchange="totalFulltime()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;ii. Bachelor (Foreign)</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->ug_bachelor_foreign }}" id="ug_bachelor_foreign" name="ug_bachelor_foreign" onchange="totalFulltime()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Number of Local and Foreign Postgraduate Students </td>
                    <td class="border border-slate-600 font-bold text-center"><div id="total_pg">{{ $data->pg }}</div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;PhDs </td>
                    <td class="border border-slate-600 font-bold text-center">{{ $data->phd }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;Postgraduates by Research </td>
                    <td class="border border-slate-600 font-bold text-center">{{ $data->pg_research }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;Postgraduates (Foreign)  </td>
                    <td class="border border-slate-600 font-bold text-center">{{ $data->pg_foreign }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;Masters (Local)  </td>
                    <td class="border border-slate-600 font-bold text-center">{{ $data->master_local }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;Masters (Foreign)  </td>
                    <td class="border border-slate-600 font-bold text-center">{{ $data->master_foreign }}</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Masters - Research (Local) FTE</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="master_research_local"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_research_local_fulltime }}" id="master_research_local_fulltime" name="master_research_local_fulltime" onchange="totalMRL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_research_local_parttime }}" id="master_research_local_parttime" name="master_research_local_parttime" onchange="totalMRL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;ii. Masters - Research (Foreign) FTE</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="master_research_foreign"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_research_foreign_fulltime }}" id="master_research_foreign_fulltime" name="master_research_foreign_fulltime" onchange="totalMRF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_research_foreign_parttime }}" id="master_research_foreign_parttime" name="master_research_foreign_parttime" onchange="totalMRF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;iii. Masters - Coursework (Local) FTE</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="master_coursework_local"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_coursework_local_fulltime }}" id="master_coursework_local_fulltime" name="master_coursework_local_fulltime" onchange="totalMCL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_coursework_local_parttime }}" id="master_coursework_local_parttime" name="master_coursework_local_parttime" onchange="totalMCL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;iv. Masters - Coursework (Foreign) FTE</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="master_coursework_foreign"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_coursework_foreign_fulltime }}" id="master_coursework_foreign_fulltime" name="master_coursework_foreign_fulltime" onchange="totalMCF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->master_coursework_foreign_parttime }}" id="master_coursework_foreign_parttime" name="master_coursework_foreign_parttime" onchange="totalMCF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;v. PhDs (Local) FTE</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="phd_local"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_local_fulltime }}" id="phd_local_fulltime" name="phd_local_fulltime" onchange="totalPHDL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_local_parttime }}" id="phd_local_parttime" name="phd_local_parttime" onchange="totalPHDL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;vi. PhDs (Foreign) FTE</td>
                    <td class="border border-slate-600 font-bold text-center"><div id="phd_foreign"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_foreign_fulltime }}" id="phd_foreign_fulltime" name="phd_foreign_fulltime" onchange="totalPHDF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->phd_foreign_parttime }}" id="phd_foreign_parttime" name="phd_foreign_parttime" onchange="totalPHDF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;vii. Doctoral Level Coursework (Local) FTE </td>
                    <td class="border border-slate-600 font-bold text-center"><div id="doc_coursework_local"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->doc_coursework_local_fulltime }}" id="doc_coursework_local_fulltime" name="doc_coursework_local_fulltime" onchange="totalDCL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->doc_coursework_local_parttime }}" id="doc_coursework_local_parttime" name="doc_coursework_local_parttime" onchange="totalDCL()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;viii. Doctoral Level Coursework (Foreign) FTE </td>
                    <td class="border border-slate-600 font-bold text-center"><div id="doc_coursework_foreign"></div></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->doc_coursework_foreign_fulltime }}" id="doc_coursework_foreign_fulltime" name="doc_coursework_foreign_fulltime" onchange="totalDCF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->doc_coursework_foreign_parttime }}" id="doc_coursework_foreign_parttime" name="doc_coursework_foreign_parttime" onchange="totalDCF()" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" /></td>
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
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" id="tab_2">
    </div>
</div>
    <!-- END: Wizard Layout -->
@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        totalFulltime();
        totalMRL();
        totalMRF();
        totalMCL();
        totalMCF();
        totalPHDL();
        totalPHDF();
        totalDCL();
        totalDCF();
    });

    function getList(that) {
        window.location = window.location.origin + '/myra/self-assessment/section-a/' + that.val();
    }

    function totalFulltime() {
        $local = parseInt($('#ug_bachelor_local').val() || 0);
        $foreign = parseInt($('#ug_bachelor_foreign').val() || 0);
        $total_pg = parseInt($('#total_pg').html() || 0);
        $('#total_ug').html($local + $foreign);
        $('#total_fulltime').html($local + $foreign + $total_pg);
    }

    function totalMRL() {
        $fulltime = parseInt($('#master_research_local_fulltime').val() || 0);
        $parttime = parseInt($('#master_research_local_parttime').val() || 0);
        $('#master_research_local').html($fulltime + $parttime);
    }

    function totalMRF() {
        $fulltime = parseInt($('#master_research_foreign_fulltime').val() || 0);
        $parttime = parseInt($('#master_research_foreign_parttime').val() || 0);
        $('#master_research_foreign').html($fulltime + $parttime);
    }

    function totalMCL() {
        $fulltime = parseInt($('#master_coursework_local_fulltime').val() || 0);
        $parttime = parseInt($('#master_coursework_local_parttime').val() || 0);
        $('#master_coursework_local').html($fulltime + $parttime);
    }

    function totalMCF() {
        $fulltime = parseInt($('#master_coursework_foreign_fulltime').val() || 0);
        $parttime = parseInt($('#master_coursework_foreign_parttime').val() || 0);
        $('#master_coursework_foreign').html($fulltime + $parttime);
    }

    function totalPHDL() {
        $fulltime = parseInt($('#phd_local_fulltime').val() || 0);
        $parttime = parseInt($('#phd_local_parttime').val() || 0);
        $('#phd_local').html($fulltime + $parttime);
    }

    function totalPHDF() {
        $fulltime = parseInt($('#phd_foreign_fulltime').val() || 0);
        $parttime = parseInt($('#phd_foreign_parttime').val() || 0);
        $('#phd_foreign').html($fulltime + $parttime);
    }

    function totalDCL() {
        $fulltime = parseInt($('#doc_coursework_local_fulltime').val() || 0);
        $parttime = parseInt($('#doc_coursework_local_parttime').val() || 0);
        $('#doc_coursework_local').html($fulltime + $parttime);
    }

    function totalDCF() {
        $fulltime = parseInt($('#doc_coursework_foreign_fulltime').val() || 0);
        $parttime = parseInt($('#doc_coursework_foreign_parttime').val() || 0);
        $('#doc_coursework_foreign').html($fulltime + $parttime);
    }
</script>
@endsection
@endcomponent