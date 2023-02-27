<!-- เลือกตั้งจำเป็น ไฟล์ intro เดิม ตามด้วย __ ( อันเดอสกอ 2 ครั้ง ) -->

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
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("https://chon.go.th/cpao/uploads/bg_chon.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .hero-text {
        text-align: center !important;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }

    .hero-text button {
        border: none;
        outline: 0;
        display: inline-block;
        /* padding: 10px 25px; */
        color: black;
        background-color: #ddd;
        text-align: center;
        cursor: pointer;
    }

    .hero-text button:hover {
        background-color: #555;
        color: white;
    }

    mark.red {
        color: red;
        background: none;
        font-size: 180%;
        -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: white;
    }

    mark.white {
        color: white;
        background: none;
        font-size: 150%;
        -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: black;
    }

    mark.black {
        color: black;
        background: none;
        font-size: 150%;
        -webkit-text-stroke-width: 0.3px;
        -webkit-text-stroke-color: white;
    }

    .c-graidient {
        /* background: #000; */
        background: -moz-linear-gradient(-45deg, #000000 0%, #000000 25%, #1e539e 50%, #ff3083 75%, #7800a8 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(-45deg, #000000 0%, #000000 25%, #1e539e 50%, #ff3083 75%, #7800a8 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(135deg, #000000 0%, #000000 25%, #1e539e 50%, #ff3083 75%, #7800a8 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        background-size: 400% 400%;
        background-repeat: no-repeat;

        justify-content: center;
        align-items: center;
        color: aquamarine;
        position: relative;

    }

    a.cd:hover,
    a.cd:focus {
        color: orangered !important;
        text-decoration: none;
        -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: white;

    }
    </style>
</head>

<body>

    <div class="hero-image">
        <div class="container-fluid">

            <div class="hero-text">
                <a class="c-graidient cd" style="focus-color:aquamarine">
                    <div class="c-graidient__img"></div>
                    <div class="c-graidient__title text-center">
                        <h1 id="head" style="font-size:200%"></h1>
                        <h4 style="color:#00FF7F;-webkit-text-stroke-width: 0.2px;-webkit-text-stroke-color: black;">
                            สู่การเลือกตั้งสมาชิกสภาองค์การบริหารส่วนจังหวัดชลบุรี</h4>
                        <h4 style="color:#00FF7F;-webkit-text-stroke-width: 0.2px;-webkit-text-stroke-color: black;">
                            และนายกองค์การบริหารส่วนจังหวัดชลบุรี</h4>
                        <!-- <h3 id="demo" style = "font-size:300%"></h3> -->
                    </div>
                </a>
                <h4 style="color:white;"><u>เลือกตั้ง 20 ธ.ค. 63</u></h4>
                <button class="btn btn-info btn-sm" onclick="window.location.href ='./home'">เข้าสู่เว็ปไซต์</button>
            </div>
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
        // document.getElementById("demo").innerHTML = days + "D " + hours + "H " +
        //     minutes + "M " + seconds + "S ";


        document.getElementById("head").innerHTML = "<mark class = 'red'>นับถอยหลัง " + (days + 1) +
            " วัน</mark>";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "เริ่มการเลือกตั้ง";
        }
    }, 1000);
    </script>
</body>

</html>