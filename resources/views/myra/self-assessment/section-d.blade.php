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
        <div class="font-medium text-center text-lg text-uppercase">SECTION D: QUANTITY AND QUALITY OF POSTGRADUATES {{ $year }}</div>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="7">1</td>
                    <td class="border border-slate-600 font-bold">Number of PhDs Graduated in the Year of Assessment</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of PhDs Graduated</td>
                    <td class="border border-slate-600 font-bold text-center">529</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i.Total Number of Local PhDs Graduated  </td>
                    <td class="border border-slate-600 font-bold"><input value="301" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;ii.Total Number of International PhDs Graduated  </td>
                    <td class="border border-slate-600 font-bold"><input value="228" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Ratio of PhDs Graduated to Active Academic Staff</td>
                    <td class="border border-slate-600 font-bold text-center">0.33</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">c. Number of PhDs Graduated within 7 Semesters or 42 Months</td>
                    <td class="border border-slate-600 font-bold"><input value="84" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">d. Percentage of PhDs Graduated within 7 Semesters or 42 Months </td>
                    <td class="border border-slate-600 font-bold text-center">15.88</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                    <td class="border border-slate-600 font-bold">Number of Masters Graduated in the Year of Assessment</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of Masters (Research Mode) Graduated</td>
                    <td class="border border-slate-600 font-bold"><input value="279" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">3</td>
                    <td class="border border-slate-600 font-bold">Number of PhDs Enrolled in the Year of Assessment</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of PhDs Enrolled</td>
                    <td class="border border-slate-600 font-bold text-center">5138</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Ratio of PhDs Enrolled to Active Academic Staff</td>
                    <td class="border border-slate-600 font-bold text-center">3.23</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">c. Total Number of PhDs Enrolled in S&T </td>
                    <td class="border border-slate-600 font-bold"><input value="3818" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">4</td>
                    <td class="border border-slate-600 font-bold">Postgraduate Enrolment in the Year of Assessment</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Ratio of Postgraduates Enrolled to Active Academic Staff</td>
                    <td class="border border-slate-600 font-bold text-center">7.09</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Ratio of Postgraduates Enrolled (based on research and mixed modes only) to Undergraduates Enrolled</td>
                    <td class="border border-slate-600 font-bold text-center">0.42</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                    <td class="border border-slate-600 font-bold">Number of International Postgraduates Enrolled in the Year of Assessment</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of International Postgraduates Enrolled</td>
                    <td class="border border-slate-600 font-bold text-center">2790</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Percentage of International Postgraduates to Total Number of Postgraduates Enrolled</td>
                    <td class="border border-slate-600 font-bold text-center">24.69</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">6</td>
                    <td class="border border-slate-600 font-bold">Entry Qualification Level of Postgraduates</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Number of Postgraduates Enrolled with CGPA >=3.0 or Equivalent for their First Degree</td>
                    <td class="border border-slate-600 font-bold"><input value="9447" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Percentage of Postgraduates Enrolled with CGPA >=3.0 or Equivalent for their First Degree</td>
                    <td class="border border-slate-600 font-bold text-center">83.60</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">7</td>
                    <td class="border border-slate-600 font-bold">Total Number of Fellowships/ Grants Awarded by Prestigious Bodies to Postgraduates via Research Mode</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Number of Postgraduates Enrolled via Research Mode with Fellowships/ Grants in the Year of Assessment </td>
                    <td class="border border-slate-600 font-bold"><input value="609" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Percentage of Postgraduates Enrolled via Research Mode with Fellowships/ Grants</td>
                    <td class="border border-slate-600 font-bold text-center">9.11</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">8</td>
                    <td class="border border-slate-600 font-bold">Number of Post-doctorals in the Year of Assessment </td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Local PostDocs</td>
                    <td class="border border-slate-600 font-bold"><input value="58" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Foreign PostDocs</td>
                    <td class="border border-slate-600 font-bold"><input value="48" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
        <table class="table border-collapse border border-slate-500" id="sectionTable">
            <thead>
                <tr class="bg-gray-400 dark:bg-dark-1 text-black">
                    <th class="whitespace-nowrap">No</th>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="5">1</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Number of PhDs Graduated in the Year of Assessment</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">a. Total Number of PhDs Graduated</td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">&emsp;i.Total Number of Local PhDs Graduated  </td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">&emsp;ii.Total Number of International PhDs Graduated  </td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">b. Ratio of PhDs Graduated to Active Academic Staff</td>
                    <td class="border border-slate-600 text-center">No./staff</td>
                    <td class="border border-slate-600 text-center">0.33</td>
                    <td class="border border-slate-600 text-center">10.00</td>
                    <td class="border border-slate-600 text-center">0.056</td>
                    <td class="border border-slate-600 text-center">5.00</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Number of Masters Graduated in the Year of Assessment</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">a. Total Number of Masters (Research Mode) Graduated</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">3</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Number of PhDs Enrolled in the Year of Assessment</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of PhDs Enrolled</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Ratio of PhDs Enrolled to Active Academic Staff</td>
                    <td class="border border-slate-600 text-center">No./staff</td>
                    <td class="border border-slate-600 text-center">3.23</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">1.50</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">c. Total Number of PhDs Enrolled in S&T </td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">4</td>
                    <td class="border border-slate-600" colspan="6">Postgraduate Enrolment in the Year of Assessment</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Ratio of Postgraduates Enrolled to Active Academic Staff</td>
                    <td class="border border-slate-600 text-center">No./staff</td>
                    <td class="border border-slate-600 text-center">7.09</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Ratio of Postgraduates Enrolled (based on research and mixed modes only) to Undergraduates Enrolled</td>
                    <td class="border border-slate-600 text-center">No. PG/UG</td>
                    <td class="border border-slate-600 text-center">0.42</td>
                    <td class="border border-slate-600 text-center">0.00</td>
                    <td class="border border-slate-600 text-center">0,25</td>
                    <td class="border border-slate-600 text-center">0.00</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Number of International Postgraduates Enrolled in the Year of Assessment</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of International Postgraduates Enrolled</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Percentage of International Postgraduates to Total Number of Postgraduates Enrolled</td>
                    <td class="border border-slate-600 text-center">%</td>
                    <td class="border border-slate-600 text-center">24.69</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">10.00</td>
                    <td class="border border-slate-600 text-center">1.50</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">6</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Entry Qualification Level of Postgraduates</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Number of Postgraduates Enrolled with CGPA >=3.0 or Equivalent for their First Degree</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Percentage of Postgraduates Enrolled with CGPA >=3.0 or Equivalent for their First Degree</td>
                    <td class="border border-slate-600 text-center">%</td>
                    <td class="border border-slate-600 text-center">83.60</td>
                    <td class="border border-slate-600 text-center">5.02</td>
                    <td class="border border-slate-600 text-center">50.00</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">7</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Total Number of Fellowships/ Grants Awarded by Prestigious Bodies to Postgraduates via Research Mode</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Number of Postgraduates Enrolled via Research Mode with Fellowships/ Grants in the Year of Assessment </td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Percentage of Postgraduates Enrolled via Research Mode with Fellowships/ Grants</td>
                    <td class="border border-slate-600 text-center">%</td>
                    <td class="border border-slate-600 text-center">9.11</td>
                    <td class="border border-slate-600 text-center">1.82</td>
                    <td class="border border-slate-600 text-center">10.00</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">8</td>
                    <td class="border border-slate-600 font-bold">Post-doctorals Appointments</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">Number of Post-doctorals in the Year of Assessment</td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                    <td class="border border-slate-600 text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Local PostDocs</td>
                    <td class="border border-slate-600 text-center" rowspan="2">No. per Institution/year</td>
                    <td class="border border-slate-600 text-center" rowspan="2">106</td>
                    <td class="border border-slate-600 text-center" rowspan="2">3.00</td>
                    <td class="border border-slate-600 text-center" rowspan="2">10.00</td>
                    <td class="border border-slate-600 text-center" rowspan="2">1.50</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Foreign PostDocs</td>
                    {{-- <td class="border border-slate-600 text-center">No. per Institution/year</td>
                    <td class="border border-slate-600 text-center">106</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">10.00</td>
                    <td class="border border-slate-600 text-center">1.50</td> --}}
                </tr>
                <tr class="bg-gray-400 text-black">
                    <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section D</td>
                    <td class="border border-slate-600 font-bold text-center">26.84</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">15</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    <!-- END: Wizard Layout -->
@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
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