@if(Session::has('notif_danger'))
    @component('inc.alert', ['type' => 'warning'])
        {{ Session::get('notif_danger') }}
    @endcomponent
@endif
