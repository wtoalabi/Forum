@component('layouts.app')
@slot('title')
Forums Page
@endslot

<forum-home loggedinuser={{Auth::id()}}></forum-home>

@endcomponent