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
                    <td class="border border-slate-600 font-bold text-center">44</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Industry </td>
                    <td class="border border-slate-600 font-bold"><input value="6" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;ii. Community/ NGO </td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;iii. University </td>
                    <td class="border border-slate-600 font-bold"><input value="32" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;iv. Agency/ Research Institute  </td>
                    <td class="border border-slate-600 font-bold"><input value="6" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Number of Staff Involved in Joint Research Projects Under MoA</td>
                    <td class="border border-slate-600 font-bold"><input value="166" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                    <td class="border border-slate-600 font-bold">Number of Staff Sent Abroad for Research Activities</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of Staff Sent Abroad for Research Activities</td>
                    <td class="border border-slate-600 font-bold"><input value="82" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">3</td>
                    <td class="border border-slate-600 font-bold">Membership in International Academic/ Professional Bodies/ Associations/ NGOs</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of Staff as Members in International Academic/ Professional Bodies/ Associations</td>
                    <td class="border border-slate-600 font-bold"><input value="327" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Number of Staff Appointed as Chairman/ Committee Members in International Academic/ Professional Bodies/ Associations/ NGOs</td>
                    <td class="border border-slate-600 font-bold"><input value="8" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="7">4</td>
                    <td class="border border-slate-600 font-bold">Participation in National Inter-Institution Research Related Activities Under MoA</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of MoAs Signed and Stamped  </td>
                    <td class="border border-slate-600 font-bold text-center">57</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;i. Industry </td>
                    <td class="border border-slate-600 font-bold"><input value="36" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;ii. Community/ NGO </td>
                    <td class="border border-slate-600 font-bold"><input value="0" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;iii. University </td>
                    <td class="border border-slate-600 font-bold"><input value="12" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">&emsp;iv. Agency/ Research Institute  </td>
                    <td class="border border-slate-600 font-bold"><input value="9" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Number of Staff Involved in Joint Research Projects Under MoA</td>
                    <td class="border border-slate-600 font-bold"><input value="252" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                    <td class="border border-slate-600 font-bold">Membership in National Academic/ Professional Bodies/ Associations/Ministry/ NGOs</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of Staff as Members in National Academic/ Professional Bodies/ Associations/ Ministry/ NGOs </td>
                    <td class="border border-slate-600 font-bold"><input value="450" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Number of Staff Appointed as Chairman/ Committee Members in National Academic/ Professional Bodies/ Associations/ Ministry/ NGOs</td>
                    <td class="border border-slate-600 font-bold"><input value="67" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">6</td>
                    <td class="border border-slate-600 font-bold">Knowledge/ Technology Diffusion Projects/ Assimilation (Social Innovation)</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Total Number of New Community-Related Projects</td>
                    <td class="border border-slate-600 font-bold"><input value="55" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">b. Total Number of Communities Receiving/ Benefiting from the Knowledge/ Technology Diffusion Projects</td>
                    <td class="border border-slate-600 font-bold"><input value="69" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">7</td>
                    <td class="border border-slate-600 font-bold">Joint Research Projects Between Institution Assessed and Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Number of Collaborative Projects Between Institution Assessed and a Minimum of 3 Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                    <td class="border border-slate-600 font-bold"><input value="14" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">8</td>
                    <td class="border border-slate-600 font-bold">Joint Research Projects between RUs in Each Project</td>
                    <td class="border border-slate-600 font-bold"></td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold">a. Number of Collaborative Projects between RUs with a Minimum of 4 Research Universities in Each Project</td>
                    <td class="border border-slate-600 font-bold"><input value="6" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">1</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Participation in International Inter-Institution Research Related Activities Under MoA</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of MoAs Signed and Stamped  </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">44.00</td>
                    <td class="border border-slate-600 text-center">0.81</td>
                    <td class="border border-slate-600 text-center">5.00</td>
                    <td class="border border-slate-600 text-center">0.81</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Number of Staff Involved in Joint Research Projects Under MoA</td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">10.42</td>
                    <td class="border border-slate-600 text-center">0.49</td>
                    <td class="border border-slate-600 text-center">20.00</td>
                    <td class="border border-slate-600 text-center">0.49</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">2</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Number of Staff Sent Abroad for Research Activities</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of Staff Sent Abroad for Research Activities</td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">5.15</td>
                    <td class="border border-slate-600 text-center">0.49</td>
                    <td class="border border-slate-600 text-center">5.00</td>
                    <td class="border border-slate-600 text-center">0.49</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">3</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Membership in International Academic/ Professional Bodies/ Associations/ NGOs</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of Staff as Members in International Academic/ Professional Bodies/ Associations</td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">20.53</td>
                    <td class="border border-slate-600 text-center">0.33</td>
                    <td class="border border-slate-600 text-center">30.00</td>
                    <td class="border border-slate-600 text-center">0.49</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Number of Staff Appointed as Chairman/ Committee Members in International Academic/ Professional Bodies/ Associations/ NGOs</td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                    <td class="border border-slate-600 text-center">0.98</td>
                    <td class="border border-slate-600 text-center">0.50</td>
                    <td class="border border-slate-600 text-center">0.98</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">4</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Participation in National Inter-Institution Research Related Activities Under MoA</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of MoAs Signed and Stamped  </td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">57.00</td>
                    <td class="border border-slate-600 text-center">1.37</td>
                    <td class="border border-slate-600 text-center">20.00</td>
                    <td class="border border-slate-600 text-center">1.37</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Number of Staff Involved in Joint Research Projects Under MoA</td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">15.82</td>
                    <td class="border border-slate-600 text-center">0.68</td>
                    <td class="border border-slate-600 text-center">8.00</td>
                    <td class="border border-slate-600 text-center">0.68</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">5</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Membership in National Academic/ Professional Bodies/ Associations/Ministry/ NGOs</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of Staff as Members in National Academic/ Professional Bodies/ Associations/ Ministry/ NGOs </td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">28.85</td>
                    <td class="border border-slate-600 text-center">0.64</td>
                    <td class="border border-slate-600 text-center">30.00</td>
                    <td class="border border-slate-600 text-center">0.68</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Number of Staff Appointed as Chairman/ Committee Members in National Academic/ Professional Bodies/ Associations/ Ministry/ NGOs</td>
                    <td class="border border-slate-600 text-center">% of staff</td>
                    <td class="border border-slate-600 text-center">4.21</td>
                    <td class="border border-slate-600 text-center">1.82</td>
                    <td class="border border-slate-600 text-center">2.00</td>
                    <td class="border border-slate-600 text-center">1.82</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="3">6</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Knowledge/ Technology Diffusion Projects/ Assimilation (Social Innovation)</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Total Number of New Community-Related Projects</td>
                    <td class="border border-slate-600 text-center">No.</td>
                    <td class="border border-slate-600 text-center">55.00</td>
                    <td class="border border-slate-600 text-center">1.56</td>
                    <td class="border border-slate-600 text-center">15.00</td>
                    <td class="border border-slate-600 text-center">1.56</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">b. Total Number of Communities Receiving/ Benefiting from the Knowledge/ Technology Diffusion Projects</td>
                    <td class="border border-slate-600 text-center">No.</td>
                    <td class="border border-slate-600 text-center">69.00</td>
                    <td class="border border-slate-600 text-center">2.34</td>
                    <td class="border border-slate-600 text-center">60.00</td>
                    <td class="border border-slate-600 text-center">2.34</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600 font-bold" rowspan="2">7</td>
                    <td class="border border-slate-600 font-bold" colspan="6">Joint Research Projects Between Institution Assessed and Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                </tr>
                <tr>
                    <td class="border border-slate-600">a. Number of Collaborative Projects Between Institution Assessed and a Minimum of 3 Research Universities/Public Universities/Private Universities/Industries/Agencies in Each Project</td>
                    <td class="border border-slate-600 text-center">No. per Institution</td>
                    <td class="border border-slate-600 text-center">14.00</td>
                    <td class="border border-slate-600 text-center">1.30</td>
                    <td class="border border-slate-600 text-center">50.00</td>
                    <td class="border border-slate-600 text-center">1.30</td>
                </tr>
                <tr class="bg-gray-400 text-black">
                    <td class="border border-slate-600 text-center font-bold" colspan="4">Total Marks For Section G</td>
                    <td class="border border-slate-600 font-bold text-center">12.81</td>
                    <td class="border border-slate-600 font-bold text-center"></td>
                    <td class="border border-slate-600 font-bold text-center">13.00</td>
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