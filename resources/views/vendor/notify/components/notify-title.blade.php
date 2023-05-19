@props(['title'])

<p @class([
    'text-sm leading-5 font-medium capitalize mb-0',
    'text-slate-900' => config('notify.theme') === 'light',
    'text-white' => config('notify.theme') !== 'light',
])>
    {{ $title }}
</p>
