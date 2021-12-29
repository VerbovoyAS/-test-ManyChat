<?php
//var_dump($data ?? 111);
?>

<?php require_once 'header.php'; ?>

<main class="container">

    <table>

    </table>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID проекта</th>
            <th scope="col">Название проекта</th>
            <th scope="col">Бюджет</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $value): ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['name'] ?></td>
                <td><?= $value['budget'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>


<?php require_once 'footer.php'; ?>
