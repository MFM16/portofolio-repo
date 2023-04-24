@extends('templates.main')

@section('content')
        <!-- Hero Section Start -->
        <section id="hero-section" class="pt-36">
            <div class="container">
                <div class="flex flex-wrap">
                    <div class="w-full self-center px-4 lg:w-1/2">
                        <h1 class="text-base font-semibold text-primary lg:text-2xl md:text-xl">{{ $profile->setting->language == 1 ? "I'm" : 'Halo semua, saya' }}<span class="block text-3xl text-slate-700 font-bold mt-1 lg:text-5xl md:text-4xl">{{ $profile->name }}</span></h1>
                        <h2 class="text-slate-500 font-semibold mb-5 lg:text-xl lg:mt-1">{{ $profile->job }}</h2>
                        <p class="text-secondary font-medium text-sm leading-relaxed mb-10">{{ $profile->job_description }}</p>
    
                        <a href="#footer" class="text-base font-semibold px-5 py-3 bg-primary text-white rounded-full">{{ $profile->setting->language == 1 ? "Contact me" : 'Hubungi saya' }}</a>
                    </div>
                    <div class="w-full self-end px-4 lg:w-1/2">
                        <div class="relative mt-10 ">
                            <img src="{{ asset($profile->photo) }}" alt="profile image" class="max-w-full mx-auto">
                            <span class="absolute -bottom-0 -z-10 left-1/2 -translate-x-1/2">
                                <svg height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#536B78" d="M40.5,-46.5C52.3,-38.3,61.6,-25.4,65.7,-10.4C69.8,4.7,68.7,21.9,60.2,33C51.7,44.1,35.7,49.2,19.1,57.2C2.6,65.3,-14.6,76.3,-26.8,72.4C-38.9,68.5,-46.1,49.6,-56,32.4C-65.9,15.1,-78.5,-0.5,-79.1,-16.8C-79.7,-33.2,-68.1,-50.3,-52.9,-57.9C-37.7,-65.4,-18.9,-63.4,-2.3,-60.7C14.3,-58,28.7,-54.6,40.5,-46.5Z" transform="translate(100 100)" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    
        <!-- About Section Start -->
        <section id="about" class="pt-36 pb-32">
            <div class="container">
                <div class="flex flex-wrap items-start">
                    <div class="w-full px-4 self-start mb-10 lg:w-1/2">
                        <h1 class="text-sm font-bold text-primary uppercase">{{ $profile->setting->language == 1 ? "About Me" : 'Tentang Saya' }}</h1>
                        <h2 class="text-3xl text-slate-700 font-bold mt-3 md:max-w-md lg:text-4xl">{{ $profile->setting->language == 1 ? "My Bio" : 'Sedikit Tentang Saya' }}</h2>
                        <p class="mt-2 text-medium font-medium text-secondary">{{ $profile->biography }}</p>
                    </div>
                    <div class="w-full px-4 lg:w-1/2 lg:pt-9">
                        <h2 class="text-2xl text-slate-700 font-bold md:max-w-md lg:text-3xl">{{ $profile->setting->language == 1 ? "Let's be Friend" : "Mari Berteman" }}</h2>
                        <p class="mt-2 font-medium text-medium text-secondary">{{ $profile->setting->language == 1 ? "To be able to find out about my latest activities, let's be friends via social media" : "Untuk dapat mengetahui kegiatan terbaru saya, mari berteman melalui media sosial" }}</p>
                        <div class="mt-2 flex">
                            @foreach ($profile->socials as $social)
                            <div class="social-icon">
                                <a href="{{ $social->url }}" target="_blank">
                                    <i class="{{ $social->logo }}"></i>
                                </a>
                            </div>  
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section End -->
    
        <!-- Portofolio Section Start -->
        <section id="portofolio" class="bg-slate-200 pt-14 pb-16">
            <div class="container">
                <div class="w-full px-4">
                    <div class="mx-auto mb-16 max-w-xl text-center">
                        <h4 class="mb-2 text-lg font-semibold text-primary">{{ $profile->setting->language == 1 ? "Portfolio" : "Portofolio" }}</h4>
                        <h2 class="mb-4 text-3xl font-bold text-slate-700 sm:text-4xl lg:text-5xl">{{ $profile->setting->language == 1 ? "Latest Project" : "Proyek Terbaru" }}</h2>
                        <p class="text-md font-medium text-secondary md:text-lg">
                            {{ $profile->setting->language == 1 ? "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus porro consequuntur alias, commodi nemo
                            enim aliquam ipsam obcaecati? Assumenda, ipsam?" : "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus porro consequuntur alias, commodi nemo
                            enim aliquam ipsam obcaecati? Assumenda, ipsam?" }}
                        </p>
                    </div>
                </div> 
                <div class="flex flex-wrap justify-center px-4 xl:mx-auto xl:w-10/12">
                    @foreach ($profile->portofolios as $portofolio)
                        <div class="mb-12 p-4 md:w-1/3">
                            <div class="overflow-hidden rounded-lg shadow-lg mb-2">
                                <img class="w-full" style="height: 210px;" src="{{ asset($portofolio->thumbnail) }}" alt="{{ $portofolio->slug }}">
                            </div>
                            <a href="{{ url('') }}/{{ $profile->nickname }}/portofolio/detail/{{ $portofolio->slug }}" class="text-slate-700 font-bold text-lg truncate mb-3 cursor-pointer hover:text-secondary">{{ $portofolio->name }}</a>
                            <p class="text-secondary text-sm">{{ $portofolio->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Portofolio Section End -->
    
        <!-- Clients Section Start -->
        @if ($profile->setting->client == 1)
            <section id="clients" class="bg-slate-700 pt-14 pb-32">
                <div class="container">
                    <div class="w-full px-4">
                        <div class="mx-auto mb-16 max-w-xl text-center">
                            <h4 class="mb-2 text-lg font-semibold text-secondary">{{ $profile->setting->language == 1 ? "Clients" : "Klien" }}</h4>
                            <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl lg:text-5xl">{{ $profile->setting->language == 1 ? "Collaborated with" : "Bekerja sama dengan" }}</h2>
                            <p class="text-md font-medium text-secondary md:text-lg">
                                {{ $profile->setting->language == 1 ? "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus porro consequuntur alias, commodi
                                nemo enim aliquam ipsam obcaecati? Assumenda, ipsam?" : "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus porro consequuntur alias, commodi
                                nemo enim aliquam ipsam obcaecati? Assumenda, ipsam?" }}
                            </p>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        <div class="flex flex-wrap items-center justify-center">
                            @foreach ($profile->clients as $client)
                            <a class="mx-4 max-w-[120px] py-4 opacity-60 grayscale transition duration-500 hover:opacity-100 cursor-pointer hover:grayscale-0 lg:mx-6 xl:mx-8">
                                <img src="{{ asset($client->photo) }}" alt="{{ $client->name }}">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- Clients Section End -->
    
        <!-- Blogs Section Start -->
        @if ($profile->setting->blog == 1)
            <section id="blogs" class="bg-slate-100 pt-14 pb-32">
                <div class="container">
                    <div class="w-full px-4">
                        <div class="mx-auto mb-16 max-w-xl text-center">
                            <h4 class="mb-2 text-lg font-semibold text-secondary">{{ $profile->setting->language == 1 ? "Blogs" : "Tulisan" }}</h4>
                            <h2 class="mb-4 text-3xl font-bold text-primary sm:text-4xl lg:text-5xl">{{ $profile->setting->language == 1 ? "Latest Post" : "Tulisan terbaru" }}</h2>
                            <p class="text-md font-medium text-secondary md:text-lg">
                                {{ $profile->setting->language == 1 ? "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus porro consequuntur alias, commodi nemo enim aliquam ipsam obcaecati? Assumenda, ipsam?" : "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus porro consequuntur alias, commodi nemo enim aliquam ipsam obcaecati? Assumenda, ipsam?" }}
                            </p>
                        </div>
                        <div class="flex flex-wrap">
                            @foreach ($profile->posts as $post)
                            <div class="w-full px-4 lg:w-1/2 xl:w-1/3">
                                <div class="mb-10 overflow-hidden rounded-xl shadow-xl bg-white">
                                    <img class="w-full" style="height: 250px" src="{{ asset($post->thumbnail) }}" alt="{{ $post->name }}">
                                    <div class="px-6 py-8">
                                        <h3 class="mb-3">
                                            <a href="#" class="text-primary text-lg hover:text-secondary font-bold">{{ $post->name }}</a>
                                        </h3>
                                        <p class="text-secondary text-base font-medium mb-4">{{ $post->description }}</p>
                                        <a class="px-4 py-2 font-semibold rounded-lg bg-primary text-white text-sm hover:opacity-80 transition duration-500" href="{{ url('') }}/{{ $profile->nickname }}/post/detail/{{ $post->slug }}">Lihat Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- Blogs Section End -->
@endsection