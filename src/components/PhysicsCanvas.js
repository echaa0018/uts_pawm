import React, { useEffect, useRef, useState } from 'react';
import './InteractiveComponents.css';

const PhysicsCanvas = () => {
  const canvasRef = useRef(null);
  const animationRef = useRef(null);
  const [isLaunched, setIsLaunched] = useState(false);
  const [ball, setBall] = useState({
    x: 50,
    y: 350,
    radius: 15,
    vx: 8,
    vy: -15,
    gravity: 0.5
  });

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    
    // Draw the ground and launch pad
    const drawScene = () => {
      // Sky gradient
      const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
      gradient.addColorStop(0, '#E0F2FE');
      gradient.addColorStop(1, '#F8FAFC');
      ctx.fillStyle = gradient;
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      // Ground
      ctx.fillStyle = '#10B981';
      ctx.fillRect(0, canvas.height - 30, canvas.width, 30);

      // Launch pad
      ctx.fillStyle = '#64748B';
      ctx.fillRect(30, canvas.height - 60, 40, 30);
    };

    // Draw the ball
    const drawBall = () => {
      ctx.beginPath();
      ctx.arc(ball.x, ball.y, ball.radius, 0, Math.PI * 2);
      ctx.fillStyle = '#F59E0B';
      ctx.fill();
      ctx.strokeStyle = '#D97706';
      ctx.lineWidth = 3;
      ctx.stroke();
      ctx.closePath();

      // Add highlight
      ctx.beginPath();
      ctx.arc(ball.x - 5, ball.y - 5, 5, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';
      ctx.fill();
      ctx.closePath();
    };

    // Animation loop
    const animate = () => {
      drawScene();
      drawBall();

      if (isLaunched) {
        setBall(prevBall => {
          let newBall = { ...prevBall };
          
          // Update position
          newBall.x += newBall.vx;
          newBall.y += newBall.vy;
          newBall.vy += newBall.gravity;

          // Bounce off bottom
          if (newBall.y + newBall.radius > canvas.height - 30) {
            newBall.y = canvas.height - 30 - newBall.radius;
            newBall.vy *= -0.7; // Bounce with energy loss
            newBall.vx *= 0.9; // Friction
          }

          // Bounce off walls
          if (newBall.x + newBall.radius > canvas.width || newBall.x - newBall.radius < 0) {
            newBall.vx *= -0.7;
            newBall.x = newBall.x + newBall.radius > canvas.width ? canvas.width - newBall.radius : newBall.radius;
          }

          // Stop if energy is too low
          if (Math.abs(newBall.vy) < 0.5 && newBall.y > canvas.height - 50) {
            setIsLaunched(false);
            newBall.vy = 0;
            newBall.vx = 0;
          }

          return newBall;
        });

        animationRef.current = requestAnimationFrame(animate);
      }
    };

    // Initial draw
    drawScene();
    drawBall();

    return () => {
      if (animationRef.current) {
        cancelAnimationFrame(animationRef.current);
      }
    };
  }, [ball, isLaunched]);

  const handleLaunch = () => {
    if (!isLaunched) {
      setIsLaunched(true);
      setBall(prevBall => ({
        ...prevBall,
        vx: 8,
        vy: -15
      }));
    }
  };

  const handleReset = () => {
    setIsLaunched(false);
    setBall({
      x: 50,
      y: 350,
      radius: 15,
      vx: 8,
      vy: -15,
      gravity: 0.5
    });
  };

  return (
    <div className="canvas-container">
      <h3 style={{ marginBottom: '1rem', color: 'var(--primary-blue)' }}>
        Interactive Projectile Motion Simulation
      </h3>
      <p style={{ marginBottom: '1rem', color: 'var(--text-medium)' }}>
        Watch the ball follow the laws of physics as it moves through the air. Click Launch to start the simulation.
      </p>
      <canvas 
        ref={canvasRef}
        width="700" 
        height="400" 
        role="img" 
        aria-label="Physics simulation showing projectile motion with a bouncing ball"
      />
      <div className="canvas-controls">
        <button 
          className="canvas-button" 
          onClick={handleLaunch}
          aria-label="Launch the ball"
          disabled={isLaunched}
        >
          🚀 Launch
        </button>
        <button 
          className="canvas-button reset" 
          onClick={handleReset}
          aria-label="Reset the simulation"
        >
          🔄 Reset
        </button>
      </div>
    </div>
  );
};

export default PhysicsCanvas;
