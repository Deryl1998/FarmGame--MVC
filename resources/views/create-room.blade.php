

<div class="testbox"  >
    <form action="{{action('App\Http\Controllers\RoomController@createWaitingRoom')}}" method="POST" role="form">
    @csrf <!-- {{ csrf_field() }} -->
        <h1>Utwórz pokój</h1>
        <input wire:model="name" name="name" class="name" type="text" placeholder="wpisz nazwe">
        <div class="btn-block">
            <input type="submit" value="Potwierdź" />
        </div>
    </form>
</div>
