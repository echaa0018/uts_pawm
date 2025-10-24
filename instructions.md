Hello Claude,

I need your help to create a best-in-class educational website. Your goal is to build a fully functional, beautiful, and interactive front-end experience.

Please follow these requirements exactly:

**1. Core Task & Tech Stack:**

* **Task:** Build a single-page website that serves as a portal for students to access various courses.
* **Tech Stack:** You **MUST** use **only pure HTML, CSS, and JavaScript.**
* **Constraints:**
    * **ABSOLUTELY NO** frameworks or libraries (no React, Vue, Angular, Laravel, Next.js, jQuery, etc.).
    * **NO** backend or database. This must be a 100% client-side application.
    * The entire website must be contained within a **single `index.html` file**. All CSS must be in a `<style>` tag and all JavaScript in a `<script>` tag. This is crucial for easy deployment on static hosting platforms like Railway.

**2. Website Structure & Content:**

* **Header/Navigation:**
    * Use a semantic `<header>` with a `<nav>` element.
    * Include a logo (you can just use text, e.g., "EduPortal") and simple navigation links like "Home," "Courses," and "About."
* **Main Content (`<main>`):**
    * **Hero Section:** A welcoming `<section>` with a strong headline (e.g., "Unlock Your Potential") and a brief description.
    * **Course Grid Section:** This is the most important part.
        * Display all the courses in a responsive grid (use CSS Grid or Flexbox).
        * **Course List:**
            1.  Physics
            2.  Mathematics
            3.  Chemistry
            4.  Thinking Computationally
            5.  Digital and AI Literacy
            6.  Sports
            7.  Pancasila
            8.  Bahasa Indonesia
            9.  English
* **Footer:** A semantic `<footer>` with copyright info and social links (just use placeholder icons or text).

**3. Scoring Criteria (Implement these features):**

* **Criterion 1: Maximize HTML5 Features:**
    * Use semantic elements extensively (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`).
    * **Interactive `<canvas>`:** For the "Physics" course details page, include a simple `<canvas>` animation (e.g., a ball demonstrating basic projectile motion).
    * **Drag & Drop:** For the "Thinking Computationally" course details page, create a simple "drag and drop" quiz. For example, 3 `<div>`s to drag and 3 target `<div>`s to drop them into (e.g., "Match the algorithm to its definition").

* **Criterion 2: Creative & Modern CSS:**
    * **Design:** Create a modern, clean, and visually appealing "glassmorphism" or "neumorphism" style for the course cards.
    * **Color Palette:** Use a beautiful, professional color palette. (e.g., a primary blue, a clean white/light gray background, and a vibrant accent color like orange or green for buttons).
    * **Typography:** Use a highly readable, modern font from Google Fonts (e.g., "Inter" or "Poppins").
    * **Responsiveness:** The layout **MUST** be fully responsive and mobile-first. The course grid should stack neatly on small screens.
    * **Micro-interactions:** Add subtle CSS transitions and hover effects to buttons, links, and course cards to make the site feel alive.

* **Criterion 3: Interactive JavaScript (SPA Simulation):**
    * **DO NOT** create multiple HTML files. Simulate a Single Page Application (SPA).
    * **Page Logic:**
        1.  When the page loads, show the "Home" view (Hero + Course Grid).
        2.  When a user clicks on a "Course Card" (e.g., "Physics"), use JavaScript to:
            * Hide the main "Home" view (e.g., `display: none`).
            * Show a new "Course Detail" view (a `<section>` that was previously hidden).
        3.  This "Course Detail" view should be populated with content for that specific course (e.g., "Welcome to Physics!"). This is where you will place the `<canvas>` or "drag & drop" quiz for the respective courses.
        4.  This view **MUST** have a "Back to Courses" button that reverses the process (hides the detail view, shows the home view).
    * **Interactivity:** Implement the JS logic for the "Physics" `<canvas>` animation and the "Thinking Computationally" drag & drop quiz.

Please generate the complete, single `index.html` file with all HTML, CSS, and JavaScript included. Make sure the code is well-commented so I can understand the logic.