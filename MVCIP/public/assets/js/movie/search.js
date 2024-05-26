window.onload = function () {
    if (typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "movie");
    }
    window.onpopstate = function (event) {
        window.history.pushState({}, "Hide", "movie");
    };
}