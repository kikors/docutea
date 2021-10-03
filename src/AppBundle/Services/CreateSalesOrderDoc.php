<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 03/03/2018
 * Time: 23:25
 */

namespace AppBundle\Services;


use AppBundle\Entity\SalesOrder;

interface CreateSalesOrderDoc {
    public function create(SalesOrder $SalesOrder);
}