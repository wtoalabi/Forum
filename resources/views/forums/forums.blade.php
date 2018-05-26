@component('layouts.app') @slot('title') Forums Page @endslot

<forum-home loggedinuser={{auth()->id()}} isadmin={{auth()->user()->isAdmin()}}></forum-home>

@endcomponent