
<?php require_once 'header.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group mb-3">
                <label> Название отдела</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Введите название" value="">
            </div>

            <div class="alert alert-info mt-2" id="infoBlock"></div>

            <button type="button" id="addDepartment" class="btn btn-success">Добавить</button>

        </form>
    </div>


    <!-- AJAX -->
    <script>
        $('#infoBlock').hide();
        $('#addDepartment').click(function (){

            var name = $('#name').val();

            var mess = 'OK';
            $.ajax({
                url: '/department/addDepartment',
                type: 'POST',
                cache: false,
                data: {'name' :name },
                dataType: 'html',
                success: function(data){
                    // if(typeof(data) === "boolean") {
                    //     $('#addWiki').text('Done');
                    //     $('#errorBlock').hide();
                    // }
                    // else {
                        $('#infoBlock').show();
                        $('#infoBlock').text(data);
                    // }
                }
            });
        });
    </script>

<?php require_once 'footer.php';?>