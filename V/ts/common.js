$(document).ready(function () {
    /*$("#login-overlay-placeholder").click(function () {
        $(this).toggleClass('WrappOut');
    });*/
    $("#login-overlay-menu-container").css({ "height": "0", "display": "none" });
    $("#overlay-menu-button").click(function () {
        var MenuItemsCount;
        MenuItemsCount = 0;
        MenuItemsCount = $("#login-overlay-menu-body").children().length;
        var WrappedHeight = 36.5 * MenuItemsCount + 50;
        $(this).toggleClass("clicked");
        if (!$("#login-overlay-menu-container").hasClass("WrappedIn")) {
            if ($("#login-overlay-menu-container").hasClass("WrappedOut"))
                $("#login-overlay-menu-container").toggleClass("WrappedOut");
            $("#login-overlay-menu-container").toggleClass("WrappedIn").animate({ height: '50px' }, 100).animate({ height: WrappedHeight }).css({ "display": "block" });
        }
        else {
            if ($("#login-overlay-menu-container").hasClass("WrappedIn"))
                $("#login-overlay-menu-container").toggleClass("WrappedIn");
            $("#login-overlay-menu-container").animate({ height: '0' }).toggleClass("WrappedOut");
        }
    });
    $("#login-overlay-menu-body").menu();
});
//# sourceMappingURL=common.js.map