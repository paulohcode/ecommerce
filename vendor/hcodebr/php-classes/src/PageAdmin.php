<?php 

    namespace Hcode;

    class PageAdmin extends Page {

        public function __construct($opts = array(), $tpl_dir = "/views/admin/")
        {
            
            parente::__construct($opts, $tpl_dir);

        }

    }

?>