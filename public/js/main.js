/**
 * @type {HTMLElement} An variable to contain the events table element.
 */
const events = document.getElementById("events");
const guestButton = document.getElementById("guest-button");

/**
 * Event handler to delete an event.
 * @param {MouseEvent} e - The button click.
 */
const deleteEventHandler = (e) => {
  // If the target is the delete button.
  if (e.target.className === "btn btn-danger btn-sm delete-event") {
    // Get the event id from the data-id attribute.
    const id = e.target.getAttribute("data-id");
    // Fetch the symfony 4 delete-event route.
    fetch(`/delete-event/${id}`, {
      method: "DELETE",
    })
      .then((res) => {
        // Once the event has been deleted, reload the page.
        window.location.reload();
      })
      .catch((err) => {
        // If there is an error, log to console.
        console.log(err);
      });
  }
};

// If the events table exist, add the delete event handler.
if (events) {
  events.addEventListener("click", (e) => deleteEventHandler(e));
}

/**
 * Fills in the login fields with the guest account information
 * @param {MouseEvent} e - The button click.
 */
const guestModeEventHandler = (e) => {
  document.getElementById("inputEmail").value = "guest@guest.com";
  document.getElementById("inputPassword").value = "guest";
};

// If the guest button exists, add the handler
if (guestButton) {
  // Add event handler to the guest-mode button
  guestButton.addEventListener("click", (e) => guestModeEventHandler(e));
}
