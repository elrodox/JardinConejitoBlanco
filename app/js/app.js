var setNavActive = function(navName){
    $("#main-nav-link-group").find(".active").removeClass("active");
    $("#"+navName+"-nav-link").addClass("active");
};
