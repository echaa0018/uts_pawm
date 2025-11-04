function initMathLab() {
    const ChartLib = typeof Chart !== 'undefined' ? Chart : (typeof window.Chart !== 'undefined' ? window.Chart : null);
    
    if (!ChartLib) {
        console.error('Chart.js not loaded yet, retrying...');
        setTimeout(initMathLab, 100);
        return;
    }

    console.log('Math Lab initialized with Chart.js version:', ChartLib.version);

    let functionChart = null;
    let derivativeChart = null;
    let integralChart = null;

    window.addEventListener('updateFunctionGraph', (event) => {
        console.log('Function graph event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('functionCanvas');
        
        if (!canvas) {
            console.error('Function canvas element not found');
            return;
        }
        
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded yet');
            setTimeout(() => window.dispatchEvent(new CustomEvent('updateFunctionGraph', { detail: data })), 100);
            return;
        }
        
        const context = canvas.getContext('2d');
        
        if (functionChart) {
            functionChart.destroy();
        }
        
        try {
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            functionChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Function',
                        data: data.dataPoints,
                        borderColor: 'rgb(156, 163, 175)',
                        backgroundColor: 'rgba(156, 163, 175, 0.1)',
                        borderWidth: 3,
                        pointRadius: 0,
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
                            title: { display: true, text: 'x' }
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: 'y' }
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: `f(x) = ${getFunctionLabel(data.functionType, data.coefficients)}`
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating function chart:', error);
        }
    });

    window.addEventListener('updateDerivative', (event) => {
        console.log('Derivative event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('derivativeCanvas');
        
        if (!canvas) {
            console.error('Derivative canvas element not found');
            return;
        }
        
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded yet');
            setTimeout(() => window.dispatchEvent(new CustomEvent('updateDerivative', { detail: data })), 100);
            return;
        }
        
        const context = canvas.getContext('2d');
        
        if (derivativeChart) {
            derivativeChart.destroy();
        }
        
        try {
            const points = [];
            const range = 5;
            const step = 0.1;
            
            for (let x = data.point - range; x <= data.point + range; x += step) {
                const y = x * x;
                points.push({ x: round(x, 2), y: round(y, 4) });
            }
            
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            derivativeChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'Function',
                            data: points,
                            borderColor: 'rgb(156, 163, 175)',
                            backgroundColor: 'rgba(156, 163, 175, 0.1)',
                            borderWidth: 2,
                            pointRadius: 0,
                            tension: 0.4
                        },
                        {
                            label: 'Tangent Line',
                            data: [
                                { x: data.point - 2, y: evaluateTangent(data.point - 2, data.point, data.derivative) },
                                { x: data.point + 2, y: evaluateTangent(data.point + 2, data.point, data.derivative) }
                            ],
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            borderWidth: 2,
                            pointRadius: 0,
                            borderDash: [5, 5]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: 'x' }
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: 'y' }
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: `f'(${data.point}) = ${data.derivative}, f''(${data.point}) = ${data.secondDerivative}`
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating derivative chart:', error);
        }
    });

    window.addEventListener('updateIntegral', (event) => {
        console.log('Integral event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('integralCanvas');
        
        if (!canvas) {
            console.error('Integral canvas element not found');
            return;
        }
        
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded yet');
            setTimeout(() => window.dispatchEvent(new CustomEvent('updateIntegral', { detail: data })), 100);
            return;
        }
        
        const context = canvas.getContext('2d');
        
        if (integralChart) {
            integralChart.destroy();
        }
        
        try {
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            integralChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'Function',
                            data: data.dataPoints,
                            borderColor: 'rgb(156, 163, 175)',
                            backgroundColor: 'rgba(156, 163, 175, 0.1)',
                            borderWidth: 2,
                            pointRadius: 0,
                            tension: 0.4,
                            parsing: {
                                xAxisKey: 'x',
                                yAxisKey: 'y'
                            }
                        },
                        {
                            label: 'Area under curve',
                            data: data.dataPoints.map(p => ({ ...p, y: p.y >= 0 ? p.y : 0 })),
                            borderColor: 'rgba(156, 163, 175, 0)',
                            backgroundColor: 'rgba(156, 163, 175, 0.3)',
                            borderWidth: 0,
                            pointRadius: 0,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: 'x' },
                            min: data.lower,
                            max: data.upper
                        },
                        y: {
                            type: 'linear',
                            title: { display: true, text: 'y' },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        title: {
                            display: true,
                            text: `∫[${data.lower} to ${data.upper}] ${data.function} dx = ${data.integral}`
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating integral chart:', error);
        }
    });

    window.addEventListener('updateMatrix', (event) => {
        console.log('Matrix event received:', event.detail);
        const data = event.detail;
        const matrixDisplay = document.getElementById('matrixDisplay');
        
        if (!matrixDisplay) {
            console.error('Matrix display element not found');
            return;
        }
        
        try {
            const matrixHTML = `
                <div class="space-y-4">
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <div class="text-center">
                            <p class="text-sm font-semibold mb-2">Matrix A</p>
                            <div class="bg-base-100 p-3 rounded">
                                <div>${formatMatrix(data.matrixA)}</div>
                            </div>
                        </div>
                        <div class="text-center text-2xl font-bold">
                            ${getOperationSymbol(data.operation)}
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-semibold mb-2">Matrix B</p>
                            <div class="bg-base-100 p-3 rounded">
                                <div>${formatMatrix(data.matrixB)}</div>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-base-300 pt-4">
                        <p class="text-sm font-semibold mb-2">Result</p>
                        <div class="bg-accent/10 p-3 rounded">
                            <div>${formatMatrix(data.result)}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>Det(A) = ${data.detA}</div>
                        <div>Det(B) = ${data.detB}</div>
                    </div>
                </div>
            `;
            
            matrixDisplay.innerHTML = matrixHTML;
        } catch (error) {
            console.error('Error displaying matrix:', error);
        }
    });
}

function getFunctionLabel(type, coefficients) {
    const a = coefficients.a;
    const b = coefficients.b;
    const c = coefficients.c;
    
    switch(type) {
        case 'polynomial':
            return `${a}x² + ${b}x + ${c}`;
        case 'sin':
            return `${a}sin(x) + ${c}`;
        case 'cos':
            return `${a}cos(x) + ${c}`;
        case 'exp':
            return `${a}e^(${b}x) + ${c}`;
        case 'log':
            return `${a}ln(x) + ${c}`;
        default:
            return 'f(x)';
    }
}

function evaluateTangent(x, x0, derivative) {
    return derivative * (x - x0);
}

function formatMatrix(matrix) {
    return `
        <table class="mx-auto">
            <tr>
                <td class="px-2 py-1">${matrix[0][0]}</td>
                <td class="px-2 py-1">${matrix[0][1]}</td>
            </tr>
            <tr>
                <td class="px-2 py-1">${matrix[1][0]}</td>
                <td class="px-2 py-1">${matrix[1][1]}</td>
            </tr>
        </table>
    `;
}

function getOperationSymbol(operation) {
    switch(operation) {
        case 'add':
            return '+';
        case 'subtract':
            return '−';
        case 'multiply':
            return '×';
        default:
            return '?';
    }
}

function round(value, decimals) {
    return Number(value.toFixed(decimals));
}

function waitForChartAndInit() {
    if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
        initMathLab();
    } else {
        setTimeout(waitForChartAndInit, 100);
    }
}

if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
    initMathLab();
} else if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', waitForChartAndInit);
} else {
    waitForChartAndInit();
}
