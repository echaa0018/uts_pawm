// ============================
// PERFORMANCE & ACCESSIBILITY UTILITIES
// ============================
const debounce = (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

const throttle = (func, limit) => {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
};

// ============================
// LOADING STATE MANAGEMENT
// ============================
const LoadingManager = {
    show(element) {
        if (element) {
            element.classList.add('loading');
        }
    },
    
    hide(element) {
        if (element) {
            element.classList.remove('loading');
        }
    },
    
    showSpinner(container) {
        const spinner = document.createElement('div');
        spinner.className = 'spinner';
        spinner.setAttribute('aria-label', 'Loading content');
        container.appendChild(spinner);
        return spinner;
    },
    
    hideSpinner(spinner) {
        if (spinner && spinner.parentNode) {
            spinner.parentNode.removeChild(spinner);
        }
    }
};

// ============================
// ACCESSIBILITY HELPERS
// ============================
const AccessibilityManager = {
    announce(message) {
        const announcement = document.createElement('div');
        announcement.setAttribute('aria-live', 'polite');
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'sr-only';
        announcement.textContent = message;
        document.body.appendChild(announcement);
        
        setTimeout(() => {
            document.body.removeChild(announcement);
        }, 1000);
    },
    
    trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        element.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    if (document.activeElement === firstElement) {
                        lastElement.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastElement) {
                        firstElement.focus();
                        e.preventDefault();
                    }
                }
            }
        });
    },
    
    updateAriaHidden(element, isHidden) {
        element.setAttribute('aria-hidden', isHidden);
    }
};
const courses = [
    {
        id: 'physics',
        title: 'Physics',
        icon: '⚛️',
        description: 'Explore the fundamental laws of nature, from motion to energy.',
        fullDescription: 'Dive into the fascinating world of physics! Learn about mechanics, thermodynamics, electromagnetism, and more. Watch our interactive projectile motion simulation below.'
    },
    {
        id: 'mathematics',
        title: 'Mathematics',
        icon: '📐',
        description: 'Master the language of numbers, patterns, and logical reasoning.',
        fullDescription: 'Mathematics is the foundation of science and technology. From algebra to calculus, develop your analytical thinking and problem-solving skills.'
    },
    {
        id: 'chemistry',
        title: 'Chemistry',
        icon: '🧪',
        description: 'Discover the composition, properties, and reactions of matter.',
        fullDescription: 'Chemistry bridges physics and biology. Learn about atoms, molecules, chemical reactions, and the periodic table. Understand the world at a molecular level.'
    },
    {
        id: 'computing',
        title: 'Thinking Computationally',
        icon: '💻',
        description: 'Develop problem-solving skills through computational thinking.',
        fullDescription: 'Learn to think like a computer scientist! Master algorithms, data structures, and logical thinking. Try our interactive drag-and-drop quiz below to test your knowledge.'
    },
    {
        id: 'digital-ai',
        title: 'Digital and AI Literacy',
        icon: '🤖',
        description: 'Navigate the digital world and understand artificial intelligence.',
        fullDescription: 'In our AI-driven world, digital literacy is essential. Learn about machine learning, data privacy, digital citizenship, and the ethical implications of technology.'
    },
    {
        id: 'sports',
        title: 'Sports',
        icon: '⚽',
        description: 'Build physical fitness, teamwork, and sportsmanship.',
        fullDescription: 'Physical education is crucial for holistic development. Engage in various sports, learn about nutrition, fitness, and the importance of an active lifestyle.'
    },
    {
        id: 'pancasila',
        title: 'Pancasila',
        icon: '🇮🇩',
        description: 'Understand Indonesia\'s philosophical foundation and values.',
        fullDescription: 'Pancasila is the ideological foundation of Indonesia. Learn about its five principles: belief in God, humanitarianism, national unity, democracy, and social justice.'
    },
    {
        id: 'bahasa',
        title: 'Bahasa Indonesia',
        icon: '📚',
        description: 'Master the Indonesian language and its rich literature.',
        fullDescription: 'Bahasa Indonesia is the unifying language of the archipelago. Develop your reading, writing, and communication skills while exploring Indonesian literature and culture.'
    },
    {
        id: 'english',
        title: 'English',
        icon: '🌍',
        description: 'Achieve fluency in the global language of communication.',
        fullDescription: 'English opens doors to global opportunities. Improve your grammar, vocabulary, speaking, and writing skills. Engage with international literature and media.'
    }
];

// ============================
// VIEW MANAGEMENT
// ============================
const homeView = document.getElementById('homeView');
const detailView = document.getElementById('courseDetailView');
const detailTitle = document.getElementById('detailTitle');
const detailContent = document.getElementById('detailContent');
const interactiveContent = document.getElementById('interactiveContent');
const backButton = document.getElementById('backButton');
const courseGrid = document.getElementById('courseGrid');

