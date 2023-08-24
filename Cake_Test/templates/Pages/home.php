<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Test</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.min.js"></script>
</head>
<body>
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
        <!-- Data will be dynamically inserted here -->
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#offersTable').DataTable({
            ajax: {
                url: 'URL_TO_YOUR_API_ENDPOINT', // Replace with your actual API endpoint
                dataSrc: 'data' // Assuming the API response has a 'data' property
            },
            columns: [
                { data: 'name' },
                { data: 'requirements' },
                { data: 'offer_desc' },
                { data: 'ecpc' },
                {
                    data: 'click_url',
                    render: function(data, type, row) {
                        return '<a href="' + data + '" target="_blank">' + data + '</a>';
                    }
                }
            ]
        });
    });
</script>

</body>

