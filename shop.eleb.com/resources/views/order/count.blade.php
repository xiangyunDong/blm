@extends('layout.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts-en.common.js"></script>
@section('contents')
    <h1>{{$title}}</h1>
    <table class="table table-bordered">
        <tr>
            @foreach($datas as $date=>$amount):
            <th>{{$date}}</th>
                @endforeach;
        </tr>
        <tr>
            @foreach($datas as $date=>$amount):
        <th>{{$amount}}</th>
                @endforeach;
        </tr>
    </table>
    <div id="main" style="width: 800px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text:''
            },
            tooltip: {},
            legend: {
                data:'订单量'
            },
            xAxis: {
                data: {!! json_encode(array_keys($datas)) !!}
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: {!! json_encode(array_values($datas)) !!}
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    @stop;