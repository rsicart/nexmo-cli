<?php
/*
 * This file is part of the Onema nexmo-cli Package.
 * For the full copyright and license information, 
 * please view the LICENSE file that was distributed 
 * with this source code.
 */
namespace Onema\NexmoCli\Command;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;

/**
 * SmsCommand - Description.
 *
 * @author Juan Manuel Torres <kinojman@gmail.com>
 * @copyright (c) 2014, onema.io
 */

class BaseCommand extends Command
{

    protected function configure()
    {
        $this
            ->addArgument(
                'text',
                InputArgument::REQUIRED,
                'Required text'
            )
            ->addArgument(
                'phone',
                InputArgument::REQUIRED,
                'To phone number'
            )
        ;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getClient()
    {
        $config = $this->getConfiguration();

        $client = new Client([
            'base_url' => 'https://rest.nexmo.com',
            'defaults' => [
                'body' => [
                    'api_key' => $config['api_key'],
                    'api_secret' => $config['api_secret'],
                    'from' => $config['account_from_number'],
                ]
            ]
        ]);

        $client->setDefaultOption('body/api_key', $config['api_key']);

        return $client;
    }

    protected function getConfiguration()
    {
        $path = __DIR__.'/../../../../app/config/parameters.yml';
        $configValues = Yaml::parse($path);
        return $configValues['parameters']['nexmo'];
    }

}