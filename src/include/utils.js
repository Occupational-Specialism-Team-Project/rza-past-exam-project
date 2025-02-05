console.log("hello world!");

function get_booked_days(month) {
    console.log("getting booked days!");
    if (month == null) {
        console.log("month is null");
        return;
    } else {
        console.log(month);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('calendar').innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "get_booked_days.php?month=" + month, true);
        xmlhttp.send();
    }
}