<!-- Navbar Section Start -->
<header class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10">
    <div class="container">
        <div class="flex items-center justify-between relative">
            <div class="px-4">
                <a href="#" class="text-lg font-semibold text-primary block py-6">{{ $profile->name }}</a>
            </div>
            <div class="px-4 flex items-center">
                <button type="button" id="hamburger-menu" class="block absolute right-4 lg:hidden">
                    <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
                </button>

                <nav id="nav-menu"
                    class="hidden absolute bg-white max-w-[250px] shadow-lg rounded-lg w-full right-4 top-full lg:max-w-full lg:shadow-none lg:border-none lg:bg-transparent lg:static lg:block">
                    <ul class="block lg:flex">
                        <li class="group">
                            <a class="text-secondary text-base py-2 px-8 flex group-hover:text-primary group-hover:font-semibold"
                                href="#">{{ $profile->setting->language == 1 ? 'Home' : 'Beranda'}}</a>
                        </li>
                        <li class="group">
                            <a class="text-secondary text-base py-2 px-8 flex group-hover:text-primary group-hover:font-semibold"
                                href="#about">{{ $profile->setting->language == 1 ? 'About me' : 'Tentang Saya'}}</a>
                        </li>
                        <li class="group">
                            <a class="text-secondary text-base py-2 px-8 flex group-hover:text-primary group-hover:font-semibold"
                                href="#portofolio">{{ $profile->setting->language == 1 ? 'Portfolio' : 'Portofolio'}}</a>
                        </li>
                        @if ($profile->setting->client == 1)
                            <li class="group">
                                <a class="text-secondary text-base py-2 px-8 flex group-hover:text-primary group-hover:font-semibold"
                                    href="#clients">{{ $profile->setting->language == 1 ? 'Clients' : 'Klien'}}</a>
                            </li>                            
                        @endif
                        @if ($profile->setting->blog == 1)
                            <li class="group">
                                <a class="text-secondary text-base py-2 px-8 flex group-hover:text-primary group-hover:font-semibold"
                                    href="#blogs">{{ $profile->setting->language == 1 ? 'Blogs' : 'Tulisan'}}</a>
                            </li>                           
                        @endif
                        <li class="group">
                            <a class="text-secondary text-base py-2 px-8 flex group-hover:text-primary group-hover:font-semibold"
                                href="#footer">{{ $profile->setting->language == 1 ? 'Contact' : 'Kontak'}}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Navbar Section End -->