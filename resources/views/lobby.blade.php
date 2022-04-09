<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Ustawienia rozgrywki</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        html, body {
            min-height: 100%;
        }
        body, div, form, input, select {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
            line-height: 22px;
        }
        h1, h4 {
            margin: auto;
            font-weight: 400;
        }
        h4 {
            margin: 20px 0 4px;
            font-weight: 400;
        }
        span {
            color: red;
        }
        .small {
            font-size: 10px;
            line-height: 18px;
        }
        .testbox {
            margin:auto;
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: inherit;
            padding: 30px;
        }
        form {
            text-align: center;
            width: 100%;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 5px #ccc;
        }
        input {
            margin-top: 20px;
            width:50%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            vertical-align: middle;
        }
        input:hover, textarea:hover, select:hover {
            outline: none;
            border: 1px solid #095484;
            background: #e6eef7;
        }
        .title-block select, .title-block input {
            margin-bottom: 10px;
        }
        select {
            padding: 7px 0;
            border-radius: 3px;
            border: 1px solid #ccc;
            background: transparent;
        }
        select, table {
            width: 50%;
        }
        option {
            background: #fff;
        }
        .day-visited, .time-visited {
            position: relative;
        }
        input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }
        input[type="time"]::-webkit-inner-spin-button {
            margin: 2px 22px 0 0;
        }
        .day-visited i, .time-visited i, input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 8px;
            font-size: 20px;
        }
        .day-visited i, .time-visited i {
            right: 5px;
            z-index: 1;
            color: #a9a9a9;
        }
        [type="date"]::-webkit-calendar-picker-indicator {
            right: 0;
            z-index: 2;
            opacity: 0;
        }
        .question-answer label {
            display: block;
            padding: 0 20px 10px 0;
        }
        .question-answer input {
            width: auto;
            margin-top: -2px;
        }
        th, td {
            width: 18%;
            padding: 15px 0;
            border-bottom: 1px solid #ccc;
            text-align: center;
            vertical-align: unset;
            line-height: 18px;
            font-weight: 400;
            word-break: break-all;
        }
        .first-col {
            width: 25%;
            text-align: left;
        }
        textarea {
            width: calc(100% - 6px);
        }
        .btn-block {
            margin-top: 20px;
            text-align: center;
        }
        button {
            width: 150px;
            padding: 10px;
            border: none;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            background-color: #095484;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0666a3;
        }
        @media (min-width: 568px) {
            .title-block {
                display: flex;
                justify-content: space-between;
            }
            .title-block select {
                width: 30%;
                margin-bottom: 0;
            }
            .title-block input {
                width: 31%;
                margin-bottom: 0;
            }
            th, td {
                word-break: keep-all;
            }
        }
    </style>
</head>

<body>
<div class="testbox">
    <form action="{{action('App\Http\Controllers\LobbyController@getLobbyForm')}}" method="POST" role="form">
    @csrf <!-- {{ csrf_field() }} -->
        <h1>Ustawienia rozgrywki</h1>
        <h4>Ilośc graczy<span>*</span></h4>
        <select name="players" id="players">
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <h4>Name<span>*</span></h4>
        <input style="visibility:visible" pattern = "^[A-Za-z0-9]{1,30}$" class="name" type="text" name="p1" id="p1" placeholder="Player1" />
        <input style="visibility:visible" pattern = "^[A-Za-z0-9]{1,30}$" class="name" type="text" name="p2" id="p2" placeholder="Player2" />
        <input style="visibility:hidden" pattern = "^[A-Za-z0-9]{1,30}$" class="name" type="text" name="p3" id="p3" placeholder="Player3" />
        <input style="visibility:hidden" pattern = "^[A-Za-z0-9]{1,30}$" class="name" type="text" name="p4" id="p4" placeholder="Player4" />
         <div class="btn-block">
             <input type="submit" value="Graj" />
         </div>
</form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script>
    let p3 = document.getElementById("p3");
    let p4 = document.getElementById("p4");
    let names = [];
    $(document).ready(function() {
        $('select').on('change', function () {
            if(this.value == 3){
                p3.style.visibility= "visible";
                p4.style.visibility= "hidden";
            }
            else if(this.value == 4){
                p3.style.visibility= "visible";
                p4.style.visibility= "visible";
            }
            else{
                p3.style.visibility= "hidden";
                p4.style.visibility= "hidden";
            }
        });

        $("form").submit(function(){
            names = validateText();
            if(names==null) return;
            let count = document.getElementById("players").value;
        });

    });


    function validateText(){
        inputs = document.getElementsByTagName('input');
        for(let i=0;i<inputs.length;i++){
            if(inputs[i].style.visibility==="visible"){
                if(inputs[i].value !== null) {
                    names.push(inputs[i].value)
                }
                else return null;
            }
        }
        return names;
    }

</script>

</body>
</html>