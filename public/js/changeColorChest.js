function changeColor(color) {        

    const form = document.getElementById("form-change-cc")
    form.action = form.action.replace("replace", color);
}