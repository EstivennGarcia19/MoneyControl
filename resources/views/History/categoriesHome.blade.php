@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')


@section('principal-container')
    <section id="categoriesHome">

        {{-- Titulo de la seccion --}}
        <article class="title-section">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <span>Categorias</span>
            <span>x</span>
        </article>

        {{-- Contenido de las categorias --}}
        <section id="cont-categories">

            @foreach ($categories as $category)
                <a href="{{ route('hist.detailCategory', $category->id) }}" class="category c-{{ $category->id }}">

                    <div class="icon">
                        <article class="cont-icon">
                            <i class='fa-solid {{ getIconClass($category->name) }}'></i>
                        </article>
                        <span>{{ $category->name }}</span>
                    </div>

                    <div class="total-price">
                        <span>${{ $category->total == 0 ? 0 : formatCOP($category->total) }}</span>
                    </div>
                </a>
            @endforeach
        </section>

    </section>
@endsection
