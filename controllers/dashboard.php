<?php

class Dashboard extends Controller {

    function __construct() {
        Session::init();
        parent::__construct();
    }

    public function index() {

        $this->view->render("dashboard/header", TRUE);
        if (Session::get("usertype") == "2") {
            $attachment = $this->model->get_attachments();
            $this->view->attachment = $attachment;
            $document = $this->model->get_user_document();
            $this->view->document = $document;
            $this->view->render("dashboard/documents", TRUE);
        } else {
            $details = $this->model->getUserDetails();
            $this->view->details = $details;
            $attachment = $this->model->attachments();
            $this->view->attachment = $attachment;
            $this->view->render("dashboard/index", TRUE);
        }
        $this->view->render("dashboard/footer", TRUE);
    }

    public function documents() {
        $this->index();
    }

    public function my_documents() {
        $details = $this->model->getUserDetails();
        $this->view->details = $details;
        $attachment = $this->model->attachments();
        $this->view->attachment = $attachment;
          $this->view->render("dashboard/header", TRUE);
        $this->view->render("dashboard/index", TRUE);
        $this->view->render("dashboard/footer", TRUE);
    }

    public function users() {
        $user = $this->model->get_user();
        $this->view->user = $user;
        $this->view->render("dashboard/header", TRUE);
        $this->view->render("dashboard/users", TRUE);
        $this->view->render("dashboard/footer", TRUE);
    }

    public function save() {
        if (!empty($_POST)) {
            $this->model->save($_POST);
        }
        $this->view->render("dashboard/header", TRUE);
        $this->view->render("dashboard/save", TRUE);
        $this->view->render("dashboard/footer", TRUE);
    }

    public function delete($param1, $param2) {
        $this->model->delete("$param1", $param2);
    }

}
