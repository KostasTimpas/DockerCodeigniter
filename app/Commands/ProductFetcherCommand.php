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
            // Your logic for fetching and storing data goes here
            // Get an instance of the cache service.
            $cache = service('cache');

            // Example: Prepare data to be stored (e.g., from a form submission).
            $product = [
                'id' => 126,
                'name' => 'Liarop2 Gadget',
                'price' => 10000000.99,
                'description' => 'Lololo',
            ];

            // Define a unique key for the item.
            $cacheKey = 'product_details_' . $product['id'];

            // Store the data in memcache for 50 seconds.
            $isSaved = $cache->save($cacheKey, $product, 50);

            if ($isSaved) {
                CLI::write(CLI::color("Product ID {$product['id']} successfully stored in cache.", 'green'));
                log_message('info', "Success in product store to memcache fetcher: Product ID {$product['id']}.");
            } else {
                CLI::error("Failed to store product ID {$product['id']} in cache.");
                log_message('error', "Error in product store to memcache fetcher: Product ID {$product['id']}.");
            }

        } catch (\Exception $e) {
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