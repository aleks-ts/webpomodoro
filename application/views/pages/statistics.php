<div class="page-header">
    <h2>
        Statistics<small> of planned and done pomodoro's per date and user. </small>
    </h2>
</div>

<table class="table table-striped table-bordered">
    <thead>
    <th>ID</th>
    <th>Date</th>
    <th>Task</th>
    <th>User</th>
    <th>Pomodoro Planned</th>
    <th>Pomodoro Done</th>
    </thead>
    <tbody>
    <?php foreach ($stats as $s){ ?>
    <tr>
        <td><?php echo HtmlHelper::out($s->task_id) ?></td>
        <td><?php echo HtmlHelper::out($s->pomodoro_date) ?></td>
        <td <?php if($s->completed) {echo "style='text-decoration: line-through'";}?>><?php echo HtmlHelper::out($s->task) ?></td>
        <td><?php echo HtmlHelper::out($s->user) ?></td>
        <td><?php echo HtmlHelper::out($s->pomodoro_planned) ?></td>
        <td><?php echo HtmlHelper::out($s->pomodoro_done) ?></td>
    </tr>
      <?php } ?>
</table>