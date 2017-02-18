<?php

namespace Application\Repository;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class PersonRepository {
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll() {
        return $this->tableGateway->select();
    }
}
