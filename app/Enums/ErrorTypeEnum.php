<?php

namespace App\Enums;

enum ErrorTypeEnum: string
{
    // Base types
    case BAD_REQUEST = 'bad_request'; // 400
    case UNAUTHORIZED = 'unauthorized'; // 401
    case FORBIDDEN = 'forbidden'; // 403
    case NOT_FOUND = 'not_found'; // 404
    case METHOD_NOT_ALLOWED = 'method_not_allowed'; // 405
    case VALIDATION_ERROR = 'validation_error'; // 422
    case SERVER_ERROR = 'server_error'; // 500

    // Validation types
    case NAME_REQUIRED = 'name_required';
    case NAME_SHOULD_BE_STRING = 'name_should_be_string';
    case NAME_MAX_255 = 'name_max_255';
    case DESCRIPTION_REQUIRED = 'description_required';
    case DESCRIPTION_SHOULD_BE_STRING = 'description_should_be_string';
    case EMAIL_REQUIRED = 'email_required';
    case EMAIL_EXISTS = 'email_exists';
    case EMAIL_NOT_EXISTS = 'email_not_exists';
    case PASSWORD_REQUIRED = 'password_required';
    case PASSWORD_MIN = 'password_min_eight';
    case PASSWORD_MAX = 'password_max_one_hundred';
    case PASSWORD_NOT_CONFIRMED = 'password_not_confirmed';
    case INCORRECT_PASSWORD = 'incorrect_password';
    case TYPE_REQUIRED = 'type_required';
    case TYPE_SHOULD_BE_ISSUE_OR_SUGGESTION = 'type_should_be_issue_or_suggestion';
    case TAGS_IDS_NOT_ARRAY = 'tags_ids_not_array';
}
