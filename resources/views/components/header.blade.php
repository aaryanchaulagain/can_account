<header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-stretch justify-between h-20">
            <a
                href="{{ route('home') }}"
                class="flex h-full w-40 sm:w-48 lg:w-52 shrink-0 items-center py-2.5 pr-3 sm:pr-4"
                aria-label="Canberra Accountants — Home"
            >
                <img
                    src="{{ asset('images/logo.png') }}?v=5"
                    alt="Canberra Accountants"
                    class="h-full w-full max-h-[3.25rem] object-contain object-left"
                    width="208"
                    height="52"
                    fetchpriority="high"
                >
            </a>

            <div class="hidden lg:flex items-center flex-1 justify-end gap-6 xl:gap-8 min-w-0 ml-2">
                <nav class="flex items-center gap-6 xl:gap-8 text-sm font-medium text-navy-800">
                    <a href="{{ route('about') }}" class="hover:text-gold-600 transition whitespace-nowrap">About Us</a>
                    <div class="relative" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                        <button type="button" class="flex items-center gap-1 hover:text-gold-600 transition whitespace-nowrap">
                            Our Services
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="servicesOpen" x-transition @click.outside="servicesOpen = false" class="absolute top-full left-0 z-50 w-80 bg-white shadow-xl rounded-lg border border-slate-100 py-2 mt-1">
                            @foreach($navServices as $service)
                                <a href="{{ route('services.show', $service) }}" class="block px-4 py-2.5 hover:bg-slate-50 text-navy-800">{{ $service->title }}</a>
                            @endforeach
                            <a href="{{ route('services.index') }}" class="block px-4 py-2.5 text-gold-600 font-semibold border-t mt-1">View All Services</a>
                        </div>
                    </div>
                    <a href="{{ route('team.index') }}" class="hover:text-gold-600 transition whitespace-nowrap">Team</a>
                    <a href="{{ route('articles.index') }}" class="hover:text-gold-600 transition whitespace-nowrap">Insights</a>
                    <a href="{{ route('companies.index') }}" class="hover:text-gold-600 transition whitespace-nowrap">Our Companies</a>
                    <a href="{{ route('forms.tax-return') }}" class="hover:text-gold-600 transition whitespace-nowrap">Tax Return Form</a>
                    <a href="{{ route('forms.business') }}" class="hover:text-gold-600 transition whitespace-nowrap">Business Form</a>
                </nav>

                <a href="{{ route('contact') }}" class="relative z-10 inline-flex items-center shrink-0 px-5 py-2.5 bg-navy-900 text-white text-sm font-semibold rounded-lg hover:bg-navy-800 transition cursor-pointer whitespace-nowrap">
                    Contact
                </a>
            </div>

            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 text-navy-900" aria-label="Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <div x-show="mobileOpen" x-transition class="lg:hidden border-t bg-white px-4 py-4 space-y-3">
        <a href="{{ route('about') }}" class="block py-2">About Us</a>
        <a href="{{ route('services.index') }}" class="block py-2">Services</a>
        <a href="{{ route('team.index') }}" class="block py-2">Team</a>
        <a href="{{ route('articles.index') }}" class="block py-2">Insights</a>
        <a href="{{ route('companies.index') }}" class="block py-2">Our Companies</a>
        <a href="{{ route('forms.tax-return') }}" class="block py-2">Tax Return Form</a>
        <a href="{{ route('forms.business') }}" class="block py-2">Business Form</a>
        <a href="{{ route('contact') }}" class="block w-full text-center py-3 mt-2 bg-navy-900 text-white font-semibold rounded-lg hover:bg-navy-800">Contact</a>
    </div>
</header>
