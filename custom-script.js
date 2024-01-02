document.addEventListener("DOMContentLoaded", function () {
    // Define the HTML for the toggle button
    var toggleButtonHTML =
        '<button class="toggleGrid show-settings" id="toggleGrid">Toggle Grid</button>';

    // Insert the button into the screen meta links
    var screenMetaLinks = document.getElementById("screen-meta-links");
    if (screenMetaLinks) {
        screenMetaLinks.insertAdjacentHTML("beforeend", toggleButtonHTML);
    }

    var bodyElement = document.body;

    // Function to toggle class on body
    function toggleBodyClass() {
        var isActive = bodyElement.classList.contains("grid-enabled");
        if (isActive) {
            bodyElement.classList.remove("grid-enabled");
            localStorage.setItem("bodyGridActive", "false");
        } else {
            bodyElement.classList.add("grid-enabled");
            localStorage.setItem("bodyGridActive", "true");
        }
    }

    // Set initial state from local storage or default to false
    var storedState = localStorage.getItem("bodyGridActive");
    if (storedState === "true") {
        bodyElement.classList.add("grid-enabled");
    }

    // Event listener for the toggle button
    var toggleButton = document.getElementById("toggleGrid");
    toggleButton.addEventListener("click", toggleBodyClass);
});
