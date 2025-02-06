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