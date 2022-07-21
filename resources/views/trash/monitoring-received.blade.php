@component("layouts.app")
@slot("title") Active Grant In Year @endslot
@section('custom-css') 
<style>
    .paper-range {
        background-color: #FFF;
        padding: 3px;
        border: 1px solid #AAA;
        border-radius: 5px;
    }
</style>
@endsection
@slot("content")
<div class="row">
    <div class="col-2">
        <div class="row">
            <div class="col card card-plain">
                <div style="font-size: 20px; font-weight: bold;">
                    <label>Filter: </label>
                </div>
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="startYear">
                        <option>START YEAR</option>
                        <option>2021</option>
                        <option>2020</option>
                        <option>2019</option>
                    </select>
                </div>  
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="grantType">
                        <option>GRANT TYPE</option>
                        <option>FUNDAMENTAL RESEARCH GRANT SCHEME</option>
                        <option>UTM ENCOURAGEMENT RESEARCH</option>
                        <option>UTM TRANDICIPLINARY RESEARCH GRANT</option>
                    </select>
                </div>            
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="sponsorCategory">
                        <option>SPONSOR CATEGORY</option>
                        <option>UNIVERSITY</option>
                        <option>NATIONAL</option>
                        <option>PRIVATE</option>
                        <option>INTERNATIONAL</option>
                    </select>
                </div>            
                <div class="w-100 mb-2">
                    <select class="form-control select2" id="faculty">
                        <option>FACULTY</option>
                        <option>UTMSPACE-KL</option>
                        <option>MJIIT</option>
                        <option>FSSH-KL</option>
                        <option>FSSH-JB</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="row">
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>SODO TOTAL</small></div>
                    <div class="card-body h3">237.90M</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>AMOUNT RECEIVED CUMMULATIVE</small></div>
                    <div class="card-body h3">158.84M</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>AMOUNT SPENT CUMMULATIVE</small></div>
                    <div class="card-body h3">94.95M</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>PERCENT SPENT CUMMULATIVE</small></div>
                    <div class="card-body h3">59.78%</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>OPEN BALANCE</small></div>
                    <div class="card-body h3">79.06M</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>AMOUNT RECEIVED IN YEAR</small></div>
                    <div class="card-body h3">17.95M</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>AMOUNT SPENT IN YEAR</small></div>
                    <div class="card-body h3">22.20M</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>PERCENT SPENT CUMMULATIVE</small></div>
                    <div class="card-body h3">123.68%</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-header"><small>PERCENT RECEIVE BY UNIVERSITY</small></div>
                    <div class="card-body h3">66.77%</div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-stretch">
                <div class="card w-100 bg-danger text-white">
                    <div class="card-header"><small>GRANT WITN NO AMOUNT RECEIVED</small></div>
                    <div class="card-body h3">92</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Balance Not Receive by Active Grant</div>
            <div class="card-body"><canvas id="bar1" width="400" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Grant with 0 Amount Received</div>
            <div class="card-body"><canvas id="bar2" width="400" height="300"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var bar1 = document.getElementById('bar1');
    var barChart1 = new Chart(bar1, {
        type: 'bar',
        data: {
            labels: ['NATIONAL', 'PRIVATE', 'UNIVERSITY', 'INTERNATIONAL'],
            datasets: [
                {
                    label: 'Sodo Total',
                    data: [intRand(89400000), intRand(40200000), intRand(82800000), intRand(25600000)],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
                {
                    label: 'Balance Not Receive',
                    data: [intRand(29800000), intRand(19700000), intRand(17200000), intRand(12300000)],
                    backgroundColor: 'rgba(72, 72, 72)',
                    borderColor: 'rgba(72, 72, 72)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var bar2 = document.getElementById('bar2');
    var barChart2 = new Chart(bar2, {
        type: 'bar',
        data: {
            labels: ['PRIVATE', 'NATIONAL', 'INTERNATIONAL', 'UNIVERSITY'],
            datasets: [
                {
                    label: 'DATA',
                    data: ['31', '22', '21', '18'],
                    backgroundColor: 'rgba(72, 138, 153)',
                    borderColor: 'rgba(72, 138, 153)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            },
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });
</script>
{{-- Active Research Grant with Extension --}}
@endsection
@endcomponent