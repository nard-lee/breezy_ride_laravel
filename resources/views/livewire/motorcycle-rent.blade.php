<div class="p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">
        Checkout: {{ $motorcycle->brand }} {{ $motorcycle->model }}
    </h1>

    <p>Year: {{ $motorcycle->year }}</p>
    <p>Rental Price: ₱{{ $motorcycle->rental_price }}</p>
    <p>Status: {{ ucfirst($motorcycle->status) }}</p>
    <p class="text-gray-500">Slug: {{ $slug }}</p>

    @if($motorcycle->status === 'available')
        <button wire:click="rent"
                class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Checkout
        </button>
    @else
        <span class="mt-4 text-red-500 font-bold">Already Rented</span>
    @endif

    {{-- Flash messages --}}
    @if(session()->has('success'))
        <p class="mt-4 text-green-500">{{ session('success') }}</p>
    @endif

    @if(session()->has('error'))
        <p class="mt-4 text-red-500">{{ session('error') }}</p>
    @endif
</div>
