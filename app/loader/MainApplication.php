<?php

use Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\View,
    Phalcon\Mvc\Url as UrlResolver,
    Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
    Phalcon\Mvc\View\Engine\Volt as VoltEngine,
    Phalcon\Session\Adapter\Files as SessionAdapter;

class MainApplication extends \Phalcon\Mvc\Application
{
    private $config;

    public function main()
    {
        $this->setServices();
        echo $this->getCompressedContent();
    }

    private function setServices()
    {
        $di = new FactoryDefault();
        $di->set('config', $this->setConfig());
        $this->setAutoloaders();
        $di->set('url', $this->setUrl(), true);
        $di->set('router', $this->setRouter());
        $this->setDI($di);
        $di->set('view', $this->setView(), true);
        $di->set('db', $this->setDb());
        $di->set('modelsMetadata', $this->setModelsMetadata());
        $di->set('session', $this->setSession());
        $this->setDI($di);
    }

    private function setConfig()
    {
        $this->config = include_once __DIR__ . "/../config/config.php";

        return $this->config;
    }

    private function setAutoloaders()
    {
        $loader = new \Phalcon\Loader();
        $loader->registerNamespaces([
            'Controllers' => $this->config->application->controllersDir,
            'Models' => $this->config->application->modelsDir,
            'Forms' => $this->config->application->formsDir,
            'Elements' => $this->config->application->elementsDir,
            'Plugins' => $this->config->application->pluginsDir,
            'Library' => $this->config->application->libraryDir,
        ]);
        $loader->register();
    }

    private function setUrl()
    {
        $url = new UrlResolver();
        $url->setBaseUri($this->config->application->baseUri);

        return $url;
    }

    private function setRouter()
    {
        return include_once __DIR__ . "/../config/routes.php";
    }

    private function setView()
    {
        $view = new View();
        $view->setViewsDir($this->config->application->viewsDir);
        $view->setLayoutsDir('layouts/');
        $view->setLayout('index');
        $view->registerEngines([
            '.volt' => $this->setVolt($view),
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
        ]);

        return $view;
    }

    private function setVolt($view)
    {
        $volt = new VoltEngine($view, $this->getDI());
        $volt->setOptions([
            'compiledPath' => $this->config->application->cacheDir . 'views/',
            'compiledSeparator' => '_',
        ]);

        return $volt;
    }

    private function setDb()
    {
        return new DbAdapter([
            'host' => $this->config->database->host,
            'username' => $this->config->database->username,
            'password' => $this->config->database->password,
            'dbname' => $this->config->database->dbname
        ]);
    }

    private function setModelsMetadata()
    {
        return new \Phalcon\Mvc\Model\Metadata\Files(array(
            'metaDataDir' => $this->config->application->cacheDir . 'models/'
        ));
    }

    private function setSession()
    {
        $session = new SessionAdapter();
        $session->start();

        return $session;
    }

    private function getCompressedContent()
    {
        $content = $this->handle()->getContent();
        $search = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/>(\s)+</', '/\n/', '/\r/', '/\t/'];
        $replace = ['>', '<', '\\1', '><', '', '', ''];

        return preg_replace($search, $replace, $content);
    }
}