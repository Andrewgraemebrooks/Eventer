import React, { Component } from 'react'
import axios from 'axios'

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
      .then(response => console.log(response))
      .catch(error => console.log(error))
  }

  render() {
    return (
      <div className="container">
        <div className="row">
          <input
            type="text"
            className="form-control"
            onChange={this.onChange}
            placeholder="Name"
            name="name"
          />
          <input
            type="text"
            className="form-control"
            onChange={this.onChange}
            placeholder="Email"
            name="email"
          />
          <input
            type="password"
            className="form-control"
            onChange={this.onChange}
            placeholder="Password"
            name="password"
          />
          <input
            type="password"
            className="form-control"
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
