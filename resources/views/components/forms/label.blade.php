@props(['label', 'name'])

<div class="inline-flex items-center gap-x-2">
    <label {{ $attributes->merge(['class' => 'block text-sm/6 font-medium text-gray-900'])}}>{{ $label }}</label>
</div>
