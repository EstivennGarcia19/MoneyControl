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
        </section>

    </section>
@endsection
