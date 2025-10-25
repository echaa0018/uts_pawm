// Course data
export const courses = [
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

// Utility function to find course by ID
export const getCourseById = (id) => {
  return courses.find(course => course.id === id);
};
