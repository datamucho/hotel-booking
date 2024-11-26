@props(['name', 'label', 'value' => '', 'minDate' => null, 'required' => false, 'placeholder' => 'Select date'])

<div class="space-y-2">
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="relative group">
        <input type="text" 
               name="{{ $name }}"
               value="{{ $value }}"
               placeholder="{{ $placeholder }}"
               {{ $required ? 'required' : '' }}
               class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pr-10 
                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20
                      hover:border-gray-400 transition-colors duration-200 cursor-pointer
                      placeholder-gray-400 shadow-sm"
               data-datepicker
               data-min-date="{{ $minDate }}"
               readonly
        >
        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none
                    group-hover:text-gray-500 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
</div> 