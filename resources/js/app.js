import React from 'react'
import { BrowserRouter, Route } from 'react-router-dom'
import Header from './components/Header/Header'
import Footer from './components/Footer/Footer'
import Home from './views/Home/Home'
import Register from './views/Register/Register'
import Login from './views/Login/Login'

function App(props) {
  return (
    <BrowserRouter>
      <div className="App">
        <Header />
        <Route exact path="/" component={Home} />
        <Route exact path="/register" component={Register} />
        <Route exact path="/login" component={Login} />
        <Footer />
      </div>
    </BrowserRouter>
  )
}

export default App
