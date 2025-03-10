<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center px-4 py-2 bg-gradient-purple text-white font-semibold rounded-md text-xs uppercase tracking-widest hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
