<?php
namespace Job\Controllers;
 class Category{
    private $categoriesTable;

    public function __construct($categoriesTable){
        $this->categoriesTable=$categoriesTable;
    }

    public function list() {
        $categories = $this->categoriesTable->findAll();
        return ['template' => '/jobs/jobs-list.html.php', 
        'title' => 'Job List',
        'variables' => [
        'categories' => $categories
        ]
        ];
    }
    public function nav() {
        $categories = $this->categoriesTable->findAll();

        return ['template' => '/category-list.html.php', 
        'title' => 'Job List',
        'variables' => [
        'categories' => $categories
        ]
        ];
    }


    public function delete() {
        $this->categoriesTable->delete('id',$_POST['id']);
        header('location: /category/manageCategory');

    }
    public function deleteSubmit() {
    if(isset($_POST['submit'])){
        $this->categoriesTable->delete('id',$_POST['id']);
        header('location: /category/manageCategory');
}
    }



    public function manageCategory() {
        $categories = $this->categoriesTable->findAll();
        return ['template' => '/admin/manageCategory.html.php', 
        'title' => 'Manage Category',
        'variables' => [
        'categories' => $categories
        ]
        ];
    }
        public function editSubmit() {
            $category = $_POST['category'];
            $this->categoriesTable->save($category);
            header('location: /category/manageCategory');
            }

        public function edit() {
                if  (isset($_GET['id'])) {
                    $result = $this->categoriesTable->find('id', $_GET['id']);
                    $category= $result;
                }
                else  {
                    $category = false;
                }
        
                return [
                    'template' => '/admin/editCategory.html.php',
                    'variables' => ['category' => $category],
                    'title' => 'Edit Category'
                ];
            }
        }
       




?>