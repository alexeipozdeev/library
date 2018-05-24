<?php

namespace Service\Scanner;

interface ScannerInterface
{
    /**
     * @param string $data
     * @return array
     * @throws ScannerException
     */
    public function dataReception(string $data): array;

    /**
     * @return string
     */
    public function getErrors(): string;
}