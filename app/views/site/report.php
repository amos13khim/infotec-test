<?php
/** @var yii\web\View $this */
/** @var array $rows */
/** @var int $selectedYear */
/** @var array $years */

use yii\helpers\Html;

$this->title = 'Top 10 authors by year';
?>
<div class="py-4">
    <h1 class="mb-3">Top 10 authors by year</h1>

    <form method="get" class="row g-2 align-items-end mb-4">
        <div class="col-md-3">
            <label class="form-label">Year</label>
            <select class="form-select" name="year">
                <?php foreach ($years as $year): ?>
                    <option value="<?= (int) $year ?>" <?= ((int) $year === $selectedYear) ? 'selected' : '' ?>><?= (int) $year ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Show</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Author</th>
                        <th>Books count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= Html::encode($row['author_name']) ?></td>
                            <td><?= (int) $row['books_count'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($rows)): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">No data for this year.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
