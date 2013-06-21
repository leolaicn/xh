<?php
class feedbackModel extends modelClass{
    protected $_column=array('id',
                          'uid',
                          'pubtime',
                          'content');
    protected $_tableName='feedback';
}