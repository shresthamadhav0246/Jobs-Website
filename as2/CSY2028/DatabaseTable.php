<?php
namespace CSY2028;

class DatabaseTable {
       private $table;
       private $pdo;
       private $primaryKey;
       private $entityClass;
       private $entityConstructor;

       public function __construct($pdo,$table,$primaryKey,$entityClass='stdclass', $entityConstructor=[]){
        $this->pdo=$pdo;
        $this->table=$table;
        $this->primaryKey=$primaryKey;
        $this->entityClass = $entityClass;
        $this->entityConstructor = $entityConstructor;
       }

    public function find($field, $value) {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

        $criteria = [
        'value' => $value
        ];
        try {
            $stmt->execute($criteria);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            // log the error message
            error_log($e->getMessage());
            return [];
        }
    
        }

        public function edit($field, $value) {
            $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');

            $criteria = [
            'value' => $value
            ];
            $stmt->execute($criteria);
            return $stmt->fetchAll();
            }

        public function findAll() {
            $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);
    
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

            $stmt->execute();
    
            return $stmt->fetchAll();
        }

    public function delete($field, $value) {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
        $criteria = [
        'value' => $value
        ];
        $stmt->execute($criteria);
}

public function total() {
    $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM `' . $this->table . '`');
    $stmt->execute();
    $row = $stmt->fetch();
    return $row[0];
}


public function save($record) {
    $entity = new $this->entityClass(...$this->entityConstructor);
    try {
       if (empty($record[$this->primaryKey])) {
           unset($record[$this->primaryKey]);
       }
       $insertId = $this->insert($record);

       $entity->{$this->primaryKey} = $insertId;
    } catch (\PDOException $e) {
       $this->update($record);
    }

    foreach ($record as $key => $value) {
        if (!empty($value)) {
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }
            $entity->$key = $value;
        }
    }
    return $entity;
}

public function update($values) {
    $query = ' UPDATE `' . $this->table .'` SET ';

    foreach ($values as $key => $value) {
        $query .= '`' . $key . '` = :' . $key . ',';
    }

    $query = rtrim($query, ',');

    $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

    // Set the :primaryKey variable
    $values['primaryKey'] = $values['id'];

    $values = $this->processDates($values);

    $stmt = $this->pdo->prepare($query);
    $stmt->execute($values);
}

public function insert($values) {
    $query = 'INSERT INTO `' . $this->table . '` (';

    foreach ($values as $key => $value) {
        $query .= '`' . $key . '`,';
    }

    $query = rtrim($query, ',');

    $query .= ') VALUES (';

    foreach ($values as $key => $value) {
        $query .= ':' . $key . ',';
    }

    $query = rtrim($query, ',');

    $query .= ')';

    $values = $this->processDates($values);

    $stmt = $this->pdo->prepare($query);
    $stmt->execute($values);

    return $this->pdo->lastInsertId();
}



private function processDates($values) {
    foreach ($values as $key => $value) {
        if ($value instanceof \DateTime) {
            $values[$key] = $value->format('Y-m-d');
        }
    }

    return $values;
}

}
?>