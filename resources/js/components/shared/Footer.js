import React from 'react'

function Footer() {
  return (
    <div className="footer">
      <div id="footer-text">
        <div className="container">
          Copyright © {new Date().getFullYear()} Eventer
        </div>
      </div>
    </div>
  )
}

export default Footer
