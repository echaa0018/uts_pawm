// Physics Lab - Chart.js Visualizations
// This file is loaded directly (not through Vite) to ensure it's available in production

// Wait for Chart.js to be loaded from CDN
function initPhysicsLab() {
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded yet, retrying...');
        setTimeout(initPhysicsLab, 100);
        return;
    }

    console.log('Physics Lab initialized with Chart.js version:', Chart.version);

    let projectileChart = null;
    let pendulumAnimation = null;
    let springAnimation = null;
    let freeFallChart = null;

    // Projectile Motion Visualization
    window.addEventListener('updateProjectile', (event) => {
        console.log('Projectile event received:', event.detail);
        const data = event.detail;
        const ctx = document.getElementById('projectileCanvas');
        
        if (!ctx) {
            console.error('Projectile canvas element not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        if (projectileChart) {
            projectileChart.destroy();
        }
        
        try {
            projectileChart = new Chart(context, {
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

            document.getElementById('projectileResults').classList.remove('hidden');
            document.getElementById('maxHeight').textContent = data.maxHeight;
            document.getElementById('range').textContent = data.range;
            document.getElementById('timeOfFlight').textContent = data.timeOfFlight;
        } catch (error) {
            console.error('Error creating projectile chart:', error);
        }
    });

    // Pendulum Animation
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
            
            // Calculate current angle with damping
            const dampingFactor = Math.exp(-damping * time);
            const currentAngle = maxAngle * dampingFactor * Math.cos(dampedOmega * time);
            
            // Calculate bob position
            const bobX = centerX + length * Math.sin(currentAngle);
            const bobY = centerY + length * Math.cos(currentAngle);
            
            // Draw pivot
            ctx.fillStyle = '#333';
            ctx.fillRect(centerX - 5, centerY - 5, 10, 10);
            
            // Draw string
            ctx.strokeStyle = '#666';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.lineTo(bobX, bobY);
            ctx.stroke();
            
            // Draw bob with opacity based on energy
            const energyFactor = dampingFactor;
            ctx.fillStyle = `rgba(59, 130, 246, ${0.3 + 0.7 * energyFactor})`;
            ctx.beginPath();
            ctx.arc(bobX, bobY, 15, 0, Math.PI * 2);
            ctx.fill();
            
            // Draw bob outline
            ctx.strokeStyle = '#2563eb';
            ctx.lineWidth = 2;
            ctx.stroke();
            
            time += 0.02;
            
            if (time < maxTime && (dampingFactor > 0.01 || damping === 0)) {
                pendulumAnimation = requestAnimationFrame(animate);
            }
        }
        
        animate();
        
        document.getElementById('pendulumResults').classList.remove('hidden');
        document.getElementById('pendulumPeriod').textContent = data.period;
        document.getElementById('pendulumFrequency').textContent = data.frequency;
    });

    // Spring-Mass Animation
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
            
            // Calculate current position with damping
            const dampingFactor = Math.exp(-(damping / (2 * data.mass)) * time);
            const displacement = amplitude * dampingFactor * Math.cos(dampedOmega * time);
            const currentY = equilibriumY + displacement;
            
            // Draw ceiling
            ctx.fillStyle = '#333';
            ctx.fillRect(0, 50, canvas.width, 10);
            
            // Draw spring
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
            
            // Draw mass with opacity based on energy
            const energyFactor = dampingFactor;
            ctx.fillStyle = `rgba(59, 130, 246, ${0.3 + 0.7 * energyFactor})`;
            ctx.fillRect(centerX - 30, currentY - 30, 60, 60);
            
            // Draw mass outline
            ctx.strokeStyle = '#2563eb';
            ctx.lineWidth = 2;
            ctx.strokeRect(centerX - 30, currentY - 30, 60, 60);
            
            // Draw mass label
            ctx.fillStyle = '#fff';
            ctx.font = '14px Arial';
            ctx.textAlign = 'center';
            ctx.fillText(data.mass + ' kg', centerX, currentY + 5);
            
            // Draw equilibrium line
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
        
        document.getElementById('springResults').classList.remove('hidden');
        document.getElementById('springPeriod').textContent = data.period;
        document.getElementById('springFrequency').textContent = data.frequency;
    });

    // Free Fall Visualization
    window.addEventListener('updateFreeFall', (event) => {
        console.log('FreeFall event received:', event.detail);
        const data = event.detail;
        const ctx = document.getElementById('freeFallCanvas');
        
        if (!ctx) {
            console.error('FreeFall canvas not found');
            return;
        }
        
        const context = ctx.getContext('2d');
        
        if (freeFallChart) {
            freeFallChart.destroy();
        }
        
        try {
            freeFallChart = new Chart(context, {
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

            document.getElementById('freeFallResults').classList.remove('hidden');
            document.getElementById('timeToFall').textContent = data.timeToFall;
            document.getElementById('finalVelocity').textContent = data.finalVelocity;
        } catch (error) {
            console.error('Error creating freefall chart:', error);
        }
    });
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPhysicsLab);
} else {
    initPhysicsLab();
}
