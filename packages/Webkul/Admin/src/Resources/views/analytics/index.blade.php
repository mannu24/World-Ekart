@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.dashboard.title') }}
@stop

@section('content-wrapper')

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1>Commissions and Analytics</h1>
            </div>

            <div class="page-action">
                <date-filter></date-filter>
               
            </div>

            <date-mobile-filter></date-mobile-filter>
        </div>

        <div class="page-content">

            <div class="dashboard-stats">
                <div class="dashboard-card">
                    <div class="title">Total Sales</div>
                    <div class="data">
                        {{ core()->formatBasePrice($statistics['total_sales']) }}
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="title">This Month Sales</div>
                    <div class="data">
                        {{ core()->formatBasePrice($statistics['month_sales']) }}
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="title">Total Commissions</div>
                    <div class="data">
                        {{ core()->formatBasePrice($statistics['total_commissions']) }}
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="title">This Month Commissions</div>
                    <div class="data">
                        {{ core()->formatBasePrice($statistics['month_commissions']) }}
                    </div>
                </div>

            </div>

            <div class="graph-stats">
                <div class="left-card-container graph">
                    <div class="card" style="overflow: hidden;">
                        <div class="card-title" style="margin-bottom: 30px;">
                            Commissions
                        </div>
                        <div class="card-info" style="height: 100%;">
                            <canvas id="myChart" style="width: 100%; height: 87%"></canvas>
                        </div>
                    </div>
                </div>
                <div class="right-card-container category">
                    <div class="card">
                        <div class="card-title">Top Performing Vendors</div>
                        <div class="card-info {{ !count($statistics['top_vendors']) ? 'center' : '' }}">
                            @if (count($statistics['top_vendors']))
                            <ul>

                                @foreach ($statistics['top_vendors'] as $item)

                                    <li>
                                        <a href="{{ route('admin.vendor.view', $item->vendor_id) }}">
                                            <div class="description">
                                                <div class="name">
                                                    {{ $item->name }}
                                                </div>

                                                <div class="info">
                                                    {{ __('admin::app.dashboard.sale-count', ['count' => $item->total_orders]) }}
                                                </div>
                                            </div>

                                            <span class="icon angle-right-icon"></span>
                                        </a>
                                    </li>

                                @endforeach

                            </ul>

                            @else

                                <div class="no-result-found">

                                    <i class="icon no-result-icon"></i>
                                    <p>{{ __('admin::app.common.no-result-found') }}</p>

                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('scripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <script type="text/x-template" id="date-filter-template">
        <div id="calender-destop">
            <div class="control-group date">
                <date @onChange="applyFilter('start', $event)" hide-remove-button="1"><input type="text" class="control" id="start_date" value="{{ $startDate->format('Y-m-d') }}" placeholder="{{ __('admin::app.dashboard.from') }}" v-model="start"/></date>
            </div>

            <div class="control-group date">
                <date @onChange="applyFilter('end', $event)" hide-remove-button="1"><input type="text" class="control" id="end_date" value="{{ $endDate->format('Y-m-d') }}" placeholder="{{ __('admin::app.dashboard.to') }}" v-model="end"/></date>
            </div>
        </div>
    </script>

    <script type="text/x-template" id="date-mobile-filter-template">
        <div>
            <div id="calender-mobile">
                <span  @click="openCalender()"></span>
            </div>
            <div v-if="toggleCalenderIcon">
                <div id="date-start" style="">
                    <div class="control-group start-date" style="margin-top:15px">
                    <label for="type">{{ __('admin::app.dashboard.from') }}</label>
                        <date @onChange="setDate('start', $event)" hide-remove-button="1">
                            <input type="text" class="control" id="start_date" value="{{ $startDate->format('Y-m-d') }}" placeholder="{{ __('admin::app.dashboard.from') }}" v-model="start"/>
                        </date>
                    </div>
                </div>

                <div id="date-end" style="">
                    <div class="control-group end-date" style="margin-top:15px">
                        <label for="type">{{ __('admin::app.dashboard.to') }}</label>
                        <date @onChange="setDate('end', $event)" hide-remove-button="1">
                            <input type="text" class="control" id="end_date" value="{{ $endDate->format('Y-m-d') }}" placeholder="{{ __('admin::app.dashboard.to') }}" v-model="end"/>
                        </date>
                    </div>
                </div>

                <div id="date-submit" style="">
                    <button class="btn btn-lg btn-primary" @click="applyFilter">Submit</button>
                </div>              
            </div>            
        </div>
    </script>

    <script>
        Vue.component('date-filter', {

            template: '#date-filter-template',

            data: function() {
                return {
                    start: "{{ $startDate->format('Y-m-d') }}",
                    end: "{{ $endDate->format('Y-m-d') }}",
                }
            },

            methods: {
                applyFilter: function(field, date) {
                    this[field] = date;

                    window.location.href = "?start=" + this.start + '&end=' + this.end;
                }
            }
        });

        Vue.component('date-mobile-filter', {

            template: '#date-mobile-filter-template',

            data: function() {
                return {
                    start: "{{ $startDate->format('Y-m-d') }}",
                    end: "{{ $endDate->format('Y-m-d') }}",
                    toggleCalenderIcon : 0
                }
            },

            methods: {

                openCalender: function(){

                    if(this.toggleCalenderIcon){
                        this.toggleCalenderIcon = 0;
                        $('#calender-mobile span').css('top','0');
                    }else{
                        this.toggleCalenderIcon = 1;
                        $('#calender-mobile span').css('top','-40px');
                    }
                },

                setDate: function(field, date) {
                    this[field] = date;
                },

                applyFilter: function() {
                    window.location.href = "?start=" + this.start + '&end=' + this.end;
                }
            }
        });

        $(document).ready(function () {

            var ctx = document.getElementById("myChart").getContext('2d');

            var data = @json($statistics['sale_graph']);

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['label'],
                    datasets: [{
                        data: data['total'],
                        backgroundColor: 'rgba(34, 201, 93, 1)',
                        borderColor: 'rgba(34, 201, 93, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            maxBarThickness: 20,
                            gridLines : {
                                display : false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 20,
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, dataTemp) {
                                return data['formated_total'][tooltipItem.index];
                            }
                        }
                    }
                }
            });
        });
    </script>

@endpush