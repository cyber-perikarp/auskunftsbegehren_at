<?php

if(strpos($_SERVER["SERVER_NAME"], ".local") !== false) {
    return true;
}

return false;