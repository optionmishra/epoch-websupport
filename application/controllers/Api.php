<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller
{
    public $error;

    public $user;

    public $start;

    public $limit;

    public $board;

    public $publication;

    public $subject;

    public $class;

    public $book;

    public $category;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('Permission');
        $this->load->helper('form');
        $this->load->model('AuthModel');
        $this->load->model('WebModel');
        $this->load->library('upload');
        $this->load->library('email');
        $this->load->library('excel');
        $this->siteName = $_ENV['NAME'];
        $this->siteEmail = $_ENV['EMAIL'];

        $this->db->where('email', $this->session->userdata('username')); // $this->session->userdata('username'));
        $this->user = $this->db->get('web_user')->row();
    }

    public function dashboard()
    {
        $boards = $this->AuthModel->board();
        $board = $this->AuthModel->boardNameToId($this->user->board_name);

        $publications = $this->AuthModel->publication();
        $publication = $publications[0]->id;

        $subjects = $this->AuthModel->msubject_mod($this->user->subject);
        $subject = $subject ? $subject : $subjects[0]->id;

        $classes = $this->AuthModel->selectable_classes($subject);
        $class = $class ? $class : $classes[0]->id;

        $books = $this->AuthModel->selectable_books($subject, $class);
        $book = $book ? $book : $books[0]->id;

        $categories = $this->AuthModel->get_categories($book);
        $category = $category ? $category : $categories[0]->id;

        $contents = $this->AuthModel->getContent($board, $publication, $subject, $class, $book, $category, 0, 10);

        $data = [
            'user' => $this->user,
            'logo' => $this->AuthModel->content_row('Logo')['file_name'],
            'mobile' => $this->AuthModel->content('Mobile1')[0]->value,
            'email' => $this->AuthModel->content('Email1')[0]->value,
            'address' => $this->AuthModel->content('Address')[0]->value,
            'siteName' => $_ENV['NAME'],
            'boards' => $boards,
            'publications' => $publications,
            'subjects' => $subjects,
            'classes' => $classes,
            'books' => $books,
            'categories' => $categories,
            'contents' => $contents[0],
            'total' => $contents[1],
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    public function filteredProducts()
    {
        $json = file_get_contents('php://input');
        $json_data = json_decode($json, true);

        $name = $json_data['name'];

        $this->setDashboardSelections();
        $data = $this->dashboardData($name, $value);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    public function dashboardData($name = null, $value = null)
    {
        switch ($name) {
            case 'subject':
                $classes = $this->AuthModel->selectable_classes($this->subject);
                $class = $classes[0]->id;
                $this->class = $class;

                $books = $this->AuthModel->selectable_books($this->subject, $class);
                $book = $books[0]->id;
                $this->book = $book;

                $categories = $this->AuthModel->get_categories($book);
                $category = $this->dashboardSelectedCategory() ? $this->dashboardSelectedCategory() : null;

                $contents = $this->AuthModel->getContent($this->board, $this->publication, $this->subject, $this->class, $this->book, $this->category, $this->start, $this->limit);

                $data = [
                    'classes' => $classes,
                    'class' => $class,
                    'books' => $books,
                    'book' => $book,
                    'categories' => $categories,
                    'contents' => $contents[0],
                    'total' => $contents[1],
                ];
                if ($category) {
                    $data['category'] = $category;
                }

                return $data;

            case 'class':
                $books = $this->AuthModel->selectable_books($this->subject, $this->class);
                $book = $books[0]->id;
                $this->book = $book;

                $categories = $this->AuthModel->get_categories($book);
                $category = $this->dashboardSelectedCategory() ? $this->dashboardSelectedCategory() : null;
                $contents = $this->AuthModel->getContent($this->board, $this->publication, $this->subject, $this->class, $this->book, $this->category, $this->start, $this->limit);
                $data = [
                    'books' => $books,
                    'book' => $book,
                    'categories' => $categories,
                    'contents' => $contents[0],
                ];
                if ($category) {
                    $data['category'] = $category;
                }

                return $data;

            case 'book':
                $categories = $this->AuthModel->get_categories($this->book);
                $category = $this->dashboardSelectedCategory() ? $this->dashboardSelectedCategory() : null;
                $contents = $this->AuthModel->getContent($this->board, $this->publication, $this->subject, $this->class, $this->book, $this->category, $this->start, $this->limit);
                $data = [
                    'categories' => $categories,
                    'contents' => $contents[0],
                    'total' => $contents[1],
                ];
                if ($category) {
                    $data['category'] = $category;
                }

                return $data;

            case 'category':
                $contents = $this->AuthModel->getContent($this->board, $this->publication, $this->subject, $this->class, $this->book, $this->category, $this->start, $this->limit);
                $data = [
                    'contents' => $contents[0],
                    'total' => $contents[1],
                ];

                return $data;
        }
    }

    public function dashboardSelectedCategory()
    {
        $selectableCategories = $this->AuthModel->get_categories($this->book);
        $currentCategoryId = $this->category;
        $currentCategoryFound = false;

        foreach ($selectableCategories as $category) {
            if ($category->id == $currentCategoryId) {
                $currentCategoryFound = true;

                return false;
            }
        }

        if (! $currentCategoryFound) {
            $defaultCategory = reset($selectableCategories);

            return $defaultCategory->id;
        }
    }

    public function pagedContents()
    {
        $this->setDashboardSelections();
        $contents = $this->AuthModel->getContent($this->board, $this->publication, $this->subject, $this->class, $this->book, $this->category, $this->start, $this->limit);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['contents' => $contents[0], 'total' => $contents[1]]));
    }

    public function setDashboardSelections()
    {
        $json = file_get_contents('php://input');
        $json_data = json_decode($json, true);

        $board = $json_data['board'];
        $publication = $json_data['publication'];
        $subject = $json_data['subject'];
        $class = $json_data['class'];
        $book = $json_data['book'];
        $category = $json_data['category'];
        $start = $json_data['start'];
        $limit = $json_data['limit'];

        $this->board = $board;
        $this->publication = $publication;
        $this->subject = $subject;
        $this->class = $class;
        $this->book = $book;
        $this->category = $category;
        $this->start = $start;
        $this->limit = $limit;
    }
}
