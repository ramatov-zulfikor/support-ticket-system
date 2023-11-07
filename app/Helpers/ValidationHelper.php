<?php

namespace App\Helpers;

use App\Enums\ErrorTypeEnum;

class ValidationHelper
{
    public static function getErrorType(array $failedRules): ErrorTypeEnum
    {
        $type = ErrorTypeEnum::VALIDATION_ERROR;

        if (isset($failedRules['name']['Required'])) {
            $type = ErrorTypeEnum::NAME_REQUIRED;
        }

        else if (isset($failedRules['name']['String'])) {
            $type = ErrorTypeEnum::NAME_SHOULD_BE_STRING;
        }

        else if (isset($failedRules['name']['Max'])) {
            $type = ErrorTypeEnum::NAME_MAX_255;
        }

        else if (isset($failedRules['description']['Required'])) {
            $type = ErrorTypeEnum::DESCRIPTION_REQUIRED;
        }

        else if (isset($failedRules['description']['String'])) {
            $type = ErrorTypeEnum::DESCRIPTION_SHOULD_BE_STRING;
        }

        else if (isset($failedRules['email']['Required'])) {
            $type = ErrorTypeEnum::EMAIL_REQUIRED;
        }

        else if (isset($failedRules['email']['Exists'])) {
            $type = ErrorTypeEnum::EMAIL_NOT_EXISTS;
        }

        else if (isset($failedRules['email']['Unique'])) {
            $type = ErrorTypeEnum::EMAIL_EXISTS;
        }

        else if (isset($failedRules['password']['Required'])) {
            $type = ErrorTypeEnum::PASSWORD_REQUIRED;
        }

        else if (isset($failedRules['password']['Min'])) {
            $type = ErrorTypeEnum::PASSWORD_MIN;
        }

        else if (isset($failedRules['password']['Max'])) {
            $type = ErrorTypeEnum::PASSWORD_MAX;
        }

        else if (isset($failedRules['password']['Confirmed'])) {
            $type = ErrorTypeEnum::PASSWORD_NOT_CONFIRMED;
        }

        else if (isset($failedRules['type']['Required'])) {
            $type = ErrorTypeEnum::TYPE_REQUIRED;
        }

        else if (isset($failedRules['type']['In'])) {
            $type = ErrorTypeEnum::TYPE_SHOULD_BE_ISSUE_OR_SUGGESTION;
        }

        else if (isset($failedRules['tags_ids']['Array'])) {
            $type = ErrorTypeEnum::TAGS_IDS_NOT_ARRAY;
        }

        return $type;
    }
}
