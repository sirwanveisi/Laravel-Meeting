@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}

<p>{{ $payment->status == 'completed' ? __('Payment completed') : __('Payment cancelled') }}</p>

<p>{{$payment->status == 'completed' ? (__('The payment was successful') . ' ' . __('Thank you!')) : __('The payment was cancelled')}}</p>

<p>{{ __('Thank you') }}</p>

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
