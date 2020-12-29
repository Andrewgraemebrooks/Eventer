import React, { Component } from 'react'
import axios from 'axios'

class Login extends Component {
  constructor(props) {
    super(props)
    this.state = {
      error: '',
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
        const appState = response.data
        localStorage['appState'] = JSON.stringify(appState)
        this.setState({ error: '' })
        this.props.history.push('/dashboard')
      })
      .catch(error => {
        const appState = { isAuthenticated: false, access_token: '' }
        localStorage['appState'] = JSON.stringify(appState)
        this.setState({ error: error.response.data.message })
      })
  }

  render() {
    return (
      <div className="container authentication-container">
        {this.state.error ? (
          <div className="alert alert-danger" role="alert">
            {this.state.error}
          </div>
        ) : (
          ''
        )}
        <div className="row">
          <label htmlFor="email">Email</label>
          <input
            type="text"
            className={
              'form-control login-input ' +
              (this.state.error ? 'is-invalid' : '')
            }
            onChange={this.onChange}
            placeholder="Email"
            name="email"
          />
          <label htmlFor="password">Password</label>
          <input
            type="password"
            className={
              'form-control login-input ' +
              (this.state.error ? 'is-invalid' : '')
            }
            onChange={this.onChange}
            placeholder="Password"
            name="password"
          />
          <button className="btn btn-primary" onClick={this.onSubmit}>
            Submit
          </button>
        </div>
      </div>
    )
  }
}

export default Login
