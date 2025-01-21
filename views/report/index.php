<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1><?= Html::encode($this->title) ?></h1>


<div class="report-search">
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    <div style="display: flex; gap: 10px; align-items: center;">
        <?= $form->field($searchModel, 'start_date')->input('date')->label(false) ?>
        <?= $form->field($searchModel, 'end_date')->input('date')->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Пошук', ['class' => 'btn btn-primary']) ?>
        </div>    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php if (!empty($data)): ?>
    <div class="report-table">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ПІБ</th>
                <th>Відключення</th>
                <th>Перевірка/здешевлення</th>
                <th>Тех. питання</th>
                <th>Інше</th>
                <th>Усього</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= Html::encode($row['agent_name']) ?></td>
                    <td><?= Html::encode($row['disconnect_count']) ?></td>
                    <td><?= Html::encode($row['verification_count']) ?></td>
                    <td><?= Html::encode($row['technical_count']) ?></td>
                    <td><?= Html::encode($row['other_count']) ?></td>
                    <td><?= Html::encode($row['total_count']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Немає даних для відображення.</p>
<?php endif; ?>
