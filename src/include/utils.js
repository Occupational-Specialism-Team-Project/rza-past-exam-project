console.log("hello world!");

function get_booked_days(month, callback) {
    console.log("getting booked days!");
    if (month == null) {
        console.log("month is null");
        return;
    } else {
        console.log(month);

        $.ajax({
            url: "get_booked_days.php",
            type: "GET",
            data: {
                month: month,
            },
            dataType: "json",
            success: callback,
            error: function(xhr) {
                console.log("error");
            },
        });
    }
}