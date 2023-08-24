<?php
// In src/Shell/ApiIntegrationShell.php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Http\Client;

class ApiIntegrationShell extends Shell
{
    public function main()
    {
        // API configuration
        $apiUrl = 'https://api.adgatemedia.com/v3/offers/';
        $apiKey = '155efa664a706f295fb446570041d707';
        $queryParams = [
            'aff' => 48864,
            'api_key' => $apiKey,
            'wall_code' => 'o6qb'
        ];

        // Make the API request
        $http = new Client();
        $response = $http->get($apiUrl, $queryParams);

        // Process the API response and save to the database
        if ($response->isOk()) {
            //$apiData = $response->;
            $this->out('API request successful');
            // Process $apiData and save to the offers table
            // Use your OffersTable or model to save the data
        } else {
            $this->out('API request failed');
        }
    }
}
