@props(['name', 'label', 'type' => 'text', 'required' => false, 'maxlength' => 120, 'autocomplete' => 'off', 'placeholder' => '', 'default' => ''])
<div {{ $attributes->class(['min-w-0']) }}>
    <label for="{{ $name }}" class="mb-2 block text-sm font-bold text-slate-800 dark:text-slate-100">{{ $label }} @if($required)<span aria-hidden="true" class="text-orange-700">*</span>@endif</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $default) }}" @required($required) maxlength="{{ $maxlength }}" autocomplete="{{ $autocomplete }}" placeholder="{{ $placeholder }}"
        @if($type === 'tel') dir="ltr" inputmode="tel" @endif
        @if($name === 'address_line') minlength="5" @endif
        aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" @if($errors->has($name)) aria-describedby="{{ $name }}-error" @endif
        class="w-full rounded-xl border-slate-300 bg-slate-50 px-4 py-3.5 text-slate-950 placeholder:text-slate-400 focus:border-orange-500 focus:ring-orange-500 dark:border-slate-600 dark:bg-slate-950 dark:text-white">
    @error($name)<p id="{{ $name }}-error" class="mt-2 text-sm text-red-700 dark:text-red-300">{{ $message }}</p>@enderror
</div>
