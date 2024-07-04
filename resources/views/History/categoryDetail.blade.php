@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')


@section('principal-container')
    <section id="categoryDetail">

        {{-- Titulo de la seccion --}}
        <article class="title-section">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <span>Detalles</span>
            <span>x</span>
        </article>

        {{-- Contenido de las categorias --}}
        <section id="cont-details">

            @foreach ($detail as $item)

                <div class="detail">
                    <span class="date">{{formatFullDate($item->date)}}</span>
                    <div class="purchase-info">
                        <span class="product">{{$item->name}}</span>
                        <span class="price">{{formatCOP($item->price)}}</span>
                    </div>
                </div>
                
            @endforeach
            {{-- @foreach ($categories as $category)
                <a href="{{ route('hist.detailCategory', $category->id) }}" class="category c-{{ $category->id }}">

                    <div class="icon">
                        <i class='bx {{ getIconClass($category->name) }}'></i>
                        <span>{{ $category->name }}</span>
                    </div>

                    <div class="total-price">
                        <span>${{ $category->total == 0 ? 0 : formatCOP($category->total) }}</span>
                    </div>
                </a>
            @endforeach --}}
        </section>

    </section>
@endsection
