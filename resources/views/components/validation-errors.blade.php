@if ($errors->any())
    <div {{ $attributes }} class="bg-purple-100 border-l-4 border-purple-600 p-4">
        <div class="font-medium text-purple-600">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-purple-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
