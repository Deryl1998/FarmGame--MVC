
<table id="players_list" class="table" wire:poll.400ms style="border-width: 2px; text-align: center; width: 100% !important;">
<thead>
<tr style="font-size: 2vw;">
    <td style="padding: 0.2rem">Gracz</td>
    <td style="padding: 0.2rem">Króliki</td>
    <td style="padding: 0.2rem"> Owce</td>
    <td style="padding: 0.2rem" >Świnie</td>
    <td style="padding: 0.2rem" >Krowy</td>
    <td style="padding: 0.2rem" >Konie</td>
    <td style="padding: 0.2rem" >Mały pies</td>
    <td style="padding: 0.2rem" >Duży pies</td>
</tr>
<tr style="background-color: transparent;">
    <td></td>
    <td> <img style="background: transparent;" src="{{URL::asset('/image/rabbit.png')}}" alt="profile Pic" height="80" width="80"></td>
    <td> <img src="{{URL::asset('/image/sheep.png')}}" alt="profile Pic" height="80" width="80"></td>
    <td> <img src="{{URL::asset('/image/pig.png')}}" alt="profile Pic" height="80" width="80"></td>
    <td> <img src="{{URL::asset('/image/cow.png')}}" alt="profile Pic" height="80" width="80"></td>
    <td> <img src="{{URL::asset('/image/horse.png')}}" alt="profile Pic" height="80" width="80"></td>
    <td> <img src="{{URL::asset('/image/small_dog.png')}}" alt="profile Pic" height="80" width="80"></td>
    <td> <img src="{{URL::asset('/image/big_dog.png')}}" alt="profile Pic" height="80" width="80"></td>
</tr>
</thead>

<tbody>
<tr style="font-size: 3.2vw !important;color: #641f05;;border-top: 1px;border-bottom: 6px; border-style: solid !important;">
<th> Zagroda</th>
<td> {{$farm['rabbits']}}</td>
<td> {{$farm['sheep']}}</td>
<td> {{$farm['pigs']}}</td>
<td> {{$farm['cows']}}</td>
<td> {{$farm['horses']}}</td>
<td> {{$farm['small_dogs']}}</td>
<td> {{$farm['big_dogs']}}</td>
</tr>
@foreach($players as $player)
    @if($player!=null)
<tr style="font-size: 3vw !important;border: #000000">
    <th> {{$player->getPlayerName()}}</th>
    <td> {{$player['rabbits']}}</td>
    <td> {{$player['sheep']}}</td>
    <td> {{$player['pigs']}}</td>
    <td> {{$player['cows']}}</td>
    <td> {{$player['horses']}}</td>
    <td> {{$player['small_dogs']}}</td>
    <td> {{$player['big_dogs']}}</td>
</tr>
    @endif
@endforeach
</tbody>
</table>



