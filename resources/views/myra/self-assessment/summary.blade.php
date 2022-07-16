@component("layouts.app")
@slot("module") UTM MyRA @endslot
@slot("submodule") Summary @endslot
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
        <div class="font-medium text-center text-lg text-uppercase">SUMMARY REPORT FOR MyRA-I {{ $year }} (SELF ASSESSMENT)</div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" id="tab_1">
        <table class="table border-collapse border border-slate-500" id="sectionTable">
            <thead>
                <tr class="table-dark text-black">
                    <th class="whitespace-nowrap">No</th>
                    <th class="whitespace-nowrap">Assessment Section</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="whitespace-nowrap">IPT Marks</th>
                    <th class="whitespace-nowrap">Benchmark Scores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="align-top border border-slate-600">1</td>
                    <td class="border border-slate-600">Section B: Quantity and Quality of Researchers</td>
                    <td class="border border-slate-600 text-center">OK</td>
                    <td class="border border-slate-600 text-center">19.58</td>
                    <td class="border border-slate-600 text-center">22</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600">2</td>
                    <td class="border border-slate-600">Section C: Quantity and Quality of Research </td>
                    <td class="border border-slate-600 text-center">OK</td>
                    <td class="border border-slate-600 text-center">29.05</td>
                    <td class="border border-slate-600 text-center">30</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600">3</td>
                    <td class="border border-slate-600">Section D: Quantity and Quality of Postgraduates</td>
                    <td class="border border-slate-600 text-center">EXCELLENT</td>
                    <td class="border border-slate-600 text-center">26.84</td>
                    <td class="border border-slate-600 text-center">15</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600">4</td>
                    <td class="border border-slate-600">Section E: Innovation</td>
                    <td class="border border-slate-600 text-center">EXCELLENT</td>
                    <td class="border border-slate-600 text-center">11.00</td>
                    <td class="border border-slate-600 text-center">10</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600">5</td>
                    <td class="border border-slate-600">Section F: Professional Services and Gifts</td>
                    <td class="border border-slate-600 text-center">OK</td>
                    <td class="border border-slate-600 text-center">6.67</td>
                    <td class="border border-slate-600 text-center">7</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600">6</td>
                    <td class="border border-slate-600">Section G: Networking and Linkages</td>
                    <td class="border border-slate-600 text-center">OK</td>
                    <td class="border border-slate-600 text-center">12.81</td>
                    <td class="border border-slate-600 text-center">13</td>
                </tr>
                <tr>
                    <td class="align-top border border-slate-600">7</td>
                    <td class="border border-slate-600">Section H: Support Facilities</td>
                    <td class="border border-slate-600 text-center">EXCELLENT</td>
                    <td class="border border-slate-600 text-center">3.00</td>
                    <td class="border border-slate-600 text-center">3</td>
                </tr>
                <tr>
                    <td class="border border-slate-600 font-bold" colspan="2">TOTAL</td>
                    <td class="border border-slate-600 text-center font-bold">CONGRATULATIONS</td>
                    <td class="border border-slate-600 text-center font-bold">108.94</td>
                    <td class="border border-slate-600 text-center font-bold">100</td>
                </tr>
            </tbody>
        </table>
        <table class="table border-none my-6" id="sectionTable">
            <thead>
                <tr>
                    <th class="whitespace-nowrap text-right">STAR RATING: </th>
                    <th class="whitespace-nowrap">
                            <span class="inline-block mx-0 px-0"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(238, 217, 29);" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg></span>
                            <span class="inline-block mx-0 px-0"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(238, 217, 29);" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg></span>
                            <span class="inline-block mx-0 px-0"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(238, 217, 29);" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg></span>
                            <span class="inline-block mx-0 px-0"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(238, 217, 29);" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg></span>
                            <span class="inline-block mx-0 px-0"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(238, 217, 29);" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg></span>
                            <span class="inline-block mx-0 px-0"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(238, 217, 29);" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg></span>
                    </th>
                </tr>
                <tr>
                    <th class="whitespace-nowrap text-right">DATA ENTRY STATUS: </th>
                    <th class="whitespace-nowrap font-bold" style="color: green">COMPLETE</th>
                </tr>
                <tr>
                    <th class="whitespace-nowrap text-right">MASTERLIST UPLOADED: </th>
                    <th class="whitespace-nowrap font-bold" style="color: green">YES</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5" id="tab_2">
        <a href="{{ route('myra.self-assessment.section-a') }}" class="intro-y rounded btn btn-primary mx-2">Back to Form</a>
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