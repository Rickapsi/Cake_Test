
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
    /* Custom styles for the autocomplete suggestions */
    .ui-autocomplete {
        max-height: 200px;
        max-width: 500px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: white;
    }

    .ui-autocomplete .ui-menu-item {
        padding: 5px;
        cursor: pointer;
    }

    .ui-autocomplete .ui-menu-item:hover {
        background-color: #f0f0f0;
    }
</style>


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

<script>
    $(document).ready(function() {
        $('#offersTable').DataTable({
            "columnDefs": [
                {
                    "targets": [3], // Index of the "ECPC" column (zero-based)
                    "orderable": true // Enable sorting for this column
                },
                {
                    "targets": "_all", // Disable sorting for all other columns
                    "orderable": false
                }
            ]
        });

        $.fn.dataTable.ext.search.push(
            function(settings, searchData, index, rowData, counter) {
                var searchTerm = $('#offersTable_filter input[type="search"]').val().toLowerCase();
                var nameData = rowData[0].toLowerCase(); // Assuming "Name" column is the first column (index 0)

                if (nameData.includes(searchTerm)) {
                    return true;
                }
                return false;
            }
        );

        // Initialize Autocomplete for the modified search input
        $('#offersTable_filter input[type="search"]').autocomplete({
            source: [
                <?php foreach ($offers as $offer): ?>
                    "<?= h($offer->name) ?>",
                <?php endforeach; ?>
            ],
            select: function(event, ui) {
                $('#offersTable_filter input[type="search"]').val(ui.item.value).trigger('input');
            }
        });
    });

    
</script>