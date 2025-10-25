import React from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { getCourseById } from '../data/courses';
import PhysicsCanvas from '../components/PhysicsCanvas';
import DragDropQuiz from '../components/DragDropQuiz';

const CourseDetail = () => {
  const { courseId } = useParams();
  const navigate = useNavigate();
  const course = getCourseById(courseId);

  if (!course) {
    return (
      <div className="course-detail">
        <h2>Course not found</h2>
        <p>The course you're looking for doesn't exist.</p>
        <button 
          className="back-button" 
          onClick={() => navigate('/')}
          aria-label="Return to course selection"
        >
          ← Back to Courses
        </button>
      </div>
    );
  }

  const handleBackClick = () => {
    navigate('/');
  };

  const renderInteractiveContent = () => {
    switch (course.id) {
      case 'physics':
        return <PhysicsCanvas />;
      case 'computing':
        return <DragDropQuiz />;
      default:
        return null;
    }
  };

  return (
    <section 
      className="course-detail" 
      aria-labelledby="detail-title"
    >
      <div className="detail-header">
        <h2 id="detail-title" className="detail-title">
          {course.icon} {course.title}
        </h2>
        <button 
          className="back-button" 
          onClick={handleBackClick}
          aria-label="Return to course selection"
        >
          ← Back to Courses
        </button>
      </div>
      
      <div className="detail-content">
        {course.fullDescription}
      </div>
      
      <div 
        role="region" 
        aria-label="Interactive course content"
      >
        {renderInteractiveContent()}
      </div>
    </section>
  );
};

export default CourseDetail;
