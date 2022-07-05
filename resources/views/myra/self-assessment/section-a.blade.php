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
<div class="content">
    <div class="flex items-center mt-8">
        <h2 class="intro-y text-lg font-medium mr-auto">
            RAW DATA MyRA-I (SELF ASSESSMENT)
        </h2>
    </div>
    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box py-10 sm:py-20 mt-5">
        @include('myra.self-assessment.tabs')
        <div class="px-5 mt-10">
            <div class="font-medium text-center text-lg text-uppercase">SECTION A: GENERAL INFORMATION 2019</div>
        </div>
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" id="tab_1">
            <table class="table border-collapse border border-slate-500" id="sectionTable">
                <thead>
                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
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
                        <td class="border border-slate-600 font-bold"><input value="193" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Associate Professors (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">360</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="360" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Senior Lecturers (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">992</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="992" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Lecturers (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">60</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="60" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Research Fellows (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">0</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                        <td class="border border-slate-600 font-bold"><input value="187" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Associate Professors (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">359</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="359" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Senior Lecturers (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">989</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="989" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Lecturers (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">58</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="58" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Research Fellows (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">0</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">c. Total Number of Active S&T Academic Staff (FTE) </td>
                        <td class="border border-slate-600 font-bold text-center">1177</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp; - Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="1177" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                        <td class="border border-slate-600 font-bold"><input value="53" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp; - Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="41">2</td>
                        <td class="border border-slate-600 font-bold">Total Number of Fulltime Students</td>
                        <td class="border border-slate-600 font-bold text-center">27152</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">a. Number of Local and Foreign Undergraduate Students </td>
                        <td class="border border-slate-600 font-bold text-center">15852</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;i. Bachelor (Local)</td>
                        <td class="border border-slate-600 font-bold"><input value="14411" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;ii. Bachelor (Foreign)</td>
                        <td class="border border-slate-600 font-bold"><input value="1441" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">b. Number of Local and Foreign Postgraduate Students </td>
                        <td class="border border-slate-600 font-bold text-center">11300</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;PhDs </td>
                        <td class="border border-slate-600 font-bold text-center">5138</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;Postgraduates by Research </td>
                        <td class="border border-slate-600 font-bold text-center">6687</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;Postgraduates (Foreign)  </td>
                        <td class="border border-slate-600 font-bold text-center">2790</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;Masters (Local)  </td>
                        <td class="border border-slate-600 font-bold text-center">5179</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;Masters (Foreign)  </td>
                        <td class="border border-slate-600 font-bold text-center">893</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. Masters - Research (Local) FTE</td>
                        <td class="border border-slate-600 font-bold text-center">1402</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="1402" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;ii. Masters - Research (Foreign) FTE</td>
                        <td class="border border-slate-600 font-bold text-center">147</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="147" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;iii. Masters - Coursework (Local) FTE</td>
                        <td class="border border-slate-600 font-bold text-center">3777</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="3777" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;iv. Masters - Coursework (Foreign) FTE</td>
                        <td class="border border-slate-600 font-bold text-center">746</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="746" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;v. PhDs (Local) FTE</td>
                        <td class="border border-slate-600 font-bold text-center">3262</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="3262" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;vi. PhDs (Foreign) FTE</td>
                        <td class="border border-slate-600 font-bold text-center">1876</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="1876" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;vii. Doctoral Level Coursework (Local) FTE </td>
                        <td class="border border-slate-600 font-bold text-center">69</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="69" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;viii. Doctoral Level Coursework (Foreign) FTE </td>
                        <td class="border border-slate-600 font-bold text-center">21</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Full Time</td>
                        <td class="border border-slate-600 font-bold"><input value="21" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;&emsp;- Part Time</td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
</div>
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