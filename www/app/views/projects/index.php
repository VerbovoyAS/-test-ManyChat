<?php
//var_dump($data ?? 'projects');die;
?>

<?php require_once 'header.php';?>

<main class="container">

    <a href="/projects/add" class="btn btn-warning">Добавить проект</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дата редактирования</th>
            <th scope="col">Редактирование</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $value):?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['created_at'] ?></td>
                <td><?= $value['updated_at'] ?></td>
                <td>
                    <a href="/projects/update?id=<?=$value['id']?>" class="btn btn-primary btn-sm">редактировать</a>
                    <a href="/projects/delete?id=<?=$value['id']?>" class="btn btn-danger btn-sm" onclick='return confirm("Вы дейстиветельно хотите удалить - <?= $value['name'] ?> ?")'>удалить</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</main>


<?php require_once 'footer.php';?>
