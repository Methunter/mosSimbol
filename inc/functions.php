<?php
function navigation() {
    $arg_list = func_get_args();
    $numargs = func_num_args();
    $str = '';
    for ($i = 0; $i < $numargs; $i++) {
        $str .= ($arg_list[$i][1] ? 
                    ($arg_list[$i][0] ? 
                        '<a href="' . $arg_list[$i][0] . '">' . $arg_list[$i][1] . '</a>' : 
                        $arg_list[$i][1]
                    ) . ($numargs - 1 > $i && $arg_list[$i][0] ? 
                            '<span>›</span>' : 
                            ''
                        ) : ''
                );
    }

    return $str;
}
?>