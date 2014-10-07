<?php
/*
 * This file is part of the Onema nexmo-cli Package.
 * For the full copyright and license information, 
 * please view the LICENSE file that was distributed 
 * with this source code.
 */
namespace Onema\NexmoCli\Command;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * TtsCommand - Description.
 *
 * @author Juan Manuel Torres <kinojman@gmail.com>
 * @copyright (c) 2014, onema.io
 */
class TtsCommand  extends BaseCommand
{

    protected function configure()
    {
        parent::configure();
        $this
            ->setName('nexmo:tts')
            ->setDescription('Text to Speech. Call a number and convert text to speech.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        try {
            $response = $this->client->post('tts/json', [
                'body' => [
                    'to' => $this->phone,
                    'text' => $this->text,
                ]
            ]);
            $data = $response->json();
            $output->writeln('<info>Just TTS the following message: ' . $this->text . '</info>');
            $output->writeln('<info>API response: '.print_r($data, true).'</info>');
        } catch (ClientErrorResponseException $e) {
            $output->writeln('<error>ERROR: '.$e->getMessage().'</error>');
        }
    }
}