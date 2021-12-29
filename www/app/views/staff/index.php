<?php require_once 'header.php'; ?>

<main class="container">

    <a href="/staff/add" class="btn btn-warning">Добавить проект</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Пол</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Зарплата</th>
            <th scope="col">Департамент</th>
            <th scope="col">Проект</th>
            <th scope="col">дата создания</th>
            <th scope="col">дата обновления</th>
            <th scope="col">редактирование</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['staffList'] as $value): ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['surname'] ?></td>
                <td><?= $data['gender'][$value['gender']] ?></td>
                <td><?= $value['birthday'] ?></td>
                <td><?= $value['salary'] ?></td>
                <td><?= $data['projectList'][$value['project_id']] ?></td>
                <td><?= $data['departmentList'][$value['department_id']] ?></td>
                <td><?= $value['created_at'] ?></td>
                <td><?= $value['updated_at'] ?></td>
                <td>
                    <a href="/staff/update?id=<?= $value['id'] ?>" class="btn btn-primary btn-sm">редактировать</a>
                    <a href="/staff/delete?id=<?= $value['id'] ?>" class="btn btn-danger btn-sm"
                       onclick='return confirm("Вы дейстиветельно хотите удалить - <?php echo $value['name'] . ' ' . $value['surname'] ?> ?")'>удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>


<?php require_once 'footer.php'; ?>
