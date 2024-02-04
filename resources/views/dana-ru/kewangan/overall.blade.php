@component("layouts.app")
@slot("content")
<div class="intro-y row mt-5">
    <div class="col-4">
        <div class="grid grid-cols-12 gap-3">
            <div class="g-col-6 box p-5 cursor-pointer zoom-in" style="background-color: #4AC4D2">
                <div class="fw-medium fs-base text-white">Belanja</div>
                <div class="fw-bold fs-lg text-white">532,660,000</div>
            </div>
            <div class="g-col-6 box p-5 cursor-pointer zoom-in" style="background-color: #8430CE;">
                <div class="fw-medium fs-base text-white">Agihan</div>
                <div class="fw-bold fs-lg text-white">568,650,000</div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-6">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>TITLE</option>
                        <option>Tier 1</option>
                        <option>Skim Zamalah</option>
                        <option>Flagship Project</option>
                        <option>GUP Tier 2 + Encouregement grant'</option>
                        <option>Pelantikan Pasca Doctoral</option>
                        <option>Insentif PenerbitanPenyelidikan - Jurnal Indeks'</option>
                        <option>Naiktaraf Makmal Penyelidikan</option>
                        <option>Hi Impact Research Lab</option>
                        <option>Matching grant (untuk geran swasta dan antarabangsa)/RACE'</option>
                        <option>Pengurusan IPR</option>
                        <option>Trans Disciplinary Research Grant'</option>
                        <option>Pembelian buku dan langganan secara online dan scival expert'</option>
                        <option>Naik taraf Hi-CoE/Gabung CoE'</option>
                        <option>UTM Seed Fund untuk pra-komersialisasi'</option>
                    </select>
                </div>     
            </div>
            <div class="col-6">
                <div class="mb-2"> 
                    <select class="tom-select w-full">
                        <option>YEAR</option>
                        <option>2022</option>
                        <option>2021</option>
                        <option>2020</option>
                        <option>2019</option>
                        <option>2018</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                        <option>2014</option>
                        <option>2013</option>
                        <option>2012</option>
                    </select>
                </div>     
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-12 d-flex">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div id="chart1">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-y grid grid-cols-12 gap-3 mt-3">
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card w-full p-5">
            <div class="intro-y overflow-x-auto overflow-y-auto mt-8 mt-sm-0">
                <table class="table table-bordered">
                    <thead class="table-dark border-b-0">
                        <tr>
                            <th class="text-nowrap">BPKI</th>
                            <th class="text-nowrap">PROGRAM UTAMA</th>
                            <th class="text-nowrap">KOD PROGRAM</th>
                            <th class="text-nowrap">TITLE</th>
                            <th class="text-nowrap">ALLOCATION</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        {{-- @forelse ($plan->log as $i=>$log)
                        <tr class="intro-x">
                            <td class="text-nowrap">{{ $i+1 }}</td>
                            <td class="text-nowrap">{{ strtoupper($log->status) }}</td>
                            <td class="text-nowrap">
                                @foreach ($log->files as $file)
                                    <a href="{{ route('dana-ru.cadangan-agihan.file.download', $file->id) }}" style="color:blue">{{ $file->filename }}</a>
                                @endforeach
                            </td>
                            <td class="text-nowrap">{{ strtoupper($log->user->name) }}</td>
                            <td class="text-nowrap">{{ date($log->created_at) }}</td>
                        </tr>
                        @empty
                        <tr class="intro-x bg-gray-300">
                            <td class="text-center" colspan="11">No record.</td>
                        </tr>
                        @endforelse --}}
                        @for ($i = 1; $i < 5; $i++)
                        <tr>
                            <td class="text-center">DO</td>
                            <td class="text-center">TD</td>
                            <td class="text-center">21A1.00A00</td>
                            <td class="text-center">SKIM ZAMALAH</td>
                            <td class="text-center">134.279 M</td>
                        </tr>
                        <tr>
                            <td class="text-center">DO</td>
                            <td class="text-center">TD</td>
                            <td class="text-center">21A1.00A00</td>
                            <td class="text-center">SKIM ZAMALAH</td>
                            <td class="text-center">134.279 M</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="g-col-6 d-flex align-items-stretch">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div id="pie1"></div>
            </div>
        </div>
    </div>
</div>
@endslot
@section('custom-js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options1 = {
          series: [{
          name: 'Allocation',
          data: [134000000, 59000000, 56000000, 49000000, 42000000, 22000000, 16000000, 16000000, 11000000, 10000000, 9000000, 9000000, 8000000, 7000000]
        }, {
          name: 'Expenses',
          data: [136000000, 50000000, 58000000, 45000000, 40000000, 18000000, 20000000, 16000000, 10000000, 6000000, 7000000, 10000000, 6000000, 7000000]
        }],
          chart: {
          type: 'bar',
          height: 500
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: [
            'Tier 1',
            'Skim Zamalah',
            'Flagship Project',
            ['GUP Tier 2 + ','Encouregement grant'],
            'Pelantikan Pasca Doctoral',
            ['Insentif Penerbitan','Penyelidikan - Jurnal Indeks'],
            'Naiktaraf Makmal Penyelidikan',
            'Hi Impact Research Lab',
            ['Matching grant (untuk geran ','swasta dan antarabangsa)','/RACE'],
            'Pengurusan IPR',
            ['Trans Disciplinary ','Research Grant'],
            ['Pembelian buku dan ','langganan secara online dan ','scival expert'],
            ['Naik taraf Hi-CoE','/Gabung CoE'],
            ['UTM Seed Fund untuk ','pra-komersialisasi'],
        ],
        },
        yaxis: {
          title: {
            text: 'RM '
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "RM " + val
            }
          }
        }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();

    var options = {
          series: [134000000, 59000000, 56000000, 49000000, 42000000, 22000000, 16000000, 16000000, 11000000, 10000000, 9000000, 9000000, 8000000, 7000000],
          chart: {
          type: 'pie',
          width: '100%'
        },
        labels: [
            'Tier 1',
            'Skim Zamalah',
            'Flagship Project',
            ['GUP Tier 2 + ','Encouregement grant'],
            'Pelantikan Pasca Doctoral',
            ['Insentif Penerbitan','Penyelidikan - Jurnal Indeks'],
            'Naiktaraf Makmal Penyelidikan',
            'Hi Impact Research Lab',
            ['Matching grant (untuk geran ','swasta dan antarabangsa)','/RACE'],
            'Pengurusan IPR',
            ['Trans Disciplinary ','Research Grant'],
            ['Pembelian buku dan ','langganan secara online dan ','scival expert'],
            ['Naik taraf Hi-CoE','/Gabung CoE'],
            ['UTM Seed Fund untuk ','pra-komersialisasi'],
        ],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var chart = new ApexCharts(document.querySelector("#pie1"), options);
    chart.render();
</script>
@endsection
@endcomponent