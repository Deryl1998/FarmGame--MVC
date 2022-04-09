<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<head>
    <style>
        .button {
            display: block;
            width: 100px !important;
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
            margin: 2px !important;
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
            background-color: rgba(100,255,50,0.7);
            opacity: 1;
            top: 1%;
        }

    </style>
</head>
    <div id="mainMenu" class="childDiv" style="float: left; display: flex;overflow: auto;">
        <div class="childDiv" style="display:inline-flex;">
            <div class="divItem"> <a onclick="changeVisibilityMenu()" class="button"> Trade </a></div>
            <div class="divItem"> <a class="button" href="{{URL::to('throw')}}">Throw</a></div>
            <div id="greenCell" class="btn divItem" style="visibility: hidden;border-color: green !important; border-width: medium !important;">
                <img id="img1" src="{{URL::asset('/image/rabbit.png')}}" alt="profile Pic" height="100" width="100">
            </div>
            <div id="redCell" class="btn divItem"  style="visibility: hidden;border-color: red !important; border-width: medium !important;">
                <img id="img2" src="{{URL::asset('/image/rabbit.png')}}" alt="profile Pic" height="100" width="100">
            </div>
        </div>
    </div>

    <div id="tradeMenu" class="childDiv" style="float: left; display: none;overflow: auto;">
        <div class="childDiv" style="display:inline-flex;">
            <div class="divItem"><a onclick="changeVisibilityMenu()" class="button"> Back </a></div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px "> <a onclick="tradeForm('rabbit')"><img src="{{URL::asset('/image/rabbit.png')}}" alt="profile Pic" height="80" width="80"></a> </div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px "> <a onclick="tradeForm('sheep')"><img src="{{URL::asset('/image/sheep.png')}}" alt="profile Pic" height="80" width="80"></a></div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px "> <a onclick="tradeForm('pig')"><img src="{{URL::asset('/image/pig.png')}}" alt="profile Pic" height="80" width="80"></a></div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px "> <a onclick="tradeForm('cow')"><img src="{{URL::asset('/image/cow.png')}}" alt="profile Pic" height="80" width="80"></a></div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px "> <a onclick="tradeForm('horse')"><img src="{{URL::asset('/image/horse.png')}}" alt="profile Pic" height="80" width="80"></a></div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px "> <a onclick="tradeForm('small_dog')"><img src="{{URL::asset('/image/small_dog.png')}}" alt="profile Pic" height="80" width="80"></a></div>
            <div class="btn divItem" style="border-color: darkred;border-width: 2px " > <a onclick="tradeForm('big_dog')"><img src="{{URL::asset('/image/big_dog.png')}}" alt="profile Pic" height="80" width="80"></a></div>
            <div style="display: inline-block; margin-top: 2px; margin-left: 15px; visibility: inherit; height: 80px !important;">
                <a class="snapchat button"> INFO <img src="{{URL::asset('/image/tradeTable.png')}}" alt="profile Pic"> </a><br>
            </div>
        </div>
    </div>

    <div id="tradeDiv" class="childDiv" style="float: left; display: none;overflow: auto;">
        <div class="childDiv" style="display:inline-flex;">
            <div class="divItem"><a onclick="changeVisibilityTradeMenu()" class="button"> Back </a> </div>
            <div class="btn divItem" style="border-color: darkred;border-width: 3px"><img id="currentAnimal" src="{{URL::asset('/image/sheep.png')}}" alt="" height="80" width="80"></div>
            <div class="btn" style="margin-left: 4px; border-color: #02000c;border-width: 2px; display: inline-flex">
            <div class="btn divItem" id="rabbit">
                <img src="{{URL::asset('/image/rabbit.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="rabbitl"></label><br>
                <input style="width: 50px" type="button" onclick="trade('rabbits','rabbitl')" id="rabbitInput" name="rabbitInput" value="-">
            </div>
            <div class="btn divItem" id="sheep">
                <img src="{{URL::asset('/image/sheep.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="sheepl"></label><br>
                <input type="button" id="sheepInput" onclick="trade('sheep','sheepl')" name="sheepInput" value="-">
            </div>
            <div class="btn divItem" id="pig" >
                <img src="{{URL::asset('/image/pig.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="pigl"></label><br>
                <input type="button" id="pigInput" onclick="trade('pigs','pigl')" name="pigInput" value="-"><br>
            </div>
            <div class="btn divItem" id="cow" >
                <img src="{{URL::asset('/image/cow.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="cowl"></label><br>
                <input type="button" id="cowInput" onclick="trade('cows','cowl')" name="cowInput" value="-">
            </div>
            <div class="btn divItem" id="horse" >
                <img src="{{URL::asset('/image/horse.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="horsel"></label><br>
                <input type="button" id="horseInput"  onclick="trade('horses','horsel')" name="horseInput" value="-">
            </div>
            <div class="btn divItem" id="small_dog" >
                <img src="{{URL::asset('/image/small_dog.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="small_dogl"></label><br>
                <input type="button" id="small_dogInput" onclick="trade('small_dogs','small_dogl')" name="small_dogInput" value="-">
            </div>
            <div class="btn divItem" id="big_dog" >
                <img src="{{URL::asset('/image/big_dog.png')}}" alt="profile Pic" height="80" width="80"><br>
                <label id="big_dogl"></label> <br>
                <input type="button" id="big_dogInput"  onclick="trade('big_dogs','big_dogl')" name="big_dogInput" value="-">
            </div>
            </div>
        </div>
    </div>

    <div id="winnerMenu" class="childDiv" style="float: left; display: none;overflow: auto">
        <p style="font-size: 45px; padding-right: 20px"> Winner:</p>
        <p style="font-size: 55px">{{$currentPlayer}}</p>
        <div class="divItem" style="float: right !important; margin-left: 10% !important;">
            <form action="{{action('App\Http\Controllers\gamePlayController@playAgain')}}" method="POST" role="form">
            @csrf <!-- {{ csrf_field() }} -->
                <input class="button" style="font-size: 30px; width: auto !important;" type="submit" value="Play again">
            </form>
        </div>
    </div>

    <div style="visibility: hidden">
    <form action="{{action('App\Http\Controllers\gamePlayController@trade')}}" method="POST" role="form">
    @csrf {{ csrf_field() }}
        <input type="hidden" name="animalToTrade" id="animalToTrade"/>
        <input type="hidden" name="forAnimal" id="forAnimal"/>
        <input type="hidden" name="number" id="number"/>
        <input id="postTrade" type="submit">
    </form>
    </div>
    <script>
        const tradeArray ={
            rabbit:{
                ship:-6,
                pig:-12,
                cow:-36,
                small_dog:-6,
                big_dog:-36
            },
            sheep:{
                rabbit:6,
                pig:-2,
                cow:-6,
                horse:-12,
                small_dog:-1,
                big_dog:-6
            },
            pig:{
                rabbit:12,
                sheep:2,
                cow:-3,
                horse:-6,
                small_dog:-3
            },
            cow:{
                rabbit:36,
                sheep:6,
                pig:3,
                horse:-2,
                big_dog:-1
            },
            horse:{
                sheep:12,
                pig:6,
                cow:2,
            },
            small_dog:{
                rabbit: 6,
                sheep: 1,
            },
            big_dog:{
                rabbit:36,
                sheep:6,
                pig:3,
                cow:1,
            }
        }
        const animals = ["rabbit","sheep","pig","cow","horse","small_dog","big_dog"]

        function checkThrows(){
            var element1 = document.getElementById('greenCell');
            var element2 = document.getElementById('redCell');
            var tab = {
                rabbits:"{{URL::asset('/image/rabbit.png')}}",
                cows:"{{URL::asset('/image/cow.png')}}",
                pigs:"{{URL::asset('/image/pig.png')}}",
                sheep:"{{URL::asset('/image/sheep.png')}}",
                horses:"{{URL::asset('/image/horse.png')}}",
                wolf:"{{URL::asset('/image/wolf.png')}}",
                fox:"{{URL::asset('/image/fox.png')}}"
            }
            if("{{$throw1}}"!=='0' && "{{$throw2}}"!=='0'){
                var img1 = document.getElementById('img1');
                var img2 = document.getElementById('img2');
                element1.style.visibility = 'visible';
                element2.style.visibility = 'visible';
                img1.src = tab["{{$throw1}}"];
                img2.src = tab["{{$throw2}}"];
            }
            else{
                element1.style.visibility = 'hidden';
                element2.style.visibility = 'hidden';
            }
        }

        function changeVisibilityMenu(){
            var menu1 = document.getElementById("mainMenu");
            var menu2 = document.getElementById("tradeMenu");
            var pic1 = document.getElementById('greenCell');
            var pic2 = document.getElementById('redCell');

            if(menu1.style.display === 'none') {
                menu1.style.display = 'flex'
                pic1.style.display = 'flex';
                pic2.style.display = 'flex';
            }
            else {
                menu1.style.display = 'none'
                pic1.style.display = 'none';
                pic2.style.display = 'none';
            }
            if(menu2.style.display === 'none') menu2.style.display = 'flex'
            else menu2.style.display = 'none'
        }

        function changeVisibilityTradeMenu(){
            var menu2 = document.getElementById("tradeMenu");
            var trade = document.getElementById("tradeDiv");
            if(trade.style.display === 'none') trade.style.display = 'flex'
            else trade.style.display = 'none'
            if(menu2.style.display === 'none') menu2.style.display = 'flex'
            else menu2.style.display = 'none'
            for(var animalType of animals) {
                var x = document.getElementById(animalType)
                x.style.display = 'none'
            }

        }

        function tradeForm(animal){
            changeVisibilityTradeMenu()
            displayAnimalsToTrade(animal)
        }

        function displayAnimalsToTrade(animal){
            var img = document.getElementById('currentAnimal')
            img.alt= animal !== "sheep" ? animal + 's' : animal;
            img.src="{{URL::asset('/image/')}}"+'/'+animal+'.png'
            const animalsToTrade = tradeArray[animal]
            for(var animalType of animals) {
                var x = document.getElementById(animalType)
                if (animalsToTrade[animalType] != null) {
                    x.style.display = 'inline'
                    var input = document.getElementById(animalType+'Input')
                    var label = document.getElementById(animalType+'l')
                    input.value= animalsToTrade[animalType] >0?'Sell':'Buy'
                    label.textContent = animalsToTrade[animalType]
                }
                else x.style.display = 'none'
            }
        }

        function trade(tradeAnimal,howMuch){
            document.getElementById('animalToTrade').value = document.getElementById('currentAnimal').alt
            document.getElementById('forAnimal').value = tradeAnimal
            document.getElementById('number').value =  document.getElementById(howMuch).textContent
            document.getElementById('postTrade').click();
        }

        function checkWinner(){
            if("{{$isWin}}"==true){
                var mainMenu = document.getElementById("mainMenu");
                var winnerMenu = document.getElementById("winnerMenu");
                mainMenu.style.display = 'none';
                winnerMenu.style.display = 'flex';
            }
        }
        checkWinner()
        checkThrows()
    </script>

