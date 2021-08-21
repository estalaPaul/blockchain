<?php

namespace EstalaPaul\BlockChain;

class BlockChain
{
    /*
     * The chain of blocks.
     *
     * @var Block[]
     */
    public array $chain;

    public function __construct()
    {
        $this->chain = [$this->createGenesisBlock()];
    }

    public function getLatestBlock(): Block
    {
        return $this->chain[count($this->chain) - 1];
    }

    public function addBlock(Block $block)
    {
        $block->previousHash = $this->getLatestBlock()->blockHash;
        $block->hash = $block->calculateHash();
        $this->chain[] = $block;
    }

    private function createGenesisBlock(): Block
    {
        return new Block(0, time(), ['Genesis Block'], '0');
    }
}
