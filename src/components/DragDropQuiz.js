import React, { useState, useRef } from 'react';
import './InteractiveComponents.css';

const DragDropQuiz = () => {
  const [draggedElement, setDraggedElement] = useState(null);
  const [quizResult, setQuizResult] = useState(null);
  const dragItemsContainerRef = useRef(null);
  const dropZonesContainerRef = useRef(null);

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

  const handleDragStart = (e, item) => {
    setDraggedElement(item);
    e.target.classList.add('dragging');
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', e.target.innerHTML);
  };

  const handleDragEnd = (e) => {
    e.target.classList.remove('dragging');
  };

  const handleDragOver = (e) => {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
    e.currentTarget.classList.add('drag-over');
  };

  const handleDragLeave = (e) => {
    e.currentTarget.classList.remove('drag-over');
  };

  const handleDrop = (e, definition) => {
    e.preventDefault();
    e.currentTarget.classList.remove('drag-over');

    if (draggedElement) {
      // Remove any existing dragged item in this zone
      const existingItem = e.currentTarget.querySelector('.drag-item');
      if (existingItem) {
        dragItemsContainerRef.current.appendChild(existingItem);
      }

      // Add the new item
      e.currentTarget.appendChild(draggedElement);
    }
  };

  const handleKeyDown = (e, item) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      // Announce selection for accessibility
      const announcement = document.createElement('div');
      announcement.setAttribute('aria-live', 'polite');
      announcement.className = 'sr-only';
      announcement.textContent = `${item.text} selected. Use arrow keys to navigate to drop zones.`;
      document.body.appendChild(announcement);
      setTimeout(() => document.body.removeChild(announcement), 1000);
    }
  };

  const checkAnswers = () => {
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

    const result = correct === total 
      ? `🎉 Perfect! You got all ${total} correct!`
      : `You got ${correct} out of ${total} correct. Try again!`;

    setQuizResult({
      text: result,
      color: correct === total ? '#10B981' : '#F59E0B'
    });

    // Announce result for accessibility
    const announcement = document.createElement('div');
    announcement.setAttribute('aria-live', 'polite');
    announcement.className = 'sr-only';
    announcement.textContent = correct === total 
      ? `Excellent! You got all ${total} questions correct!`
      : `You got ${correct} out of ${total} questions correct. Try again!`;
    document.body.appendChild(announcement);
    setTimeout(() => document.body.removeChild(announcement), 1000);
  };

  return (
    <div className="quiz-container">
      <h3 style={{ marginBottom: '1rem', color: 'var(--primary-blue)' }}>
        Drag & Drop Quiz: Match the Algorithm to Definition
      </h3>
      <div className="quiz-instructions">
        <strong>Instructions:</strong> Drag each algorithm concept from the left and drop it onto its correct definition on the right. 
        You can also use keyboard navigation with Tab and Enter keys.
      </div>
      
      <h4 style={{ marginBottom: '1rem' }}>Algorithm Concepts:</h4>
      <div 
        className="drag-items-container" 
        ref={dragItemsContainerRef}
        role="list" 
        aria-label="Draggable algorithm concepts"
      >
        {quizData.map(item => (
          <div
            key={item.id}
            className="drag-item"
            draggable
            id={item.id}
            data-correct={item.correct}
            role="listitem"
            aria-label={`Draggable item: ${item.text}`}
            tabIndex="0"
            onDragStart={(e) => handleDragStart(e, item)}
            onDragEnd={handleDragEnd}
            onKeyDown={(e) => handleKeyDown(e, item)}
          >
            {item.text}
          </div>
        ))}
      </div>
      
      <h4 style={{ margin: '2rem 0 1rem' }}>Definitions:</h4>
      <div 
        className="drop-zones-container" 
        ref={dropZonesContainerRef}
        role="list" 
        aria-label="Drop zones for algorithm definitions"
      >
        {definitions.map(def => (
          <div
            key={def.id}
            className="drop-zone"
            id={def.id}
            role="listitem"
            aria-label={`Drop zone for: ${def.text}`}
            tabIndex="0"
            onDragOver={handleDragOver}
            onDrop={(e) => handleDrop(e, def)}
            onDragLeave={handleDragLeave}
            onKeyDown={(e) => {
              if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.className = 'sr-only';
                announcement.textContent = `Drop zone: ${def.text}`;
                document.body.appendChild(announcement);
                setTimeout(() => document.body.removeChild(announcement), 1000);
              }
            }}
          >
            <div className="drop-zone-label">{def.text}</div>
          </div>
        ))}
      </div>
      
      <button 
        className="check-button" 
        onClick={checkAnswers}
        aria-describedby="quiz-instructions"
      >
        Check Answers
      </button>
      
      {quizResult && (
        <div 
          className="quiz-result show" 
          role="status" 
          aria-live="polite"
          style={{ color: quizResult.color }}
        >
          {quizResult.text}
        </div>
      )}
    </div>
  );
};

export default DragDropQuiz;