// Function to show home view
function showHomeView() {
    LoadingManager.show(homeView);
    
    setTimeout(() => {
        homeView.classList.remove('hidden');
        detailView.classList.remove('active');
        AccessibilityManager.updateAriaHidden(homeView, false);
        AccessibilityManager.updateAriaHidden(detailView, true);
        
        // Update navigation aria-current
        document.querySelectorAll('[role="menuitem"]').forEach(item => {
            item.removeAttribute('aria-current');
        });
        document.getElementById('navHome').setAttribute('aria-current', 'page');
        
        LoadingManager.hide(homeView);
        AccessibilityManager.announce('Returned to course selection');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 150);
}

// Function to show course detail view
function showCourseDetail(course) {
    LoadingManager.show(detailView);
    const spinner = LoadingManager.showSpinner(interactiveContent);
    
    setTimeout(() => {
        homeView.classList.add('hidden');
        detailView.classList.add('active');
        AccessibilityManager.updateAriaHidden(homeView, true);
        AccessibilityManager.updateAriaHidden(detailView, false);
        
        // Update navigation aria-current
        document.querySelectorAll('[role="menuitem"]').forEach(item => {
            item.removeAttribute('aria-current');
        });
        
        detailTitle.textContent = course.icon + ' ' + course.title;
        detailContent.textContent = course.fullDescription;
        
        // Clear previous interactive content
        interactiveContent.innerHTML = '';
        
        // Add interactive content based on course
        if (course.id === 'physics') {
            createPhysicsCanvas();
        } else if (course.id === 'computing') {
            createDragDropQuiz();
        }
        
        LoadingManager.hide(detailView);
        LoadingManager.hideSpinner(spinner);
        AccessibilityManager.announce(`Now viewing ${course.title} course details`);
        AccessibilityManager.trapFocus(detailView);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 200);
}

// ============================
// GENERATE COURSE CARDS
// ============================
function generateCourseCards() {
    courseGrid.innerHTML = '';
    courses.forEach((course, index) => {
        const card = document.createElement('article');
        card.className = 'course-card';
        card.setAttribute('role', 'gridcell');
        card.setAttribute('aria-label', `${course.title} course: ${course.description}`);
        card.setAttribute('tabindex', '0');
        card.innerHTML = `
            <div class="course-icon" aria-hidden="true">${course.icon}</div>
            <h3 class="course-title">${course.title}</h3>
            <p class="course-description">${course.description}</p>
            <button class="course-button" aria-describedby="course-desc-${index}">Learn More</button>
            <div id="course-desc-${index}" class="sr-only">Click to learn more about ${course.title}</div>
        `;
        
        // Add click event to show course details
        card.addEventListener('click', () => showCourseDetail(course));
        
        // Add keyboard support
        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                showCourseDetail(course);
            }
        });
        
        courseGrid.appendChild(card);
    });
}

// ============================
// PHYSICS CANVAS ANIMATION
// ============================
function createPhysicsCanvas() {
    interactiveContent.innerHTML = `
        <div class="canvas-container">
            <h3 style="margin-bottom: 1rem; color: var(--primary-blue);">Interactive Projectile Motion Simulation</h3>
            <p style="margin-bottom: 1rem; color: var(--text-medium);">Watch the ball follow the laws of physics as it moves through the air. Click Launch to start the simulation.</p>
            <canvas id="physicsCanvas" width="700" height="400" role="img" aria-label="Physics simulation showing projectile motion with a bouncing ball"></canvas>
            <div class="canvas-controls">
                <button class="canvas-button" id="launchBtn" aria-label="Launch the ball">🚀 Launch</button>
                <button class="canvas-button reset" id="resetBtn" aria-label="Reset the simulation">🔄 Reset</button>
            </div>
        </div>
    `;

    const canvas = document.getElementById('physicsCanvas');
    const ctx = canvas.getContext('2d');
    
    // Animation variables
    let animationId;
    let ball = {
        x: 50,
        y: canvas.height - 50,
        radius: 15,
        vx: 8,
        vy: -15,
        gravity: 0.5,
        isLaunched: false
    };

    // Draw the ground and launch pad
    function drawScene() {
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
    }

    // Draw the ball
    function drawBall() {
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
    }

    // Animation loop
    function animate() {
        drawScene();
        drawBall();

        if (ball.isLaunched) {
            // Update position
            ball.x += ball.vx;
            ball.y += ball.vy;
            ball.vy += ball.gravity;

            // Bounce off bottom
            if (ball.y + ball.radius > canvas.height - 30) {
                ball.y = canvas.height - 30 - ball.radius;
                ball.vy *= -0.7; // Bounce with energy loss
                ball.vx *= 0.9; // Friction
            }

            // Bounce off walls
            if (ball.x + ball.radius > canvas.width || ball.x - ball.radius < 0) {
                ball.vx *= -0.7;
                ball.x = ball.x + ball.radius > canvas.width ? canvas.width - ball.radius : ball.radius;
            }

            // Stop if energy is too low
            if (Math.abs(ball.vy) < 0.5 && ball.y > canvas.height - 50) {
                ball.isLaunched = false;
                ball.vy = 0;
                ball.vx = 0;
            }

            animationId = requestAnimationFrame(animate);
        } else {
            cancelAnimationFrame(animationId);
        }
    }

    // Initial draw
    drawScene();
    drawBall();

    // Launch button
    document.getElementById('launchBtn').addEventListener('click', () => {
        if (!ball.isLaunched) {
            ball.isLaunched = true;
            ball.vx = 8;
            ball.vy = -15;
            animate();
        }
    });

    // Reset button
    document.getElementById('resetBtn').addEventListener('click', () => {
        cancelAnimationFrame(animationId);
        ball = {
            x: 50,
            y: canvas.height - 50,
            radius: 15,
            vx: 8,
            vy: -15,
            gravity: 0.5,
            isLaunched: false
        };
        drawScene();
        drawBall();
    });
}

