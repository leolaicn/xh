<?php
/**
 * feebback表模型
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class feedbackModel extends modelClass{
    protected static $_column=array('id',
                          'uid',
                          'pubtime',
                          'content');
    protected static $_tableName='feedback';
    protected static $_tablePreFix='xh_';
}