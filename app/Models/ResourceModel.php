<?php

namespace App\Models;


interface ResourceModel
{
    static function getIndexData (): array;

    static function getStoreData (): array;

    static function getUpdateData (): array;

    static function getDeleteData(): array;
}
