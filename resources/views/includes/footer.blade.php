<!-- Footer Section Start -->
<section id="footer" class="bg-slate-800 pt-14 pb-3">
    <div class="container">
        <div class="flex flex-wrap">
            <div class="w-full px-4 text-left text-slate-500 mb-12 md:w-1/2">
                <h2 class="mb-5 text-4xl font-bold text-white">{{ $profile->setting->language == 1 ? "Contact" : "Kontak" }}</h2>
                <h3 class="mb-2 text-2xl font-bold text-secondary">{{ $profile->setting->language == 1 ? "Contact me" : "Hubungi saya" }}</h3>
                <p>{{ $profile->email }}</p>
                <p>{{ $profile->address }}</p>
            </div>
            <div class="mb-12 w-full px-4 md:w-1/2">
                <h3 class="mb-5 text-xl font-semibold text-white">Tautan</h3>
                <ul class="text-secondary">
                    <li>
                        <a href="#home" class="mb-3 inline-block text-base hover:text-primary">Beranda</a>
                    </li>
                    <li>
                        <a href="#about" class="mb-3 inline-block text-base hover:text-primary">Tentang Saya</a>
                    </li>
                    <li>
                        <a href="#portfolio" class="mb-3 inline-block text-base hover:text-primary">Portfolio</a>
                    </li>
                    <li>
                        <a href="#clients" class="mb-3 inline-block text-base hover:text-primary">Clients</a>
                    </li>
                    <li>
                        <a href="#blog" class="mb-3 inline-block text-base hover:text-primary">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<script src="{{ url('js/script.js') }}"></script>
<!-- Footer Section End -->