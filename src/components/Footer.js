import React from 'react';

const Footer = () => {
  return (
    <footer role="contentinfo">
      <div className="footer-content">
        <p>&copy; 2025 EduPortal. All rights reserved.</p>
        <p>Empowering learners worldwide with quality education.</p>
        <div className="social-links" role="list" aria-label="Social media links">
          <a href="#" title="Facebook" role="listitem" aria-label="Visit our Facebook page">📘</a>
          <a href="#" title="Twitter" role="listitem" aria-label="Visit our Twitter page">🐦</a>
          <a href="#" title="Instagram" role="listitem" aria-label="Visit our Instagram page">📷</a>
          <a href="#" title="LinkedIn" role="listitem" aria-label="Visit our LinkedIn page">💼</a>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
