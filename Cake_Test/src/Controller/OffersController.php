<?php

namespace App\Controller;
use App\Controller\AppController;

class OffersController extends AppController
{
    public function index()
    {
        $offersTable = $this->getTableLocator()->get('Offers'); 
        $offers = $offersTable->find('all');
        
        $encryptionKey = '88d0a029e9770818280a65dfdfc6c259e542371cf5f423c2b97a0c6078774733';

        // Decrypt fields if they are encrypted
        foreach ($offers as $offer) {
            $iv = str_pad($offer->offer_id, 16, "\0");

            $offer->requirements = openssl_decrypt($offer->requirements, 'aes-256-cbc', $encryptionKey , 0, $iv);
            $offer->offer_desc = openssl_decrypt($offer->offer_desc, 'aes-256-cbc', $encryptionKey, 0, $iv);
            $offer->click_url = openssl_decrypt($offer->click_url, 'aes-256-cbc', $encryptionKey, 0, $iv);
            $offer->support_url = openssl_decrypt($offer->support_url, 'aes-256-cbc', $encryptionKey, 0, $iv);
            $offer->preview_url = openssl_decrypt($offer->preview_url, 'aes-256-cbc', $encryptionKey, 0, $iv);
        }
        $this->set(compact('offers'));
    }
}
