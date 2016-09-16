<?php

class MY_Loader extends CI_Loader {

    public function template($template_name, $vars = array(), $return = FALSE) {

        if ($return) {
            $content = $this->view('_layouts/header', $vars, $return);
            $content = $this->view('_layouts/menubar', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('_layouts/footer', $vars, $return);
            return $content;
        }

        $this->view('_layouts/header', $vars);
        $this->view('_layouts/topbar', $vars);
        $this->view('_layouts/menubar', $vars);
        $this->view($template_name, $vars);
        $this->view('_layouts/footer', $vars);
    }

    public function ajaxtemplate($template_name, $vars = array(), $return = FALSE) {

        if ($return) {
            $content = $this->view('_layouts/ajaxheader', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            return $content;
        }

        $this->view('_layouts/header', $vars);
        $this->view($template_name, $vars);
    }

}

?>
