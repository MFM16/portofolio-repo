@extends('templates.main')

@section('content')
    <section class="pt-36 pb-10">
        <div class="container">
            <div class="w-full px-4">
                <div class="mb-12 text-center max-w-xl lg:max-w-lg mx-auto">
                    <h1 class="text-primary text-3xl font-bold uppercase md:text-4xl lg:text-5xl">
                        {{ $portofolio->name }}
                    </h1>
                </div>
                <div class="mx-auto overflow-hidden rounded-xl shadow-xl mb-12 lg:w-3/4">
                    <img class="w-full" src="dist/img/1.jpg" alt="">
                </div>
                <div class="text-justify font-base md:text-lg lg:px-16">
                    {!! $portofolio->full_description !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Img Section End -->

    <!-- Main Section End -->

    <section class="pb-12">
        <div class="container">
            <div class="w-full px-4 lg:px-16">
                <div class="text-left font-medium">
                    <h3 class="text-base font-semibold mb-5">Portofolio Lainnya :</h3>
                    <ul>
                        @forelse ($portofolios as $item)
                        <li class="block mb-2">
                            <a class="text-sm md:text-base text-secondary hover:font-semibold hover:text-primary" href="{{ url('') }}/{{ $profile->nickname }}/portofolio/detail/{{ $item->slug }}">{{ $item->name }}</a>
                        </li>
                        @empty
                            
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection