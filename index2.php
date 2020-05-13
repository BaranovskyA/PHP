<?php

require_once "functions.php";
include "db_helpers.php";

$data = mysql_first('lessons.books', '*', ['id'=>1]);

mysql_insert('lessons.books', [
    'title' => 'Hello',
    'author' => 'world'
]);

mysql_update('lessons.books', ['id' => 1], ['id' => 4, 'author' => 6]);
// $connection = mysqli_connect('localhost', 'root', 'Sasha10asd!', 'lessons');

// if (mysqli_connect_errno($connection)) {
//     exit(mysqli_connect_error($connection));
// }

// $query = 'SELECT * FROM books';
// $result = mysqli_query($connection, $query);
// $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// mysqli_close($connection);

// ?>

<!-- <table border='1'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Автор</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($data as $row): ?>
            <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['title']?></td>
                <td><?=$row['author']?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> -->

