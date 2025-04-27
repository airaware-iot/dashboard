import './bootstrap';

function adjustChartWidths() {
    const charts = document.querySelectorAll('svg[width="777"]');

    if(charts) {
        charts.forEach((chart) => chart.classList.add('w-full'))
        console.log('optimized chart widths')
    }
}

adjustChartWidths()
setInterval(adjustChartWidths, 120000)





