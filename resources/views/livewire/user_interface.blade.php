<div wire:poll.1000ms xmlns:wire="http://www.w3.org/1999/xhtml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .button {
                display: block;
                font-size: 2.5vw !important;
                width: auto !important;
                min-width: 100px !important;
                padding: 1vw;
                padding-top: 15px!important;
                height: auto !important;
                min-height: 60px !important;
                text-align: center;
                color: black;
                border: 3px solid black;
                text-decoration: none;
                background-color: rgba(255,255,255,0.7);
            }
            .divItem{
                visibility: inherit;
                display: inline-block;
                margin: 0.2vw !important;
                width:  auto !important;
                height: auto !important;
            }

            .childDiv{
                align-items: center !important;
                justify-content: center !important;
                width: 100%;
                height: 100%;
            }

            a.snapchat {
                position: relative;
                background: lightgrey;
            }

            a.snapchat img {
                visibility: hidden;
                position: fixed;
                opacity: 0;
                width: auto;
                height: auto;
                right: 1%;
                top: 40%;
                transition: opacity .5s, top .5s;
            }

            a.snapchat:hover img {
                visibility: visible;
                background-color: rgba(255,255,255,0.8);
                opacity: 1;
                top: 1%;
            }

        </style>

    @if($endRound && !$endGame)
        @if(!$handelMenu)
            <div id="mainMenu" class="childDiv" style="float: left; display: flex;overflow: auto;margin-top: 2vh">
                <div class="childDiv" style="display:inline-flex;">
                    <div style="margin: 1vw !important;" id="tradeBtn" class="divItem"> <a wire:click="tradeMenuDisplay()" class="button"> Wymień zwierzę </a></div>
                    <div style="margin: 1vw !important;" id="trowBtn" class="divItem"> <a class="button" wire:click="throwDice()" >Rzuć kościami</a></div>
                </div>
            </div>
        @endif
        @if($handelMenu && !$playerPickToTrade)
            <div id="tradeMenu" class="childDiv" style="float: left;overflow: auto;margin-top: 2%">
                <div class="childDiv" style="display:inline-flex;">
                    <div class="divItem"><a wire:click="tradeMenuDisplay()" class="button"> Cofnij </a></div>
                    @foreach(\App\Models\GameRules::$animalsToTrade as $animal)
                        <div class="btn divItem" style="border-color: darkred;border-width: 2px ">
                            <a wire:click="tradeForm( '{{$animal}}' )"><img style="width: 4.2vw; height: 10vh;" src="{{\App\Models\GameRules::getImage($animal)}}" alt="profile Pic" ></a>
                        </div>
                    @endforeach
                    <div class="btn divItem">
                        <a class="button snapchat" style="font-weight: 800 !important;"> INFO <img src="{{URL::asset('/image/tradeTable.png')}}" alt="profile Pic"> </a>
                    </div>
                </div>
            </div>
            @endif

        @if($handelMenu && $playerPickToTrade)
            <div id="tradeDiv" class="childDiv" style="float: left;overflow: auto;">
                <div class="childDiv" style="display:inline-flex;margin-top: 2vh">
                    <div class="divItem"><a wire:click="pickToTradeHidden()" class="button"> Cofnij </a> </div>
                    <div class="btn divItem" style="border-color: darkred;border-width: 3px;font-size: 30px;font-family: fantasy;">
                        <img src="{{\App\Models\GameRules::getImage($currentAnimal)}}" alt=""  style="height:8vh; width:4vw;"><br>
                        <label style="font-size: 1.5vw" >waluta </label>
                    </div>
                    <div class="btn" style="margin-left: 4px; border-color: #02000c;border-width: 2px; display: inline-flex">
                    @foreach(\App\Models\GameRules::$tradeArray[$currentAnimal]  as $animal)
                            <div class="btn divItem">
                                <label style="font-size: 1.2vw" >{{$this->returnTextPrice($animal[1])}}</label><br>
                                <img src="{{\App\Models\GameRules::getImage($animal[0])}}" alt="profile Pic"  style="height:8vh; width:4vw;"><br>
                                <input style="border: 3px solid black;margin-top: 1vh; background-color: rgba(255,255,255,0.7);" wire:click="trade('{{$currentAnimal}}','{{$animal[0]}}',{{$animal[1]}} )" type="button" value="Potwierdź">
                            </div>
                    @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if(!$endRound && !$endGame)
        @if($throw1 != null && $throw2!=null)
            <div class="btn" style= "display: inline-flex">
                <div class="btn divItem">
                <label style="font-size: 3vw" >Wyrzucono: </label>
                </div>
            <div id="greenCell" class="btn divItem" style="border-color: green !important; border-width: medium !important;">
                <img style="height:15vh; width:8vw;" src="{{\App\Models\GameRules::getImage($throw1)}}" alt="profile Pic">
            </div>
            <div id="redCell" class="btn divItem"  style="border-color: red !important; border-width: medium !important;">
                <img style="height:15vh; width:8vw;" src="{{\App\Models\GameRules::getImage($throw2)}}" alt="profile Pic">
            </div>
            </div>
        @endif
    @endif

    @if($endGame)
        <div id="winnerMenu" class="childDiv" style="float: left;overflow: auto;height: 24vh">
            <div style="float: left; width: 50%">
                <p style="font-size: 6vh;margin-left: 10%;width: auto !important;">Zwyciezca:<br> {{$currentPlayerName}}</p>
            </div>
            <div  style="float: right !important;width: 30%;margin-top: 5vh;margin-right: 15%">
                <form action="{{action('App\Http\Controllers\gamePlayController@playAgain')}}" method="POST" role="form">
                @csrf <!-- {{ csrf_field() }} -->
                    <input class="button" style="font-size: 30px; width: auto !important;" type="submit" value="Zagraj ponownie">
                </form>
            </div>
        </div>
    @endif

</div>
