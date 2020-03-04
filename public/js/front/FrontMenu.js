export default class FrontMenuBehaviour {

    // Handle the behaviour of FrontMenu

    constructor() {
        this.menuBehaviour();
    }

    menuBehaviour() {
        $(document).ready(function () {
            $(".dropdown, .btn-group").hover(function () {
                let dropdownMenu = $(this).children(".dropdown-menu:visible");
                dropdownMenu.parent().toggleClass("open");
            });
        });
    }
}