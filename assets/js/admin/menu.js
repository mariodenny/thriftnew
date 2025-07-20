function show_box_menu_admin() {
    box_menu_admin.style.display = 'block';
}
function toggleDropdown(id) {
    var el = document.getElementById(id);
    if (el.style.display === "block") {
        el.style.display = "none";
    } else {
        el.style.display = "block";
    }
}
