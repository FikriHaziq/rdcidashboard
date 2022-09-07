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
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->support }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="align-top border border-slate-600 font-bold" rowspan="4">2</td>
                                <td class="border border-slate-600 font-bold"> Library Facilities</td>
                                <td class="border border-slate-600 font-bold"></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">a. Total Number of Titles of Books (Hard copy) </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->book }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">b. Total Number of Online Titles of Books</td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->book_online }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-600 font-bold">c. Total Number of Titles of Journals Subscribed  </td>
                                <td class="border border-slate-600 font-bold"><input value="{{ $data->journal_subscribed }}" class="font-bold text-center bg-gray-300 w-full border border-slate-300 rounded-md py-1 pl-9 pr-3 shadow-sm" placeholder="" type="text" name="search"/></td>
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
                        (CAPPED AT 100%/OUTPUT)
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
                                    <th class="myra-1-header table-border-black" colspan="7">Myra I</th>
                                    <th class="myra-2-header table-border-black" colspan="7">Myra II</th>
                                </tr>
                                <tr class="myra-blue text-black text-center table-border-black">
                                    <th class="whitespace-nowrap">No.</th>
                                    <th class="whitespace-nowrap">Criteria</th>
                                    <th class="whitespace-nowrap">KPI</th>
                                    <th class="whitespace-nowrap">Myra I</th>
                                    <th class="whitespace-nowrap">Myra II</th>
                                    <th class="whitespace-nowrap">{{ $year }}</th>
                                    <th class="whitespace-nowrap">Weightage</th>
                                    <th class="whitespace-nowrap">Benchmark Target</th>
                                    <th class="whitespace-nowrap">Benchmark Marks</th>
                                    <th class="whitespace-nowrap">Marks</th>
                                    <th class="whitespace-nowrap">Achievement (%)</th>
                                    <th class="whitespace-nowrap">Weightage</th>
                                    <th class="whitespace-nowrap">Benchmark Target</th>
                                    <th class="whitespace-nowrap">Benchmark Marks</th>
                                    <th class="whitespace-nowrap">Marks</th>
                                    <th class="whitespace-nowrap">Achievement (%)</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-black">
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">1</td>
                                    <td class="border border-slate-600 fw-bold">Laboratories/ Research Facilities that are Accreditated Based on their Core Competencies</td>
                                    <td class="border border-slate-600 fw-bold">Total Number of Laboratories/Research Facilities Accreditated to Good Manufacturing Practice (GMP), Good Regulatory Practice (GRP), Good Laboratory Practice (GLP), ISO17025, ISO15189, etc that are fully operational</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra1_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_1[0] == 'YES') myra-yes @else myra-no @endif">{{ $data->calculation->myra2_1[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow">{{ number_format($data->calculation->myra_year_1[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra1_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra1_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra1_achievement_1[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ $data->calculation->myra2_weightage_1 }}%</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_target_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_benchmark_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->myra2_mark_1[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink">{{ number_format($data->calculation->myra2_achievement_1[0], 2) }}%</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold" rowspan="3">2</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">Library Facilities</td>
                                    <td class="border border-slate-600 fw-bold">a. Total Number of Titles of Books (Hardcopy)</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra1_2[0] == 'YES') myra-yes @else myra-no @endif" rowspan="3">{{ $data->calculation->myra1_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold @if($data->calculation->myra2_2[0] == 'YES') myra-yes @else myra-no @endif" rowspan="3">{{ $data->calculation->myra2_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold myra-yellow" rowspan="3">{{ number_format($data->calculation->myra_year_2[0], 0) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ $data->calculation->myra1_weightage_2 }}%</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ $data->calculation->myra1_benchmark_target_2[0] }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ number_format($data->calculation->myra1_benchmark_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" rowspan="3">{{ number_format($data->calculation->myra1_mark_2[0], 2) }}</td>
                                    <td class="border border-slate-600 fw-bold myra-pink" rowspan="3">{{ number_format($data->calculation->myra1_achievement_2[0], 2) }}%</td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray" rowspan="3"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray" rowspan="3"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray" rowspan="3"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray" rowspan="3"></td>
                                    <td class="border border-slate-600 fw-bold myra-dark-gray" rowspan="3"></td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">b. Total Number of Online Titles of Books (Digital Copy)</td>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-600 fw-bold">c. Total Number of Titles of Journals Subscribed</td>
                                </tr>
                                <tr class="text-center total-mark">
                                    <td class="border border-slate-600 fw-bold" colspan="8">Total Mark for Section H</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_benchmark_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold">{{ number_format($data->calculation->total_myra1_mark, 2) }}</td>
                                    <td class="border border-slate-600 fw-bold" colspan="3"></td>
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
</div>
    <!-- END: Wizard Layout -->
@endslot
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
<script>
    function getList(that) {
        window.location = window.location.origin + '/myra/self-assessment/section-h/' + that.val();
    }
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