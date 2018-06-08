<?php

if(strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {
    return true;
}

return false;