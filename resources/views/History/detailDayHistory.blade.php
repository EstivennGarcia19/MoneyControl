@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')

<?php
    $date_day = $date_tittle->first()->date;

?>


@section('principal-container')
    <section id="home-history">      
        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>{{ formatDate($date_day) }}</span></div>

            <div class="invisible">
                <p>p</p>    
            </div>
        </article>

        <section id="days-container">

            <article class="info">
                <p>Hola, Este dia compraste esto:</p>
            </article>

            <ol>
                @foreach ($detail_days as $item)
                    <?php $copAmount = number_format($item->price, 0, ',', ','); ?>
                    <li>
                        <article class="things-purshased">
                            <p>x</p>
                            <span>{{ $item->name }}</span>
                            <span>${{ formatCOP($item->price) }}</span>
                        </article>

                    </li>
                @endforeach
            </ol>

        </section>

        <div id="forgotAdd" data-bs-toggle="modal" data-bs-target="#addMoreAmount">
            <i class='bx bx-question-mark bx-tada'></i>
        </div>

        <div class="modal fade" id="addMoreAmount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="addMoreAmountLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="removeAmount">¿Que olvidaste?</h1>
                        <button type="button" class="btn text-light" data-bs-dismiss="modal"><i
                                class='bx bx-x'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-content-modal">

                            <form action="{{ route('history.store') }}" method="POST">
                                @method('PUT')
                                @csrf

                                <article>
                                    <div>
                                        <label for="name"><i class='bx bx-calendar-edit'></i></label>
                                        <input type="text" placeholder="Nombre" id="input_add_amount" name="name"
                                            value="">
                                    </div>
                                    <div>
                                        <label for="price"><i class='bx bx-wallet'></i></label>
                                        
                                        <input type="text" placeholder="Cuanto" inputmode="numeric" class="price" id="input_add_amount" name="price">
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="date" value="{{ $date_day }}">
                                </article>

                                <button><i class='bx bx-plus'></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/formatCOP.js') }}"></script>

    
@endpush

