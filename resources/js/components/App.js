import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Navbar from './shared/Navbar'
import Landing from './landing/Landing'
import Footer from './shared/Footer'
import Register from './authentication/Register'

class App extends Component {
  render() {
    return (
      <BrowserRouter>
        <Navbar />
        <Switch>
          <Route exact path="/" component={Landing} />
          <Route exact path="/register" component={Register} />
        </Switch>
        <Footer />
      </BrowserRouter>
    )
  }
}

ReactDOM.render(<App />, document.getElementById('app'))
