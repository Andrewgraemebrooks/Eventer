import axios from 'axios'
import React, { Component } from 'react'
import { version } from 'react-dom'

class Register extends Component {
  constructor(props) {
    super(props)
    this.state = {
      name: '',
      email: '',
      password: '',
      password_confirm: '',
      errors: [],
    }
  }

  handleFieldChange(event) {
    this.setState({
      [event.target.name]: event.target.value,
    })
  }

  handleCreateNewUser(event) {
    event.preventDefault()

    const history = this.props

    const user = {
      name: this.state.name,
      email: this.state.email,
      password: this.state.password,
      password_confirm: this.state.password_confirm,
    }

    // if (user.password !== user.password_confirm) {
    //   this.setState({
    //     [errors[field][0]]: 'The password confirmation does not match.',
    //   })
    //   this.renderErrorFor('password')
    // }

    axios
      .post('/register', user)
      .then(response => {
        // Redirect to home page
        // history.push('/')
      })
      .catch(error => {
        this.setState({ errors: error.response.data.errors })
      })
  }

  hasErrorFor(field) {
    return !!this.state.errors[field]
  }

  renderErrorFor(field) {
    if (this.hasErrorFor(field)) {
      return (
        <span className="invalid-feedback">
          <strong>{this.state.errors[field][0]}</strong>
        </span>
      )
    }
  }

  render() {
    return (
      <div className="content-container container-fluid">
        <div className="row justify-content-center">
          <div className="col">
            <div className="card">
              <div className="card-header">Register</div>
              <div className="card-body">
                <form onSubmit={e => this.handleCreateNewUser(e)}>
                  <div className="form-group row">
                    <label className="col-md-4 col-form-label text-md-right">
                      Name
                    </label>
                    <div className="col-md-6">
                      <input
                        id="name"
                        type="text"
                        className={`form-control ${
                          this.hasErrorFor('name') ? 'is-invalid' : ''
                        }`}
                        name="name"
                        required
                        onChange={e => this.handleFieldChange(e)}
                      />
                      {this.renderErrorFor('name')}
                    </div>
                  </div>
                  <div className="form-group row">
                    <label className="col-md-4 col-form-label text-md-right">
                      Email Address
                    </label>
                    <div className="col-md-6">
                      <input
                        id="email"
                        type="email"
                        className={`form-control ${
                          this.hasErrorFor('email') ? 'is-invalid' : ''
                        }`}
                        name="email"
                        required
                        onChange={e => this.handleFieldChange(e)}
                      />
                      {this.renderErrorFor('email')}
                    </div>
                  </div>
                  <div className="form-group row">
                    <label className="col-md-4 col-form-label text-md-right">
                      Password
                    </label>
                    <div className="col-md-6">
                      <input
                        id="password"
                        type="password"
                        className={`form-control ${
                          this.hasErrorFor('password') ? 'is-invalid' : ''
                        }`}
                        name="password"
                        required
                        onChange={e => this.handleFieldChange(e)}
                      />
                      {this.renderErrorFor('password')}
                    </div>
                  </div>
                  <div className="form-group row">
                    <label className="col-md-4 col-form-label text-md-right">
                      Confirm Password
                    </label>
                    <div className="col-md-6">
                      <input
                        id="password-confirm"
                        type="password"
                        className="form-control"
                        name="password-confirm"
                        onChange={e => this.handleFieldChange(e)}
                        required
                      />
                    </div>
                  </div>
                  <div className="form-group row mb-0">
                    <div className="col-md-6 offset-md-4">
                      <button type="submit" className="btn btn-primary">
                        Register
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default Register
