<?php

namespace Shared\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function __construct(string $environment, bool $debug, private string $name)
    {
        $this->name = $_SERVER['APP_NAME'] ?? $name;
        parent::__construct($environment, $debug);
        $this->loadAppEnv();
    }

    private function loadAppEnv(): void
    {
        $dotenv = new Dotenv();
        $envFile = $this->getProjectDir() . '/apps/' . $this->name . '/.env';

        if (file_exists($envFile)) {
            $dotenv->usePutenv(true);
            $dotenv->load($envFile);
        }
    }

    public function getSharedConfigDir(): string
    {
        return $this->getProjectDir().'/config';
    }

    public function getAppConfigDir(): string
    {
        return $this->getProjectDir().'/apps/'.$this->name.'/config';
    }

    public function registerBundles(): iterable
    {
        $sharedBundles = require $this->getSharedConfigDir().'/bundles.php';
        $appBundles = require $this->getAppConfigDir().'/bundles.php';

        foreach (array_merge($sharedBundles, $appBundles) as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    public function getCacheDir(): string
    {
        return ($_SERVER['APP_CACHE_DIR'] ?? $this->getProjectDir().'/var/cache').'/'.$this->name.'/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return ($_SERVER['APP_LOG_DIR'] ?? $this->getProjectDir().'/var/log').'/'.$this->name;
    }

    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader): void
    {
        $this->doConfigureContainer($container, $this->getSharedConfigDir());
        $this->doConfigureContainer($container, $this->getAppConfigDir());
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $this->doConfigureRoutes($routes, $this->getSharedConfigDir());
        $this->doConfigureRoutes($routes, $this->getAppConfigDir());
    }

    private function doConfigureContainer(ContainerConfigurator $container, string $configDir): void
    {
        $container->import($configDir.'/{packages}/*.{php,yaml}');
        $container->import($configDir.'/{packages}/'.$this->environment.'/*.{php,yaml}');

        if (is_file($configDir.'/services.yaml')) {
            $container->import($configDir.'/services.yaml');
            $container->import($configDir.'/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import($configDir.'/{services}.php');
        }
    }

    private function doConfigureRoutes(RoutingConfigurator $routes, string $configDir): void
    {
        $routes->import($configDir.'/{routes}/'.$this->environment.'/*.{php,yaml}');
        $routes->import($configDir.'/{routes}/*.{php,yaml}');

        if (is_file($configDir.'/routes.yaml')) {
            $routes->import($configDir.'/routes.yaml');
        } else {
            $routes->import($configDir.'/{routes}.php');
        }

        if (false !== ($fileName = (new \ReflectionObject($this))->getFileName())) {
            $routes->import($fileName, 'annotation');
        }
    }
}