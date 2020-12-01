import React from 'react'

function Landing() {
  return (
    <div>
      <div className="container py-4 bg-dark d-flex flex-column align-items-center">
        <div className="row">
          <h3 className="text-white text-center">
            See what's happening in the world right now
          </h3>
        </div>
        <div className="row">
          <p className="text-white">Join Eventer Today</p>
        </div>
        <div className="row pb-2">
            <button className='btn btn-primary landing-button'>Register</button>
        </div>
        <div className="row pb-4">
            <button className='btn btn-primary landing-button'>Login</button>
        </div>
        <div className="row">
            <img src="media/Landing/michael-discenza-MxfcoxycH_Y-unsplash-min.jpg" alt="Event Image" id="landing-image"/>
        </div>
        <div className="row pt-4">
            <div className="col-6">
                <button className="btn btn-primary landing-button">Register</button>
            </div>
            <div className="col-6">
                <button className="btn btn-primary landing-button">Login</button>
            </div>
        </div>
      </div>
    </div>
  )
}

export default Landing
