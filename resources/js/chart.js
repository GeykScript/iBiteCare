
import ApexCharts from 'apexcharts';


document.addEventListener('DOMContentLoaded', () => {
   const options = {
        series: [{
                name: "Income",
                color: "#26a7e2ff",
                data: ["1420", "1620", "1820", "1420", "1650", "2120"],
            },
            {
                name: "Expense",
                data: ["788", "810", "866", "788", "1100", "1200"],
                color: "#F05252",
            }
        ],
        chart: {
            sparkline: {
                enabled: false,
            },
            type: "bar",
            width: "100%",
            height: 300,
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





const getChartOptions = () => {
  return {
    series: [35.1, 23.5, 2.4, 5.4],
    colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"],
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
              label: "Unique visitors",
              fontFamily: "Inter, sans-serif",
              formatter: function (w) {
                const sum = w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
                return '$' + sum + 'k'
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
    labels: ["Direct", "Sponsor", "Affiliate", "Email marketing"],
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
            case 'desktop':
              chart.updateSeries([15.1, 22.5, 4.4, 8.4]);
              break;
            case 'tablet':
              chart.updateSeries([25.1, 26.5, 1.4, 3.4]);
              break;
            case 'mobile':
              chart.updateSeries([45.1, 27.5, 8.4, 2.4]);
              break;
            default:
              chart.updateSeries([55.1, 28.5, 1.4, 5.4]);
          }

      } else {
          chart.updateSeries([35.1, 23.5, 2.4, 5.4]);
      }
  }

  // Attach the event listener to each checkbox
  checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', (event) => handleCheckboxChange(event, chart));
  });
}
