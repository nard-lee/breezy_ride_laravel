<div class="p-6 max-w-7xl mx-auto bg-gray-50 min-h-screen space-y-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden shadow-lg rounded-xl">
        <div class="p-8 text-white">
            <h1 class="text-3xl font-bold mb-2">Motorcycle Rentals</h1>
            <p class="text-blue-100">Find your perfect ride from our premium collection</p>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-white shadow-md rounded-xl border border-gray-100 p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="text-gray-600">
                <span class="font-semibold text-gray-900">{{ count($motorcycles) }}</span> motorcycles available
            </div>
            <div class="text-sm text-gray-500">
                Updated {{ now()->format('M d, Y') }}
            </div>
        </div>
    </div>

    <!-- Motorcycles Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($motorcycles as $moto)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <!-- Image with Status Badge -->
                <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center relative">
                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    
                    <!-- Status Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $moto->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($moto->status) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $moto->brand }}</h2>
                        <p class="text-gray-600 font-medium">{{ $moto->model }}</p>
                    </div>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Year
                            </div>
                            <span class="font-semibold text-gray-900">{{ $moto->year }}</span>
                        </div>
                    </div>
                    
                    <!-- Price and Action -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-2xl font-bold text-blue-600">₱{{ number_format($moto->rental_price, 2) }}</p>
                                <p class="text-sm text-gray-500">per day</p>
                            </div>
                        </div>
                        
                        @if($moto->status === 'available')
                            <a href="{{ route('motorcycle.rent', ['id' => $moto->id, 'slug' => str_replace(' ', '-', $moto->model)]) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Rent Now
                            </a>
                        @else
                            <button disabled class="w-full inline-flex items-center justify-center px-4 py-3 bg-gray-300 text-gray-500 font-semibold rounded-lg cursor-not-allowed">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Unavailable
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    @if(count($motorcycles) === 0)
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-12">
            <div class="text-center">
                <svg class="w-20 h-20 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No motorcycles available</h3>
                <p class="text-gray-600 mb-6">Check back later for new arrivals or contact us for custom requests.</p>
                <button class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    Contact Us
                </button>
            </div>
        </div>
    @endif
</div>