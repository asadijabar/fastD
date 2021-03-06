<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\ServiceProvider;


use FastD\Config\ConfigLoader;
use FastD\Container\Container;
use FastD\Container\ServiceProviderInterface;
use medoo;

/**
 * Class DatabaseServiceProvider
 * @package FastD\ServiceProvider
 */
class DatabaseServiceProvider implements ServiceProviderInterface
{
    protected $db;

    /**
     * @param Container $container
     * @return void
     */
    public function register(Container $container)
    {
        $config = ConfigLoader::loadPhp(app()->getAppPath() . '/config/database.php');

        $container->add('database', function () use ($config) {
            if (null === $this->db) {
                $this->db = new medoo($config);
            }
            return $this->db;
        });

        unset($config);
    }
}