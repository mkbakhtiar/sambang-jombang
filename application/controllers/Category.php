<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_Controller extends CI_Controller
{

	public function __construct()
{
    parent::__construct();
    $this->load->model('category_model'); // Memuat model category_model
    $this->load->model('auth_model'); // Memuat model auth_model
   
}


	public function index() {
		$category_list = $this->generateCategoryList(); // Mendapatkan daftar kategori
		$data['category_list'] = $category_list; // Menyimpan daftar kategori ke dalam data
		$this->load->view('category_view', $data); // Menampilkan tampilan dengan daftar kategori
	}

    private function generateCategoryList() {   
        // Mendapatkan daftar kategori dari model
        $categories = $this->category_model->getCategories();
        // Menghasilkan daftar kategori
        return $this->buildCategoryList($categories);
    }

    private function buildCategoryList($categories, $parent_id = 0) {
        $list_items = '';

        foreach ($categories as $cat) {
            if ((int)$cat['category_parent_id'] !== (int)$parent_id) {
                continue;
            }
            $list_items .= '<li>';
            $list_items .= '<a href="#' . $cat['category_id'] . '">' . $cat['category_title'] . '</a>';
            // Rekursif untuk menangani subkategori
            $list_items .= $this->buildCategoryList($categories, $cat['category_id']);
            $list_items .= '</li>';
        }

        if ('' == trim($list_items)) {
            return '';
        }

        return '<ul>' . $list_items . '</ul>';
    }
}
