<?php

namespace devise\Service;
use setup\baseclass\BaseService;

class crud extends BaseService {
    public function index() {
        $data = $this->connect()->show('news');
        $this->render('crud/index',$data,'data');
    }

    public function display($variables) {
        $data = $this->connect()->showById('news', $variables);
        $this->render('crud/show',$data,'data');
    }

    public function iface_insert() {
        $this->render('crud/create');
    }

    public function insert() {
        $data = [
          'title' => $_POST['title'],
          'content' => $_POST['content'],
        ];

        $this->connect()->insert($data, 'news');
        header('Location:/posts');
    }

    public function iface_update($variables) {
        $data = $this->connect()->showById('news', $variables);
        $this->render('crud/edit', $data, 'data');
    }

    public function update($variables) {
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
        ];

        $this->connect()->renew($data,'news', $variables);
        header('Location:/posts');

    }

    public function drop($variables) {
        $this->connect()->destroy('news', $variables);
        header('Location:/posts');
    }
}