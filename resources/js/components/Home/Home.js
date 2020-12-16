import React, { Component } from 'react'
import Footer from '../Footer/Footer'
import Header from '../Header/Header'
import { Link } from 'react-router-dom'

class Home extends Component {
  constructor(props) {
    super(props)
    this.state = {
      isLoggedIn: false,
      user: {},
    }
  }

  // check if user is authenticated and storing authentication data as states if true
  componentDidMount() {
    let state = localStorage['appState']
    if (state) {
      let AppState = JSON.parse(state)
      this.setState({ isLoggedIn: AppState.isLoggedIn, user: AppState.user })
    }
  }

  render() {
    return (
      <div>
        <Header
          userData={this.state.user}
          userIsLoggedIn={this.state.isLoggedIn}
        ></Header>
        <div className="container-fluid content-container">
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
              <h3 className="landing-text">
                See what's happening in the world right now
              </h3>
            </div>
            <div className="row">
              <p className="landing-text">Join Eventer Today</p>
            </div>
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
          </div>
        </div>
        <Footer />
      </div>
    )
  }
}

export default Home
