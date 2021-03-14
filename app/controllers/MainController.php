<?php

namespace app\controllers;

use app\Engine\Controller;


class MainController extends Controller {

	public function indexAction() {
		$vars = [];
		$this->view->render('Главная',$vars);
	}

}