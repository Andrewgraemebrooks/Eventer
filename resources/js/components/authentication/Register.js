import React, { Component } from 'react'

class Register extends Component {
  render() {
    return (
      <div className="content-container container-fluid">
        <div className="row justify-content-center">
          <div className="col">
            <div className="card">
              <div className="card-header">Register</div>
              <div className="card-body">
                <form method="POST" action="">
                  <div className="form-group row">
                    <label className="col-md-4 col-form-label text-md-right">
                      Name
                    </label>

                    <div className="col-md-6">
                      <input
                        id="name"
                        type="text"
                        className="form-control"
                        name="name"
                        required
                      />
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
                        className="form-control"
                        name="email"
                        required
                      />
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
                        className="form-control"
                        name="password"
                        required
                      />
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
                        name="password_confirmation"
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
