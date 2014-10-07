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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;

/**
 * CallCommand - Description.
 *
 * @author Roger Sicart <roger.sicart@gmail.com>
 * @author Michael Inthilith <minthilith@gmail.com>
 * @copyright (c) 2014
 */
class CallCommand extends BaseCommand
{

    protected $answer_url;

    protected function configure()
    {
        $this
            ->addArgument(
                'phone',
                InputArgument::REQUIRED,
                'To phone number'
            )
            ->addOption(
                'config-file',
                'c',
                InputArgument::OPTIONAL,
                'Yaml custom config file'
            )
            ->addArgument(
                'answer_url',
                InputArgument::REQUIRED,
                'VoiceXML file url'
            )
            ->addArgument(
                'text',
                InputArgument::OPTIONAL,
                'Override default text to speech'
            )
            ->setName('nexmo:call')
            ->setDescription('Call a number with XML answer_url required.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        try {
            $response = $this->client->post('call/json', [
                'body' => [
                    'to' => $this->phone,
                    'answer_url' => $input->getArgument('answer_url'),
                ]
            ]);
            var_dump($input->answer_url);
            $data = $response->json();
            $output->writeln('<info>Just Call with the following file: ' . $input->answer_url . '</info>');
            $output->writeln('<info>API response: '.print_r($data, true).'</info>');
        } catch (ClientErrorResponseException $e) {
            $output->writeln('<error>ERROR: '.$e->getMessage().'</error>');
        }
    }
}