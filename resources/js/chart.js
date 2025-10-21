
import ApexCharts from 'apexcharts';


const totalPatients = document.getElementById('totalPatients');
const totalMale = document.getElementById('totalMale');
const totalFemale = document.getElementById('totalFemale');

// Bar chart options
let chartOptions = {
    chart: {
        type: 'bar',
        height: 350,
        toolbar: {
            show: false
        }
    },
        plotOptions: {
        bar: {
            horizontal: false, 
            columnWidth: '100%' ,
              borderRadiusApplication: 'end',
          borderRadius: 3   
        }
    },
    series: [],
    xaxis: {
        categories: []
    },
    colors: ['#0ac4fdff', '#ff0a70ec']
};

let chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
chart.render();

const filter = document.getElementById('filter');
const serviceFilter = document.getElementById('serviceFilter');
const ageFilter = document.getElementById('ageFilter');

function fetchChartData() {
    const params = new URLSearchParams({
        filter: filter.value,
        serviceFilter: serviceFilter.value,
        ageFilter: ageFilter.value
    });

    fetch(`/clinic/chart-data?${params.toString()}`)
        .then(res => res.json())
        .then(data => {
            // Update chart
            chart.updateOptions({
                series: data.series,
                xaxis: {
                    categories: data.categories
                }
            });

            // Update totals
            totalMale.textContent = data.totalMale;
            totalFemale.textContent = data.totalFemale;
            totalPatients.textContent = data.totalPatients;
        });
}

// Update chart on dropdown change
filter.addEventListener('change', fetchChartData);
serviceFilter.addEventListener('change', fetchChartData);
ageFilter.addEventListener('change', fetchChartData);

// Initial load
fetchChartData();



const totalRevenue = document.getElementById('totalRevenue');
const filter2 = document.getElementById('filter2');

let chartOptions2 = {
    chart: {
        type: 'area',  // ✅ changed to area chart
        height: 380,
        toolbar: { show: false }
    },
    dataLabels: {
        enabled: false 
    },
    stroke: {
        curve: 'smooth', // smooth line
        width: 2
    },
    fill: {
        type: 'gradient', // gradient fill for area
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.4,
            opacityTo: 0.1,
            stops: [0, 90, 100]
        }
    },
    markers: {
        size: 4
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return '₱ ' + Number(val).toLocaleString();
            }
        }
    },
    series: [],
    xaxis: { categories: [] },
    colors: ['#ff0808ef']
};

let chart2 = new ApexCharts(document.querySelector("#revenueChart"), chartOptions2);
chart2.render();

function fetchRevenueData() {
    const params = new URLSearchParams({ filter: filter2.value });

    fetch(`/clinic/revenue-chart-data?${params.toString()}`)
        .then(res => res.json())
        .then(data => {
            // Update chart
            chart2.updateOptions({ xaxis: { categories: data.categories } });
            chart2.updateSeries(data.series);

            // Update total
            totalRevenue.textContent = `₱ ${Number(data.totalRevenue).toLocaleString()}`;
        })
        .catch(err => console.error('Error fetching revenue data:', err));
}

filter2.addEventListener('change', fetchRevenueData);

// Initial load
fetchRevenueData();




