<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Farmer</title>
    <style>

        body{
            font-weight:900 !important;
            background-image: url('{{asset('image/farm.png')}}');
            height: 99vh;overflow: hidden;
            background-repeat: no-repeat, repeat;
            background-size: cover !important;
        }
        .boardDiv{
            background-color: rgba(255,255,255,0.6);
            overflow: auto;
            width: 98%;
            height: 70%;
            display: flex;
            margin-top: 1vh;
            margin-left: auto;
            margin-right: auto;
            border: 3px solid black;
        }

        .bottomPanel{
            height: 25% !important;
            width: 98% !important;
            margin-top: 2vh !important;
            display: flex;
            margin-left: auto;
            margin-right: auto;
        }

        .playerInfoDiv{
            border: 2px solid black;
            overflow: auto;
            float:left;
            background-color: rgba(255,255,255,0.6);
            width: 25%;

        }

        .menuDiv{
            border: 2px solid black;
            float:right;
            background-color: rgba(255,255,255,0.6);
            margin-left: auto !important;
            width: 70%;
        }

        label{
            font-family: fantasy;
            font-size: 25px;
        }

    </style>
    @livewireStyles
</head>

<body>

<div class="boardDiv">
    @livewire('players-list',['farm' =>$farm])
</div>

<div class="bottomPanel">
    <div class="playerInfoDiv" style="text-align: center">
        @livewire('player-info',['farm' =>$farm])
    </div>

    <div class="menuDiv menuSizeDIv">
        @livewire('user-interface',['gameID'=>$gameID])
    </div>
</div>
@livewireScripts
</body>

</html>
