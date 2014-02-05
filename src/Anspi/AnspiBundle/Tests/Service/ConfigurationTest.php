<?php

namespace Anspi\AnspiBundle\Tests\Service;

use Anspi\AnspiBundle\Tests\TestCase;
use Anspi\AnspiBundle\Service\Configuration;

class ConfigurationTest extends TestCase
{
    public function testMinimalConfiguration()
    {
        $configuration = new Configuration();

        $this->assertFalse($configuration->isValid());

        $configuration->setUsername(TEST_TESSERAMENTOANSPI_USERNAME);
        $this->assertEquals(TEST_TESSERAMENTOANSPI_USERNAME, $configuration->getUsername());

        $this->assertFalse($configuration->isValid());

        $configuration->setPassword(TEST_TESSERAMENTOANSPI_PASSWORD);
        $this->assertEquals(TEST_TESSERAMENTOANSPI_PASSWORD, $configuration->getPassword());

        $this->assertTrue($configuration->isValid());
    }

    public function testSaveAndLoad()
    {
        $this->markTestIncomplete();

        $tempfile = tempnam(sys_get_temp_dir(), 'test-phpunit');
        $username = 'hello';
        $password = 'world';

        $configuration = $this->getConfiguration();
        $configuration->setUsername($username);
        $configuration->setUsername($password);
        $configuration->save($tempfile);

        $configuration = $this->getConfiguration();
        $configuration->load($tempfile);
        $this->assertEquals($username, $configuration->getUsername());
        $this->assertEquals($password, $configuration->getPassword());

        unlink($tempfile);
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }

}