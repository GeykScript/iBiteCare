
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
            columnWidth: '100%' 
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





// line charts
const LineChartoptions = {
// add data series via arrays, learn more here: https://apexcharts.com/docs/series/
series: [
  {
    name: "Male",
    data: [1500, 1418, 1456, 1526, 1356, 1256],
    color: "#1A56DB",
  },
  {
    name: "Female",
    data: [643, 413, 765, 412, 1423, 1731],
    color: "#fa1fd5ff",
  },
],
chart: {
  height: "85%",
  maxWidth: "100%",
  type: "area",
  fontFamily: "Inter, sans-serif",
  dropShadow: {
    enabled: false,
  },
  toolbar: {
    show: false,
  },
},
tooltip: {
  enabled: true,
  x: {
    show: false,
  },
},
legend: {
  show: true
},
fill: {
  type: "gradient",
  gradient: {
    opacityFrom: 1,
    opacityTo: 0,
    shade: "#1C64F2",
    gradientToColors: ["#1C64F2"],
  },
},
dataLabels: {
  enabled: false,
},
stroke: {
  width: 6,
},
grid: {
  show: false,
  strokeDashArray: 4,
  padding: {
    left: 2,
    right: 2,
    top: -26
  },
},
xaxis: {
  categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
  labels: {
    show: false,
  },
  axisBorder: {
    show: false,
  },
  axisTicks: {
    show: false,
  },
},
yaxis: {
  show: false,
  labels: {
    formatter: function (value) {
      return value;
    }
  }
},
}

if (document.getElementById("legend-chart") && typeof ApexCharts !== 'undefined') {
const chart = new ApexCharts(document.getElementById("legend-chart"), LineChartoptions);
chart.render();
}




const getChartOptionsPie = () => {
  return {
    series: [45.9, 23.3, 17.7,13.0],
    colors: ["#FF0000", "#FF4D4D", "#FF8080", "#FFB3B3"],
    chart: {
      height: 260,
      width: "100%",
      type: "pie",
    },
    stroke: {
      colors: ["white"],
      lineCap: "",
    },
    plotOptions: {
      pie: {
        labels: {
          show: true,
        },
        size: "100%",
        dataLabels: {
          offset: -25
        }
      },
    },
    labels: ["Child(0-12)", "Teenager(13-19)", "Adult(20-59)", "Senior(60+)"],
    dataLabels: {
      enabled: true,
      style: {
        fontFamily: "Inter, sans-serif",
      },
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return value + "%"
        },
      },
    },
    xaxis: {
      labels: {
        formatter: function (value) {
          return value  + "%"
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
  }
}

if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptionsPie());
  chart.render();
}
//---------------------------------------------REPORTS CHARTS---------------------------------------------



const ColumnChartoptions = {
  colors: ["#bce91cff"],
  series: [
    {
      name: "Sales",
      color: "#1ac3daef",
      data: [
        { x: "Jan", y: 231 },
        { x: "Feb", y: 122 },
        { x: "Mar", y: 63 },
        { x: "Apr", y: 421 },
        { x: "May", y: 122 },
        { x: "Jun", y: 323 },

      ],
    },
  ],
  chart: {
    type: "bar",
    height: "420px",
    fontFamily: "Inter, sans-serif",
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "80%",
      borderRadiusApplication: "end",
      borderRadius: 8,
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: {
      fontFamily: "Inter, sans-serif",
    },
  },
  states: {
    hover: {
      filter: {
        type: "darken",
        value: 1,
      },
    },
  },
  stroke: {
    show: true,
    width: 0,
    colors: ["transparent"],
  },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -14
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    floating: false,
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
  fill: {
    opacity: 1,
  },
}

if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("column-chart"), ColumnChartoptions);
  chart.render();
}


