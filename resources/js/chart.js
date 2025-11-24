import ApexCharts from 'apexcharts';


document.addEventListener("DOMContentLoaded", () => {
  const chartContainer = document.querySelector("#chart");
  const filter = document.getElementById("filter");
  const serviceFilter = document.getElementById("serviceFilter");
  const ageFilter = document.getElementById("ageFilter");

  // Only run if chart section exists
  if (chartContainer && filter && serviceFilter && ageFilter) {
    const totalPatients = document.getElementById('totalPatients');
    const totalMale = document.getElementById('totalMale');
    const totalFemale = document.getElementById('totalFemale');
    // const uniquePatients = document.getElementById('uniquePatients');


    let chartOptions = {
      chart: { type: 'bar', height: 350, toolbar: { show: false } },
      plotOptions: {
        bar: { horizontal: false, columnWidth: '80%', borderRadiusApplication: 'end', borderRadius: 3 }
      },
      series: [{ name: 'Loading', data: [] }],
      xaxis: { categories: [] },
      colors: ['#0ac4fdff', '#ff0a70ec'],
      noData: { text: 'Loading data...' }
    };

    let chart = new ApexCharts(chartContainer, chartOptions);
    chart.render();

    // Setup dropdowns
    function setupDropdown(className, hiddenId, labelId) {
      document.querySelectorAll(`.${className}`).forEach(option => {
        option.addEventListener('click', e => {
          e.preventDefault();
          const value = option.getAttribute('data-value');
          const text = option.textContent;
          const hidden = document.getElementById(hiddenId);
          const label = document.getElementById(labelId);
          if (!hidden || !label) return;

          hidden.value = value;
          label.textContent = text;
          fetchChartData();
        });
      });
    }

    setupDropdown('filter-option', 'filter', 'filterLabel');
    setupDropdown('service-option', 'serviceFilter', 'serviceFilterLabel');
    setupDropdown('age-option', 'ageFilter', 'ageFilterLabel');

    function fetchChartData() {
      if (!filter || !serviceFilter || !ageFilter) return;
      const params = new URLSearchParams({
        filter: filter.value,
        serviceFilter: serviceFilter.value,
        ageFilter: ageFilter.value
        
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
          // uniquePatients.textContent = data.uniquePatients;
        })
        .catch(err => console.error("Fetch error:", err));
    }

    fetchChartData();
  }
});





document.addEventListener("DOMContentLoaded", function () {
  const revenueChartEl = document.querySelector("#revenueChart");
  const filter2 = document.getElementById("filter2");
  const totalRevenue = document.getElementById("totalRevenue");

  // ✅ Only initialize if we're on the Reports page
  if (revenueChartEl && filter2 && totalRevenue) {

    let chartOptions2 = {
      chart: { type: 'area', height: 400, toolbar: { show: false } },
      noData: { text: 'Loading revenue data...' },
      dataLabels: { enabled: false },
      stroke: { curve: 'smooth', width: 2 },
      fill: { 
        type: 'gradient', 
        gradient: { 
          shadeIntensity: 1, 
          opacityFrom: 0.4, 
          opacityTo: 0.1, 
          stops: [0, 90, 100] 
        } 
      },
      markers: { size: 4 },
      tooltip: { y: { formatter: val => '₱ ' + Number(val).toLocaleString() } },
      series: [],
      xaxis: { categories: [] },
      colors: ['#ff0808ef']
    };

    let chart2 = new ApexCharts(revenueChartEl, chartOptions2);
    chart2.render();

    function fetchRevenueData() {
      const params = new URLSearchParams({ filter: filter2.value });

      chart2.updateOptions({
        series: [],
        xaxis: { categories: [] },
        noData: { text: 'Loading revenue data...' }
      });

      fetch(`/clinic/revenue-chart-data?${params.toString()}`)
        .then(res => res.json())
        .then(data => {
          chart2.updateOptions({ 
            xaxis: { categories: data.categories },
            noData: { text: '' }
          });
          chart2.updateSeries(data.series);
          totalRevenue.textContent = `₱ ${Number(data.totalRevenue).toLocaleString()}`;
        })
        .catch(err => {
          console.error('Error fetching revenue data:', err);
          chart2.updateOptions({
            series: [],
            noData: { text: 'Failed to load data' }
          });
        });
    }

    // Dropdown logic
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

    // Initial load
    fetchRevenueData();
  }
});
