<?php

namespace App\Tests\Cases\Contract;

use App\Tests\Cases\Contract\FakeServer\PactFakeServer;
use App\Tests\Cases\Contract\FakeServer\PactFakeServerFactory;
use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\ProviderVerifier\Model\Config\PublishOptions;
use PhpPact\Standalone\ProviderVerifier\Model\ConsumerVersionSelectors;
use PhpPact\Standalone\ProviderVerifier\Model\Selector\Selector;
use PhpPact\Standalone\ProviderVerifier\Model\Source\Broker;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PactVerifyTest extends KernelTestCase
{
    private PactFakeServer $server;

    protected function setUp(): void
    {
        self::bootKernel();

        PactManager::createPacts(self::getContainer());

        $this->server = PactFakeServerFactory::create();
        $this->server->start();
    }

    protected function tearDown(): void
    {
        $this->server->stop();
    }

    public function testPactVerifyConsumer(): void
    {
        $verifier = new Verifier($this->getConfig());
        $verifier->addBroker($this->getPactBroker());

        $verifyResult = $verifier->verify();

        $this->assertTrue($verifyResult);
    }

    private function getPactBroker(): Broker
    {
        $selectors = (new ConsumerVersionSelectors())
            ->addSelector(new Selector(mainBranch: true))
            ->addSelector(new Selector(deployedOrReleased: true));


        return (new Broker())
            ->setUrl(new Uri(getenv('PACT_BROKER_URL')))
            ->setEnablePending(true)
            ->setProviderBranch(exec('git rev-parse --abbrev-ref HEAD'))
            ->setConsumerVersionSelectors($selectors);
    }

    private function getConfig(): VerifierConfig
    {
        $config = new VerifierConfig();

        $config->getProviderInfo()
            ->setName(getenv('APP_NAME'))
            ->setHost($this->server->getHost());

        // Use only in CI
        $config->setPublishOptions($this->getCIConfig());

        return $config;
    }

    private function getCIConfig(): PublishOptions
    {
        return (new PublishOptions())
                ->setProviderVersion(exec('git rev-parse --short HEAD'))
                ->setProviderBranch(exec('git rev-parse --abbrev-ref HEAD'));
    }
}