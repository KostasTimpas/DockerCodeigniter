<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Cache\CacheFactory;

class CacheTest extends Controller
{

    /**
     * @var \CodeIgniter\Cache\CacheInterface
     */
    protected $cache;

    public function __construct()
    {
        // Get an instance of the cache service.
        $this->cache = service('cache');
    }

    /**
     * Store a product in memcache.
     */
    public function store()
    {
        // 1. Prepare data to be stored (e.g., from a form submission).
        $product = [
            'id' => 126,
            'name' => 'Liarop2 Gadget',
            'price' => 10000000.99,
            'description' => 'Lololo',
        ];

        // 2. Define a unique key for the item.
        $cacheKey = 'product_details_' . $product['id'];

        // 3. Store the data in memcache for 1 hour (3600 seconds).
        // The `save()` method returns true on success, false on failure.
        $isSaved = $this->cache->save($cacheKey, $product, 50);

        if ($isSaved) {
            $data = [
                'message' => 'Product successfully stored in Memcached.',
                'product_id' => $product['id']
            ];
            return view('products/store_success', $data);
        } else {
            // Handle the case where saving to cache failed.
            $data = ['error_message' => 'Failed to store product in Memcached.'];
            return view('products/store_error', $data);
        }
    }

    /**
     * Retrieve a product from memcache and show it to the user.
     * @param int $id
     */
    public function show($id)
    {
        // 1. Define the cache key.
        $cacheKey = 'product_details_' . $id;

        // 2. Attempt to retrieve data from memcache.
        // The `get()` method returns null if the key doesn't exist.
        $product = $this->cache->get($cacheKey);

        // 3. Check if the product was found in the cache.
        if ($product) {
            // If found, load the view and pass the cached data.
            $data['product'] = $product;
            $data['source'] = 'Memcached';
            return view('products/show', $data);
        } else {
            // Best Practice: If not in cache, fetch from the database.
            // For this example, we'll just simulate a database fetch.
            $productFromDb = $this->fetchProductFromDatabase($id);

            if ($productFromDb) {
                // Store the data in memcache for future requests.
                $this->cache->save($cacheKey, $productFromDb, 3600);

                // Pass the data to the view.
                $data['product'] = $productFromDb;
                $data['source'] = 'Database';
                return view('products/show', $data);
            } else {
                // Handle product not found in either cache or database.
                return view('products/not_found');
            }
        }
    }

    /**
     * Simulates fetching product data from a database.
     * In a real application, this would be a model method.
     */
    private function fetchProductFromDatabase($id)
    {
        // ... Logic to query the database ...
        // For this example, we'll return a hardcoded array if id is 123
        if ($id == 123) {
            return [
                'id' => 123,
                'name' => 'Fancy Gadget (from DB)',
                'price' => 99.99,
                'description' => 'A high-tech gadget with many features.',
            ];
        }
        return null;
    }

    public function clear()
    {
        $cache = \Config\Services::cache();
        $cache->delete('test_key');

        return $this->response->setJSON([
            'status' => 'cleared'
        ]);
    }
}
