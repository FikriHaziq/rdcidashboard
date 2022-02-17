@component("dashboard.layouts.app")
@slot('module') UTM Research @endslot
@slot("submodule") Faculty Achievement - Year @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-8 box p-5 cursor-pointer zoom-in" style="background-color: rgb(100, 181, 246)">
                <div class="fw-medium fs-xs text-white">Total Approved, {{$year}}</div>
                <div class="fw-bold fs-lg text-white">{{ number_format($result['total_approved'],2) }}</div>
            </div>
            <div class="g-col-4 box p-5 cursor-pointer zoom-in" style="background-color: rgb(229, 115, 115);">
                <div class="fw-medium fs-xs text-white">Total Projects</div>
                <div class="fw-bold fs-lg text-white">{{ $result['total_grant'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-4">
                <div class="mb-2"> 
                    <select onchange="updateChart(this)" class="tom-select w-full">
                        <option value="ALL">ALL SPONSOR CATEGORY</option>
                        <option value="UNIVERSITY">UNIVERSITY</option>
                        <option value="PRIVATE">PRIVATE</option>
                        <option value="NATIONAL">NATIONAL</option>
                        <option value="INTERNATIONAL">INTERNATIONAL</option>
                    </select>
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>SUBSPONSOR</option>
                        <option>RESEARCH UNIVERSITY GRANT</option>
                        <option>POST DOCTORAL FELLOWSHIP</option>
                        <option>MINISTRY OF EDUCATION</option>
                    </select>
                </div>      
            </div>
            <div class="col-4">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>FACULTY</option>
                        <option>UTMSPACE-KL</option>
                        <option>MJIIT</option>
                        <option>FSSH-KL</option>
                        <option>FSSH-JB</option>
                    </select>
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>SCHOOL</option>
                        <option>SEKOLAH KEJURUTERAAN KIMIA & TENAGA | J5105</option>
                        <option>SEKOLAH KEJURUTERAAN ELEKTRIK | J5104</option>
                        <option>FAKULTI ALAM BINA & UKUR | J5200</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>STAFF NAME</option>
                        @foreach ($result['project_leader'] as $pl)
                        <option>{{ $pl['name'] }}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="mb-2"> 
                    <select class="tom-select w-full" id="year-select">
                        @for ($i = 1990; $i <= date('Y'); $i++)
                            <option value="{{$i}}" @if($year == $i) selected @endif>{{$i}}</option>
                        @endfor
                    </select> 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body"><canvas id="mixed" width="800" height="300"></canvas></div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="overflow-x-auto" style="height: 300px; overflow: scroll;">
                <table class="table table-sm table-bordered">
                    <thead style="color: white; background-color: rgb(83, 19, 11)">
                        <tr>
                            <th class="whitespace-nowrap">Category</th>
                            <th class="whitespace-nowrap">No. Of Project</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>UNIVERSITY</td>
                            <td><b>{{ $result['sponsor_category'][0]['total'] }}</b></td>
                        </tr>
                        <tr>
                            <td>PRIVATE</td>
                            <td><b>{{ $result['sponsor_category'][1]['total'] }}</b></td>
                        </tr>
                        <tr>
                            <td>NATIONAL</td>
                            <td><b>{{ $result['sponsor_category'][2]['total'] }}</b></td>
                        </tr>
                        <tr>
                            <td>INTERNATIONAL</td>
                            <td><b>{{ $result['sponsor_category'][3]['total'] }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">
            <div class="overflow-x-auto" style="height: 300px; overflow: scroll;">
                <table class="table table-sm table-bordered">
                    <thead style="color: white; background-color: rgb(172, 62, 49)">
                        <tr>
                            <th class="">STAFF NAME</th>
                            <th class="">Project</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result['project_leader'] as $pl)
                        <tr>
                            <td style="font-size: 13px">{{ $pl['name'] }}</td>
                            <td><b>{{ $pl['project'] }}</b></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="intro-y row mt-3">
    <div class="col-12 d-flex">
        <div class="card w-100">
            <div class="card-body"><canvas id="bar1" width="1100" height="300"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var all_result = {!! json_encode($result) !!};
    var result = all_result;
    var sponsor = {sponsor_label:[], total:[], approved:[], faculty:[]};

    result.sponsor_category.forEach((element) => {
        sponsor.sponsor_label.push(element.sponsor);
        sponsor.total.push(element.total);
        sponsor.approved.push(element.approved);
        sponsor.faculty.push(element.faculty);
    });

    var mixed = document.getElementById('mixed');
    var mixedChart = new Chart(mixed, {
        data: {
            labels: sponsor.sponsor_label,
            datasets: [
                {
                    type: 'line',
                    label: 'No Of Project',
                    yAxisID: 'project-axis',
                    data: sponsor.total,
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                },
                {
                    type: 'bar',
                    label: 'Approved',
                    data: sponsor.approved,
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                },
                {
                    type: 'bar',
                    label: 'Received',
                    data: sponsor.approved,
                    backgroundColor: 'rgb(218, 174, 89)',
                    borderColor: 'rgb(218, 174, 89)',
                }
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        display: true,
                        stacked: true,
                        beginAtZero: true
                    },
                    {
                        id: 'project-axis',
                        display: false,
                        stacked: false,
                        beginAtZero: true,
                        suggestedMax: 200
                    }
                ],
            }
        }
    });

    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: result.faculties,
            datasets: [
                {
                    label: 'UNIVERSITY',
                    data: result.sponsor_category[0].faculty,
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'PRIVATE',
                    data: result.sponsor_category[1].faculty,
                    backgroundColor: 'rgb(218, 174, 89)',
                    borderColor: 'rgb(218, 174, 89)',
                    borderWidth: 1
                },
                {
                    label: 'NATIONAL',
                    data: result.sponsor_category[2].faculty,
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
                {
                    label: 'INTERNATIONAL',
                    data: result.sponsor_category[3].faculty,
                    backgroundColor: 'rgba(72, 138, 153)',
                    borderColor: 'rgba(72, 138, 153)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    stacked: true,
                    beginAtZero: true
                },
                x: {
                    stacked: true
                }
            }
        }
    });

    function updateChart(sponsor){
        var data = new FormData();
        var filter_data = {
            sponsor_category : sponsor.value
        };

        data.append("data", JSON.stringify(all_result.raw_data));
        data.append("filter", JSON.stringify(filter_data));
        $.ajax({
            url: "/ajax/grant-mestec/",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                ajaxCallBack(res);
            },
            error: function(data) {
                console.log(data);
            }
        });

    }

    $('#year-select').on('change', function() {
        window.location.href = window.location.origin+"/research/faculty-year/"+this.value;
    });

    
    function ajaxCallBack(data){
        result = data.result;
        var filter = data.filter;
        console.log(result);
        sponsor = {sponsor_label:[], total:[], approved:[], faculty:[]};
        result.sponsor_category.forEach((element) => {
            sponsor.sponsor_label.push(element.sponsor);
            sponsor.total.push(element.total);
            sponsor.approved.push(element.approved);
            sponsor.faculty.push(element.faculty);
        });
        if(filter.sponsor_category == "ALL")mixedChart.data.labels = ['UNIVERSITY', 'PRIVATE', 'NATIONAL', 'INTERNATIONAL'];
        else mixedChart.data.labels = sponsor.sponsor_label;
        mixedChart.data.datasets[0].data = sponsor.total;
        mixedChart.data.datasets[1].data = sponsor.approved;
        mixedChart.data.datasets[2].data = sponsor.approved;
        mixedChart.update();
    }
</script>
@endsection
@endcomponent