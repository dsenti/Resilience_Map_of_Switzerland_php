<script>
    // hiding the details window when loading the site at first
    var iframe = $("#detailsIframe");
    iframe.hide();

    //variable that gets updated everytime a tile is pressed
    var current_tile;
    //function returning the tile which was last opened, called from the detailsCantons.html file
    function getCurrentTile() {
        return current_tile;
    }

    // creating the button which calls the iframe
    var detailsButton = String('<button id="detailsButton" onclick="showDetails()">Details</button>');


    //this function opens the details window
    function showDetails() {
        //getting the iframe with it's id
        var iframe = $("#detailsIframe");
        //cloning it to force a reload so that the function getCurrentTile is called
        var iframe2 = $(iframe).clone();
        $(iframe).replaceWith(iframe2);
        //show the window
        iframe2.fadeIn((speed = "slow"));
        iframe2.attr("src", iframe2.data("src"));
        map.closePopup();
    }

    //this function closes the details window when you hit "ESC"
    window.onkeydown = function(event) {
        if (event.keyCode == 27) {
            hideDetails();
        }
    };

    //this function closes the details window
    function hideDetails() {
        var iframebody = $(".iframebody");
        var iframe = $("#detailsIframe");
        iframe.fadeOut((speed = "fast"));
        iframe.promise().done(function() {
            // will be called when all the animations on the queue finish
            iframe.css('width', "35%");
            iframe.css('margin-left', "59%");
            iframebody.css('display', "inline")
        });
    }
</script>