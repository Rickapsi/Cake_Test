<!-- In src/Template/Offers/index.ctp -->
<table id="offersTable" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Requirements</th>
            <th>Description</th>
            <th>ECPC</th>
            <th>Click URL</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($offers as $offer): ?>
            <tr>
                <td><?= h($offer->name) ?></td>
                <td><?= h($offer->requirements) ?></td>
                <td><?= h($offer->offer_desc) ?></td>
                <td><?= h($offer->ecpc) ?></td>
                <td>
                    <a href="<?= h($offer->click_url) ?>" target="_blank">
                        <?= h($offer->click_url) ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>