// ============================
// DRAG & DROP QUIZ
// ============================
function createDragDropQuiz() {
    const quizData = [
        { id: 'sorting', text: 'Sorting', target: 'definition1', correct: 'definition1' },
        { id: 'searching', text: 'Searching', target: 'definition2', correct: 'definition2' },
        { id: 'recursion', text: 'Recursion', target: 'definition3', correct: 'definition3' }
    ];

    const definitions = [
        { id: 'definition1', text: 'Arranging data in order' },
        { id: 'definition2', text: 'Finding specific data' },
        { id: 'definition3', text: 'Function calling itself' }
    ];

    interactiveContent.innerHTML = `
        <div class="quiz-container">
            <h3 style="margin-bottom: 1rem; color: var(--primary-blue);">Drag & Drop Quiz: Match the Algorithm to Definition</h3>
            <div class="quiz-instructions">
                <strong>Instructions:</strong> Drag each algorithm concept from the left and drop it onto its correct definition on the right. You can also use keyboard navigation with Tab and Enter keys.
            </div>
            
            <h4 style="margin-bottom: 1rem;">Algorithm Concepts:</h4>
            <div class="drag-items-container" id="dragItems" role="list" aria-label="Draggable algorithm concepts"></div>
            
            <h4 style="margin: 2rem 0 1rem;">Definitions:</h4>
            <div class="drop-zones-container" id="dropZones" role="list" aria-label="Drop zones for algorithm definitions"></div>
            
            <button class="check-button" id="checkAnswers" aria-describedby="quiz-instructions">Check Answers</button>
            <div class="quiz-result" id="quizResult" role="status" aria-live="polite"></div>
        </div>
    `;

    const dragItemsContainer = document.getElementById('dragItems');
    const dropZonesContainer = document.getElementById('dropZones');

    // Create draggable items
    quizData.forEach(item => {
        const dragItem = document.createElement('div');
        dragItem.className = 'drag-item';
        dragItem.draggable = true;
        dragItem.id = item.id;
        dragItem.textContent = item.text;
        dragItem.dataset.correct = item.correct;
        dragItem.setAttribute('role', 'listitem');
        dragItem.setAttribute('aria-label', `Draggable item: ${item.text}`);
        dragItem.setAttribute('tabindex', '0');

        dragItem.addEventListener('dragstart', handleDragStart);
        dragItem.addEventListener('dragend', handleDragEnd);
        
        // Add keyboard support for drag items
        dragItem.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                AccessibilityManager.announce(`${item.text} selected. Use arrow keys to navigate to drop zones.`);
            }
        });

        dragItemsContainer.appendChild(dragItem);
    });

    // Create drop zones
    definitions.forEach(def => {
        const dropZone = document.createElement('div');
        dropZone.className = 'drop-zone';
        dropZone.id = def.id;
        dropZone.innerHTML = `<div class="drop-zone-label">${def.text}</div>`;
        dropZone.setAttribute('role', 'listitem');
        dropZone.setAttribute('aria-label', `Drop zone for: ${def.text}`);
        dropZone.setAttribute('tabindex', '0');

        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('drop', handleDrop);
        dropZone.addEventListener('dragleave', handleDragLeave);
        
        // Add keyboard support for drop zones
        dropZone.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                AccessibilityManager.announce(`Drop zone: ${def.text}`);
            }
        });

        dropZonesContainer.appendChild(dropZone);
    });

    // Drag and drop handlers
    let draggedElement = null;

    function handleDragStart(e) {
        draggedElement = this;
        this.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragEnd(e) {
        this.classList.remove('dragging');
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'move';
        this.classList.add('drag-over');
        return false;
    }

    function handleDragLeave(e) {
        this.classList.remove('drag-over');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }
        this.classList.remove('drag-over');

        if (draggedElement) {
            // Remove any existing dragged item in this zone
            const existingItem = this.querySelector('.drag-item');
            if (existingItem) {
                dragItemsContainer.appendChild(existingItem);
            }

            // Add the new item
            this.appendChild(draggedElement);
        }

        return false;
    }

    // Check answers
    document.getElementById('checkAnswers').addEventListener('click', () => {
        let correct = 0;
        let total = quizData.length;

        definitions.forEach(def => {
            const zone = document.getElementById(def.id);
            const item = zone.querySelector('.drag-item');

            // Reset classes
            zone.classList.remove('correct', 'incorrect');

            if (item && item.dataset.correct === def.id) {
                zone.classList.add('correct');
                correct++;
            } else if (item) {
                zone.classList.add('incorrect');
            }
        });

        const resultDiv = document.getElementById('quizResult');
        resultDiv.classList.add('show');
        
        if (correct === total) {
            resultDiv.textContent = `🎉 Perfect! You got all ${total} correct!`;
            resultDiv.style.color = '#10B981';
            AccessibilityManager.announce(`Excellent! You got all ${total} questions correct!`);
        } else {
            resultDiv.textContent = `You got ${correct} out of ${total} correct. Try again!`;
            resultDiv.style.color = '#F59E0B';
            AccessibilityManager.announce(`You got ${correct} out of ${total} questions correct. Try again!`);
        }
        
        // Focus on result for screen readers
        resultDiv.focus();
    });
}

