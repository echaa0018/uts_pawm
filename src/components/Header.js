import React from 'react';
import { Link, useLocation } from 'react-router-dom';

const Header = () => {
  const location = useLocation();

  return (
    <header role="banner">
      <nav role="navigation" aria-label="Main navigation">
        <Link to="/" className="logo" aria-label="EduPortal - Go to homepage">
          EduPortal
        </Link>
        <ul className="nav-links" role="menubar">
          <li role="none">
            <Link 
              to="/" 
              role="menuitem" 
              aria-current={location.pathname === '/' ? 'page' : undefined}
            >
              Home
            </Link>
          </li>
          <li role="none">
            <Link 
              to="/" 
              role="menuitem"
              aria-current={location.pathname === '/' ? 'page' : undefined}
            >
              Courses
            </Link>
          </li>
          <li role="none">
            <Link 
              to="/about" 
              role="menuitem"
              aria-current={location.pathname === '/about' ? 'page' : undefined}
            >
              About
            </Link>
          </li>
        </ul>
      </nav>
    </header>
  );
};

export default Header;
