import React from 'react'
import { Link } from 'react-router-dom'

function Navbar(props) {
  return (
    <nav className="navbar navbar-expand-md">
      <div className="container">
        <Link className="navbar-brand" to="/">
          <img id="nav-logo" src="media/Logo/android-chrome-512x512.png" alt="Eventer Icon" />
        </Link>
      </div>
    </nav>
  )
}

export default Navbar
