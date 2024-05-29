// const optionMenu = document.getElementById("add-remove-buttons");
// const selectBtn = document.querySelector(".select-btn");
// const options = document.querySelectorAll(".option");

// selectBtn.addEventListener("click", () => optionMenu.classList.toggle('active'));


// const buttons = document.querySelector(".options");
// const selectBtn = document.querySelector(".select-btn");

// selectBtn.addEventListener("click", () => buttons.classList.toggle('active'));


function openOptions() {
    
    // Seleccionar el primer elemento con la clase "options" dentro de un elemento con la clase "more-options"
    const sub_menu = document.querySelector('.more-options .options');

    sub_menu.classList.toggle('active')

}