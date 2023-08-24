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

        // Api controls
        if ($response->isOk()) { //On success
            $this->out('API request successful');
            $apiData = $response->getJson()['data'];
            
            $offersTable = $this->loadModel('offers');

            // Encryption key (replace with your actual key)
            $encryptionKey = '88d0a029e9770818280a65dfdfc6c259e542371cf5f423c2b97a0c6078774733';

            //Inputting data into offer table
            foreach ($apiData as $offer) {
                
                //pad iv param in encryption s.t. it is 16bit (prevents warnings)
                $iv = str_pad($offer['id'], 16, "\0");

                $newOffer = $offersTable->newEntity([
                    'offer_id' => $offer['id'],
                    'name' => $offer['name'],
                    'anchor' => $offer['anchor'],
                    'requirements' => openssl_encrypt($offer['requirements'], 'aes-256-cbc', $encryptionKey, 0, $iv),
                    'offer_desc' => openssl_encrypt($offer['description'], 'aes-256-cbc', $encryptionKey, 0, $iv),
                    'ecpc' => $offer['epc'],
                    'click_url' => openssl_encrypt($offer['click_url'], 'aes-256-cbc', $encryptionKey, 0, $iv),
                    'support_url' => openssl_encrypt($offer['support_url'], 'aes-256-cbc', $encryptionKey, 0, $iv),
                    'preview_url' => openssl_encrypt($offer['preview_url'], 'aes-256-cbc', $encryptionKey, 0, $iv),
                ]);
            
                if ($offersTable->save($newOffer)) {
                    $this->out('Offer saved: ' . $newOffer->id);
                } else {
                    $this->out('Error saving offer: ' . print_r($newOffer->getErrors(), true));
                }
            }

        } else { //On fail
            $this->out('API request failed');
        }
    }
}
