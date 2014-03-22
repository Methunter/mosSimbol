<div id="flavor_2"></div>
<script>

    // Code used for "Flavor 2" example (above)

    $.getJSON("agile_carousel_data.php", function(data) {
        $(document).ready(function(){
            $("#flavor_2").agile_carousel({
                
                // required settings
                
                carousel_data: data,
                carousel_outer_height: 500,
                carousel_height: 430,
                slide_height: 500,
                carousel_outer_width: 600,
                slide_width: 600,
                                                
                // end required settings
                                                
                transition_type: "fade",
                transition_time: 600,
                timer: 3000,
                continuous_scrolling: true,
                control_set_1: ",next_button, previous_button",
//                ... (continues on same line)... pause_button,next_button",
                control_set_2: "content_buttons",
                change_on_hover: "content_buttons"
            });
        });
    });
 </script>