import React from 'react'

function Footer(props) {
  return (
    <div className="footer">
      <div className="bg-dark text-white footer-copyright text-center py-3">
        <div className="container">
          Copyright © {new Date().getFullYear()} Eventer
        </div>
      </div>
    </div>
  )
}

export default Footer
