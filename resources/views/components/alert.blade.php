@props(['type', 'message', 'timeout' => '5000'])

@if(session()->has($type))

<div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, {{$timeout}})"
    class="mb-4 p-3 text-sm rounded {{$type == 'success' ? ' bg-green-100 text-green-700 border border-green-400' : 'bg-red-100 text-red-700 border border-red-400'}}">
    {{$message}}</div>
@endif