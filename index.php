<?php
    require_once(getcwd().'/inc/header.php');
    require_once(getcwd().'/inc/navigation.php');
?>
    <div id="content">
        <div id="slides">
            <div>
                <img src="images/slide-1.jpg" width="490" height="270" alt="Slide 1">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div>
                <img src="images/slide-2.jpg" width="490" height="270" alt="Slide 2">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div>
                <img src="images/slide-3.jpg" width="490" height="270" alt="Slide 3">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div>
                <img src="images/slide-4.jpg" width="490" height="270" alt="Slide 4">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>

        <div id="rest">
        </div>
    </div><script type="text/javascript">
    $(function(){
            $("#slides").slides();
            $("#slides").slides("next","fadeTo");
            $("#slides").slides("previous",$.fn.extend.fadeToggle);
            
            $("#slides").slides($.fn.extend.fadeTo,4,$.fn.extend.fadeTo);


        });
    </script><?php
        require_once(getcwd()."/inc/footer.php");
    ?>
</body>
</html>
