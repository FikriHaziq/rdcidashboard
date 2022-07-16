@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section F @endslot
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
<div class="intro-y box py-10 sm:py-20 mt-5">
    @include('myra.self-assessment.tabs', compact('year'))
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg text-uppercase">SECTION F: PROFESSIONAL SERVICES AND GIFTS {{ $year }}</div>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">1</td>
                    <td class="border border-slate-600 font-bold">Gross Income from Training Courses (Non-degree Programmes) and Postgraduate Fees from Research Programmes</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Training Courses from Non-Degree Programmes </td>
                    <td class="border border-slate-600 font-bold"><input value="1771683" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Postgraduate Fees from Research Programmes </td>
                    <td class="border border-slate-600 font-bold"><input value="23003002" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                    <td class="border border-slate-600 font-bold">Gross Income from Organising Conferences, Seminars and Knowledge-Sharing Programmes in the Field of Expertise</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total amount (RM) </td>
                    <td class="border border-slate-600 font-bold"><input value="2115517" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">3</td>
                    <td class="border border-slate-600 font-bold">Gross Income from Product Commercialization/ Technology Know-How Licensing</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Product Commercialization </td>
                    <td class="border border-slate-600 font-bold"><input value="774192" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Technology Know-How Licensing / Sold Outright </td>
                    <td class="border border-slate-600 font-bold"><input value="430100" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">4</td>
                    <td class="border border-slate-600 font-bold">Gross Income Based on Financial Transaction of that Year from Consultancies (excluding Contract Research)/ Hospital Recoupable Fees/ Lab Services Fees</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Consultancies (excluding contract research) </td>
                    <td class="border border-slate-600 font-bold"><input value="15326110" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Hospital Recoupable Fees </td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">c. Lab Services Fees </td>
                    <td class="border border-slate-600 font-bold"><input value="2790889" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                    <td class="border border-slate-600 font-bold">Endowment (including Professorial Chairs)</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Amount (RM) of New Endowments Received </td>
                    <td class="border border-slate-600 font-bold"><input value="1831936" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Income/Dividends (RM) from Existing Endowments </td>
                    <td class="border border-slate-600 font-bold"><input value="354263" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">6</td>
                    <td class="border border-slate-600 font-bold">Gifts/ Donations (money, equipment, research materials, etc.) worth >=RM 3,000 each</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Amount (RM) Received </td>
                    <td class="border border-slate-600 font-bold"><input value="4061216" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">7</td>
                    <td class="border border-slate-600 font-bold">Percentage of Operational Expenditure (OE) for R&D Development</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Operational Expenditure (OE) (RM)</td>
                    <td class="border border-slate-600 font-bold"><input value="573657080" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Expenditure for R&D Development (RM) </td>
                    <td class="border border-slate-600 font-bold"><input value="39196417" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
        <div class="px-5 my-10">
            <div class="font-medium text-center text-lg text-uppercase">(CAPPED AT 100% EXCEPT CONSULTANCIES & LAB SERVICES (CAPPED AT 200%) / OUTPUT)</div>
        </div>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">1</td>
                    <td class="border border-slate-600 font-bold">Gross Income from Training Courses (Non-degree Programmes) and Postgraduate Fees from Research Programmes</td>
                    <td class="border border-slate-600 text-center" rowspan="8">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center" rowspan="8">28.09</td>
                    <td class="border border-slate-600 text-center" rowspan="8">2.10</td>
                    <td class="border border-slate-600 text-center" rowspan="8">6.00</td>
                    <td class="border border-slate-600 text-center" rowspan="8">2.10</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Training Courses from Non-Degree Programmes </td>
                    {{-- <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">28.09</td>
                    <td class="border border-slate-600 text-center">2.10</td>
                    <td class="border border-slate-600 text-center">6.00</td>
                    <td class="border border-slate-600 text-center">2.10</td> --}}
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Postgraduate Fees from Research Programmes </td>
                    {{-- <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">28.09</td>
                    <td class="border border-slate-600 text-center">2.10</td>
                    <td class="border border-slate-600 text-center">6.00</td>
                    <td class="border border-slate-600 text-center">2.10</td> --}}
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                    <td class="border border-slate-600 font-bold">Gross Income from Organising Conferences, Seminars and Knowledge-Sharing Programmes in the Field of Expertise</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total amount (RM) </td>
                    {{-- <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">28.09</td>
                    <td class="border border-slate-600 text-center">2.10</td>
                    <td class="border border-slate-600 text-center">6.00</td>
                    <td class="border border-slate-600 text-center">2.10</td> --}}
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">3</td>
                    <td class="border border-slate-600 font-bold">Gross Income from Product Commercialization/ Technology Know-How Licensing</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Product Commercialization </td>
                    {{-- <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">28.09</td>
                    <td class="border border-slate-600 text-center">2.10</td>
                    <td class="border border-slate-600 text-center">6.00</td>
                    <td class="border border-slate-600 text-center">2.10</td> --}}
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Technology Know-How Licensing / Sold Outright </td>
                    {{-- <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">28.09</td>
                    <td class="border border-slate-600 text-center">2.10</td>
                    <td class="border border-slate-600 text-center">6.00</td>
                    <td class="border border-slate-600 text-center">2.10</td> --}}
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="4">4</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Gross Income Based on Financial Transaction of that Year from Consultancies (excluding Contract Research)/ Hospital Recoupable Fees/ Lab Services Fees</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Consultancies (excluding contract research) </td>
                    <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">15.33</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Hospital Recoupable Fees </td>
                    <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">0.00</td>
                    <td class="border border-slate-600 text-center">0.00</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">c. Lab Services Fees </td>
                    <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">2.79</td>
                    <td class="border border-slate-600 text-center">0.93</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Endowment (including Professorial Chairs)</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Amount (RM) of New Endowments Received </td>
                    <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">1.83</td>
                    <td class="border border-slate-600 text-center">0.64</td>
                    <td class="border border-slate-600 text-center">4.00</td>
                    <td class="border border-slate-600 text-center">1.40</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Income/Dividends (RM) from Existing Endowments </td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                    <td class="border border-slate-600 text-center">-</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">6</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Gifts/ Donations (money, equipment, research materials, etc.) worth >=RM 3,000 each</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Amount (RM) Received </td>
                    <td class="border border-slate-600 text-center">Total Amount (RM in millions)</td>
                    <td class="border border-slate-600 text-center">4.06</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">7</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Percentage of Operational Expenditure (OE) for R&D Development</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Operational Expenditure (OE) (RM)</td>
                    <td class="border border-slate-600 text-center" rowspan="2">% of Operational Expenditure for R&D</td>
                    <td class="border border-slate-600 text-center" rowspan="2">6.83</td>
                    <td class="border border-slate-600 text-center" rowspan="2">0.50</td>
                    <td class="border border-slate-600 text-center" rowspan="2">2.00</td>
                    <td class="border border-slate-600 text-center" rowspan="2">0.50</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Expenditure for R&D Development (RM) </td>
                    {{-- <td class="border border-slate-600 text-center">% of Operational Expenditure for R&D</td>
                    <td class="border border-slate-600 text-center">6.83</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">0.50</td> --}}
                </tr>
                <tr class="bg-gray-400 text-black">
                    <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section F</td>
                    <td class="border border-slate-600 font-bold text-center">6.67</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">7.00</td>
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