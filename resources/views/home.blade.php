@section('styles')
<style>
body{
    background:#05070f !important;
}
.content{
    background:#05070f;
}

/* ===== GLASS CARD ===== */
.glass-card{
    background:rgba(15,23,42,.65);
    backdrop-filter: blur(18px);
    border-radius:16px;
    border:1px solid rgba(255,255,255,.06);
    box-shadow:0 25px 60px rgba(0,0,0,.7);
    color:#fff;
}
.stat-card{
    position:relative;
    overflow:hidden;
}
.stat-card i{
    position:absolute;
    right:16px;
    top:16px;
    font-size:3rem;
    opacity:.15;
}

/* ===== CHART CONTAINER ===== */
.chart-box{
    position:relative;
    padding:20px;
    border-radius:18px;
    background:linear-gradient(180deg,#0b1020,#060914);
    box-shadow:inset 0 0 0 1px rgba(255,255,255,.04),
               0 30px 60px rgba(0,0,0,.8);
}

/* ===== LOADER ===== */
.chart-loader{
    position:absolute;
    inset:0;
    background:rgba(5,7,15,.75);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:10;
    border-radius:18px;
}
.chart-loader span{
    color:#38bdf8;
    font-size:14px;
}

/* ===== NEON TOOLTIP ===== */
.apexcharts-tooltip{
    background:#020617 !important;
    border:1px solid #38bdf8 !important;
    box-shadow:0 0 20px rgba(56,189,248,.9);
    color:#fff;
}
</style>
@endsection
@extends('layouts.admin')

@section('content')
<div class="content p-3">

{{-- ================= ROW DATA CARDS ================= --}}
<div class="row mb-4">
@foreach([
['Total Row Data',$totalRowData,'database'],
['Used',$usedRowData,'check-circle'],
['Unused',$unusedRowData,'ban'],
['Total Amount','₹'.number_format($totalAmount),'wallet'],
] as $c)
<div class="col-md-3">
    <div class="glass-card stat-card p-3">
        <i class="fa fa-{{ $c[2] }}"></i>
        <small class="text-muted">{{ $c[0] }}</small>
        <h3 class="fw-bold">{{ $c[1] }}</h3>
    </div>
</div>
@endforeach
</div>

{{-- ================= WINNER CARDS ================= --}}
<div class="row mb-5">
@foreach([
['Total Winners',$totalWinners,'trophy'],
['Pending','₹'.number_format($pendingAmount),'clock'],
['Processing','₹'.number_format($processingAmount),'sync'],
['Payable','₹'.number_format($totalWinnerAmount),'money-bill'],
] as $c)
<div class="col-md-3">
    <div class="glass-card stat-card p-3">
        <i class="fa fa-{{ $c[2] }}"></i>
        <small class="text-muted">{{ $c[0] }}</small>
        <h3 class="fw-bold">{{ $c[1] }}</h3>
    </div>
</div>
@endforeach
</div>

{{-- ================= ROW DATA ================= --}}
<div class="row mb-3 align-items-center">
    <div class="col-md-3"><h5 class="text-info">Row Data Analytics</h5></div>

    <div class="col-md-3">
        <select id="rowRange" class="form-select bg-dark text-white">
            <option value="">Total</option>
            <option value="today">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
            <option value="3month">Last 3 Months</option>
            <option value="6month">Last 6 Months</option>
            <option value="year">Last Year</option>
        </select>
    </div>

    <div class="col-md-2">
        <input type="date" id="rowFrom" class="form-control bg-dark text-white">
    </div>
    <div class="col-md-2">
        <input type="date" id="rowTo" class="form-control bg-dark text-white">
    </div>
    <div class="col-md-2">
        <button id="rowApply" class="btn btn-info w-100">Apply</button>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-7">
        <div class="chart-box">
            <div class="chart-loader" id="rowLoader"><span>Loading…</span></div>
            <div id="rowLineChart"></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="chart-box">
            <div id="rowPieChart"></div>
        </div>
    </div>
</div>

{{-- ================= WINNER ================= --}}
<div class="row mb-3 align-items-center">
    <div class="col-md-3">
        <h5 class="text-warning">Winner Analytics</h5>
        <small class="text-muted">Started from: {{ $winnerStartDate ?? 'N/A' }}</small>
    </div>

    <div class="col-md-3">
        <select id="winnerRange" class="form-select bg-dark text-white">
            <option value="">Total</option>
            <option value="today">Today</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
            <option value="3month">Last 3 Months</option>
            <option value="6month">Last 6 Months</option>
            <option value="year">Last Year</option>
        </select>
    </div>

    <div class="col-md-2">
        <input type="date" id="winnerFrom" class="form-control bg-dark text-white">
    </div>
    <div class="col-md-2">
        <input type="date" id="winnerTo" class="form-control bg-dark text-white">
    </div>
    <div class="col-md-2">
        <button id="winnerApply" class="btn btn-warning w-100">Apply</button>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="chart-box">
            <div class="chart-loader" id="winnerLoader"><span>Loading…</span></div>
            <div id="winnerLineChart"></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="chart-box">
            <div id="winnerPieChart"></div>
        </div>
    </div>
</div>

</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
/* ================= INIT CHARTS ================= */

let rowChart = new ApexCharts(document.querySelector("#rowLineChart"),{
    chart:{type:'area',height:280,toolbar:{show:false}},
    series:[{name:'Row Data',data:@json($rowChart->pluck('total'))}],
    xaxis:{categories:@json($rowChart->pluck('date'))},
    stroke:{curve:'smooth',width:4},
    fill:{type:'gradient',gradient:{opacityFrom:.6,opacityTo:.1}},
    colors:['#38bdf8'],
    tooltip:{theme:'dark'}
});
rowChart.render();

let winnerChart = new ApexCharts(document.querySelector("#winnerLineChart"),{
    chart:{type:'area',height:280,toolbar:{show:false}},
    series:[{name:'Winner Amount',data:@json($winnerChart->pluck('total'))}],
    xaxis:{categories:@json($winnerChart->pluck('date'))},
    stroke:{curve:'smooth',width:4},
    fill:{type:'gradient',gradient:{opacityFrom:.6,opacityTo:.1}},
    colors:['#f59e0b'],
    tooltip:{theme:'dark'}
});
winnerChart.render();

/* ================= PIE CHARTS ================= */

new ApexCharts(document.querySelector("#rowPieChart"),{
    chart:{type:'donut'},
    series:[{{ $usedRowData }},{{ $unusedRowData }}],
    labels:['Used','Unused'],
    colors:['#22c55e','#fde047'],
    tooltip:{theme:'dark'}
}).render();

new ApexCharts(document.querySelector("#winnerPieChart"),{
    chart:{type:'donut'},
    series:[{{ $pendingAmount }},{{ $processingAmount }}],
    labels:['Pending','Processing'],
    colors:['#ef4444','#f59e0b'],
    tooltip:{theme:'dark'}
}).render();

/* ================= AJAX HELPERS ================= */

function updateChart(url, chart, params, loader){
    loader.show();
    $.get(url, params)
        .done(function(res){
            if(!res || res.length === 0){
                chart.updateSeries([{data:[]}]);
                chart.updateOptions({xaxis:{categories:[]}});
                return;
            }
            chart.updateOptions({xaxis:{categories:res.map(i=>i.date)}});
            chart.updateSeries([{data:res.map(i=>i.total)}]);
        })
        .always(function(){
            loader.hide();
        });
}

/* ===== ROW PRESET ===== */
$('#rowRange').on('change',function(){
    $('#rowFrom,#rowTo').val('');
    updateChart(
        "{{ route('admin.dashboard.rowData') }}",
        rowChart,
        {range:this.value},
        $('#rowLoader')
    );
});

/* ===== ROW MANUAL ===== */
$('#rowApply').on('click',function(){
    if(!$('#rowFrom').val() || !$('#rowTo').val()) return;
    $('#rowRange').val('');
    updateChart(
        "{{ route('admin.dashboard.rowData') }}",
        rowChart,
        {from:$('#rowFrom').val(),to:$('#rowTo').val()},
        $('#rowLoader')
    );
});

/* ===== WINNER PRESET ===== */
$('#winnerRange').on('change',function(){
    $('#winnerFrom,#winnerTo').val('');
    updateChart(
        "{{ route('admin.dashboard.winnerData') }}",
        winnerChart,
        {range:this.value},
        $('#winnerLoader')
    );
});

/* ===== WINNER MANUAL ===== */
$('#winnerApply').on('click',function(){
    if(!$('#winnerFrom').val() || !$('#winnerTo').val()) return;
    $('#winnerRange').val('');
    updateChart(
        "{{ route('admin.dashboard.winnerData') }}",
        winnerChart,
        {from:$('#winnerFrom').val(),to:$('#winnerTo').val()},
        $('#winnerLoader')
    );
});
</script>
@endsection
