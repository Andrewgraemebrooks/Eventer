/**
 * Checks to see if app state exists in local storage and returns it as an object.
 * @returns {Object}
 */
const checkAppState = () => {
  let appState
  if (localStorage['appState']) {
    appState = JSON.parse(localStorage['appState'])
  } else {
    appState = { isAuthenticated: false, access_token: '' }
    localStorage['appState'] = JSON.stringify(appState)
  }
  return appState
}

export default checkAppState
