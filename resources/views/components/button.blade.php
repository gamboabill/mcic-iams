@props([
'type' => 'primary',
'label' => '',
'icon' => '',
'click' => null,
'px' => '3',
'py' => '1',
'mt' => '',
])

@php
$styles = [
'default' => 'bg-gray-500 text-white hover:bg-gray-700',
'primary' => 'bg-blue-500 text-white hover:bg-blue-700',
'danger' => 'bg-red-500 text-white hover:bg-red-700',
'success' => 'bg-green-500 text-white hover:bg-green-700',
'outline' => 'border border-gray-400 text-gray-700 hover:bg-gray-200',
'danger-outline' => 'border border-transparent text-red-500 hover:bg-red-500 hover:text-white',
'primary-outline' => 'border border-transparent text-blue-500 hover:bg-blue-700 hover:text-white',
'success-outline' => 'border border-transparent text-green-500 hover:bg-green-700 hover:text-white',
];

$class = $styles[$type] ?? $styles['primary'];
@endphp

<button @if($click) wire:click="{{ $click }}" @endif
    class="px-{{$px}} py-{{$py}} mt-{{$mt}} rounded transition duration-150 {{ $class }}">
    <i class="{{ $icon }}"></i> {{ $label }}
</button>