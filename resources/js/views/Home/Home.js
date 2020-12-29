import React from 'react'
import { Link } from 'react-router-dom'

const appState = JSON.parse(localStorage['appState'])

function Home(props) {
  console.log(appState.isAuthenticated)
  return (
    <div>
      <div id="landing-container" className="container-fluid">
        <div className="col-md-6">
          <img
            id="landing-image"
            className="responsive"
            src="media/Landing/michael-discenza-MxfcoxycH_Y-unsplash-min.jpg"
            alt="Event Image"
          />
        </div>
        <div id="landing-description" className="col-md-6">
          <div className="row">
            <h3 className="landing-text">The Home of Event Management.</h3>
          </div>
          <div className="row">
            <p className="landing-text">Join Eventer Today</p>
          </div>
          {!appState.isAuthenticated ? (
            <div id="landing-buttons" className="row ">
              <div className="col-6">
                <Link to="/register">
                  <button className="btn btn-primary landing-button">
                    Register
                  </button>
                </Link>
              </div>
              <div className="col-6">
                <Link to="/login">
                  <button className="btn btn-primary landing-button">
                    Login
                  </button>
                </Link>
              </div>
            </div>
          ) : (
            <div id="landing-buttons" className="row ">
              <Link to="/dashboard">
                <button className="btn btn-primary landing-button">
                  Dashboard
                </button>
              </Link>
            </div>
          )}
        </div>
      </div>
    </div>
  )
}

export default Home