// ============================
// EVENT LISTENERS
// ============================

// Back button
backButton.addEventListener('click', showHomeView);

// Navigation links with improved accessibility
document.getElementById('navHome').addEventListener('click', (e) => {
    e.preventDefault();
    showHomeView();
});

document.getElementById('navCourses').addEventListener('click', (e) => {
    e.preventDefault();
    showHomeView();
    setTimeout(() => {
        const coursesSection = document.querySelector('.courses-section');
        if (coursesSection) {
            coursesSection.scrollIntoView({ behavior: 'smooth' });
            AccessibilityManager.announce('Scrolled to courses section');
        }
    }, 100);
});

document.getElementById('navAbout').addEventListener('click', (e) => {
    e.preventDefault();
    AccessibilityManager.announce('EduPortal - Empowering learners worldwide with quality education since 2025.');
    // Use a more accessible alternative to alert
    const aboutModal = document.createElement('div');
    aboutModal.innerHTML = `
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10000; display: flex; align-items: center; justify-content: center;">
            <div style="background: white; padding: 2rem; border-radius: 10px; max-width: 400px; text-align: center;">
                <h3>About EduPortal</h3>
                <p>Empowering learners worldwide with quality education since 2025.</p>
                <button onclick="this.parentElement.parentElement.remove()" style="margin-top: 1rem; padding: 0.5rem 1rem; background: var(--primary-blue); color: white; border: none; border-radius: 5px;">Close</button>
            </div>
        </div>
    `;
    document.body.appendChild(aboutModal);
    AccessibilityManager.trapFocus(aboutModal);
});

// ============================
// INITIALIZATION
// ============================

// Wait for DOM to be ready
function initializeApp() {
    // Generate course cards on page load
    generateCourseCards();

    // Add smooth scroll behavior with throttling for performance
    const smoothScrollHandler = throttle((e) => {
        const href = e.target.getAttribute('href');
        if (href && href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }, 100);

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', smoothScrollHandler);
    });

    // Add keyboard navigation support
    document.addEventListener('keydown', (e) => {
        // ESC key to go back from detail view
        if (e.key === 'Escape' && detailView.classList.contains('active')) {
            showHomeView();
        }
    });

    // Add resize handler for responsive canvas
    const resizeHandler = debounce(() => {
        const canvas = document.getElementById('physicsCanvas');
        if (canvas) {
            // Adjust canvas size on resize
            const container = canvas.parentElement;
            if (container && window.innerWidth < 768) {
                canvas.width = Math.min(700, container.offsetWidth - 40);
            }
        }
    }, 250);

    window.addEventListener('resize', resizeHandler);

    // Log initialization
    console.log('🎓 EduPortal initialized successfully!');
    console.log(`📚 Loaded ${courses.length} courses`);
    
    // Announce successful loading to screen readers
    AccessibilityManager.announce('EduPortal loaded successfully. Use Tab to navigate through courses.');
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeApp);
} else {
    initializeApp();
}

// Export for testing (Node.js environment)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        courses,
        generateCourseCards,
        showCourseDetail,
        showHomeView
    };
}
