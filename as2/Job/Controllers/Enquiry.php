<?php
namespace Job\Controllers;
 class Enquiry{
    private $enquiresTable;

    public function __construct($enquiresTable){
        $this->enquiresTable=$enquiresTable;
    }

    public function editSubmit($id = null) {
        $enquiry =$_POST['enquiry'];
       $this->enquiresTable->save($enquiry);
        header('location:/job/home');
       }
     
    public function edit($id = null) {
        if (isset($id)) {
	        $enquiry = $this->enquiresTable->find('id', $id)[0] ?? null;
	    }
	    else {
	    	$enquiry = null;
        }
        
           return [
               'template' => '/enquiry/editEnquiry.html.php',
               'variables' => ['enquiry' => $enquiry
                               
            ],
               'title' => 'Enquires Page',
               
           ];
       }

       public function list(){
        $enquires=$this->enquiresTable->findAll();
       
       return [
        'template'=>'/enquiry/enquires.html.php',
        'variables'=>['enquires'=>$enquires],
        'title'=>'Enquiry Page'
       ];
       }
    }