<?php
try {
    $pdo = new PDO("mysql:dbname=iran;host=localhost", 'root', 'root');
    $pdo->exec("set names utf8;");
    // echo "Connection OK!";
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

#==============  Simple Validators  ================
function isValidCity($data)
{
    if (empty($data['province_id']) or !is_numeric($data['province_id']))
        return false;
    return empty($data['name']) ? false : true;
}
function isValidProvince($data)
{
    #It's better to validate data in database
    $province_id = intval($data['province_id'] ?? 0);
    if ($province_id < 1 OR $province_id > 31)
        return false;
    return true;
}

#================  Read Operations  =================
function getCities($data = null)
{
    global $pdo;
    $province_id = $data['province_id'] ?? null;
    $where = '';
    if (!is_null($province_id) and is_int($province_id)) {
        $where = "where province_id = {$province_id} ";
    }
    $sql = "select * from city $where";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function getProvinces($data = null)
{
    global $pdo;
    $sql = "select * from province";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}


#================  Create Operations  =================
function addCity($data)
{
    global $pdo;
    if (!isValidCity($data)) {
        return false;
    }
    $sql = "INSERT INTO `city` (`province_id`, `name`) VALUES (:province_id, :name);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':province_id' => $data['province_id'], ':name' => $data['name']]);
    return $stmt->rowCount();
}
function addProvince($data)
{
    global $pdo;
    if (!isValidProvince($data)) {
        return false;
    }
    $sql = "INSERT INTO `province` (`name`) VALUES (:name);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $data['name']]);
    return $stmt->rowCount();
}


#================  Update Operations  =================
function changeCityName($city_id, $name)
{
    global $pdo;
    $sql = "update city set name = '$name' where id = $city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
function changeProvinceName($province_id, $name)
{
    global $pdo;
    $sql = "update province set name = '$name' where id = $province_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

#================  Delete Operations  =================
function deleteCity($city_id)
{
    global $pdo;
    $sql = "delete from city where id = $city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
function deleteProvince($province_id)
{
    global $pdo;
    $sql = "delete from province where id = $province_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

// Function Tests
// $data = addCity(['province_id' => 23,'name' => "New City"]);
// $data = addProvince(['name' => "new Province"]);
// $data = getCities(['province_id' => 23]);
// $data = deleteProvince(34);
// $data = changeProvinceName(34,"استان جدید");
// $data = getProvinces();
// $data = deleteCity(443);
// $data = changeCityName(445,"شهر جدید");
//$data = getCities(['province_id' => 1]);
//$data = json_encode($data);
//echo "<pre>";
//print_r($data);
//echo "<pre>";
