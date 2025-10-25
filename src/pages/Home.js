import React from 'react';
import CourseCard from '../components/CourseCard';
import { courses } from '../data/courses';

const Home = () => {
  return (
    <div>
      {/* Hero Section */}
      <section className="hero-section" aria-labelledby="hero-title">
        <h1 id="hero-title">Unlock Your Potential</h1>
        <p>
          Embark on a journey of knowledge and discovery. Choose from our diverse range of courses 
          designed to elevate your skills and broaden your horizons.
        </p>
      </section>

      {/* Courses Grid Section */}
      <section className="courses-section" aria-labelledby="courses-title">
        <h2 id="courses-title" className="section-title">Explore Our Courses</h2>
        <div className="course-grid" role="grid" aria-label="Course selection grid">
          {courses.map((course, index) => (
            <CourseCard key={course.id} course={course} index={index} />
          ))}
        </div>
      </section>
    </div>
  );
};

export default Home;
