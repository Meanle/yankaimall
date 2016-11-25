<?php
namespace Home\Action;

class TestAction extends BaseAction
{

    public function index()
    {
        sms(13203290137);
    }

}