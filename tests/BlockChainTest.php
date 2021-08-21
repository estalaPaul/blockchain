<?php

namespace Tests;

use EstalaPaul\Block;
use EstalaPaul\BlockChain;
use PHPUnit\Framework\TestCase;

class BlockChainTest extends TestCase
{
    public function testChain()
    {
        $blockChain = new BlockChain();
        $blockChain->addBlock(new Block(1, time(), [ 'amount' => 100 ]));
        $blockChain->addBlock(new Block(2, time(), [ 'amount' => 200 ]));
        $this->assertCount(3, $blockChain->chain);
    }

    public function testChainIsValid()
    {
        $blockChain = new BlockChain();
        $blockChain->addBlock(new Block(1, time(), [ 'amount' => 100 ]));
        $blockChain->addBlock(new Block(2, time(), [ 'amount' => 200 ]));
        $this->assertTrue($blockChain->isChainValid());

        $blockChain->chain[1]->data = [ 'amount' => 1000 ];
        $this->assertFalse($blockChain->isChainValid());

        $blockChain->chain[1]->blockHash = $blockChain->chain[1]->calculateHash();
        $this->assertFalse($blockChain->isChainValid());
    }

    private function logToScreen($message)
    {
        fwrite(STDERR, print_r($message, true));
    }
}
