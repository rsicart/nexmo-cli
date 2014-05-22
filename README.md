nexmo-cli
=========

Send SMS and Voice messages from the command line using the Nexmo API


## Installation 

```shell
php composer.phar require onema/nexmo-cli:dev-master
```

## Configuration 
From the project root create a the following file `app/config/parameters.yml`

```yaml
#app/config/parameters.yml
parameters:
    nexmo:
        api_key: APIKey
        api_secret: APISecret
        account_from_number: AccountPhoneNumber
```

## Use 

Create a `console` file in the location of your choise. I will create it in the app directory
```php
#!/usr/bin/env php
<?php
// app/console
set_time_limit(0);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Onema\NexmoCli\Command\TtsCommand;
use Onema\NexmoCli\Command\SmsCommand;

$application = new Application();
$application->add(new TtsCommand());
$application->add(new SmsCommand());
$application->run();

```

### Send SMS
From the command line type the following command
```shell
nexmo:sms [text] [phone] 
```

Examaple 
```shell
nexmo:sms 'Hello World' 1234567890
```

### Send TTS
From the command line type the following command
```shell
nexmo:tts [text] [phone] 
```

Examaple 
```shell
nexmo:tts 'Hello World' 1234567890
```





