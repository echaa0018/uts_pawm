// ============================
// COURSE DATA
// ============================
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
    homeView.classList.remove('hidden');
    detailView.classList.remove('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Function to show course detail view
function showCourseDetail(course) {
    homeView.classList.add('hidden');
    detailView.classList.add('active');
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
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ============================
// GENERATE COURSE CARDS
// ============================
function generateCourseCards() {
    courseGrid.innerHTML = '';
    courses.forEach(course => {
        const card = document.createElement('article');
        card.className = 'course-card';
        card.innerHTML = `
            <div class="course-icon">${course.icon}</div>
            <h3 class="course-title">${course.title}</h3>
            <p class="course-description">${course.description}</p>
            <button class="course-button">Learn More</button>
        `;
        
        // Add click event to show course details
        card.addEventListener('click', () => showCourseDetail(course));
        
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
            <canvas id="physicsCanvas" width="700" height="400"></canvas>
            <div class="canvas-controls">
                <button class="canvas-button" id="launchBtn">🚀 Launch</button>
                <button class="canvas-button reset" id="resetBtn">🔄 Reset</button>
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
                <strong>Instructions:</strong> Drag each algorithm concept from the left and drop it onto its correct definition on the right.
            </div>
            
            <h4 style="margin-bottom: 1rem;">Algorithm Concepts:</h4>
            <div class="drag-items-container" id="dragItems"></div>
            
            <h4 style="margin: 2rem 0 1rem;">Definitions:</h4>
            <div class="drop-zones-container" id="dropZones"></div>
            
            <button class="check-button" id="checkAnswers">Check Answers</button>
            <div class="quiz-result" id="quizResult"></div>
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

        dragItem.addEventListener('dragstart', handleDragStart);
        dragItem.addEventListener('dragend', handleDragEnd);

        dragItemsContainer.appendChild(dragItem);
    });

    // Create drop zones
    definitions.forEach(def => {
        const dropZone = document.createElement('div');
        dropZone.className = 'drop-zone';
        dropZone.id = def.id;
        dropZone.innerHTML = `<div class="drop-zone-label">${def.text}</div>`;

        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('drop', handleDrop);
        dropZone.addEventListener('dragleave', handleDragLeave);

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
        } else {
            resultDiv.textContent = `You got ${correct} out of ${total} correct. Try again!`;
            resultDiv.style.color = '#F59E0B';
        }
    });
}

// ============================
// EVENT LISTENERS
// ============================

// Back button
backButton.addEventListener('click', showHomeView);

// Navigation links
document.getElementById('navHome').addEventListener('click', (e) => {
    e.preventDefault();
    showHomeView();
});

document.getElementById('navCourses').addEventListener('click', (e) => {
    e.preventDefault();
    showHomeView();
    setTimeout(() => {
        document.querySelector('.courses-section').scrollIntoView({ behavior: 'smooth' });
    }, 100);
});

document.getElementById('navAbout').addEventListener('click', (e) => {
    e.preventDefault();
    alert('EduPortal - Empowering learners worldwide with quality education since 2025.');
});

// ============================
// INITIALIZATION
// ============================

// Generate course cards on page load
generateCourseCards();

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

// Log initialization
console.log('🎓 EduPortal initialized successfully!');
console.log(`📚 Loaded ${courses.length} courses`);

// Export for testing (Node.js environment)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        courses,
        generateCourseCards,
        showCourseDetail,
        showHomeView
    };
}
