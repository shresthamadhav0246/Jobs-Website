<?php
namespace Job\Controllers;
class FAQs{
    public function FAQs(){
        return[
            'template'=>'/faqs/faqs.html.php',
            'title'=>'FAQs',
            'variables'=>[]
        ];
    }
}
?>