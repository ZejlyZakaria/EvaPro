<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div
                        class="d-sm-flex align-items-center justify-content-between border-bottom"
                    >
                        <h4 class="card-title" style="font-weight: 700">
                            Tableau De Bord
                        </h4>

                        <div>
                            <div class="btn-wrapper">
                                <!-- <a
                                    href="#"
                                    class="btn btn-otline-dark align-items-center"
                                    ><i class="icon-share"></i> Share</a
                                > -->
                                <a href="#" class="btn btn-otline-dark" @click="printPage()"
                                    ><i class="icon-printer"></i> Imprimer</a
                                >
                                <a
                                    href="#"
                                    class="btn btn-primary text-white me-0"
                                    onclick="showSwal('success-message')"
                                    ><i class="icon-download"></i> Export</a
                                >
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                        <div
                            class="tab-pane fade show active"
                            id="overview"
                            role="tabpanel"
                            aria-labelledby="overview"
                        >

                            <div class="row">
                                <div class="col-lg-8 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div
                                            class="col-12 grid-margin stretch-card"
                                        >
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div
                                                        class="d-sm-flex justify-content-between align-items-start"
                                                    >
                                                        <div>
                                                            <h4
                                                                class="card-title card-title-dash"
                                                            >
                                                                Total payé
                                                            </h4>
                                                            <p
                                                                class="card-subtitle card-subtitle-dash"
                                                            >
                                                                Tout le total payé par NEWTEAM entre cette et l'année précédente.
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div
                                                        class="d-sm-flex align-items-center mt-1 justify-content-between"
                                                    >
                                                        <div
                                                            class="d-sm-flex align-items-center mt-4 justify-content-between"
                                                        >
                                                            <h2
                                                                class="me-2 fw-bold"
                                                            >
                                                                {{
                                                                    "28000" +
                                                                        "€"
                                                                }}
                                                            </h2>
                                                            <h4 class="me-2">
                                                                EURO
                                                            </h4>
                                                            <h4
                                                                class="text-success"
                                                            >
                                                                (Total pour cette année)
                                                            </h4>
                                                        </div>
                                                        <div class="me-3">
                                                            <div
                                                                id="marketing-overview-legend"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="chartjs-bar-wrapper mt-3"
                                                    >
                                                        <canvas
                                                            id="marketingOverview"
                                                        ></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div
                                            class="col-12 grid-margin stretch-card"
                                        >
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-3"
                                                            >
                                                                <h4
                                                                    class="card-title card-title-dash"
                                                                >
                                                                    Projets réalisés / en cours
                                                                </h4>
                                                            </div>
                                                            <canvas
                                                                class="my-auto"
                                                                id="doughnutChart"
                                                                height="200"
                                                            ></canvas>
                                                            <div
                                                                id="doughnut-chart-legend"
                                                                class="mt-5 text-center"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex-grow"> &nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'
