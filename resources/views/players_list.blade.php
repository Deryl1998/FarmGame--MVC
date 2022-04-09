
<table id="players_list" class="table" style="border-width: 2px; text-align: center; width: 100% !important;">
<thead>
<tr style="font-size: 20px;">
    <td style="padding: 0.2rem" scope="col">Name</td>
    <td style="padding: 0.2rem" scope="col">Rabbits</td>
    <td style="padding: 0.2rem" scope="col">Sheep</td>
    <td style="padding: 0.2rem" >Pigs</td>
    <td style="padding: 0.2rem" >Cows</td>
    <td style="padding: 0.2rem" >Horses</td>
    <td style="padding: 0.2rem" >Small Dogs</td>
    <td style="padding: 0.2rem" >Big Dogs</td>
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

<tbody style="font-size: 30px !important;">
<tr style="background-color: rgba(0,0,0,0.2)">
<th> Farm</th>
<td> {{$farm['rabbits']}}</td>
<td> {{$farm['sheep']}}</td>
<td> {{$farm['pigs']}}</td>
<td> {{$farm['cows']}}</td>
<td> {{$farm['horses']}}</td>
<td> {{$farm['small_dogs']}}</td>
<td> {{$farm['big_dogs']}}</td>
</tr>
@foreach($players as $player)
<tr style="font-size: 25px !important;">
    <th> {{$player['name']}}</th>
    <td> {{$player['rabbits']}}</td>
    <td> {{$player['sheep']}}</td>
    <td> {{$player['pigs']}}</td>
    <td> {{$player['cows']}}</td>
    <td> {{$player['horses']}}</td>
    <td> {{$player['small_dogs']}}</td>
    <td> {{$player['big_dogs']}}</td>
</tr>
@endforeach
</tbody>
</table>



