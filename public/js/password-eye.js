function showPassword(e) {
    // alert(e);
    if ($(e).prev().attr("type") == "password") {
        $(e).prev().prop("type", "text");
        $(e).removeClass("fa-eye");
        $(e).addClass("fa-eye-slash");
    } else {
        $(e).prev().prop("type", "password");
        $(e).removeClass("fa-eye-slash");
        $(e).addClass("fa-eye");
    }
}
