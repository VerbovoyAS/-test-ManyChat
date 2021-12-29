<?php require_once 'header.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group mb-3">
                <label>Имя</label>
                <input id="id" class="form-control d-none" type="text" name="name" placeholder="id"
                       value="<?= $data['getStaff']['id'] ?? '' ?>">
                <input id="name" class="form-control" type="text" name="name" placeholder="Введите имя"
                       value="<?= $data['getStaff']['name'] ?>">
            </div>

            <div class="form-group mb-3">
                <label>Фамилия</label>
                <input id="surname" class="form-control" type="text" name="surname" placeholder="Введите фамилию"
                       value="<?= $data['getStaff']['surname'] ?>">
            </div>

            <div class="form-group mb-3">
                <label>Пол</label>
                <select id="gender" name='gender' class='form-control'>
                    <option value=''>Выбирите пол...</option>
                    <option <?= $data['getStaff']['gender'] == 1 ? 'Selected' : '' ?> value='1'>Мужской</option>
                    <option <?= $data['getStaff']['gender'] == 2 ? 'Selected' : '' ?> value='2'>Женский</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Дата рождения</label>
                <input id="birthday" class="form-control" type="date" name="birthday"
                       placeholder="Введите дату рождения"
                       value="<?= $data['getStaff']['birthday'] ?>">
            </div>

            <div class="form-group mb-3">
                <label>Зарплата</label>
                <input id="salary" class="form-control" type="text" name="salary" placeholder="Укажите зарплату"
                       value="<?= $data['getStaff']['salary'] ?>">
            </div>

            <div class="form-group mb-3">
                <label>Отдел</label>
                <select id="department" name='department' class='form-control'>
                    <?= $data['getDepartment'] ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Проект</label>
                <select id="project" name='project' class='form-control'>
                    <?= $data['getProject'] ?>
                </select>
            </div>

            <div class="alert alert-info mt-2" id="infoBlock"></div>

            <button type="button" id="updateStaff" class="btn btn-success">Обновить</button>

        </form>
    </div>


    <!-- AJAX -->
    <script>
        $('#infoBlock').hide();
        $('#updateStaff').click(function () {

            var id = $('#id').val();
            var name = $('#name').val();
            var surname = $('#surname').val();
            var gender = $('#gender').val();
            var birthday = $('#birthday').val();
            var salary = $('#salary').val();
            var department = $('#department').val();
            var project = $('#project').val();

            $.ajax({
                url: '/staff/updateStaff',
                type: 'POST',
                cache: false,
                data: {
                    'id': id,
                    'name': name,
                    'surname': surname,
                    'gender': gender,
                    'birthday': birthday,
                    'salary': salary,
                    'department': department,
                    'project': project
                },
                dataType: 'html',
                success: function (data) {
                    $('#infoBlock').show();
                    $('#infoBlock').text(data);
                }
            });
        });
    </script>

<?php require_once 'footer.php'; ?>