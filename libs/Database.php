<?php



/**
 * insert
 * @param string $table A name of table to insert into
 * @param string $data An associative array
 */
function select($sql, $array = array()) {
    $sth = $this->prepare($sql);
    foreach ($array as $key => $value) {

        $sth->bindValue("$key", $value);
    }
    return $db->query($sth);
}

function insert($table, $data) {
    ksort($data);
    $fieldNames = implode('`, `', array_keys($data));
    $fieldValues = ':' . implode(', :', array_keys($data));

    $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
    foreach ($data as $key => $value) {
        $sth->bindValue(":$key", $value);
    }
    $ret = $db->exec($sth);
    $id = $this->select("select id from $table order by id DESC LIMIT 1 ");
    if (isset($id[0]))
        return $id[0]["id"];
}

/**
 * update
 * @param string $table A name of table to insert into
 * @param string $data An associative array
 * @param string $where the WHERE query part
 */
function update($table, $data, $where) {
    ksort($data);

    $fieldDetails = NULL;
    foreach ($data as $key => $value) {
        $fieldDetails .= "`$key`=:$key,";
    }
    $fieldDetails = rtrim($fieldDetails, ',');

    //print("UPDATE $table SET $fieldDetails WHERE $where");

    $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

    foreach ($data as $key => $value) {
        $sth->bindValue(":$key", $value);
        //print($value);
    }
    $ret = $db->exec($sth);
}

function delete($table, $where, $limit = 1) {
    return $db->exec("DELETE FROM $table WHERE $where LIMIT $limit");
}

/**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
   


