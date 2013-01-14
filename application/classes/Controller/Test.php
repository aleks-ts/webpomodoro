<?php

class Controller_Test extends Controller
{
    public function action_index()
    {
        echo json_encode(array("name"=>"John","time"=>"pm"));
    }
}