export default {
    mounted() {
        this.getData();

    },
    data() {
        return {
            provider: {
                id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content")
            },
            totalSales: "",
            billings: {},
            tempBillings: {},
            gainRate: "",
            gainValue: "",
            projectsCount: "",
            projectsDone: "",
            projects: {},
            providers: {},
            providersStat: "",
            projectsDone: 0,
            billAmount: 0,
            data1Chart1: [],
            data2Chart1: [],
            valueClosed: '',
            data1Chart1: [],
            data2Chart1: [],
            totalPayment: "",
        };
    },
    methods: {
        getData() {
            var projectsCount = 0;
            var projectsCountDone = 0;
            axios.post("api/getProjectsCountPro/" + this.provider.id).then(response => {
                projectsCount = response.data.data;
                axios.post("api/getProjectsCountProDone/" + this.provider.id).then(response => {
                projectsCountDone = response.data.data;

                var projectsChart = [projectsCount, projectsCountDone];
                this.loadCharts(projectsChart);

            });
            });

        },
        loadCharts(projectsChart) {
            (function($) {
                'use strict';
                $(function() {
                if ($("#marketingOverview").length) {
                    var marketingOverviewChart = document.getElementById("marketingOverview").getContext('2d');
                    var marketingOverviewData = {
                        labels: ["JAN","FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                        datasets: [{
                            label: 'Année précédente',
                            data: [110, 220, 200, 190, 220, 110, 210, 110, 205, 202, 201, 150],
                            backgroundColor: "#52CDFF",
                            borderColor: [
                                '#52CDFF',
                            ],
                            borderWidth: 0,
                            fill: true, // 3: no fill

                        },{
                        label: 'Cette année',
                        data: [215, 290, 210, 250, 290, 230, 290, 210, 280, 220, 190, 300],
                        backgroundColor: "#1F3BB3",
                        borderColor: [
                            '#1F3BB3',
                        ],
                        borderWidth: 0,
                        fill: true, // 3: no fill
                    }]
                    };

                    var marketingOverviewOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color:"#F0F0F0",
                                    zeroLineColor: '#F0F0F0',
                                },
                                ticks: {
                                beginAtZero: true,
                                autoSkip: true,
                                maxTicksLimit: 5,
                                fontSize: 10,
                                color:"#6B778C"
                                }
                            }],
                            xAxes: [{
                            stacked: true,
                            barPercentage: 0.35,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 12,
                                fontSize: 10,
                                color:"#6B778C"
                            }
                        }],
                        },
                        legend:false,
                        legendCallback: function (chart) {
                        var text = [];
                        text.push('<div class="chartjs-legend"><ul>');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            console.log(chart.data.datasets[i]); // see what's inside the obj.
                            text.push('<li class="text-muted text-small">');
                            text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                            text.push(chart.data.datasets[i].label);
                            text.push('</li>');
                        }
                        text.push('</ul></div>');
                        return text.join("");
                        },

                        elements: {
                            line: {
                                tension: 0.4,
                            }
                        },
                        tooltips: {
                            backgroundColor: 'rgba(31, 59, 179, 1)',
                        }
                    }
                    var marketingOverview = new Chart(marketingOverviewChart, {
                        type: 'bar',
                        data: marketingOverviewData,
                        options: marketingOverviewOptions
                    });
                    document.getElementById('marketing-overview-legend').innerHTML = marketingOverview.generateLegend();
                }
                if ($("#doughnutChart").length) {
                    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
                    var doughnutPieData = {
                    datasets: [{
                        data: projectsChart,
                        backgroundColor: [
                        "#1F3BB3",
                        "#81DADA"
                        ],
                        borderColor: [
                        "#1F3BB3",
                        "#81DADA"
                        ],
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Réalisés',
                        'En cours',

                    ]
                    };
                    var doughnutPieOptions = {
                    cutoutPercentage: 50,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    responsive: true,
                    maintainAspectRatio: true,
                    showScale: true,
                    legend: false,
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<div class="chartjs-legend"><ul class="justify-content-center">');
                        for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
                        text.push('</span>');
                        if (chart.data.labels[i]) {
                            text.push(chart.data.labels[i]);
                        }
                        text.push('</li>');
                        }
                        text.push('</div></ul>');
                        return text.join("");
                    },

                    layout: {
                        padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                        }
                    },
                    tooltips: {
                        callbacks: {
                        title: function(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            return data['datasets'][0]['data'][tooltipItem['index']];
                        }
                        },

                        backgroundColor: '#fff',
                        titleFontSize: 14,
                        titleFontColor: '#0B0F32',
                        bodyFontColor: '#737F8B',
                        bodyFontSize: 13,
                        displayColors: false
                    }
                    };
                    var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: doughnutPieData,
                    options: doughnutPieOptions
                    });
                    document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
                }


                });
            })(jQuery);

        },
        printPage() {
            window.print();
        }
    },
    created() {
        this.getData();
    }
};
</script>
