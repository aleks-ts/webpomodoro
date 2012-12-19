
<?php if(!$loaded) {?>
    <div class='alert'>
        <button type='button' class='close' data-dismiss='alert'>×</button>
        <strong>Внимание!</strong> Введен неправильный ID! =  <?php echo $wrong_id?>
    </div>
<?php }else{?>
    <table class="table table-striped table-bordered">
        <thead>
            <th>ID</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Email</th>
        </thead>
        <tr>
            <td><?php echo HtmlHelper::out($customer->customer_id) ?></td>
            <td><?php echo HtmlHelper::out($customer->name) ?></td>
            <td><?php echo HtmlHelper::out($customer->surname) ?></td>
            <td><?php echo HtmlHelper::out($customer->email) ?></td>
        </tr>
    </table>

<a href="../index/<?php echo $customer->customer_id; ?>?ret=customer/showall"><button type="button" class="btn btn-warning">Редактировать</button></a>
<a href="../delete/<?php echo $customer->customer_id; ?>"><button type="button" class="btn btn-danger">Удалить</button></a>

<?php }?>

<br><br>
<a href='/customer/showall'>Вернуться к списку пользователей</a>