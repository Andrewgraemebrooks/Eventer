import React, { Component } from 'react'
import axios from 'axios'
import { useHistory } from 'react-router-dom'

class Register extends Component {
  constructor(props) {
    super(props)
    this.state = {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
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
      .post('/api/auth/signup', userData)
      .then(response => {
        this.props.history.push('/login')
      })
      .catch(error => console.log(error))
  }

  render() {
    return (
      <div id="register-container" className="container">
        <div className="row">
          <label htmlFor="name">Name</label>
          <input
            type="text"
            className="form-control register-input"
            onChange={this.onChange}
            placeholder="Name"
            name="name"
          />
          <label htmlFor="email">Email</label>
          <input
            type="text"
            className="form-control register-input"
            onChange={this.onChange}
            placeholder="Email"
            name="email"
          />
          <label htmlFor="password">Password</label>
          <input
            type="password"
            className="form-control register-input"
            onChange={this.onChange}
            placeholder="Password"
            name="password"
          />
          <label htmlFor="password_confirmation">Confirm Password</label>
          <input
            type="password"
            className="form-control register-input"
            onChange={this.onChange}
            placeholder="Confirm Password"
            name="password_confirmation"
          />
          <button className="btn btn-outline-success" onClick={this.onSubmit}>
            Submit
          </button>
        </div>
      </div>
    )
  }
}

export default Register
