function validateZooBooking() {
    // Get <input> elements
    let startDatetime = $("#start_datetime");
    let endDatetime = $("#end_datetime");
    let numberOfPeople = $("#number_of_people");

    // Get <input> values as variables so we can validate the values
    let startDatetimeValue = startDatetime.val();
    let endDatetimeValue = endDatetime.val();
    let numberOfPeopleValue = numberOfPeople.val();

    // Get datetime <input> values in seconds since 1970 (UNIX time) so we can compare them
    let startDatetimeUnix = new Date(startDatetimeValue).getTime();
    let endDatetimeUnix = new Date(endDatetimeValue).getTime();
    // Get current/present datetime in UNIX time so it can be compared
    let currentDatetimeUnix = Date.now();

    // Validate start datetime
    if (startDatetimeValue == "") { // Presence Check
        showValidationMessage(startDatetime, "Value cannot be empty.");
    } else if (startDatetimeUnix > endDatetimeUnix) { // Consistency Check
        showValidationMessage(startDatetime, `Start time (${startDatetimeValue.replace("T", " ")}) cannot be later than end time (${endDatetimeValue.replace("T", " ")}).`);
    } else if (startDatetimeUnix < currentDatetimeUnix) { // Consistency Check
        showValidationMessage(startDatetime, `End time (${startDatetimeValue.replace("T", " ")}) cannot be earlier than the present.`);
    } else {
        showValidationMessage(startDatetime);
    }

    // Validate end datetime
    if (endDatetimeValue == "") { // Presence Check
        showValidationMessage(endDatetime, "Value cannot be empty.");
    } else if (endDatetimeUnix < startDatetimeUnix) { // Consistency Check
        showValidationMessage(endDatetime, `End time (${endDatetimeValue.replace("T", " ")}) cannot be earlier than start time (${startDatetimeValue.replace("T", " ")}).`);
    } else if (endDatetimeUnix < currentDatetimeUnix) { // Consistency Check
        showValidationMessage(endDatetime, `End time (${endDatetimeValue.replace("T", " ")}) cannot be earlier than the present.`);
    } else {
        showValidationMessage(endDatetime);
    }

    // Validate both times
    let bookDurationSeconds = (Math.floor(endDatetimeUnix) / 1000) - (Math.floor(startDatetimeUnix) / 1000);
    if (bookDurationSeconds > MAX_TICKET_DURATION) { // Length Check
        showValidationMessage(startDatetime, `The duration between start time and end time (${bookDurationSeconds}) cannot be greater than the max ticket duration (${MAX_TICKET_DURATION} in seconds).`)
        showValidationMessage(endDatetime, `The duration between start time and end time (${bookDurationSeconds}) cannot be greater than the max ticket duration (${MAX_TICKET_DURATION} in seconds).`)
    }

    if (numberOfPeopleValue == "") { // Presence Check
        showValidationMessage(numberOfPeople, "Value cannot be empty.");
    } else if (numberOfPeopleValue < 1) { // Length Check
        showValidationMessage(numberOfPeople, `The number of people visiting (${numberOfPeopleValue}) must be at least 1.`);
    } else if (numberOfPeopleValue > MAX_ZOO_VISITORS) { // Consistency Check
        showValidationMessage(numberOfPeople, `The number of people visiting (${numberOfPeopleValue}) cannot be greater than the max daily visitors (${MAX_ZOO_VISITORS}).`);
    } else {
        showValidationMessage(numberOfPeople);
    }
}

function showValidationMessage(inputElement, error_message) {
    // Get the feedback <div> that corresponds to the <input> element
    try {
        var feedbackDiv = $("#" + inputElement.attr("id") + "_feedback");
    } catch (error) {
        console.error("Couldn't get feedback div: " + error);
        return;
    }

    // Apply the class to the feedback div and remove the old one
    classApplied = !error_message ? "is-valid" : "is-invalid";
    classRemoved = !error_message ? "is-invalid" : "is-valid";
    try {
        inputElement.addClass(classApplied);
        inputElement.removeClass(classRemoved);
    } catch (error) {
        console.error("Couldn't apply class to input element: " + error);
        return;
    }
    feedbackDiv.html(error_message); // Give the feedback div the error message

    return true;
}
