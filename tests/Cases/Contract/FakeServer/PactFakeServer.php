<?php

namespace App\Tests\Cases\Contract\FakeServer;

use Symfony\Component\Process\Process;

class PactFakeServer
{
    public function __construct(
        private readonly Process $process,
        private readonly string $host,
    )
    {
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function start(): void
    {
        $logLevel = getenv('PACT_LOGLEVEL');

        if ($this->process->isRunning()) {
            return;
        }

        if ($logLevel == 'DEBUG') {
            $callback = function (string $type, string $buffer): void {
                echo "\n$type > $buffer";
            };
        }

        $this->process->start($callback ?? null);

        $this->process->waitUntil(function (): bool {
            $fp = @fsockopen($this->getHost());

            if ($serverIsOpen = is_resource($fp)) {
                fclose($fp);
            }

            return $serverIsOpen;
        });
    }

    public function stop(): void
    {
        $this->process->stop();
    }
}
