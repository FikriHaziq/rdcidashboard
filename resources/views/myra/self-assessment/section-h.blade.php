@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section H @endslot
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
        <div class="font-medium text-center text-lg text-uppercase">SECTION H: SUPPORT FACILITIES {{ $year }}</div>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">1</td>
                    <td class="border border-slate-600 font-bold">Laboratories/ Research Facilities that are Accreditated Based on their Core Competencies</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">Total Number of Laboratories Accredited to Good Manufacturing Practice (GMP), Good Regulatory Practice (GRP), Good Laboratory Practice (GLP), ISO17025, ISO15189, etc. </td>
                    <td class="border border-slate-600 font-bold"><input value="6" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">2</td>
                    <td class="border border-slate-600 font-bold"> Library Facilities</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of Titles of Books (Hard copy) </td>
                    <td class="border border-slate-600 font-bold"><input value="337806" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Number of Online Titles of Books</td>
                    <td class="border border-slate-600 font-bold"><input value="62172" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">c. Total Number of Titles of Journals Subscribed  </td>
                    <td class="border border-slate-600 font-bold"><input value="2661387" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">1</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Laboratories/ Research Facilities that are Accreditated Based on their Core Competencies</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">Total Number of Laboratories Accredited to Good Manufacturing Practice (GMP), Good Regulatory Practice (GRP), Good Laboratory Practice (GLP), ISO17025, ISO15189, etc. </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">6.00</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">2</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">2</td>
                    <td class="border border-slate-600 font-bold" colspan="6"> Library Facilities</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of Titles of Books (Hard copy) </td>
                    <td class="border border-slate-600 text-center" rowspan="3">millions titles per Institution</td>
                    <td class="border border-slate-600 text-center" rowspan="3">3.06</td>
                    <td class="border border-slate-600 text-center" rowspan="3">1.00</td>
                    <td class="border border-slate-600 text-center" rowspan="3">1.20</td>
                    <td class="border border-slate-600 text-center" rowspan="3">1</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Number of Online Titles of Books</td>
                    {{-- <td class="border border-slate-600 text-center">millions titles per Institution</td>
                    <td class="border border-slate-600 text-center">3.06</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                    <td class="border border-slate-600 text-center">1.20</td>
                    <td class="border border-slate-600 text-center">1</td> --}}
                </tr>
                <tr>
                    <td class="border border-slate-600">c. Total Number of Titles of Journals Subscribed  </td>
                    {{-- <td class="border border-slate-600 text-center">millions titles per Institution</td>
                    <td class="border border-slate-600 text-center">3.06</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                    <td class="border border-slate-600 text-center">1.20</td>
                    <td class="border border-slate-600 text-center">1</td> --}}
                </tr>
                <tr class="bg-gray-400 text-black">
                    <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section H</td>
                    <td class="border border-slate-600 font-bold text-center">3.00</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">3.00</td>
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