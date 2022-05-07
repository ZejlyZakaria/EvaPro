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
                                <a
                                    href="#"
                                    class="btn btn-otline-dark align-items-center"
                                    ><i class="icon-share"></i> Share</a
                                >
                                <a href="#" class="btn btn-otline-dark"
                                    ><i class="icon-printer"></i> Print</a
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
                                <div class="col-sm-12">
                                    <div
                                        class="statistics-details d-flex align-items-center justify-content-between"
                                    >
                                        <div>
                                            <p class="statistics-title">
                                                Taux de gain
                                            </p>
                                            <h3 class="rate-percentage">
                                                {{ gainRate + "%" }}
                                            </h3>
                                            <!-- <p class="text-danger d-flex">
                                                <i class="mdi mdi-menu-down"></i
                                                ><span>-0.5%</span>
                                            </p> -->
                                        </div>
                                        <div>
                                            <p class="statistics-title">
                                                Gain en valeur
                                            </p>
                                            <h3 class="rate-percentage">
                                                {{ gainValue + "€" }}
                                            </h3>
                                            <!-- <p class="text-success d-flex">
                                                <i class="mdi mdi-menu-up"></i
                                                ><span>+0.1%</span>
                                            </p> -->
                                        </div>
                                        <div>
                                            <p class="statistics-title">
                                                Nombre de projets
                                            </p>
                                            <h3 class="rate-percentage">
                                                {{ projects.length }}
                                            </h3>
                                            <!-- <p class="text-danger d-flex">
                                                <i class="mdi mdi-menu-down"></i
                                                ><span>68.8</span>
                                            </p> -->
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">
                                                Nombre de projets réalisés
                                            </p>
                                            <h3 class="rate-percentage">
                                                {{ projectsDone }}
                                            </h3>
                                            <!-- <p class="text-success d-flex">
                                                <i class="mdi mdi-menu-down"></i
                                                ><span>+0.8%</span>
                                            </p> -->
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">
                                                Nombre de fournisseurs
                                            </p>
                                            <h3 class="rate-percentage">
                                                {{ providers.length }}
                                            </h3>
                                            <!-- <p class="text-danger d-flex">
                                                <i class="mdi mdi-menu-down"></i
                                                ><span>68.8</span>
                                            </p> -->
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">
                                                Chiffre d'affaires
                                            </p>
                                            <h3 class="rate-percentage">
                                                {{ billAmount + "€" }}
                                            </h3>
                                            <!-- <p class="text-success d-flex">
                                                <i class="mdi mdi-menu-down"></i
                                                ><span>+0.8%</span>
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div
                                            class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card"
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
                                                                Différences de
                                                                bénéfices
                                                            </h4>
                                                            <h5
                                                                class="card-subtitle card-subtitle-dash"
                                                            >
                                                                Différence de
                                                                profit entre
                                                                l'année en cours
                                                                et l'année
                                                                précédente.
                                                            </h5>
                                                        </div>
                                                        <div
                                                            id="performance-line-legend"
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="chartjs-wrapper mt-5"
                                                    >
                                                        <canvas
                                                            id="performaneLine"
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
                                            class="col-md-6 col-lg-12 grid-margin stretch-card"
                                        >
                                            <div
                                                class="card bg-primary card-rounded"
                                            >
                                                <div class="card-body pb-0">
                                                    <h4
                                                        class="card-title card-title-dash text-white mb-4"
                                                    >
                                                        Résumé de l'état
                                                    </h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p
                                                                class="status-summary-ight-white mb-1"
                                                            >
                                                                Bénéfice moyen
                                                            </p>
                                                            <h2
                                                                class="text-info"
                                                            >
                                                                {{ valueClosed + '€' }}
                                                            </h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div
                                                                class="status-summary-chart-wrapper pb-4"
                                                            >
                                                                <canvas
                                                                    id="status-summary"
                                                                ></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
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
                                                                Chiffre d'affaires
                                                            </h4>
                                                            <p
                                                                class="card-subtitle card-subtitle-dash"
                                                            >
                                                                Lorem ipsum
                                                                dolor sit amet
                                                                consectetur
                                                                adipisicing elit
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <div
                                                                class="dropdown"
                                                            >
                                                                <button
                                                                    class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                    type="button"
                                                                    id="dropdownMenuButton2"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    This month
                                                                </button>
                                                                <div
                                                                    class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton2"
                                                                >
                                                                    <h6
                                                                        class="dropdown-header"
                                                                    >
                                                                        Settings
                                                                    </h6>
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        >Action</a
                                                                    >
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        >Another
                                                                        action</a
                                                                    >
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        >Something
                                                                        else
                                                                        here</a
                                                                    >
                                                                    <div
                                                                        class="dropdown-divider"
                                                                    ></div>
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        >Separated
                                                                        link</a
                                                                    >
                                                                </div>
                                                            </div>
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
                                                                    totalSales +
                                                                        "€"
                                                                }}
                                                            </h2>
                                                            <h4 class="me-2">
                                                                EURO
                                                            </h4>
                                                            <h4
                                                                class="text-success"
                                                            >
                                                                (+1.37%)
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
                                                                <div>
                                                                    <h4
                                                                        class="card-title card-title-dash"
                                                                    >
                                                                        Leave
                                                                        Report
                                                                    </h4>
                                                                </div>
                                                                <div>
                                                                    <div
                                                                        class="dropdown"
                                                                    >
                                                                        <button
                                                                            class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                            type="button"
                                                                            id="dropdownMenuButton3"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false"
                                                                        >
                                                                            Month
                                                                            Wise
                                                                        </button>
                                                                        <div
                                                                            class="dropdown-menu"
                                                                            aria-labelledby="dropdownMenuButton3"
                                                                        >
                                                                            <h6
                                                                                class="dropdown-header"
                                                                            >
                                                                                week
                                                                                Wise
                                                                            </h6>
                                                                            <a
                                                                                class="dropdown-item"
                                                                                href="#"
                                                                                >Year
                                                                                Wise</a
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3">
                                                                <canvas
                                                                    id="leaveReport"
                                                                ></canvas>
                                                            </div>
                                                        </div>
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
                                                                    Fournisseurs par type
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
        this.getBillings();
        this.getTotalSales();

    },
    data() {
        return {
            totalSales: "",
            billings: {},
            tempBillings: {},
            gainRate: "",
            gainValue: "",
            projectsCount: "",
            projects: {},
            providers: {},
            providersStat: "",
            projectsDone: 0,
            billAmount: 0,
            data1Chart1: [],
            data2Chart1: [],
            valueClosed: '',
            labels: [
                "JANV",
                "FEVR",
                "MARS",
                "AVR",
                "MAI",
                "JUIN",
                "JUILL",
                "AOÛT",
                "SEPT",
                "OCT",
                "NOV",
                "DEC"
            ],
            data1Chart1: [],
            data2Chart1: []
        };
    },
    methods: {
        getBillings() {
            axios.get("api/getBillingsDash").then(response => {
                this.billings = response.data.data.reverse();
                var totalCom = 0;
                var billAmount = 0;
                this.billings.forEach(element => {
                    totalCom += element.total_commissions;
                    billAmount += element.bill_amount;
                });
                var gain = 0;
                if (billAmount != 0) gain = (totalCom * 100) / billAmount;
                this.gainRate = gain;
                this.gainValue = totalCom;
                this.billAmount = billAmount;



            });
            var date = new Date();
            axios.get("api/getProjectsCountDash").then(response => {
                this.projects = response.data.data;
                this.projects.forEach(element => {
                    var dateSQL = element.end_date.split("-");
                    var dateJS = new Date();
                    dateJS.setFullYear(
                        parseInt(dateSQL[0]),
                        parseInt(dateSQL[1]) - 1,
                        parseInt(dateSQL[2])
                    );
                    if (dateJS < date) this.projectsDone += 1;
                });
            });

            axios.get("api/getProviders").then(response => {
                this.providers = response.data.data;
                var s = 0;
                var f = 0;
                this.providers.forEach(element => {
                    if (element.type == "Salarié") s++;
                    else if (element.type == "Freelance") f++;
                });
                var tab = [s, f];
                this.providersStat = tab;

                            var currentYear = new Date().getFullYear();
            this.labels.forEach(label => {
                var total = 0;
                for (let index = 0; index < this.billings.length; index++) {
                    if (
                        this.billings[index].billing_month == label &&
                        this.billings[index].billing_year == currentYear
                    ) {
                        total += this.billings[index].total_commissions;
                    }
                }
                this.data1Chart1.push(total);
            });
            var lastYear = currentYear - 1;
            this.labels.forEach(label => {
                var total = 0;
                for (let index = 0; index < this.billings.length; index++) {
                    if (
                        this.billings[index].billing_month == label &&
                        this.billings[index].billing_year == lastYear
                    ) {
                        total += this.billings[index].total_commissions;
                    }
                }
                this.data2Chart1.push(total);
            });
            var val = 0;
            this.data1Chart1.forEach(element => {
                val += element;
            });
            this.valueClosed = val / (this.data1Chart1.length);

                this.loadCharts(this.data1Chart1, this.data2Chart1, tab);

            });


        },
        getTotalSales() {
            axios.get("api/getTotalSales").then(response => {
                this.totalSales = response.data.data;
            });
        },
        loadCharts(gainsChartData1, gainsChartData2, providersChart) {
            (function($) {
                'use strict';
                $(function() {
                if ($("#performaneLine").length) {
                    var graphGradient = document.getElementById("performaneLine").getContext('2d');
                    var graphGradient2 = document.getElementById("performaneLine").getContext('2d');
                    var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
                    saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
                    saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
                    var saleGradientBg2 = graphGradient2.createLinearGradient(100, 0, 50, 150);
                    saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
                    saleGradientBg2.addColorStop(1, 'rgba(0, 208, 255, 0.03)');
                    var salesTopData = {
                        labels: ["JAN","jan", "FEV", "fev", "MAR","mar", "AVR", "avr", "MAI", "mai", "JUN", "jun", "JUL", "jul", "SEP", "sep", "OCT", "oct", "NOV", "nov", "DEC", "dec"],
                        datasets: [{
                            label: 'Cette année',
                            data: gainsChartData1,
                            backgroundColor: saleGradientBg,
                            borderColor: [
                                '#1F3BB3',
                            ],
                            borderWidth: 1.5,
                            fill: true, // 3: no fill
                            pointBorderWidth: 1,
                            pointRadius: [4, 4, 4, 4, 4,4, 4, 4, 4, 4,4, 4, 4],
                            pointHoverRadius: [2, 2, 2, 2, 2,2, 2, 2, 2, 2,2, 2, 2],
                            pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3','#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3','#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3','#1F3BB3)'],
                            pointBorderColor: ['#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff',],
                        },{
                        label: 'Année précédente',
                        data: gainsChartData1,
                        backgroundColor: saleGradientBg2,
                        borderColor: [
                            '#52CDFF',
                        ],
                        borderWidth: 1.5,
                        fill: true, // 3: no fill
                        pointBorderWidth: 1,
                        pointRadius: [0, 0, 0, 4, 0],
                        pointHoverRadius: [0, 0, 0, 2, 0],
                        pointBackgroundColor: ['#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF','#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF','#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF','#52CDFF)'],
                            pointBorderColor: ['#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff','#fff',],
                    }]
                    };

                    var salesTopOptions = {
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
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 4,
                                fontSize: 10,
                                color:"#6B778C"
                                }
                            }],
                            xAxes: [{
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
                            text.push('<li>');
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
                    var salesTop = new Chart(graphGradient, {
                        type: 'line',
                        data: salesTopData,
                        options: salesTopOptions
                    });
                    document.getElementById('performance-line-legend').innerHTML = salesTop.generateLegend();
                }
                if ($("#performaneLine-dark").length) {
                    var graphGradient = document.getElementById("performaneLine-dark").getContext('2d');
                    var graphGradient2 = document.getElementById("performaneLine-dark").getContext('2d');
                    var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
                    saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
                    saleGradientBg.addColorStop(1, 'rgba(34, 36, 55, 0.5)');
                    var saleGradientBg2 = graphGradient2.createLinearGradient(10, 0, 0, 150);
                    saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
                    saleGradientBg2.addColorStop(1, 'rgba(34, 36, 55, 0.2)');
                    var salesTopDataDark = {
                        labels: ["SUN","sun", "MON", "mon", "TUE","tue", "WED", "wed", "THU", "thu", "FRI", "fri", "SAT"],
                        datasets: [{
                            label: '# of Votes',
                            data: [50, 110, 60, 290, 200, 115, 130, 170, 90, 210, 240, 280, 200],
                            backgroundColor: saleGradientBg,
                            borderColor: [
                                '#1F3BB3',
                            ],
                            borderWidth: 1.5,
                            fill: true, // 3: no fill
                            pointBorderWidth: 1,
                            pointRadius: [4, 4, 4, 4, 4,4, 4, 4, 4, 4,4, 4, 4],
                            pointHoverRadius: [2, 2, 2, 2, 2,2, 2, 2, 2, 2,2, 2, 2],
                            pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3','#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3','#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3','#1F3BB3)'],
                            pointBorderColor: ['#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437',],
                        },{
                        label: '# of Votes',
                        data: [30, 150, 190, 250, 120, 150, 130, 20, 30, 15, 40, 95, 180],
                        backgroundColor: saleGradientBg2,
                        borderColor: [
                            '#52CDFF',
                        ],
                        borderWidth: 1.5,
                        fill: true, // 3: no fill
                        pointBorderWidth: 1,
                        pointRadius: [0, 0, 0, 4, 0],
                        pointHoverRadius: [0, 0, 0, 2, 0],
                        pointBackgroundColor: ['#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF','#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF','#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF','#52CDFF)'],
                            pointBorderColor: ['#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437','#222437',],
                    }]
                    };

                    var salesTopOptionsDark = {
                    responsive: true,
                    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color:"rgba(255,255,255,.05)",
                                    zeroLineColor: "rgba(255,255,255,.05)",
                                },
                                ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 4,
                                fontSize: 10,
                                color:"#6B778C"
                                }
                            }],
                            xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
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
                            text.push('<li>');
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
                    var salesTopDark = new Chart(graphGradient, {
                        type: 'line',
                        data: salesTopDataDark,
                        options: salesTopOptionsDark
                    });
                    document.getElementById('performance-line-legend-dark').innerHTML = salesTopDark.generateLegend();
                }
                if ($("#datepicker-popup").length) {
                    $('#datepicker-popup').datepicker({
                    enableOnReadonly: true,
                    todayHighlight: true,
                    });
                    $("#datepicker-popup").datepicker("setDate", "0");
                }
                if ($("#status-summary").length) {
                    var statusSummaryChartCanvas = document.getElementById("status-summary").getContext('2d');;
                    var statusData = {
                        labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI"],
                        datasets: [{
                            label: '# of Votes',
                            data: [50, 68, 70, 10, 12, 80],
                            backgroundColor: "#ffcc00",
                            borderColor: [
                                '#01B6A0',
                            ],
                            borderWidth: 2,
                            fill: false, // 3: no fill
                            pointBorderWidth: 0,
                            pointRadius: [0, 0, 0, 0, 0, 0],
                            pointHoverRadius: [0, 0, 0, 0, 0, 0],
                        }]
                    };

                    var statusOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                            display:false,
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                    color:"#F0F0F0"
                                },
                                ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 4,
                                fontSize: 10,
                                color:"#6B778C"
                                }
                            }],
                            xAxes: [{
                            display:false,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
                                fontSize: 10,
                                color:"#6B778C"
                            }
                        }],
                        },
                        legend:false,

                        elements: {
                            line: {
                                tension: 0.4,
                            }
                        },
                        tooltips: {
                            backgroundColor: 'rgba(31, 59, 179, 1)',
                        }
                    }
                    var statusSummaryChart = new Chart(statusSummaryChartCanvas, {
                        type: 'line',
                        data: statusData,
                        options: statusOptions
                    });
                }
                if ($('#totalVisitors').length) {
                    var bar = new ProgressBar.Circle(totalVisitors, {
                    color: '#fff',
                    // This has to be the same size as the maximum width to
                    // prevent clipping
                    strokeWidth: 15,
                    trailWidth: 15,
                    easing: 'easeInOut',
                    duration: 1400,
                    text: {
                        autoStyleContainer: false
                    },
                    from: {
                        color: '#52CDFF',
                        width: 15
                    },
                    to: {
                        color: '#677ae4',
                        width: 15
                    },
                    // Set default step function for all animate calls
                    step: function(state, circle) {
                        circle.path.setAttribute('stroke', state.color);
                        circle.path.setAttribute('stroke-width', state.width);

                        var value = Math.round(circle.value() * 100);
                        if (value === 0) {
                        circle.setText('');
                        } else {
                        circle.setText(value);
                        }

                    }
                    });

                    bar.text.style.fontSize = '0rem';
                    bar.animate(.64); // Number from 0.0 to 1.0
                }
                if ($('#visitperday').length) {
                    var bar = new ProgressBar.Circle(visitperday, {
                    color: '#fff',
                    // This has to be the same size as the maximum width to
                    // prevent clipping
                    strokeWidth: 15,
                    trailWidth: 15,
                    easing: 'easeInOut',
                    duration: 1400,
                    text: {
                        autoStyleContainer: false
                    },
                    from: {
                        color: '#34B1AA',
                        width: 15
                    },
                    to: {
                        color: '#677ae4',
                        width: 15
                    },
                    // Set default step function for all animate calls
                    step: function(state, circle) {
                        circle.path.setAttribute('stroke', state.color);
                        circle.path.setAttribute('stroke-width', state.width);

                        var value = Math.round(circle.value() * 100);
                        if (value === 0) {
                        circle.setText('');
                        } else {
                        circle.setText(value);
                        }

                    }
                    });

                    bar.text.style.fontSize = '0rem';
                    bar.animate(.34); // Number from 0.0 to 1.0
                }
                if ($("#marketingOverview").length) {
                    var marketingOverviewChart = document.getElementById("marketingOverview").getContext('2d');
                    var marketingOverviewData = {
                        labels: ["JAN","FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                        datasets: [{
                            label: 'Last week',
                            data: [110, 220, 200, 190, 220, 110, 210, 110, 205, 202, 201, 150],
                            backgroundColor: "#52CDFF",
                            borderColor: [
                                '#52CDFF',
                            ],
                            borderWidth: 0,
                            fill: true, // 3: no fill

                        },{
                        label: 'This week',
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
                if ($("#marketingOverview-dark").length) {
                    var marketingOverviewChartDark = document.getElementById("marketingOverview-dark").getContext('2d');
                    var marketingOverviewDataDark = {
                        labels: ["JAN","FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                        datasets: [{
                            label: 'Last week',
                            data: [110, 220, 200, 190, 220, 110, 210, 110, 205, 202, 201, 150],
                            backgroundColor: "#52CDFF",
                            borderColor: [
                                '#52CDFF',
                            ],
                            borderWidth: 0,
                            fill: true, // 3: no fill

                        },{
                        label: 'This week',
                        data: [215, 290, 210, 250, 290, 230, 290, 210, 280, 220, 190, 300],
                        backgroundColor: "#1F3BB3",
                        borderColor: [
                            '#1F3BB3',
                        ],
                        borderWidth: 0,
                        fill: true, // 3: no fill
                    }]
                    };

                    var marketingOverviewOptionsDark = {
                    responsive: true,
                    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color:"rgba(255,255,255,.05)",
                                    zeroLineColor: "rgba(255,255,255,.05)",
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
                                maxTicksLimit: 7,
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
                    var marketingOverviewDark = new Chart(marketingOverviewChartDark, {
                        type: 'bar',
                        data: marketingOverviewDataDark,
                        options: marketingOverviewOptionsDark
                    });
                    document.getElementById('marketing-overview-legend').innerHTML = marketingOverviewDark.generateLegend();
                }
                if ($("#doughnutChart").length) {
                    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
                    var doughnutPieData = {
                    datasets: [{
                        data: providersChart,
                        backgroundColor: [
                        "#FDD0C7",
                        "#81DADA"
                        ],
                        borderColor: [
                        "#FDD0C7",
                        "#81DADA"
                        ],
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Salarié',
                        'Freelance',

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
                if ($("#leaveReport").length) {
                    var leaveReportChart = document.getElementById("leaveReport").getContext('2d');
                    var leaveReportData = {
                        labels: ["Jan","Feb", "Mar", "Apr", "May"],
                        datasets: [{
                            label: 'Last week',
                            data: [18, 25, 39, 11, 24],
                            backgroundColor: "#52CDFF",
                            borderColor: [
                                '#52CDFF',
                            ],
                            borderWidth: 0,
                            fill: true, // 3: no fill

                        }]
                    };

                    var leaveReportOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color:"rgba(255,255,255,.05)",
                                    zeroLineColor: "rgba(255,255,255,.05)",
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
                            barPercentage: 0.5,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
                                fontSize: 10,
                                color:"#6B778C"
                            }
                        }],
                        },
                        legend:false,

                        elements: {
                            line: {
                                tension: 0.4,
                            }
                        },
                        tooltips: {
                            backgroundColor: 'rgba(31, 59, 179, 1)',
                        }
                    }
                    var leaveReport = new Chart(leaveReportChart, {
                        type: 'bar',
                        data: leaveReportData,
                        options: leaveReportOptions
                    });
                }
                if ($("#leaveReport-dark").length) {
                    var leaveReportChartDark = document.getElementById("leaveReport-dark").getContext('2d');
                    var leaveReportDataDark = {
                        labels: ["JAN","FEB", "MAR", "APR", "MAY"],
                        datasets: [{
                            label: 'Last week',
                            data: [18, 25, 39, 11, 24],
                            backgroundColor: "#52CDFF",
                            borderColor: [
                                '#52CDFF',
                            ],
                            borderWidth: 0,
                            fill: true, // 3: no fill

                        }]
                    };

                    var leaveReportOptionsDark = {
                    responsive: true,
                    maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color:"#383e5d",
                                    zeroLineColor: '#383e5d',
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
                            barPercentage: 0.5,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
                                fontSize: 10,
                                color:"#6B778C"
                            }
                        }],
                        },
                        legend:false,

                        elements: {
                            line: {
                                tension: 0.4,
                            }
                        },
                        tooltips: {
                            backgroundColor: 'rgba(31, 59, 179, 1)',
                        }
                    }
                    var leaveReportDark = new Chart(leaveReportChartDark, {
                        type: 'bar',
                        data: leaveReportDataDark,
                        options: leaveReportOptionsDark
                    });
                }

                });
            })(jQuery);

        }
    },
    created() {
        this.getBillings();
        this.getTotalSales();
    }
};
</script>
