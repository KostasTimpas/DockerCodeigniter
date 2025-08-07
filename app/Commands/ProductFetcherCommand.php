<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Cache\CacheFactory;

class ProductFetcherCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Cron';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'cron:store_products_to_memcache';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'This is my custom cron command.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'cron:store_products_to_memcache';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

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
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        CLI::write('Starting my custom cron command...', 'yellow');

        // --- Your cron logic goes here ---
        // For example, fetching data, processing a queue, sending emails, etc.
        $this->doSomething();

        CLI::write('My custom cron command finished successfully.', 'green');
    }

    private function doSomething()
    {
        // Example logic
        CLI::write('Hello from the cron command!', 'blue');
        // --- Best Practice: Use a lock file to prevent multiple instances ---
        $lockFile = WRITEPATH . 'cache/product_fetch.lock';
        $fp = fopen($lockFile, 'w+');

        if (!flock($fp, LOCK_EX | LOCK_NB)) {
            CLI::error('Another instance of the product fetcher is already running. Exiting.');
            fclose($fp);
            return;
        }

        CLI::write(CLI::color('Starting product fetch process...', 'green'));

        try {
            // Get an instance of the cache service
            $cache = service('cache');

            // Δημιουργία λίστας με 10 προϊόντα (μπορείς να τα αντικαταστήσεις με πραγματικά δεδομένα)
            $products = [
                [
                    'id' => 101,
                    'name' => 'Product 1',
                    'price' => 9.99,
                    'description' => 'Description for product 1',
                ],
                [
                    'id' => 102,
                    'name' => 'Product 2',
                    'price' => 19.99,
                    'description' => 'Description for product 2',
                ],
                [
                    'id' => 103,
                    'name' => 'Product 3',
                    'price' => 29.99,
                    'description' => 'Description for product 3',
                ],
                [
                    'id' => 104,
                    'name' => 'Product 4',
                    'price' => 39.99,
                    'description' => 'Description for product 4',
                ],
                [
                    'id' => 105,
                    'name' => 'Product 5',
                    'price' => 49.99,
                    'description' => 'Description for product 5',
                ],
                [
                    'id' => 106,
                    'name' => 'Product 6',
                    'price' => 59.99,
                    'description' => 'Description for product 6',
                ],
                [
                    'id' => 107,
                    'name' => 'Product 7',
                    'price' => 69.99,
                    'description' => 'Description for product 7',
                ],
                [
                    'id' => 108,
                    'name' => 'Product 8',
                    'price' => 79.99,
                    'description' => 'Description for product 8',
                ],
                [
                    'id' => 109,
                    'name' => 'Product 9',
                    'price' => 89.99,
                    'description' => 'Description for product 9',
                ],
                [
                    'id' => 110,
                    'name' => 'Product 10',
                    'price' => 99.99,
                    'description' => 'Description for product 10',
                ],
            ];

            foreach ($products as $product) {
                $cacheKey = 'product_details_' . $product['id'];

                $isSaved = $cache->save($cacheKey, $product, 50); // expires in 50 seconds

                if ($isSaved) {
                    CLI::write(CLI::color("✅ Product ID {$product['id']} stored in cache.", 'green'));
                    log_message('info', "Stored Product ID {$product['id']} to cache.");
                } else {
                    CLI::error("❌ Failed to store Product ID {$product['id']}.");
                    log_message('error', "Failed to store Product ID {$product['id']}.");
                }
            }

        }catch (\Exception $e) {
            CLI::error('An error occurred: ' . $e->getMessage());
            log_message('error', 'Error in product fetch process: ' . $e->getMessage());
        } finally {
            // --- Best Practice: Release the lock ---
            flock($fp, LOCK_UN);
            fclose($fp);
            CLI::write(CLI::color('Product fetch process finished.', 'green'));
        }
    }
}