export default class FrontMenuBehaviour {

    // Handle the behaviour of FrontMenu

    constructor() {
        this.menuBehaviour();
    }

    menuBehaviour() {
        $(document).ready(function () {
            $(".dropdown, .btn-group").hover(function () {
                var dropdownMenu = $(this).children(".dropdown-menu");
                if (dropdownMenu.is(":visible")) {
                    dropdownMenu.parent().toggleClass("open");
                }
            });
        });
    }
}