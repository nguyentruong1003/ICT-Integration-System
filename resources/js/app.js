require("./bootstrap");

let turboLinks = require("turbolinks");
turboLinks.start();

// Fix bootstrap dropdown toggle
document.addEventListener("turbolinks:load", function () {
    $(".dropdown-toggle").dropdown();
});
