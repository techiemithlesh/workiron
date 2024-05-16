@component('mail::message')
# Dear User,

Your vehicle inspection report is ready. Please download the attached PDF:

[Download PDF]({{ $pdfUrl }})

Thanks,<br>
{{ config('app.name') }}
@endcomponent
