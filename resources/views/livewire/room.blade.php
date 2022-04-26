
<div  id="room"class="room" wire:poll.2000ms>
    <style>
        button{
            width: auto !important;
        }

        .room{
            width: 50% !important;
            margin-left: auto !important;;
            margin-right: auto !important;
            margin-top: 5vh;
        }
        input{
            width: auto!important;
            text-align: center;
            margin-top: 0;
        }
        .myBtn{
            background-color: #095484;
            font-size: 20px;
            color: white;
            cursor: pointer;
            padding: 10px;
            border: none;
        }
    </style>
    <form action="{{action('App\Http\Controllers\RoomController@createGame')}}" method="POST" role="form">
    @csrf <!-- {{ csrf_field() }} -->
        <h1>Lobby</h1>
        <h4>Gracze: </h4>
        <table class="table" style="border-width: 2px; text-align: center; width: 100% !important;">
            @foreach($users as $user)
                <tr>
                    <td><input  class="name" type="text"  value="{{$user['name']}}" placeholder="wolne miejsce" readonly/></td>
                    @if($isOwnerRoom)
                        <td id="btn1"><input wire:click="removeUser({{$user['id']}})" class="myBtn" type="button" value="usuń gracza"/></td>
                    @endif
                </tr>
            @endforeach
        </table>
        @if($isOwnerRoom)
        <div class="btn-block">
            <input class="myBtn" style="width: 15vw !important;" type="submit" value="Graj" />
        </div>
        @endif
        <div  class="btn-block">
            <input wire:click="leaveRoom({{$currentUser}})" class="myBtn" type="button" value="Wyjdz z pokoju"/>
        </div>
        <script>
        </script>
    </form>
</div>


