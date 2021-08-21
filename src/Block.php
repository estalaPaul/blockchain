<?php

namespace EstalaPaul\BlockChain;

class Block
{
    /*
     * The blocks index.
     *
     * @var int
     */
    public int $index;

    /*
     * The blocks created timestamp.
     *
     * @var int
     */
    public int $timestamp;

    /*
     * The blocks data.
     *
     * @var array
     */
    public array $data;

    /*
     * The hash pertaining to the previous block.
     *
     * @var string
     */
    public string $previousHash;

    /*
     * The blocks hash.
     *
     * @var string
     */
    public string $blockHash;

    public function __construct(int $index, int $timestamp, array $data, string $previousHash)
    {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->blockHash = $this->calculateHash();
    }

    public function calculateHash(): string
    {
        return hash('sha256', $this->index . $this->previousHash . $this->timestamp . json_encode($this->data));
    }
}
