function get_booked_days(month, callback) {
    if (month == null) {
        return;
    } else {
        $.ajax({
            url: "get_booked_days.php",
            type: "GET",
            data: {
                month: month,
            },
            dataType: "json",
            success: callback,
            error: function() {
                console.log("error");
            },
        });
    }
}

function createDays(data) {
    console.log();
    for (let n = 1; n <= (Object.keys(data).length); n++) {
        let day = data[n];
        console.log(day);

        var newDay = document.createElement("div");
        newDay.id = "day" + n;
        $("#daysOfTheMonth").append(newDay);
    }
}