@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
Here is your today's report!

Click below to download
@component('mail::button', ['url' => $link])
Download report
@endcomponent
Sincerely,
NyembazIMS.
@endcomponent
