function initChemistryLab() {
    const ChartLib = typeof Chart !== 'undefined' ? Chart : (typeof window.Chart !== 'undefined' ? window.Chart : null);
    
    if (!ChartLib) {
        console.error('Chart.js not loaded yet, retrying...');
        setTimeout(initChemistryLab, 100);
        return;
    }

    console.log('Chemistry Lab initialized with Chart.js version:', ChartLib.version);

    let molarityChart = null;
    let phChart = null;
    let stoichiometryChart = null;
    let gasLawChart = null;

    window.addEventListener('updateMolarity', (event) => {
        console.log('Molarity event received:', event.detail);
        const data = event.detail;
        const ctx = document.getElementById('molarityCanvas');
        
        if (!ctx) {
            console.error('Molarity canvas element not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        if (molarityChart) {
            molarityChart.destroy();
        }
        
        try {
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            molarityChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Molarity vs Volume',
                        data: data.concentrations,
                        borderColor: 'rgb(251, 146, 60)',
                        backgroundColor: 'rgba(251, 146, 60, 0.1)',
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        parsing: {
                            xAxisKey: 'x',
                            yAxisKey: 'y'
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: 'Volume (L)' }
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: 'Molarity (M)' },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: `Molarity = ${data.molarity} M (from ${data.moles} mol in ${data.volume} L)`
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating molarity chart:', error);
        }
    });

    window.addEventListener('updatepH', (event) => {
        console.log('pH event received:', event.detail);
        const data = event.detail;
        const ctx = document.getElementById('phCanvas');
        
        if (!ctx) {
            console.error('pH canvas element not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        if (phChart) {
            phChart.destroy();
        }
        
        try {
            const phScale = [];
            for (let i = 0; i <= 14; i++) {
                phScale.push({ x: i, y: i });
            }
            
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            phChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'pH Scale',
                            data: phScale,
                            borderColor: 'rgb(147, 197, 253)',
                            backgroundColor: 'rgba(147, 197, 253, 0.1)',
                            borderWidth: 2,
                            pointRadius: 0,
                            parsing: {
                                xAxisKey: 'x',
                                yAxisKey: 'y'
                            }
                        },
                        {
                            label: 'pH Curve',
                            data: data.pHCurve,
                            borderColor: 'rgb(251, 146, 60)',
                            backgroundColor: 'rgba(251, 146, 60, 0.1)',
                            borderWidth: 3,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.4,
                            parsing: {
                                xAxisKey: 'x',
                                yAxisKey: 'y'
                            }
                        },
                        {
                            label: 'Current pH',
                            data: [{ x: -Math.log10(data.concentration), y: data.pH }],
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgb(239, 68, 68)',
                            borderWidth: 0,
                            pointRadius: 8,
                            pointHoverRadius: 10
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: '-log₁₀[Concentration]' }
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: 'pH' },
                            min: 0,
                            max: 14
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: `pH = ${data.pH}, pOH = ${data.pOH} (${data.type})`
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating pH chart:', error);
        }
    });

    window.addEventListener('updateStoichiometry', (event) => {
        console.log('Stoichiometry event received:', event.detail);
        const data = event.detail;
        const ctx = document.getElementById('stoichiometryCanvas');
        
        if (!ctx) {
            console.error('Stoichiometry canvas element not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        if (stoichiometryChart) {
            stoichiometryChart.destroy();
        }
        
        try {
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            stoichiometryChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: data.reactant1 + ' (Reactant 1)',
                            data: data.reactionProgress.map(p => ({ x: p.x, y: p.reactant1 })),
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            borderWidth: 2,
                            pointRadius: 2,
                            tension: 0.4
                        },
                        {
                            label: data.reactant2 + ' (Reactant 2)',
                            data: data.reactionProgress.map(p => ({ x: p.x, y: p.reactant2 })),
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            pointRadius: 2,
                            tension: 0.4
                        },
                        {
                            label: data.product + ' (Product)',
                            data: data.reactionProgress.map(p => ({ x: p.x, y: p.product })),
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            borderWidth: 3,
                            pointRadius: 3,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: 'Reaction Progress (%)' },
                            min: 0,
                            max: 100
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: 'Moles (mol)' },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: `${data.reactant1} + ${data.reactant2} → ${data.product} (Limiting: ${data.limitingReactant})`
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating stoichiometry chart:', error);
        }
    });

    window.addEventListener('updateGasLaw', (event) => {
        console.log('Gas Law event received:', event.detail);
        const data = event.detail;
        const ctx = document.getElementById('gasLawCanvas');
        
        if (!ctx) {
            console.error('Gas Law canvas element not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        if (gasLawChart) {
            gasLawChart.destroy();
        }
        
        try {
            let xLabel = '';
            let yLabel = '';
            let title = '';
            
            switch(data.type) {
                case 'ideal':
                    xLabel = 'Temperature (K)';
                    yLabel = 'Pressure (atm)';
                    title = `PV = nRT (P vs T at V = ${data.volume} L, n = ${data.moles} mol)`;
                    break;
                case 'boyle':
                    xLabel = 'Volume (L)';
                    yLabel = 'Pressure (atm)';
                    title = `Boyle's Law: P₁V₁ = P₂V₂ (P vs V at constant T)`;
                    break;
                case 'charles':
                    xLabel = 'Temperature (K)';
                    yLabel = 'Volume (L)';
                    title = `Charles' Law: V₁/T₁ = V₂/T₂ (V vs T at constant P)`;
                    break;
            }
            
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            gasLawChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [{
                        label: data.type === 'ideal' ? 'Ideal Gas Law' : (data.type === 'boyle' ? 'Boyle\'s Law' : 'Charles\' Law'),
                        data: data.dataPoints,
                        borderColor: 'rgb(251, 146, 60)',
                        backgroundColor: 'rgba(251, 146, 60, 0.1)',
                        borderWidth: 3,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        tension: 0.4,
                        parsing: {
                            xAxisKey: 'x',
                            yAxisKey: 'y'
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: xLabel }
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: yLabel },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: title
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating gas law chart:', error);
        }
    });
}

function waitForChartAndInit() {
    if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
        initChemistryLab();
    } else {
        setTimeout(waitForChartAndInit, 100);
    }
}

if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
    initChemistryLab();
} else if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', waitForChartAndInit);
} else {
    waitForChartAndInit();
}
