function initPhysicsLab() {
    const ChartLib = typeof Chart !== 'undefined' ? Chart : (typeof window.Chart !== 'undefined' ? window.Chart : null);
    
    if (!ChartLib) {
        console.error('Chart.js not loaded yet, retrying...');
        setTimeout(initPhysicsLab, 100);
        return;
    }

    console.log('Physics Lab initialized with Chart.js version:', ChartLib.version);

    let projectileChart = null;
    let pendulumAnimation = null;
    let springAnimation = null;
    let freeFallChart = null;

    window.addEventListener('updateProjectile', (event) => {
        console.log('Projectile event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('projectileCanvas');
        
        if (!canvas) {
            console.error('Projectile canvas element not found');
            return;
        }
        
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded yet');
            setTimeout(() => window.dispatchEvent(new CustomEvent('updateProjectile', { detail: data })), 100);
            return;
        }
        
        const context = canvas.getContext('2d');
        
        if (projectileChart) {
            projectileChart.destroy();
        }
        
        try {
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            projectileChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Trajectory',
                        data: data.trajectory,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        pointRadius: 2,
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
                    animation: {
                        duration: 750
                    },
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: 'Distance (m)' }
                        },
                        y: {
                            title: { display: true, text: 'Height (m)' },
                            min: 0
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating projectile chart:', error);
        }
    });

    window.addEventListener('startPendulumAnimation', (event) => {
        console.log('Pendulum event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('pendulumCanvas');
        
        if (!canvas) {
            console.error('Pendulum canvas not found');
            return;
        }
        
        const ctx = canvas.getContext('2d');
        
        if (pendulumAnimation) {
            cancelAnimationFrame(pendulumAnimation);
        }

        const centerX = canvas.width / 2;
        const centerY = 50;
        const length = data.length * 80;
        const maxAngle = data.angle * Math.PI / 180;
        const damping = data.damping || 0;
        const dampedOmega = data.dampedOmega || data.omega;
        let time = 0;
        const maxTime = damping > 0 ? 30 : 60;

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const dampingFactor = Math.exp(-damping * time);
            const currentAngle = maxAngle * dampingFactor * Math.cos(dampedOmega * time);
            
            const bobX = centerX + length * Math.sin(currentAngle);
            const bobY = centerY + length * Math.cos(currentAngle);
            
            ctx.fillStyle = '#333';
            ctx.fillRect(centerX - 5, centerY - 5, 10, 10);
            
            ctx.strokeStyle = '#666';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.lineTo(bobX, bobY);
            ctx.stroke();
            
            const energyFactor = dampingFactor;
            ctx.fillStyle = `rgba(59, 130, 246, ${0.3 + 0.7 * energyFactor})`;
            ctx.beginPath();
            ctx.arc(bobX, bobY, 15, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.strokeStyle = '#2563eb';
            ctx.lineWidth = 2;
            ctx.stroke();
            
            time += 0.02;
            
            if (time < maxTime && (dampingFactor > 0.01 || damping === 0)) {
                pendulumAnimation = requestAnimationFrame(animate);
            }
        }
        
        animate();
    });

    window.addEventListener('startSpringAnimation', (event) => {
        console.log('Spring event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('springCanvas');
        
        if (!canvas) {
            console.error('Spring canvas not found');
            return;
        }
        
        const ctx = canvas.getContext('2d');
        
        if (springAnimation) {
            cancelAnimationFrame(springAnimation);
        }

        const centerX = canvas.width / 2;
        const equilibriumY = canvas.height / 2;
        const amplitude = data.displacement * 100;
        const damping = data.damping || 0;
        const dampedOmega = data.dampedOmega || data.omega;
        let time = 0;
        const maxTime = damping > 0 ? 30 : 60;

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const dampingFactor = Math.exp(-(damping / (2 * data.mass)) * time);
            const displacement = amplitude * dampingFactor * Math.cos(dampedOmega * time);
            const currentY = equilibriumY + displacement;
            
            ctx.fillStyle = '#333';
            ctx.fillRect(0, 50, canvas.width, 10);
            
            ctx.strokeStyle = '#666';
            ctx.lineWidth = 2;
            ctx.beginPath();
            const springCoils = 15;
            const springWidth = 30;
            for (let i = 0; i <= springCoils; i++) {
                const y = 60 + (currentY - 60 - 30) * (i / springCoils);
                const x = centerX + (i % 2 === 0 ? -springWidth : springWidth);
                if (i === 0) {
                    ctx.moveTo(centerX, 60);
                } else {
                    ctx.lineTo(x, y);
                }
            }
            ctx.lineTo(centerX, currentY - 30);
            ctx.stroke();
            
            const energyFactor = dampingFactor;
            ctx.fillStyle = `rgba(59, 130, 246, ${0.3 + 0.7 * energyFactor})`;
            ctx.fillRect(centerX - 30, currentY - 30, 60, 60);
            
            ctx.strokeStyle = '#2563eb';
            ctx.lineWidth = 2;
            ctx.strokeRect(centerX - 30, currentY - 30, 60, 60);
            
            ctx.fillStyle = '#fff';
            ctx.font = '14px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(data.mass + ' kg', centerX, currentY + 5);
            
            ctx.strokeStyle = '#ef4444';
            ctx.setLineDash([5, 5]);
            ctx.beginPath();
            ctx.moveTo(centerX - 60, equilibriumY);
            ctx.lineTo(centerX + 60, equilibriumY);
            ctx.stroke();
            ctx.setLineDash([]);
            
            time += 0.02;
            
            if (time < maxTime && (dampingFactor > 0.01 || damping === 0)) {
                springAnimation = requestAnimationFrame(animate);
            }
        }
        
        animate();
    });

    window.addEventListener('updateFreeFall', (event) => {
        console.log('FreeFall event received:', event.detail);
        const data = event.detail;
        const canvas = document.getElementById('freeFallCanvas');
        
        if (!canvas) {
            console.error('FreeFall canvas not found');
            return;
        }
        
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded yet');
            setTimeout(() => window.dispatchEvent(new CustomEvent('updateFreeFall', { detail: data })), 100);
            return;
        }
        
        const context = canvas.getContext('2d');
        
        if (freeFallChart) {
            freeFallChart.destroy();
        }
        
        try {
            const ChartLib = typeof Chart !== 'undefined' ? Chart : window.Chart;
            freeFallChart = new ChartLib(context, {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'Height (m)',
                            data: data.trajectory.map(p => ({ x: p.t, y: p.y })),
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            yAxisID: 'y',
                            parsing: {
                                xAxisKey: 'x',
                                yAxisKey: 'y'
                            }
                        },
                        {
                            label: 'Velocity (m/s)',
                            data: data.trajectory.map(p => ({ x: p.t, y: p.v })),
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            borderWidth: 2,
                            yAxisID: 'y1',
                            parsing: {
                                xAxisKey: 'x',
                                yAxisKey: 'y'
                            }
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        x: {
                            type: 'linear',
                            title: { display: true, text: 'Time (s)' }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: { display: true, text: 'Height (m)' }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: { display: true, text: 'Velocity (m/s)' },
                            grid: {
                                drawOnChartArea: false,
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating freefall chart:', error);
        }
    });
}

function waitForChartAndInit() {
    if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
        initPhysicsLab();
    } else {
        setTimeout(waitForChartAndInit, 100);
    }
}

if (typeof Chart !== 'undefined' || typeof window.Chart !== 'undefined') {
    initPhysicsLab();
} else if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', waitForChartAndInit);
} else {
    waitForChartAndInit();
}
