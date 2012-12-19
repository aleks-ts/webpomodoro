<div id="clock" class="label label-important" style="font-size: 20px" align="right">19:30</div>


<?php if(!$valid) {?>
<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div><strong>Внимание!</strong> Ошибка ввода данных!</div>
</div>
<?php }elseif ($valid  and $add){?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div><strong>Success!</strong> Данные успешно сохранены.</div>
</div>
<?php }?>

<script type="text/javascript">
    var curTime=0;
    var curTimerId=0;

    function timerCallback(){
        curTime++;
        if(curTime>=5){
            stopTimer();
            $.get('/tasklist/pomodoroComplete',null,function(){
                window.location.href=window.location.href;
            });

        }else{
            updateClock(curTime);
        }
    }

    function stopTimer()
    {
        if(curTimerId!=0){
            window.clearInterval(curTimerId);
            curTimerId=0;
        }
    }

    function startTimer(){
        curTime=0;
        curTimerId=window.setInterval(timerCallback, 1000);
    }

    function updateClock(sec)
    {
        var d=new Date(sec*1000);
        m=d.getMinutes();
        s=d.getSeconds();

        m=formatTime(m);
        s=formatTime(s);

        $('#clock').html(m.toString()+":"+ s.toString());
    }

    function formatTime(i)
    {
        if (i<10) {
            i="0" + i.toString();
        }
        return i;
    }

</script>

<button onclick="startTimer()">Start Timer</button>

<div style="margin-top: 10px; margin-bottom: 10px; border: solid 1px #eee; padding: 10px; background-color: #ffffff;">
    <form class="form-inline" method="POST" action="">
        <input type="text" name="title" class="input-xxlarge" placeholder="Title">
        <input type="text" name="estimated"  class="input-small" placeholder="Estimated">
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

<table class="table table-striped table-bordered">
    <thead>
    <th></th>
    <th>Task</th>
    <th>Estimated</th>
    <th>Actual</th>
    <th>Start/Stop</th>
    <th></th>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task){ ?>
            <tr <?php if($task->task_id==$running_task) {echo "class='success'"; } ?>>
                <td><input type="checkbox" onclick="completeTask(<?php echo $task->task_id, ",", $task->completed ?>)"
                    <?php if($task->completed) {echo "checked='true'";}?>></td>
                <td <?php if($task->completed) {echo "style='text-decoration: line-through'";}?>><?php echo HtmlHelper::out($task->title) ?></td>
                <td><?php echo HtmlHelper::out($task->estimated) ?></td>
                <td><?php echo HtmlHelper::out($task->actual) ?></td>
                <td><button class="btn"><i class=<?php if($task->task_id==$running_task) {echo "'icon-stop'";} else {echo "'icon-play'";}?>></i></button></td>
                <td><a href="/tasklist/delete/<?php echo HtmlHelper::out($task->task_id) ?>">delete</a></td>
            </tr>
            <?php } ?>
</table>

<?php echo "running task: ", $running_task; ?>

<script type="text/javascript">

    function completeTask(id, task_completed){
        if(task_completed==0){
            $.get('/tasklist/complete/'+id.toString(),null,function(){
                window.location.href=window.location.href;
            })
        }
        else{
            $.get('/tasklist/uncomplete/'+id.toString(),null,function(){
                window.location.href=window.location.href;
            })
        }
    }

</script>

































    <!--
<table class="table table-striped table-bordered">
    <thead>
        <th></th>
        <th>Task</th>
        <th>Planned</th>
        <th>Actual</th>
        <th>Start/Stop</th>
        <th></th>
    </thead>
    <tbody>
        <tr>
            <td><input type="checkbox" checked="true"></td>
            <td style="text-decoration: line-through ">setup database</td>
            <td>2</td>
            <td>3</td>
            <td></td>
            <td><a href="#">delete</a></td>
        </tr>
        <tr class="success">
            <td><input type="checkbox"></td>
            <td>make html template</td>
            <td>3</td>
            <td>3</td>
            <td><button class="btn"><i class="icon-stop"></i></button></td>
            <td><a href="#">delete</a></td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td>make user module</td>
            <td>4</td>
            <td>4</td>
            <td><button class="btn"><i class="icon-play"></i></button></td>
            <td><a href="#">delete</a></td>
        </tr>

    </tbody>
</table>
-->


