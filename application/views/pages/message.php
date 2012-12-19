

<div class='alert'>
    <button type='button' class='close' data-dismiss='alert'>×</button>
    <strong>Внимание!</strong> <?php echo HtmlHelper::out($message) ?>
    <?php echo HtmlHelper::out($name) ?>
    <?php echo HtmlHelper::out($surname) ?>
</div>

<a href='/customer/showall'>Вернуться к списку пользователей</a>