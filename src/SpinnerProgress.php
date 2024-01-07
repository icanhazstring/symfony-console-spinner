<?php

declare(strict_types=1);

namespace icanhazstring\SymfonyConsoleSpinner;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class SpinnerProgress
{
    private const CHARS = ['⠏', '⠛', '⠹', '⢸', '⣰', '⣤', '⣆', '⡇'];

    /**
     * @var ProgressBar
     */
    private $progressBar;
    /**
     * @var int
     */
    private $step;

    public function __construct(OutputInterface $output, int $max = 0)
    {
        $this->progressBar = new ProgressBar($output, $max);
        $this->progressBar->setBarCharacter('✔');
        $this->progressBar->setFormat('%bar%  %message%');
        $this->progressBar->setBarWidth(1);
        $this->progressBar->setRedrawFrequency(31);

        $this->step = 0;
    }

    public function advance(int $step = 1): void
    {
        $this->step += $step;
        $this->progressBar->setProgressCharacter(self::CHARS[$this->step % 8]);
        $this->progressBar->advance($step);
    }

    public function setMessage(string $message): void
    {
        $this->progressBar->setMessage($message, 'message');
    }

    public function finish(): void
    {
        $this->progressBar->finish();
    }

    public function getProgressBar(): ProgressBar
    {
        return $this->progressBar;
    }
}
