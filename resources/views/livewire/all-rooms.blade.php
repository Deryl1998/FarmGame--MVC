
<div class="testbox" wire:poll.2000ms>
    <table>
        <tr>
            <td>Nazwa pokoju</td>
            <td>Gracz 1</td>
            <td>Gracz 2</td>
            <td>Gracz 3</td>
            <td>Gracz 4</td>
            <td></td>
        </tr>
        @foreach($rooms as $room)
            <tr style="font-size: 2vw !important;">
                <th style="padding: 2vw"> {{$room['name']}}</th>

                @foreach($room->getUsers() as $user)
                    <th style="padding: 2vw">
                        @if($user['name']!="") {{$user['name']}}
                        @else wolne
                        @endif
                    </th>
                @endforeach
                <th>
                    <button wire:click="redirectToRoom({{ $room['id'] }})">
                        Dołącz
                    </button>
                </th>
            </tr>
        @endforeach
    </table>
</div>





