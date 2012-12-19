<table class="table table-striped table-bordered">
    <thead>
    <th>ID</th>
    <th>Имя</th>
    <th>Фамилия</th>
    <th>Email</th>
    <th>Ред./Удалить</th>
    </thead>
    <?php foreach ($customers as $customer){ ?>
        <tr>
            <td><?php echo HtmlHelper::out($customer->customer_id) ?></td>
            <td><a href='show/<?php echo $customer->customer_id ?>'><?php echo HtmlHelper::out($customer->name) ?></a></td>
            <td><?php echo HtmlHelper::out($customer->surname) ?></td>
            <td><?php echo HtmlHelper::out($customer->email) ?></td>
            <td><div class="btn-group">
                <a href="index/<?php echo $customer->customer_id; ?>?ret=customer/showall"><button type="button" class="btn"><i class="icon-edit"></i></button></a>
                <a href="delete/<?php echo $customer->customer_id; ?>"><button type="button" class="btn"><i class="icon-remove"></i></button></a>
                </div>
            </td>
        </tr>
    <?php } ?>
</table>
<?php echo $pagination; ?>
