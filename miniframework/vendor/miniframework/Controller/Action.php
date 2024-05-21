<?php

namespace MF\Controller;

abstract class Action {
    protected $view;

    public function __construct() {
        $this->view = new \stdClass();
    }

    protected function render($view, $layout) {
        $this->view->page = $view; // Define a página a ser renderizada
        if(file_exists("../App/Views/".$layout.".phtml")) {
            require_once "../App/Views/".$layout.".phtml"; // Ajuste do caminho relativo
        } else {
            $this->content();
        }
    }

    protected function content() {
        $classAtual = get_class($this);

        $classAtual = str_replace('App\\Controllers\\', '', $classAtual);

        $classAtual = strtolower(str_replace('Controller', '', $classAtual));

        require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml"; // Usa o nome da view definida em render
    }
}
