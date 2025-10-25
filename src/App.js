import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Header from './components/Header';
import Home from './pages/Home';
import CourseDetail from './pages/CourseDetail';
import Footer from './components/Footer';
import './App.css';

function App() {
  return (
    <div className="App">
      <Header />
      <main id="main-content" role="main">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/course/:courseId" element={<CourseDetail />} />
        </Routes>
      </main>
      <Footer />
    </div>
  );
}

export default App;
