<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-info text-info-content']) }}>
    {{ $slot }}
</button>
