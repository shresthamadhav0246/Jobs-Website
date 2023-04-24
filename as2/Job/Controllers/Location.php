<?php
namespace Job\Controllers;
 class Location{
    private $locationsTable;

    public function __construct($locationsTable){
        $this->locationsTable=$locationsTable;
    }

    public function list() {
        $locations = $this->locationsTable->findAll();
        return ['template' => '/location/listOfLocation.html.php', 
        'title' => 'Location List',
        'variables' => [
        'locations' => $locations
        ]
        ];
    }
    public function editSubmit() {
        $location = $_POST['location'];
        $this->locationsTable->save($location);
        header('location:/location/list');
        }

    public function edit() {
            if  (isset($_GET['id'])) {
                $result = $this->locationsTable->find('id', $_GET['id']);
                $location= $result;
            }
            else  {
                $location = false;
            }
    
            return [
                'template' => '/location/addLocation.html.php',
                'variables' => ['location' => $location],
                'title' => 'Edit location'
            ];
        }

        public function delete() {
            $this->locationsTable->delete('id',$_POST['id']);
            header('location:/location/list');
    
        }
        public function deleteSubmit() {
        if(isset($_POST['submit'])){
            $this->locationsTable->delete('id',$_POST['id']);
            header('location:/location/list');
    }
        }

 }