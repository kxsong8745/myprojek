<?php

class Kenderaan extends Admin_Controller {
    public function listkend(){
        $this->template->title("Senarai Kenderaan");
        $this->template->render();

    }
}