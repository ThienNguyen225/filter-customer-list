<?php
$customer_list = array(
    "1" => array("name" => "Mai Thanh Hằng", "day_of_birth" => "1983/08/20", "address" => "Hà Nội", "profile" => "images/1.jpg"),
    "2" => array("name" => "Nguyễn Thị Mỹ Trinh", "day_of_birth" => "1983/08/21", "address" => "Bắc Giang", "profile" => "images/2.jpg"),
    "3" => array("name" => "Nguyễn Thị Huệ", "day_of_birth" => "1983/08/22", "address" => "Nam Định", "profile" => "images/3.jpg"),
    "4" => array("name" => "Trần Thị Thu Hòa", "day_of_birth" => "1983/08/17", "address" => "Hà Tây", "profile" => "images/4.jpg"),
    "5" => array("name" => "Nguyễn Thị Nguyệt", "day_of_birth" => "1983/08/19", "address" => "Hà Nội", "profile" => "images/5.jpg"),
    "6" => array("name" => "Nguyễn Thị Hoa", "day_of_birth" => "1983/02/17", "address" => "Hà Nội", "profile" => "images/6.jpg")
);

function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực hành lọc danh sách khách hàng</title>
</head>
<style>
    h2{
        color: blue;
    }
    form{
        margin-left: 50%;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
<body>
<?php
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>

<form method="post">
    Từ: <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd"
               value="<?php echo isset($from_date) ? $from_date : ''; ?>" size="30"/>
    Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"
                value="<?php echo isset($to_date) ? $to_date : ''; ?>" size="30"/>
    <input type="submit" id="submit" value="Lọc" size="30"/>
</form>

<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php foreach($filtered_customers as $index=> $customer): ?>
        <tr>
            <td><?php echo $index ?></td>
            <td><?php echo $customer['name'];?></td>
            <td><?php echo $customer['day_of_birth'];?></td>
            <td><?php echo $customer['address'];?></td>
            <td><div class="profile"><img width="80px" src="<?php echo $customer['profile'];?>"/></div> </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
