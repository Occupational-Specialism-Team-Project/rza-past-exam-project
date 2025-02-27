function get_booked_days(month, potential_visitors, callback) {
    if (month == null) {
        console.log("Error - month field is NULL");
        return;
    } else {
        if (potential_visitors == null) {
            potential_visitors = 1;
        }
        $.ajax({
            url: "get_booked_days.php",
            type: "GET",
            data: {
                month: month,
                potential_visitors: potential_visitors,
            },
            dataType: "json",
            success: callback,
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            },
        });
    }
}

function createDays(data) {
    $("#daysOfTheMonth").empty();
    for (let n = 1; n <= (Object.keys(data).length); n++) {
        var newDay = document.createElement("div");
        newDay.id = "day" + n;
        newDay.classList.add("border", "border-dark", "rounded", "calendar_day", "text-center", "align-items-center", "bg-success-subtle");
        newDay.innerHTML = n;

        // Check if day is fully booked up
        let day = data[n];
        if (day) {
            newDay.classList.remove("bg-success-subtle");
            newDay.classList.add("bg-danger-subtle", "fw-bold");

            // Add indicator that day is booked up beyond just using colour (see WCAG)
            var fullIndicator = document.createElement("i");
            fullIndicator.innerHTML = " (full)";
            fullIndicator.classList.add("fw-normal");
            newDay.append(fullIndicator);
        }

        $("#daysOfTheMonth").append(newDay);
    }
}

function initialCalendarDisplay() {
    let currentDate = new Date();
    let currentMonth = (currentDate.getMonth() < 10 ? '0' : '') + (currentDate.getMonth() + 1);
    let monthValue = `${currentDate.getFullYear()}-${currentMonth}`;

    let month = $("#month");
    month.value = monthValue;
    month.min = monthValue;
    let potential_visitors = $("#potential_visitors");
    potential_visitors.value = 1;
    get_booked_days(month.value, potential_visitors.value, function(data) {
        createDays(data);
    });
}

initialCalendarDisplay();
let visitors_text = document.getElementById('visitors_live_count');
visitors_text.innerHTML = document.getElementById('potential_visitors').value;