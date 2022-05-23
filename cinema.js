document.addEventListener('DOMContentLoaded', (event) => {



    document.getElementById("filmInfo").innerHTML = film + " - " + date + " - " + hour

    document.getElementById("filmName").value = film
    document.getElementById("filmDate").value = date
    document.getElementById("filmHour").value = hour


    //draw
    var tablica = document.createElement("table")
    var letter = 0
    var alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P"]
    for (var i = 0; i < 15; i++) {
        var row = document.createElement("div")
        for (var j = 0; j < 17; j++) {
            var seat = document.createElement("td")
            if (!j || j == 16) {
                seat.style.border = "0"
                seat.style.background = "#fff"
                seat.style.color = "#000"
                seat.innerHTML = alphabet[letter];
                if (j == 16)
                    letter++


            } else {
                seat.setAttribute("data-row", j)
                seat.setAttribute("data-col", alphabet[letter])
                seat.className = "seat"
                seat.innerHTML = j;
                // seat.style.color = "#fff"

                for (let m = 0; m <= booked.length; m++) {

                    if (j + alphabet[letter] == booked[m]) {
                        seat.className = "";
                        seat.style.background = "#737374"

                    }
                }
            }
            row.appendChild(seat)
        }
        tablica.appendChild(row)
    }

    document.getElementById("sala").appendChild(tablica)



})
// var reserved = []
var colBook = null
var rowBook = null

var oldTd = 0;
document.querySelector("#sala").addEventListener("click", function (event) {
    var td = event.target;
    while (td !== this && !td.matches("td")) {
        td = td.parentNode;
    }
    if (td === this) {
        console.log("No table cell found");
    } else {
        if (td.className == "seat active") {
            td.className = "seat"
            // const index = reserved.indexOf(td.id);
            // reserved.splice(index, 1);
            colBook = null;
            rowBook = null;
            document.getElementById("col").value = colBook
            document.getElementById("row").value = rowBook

        } else if (td.className == "seat") {
            if (oldTd != 0) {
                oldTd.className = ("seat")
            }
            td.className = "seat active"
            // reserved.push(td.id)
            colBook = td.dataset.col
            rowBook = td.dataset.row

            oldTd = td;
            document.getElementById("col").value = colBook
            document.getElementById("row").value = rowBook
        }


    }

});