<?php
require_once '../../database/config-pdo.php';

$column = array('appointment_id', 'firstname', 'lastname', 'clinic', 'appointment_date', 'appointment_time', 'service', 'dentist', 'status');

$query = "SELECT tbl_appointment.appointment_id, tbl_user.firstname, tbl_user.lastname, tbl_appointment.clinic, tbl_appointment.appointment_date, tbl_appointment.appointment_time, tbl_appointment.service, tbl_appointment.dentist, tbl_appointment.status
FROM tbl_appointment
LEFT JOIN tbl_user
ON tbl_appointment.user_id = tbl_user.user_id";

if (isset($_POST['search']['value'])) {
    $query .= '
 WHERE (tbl_appointment.appointment_id LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_user.firstname LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_user.lastname LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_appointment.clinic LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_appointment.appointment_date LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_appointment.appointment_time LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_appointment.service LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_appointment.dentist LIKE "%' . $_POST['search']['value'] . '%"
 OR tbl_appointment.status LIKE "%' . $_POST['search']['value'] . '%" )
 ';
}

if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY tbl_appointment.appointment_id DESC ';
}

$query1 = '';

if ($_POST['length'] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['appointment_id'];
    $sub_array[] = $row['firstname'];
    $sub_array[] = $row['lastname'];
    $sub_array[] = $row['clinic'];
    $sub_array[] = $row['appointment_date'];
    $sub_array[] = $row['appointment_time'];
    $sub_array[] = $row['service'];
    $sub_array[] = $row['dentist'];
    $sub_array[] = $row['status'];
    $sub_array[] = '
    <button type="button" id="get_update" data-id="'.$row['appointment_id'].'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
    ';
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT tbl_appointment.appointment_id, tbl_user.firstname, tbl_user.lastname, tbl_appointment.clinic, tbl_appointment.appointment_date, tbl_appointment.appointment_time, tbl_appointment.service, tbl_appointment.dentist, tbl_appointment.status
    FROM tbl_appointment
    LEFT JOIN tbl_user
    ON tbl_appointment.user_id = tbl_user.user_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data' => $data,
);

echo json_encode($output);
