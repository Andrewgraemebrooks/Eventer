import React from 'react'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import PrivateRoute from './PrivateRoute'
import Header from './components/Header/Header'
import Footer from './components/Footer/Footer'
import Home from './views/Home/Home'
import Register from './views/Register/Register'
import Login from './views/Login/Login'
import Dashboard from './views/User/Dashboard'

function App(props) {
  return (
    <BrowserRouter>
      <div className="App">
        <Header />
        <Switch>
          <Route exact path="/" component={Home} />
          <Route exact path="/register" component={Register} />
          <Route exact path="/login" component={Login} />
          <PrivateRoute exact path="/dashboard" component={Dashboard} />
        </Switch>
        <Footer />
      </div>
    </BrowserRouter>
  )
}

export default App
