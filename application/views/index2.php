<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@700;800&display=swap" rel="stylesheet">
    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .hero-image {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("bg_chon.jpg");
        height: 50%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .hero-text {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }

    p.countdown {
        text-align: center;
        font-size: 300%;
        color: orange;
        -webkit-text-stroke-width: 0.2px;
        -webkit-text-stroke-color: white;
    }

    mark.red {
        color: red;
        background: none;
        font-size: 120%
    }

    /* 
    .details {
        -webkit-text-stroke-width: 0.1px;
        -webkit-text-stroke-color: white;
    } */
    </style>
</head>

<body>
    <div class="hero-image container">
        <div class="hero-text">
            <h1 id="head"></h1>
            <p id="demo" class="countdown"></p>
            <p class="details" style="font-size:150%;color:#90EE90">
                สู่การเลือกตั้งสมาชิกสภาองค์การบริหารส่วนจังหวัดชลบุรี
                <br>และนายกองค์การบริหารส่วนจังหวัดชลบุรี
            </p>
        </div>
    </div>


    <!-- SCRIPT BOOTSTRAP  -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script>
    // Set the date we're counting down to
    var countDownDate = new Date("Dec 20, 2020 00:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";


        document.getElementById("head").innerHTML = "นับถอยหลัง <mark class ='red'>" + days + "</mark> วัน";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "เริ่มการเลือกตั้ง";
        }
    }, 1000);
    </script>
</body>

</html>