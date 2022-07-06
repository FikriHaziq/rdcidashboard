@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section E @endslot
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
            <div class="font-medium text-center text-lg text-uppercase">SECTION E: INNOVATION 2019</div>
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
                        <td class="align-top border border-slate-600 font-bold" rowspan="9">1</td>
                        <td class="border border-slate-600 font-bold">Patents</td>
                        <td class="border border-slate-600 font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">a. Total Number of New Certificates of Patents Granted </td>
                        <td class="border border-slate-600 font-bold text-center">52</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. National </td>
                        <td class="border border-slate-600 font-bold"><input value="51" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr><tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. International </td>
                        <td class="border border-slate-600 font-bold"><input value="1" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">b. Total Number of New Certificates of Patents Filed </td>
                        <td class="border border-slate-600 font-bold text-center">49</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. National </td>
                        <td class="border border-slate-600 font-bold"><input value="49" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr><tr>
                        <td class="border border-slate-600 font-bold">&emsp;i. International </td>
                        <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">c. Total Number of New Inventions (Technology/Innovations) Granted Patents</td>
                        <td class="border border-slate-600 font-bold"><input value="52" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">d. Total Number of New Inventions (Technology/Innovations) Filed Patents</td>
                        <td class="border border-slate-600 font-bold"><input value="49" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                        <td class="border border-slate-600 font-bold">Commercialized Products</td>
                        <td class="border border-slate-600 font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">a. Total Number of Innovations Successfully Developed into Commercialized Products for the Market </td>
                        <td class="border border-slate-600 font-bold"><input value="8" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="2">3</td>
                        <td class="border border-slate-600 font-bold">Technology Know-How Licensing</td>
                        <td class="border border-slate-600 font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">a. Total Number Licensed or Sold Outright </td>
                        <td class="border border-slate-600 font-bold"><input value="24" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="2">4</td>
                        <td class="border border-slate-600 font-bold">Other IPRs (other than Patents, Commercialized Products, Technology Know-How and Books declared in Section C)</td>
                        <td class="border border-slate-600 font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">a. Total Number of Other IPRs (copyrights / trademarks / industrial designs, etc) Obtained  </td>
                        <td class="border border-slate-600 font-bold"><input value="429" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                        <td class="border border-slate-600 font-bold">Start-Up/ Spin-off Companies</td>
                        <td class="border border-slate-600 font-bold"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">a. Number of active companies that commercialized university innovations in the year of assessment  </td>
                        <td class="border border-slate-600 font-bold"><input value="26" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600 font-bold">b. Number of new companies that commercialized university innovations in the year of assessment </td>
                        <td class="border border-slate-600 font-bold"><input value="13" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                        <td class="align-top border border-slate-600 font-bold" rowspan="9">1</td>
                        <td class="border border-slate-600 font-bold" colspan="6">Patents</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">a. Total Number of New Certificates of Patents Granted </td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;i. National </td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                    </tr><tr>
                        <td class="border border-slate-600">&emsp;i. International </td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">b. Total Number of New Certificates of Patents Filed </td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                        <td class="border border-slate-600 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">&emsp;i. National </td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                    </tr><tr>
                        <td class="border border-slate-600">&emsp;i. International </td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">c. Total Number of New Inventions (Technology/Innovations) Granted Patents</td>
                        <td class="border border-slate-600 text-center">No./S&T staff</td>
                        <td class="border border-slate-600 text-center">0.044</td>
                        <td class="border border-slate-600 text-center">2.00</td>
                        <td class="border border-slate-600 text-center">0.055</td>
                        <td class="border border-slate-600 text-center">2.00</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">d. Total Number of New Inventions (Technology/Innovations) Filed Patents</td>
                        <td class="border border-slate-600 text-center">No./S&T staff</td>
                        <td class="border border-slate-600 text-center">0.042</td>
                        <td class="border border-slate-600 text-center">1.00</td>
                        <td class="border border-slate-600 text-center">0.02</td>
                        <td class="border border-slate-600 text-center">1.00</td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                        <td class="border border-slate-600 font-bold" colspan="6">Commercialized Products</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">a. Total Number of Innovations Successfully Developed into Commercialized Products for the Market </td>
                        <td class="border border-slate-600 text-center">No./staff</td>
                        <td class="border border-slate-600 text-center">0.005</td>
                        <td class="border border-slate-600 text-center">3.00</td>
                        <td class="border border-slate-600 text-center">0.0025</td>
                        <td class="border border-slate-600 text-center">3.00</td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="2">3</td>
                        <td class="border border-slate-600 font-bold" colspan="6">Technology Know-How Licensing</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">a. Total Number Licensed or Sold Outright </td>
                        <td class="border border-slate-600 text-center">No./staff</td>
                        <td class="border border-slate-600 text-center">0.0151</td>
                        <td class="border border-slate-600 text-center">3.00</td>
                        <td class="border border-slate-600 text-center">0.005</td>
                        <td class="border border-slate-600 text-center">3.00</td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="2">4</td>
                        <td class="border border-slate-600 font-bold" colspan="6">Other IPRs (other than Patents, Commercialized Products, Technology Know-How and Books declared in Section C)</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">a. Total Number of Other IPRs (copyrights / trademarks / industrial designs, etc) Obtained  </td>
                        <td class="border border-slate-600 text-center">No./staff</td>
                        <td class="border border-slate-600 text-center">0.27</td>
                        <td class="border border-slate-600 text-center">2.00</td>
                        <td class="border border-slate-600 text-center">0.05</td>
                        <td class="border border-slate-600 text-center">1.00</td>
                    </tr>
                    <tr>
                        <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                        <td class="border border-slate-600 font-bold" colspan="6">Start-Up/ Spin-off Companies</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">a. Number of active companies that commercialized university innovations in the year of assessment  </td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-600">b. Number of new companies that commercialized university innovations in the year of assessment </td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                        <td class="border border-slate-600 text-center">-</td>
                    </tr>
                    <tr class="bg-gray-400 text-black">
                        <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section E</td>
                        <td class="border border-slate-600 font-bold text-center">11.00</td>
                        <td class="border border-slate-600 font-bold text-center"></td>
                        <td class="border border-slate-600 font-bold text-center">10</td>
                    </tr>
                </tbody>
            </table>
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