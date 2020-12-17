import React, { Component } from 'react'
import { Link, withRouter } from 'react-router-dom'

class Header extends Component {
  constructor(props) {
    super(props)
    this.state = {
      user: props.userData,
      isLoggedIn: props.userIsLoggedIn,
    }
    this.logOut = this.logOut.bind(this)
  }

  logOut() {
    let appState = {
      isLoggedIn: false,
      user: {},
    }
    localStorage['appState'] = JSON.stringify(appState)
    this.setState(appState)
    this.props.history.push('/login')
  }

  render() {
    const isAuthenticated = !!this.state.isLoggedIn

    const authLinks = (
      <div className="navbar-nav mr-auto">
        <Link className="nav-link" to="/dashboard">
          Dashboard
        </Link>
      </div>
    )

    const guestLinks = (
      <div className="navbar-nav mr-auto">
        <Link className="nav-link" to="/login">
          <button className="btn btn-primary landing-button mr-3">Login</button>
        </Link>
        <Link className="nav-link" to="/register">
          <button className="btn btn-primary landing-button">Register</button>
        </Link>
      </div>
    )

    return (
      <div className="navbar">
        <Link className="navbar-brand" to="/">
          <img
            id="nav-logo"
            src="media/Logo/android-chrome-512x512.png"
            alt="Eventer Icon"
          />
        </Link>
        {/* {isAuthenticated ? authLinks : guestLinks} */}
      </div>
    )
  }
}

export default withRouter(Header)
