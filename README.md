# symfony-console-spinner

Custom symfony progressbar with a spinner.

I wanted a progressbar displaying a long running task like
waiting for an external resource to be available. This is where I
stumbled upon [alecrabbit/php-cli-snake](https://github.com/alecrabbit/php-cli-snake).

I tried to mimic the the animation using symfony/console and this
is the result:

![example of multiple progress bars with this spinner component](docs/spinnerprogress.gif)

## Installation

Use composer to require the small package

```bash
composer require icanhazstring/symfony-console-spinner
```

## Usage

To use the spinner, just instantiate the `SpinnerProgress` like the
default `ProgressBar` from symfony giving it the `OutputInterface` and
the maximum count of items to process:

```php
public function execute(OutputInterface $output, InputInterface $input)
{
    $spinner = new SpinnerProgress($output, 100);

    for($i = 0; $i < 100; $i++) {

        usleep(1000);

        $spinner->advance();

    }

    $spinner->finish();
}
```

You can also get the underlying `ProgressBar` instance if you want to change anything, for example adding the elapsed time to the output format:

```php
$spinner = new SpinnerProgress($output, 100);
$spinner->getProgressBar()->setFormat('%bar% (%elapsed:6s%) %message%');
```

## License

This package is released under the [MIT license](LICENSE).
