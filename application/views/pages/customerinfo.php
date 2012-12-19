

    <form class="form-signin" method="POST" action="">

        <h2 class="form-signin-heading"><?php echo HtmlHelper::out($title) ?></h2>

    <?php if(!$valid) {?>
        <div class="alert alert-error">
            <div>Внимание! Ошибка ввода данных!</div>
        </div>
    <?php }elseif ($valid and $edit){?>
        <div class="alert alert-success">
            <div>Данные успешно сохранены.</div>
        </div>
    <?php }?>


        <div class="control-group">
            <label class="control-label" for="name">Имя*:</label>
            <div class="controls">
                <input type="text" name="name" id="name" placeholder="Введите ваше имя" value="<?php echo HtmlHelper::out($customer->name) ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Фамилия*:</label>
            <div class="controls">
                <input type="text" name="surname" id="surname" placeholder="Введите вашу фамилию" value="<?php echo HtmlHelper::out($customer->surname) ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email">Email*:</label>
            <div class="controls">
                <input type="text" name="email" id="email" placeholder="Введите ваш email" value="<?php echo HtmlHelper::out($customer->email) ?>">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="submit" name="action" value="save" class="btn btn-large btn-primary">Сохранить</button>
                <button type="submit" name="action" value="cancel" class="btn btn-large btn-primary">Отмена</button>
            </div>
        </div>
    </form>

<div align="center">
    <a href='/customer/showall'>Вернуться к списку пользователей</a>
</div>



