<?php

class Model_Customer extends ORM
{
    protected $_table_name = 'customers';
    protected $_primary_key = 'customer_id';
    protected $_db_group = 'testdb';
}