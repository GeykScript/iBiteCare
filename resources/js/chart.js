import ApexCharts from 'apexcharts';

const totalPatients = document.getElementById('totalPatients');
const totalMale = document.getElementById('totalMale');
const totalFemale = document.getElementById('totalFemale');

let chartOptions = {
  chart: { type: 'bar', height: 350, toolbar: { show: false } },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '80%',
      borderRadiusApplication: 'end',
      borderRadius: 3
    }
  },
  series: [{ name: 'Loading', data: [] }],
  xaxis: { categories: [] },
  colors: ['#0ac4fdff', '#ff0a70ec'],
  noData: { text: 'Loading data...' }
};

let chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
chart.render();

// Function to attach dropdown logic
function setupDropdown(className, hiddenId, labelId) {
  document.querySelectorAll(`.${className}`).forEach(option => {
    option.addEventListener('click', e => {
      e.preventDefault();
      const value = option.getAttribute('data-value');
      const text = option.textContent;

      document.getElementById(hiddenId).value = value;
      document.getElementById(labelId).textContent = text;

      fetchChartData();
    });
  });
}

// Attach dropdowns
setupDropdown('filter-option', 'filter', 'filterLabel');
setupDropdown('service-option', 'serviceFilter', 'serviceFilterLabel');
setupDropdown('age-option', 'ageFilter', 'ageFilterLabel');

function fetchChartData() {
  const params = new URLSearchParams({
    filter: document.getElementById('filter').value,
    serviceFilter: document.getElementById('serviceFilter').value,
    ageFilter: document.getElementById('ageFilter').value
  });

  fetch(`/clinic/chart-data?${params}`)
    .then(res => res.json())
    .then(data => {
      chart.updateOptions({
        series: data.series,
        xaxis: { categories: data.categories }
      });

      totalMale.textContent = data.totalMale;
      totalFemale.textContent = data.totalFemale;
      totalPatients.textContent = data.totalPatients;
    });
}

// Initial chart load
fetchChartData();








const totalRevenue = document.getElementById('totalRevenue');
const filter2 = document.getElementById('filter2');

// Setup dropdown logic
document.querySelectorAll('.filter2-option').forEach(option => {
    option.addEventListener('click', e => {
        e.preventDefault();
        const value = option.getAttribute('data-value');
        const text = option.textContent;

        filter2.value = value;
        document.getElementById('filterLabel2').textContent = text;

        fetchRevenueData();
    });
});

// ApexCharts setup
let chartOptions2 = {
    chart: { type: 'area', height: 400, toolbar: { show: false } },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2 },
    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1, stops: [0, 90, 100] } },
    markers: { size: 4 },
    tooltip: { y: { formatter: val => '₱ ' + Number(val).toLocaleString() } },
      series: [{ name: 'Loading', data: [] }],
  xaxis: { categories: [] },
  colors: ['#0ac4fdff', '#ff0a70ec'],
  noData: { text: 'Loading data...' },
    colors: ['#ff0808ef']
};

let chart2 = new ApexCharts(document.querySelector("#revenueChart"), chartOptions2);
chart2.render();

function fetchRevenueData() {
    const params = new URLSearchParams({ filter: filter2.value });

    fetch(`/clinic/revenue-chart-data?${params.toString()}`)
        .then(res => res.json())
        .then(data => {
            chart2.updateOptions({ xaxis: { categories: data.categories } });
            chart2.updateSeries(data.series);
            totalRevenue.textContent = `₱ ${Number(data.totalRevenue).toLocaleString()}`;
        })
        .catch(err => console.error('Error fetching revenue data:', err));
}

// Initial load
fetchRevenueData();