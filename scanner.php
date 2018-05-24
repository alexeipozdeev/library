<?php

use Model\Book\Book;
use Model\Disk\Disk;
use Service\DI\DI;
use Service\Scanner\ScannerException;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$data = DI::Request()->get('dataScaner');
if($data) {
    try {
        $fields = DI::Scanner()->dataReception($data);

        if($fields) {
            $model = $fields['isbn'] ? new Book() : new Disk();
            $model->assign($fields)->save();

            DI::Log()->info('Added successfully "' . $model->title . '" ID: ' . $model->id);
        } else {
            DI::Log()->error(DI::Scanner()->getErrors());
        }
    } catch (Exception $e) {
        DI::Log()->error($e->getMessage());
        throw new ScannerException("Unable to write data");
    }
}