@component("dashboard.layouts.app")
@slot("title") Active Grant In Year @endslot
@section('custom-css') @endsection
@slot("content")
<div class="row">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-header">Overall Research Grant Secured in Yearly Basis</div>
            <div class="card-body"><canvas id="line1" width="1200" height="300"></canvas></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Amount Approved Of Active Grant Secured in Yearly Basis</div>
            <div class="card-body"><canvas id="line2" width="600" height="300"></canvas></div>
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header">Active Research Grant Secured in Yearly Basis</div>
            <div class="card-body"><canvas id="line3" width="600" height="300"></canvas></div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script>
    var line1 = document.getElementById('line1');
    var lineChart1 = new Chart(line1, {
        type: 'line',
        data: {
            labels: ['2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025'],
            datasets: [
                {
                    label: 'ST',
                    data: [intRand(648), intRand(514), intRand(250), intRand(113), intRand(41), intRand(15), intRand(155), intRand(620), intRand(815), intRand(1100), intRand(1100), intRand(2000), intRand(2600), intRand(2400), intRand(2700), intRand(2900), intRand(2900), intRand(2400), intRand(2500), intRand(2800), intRand(3000), intRand(2700), intRand(1700), intRand(263), intRand(26), intRand(2),],
                    backgroundColor: 'rgba(172, 62, 49)',
                    borderColor: 'rgba(172, 62, 49)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    
    var line2 = document.getElementById('line2');
    var lineChart2 = new Chart(line2, {
        type: 'line',
        data: {
            labels: ['2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025'],
            datasets: [
                {
                    label: 'ST',
                    data: [intRand(50), intRand(50), intRand(50), intRand(100), intRand(100), intRand(100), intRand(100), intRand(500), intRand(500), intRand(1500), intRand(2000), intRand(2000), intRand(300), intRand(30), intRand(30),],
                    backgroundColor: 'rgba(0, 0, 0)',
                    borderColor: 'rgba(0, 0, 0)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    var line3 = document.getElementById('line3');
    var lineChart3 = new Chart(line3, {
        type: 'line',
        data: {
            labels: ['2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025'],
            datasets: [
                {
                    label: 'ST',
                    data: [intRand(50), intRand(50), intRand(50), intRand(100), intRand(100), intRand(100), intRand(100), intRand(500), intRand(500), intRand(1500), intRand(2000), intRand(2000), intRand(300), intRand(30), intRand(30),],
                    backgroundColor: 'rgba(72, 138, 153)',
                    borderColor: 'rgba(72, 138, 153)',
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
{{-- Active Research Grant with Extension --}}
@endsection
@endcomponent