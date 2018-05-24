<?php

namespace Service\Scanner;


class Scanner_LED implements ScannerInterface
{
    private $errors;

    /**
     * @param string $data
     * @return array
     */
    public function dataReception(string $data): array
    {
        if($data === '') {
            $this->setErrors('No input data');
            return null;
        }

        return $this->parsingData($data);
    }

    /**
     * @param string $data
     * @return array
     */
    private function parsingData(string $data): array
    {
        return json_decode($data);
    }

    /**
     * @return string
     */
    public function getErrors(): string
    {
        return $this->errors;
    }

    /**
     * @param string $errors
     */
    private function setErrors(string $errors): void
    {
        $this->errors = $errors;
    }
}