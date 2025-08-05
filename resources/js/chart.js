
import ApexCharts from 'apexcharts';


// Bar chart options
document.addEventListener('DOMContentLoaded', () => {
   const options = {
        series: [{
                name: "Income",
                color: "#31b852ff",
                data: ["1420", "1620", "1820", "1420", "1650", "2120"],
            },
            {
                name: "Expense",
                data: ["788", "810", "866", "788", "1100", "1200"],
                color: "#ec2f2fff",
            }
        ],
        chart: {
            sparkline: {
                enabled: false,
            },
            type: "bar",
            width: "100%",
            height: 480,
            toolbar: {
                show: false,
            }
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {
            bar: {
                horizontal: true,
                columnWidth: "100%",
                borderRadiusApplication: "end",
                borderRadius: 6,
                dataLabels: {
                    position: "top",
                },
            },
        },
        legend: {
            show: true,
            position: "bottom",
        },
        dataLabels: {
            enabled: false,
        },
        tooltip: {
            shared: true,
            intersect: false,
            formatter: function(value) {
                return "₱ " + value
            }
        },
        xaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function(value) {
                    return "₱ " + value
                }
            },
            categories: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            }
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -20
            },
        },
        fill: {
            opacity: 1,
        }
    }

    if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("bar-chart"), options);
        chart.render();
    }
});



// Function to get chart options for the donut chart

const getChartOptions = () => {
  return {
    series: [35.1, 20.5, 5.4],
    colors: ["#21c5bdff", "#FF0303", "#2b8be4ff"],
    chart: {
      height: 250,
      width: "100%",
      type: "donut",
    },
    stroke: {
      colors: ["transparent"],
      lineCap: "",
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            name: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: 20,
            },
            total: {
              showAlways: true,
              show: true,
              label: "Total Patients ",
              fontFamily: "Inter, sans-serif",
              formatter: function (w) {
                const sum = w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
                return '₱ ' + sum + 'k'
              },
            },
            value: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: -20,
              formatter: function (value) {
                return value + "k"
              },
            },
          },
          size: "75%",
        },
      },
    },
    grid: {
      padding: {
        top: 0,
      },
    },
    labels: ["Anti Rabies", "Booster", "Tetanus Toxiod"],
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return value + "k"
        },
      },
    },
    xaxis: {
      labels: {
        formatter: function (value) {
          return value  + "k"
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

if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
  chart.render();

  // Get all the checkboxes by their class name
  const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');

  // Function to handle the checkbox change event
  function handleCheckboxChange(event, chart) {
      const checkbox = event.target;
      if (checkbox.checked) {
          switch(checkbox.value) {
            case 'anti-rabies':
              chart.updateSeries([15.1, 22.5, 4.4]);
              break;
            case 'booster':
              chart.updateSeries([25.1, 26.5, 1.4]);
              break;
            case 'tetanus':
              chart.updateSeries([45.1, 27.5, 8.4]);
              break;
            default:
              chart.updateSeries([55.1, 28.5, 1.4]);
          }

      } else {
          chart.updateSeries([35.1, 23.5, 2.4]);
      }
  }

  // Attach the event listener to each checkbox
  checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', (event) => handleCheckboxChange(event, chart));
  });
}



// line charts

const options = {
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
  height: "65%",
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
const chart = new ApexCharts(document.getElementById("legend-chart"), options);
chart.render();
}




const getChartOptionsPie = () => {
  return {
    series: [45.9, 23.3, 17.7,13.0],
    colors: ["#FF0000", "#FF4D4D", "#FF8080", "#FFB3B3"],
    chart: {
      height: 280,
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
