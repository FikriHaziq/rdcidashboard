@component("dashboard.layouts.app")
@slot('module') UTM Research @endslot
@slot("submodule") Faculty Achievement - Year @endslot
@section('custom-css') @endsection
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-8 box p-5 cursor-pointer zoom-in" style="background-color: rgb(100, 181, 246)">
                <div class="fw-medium fs-xs text-white">Total Approved, 2021</div>
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
                    <select class="tom-select w-full">
                        <option>SPONSOR CATEGORY</option>
                        <option>UNIVERSITY</option>
                        <option>PRIVATE</option>
                        <option>NATIONAL</option>
                        <option>INTERNATIONAL</option>
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
                        <option>AHMAD FAUZI BIN ISMAIL</option>
                        <option>THAREK BIN ABD RAHMAN</option>
                        <option>ROSLI BIN MD. ILLIAS</option>
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
        <div class="card w-full">&nbsp;</div>
    </div>
    <div class="g-col-3 d-flex align-items-stretch">
        <div class="card w-full">&nbsp;</div>
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
    var result = {!! json_encode($result) !!};
    var mixed = document.getElementById('mixed');
    var mixedChart = new Chart(mixed, {
        data: {
            labels: ['UNIVERSITY', 'PRIVATE', 'NATIONAL', 'INTERNATIONAL'],
            datasets: [
                {
                    type: 'line',
                    label: 'No Of Project',
                    yAxisID: 'project-axis',
                    data: [result.university.total, result.private.total, result.national.total, result.international.total],
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                },
                {
                    type: 'bar',
                    label: 'Approved',
                    data: [result.university.approved, result.private.approved, result.national.approved, result.international.approved],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                },
                {
                    type: 'bar',
                    label: 'Received',
                    data: [result.university.approved, result.private.approved, result.national.approved, result.international.approved],
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
                    data: result.university.faculty,
                    backgroundColor: 'rgb(172, 62, 49)',
                    borderColor: 'rgb(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'PRIVATE',
                    data: result.private.faculty,
                    backgroundColor: 'rgb(218, 174, 89)',
                    borderColor: 'rgb(218, 174, 89)',
                    borderWidth: 1
                },
                {
                    label: 'NATIONAL',
                    data: result.national.faculty,
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
                {
                    label: 'INTERNATIONAL',
                    data: result.international.faculty,
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
</script>
@endsection
@endcomponent