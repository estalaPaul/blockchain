<?php

namespace EstalaPaul;

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
        $block->blockHash = $block->calculateHash();
        $this->chain[] = $block;
    }

    public function isChainValid(): bool
    {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->blockHash !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->blockHash) {
                return false;
            }
        }

        return true;
    }

    private function createGenesisBlock(): Block
    {
        return new Block(0, time(), ['Genesis Block'], '0');
    }
}
