'use strict'

import './bootstrap';

function adjustChartWidths() {
    const charts = document.querySelectorAll('svg[width="777"]');

    function setWidthHeight(chart) {
        chart.classList.add('w-full') // Set currently available width

        const width = chart.clientWidth;
        const height = width * (10 / 16);

        chart.setAttribute('height', String(height))
        chart.setAttribute('width', String(width))
    }

    if (charts) {
        charts.forEach((chart) => {
            setWidthHeight(chart)
            console.log('optimized chart widths')

            const resizeObserver = new ResizeObserver(() => {
                setWidthHeight(chart);
                console.log('optimized chart widths by resize');
            });

            resizeObserver.observe(chart);
        })
    }
}

adjustChartWidths() // Initial
setInterval(adjustChartWidths, 120000) // When livewire refreshes
