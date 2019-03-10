@extends('layout.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts-en.common.js"></script>
@section('contents')

    <div id="main" style="width: 800px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '堆叠区域图'
            },
            tooltip : {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#6a7985'
                    }
                }
            },
            legend: {
                data:['三文鱼','活鲍鱼','芝士焗大虾','阿根廷红虾']
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    data : ['20190228','20190301','20190302','20190303','20190304','20190305','20190306']
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : {!! json_encode($series) !!}

        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    @stop;