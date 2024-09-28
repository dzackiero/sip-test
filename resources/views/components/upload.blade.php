@props(['label' => null, 'name' => null, 'currentFile' => null, 'class' => null, 'required' => false, 'preview' => false])

<div class="w-full {{ $class }}">
    @if($label)
        <label for="{{ $name }}" class="font-semibold text-sm">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <!-- File input for uploading a new file -->
    <input type="file"
           name="{{ $name }}"
           id="{{ $name }}"
           accept="image/*"
        {{ $attributes->merge([
            'class' => 'mt-1 flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50'
        ]) }}>

    <!-- Display the current file name if available -->
    @if($currentFile)
        <div class="mt-2 text-sm text-neutral-500">
            <p>Current File: <span class="font-semibold">{{ basename($currentFile) }}</span></p>
        </div>
    @endif

    <!-- Preview image if enabled and currentFile exists -->
    <div class="mt-2 max-w-sm w-fit border border-neutral-300 p-2 rounded">
        <img id="{{ $name }}_preview"
             src="{{ $currentFile ? asset('storage/' . $currentFile) : '' }}"
             class="{{ $currentFile ? 'mt-2 max-w-sm max-h-96 border p-2 rounded' : 'hidden' }}"
             alt="Image Preview">
        <div class="w-64 h-32 grid place-items-center text-neutral-300" id="{{ $name }}_placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </div>
    </div>
</div>

<script>
    document.getElementById('{{ $name }}').addEventListener('change', function (event) {
        const fileInput = event.target;
        const previewImage = document.getElementById('{{ $name }}_preview');
        const placeholder = document.getElementById('{{ $name }}_placeholder');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                placeholder.classList.add("hidden");
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
                placeholder.classList.remove("hidden");
        }
    });
</script>
