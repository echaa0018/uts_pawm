import './bootstrap';
import Chart from 'chart.js/auto';

// Make Chart.js available globally
window.Chart = Chart;

// Verify Chart.js loaded
console.log('app.js loaded, Chart.js version:', Chart.version);
console.log('window.Chart available:', typeof window.Chart !== 'undefined');