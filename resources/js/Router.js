import React from 'react';
import { Route, Switch } from 'react-router-dom';
import Home from './views/Home/Home';
import Login from './views/Login/Login';
import Register from './views/Register/Register';
import Dashboard from './views/user/Dashboard/Dashboard'
import NotFound from './views/NotFound/NotFound'

const Main = (props) => (
    <Switch>
        {/* User might log in */}
        <Route path="/" component={Home} />

        {/* User will log in */}
        <Route path="/login" component={Login} />
        <Route path="/register" component={Register} />

        {/* User is logged in */}
        {/* <PrivateRoute path="/dashboard" component={Dashboard} /> */}

        {/* Page not found */}
        <Route component={NotFound} />
    </Switch>
);

export default Main;
