import React, { Component } from 'react'
import axios from 'axios'

class Login extends Component {
  constructor(props) {
    super(props)
    this.state = {
      email: '',
      password: '',
    }
    this.onChange = this.onChange.bind(this)
    this.onSubmit = this.onSubmit.bind(this)
  }

  /**
   * Updates the state when the value of an element has been changed.
   * @param {React.ChangeEvent<HTMLInputElement>} event
   */
  onChange(event) {
    this.setState({ [event.target.name]: event.target.value })
  }

  /**
   * Creates a new user
   * @param {React.MouseEvent<HTMLButtonElement, MouseEvent>} event
   */
  onSubmit(event) {
    event.preventDefault()
    const userData = this.state
    axios
      .post('/api/auth/login', userData)
      .then(response => {
        const token = response.data.access_token
        const appState = {
          isLoggedIn: true,
          access_token: token,
        }
        localStorage['appState'] = JSON.stringify(appState)
      })
      .catch(error => console.log(error))
  }

  render() {
    return (
      <div className="container authentication-container">
        <div className="row">
          <label htmlFor="email">Email</label>
          <input
            type="text"
            className="form-control login-input"
            onChange={this.onChange}
            placeholder="Email"
            name="email"
          />
          <label htmlFor="password">Password</label>
          <input
            type="password"
            className="form-control login-input"
            onChange={this.onChange}
            placeholder="Password"
            name="password"
          />
          <button className="btn btn-outline-success" onClick={this.onSubmit}>
            Submit
          </button>
        </div>
      </div>
    )
  }
}

export default Login
