@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Section B @endslot
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
        <div class="font-medium text-center text-lg text-uppercase">SECTION B: QUANTITY AND QUALITY OF RESEARCHERS {{ $year }}</div>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="14">1</td>
                    <td class="border border-slate-600 font-bold">Critical Mass</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">Total Number of Active Academic Staff involved as Principal Investigators of Research Grants (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">1133</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;a. University Grants </td>
                    <td class="border border-slate-600 font-bold text-center">592</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="592" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;b. National Grants  </td>
                    <td class="border border-slate-600 font-bold text-center">382</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="382" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;c. Industrial/NGO/Private Grants </td>
                    <td class="border border-slate-600 font-bold text-center">79</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="79" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;d. International Grants </td>
                    <td class="border border-slate-600 font-bold text-center">80</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="80" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="7">2</td>
                    <td class="border border-slate-600 font-bold">PhDs or Professional Qualifications (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center">1442</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;a. Total Number of Active Staff with PhDs/DSc, DEng, etc. </td>
                    <td class="border border-slate-600 font-bold text-center">1423</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="1423" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;b. Total Number of Active Staff with Professional Postgraduate Qualifications  </td>
                    <td class="border border-slate-600 font-bold text-center">19</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Full Time</td>
                    <td class="border border-slate-600 font-bold"><input value="19" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;&emsp; - Part Time</td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="5">3</td>
                    <td class="border border-slate-600 font-bold">Research Experience of Active and Full Time Staff </td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">Total Number of Staff in each Age Group (3 Cohorts)  </td>
                    <td class="border border-slate-600 font-bold text-center">1593</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;a. >50 Years Old </td>
                    <td class="border border-slate-600 font-bold"><input value="542" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;b. 40-50 Years Old </td>
                    <td class="border border-slate-600 font-bold"><input value="565" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;c. <40 Years Old </td>
                    <td class="border border-slate-600 font-bold"><input value="486" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="7">4</td>
                    <td class="border border-slate-600 font-bold">Awards/ Stewardships Conferred by National and International Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;a. Total Number of Awards Conferred by International Academic and Professional Bodies for Research Excellence  </td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->award_int }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;b. Total Number of Recognitions/ Stewardships Conferred by International Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->recog_int }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;c. Total Number of Awards Conferred by National Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->award_nat }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;d. Total Number of Recognitions/ Stewardships Conferred by National Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->recog_nat }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;e. Research Exhibition Awards (gold medal / special awards)  </td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->exhibition }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;f. Other Research Awards </td>
                    <td class="border border-slate-600 font-bold"><input value="{{ $data->other }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                <tr class="bg-gray-400 text-black">
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="6">1</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Critical Mass</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">Percentage of Active Academic Staff involved as Principal Investigators of Research Grants (FTE) </td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">71.12</td>
                    <td class="border border-slate-600 font-bold text-center">7.67</td>
                    <td class="border border-slate-600 font-bold text-center">65.00</td>
                    <td class="border border-slate-600 font-bold text-center">7.70</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;a. University Grants </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">37.16</td>
                    <td class="border border-slate-600 text-center">3.73</td>
                    <td class="border border-slate-600 text-center">23.00</td>
                    <td class="border border-slate-600 text-center">2.31</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;b. National Grants  </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">23.98</td>
                    <td class="border border-slate-600 text-center">2.46</td>
                    <td class="border border-slate-600 text-center">18.00</td>
                    <td class="border border-slate-600 text-center">1.850</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;c. Industrial/NGO/Private Grants </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">4.96</td>
                    <td class="border border-slate-600 text-center">0.51</td>
                    <td class="border border-slate-600 text-center">12.00</td>
                    <td class="border border-slate-600 text-center">1.230</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;d. International Grants </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">5.02</td>
                    <td class="border border-slate-600 text-center">0.97</td>
                    <td class="border border-slate-600 text-center">12.00</td>
                    <td class="border border-slate-600 text-center">2.31</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">2</td>
                    <td class="border border-slate-600 font-bold" colspan="6">PhDs or Professional Qualifications (FTE) </td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;a. Total Number of Active Staff with PhDs/DSc, DEng, etc. </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">89.33</td>
                    <td class="border border-slate-600 text-center">5.24</td>
                    <td class="border border-slate-600 text-center">60.00</td>
                    <td class="border border-slate-600 text-center">3.52</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;b. Total Number of Active Staff with Professional Postgraduate Qualifications  </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">1.19</td>
                    <td class="border border-slate-600 text-center">0.05</td>
                    <td class="border border-slate-600 text-center">20.00</td>
                    <td class="border border-slate-600 text-center">0.88</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="5">3</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Research Experience of Active and Full Time Staff </td>
                </tr>
                <tr>
                    <td class="border border-slate-600">Total Number of Staff in each Age Group (3 Cohorts)  </td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">3.47</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">4.40</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">&emsp;a. >50 Years Old </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">34.02</td>
                    <td class="border border-slate-600 text-center">0.97</td>
                    <td class="border border-slate-600 text-center">30.00</td>
                    <td class="border border-slate-600 text-center">1.32</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">&emsp;b. 40-50 Years Old </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">35.47</td>
                    <td class="border border-slate-600 text-center">1.23</td>
                    <td class="border border-slate-600 text-center">40.00</td>
                    <td class="border border-slate-600 text-center">1.76</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 ">&emsp;c. <40 Years Old </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">30.51</td>
                    <td class="border border-slate-600 text-center">1.28</td>
                    <td class="border border-slate-600 text-center">30.00</td>
                    <td class="border border-slate-600 text-center">1.32</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="7">4</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Awards/ Stewardships Conferred by National and International Academic and Professional Bodies for Research Excellence </td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;a. Total Number of Awards Conferred by International Academic and Professional Bodies for Research Excellence  </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                    <td class="border border-slate-600 text-center">0.06</td>
                    <td class="border border-slate-600 text-center">15.00</td>
                    <td class="border border-slate-600 text-center">0.88</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;b. Total Number of Recognitions/ Stewardships Conferred by International Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">17.00</td>
                    <td class="border border-slate-600 text-center">1.00</td>
                    <td class="border border-slate-600 text-center">15.00</td>
                    <td class="border border-slate-600 text-center">0.88</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;c. Total Number of Awards Conferred by National Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">9.00</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                    <td class="border border-slate-600 text-center">20.00</td>
                    <td class="border border-slate-600 text-center">1.10</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;d. Total Number of Recognitions/ Stewardships Conferred by National Academic and Professional Bodies for Research Excellence </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">7.00</td>
                    <td class="border border-slate-600 text-center">0.31</td>
                    <td class="border border-slate-600 text-center">25.00</td>
                    <td class="border border-slate-600 text-center">1.10</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;e. Research Exhibition Awards (gold medal / special awards)  </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">27.00</td>
                    <td class="border border-slate-600 text-center">0.24</td>
                    <td class="border border-slate-600 text-center">50.00</td>
                    <td class="border border-slate-600 text-center">0.44</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">&emsp;f. Other Research Awards </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">143.00</td>
                    <td class="border border-slate-600 text-center">1.05</td>
                    <td class="border border-slate-600 text-center">150.00</td>
                    <td class="border border-slate-600 text-center">1.10</td>
                </tr>
                <tr class="bg-gray-400 text-black">
                    <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section B</td>
                    <td class="border border-slate-600 font-bold text-center">19.58</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">22</td>
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