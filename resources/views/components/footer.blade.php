<footer class="bg-navy-950 text-slate-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div>
                <p class="font-serif text-2xl text-white mb-4">Canberra Accountants</p>
                <p class="text-sm leading-relaxed">Premium accounting, taxation and advisory services across Australia.</p>
                <p class="mt-4 text-xs text-slate-400">ABN: {{ $siteSettings['abn'] ?? '76 676 815 080' }}</p>
                <p class="text-xs text-slate-400">Tax Agent: {{ $siteSettings['tax_agent'] ?? '26258136' }}</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-sm">
                    @foreach($navServices->take(6) as $service)
                        <li><a href="{{ route('services.show', $service) }}" class="hover:text-gold-400 transition">{{ $service->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-gold-400 transition">About Us</a></li>
                    <li><a href="{{ route('team.index') }}" class="hover:text-gold-400 transition">Our Team</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-gold-400 transition">Insights</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-gold-400 transition">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Contact</h4>
                <p class="text-sm"><a href="tel:0261906075" class="hover:text-gold-400">{{ $siteSettings['phone'] ?? '(02) 6190 6075' }}</a></p>
                <p class="text-sm mt-2"><a href="mailto:{{ $siteSettings['email'] ?? 'info@canberraaccountants.com.au' }}" class="hover:text-gold-400">{{ $siteSettings['email'] ?? 'info@canberraaccountants.com.au' }}</a></p>
                <p class="text-sm mt-4 text-slate-400">Service Areas: Canberra, Sydney, Hobart, Adelaide, Australia Wide</p>
            </div>
        </div>
        <div class="border-t border-navy-800 mt-12 pt-8 text-center">
            <p class="text-sm text-white">&copy; {{ date('Y') }} Canberra Accountants. All rights reserved.</p>
            <p class="mt-2 text-xs text-slate-400">
                Developed by <span class="text-white font-semibold tracking-wide">RAMROSOFT</span>
            </p>
            <p class="mt-2 text-xs text-slate-500">CRN: {{ $siteSettings['crn'] ?? '577972' }}</p>
        </div>
    </div>
</footer>
