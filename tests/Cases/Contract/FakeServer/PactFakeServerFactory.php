<?php

namespace App\Tests\Cases\Contract\FakeServer;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PactFakeServerFactory
{
    public static function create(): PactFakeServer
    {
        $port = self::generatePort();
        $host = sprintf('127.0.0.1:%d', $port);
        $process = self::createProcess($host);

        return new PactFakeServer($process, $host, $port);
    }

    private static function createProcess(string $host): Process
    {
        return new Process(['php', '-S', $host, "-t", BASE_PATH]);
    }

    private static function generatePort(): int
    {
        $port = rand(1111, 9999);

        if (self::isAvaiblePort($port)) {
            return $port;
        }

        return self::generatePort();
    }

    private static function isAvaiblePort(int $port): bool
    {
        $process = new Process(['netstat', '-an']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return !preg_match('/:' . $port . '\s+LISTEN/', $process->getOutput());
    }
}
