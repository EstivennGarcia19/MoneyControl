function expandCard() {

    var card = document.querySelector('.all-my-money');
    var btn_expand = document.querySelector('.btn-expand');
    var incomes_form = document.querySelector('.incomes-form');

    card.classList.add('expand');

    incomes_form.classList.add('active');
    btn_expand.style.display = 'none';
}


function closeCard() {
    var card = document.querySelector('.all-my-money');
    var btn_expand = document.querySelector('.btn-expand');
    var incomes_form = document.querySelector('.incomes-form');


    card.classList.remove('expand');
    incomes_form.classList.remove('active');
    btn_expand.style.display = 'inline';

}



// function decreaseCard() {

//     var card = document.querySelector('.all-my-money');
//     var btn_expand = document.querySelector('.btn-expand');
//     var incomes_form = document.querySelector('.incomes-form');

//     card.classList.remove('expand');

//     incomes_form.classList.remove('active');

//     btn_expand.style.display = 'block';
    
// }
