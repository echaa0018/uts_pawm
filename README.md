# EduPortal React

An educational platform built with React that provides interactive learning experiences across various subjects.

## Features

- **Interactive Physics Simulation**: Projectile motion simulation with realistic physics
- **Drag & Drop Quiz**: Algorithm matching quiz with accessibility support
- **Responsive Design**: Mobile-first approach with excellent UX across all devices
- **Accessibility**: Full keyboard navigation, screen reader support, and ARIA labels
- **Modern UI**: Glassmorphism design with smooth animations

## Getting Started

### Prerequisites

- Node.js (version 14 or higher)
- npm or yarn

### Installation

1. Install dependencies:
```bash
npm install
```

2. Start the development server:
```bash
npm start
```

3. Open [http://localhost:3000](http://localhost:3000) to view it in the browser.

### Available Scripts

- `npm start` - Runs the app in development mode
- `npm build` - Builds the app for production
- `npm test` - Launches the test runner
- `npm eject` - Ejects from Create React App (one-way operation)

## Project Structure

```
src/
├── components/          # Reusable React components
│   ├── Header.js       # Navigation header
│   ├── Footer.js       # Footer component
│   ├── CourseCard.js   # Individual course card
│   ├── PhysicsCanvas.js # Physics simulation
│   └── DragDropQuiz.js # Interactive quiz
├── pages/              # Page components
│   ├── Home.js         # Home page with course grid
│   └── CourseDetail.js # Course detail page
├── data/               # Data and utilities
│   └── courses.js      # Course data and helpers
├── App.js              # Main app component
├── App.css             # Main app styles
├── index.js            # App entry point
└── index.css           # Global styles
```

## Technologies Used

- **React 18** - Modern React with hooks
- **React Router** - Client-side routing
- **CSS3** - Modern CSS with custom properties
- **Canvas API** - Physics simulation
- **HTML5 Drag & Drop** - Interactive quiz

## Accessibility Features

- Screen reader support with ARIA labels
- Keyboard navigation throughout the app
- Focus management and trapping
- High contrast and reduced motion support
- Semantic HTML structure

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

MIT License - see LICENSE file for details
