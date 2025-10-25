import React from 'react';
import { useNavigate } from 'react-router-dom';

const CourseCard = ({ course, index }) => {
  const navigate = useNavigate();

  const handleClick = () => {
    navigate(`/course/${course.id}`);
  };

  const handleKeyDown = (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      handleClick();
    }
  };

  return (
    <article
      className="course-card"
      role="gridcell"
      aria-label={`${course.title} course: ${course.description}`}
      tabIndex="0"
      onClick={handleClick}
      onKeyDown={handleKeyDown}
    >
      <div className="course-icon" aria-hidden="true">
        {course.icon}
      </div>
      <h3 className="course-title">{course.title}</h3>
      <p className="course-description">{course.description}</p>
      <button 
        className="course-button" 
        aria-describedby={`course-desc-${index}`}
        onClick={(e) => {
          e.stopPropagation();
          handleClick();
        }}
      >
        Learn More
      </button>
      <div id={`course-desc-${index}`} className="sr-only">
        Click to learn more about {course.title}
      </div>
    </article>
  );
};

export default CourseCard;
